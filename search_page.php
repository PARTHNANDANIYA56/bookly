<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// };

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <title>search page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>search page</h3>
        <p> <a href="home.php">home</a> / search </p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search products..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>

    <section class="books" style="padding-top: 0;">

        <div class="box-container">
            <?php
         if (isset($_POST['submit'])) {
            $search_item = $_POST['search'];
            $select_books = mysqli_query($conn, "SELECT * FROM `books` b,`category` c WHERE b.`title` LIKE '%{$search_item}%' OR b.`author` LIKE '%{$search_item}%' OR c.`category` LIKE '%{$search_item}%'") or die('query failed');
            if (mysqli_num_rows($select_books) > 0) {
               while ($fetch_books = mysqli_fetch_assoc($select_books)) {
         ?>
            <div class="box">
                <div class="image">
                    <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                        <img class="img" src="./upload/cover/<?php echo $fetch_books['cover'];?>" alt="">
                    </a>
                </div>
                <div class="content">
                    <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                        <h2 class="name"><?php echo $fetch_books['title']; ?></h2>
                        <!-- <div class="price"></div> -->
                        <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" class="btn">Free</a>
                </div>
                </a>
            </div>
            <?php
               }
            } else {
               echo '<p class="empty">no result found!</p>';
            }
         } else {
            echo '<p class="empty">search something!</p>';
         }
         ?>
        </div>


    </section>









    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>