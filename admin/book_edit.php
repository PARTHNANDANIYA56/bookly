<?php
session_start();
include('config.php');

$id = $_GET['id'];




if (isset($_POST['update'])) {

    // $update_id = $_POST['update_id'];
    $update_title = $_POST['update_title'];
    $update_description = $_POST['update_description'];
    $update_author = $_POST['update_author'];
    $update_publisher = $_POST['update_publisher'];
    $update_isbn = $_POST['update_isbn'];
    $update_category = $_POST['update_category'];
    $status = $_POST['status'];
    // $shows = $_POST['shows'];

    // cover
    $update_cover = $_FILES['update_cover']['name'];
    $update_cover_size = $_FILES['update_cover']['size'];
    $update_cover_tmp_name = $_FILES['update_cover']['tmp_name'];
    $update_cover_folder = '../upload/cover/' . $update_cover;
    $update_old_cover = $_POST['update_old_cover'];

    // file
    $update_file = $_FILES['update_file']['name'];
    $update_file_size = $_FILES['update_file']['size'];
    $update_file_tmp_name = $_FILES['update_file']['tmp_name'];
    $update_file_folder = '../upload/book/' . $update_file;
    $update_old_file = $_POST['update_old_file'];





    $q = "UPDATE `books` SET `title`='$update_title',`author`='$update_author',`description`='$update_description',`publisher`='$update_publisher',`isbn`='$update_isbn',`category_id`='$update_category',`status`='$status' WHERE `id` = $id";
    $run = mysqli_query($conn, $q) or die('query failed');


    if (!empty($update_cover)) {
        if ($update_cover_size > 2000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `books` SET cover = '$update_cover' WHERE id = $id") or die('query failed');
            move_uploaded_file($update_cover_tmp_name, $update_cover_folder);
            // unlink('../upload/book/',$update_old_cover);
        }
    }
    if (!empty($update_file)) {
        if ($update_file_size > 200000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `books` SET file = '$update_file' WHERE id = $id") or die('query failed');
            move_uploaded_file($update_file_tmp_name, $update_file_folder);

            // unlink('../upload/book/',$update_old_file);

        }
    }
    if ( $run || $update_cover ||$update_file) {
        $_SESSION['book_status'] = "Book Detail Updated Successfully";
        $_SESSION['book_status_code'] = "success";
        header('location:books.php');
    } else {
        $_SESSION['book_status'] = "Book Detail Not Updated Successfully";
        $_SESSION['book_status_code'] = "error";
        header('location:books.php');
    }
    // header('location:books.php');
}



//  add files
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
                    <div class="text-dark">Hii, <?php echo $_SESSION['admin_name'] . " "; ?></div>
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

            <h1 class="h3 mb-3"><strong>Books</strong> </h1>



            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    $select_book = mysqli_query($conn, "SELECT * FROM `books` where `id` = $id") or die('query failed');
                    if (mysqli_num_rows($select_book) > 0) {
                        while ($fetch_books = mysqli_fetch_assoc($select_book)) {
                    ?>


                            <div class="mb-3">
                                <label for="update_title" class="form-label fs-6">Title</label>
                                <input type="text" name="update_title" class="form-control" id="update_title" value="<?php echo $fetch_books['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="update_description" class="form-label fs-6">Description</label>
                                <textarea class="form-control" name="update_description" placeholder="decription" id="update_description" style="height: 100px"><?php echo $fetch_books['description'] ?>
                    </textarea>
                                <!-- <input type="text"  class="form-control" id="book_description"> -->
                            </div>
                            <div class="mb-3">

                                <label for="update_author" class="form-label fs-6">Author</label>
                                <input type="text" class="form-control" name="update_author" id="update_title" value="<?php echo $fetch_books['author'] ?>">
                                <!--  -->
                                <!-- <input type="text"  class="form-control" id="book_author"> -->
                            </div>

                            <div class="mb-3">
                                <label for="update_publisher" class="form-label fs-6">Publisher</label>
                                <input type="text" name="update_publisher" class="form-control" id="update_publisher" value="<?php echo $fetch_books['publisher'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="update_isbn" class="form-label fs-6">ISBN number</label>
                                <input type="text" name="update_isbn" class="form-control" id="update_isbn" max=13 value="<?php echo $fetch_books['isbn'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="update_category" class="form-label fs-6">Category</label>
                                <select class="form-select" name="update_category" aria-label="Default select example">
                                    <option selected disabled>Select Category</option>
                                    <?php
                                    $cname = $fetch_books['category_id'];
                                    $scategory = mysqli_query($conn, "SELECT * FROM `category`") or die('query failed');
                                    if (mysqli_num_rows($scategory) > 0) {
                                        while ($fetch_category = mysqli_fetch_assoc($scategory)) {
                                            if ($fetch_category['id'] == $cname) {
                                                echo '<option value="' . $fetch_category['id'] . '"selected>' . $fetch_category['category'] . '</option>';
                                            } else {

                                                echo '<option value="' . $fetch_category['id'] . '">' . $fetch_category['category'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>

                                </select>
                                <!-- <input type="text"  class="form-control" id="book_category"> -->
                            </div>

                            <div class="mb-3">
                                <label for="update_cover" class="form-label fs-6">Book Cover</label>
                                <input type="file" name="update_cover" accept="image/jpg, image/jpeg, image/png" class="form-control" id="update_cover"><span name="update_old_cover" value="<?php echo $fetch_books['cover'] ?>"><?php echo $fetch_books['cover'] ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="update_file" class="form-label fs-6">Book File</label>
                                <input type="file" name="update_file" accept=".pdf" class="form-control" id="book_file"><span name="update_old_file" value="<?php echo $fetch_books['file'] ?>"><?php echo $fetch_books['file'] ?></span>
                            </div>
                            <select class="form-select mb-3" name="status" required>
                                <option value="0" <?= $fetch_books['status'] == 0 ? 'selected="selected"' : "" ?>> Pending</option>
                                <option value="1" <?= $fetch_books['status'] == 1 ? 'selected="selected"' : "" ?>>Approved</option>
                                <option value="2" <?= $fetch_books['status'] == 2 ? 'selected="selected"' : "" ?>>Rejected</option>
                            </select>
                            <button type="submit" name="update" class="btn btn-primary">Save Changes</button>


                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </form>

            </div>
        </div>


    </main>


    <?php include('includes/scripts.php');

    include('includes/footer.php') ?>