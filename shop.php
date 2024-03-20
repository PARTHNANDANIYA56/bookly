<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <title>Books</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>our Books</h3>
        <p> <a href="home.php">home</a> / books </p>
    </div>

    <section class="spec-books">
        <div class="spec-heading title">Books</div>
        <div class="spec-container" style="flex-wrap: wrap;">
            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `books` where `shows` = '1'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_books = mysqli_fetch_assoc($select_book)) {
            ?>
            <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                <div class="content">
                    <div class="spec-imag">
                        <img class="" src="./upload/cover/<?php echo $fetch_books['cover']; ?>" alt="">
                    </div>
                    <div class="spec-text"><?php echo $fetch_books['title']; ?></div>
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