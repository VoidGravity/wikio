<?


?>
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
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <?php
    require_once "../inc/nav.php"
    ?>


    <header class="page-header"></header>
    <!-- end of page header -->

    <div class="container">
        <section>
            <div class="feature-posts">
                <a href="" class="feature-post-item">
                    <span>Last Categories</span>
                </a>
                <?php
                require_once '../../controllers/wikiController.php';
                $wiki = new ArticleController();
                $Thedata = $wiki->getNoSideBarData();
                 foreach ($Thedata['categories'] as $category) { ?>

<a href="single-post.html" class="feature-post-item">
                        <img src="../../../public/imgs/img-1.jpg" class="w-100" alt="">
                        <div class="feature-post-caption"><?=$category["Nom"]?></div>
                    </a>

                    <?php } ?>
                
                </div>
        </section>
        <hr>
        <div class="page-container">
            <div class="page-content">
                <p class="d-flex justify-content-center">
                <h1 class="d-flex justify-content-center">Derniers wikis</h1>
                </p>

                <?php 
                foreach ($Thedata['articles'] as $article) { ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-center mb-5">
                            <div class="card-header p-0">
                                <div class="blog-media">
                                    <img src="../../../public/imgs/blog-2.jpg" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary"><?=$article["Nom"]?></a>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                <h5 class="card-title mb-2"><?=$article["title"]?></h5>
                                <small class="small text-muted"><?=$article["creationDate"]?>
                                    <!--  -->
                                    <!-- <a href="#" class="text-muted">34 Comments</a> -->
                                </small>
                                <p class="my-2"><?=$article["description"]?></p>
                            </div>

                            <div class="card-footer p-0 text-center">
                                <a href="single-post.php?id=<?=$article['id']?>" class="btn btn-outline-dark btn-sm">READ MORE</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
                <!-- <button class="btn btn-primary btn-block my-4">Load More Posts</button> -->
            </div>
        </div>
    </div>



    <!-- Page Footer -->
    <?php
    // require_once "../inc/footer.html"
    ?>
    <!-- End of Page Footer -->

    <!-- core  -->
    <script src="../../../public/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="../../../public/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- JoeBLog js -->
    <script src="../../../public/js/joeblog.js"></script>

</body>

</html>