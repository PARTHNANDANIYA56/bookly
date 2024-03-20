<?php
include('../config.php');

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">




                <li class="nav-item d-flex justify-content-center align-items-center">
                    <div class="text-dark">Hii , <?php echo $_SESSION['author_name'] . " "; ?></div>
                    <a class="nav-link" href="../logout.php">
                        <button type="button" class="btn btn-outline-dark">
                            Log out
                        </button>
                    </a>

                </li>

            </ul>
        </div>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Dashboard</strong> </h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Books</h5>
                                            </div>

                                            <!-- <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div> -->
                                        </div>
                                        <?php
                                        $id = $_SESSION['author_id'];
                                        $select_book_number = mysqli_query($conn, "SELECT * FROM `books` where `author_id`='$id'") or die('query failed');
                                        $books_rows_number = mysqli_num_rows($select_book_number);
                                        ?>
                                        <h1 class="mt-1 mb-3"><?php echo $books_rows_number; ?></h1>
                                    </div>
                                </div>



                            </div>
                            <div class="col-sm-6">


                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Category</h5>
                                            </div>

                                            <!-- <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div> -->
                                        </div>
                                        <?php
                                            $select_category_number = mysqli_query($conn, "SELECT * FROM `category` where `editor`='author'") or die('query failed');
                                            $categories_rows_number = mysqli_num_rows($select_category_number);
                                            ?>
                                        <h1 class="mt-1 mb-3"><?php echo $categories_rows_number; ?></h1>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
    </main>


    <?php include('includes/scripts.php');

    include('includes/footer.php') ?>