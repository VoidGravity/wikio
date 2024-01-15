<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with JoeBLog landing page.">
    <meta name="author" content="Devcrud">
    <title>Wikio</title>
    <!-- font icons -->
    <link rel="stylesheet" href="../../../public/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + JoeBLog main styles -->
    <link rel="stylesheet" href="../../../public/css/joeblog.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page Second Navigation -->
    <?php
    require_once "../inc/nav.php";
    require_once "../../controllers/wikiController.php";
    $wiki = new ArticleController();
    $id = $_GET["id"];
    $Thedata = $wiki->read($id);

    ?>
    <!-- End Of Page Second Navigation -->

    <!-- Page Header -->
    <header class="page-header page-header-mini">
        <h1 class="title"><?= $Thedata["title"] ?></h1>
        <ol class="breadcrumb pb-0">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $Thedata["description"] ?></li>
        </ol>
    </header>
    <!-- End Of Page Header -->

    <section class="container">
        <div class="page-container">
            <div class="page-content">
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4"><?= $Thedata["title"] ?></h3>
                        <div class="blog-media mb-4">
                            <img src="../../../public/imgs/blog-6.jpg" alt="" class="w-100">
                            <a href="#" class="badge badge-primary"><?= $Thedata["Nom"] ?></a>
                        </div>
                        <small class="small text-muted">
                            <!-- <a href="#" class="text-muted">BY Admin</a> -->
                            <span class="px-2">·</span>
                            <span><?= $Thedata["creationDate"] ?></span>
                            <span class="px-2">·</span>
                            <!-- <a href="#" class="text-muted">32 Comments</a> -->
                        </small>
                    </div>
                    <div class="card-body border-top">
                        <p class="my-3"><?= $Thedata["content"] ?></p>
                    </div>

                    <div class="card-footer">
                        <!-- <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments 4</a></h6> -->


                        <div class="page-sidebar">
                            <h6 class=" ">Categorie</h6>
                            <a href="single-post.php" class="badge badge-primary m-1"><?= $Thedata["Nom"] ?></a>

                        </div>
                    </div>
                </div>

                <!-- <h6 class="mt-5 text-center">Related Posts</h6> -->
                <hr>

            </div>
            <!-- Sidebar -->
            <div class="page-sidebar">
                <h6 class="">Tags</h6>
                <?php
                foreach ($Thedata as $tag) { ?>



                    <a href="single-post.php" class="badge badge-primary m-1"><?= $Thedata["tagName"] ?></a>
                <?php
                } ?>
                

            </div>
        </div>
    </section>




    <!-- Page Footer -->
    <?php
    require_once "../inc/footer.html"
    ?>
    <!-- End of Page Footer -->

    <!-- core  -->
    <script src="../../../public/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="../../../public/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- JoeBLog js -->
    <script src="../../../public/js/joeblog.js"></script>

</body>

</html>