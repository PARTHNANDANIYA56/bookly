<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$ct = $_GET['ct'];
$pid = $_GET['pid'];
// if(!isset($user_id)){
//    header('location:login.php');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ct ?></title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3><?php echo $ct ?></h3>
        <p> <a href="home.php">Home</a> / Category / <?php echo $ct ?> </p>
    </div>

    <section class="spec-books">
        <div class="spec-heading title"><?php echo $ct ?></div>
        <div class="spec-container" style="flex-wrap: wrap;">
            <?php
        //  $select_book = mysqli_query($conn, "SELECT b.*,c.* FROM `books` b, `category` c WHERE b.shows = '1' and c.id = b.category_id AND c.category LIKE '%{$ct}%'") or die('query failed');
         $select_book = mysqli_query($conn, "SELECT b.*, c.*, b.id AS book_id FROM `books` b, `category` c WHERE b.shows = '1' and c.id = b.category_id AND c.category LIKE '%{$ct}%'") or die('query failed');
         if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
         ?>
            <a href="product.php?pid=<?php echo $fetch_books['book_id']; ?>" rel="noopener noreferrer">
                <div class="content">
                    <div class="spec-imag">
                        <img class="" src="./upload/cover/<?php echo $fetch_books['cover']; ?>" alt="">
                    </div>

                    <div class="spec-text"><?php echo $fetch_books['title']; ?>
                    </div>
                </div>
            </a>
            <?php
            }
         } else {
            // echo '<p class="empty">no products added yet!</p>';
         }
         ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>