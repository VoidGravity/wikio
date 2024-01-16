<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with JoeBLog landing page.">
    <meta name="author" content="Devcrud">
    <title>Wikio</title>
    <!-- font icons  -->

    <link rel="stylesheet" href="../../../public/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + JoeBLog main styles -->
    <link rel="stylesheet" href="../../../public/css/joeblog.css">
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <?php
    require_once "../inc/nav.php"
    ?>


    <header class="page-header"></header>
    <!-- end of page header -->

    <div class="container">
        <form method="post" action="../../controllers/wikiController.php" style="margin-top: 1rem;">
            <h1>Add new Wiki </h1>
            <input type="text" class="form-control" name="title" placeholder="Title" required>
            <textarea name="content" class="form-control" placeholder="Content" required></textarea>
            <textarea name="addDescription" class="form-control" placeholder="Description" required></textarea>
            <input type="hidden" class="form-control" name="author_id" value="author_id_here"> <!-- Use a session or another method to get the author_id -->

            <select name="CategorieId" class="form-control" required>
                <?php
                require_once '../../controllers/wikiController.php';
                $articleController = new ArticleController($db);
                $categories = $articleController->getCategoriesForView();
                foreach ($categories as $category) {
                    echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['Nom']) . "</option>";
                }
                var_dump($categories);
                ?>
            </select>
            <select name="tags[]" required class="form-control">
                <?php
                require_once '../../controllers/wikiController.php';
                $tags = $articleController->getTagforView();
                foreach ($tags as $tag) {
                    echo "<option value='" . htmlspecialchars($tag['id']) . "'>" . htmlspecialchars($tag['Nom']) . "</option>";
                }
                var_dump($categories);
                ?>
            </select>
            <button type="submit" name="createArticle" class="btn" style="width: 100%;background: #c2f6ea;margin-bottom: 1rem;">Create Wiki</button>
        </form>
    </div>
</body>

</html>