<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `bookmark` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `bookmark` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `bookmark` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Bookly's bookmarks</h3>
   <p> <a href="home.php">home</a> / bookmark </p>
</div>

<section class="shopping-cart">


   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `bookmark` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <a href="product.php?pid=<?php echo $fetch_cart['pid']; ?>"><img src="./upload/cover/<?php echo $fetch_cart['image']; ?>" alt=""></a>
         <a href="product.php?pid=<?php echo $fetch_cart['pid']; ?>"><div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">Free</div></a>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
         </form>
      </div>
      <?php
      // $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Nothig is bookmarked</p>';
      }
      ?>
   </div>

  

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>