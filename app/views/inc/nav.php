<?php session_start();
?>
<style>
    .search {
        position: relative;
    }

    .search .results {
        display: none;
        position: absolute;
        top: 100%;
        background: white;
        left: 0;
        right: 0;
        box-shadow: #0000002e 0px 9px 13px;
        padding: 8px;
    }
</style>
<nav class="navbar custom-navbar navbar-expand-md navbar-light bg-primary sticky-top">
    <div class="container">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="no-sidebar.php">Home</a>
                </li>
                
                
                
                <li class="nav-item">
                    <!-- input search wide -->
                    <form class="form-inline my-3 my-lg-0">
                        <div class="search">
                            <input class="form-control" type="search" id="searchInput" placeholder="Search" aria-label="Search">
                            <div class="results" id="searchResults">
                            </div>
                        </div>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            <div class="navbar-nav ml-auto">

                <ul>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin") { ?>
                        <a href="../pages/dashboard.php" class="ml-2 btn btn-dark mt-1 btn-sm">Dashboard</a>
                    <?php } ?>
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

<script>
    var searchResults = document.getElementById('searchResults');
    var searchInput = document.getElementById('searchInput');

    searchResults.innerHTML = `<ul><li class="item">fxgvcqsdfsdfg</li></ul>`;
    searchInput.addEventListener('keyup', function(event) {
        var value = event.target.value;

        // Clear previous results
        searchResults.innerHTML = '';

        var results = fetch('../../controllers/wikiController.php?action=search&value=' + value)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var data = data.map(e => `<a href="single-post.php?id=${e.id}"><li class="item">${e.title}</li></a>`).join('');
                // Process the search results
                if (value.length > 0) {
                    searchResults.style.display = 'block';
                    searchResults.innerHTML = `<ul>${data}</ul>`;
                } else {
                    searchResults.style.display = 'none';
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                searchResults.style.display = 'none';
            });
    });
</script>