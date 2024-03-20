<?php
session_start();
include('config.php');




if (isset($_POST['add_book'])) {

    $title = $_POST['book_title'];
    $description = $_POST['book_description'];
    $author = $_POST['book_author'];
    $publisher = $_POST['book_publisher'];
    $isbn = $_POST['book_isbn'];
    $category = $_POST['book_category'];
    $shows = $_POST['shows'];
    $admin_id = $_POST['admin_id'];
    $status = $_POST['status'];
    // cover
    $cover = $_FILES['book_cover']['name'];
    $cover_size = $_FILES['book_cover']['size'];
    $cover_tmp_name = $_FILES['book_cover']['tmp_name'];
    $cover_folder = '../upload/cover/' . $cover;

    // file
    $file = $_FILES['book_file']['name'];
    $file_size = $_FILES['book_file']['size'];
    $file_tmp_name = $_FILES['book_file']['tmp_name'];
    $file_folder = '../upload/book/' . $file;

    // echo $title.$description.$author.$publisher.$isbn.$shows.$cover_folder.$file_folder;

    $add_book_query = mysqli_query($conn, "INSERT INTO `books`(`title`, `author`,`author_id`,`description`, `publisher`, `isbn`, `category_id`, `cover`, `file`, `shows`,`status`) VALUES ('$title','$author','$admin_id','$description','$publisher','$isbn','$category','$cover','$file','$shows','$status')") or die('query failed');


    if ($add_book_query) {
        if ($cover_size > 2000000) {
            $message[] = 'Cover Photo size is too large';
        } else {
            move_uploaded_file($cover_tmp_name, $cover_folder);
            $message[] = 'Product added successfully!' . print($add_book_query);
        }
    } else {
        $message[] = 'product could not be added!';
    }
    if ($add_book_query) {
        if ($file_size > 100000000) {
            $message[] = 'Cover Photo size is too large';
        } else {
            move_uploaded_file($file_tmp_name, $file_folder);
        }
        $_SESSION['book_status'] = "Book added successfully!";
        $_SESSION['book_status_code'] = "success";
    } else {
        $_SESSION['book_status'] = "Book not added successfully!";
        $_SESSION['book_status_code'] = "error";
    }
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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-dark mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Book
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="book_title" class="form-label fs-6">Title</label>
                                    <input type="text" name="book_title" class="form-control" id="book_title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="book_description" class="form-label fs-6">Description</label>
                                    <textarea class="form-control" name="book_description" placeholder="decription" id="book_description" style="height: 100px" required></textarea>
                                </div>
                                <div class="row">

                                    <div class="mb-3 col-6">

                                        <label for="book_author" class="form-label fs-6">Author</label>
                                        <input type="text" name="book_author" class="form-control" id="book_author" required>

                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="book_publisher" class="form-label fs-6">Publisher</label>
                                        <input type="text" name="book_publisher" class="form-control" id="book_publisher" required>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="mb-3 col-6">
                                        <label for="book_isbn" class="form-label fs-6">ISBN number</label>
                                        <input type="text" name="book_isbn" class="form-control" id="book_isbn" max=13 required>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="book_category" class="form-label fs-6">Category</label>
                                        <select class="form-select" name="book_category" aria-label="Default select example" required>
                                            <option selected disabled>Select Category</option>
                                            <?php
                                            // $name = "author";
                                            $scategory = mysqli_query($conn, "SELECT * FROM `category`") or die('query failed');
                                            if (mysqli_num_rows($scategory) > 0) {
                                                while ($fetch_category = mysqli_fetch_assoc($scategory)) {
                                                    echo '<option value="' . $fetch_category['id'] . '">' . $fetch_category['category'] . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                        <!-- <input type="text"  class="form-control" id="book_category"> -->
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="book_cover" class="form-label fs-6">Book Cover</label>
                                    <input type="file" name="book_cover" accept="image/jpg, image/jpeg, image/png" class="form-control" id="book_cover" required>
                                </div>
                                <div class="mb-3">
                                    <label for="book_file" class="form-label fs-6">Book File</label>
                                    <input type="file" name="book_file" accept=".pdf" class="form-control" id="book_file" required>
                                </div>
                                <input type="hidden" value="0" name="shows" id="shows">
                                <input type="hidden" value="<?php echo $_SESSION['admin_id'] ?>" name="admin_id" id="admin_id">
                                <input type="hidden" value="1" name="status" id="status">
                                <button type="submit" name="add_book" class="btn btn-primary">Add book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row" id="example1">

                            <!-- book table start here -->
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead class='table-dark'>
                                    <tr>
                                        <th>No.</th>
                                        <td>Cover</td>
                                        <td>file</td>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>ISBN</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                        <th>Shows</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <?php
                                        $select_book = mysqli_query($conn, "SELECT * FROM `books`") or die('query failed');
                                        if (mysqli_num_rows($select_book) > 0) {
                                            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
                                        ?>


                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <!-- cover image here -->
                                                        <div>
                                                            <img src="<?php echo '../upload/cover/' . $fetch_books['cover']; ?>" alt="cover_pic" style="width: 165px;height: 245px;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <!-- file here -->
                                                        <div>
                                                            <a href="<?php echo '../upload/book/' . $fetch_books['file']; ?>" target="_blank" rel="noopener noreferrer">
                                                                <button type="button" class="btn btn-outline-dark">
                                                                    View
                                                                </button>
                                                            </a>
                                                        </div>

                                                    </td>
                                                    <td><?php echo $fetch_books['title']; ?></td>
                                                    <td><?php echo $fetch_books['description']; ?></td>
                                                    <td><?php echo $fetch_books['author']; ?></td>
                                                    <td><?php echo $fetch_books['publisher']; ?></td>
                                                    <td><?php echo $fetch_books['isbn']; ?></td>
                                                    <td>
                                                        <?php

                                                        $fb = $fetch_books['category_id'];
                                                        $select_category = mysqli_query($conn, "SELECT * FROM `category` WHERE `id` = $fb ") or die('query failed');
                                                        if (mysqli_num_rows($select_category) > 0) {
                                                            while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                                                                echo $fetch_category['category'];
                                                            }
                                                        } else {
                                                            echo '<p class="empty">no products added yet!</p>';
                                                        }


                                                        ?>
                                                    </td>
                                                    <td>

                                                        <div class="d-flex">
                                                            <!-- edit button start here -->
                                                            <a href="book_edit.php?id=<?php echo $fetch_books['id']; ?>">
                                                                <button class="btn btn-warning me-2"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></button>
                                                            </a>

                                                            <!-- -------------------------- -->
                                                            <!-- delete button start here -->
                                                            <button class="btn btn-danger confirm_btn" onclick="deleterow(<?php echo $fetch_books['id']; ?>)"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>


                                                        <div class="form-check form-switch justify-content-center align-items-center d-flex">
                                                            <?php
                                                            // echo $fetch_books['shows'];  
                                                            ?>
                                                            <input class="form-check-input" type="checkbox" name="shows" id="shows" value=<?php echo '"' . $fetch_books['shows'] . '"';
                                                                                                                                            if ($fetch_books['shows'] == "1") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?> onclick="togleactive(<?php echo $fetch_books['id']; ?>)">

                                                        </div>

                                                    </td>
                                                    <td>
                                                        <?php if ($fetch_books['status'] == 1) {
                                                            echo "<button class='btn btn-success' disabled>Approved</button>";
                                                        } else if ($fetch_books['status'] == 2) {
                                                            echo "<button class='btn btn-danger' disabled>Rejected</button>";
                                                        } else {
                                                            echo "<button class='btn btn-warning' disabled>Pending</button>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                        <?php
                                            }
                                        } else {
                                            echo '<p class="empty">no products added yet!</p>';
                                        }
                                        ?>






                                    </form>
                                </tbody>
                                
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>


    <?php include('includes/scripts.php');
    if (isset($_SESSION['book_status']) && $_SESSION['book_status'] != "") {
        echo  '<script>
swal({
title: "' . $_SESSION['book_status'] . '",
icon: "' . $_SESSION['book_status_code'] . '",
button: "Ok",
})
</script>';
        unset($_SESSION['book_status']);
    }

    include('includes/footer.php') ?>