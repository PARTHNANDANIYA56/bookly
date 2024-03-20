<?php


include('../config.php');

// if (isset($_POST['confirm_btn'])) {

    $id = $_POST['delid'];

    // $category = "SELECT * FROM `category` WHERE `id` = $id";
    // $run = mysqli_query($conn, $book_query);
    // $book_data = mysqli_fetch_array($run);
    // $book_cover = $book_data['cover'];
    // $book_file = $book_data['file'];

    $delete_query = "DELETE FROM `category` WHERE  `id` = $id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
               echo 200;
    } else {

        echo 500;
    }
// }
