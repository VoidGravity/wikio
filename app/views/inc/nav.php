<?php session_start();
?>

<nav class="navbar custom-navbar navbar-expand-md navbar-light bg-primary sticky-top">
    <div class="container">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="no-sidebar.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="no-sidebar.html">No Sidebar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="single-post.html">Single Post</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <!-- input search wide -->
                    <form class="form-inline my-3 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            <div class="navbar-nav ml-auto">

                <ul>
                    <?php if (isset($_SESSION['user_role'])) : ?>

                        <a href="../pages/authorWiki.php" class="ml-2 btn btn-dark mt-1 btn-sm">Manage Article</a>
                        <!-- I'll offer him the option to add and hide articles -->
                        <a href="../../controllers/UserController.php?action=logout" class="ml-4 btn btn-secondary mt-1 btn-sm">Logout</a>

                    <?php else : ?>
                        <!-- <li class="nav-item"> -->
                        <a href="../pages/signIn.php" class="ml-4 btn btn-secondary mt-1 btn-sm">Login</a>
                        <a href="../pages/signup.php" class="ml-2 btn btn-dark mt-1 btn-sm">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>
</nav>