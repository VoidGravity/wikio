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
        <?php
        require_once '../../controllers/wikiController.php';
        $articleController = new ArticleController();
        $wikiData = $articleController->getArticleById($_GET['EAWid']);
        ?>
        <form method="post" action="../../controllers/wikiController.php" style="margin-top: 1rem;">
            <input type="hidden" value="<?= $_GET['EAWid']; ?>" name="id">
            <h1>Add new Wiki </h1>
            <input type="text" value="<?= $wikiData->title ?>" class="form-control" name="title" placeholder="Title" required>
            <textarea name="content" class="form-control" placeholder="Content" required><?= $wikiData->content ?></textarea>
            <textarea name="addDescription" class="form-control" placeholder="Description" required><?= $wikiData->description ?></textarea>
            <input type="hidden" class="form-control" name="author_id" value="<?= $_SESSION['user_id'] ?>"> <!-- Use a session or another method to get the author_id -->

            <select value="<?= $wikiData->CategorieId ?>" name="CategorieId" class="form-control" required>
                <?php
                $categories = $articleController->getCategoriesForView();
                foreach ($categories as $category) {
                    echo "<option selected='" . ($wikiData->CategorieId == $category['id']?"true":"false") . "' value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['Nom']) . "</option>";
                }
                var_dump($categories);
                ?>
            </select>
            <select value="<?= $wikiData->tagId ?>" name="tags[]" required class="form-control">
                <?php
                require_once '../../controllers/wikiController.php';
                $tags = $articleController->getTagforView();
                foreach ($tags as $tag) {
                    echo "<option selected=" . ($wikiData->tagId == $tag['id']) . " value='" . htmlspecialchars($tag['id']) . "'>" . htmlspecialchars($tag['Nom']) . "</option>";
                }
                var_dump($categories);
                ?>
            </select>
            <button type="submit" name="updateArticle" class="btn" style="width: 100%;background: #c2f6ea;margin-bottom: 1rem;">Update Wiki</button>
        </form>
    </div>
</body>

</html>