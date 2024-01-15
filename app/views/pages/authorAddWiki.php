<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="../../controllers/wikiController.php">
                        <input type="text" name="title" placeholder="Title" required>
                        <textarea name="content" placeholder="Content" required></textarea>
                        <textarea name="addDescription" placeholder="Description" required></textarea>
                        <input type="hidden" name="author_id" value="author_id_here"> <!-- Use a session or another method to get the author_id -->

                        <select name="CategorieId" required>
                            <?php
                            //   //     /////    ::    ::   
                            //   //   //    //   ::    ::
                            //      //    //   ::    ::
                            //      //    //   ::    ::
                            //       /////      ::::::

                            require_once '../../controllers/wikiController.php';
                            $articleController = new ArticleController($db);

                            $categories = $articleController->getCategoriesForView();
                            foreach ($categories as $category) {
                                echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['Nom']) . "</option>";
                            }
                            var_dump($categories);
                            ?>

                        </select>


                        <select name="tags[]" required>
                            <?php
                            //   //     /////    ::    ::   
                            //   //   //    //   ::    ::
                            //      //    //   ::    ::
                            //      //    //   ::    ::
                            //       /////      ::::::

                            require_once '../../controllers/wikiController.php';
                            // $articleController = new ArticleController($db);

                            $tags = $articleController->getTagforView();
                            foreach ($tags as $tag) {
                                echo "<option value='" . htmlspecialchars($tag['id']) . "'>" . htmlspecialchars($tag['Nom']) . "</option>";
                            }
                            var_dump($categories);
                            ?>
                        </select>
                        <button type="submit" name="createArticle">Create Wiki</button>
                    </form>
</body>
</html>