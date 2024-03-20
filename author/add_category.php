<?php
session_start();
include '../config.php';



if (isset($_POST['add_category'])) {
    $add_category = $_POST['acategory'];
    $editor = $_POST['editor'];

    $select_category = mysqli_query($conn, "SELECT * FROM `category` where `category` ='$add_category'");

    if (mysqli_num_rows($select_category) > 0) {
        $_SESSION['category_status'] = "Category alredy exists";
        $_SESSION['category_status_code'] = "error";
    } else {
        $add_category_query = mysqli_query($conn, "INSERT INTO `category`(`category`, `editor`) VALUES ('$add_category','$editor')");

        if ($add_category_query) {
            $_SESSION['category_status'] = "Category Added Successfully";
            $_SESSION['category_status_code'] = "success";
        } else {
            $_SESSION['category_status'] = "Category not Added Successfully";
            $_SESSION['category_status_code'] = "error";
        }
    }
}

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
                    <div class="text-dark">Hii, <?php echo $_SESSION['author_name'] . " "; ?></div>
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

            <h1 class="h3 mb-3"><strong>Category</strong> </h1>

            <div class="row">


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-dark mb-3 ms-3" data-bs-toggle="modal" data-bs-target="#category" style="width: 138px;">
                    Add Category
                </button>

                <!-- Add Category -->
                <div class="modal fade" id="category" tabindex="-1" aria-labelledby="addCategory" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategory">Add Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="Category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="Category" name="acategory">
                                    </div>
                                    <input type="hidden" value="<?php echo $_SESSION['author_name'] . " "; ?>" name="editor">
                                    <button type="submit" class="btn btn-primary" name="add_category">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Category List -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row" id="example1">

                                <!-- book table start here -->
                                <table id="acategory" class="table table-bordered" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <td>Category Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="" method="post">
                                            <?php

                                            $ename = $_SESSION['author_name'];
                                            $select_category = mysqli_query($conn, "SELECT * FROM `category` where `editor` ='$ename'") or die('query failed');
                                            if (mysqli_num_rows($select_category) > 0) {
                                                while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                            ?>

                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $fetch_category['category'] ?></td>
                                                        <td>

                                                            <div class="">
                                                                <!-- edit button start here -->
                                                                <a href="update_category.php?uid=<?php echo $fetch_category['id'] ?>">
                                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                                    </button>
                                                                </a>
                                                                <!-- delete button start here -->
                                                                <button class="btn btn-danger confirm_btn" onclick="deleteCategory(<?php echo $fetch_category['id']; ?>)"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                                                            </div>
                                        </form>
                                        </td>

                                        </tr>
                                <?php
                                                }
                                            } else {
                                            }
                                ?>






                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
    </main>


    <?php include('includes/scripts.php');
  if (isset($_SESSION['category_status']) && $_SESSION['category_status'] != "") {
    echo  '<script>
swal({
title: "' . $_SESSION['category_status'] . '",
icon: "' . $_SESSION['category_status_code'] . '",
button: "Ok",
})
</script>';
    unset($_SESSION['category_status']);
}
    include('includes/footer.php') ?>