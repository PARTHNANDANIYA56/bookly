<?php


include('config.php');

    $id = $_POST['delid']; 
    $delete_query = "DELETE FROM `category` WHERE  `id` = $id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
               echo 200;
    } else {

        echo 500;
    }
?>