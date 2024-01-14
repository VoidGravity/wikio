<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/dashboard.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="side">
            <div class="h-100">
                <div class="sidebar_logo d-flex align-items-end">

                    <a href="#" class="nav-link text-white-50">Dashboard</a>

                </div>

                <ul class="sidebar_nav">
                    <li class="sidebar_item active" style="width: 100%;">
                        <a href="<?= url("dashboard")?>" class="sidebar_link"> <img src="<?= ABS_URL_dash ?>img/1. overview.svg" alt="icon">Overview</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="<?= url("dashboard/candidat")?>" class="sidebar_link"> <img src="<?= ABS_URL_dash ?>img/agents.svg" alt="icon">Candidat</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="<?= url("dashboard/offre")?>" class="sidebar_link"> <img src="<?= ABS_URL_dash ?>img/task.svg" alt="icon">Offre</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="<?= url("dashboard/contact")?>" class="sidebar_link"><img src="<?= ABS_URL_dash ?>img/agent.svg" alt="icon">Contact</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="#" class="sidebar_link"><img src="<?= ABS_URL_dash ?>img/articles.svg" alt="icon">list</a>
                    </li>

                </ul>
                <div class="line"></div>
                <a href="#" class="sidebar_link"><img src="<?= ABS_URL_dash ?>img/settings.svg" alt="">Settings</a>


            </div>
        </aside>
        <div class="main">
            <nav class="navbar justify-content-space-between pe-4 ps-2">
                <button class="btn open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar  gap-4">
                    <div class="">
                        <input type="search" class="search " placeholder="Search">
                        <img class="search_icon" src="<?= ABS_URL_dash ?>img/search.svg" alt="iconicon">
                    </div>
                    <!-- <img src="<?= ABS_URL_dash ?>img/search.svg" alt="icon"> -->
                    <img class="notification" src="<?= ABS_URL_dash ?>img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <div class="list-group list-group-light">
                            <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                <p class="mt-auto">Notification</p><a href="#"><img src="<?= ABS_URL_dash ?>img/settingsno.svg" alt="icon"></a>
                            </div>
                            <?php
                            foreach ($notifications as $notification) {
                            ?>
                                <div class="list-group-item px-3 d-flex"><img src="<?= ABS_URL_dash ?>img/notif.svg" alt="iconimage">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $notification['title'] ?></h5>
                                        <p class="card-text mb-3"><?= $notification['content'] ?>.</p>
                                        <small class="card-text"><?= $notification['created_at'] ?></small>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="list-group-item px-3 text-center"><a href="#">View all notifications</a></div>
                        </div>
                    </div>
                    <div class="inline"></div>
                    <div class="name"> Admin</div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                <img src="<?= ABS_URL_dash ?>img/photo_admin.svg" alt="icon">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <a class="dropdown-item" href="<?= url('logout') ?>">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="Agents px-4 d-flex">
                <section>
                    <table class="agent table align-middle bg-white" style="min-width: 700px;">
                        <thead class="bg-light">
                            <tr>
                                <th>Title</th>
                                <th>description</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Creation Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($offers as $offer) {

                                echo '
                            <tr class="freelancer">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <img src=" '.$offer["image_path"]. '" alt="test img" height="144" width="144">
                                            <p class="fw-bold mb-1 f_name">
                                            ' . $offer["title"] . '
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                <p class="fw-bold mb-1 f_name">' . $offer["description"] . '</p>
                                </td>
                                <td>
                                <p class="fw-bold mb-1 f_name">' . $offer["company"] . '</p></td>
                                <td><p class="fw-bold mb-1 f_name">' . $offer["location"] . '</p></td>
                                <td><p class="fw-bold mb-1 f_name">' . $offer["status"] . '</p></td>
                                <td><p class="fw-bold mb-1 f_name">' . $offer["date_created"] . '</p></td>
                                <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo">Edit</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delateModal" data-bs-whatever="@mdo">Delate</button>
                                </td>
                            </tr>
                            ';
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
                <section class="ms-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">ADD</button>

                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../model/OfferCrud.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title" class="col-form-label">Title:</label>
                                            <input type="text" id="title" name="title" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Description:</label>
                                            <textarea id="desc" class="form-control" name="desc"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="company" class="col-form-label">Company:</label>
                                            <input type="text" id="company" name="company" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="col-form-label">Location:</label>
                                            <input type="text" id="location" name="location" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="col-form-label">Status:</label>
                                            <input type="text" id="status" name="status" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="col-form-label">Image:</label>
                                            <input type="file" name="image" id="image"> 
                                        </div>
                                        <div class="mb-3">
                                            <label for="user" class="col-form-label">User:</label>
                                            <input type="text" id="user" name="user" class="form-control">
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Send message</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../model/OfferCrud.php" method="POST">
                                        <div class="mb-3">
                                            <label for="title" class="col-form-label">Id:</label>
                                            <input type="text" id="title" name="idedit" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Title:</label>
                                            <textarea id="desc" class="form-control" name="title"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="company" class="col-form-label">Description:</label>
                                            <input type="text" id="company" name="desc" class="form-control">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submitUpdate" class="btn btn-primary">Send message</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade " id="delateModal" tabindex="-1" aria-labelledby="delateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delate offer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../model/OfferCrud.php" method="POST">
                                        <div class="mb-3">
                                            <label for="title" class="col-form-label">id:</label>
                                            <input type="text" id="Delate" name="OfferID" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submitDelete" class="btn btn-primary">Send message</button>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                               
                                ?>

                            </div>
                        </div>
                    </div>
                </section>
            </section>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../assets/styles/dashboard/dashboard.js"></script>
</body>

</html>