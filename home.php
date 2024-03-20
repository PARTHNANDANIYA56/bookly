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
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="plugin/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="plugin/assets/owlcarousel/assets/owl.theme.default.min.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="home">

        <div class="content">
            <h3>Welcome to Bookly</h3>
            <p>Welcome to our ebook site! We are thrilled to have you here and offer you access to a vast collection of
                digital books that cover various genres and topics.</p>
            <a href="about.php" class="white-btn">discover more</a>
        </div>

    </section>
    <!-- <CATEGORY SECTION!-- -->
    <section class="category-section">
        <div class="category-heading title">Category</div>
        <div class="category-container spec-container owl-carousel owl-theme">
            <div class="category-content">
                <a href="category_wise.php?ct=Mystery">
                    <img src="https://www.handleyregional.org/sites/default/files/inline-images/pexels-wallace-chuck-3109168_0.jpg"
                        alt="category_image">
                    <div class="category-text">Mystery</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=Fiction">
                    <img src="https://c4.wallpaperflare.com/wallpaper/439/852/914/little-prince-universe-science-fiction-fantasy-art-wallpaper-preview.jpg"
                        alt="category_image">
                    <div class="category-text">Fiction</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=History">
                    <img src="https://wallpapercave.com/wp/wp3255759.jpg" alt="category_image">
                    <div class="category-text">History</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=Travel">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80"
                        alt="category_image">
                    <div class="category-text">Travel</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=Biography">
                    <img src="https://thehouseofelements.com/cdn/shop/products/il_fullxfull.4232749309_db0b_5bc71503-4367-4403-9a5c-e01dcee3d70a_1500x.jpg?v=1692198667"
                        alt="category_image">
                    <div class="category-text">Biography</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=Business">
                    <img src="https://www.ingramspark.com/hubfs/Book-Cover-Design-Pillar/15.png" alt="category_image">
                    <div class="category-text">Business</div>
                </a>
            </div>
            <div class="category-content">
                <a href="category_wise.php?ct=Horror">
                    <img src="https://res.cloudinary.com/upwork-cloud/image/upload/c_scale,w_400/v1708002023/catalog/1503180465599033344/ic23ezxv0n1oxo04gmew.webp"
                        alt="category_image">
                    <div class="category-text">Horror</div>
                </a>
            </div>
        </div>
    </section>

    <!-- <section class="spec-books">
      <div class="spec-heading title">Mystery</div>
      <div class="spec-container owl-carousel owl-theme">
         <?php
         $select_book = mysqli_query($conn, "SELECT b.*,c.* FROM `books` b, `category` c WHERE b.shows = '1' and c.id = b.category_id AND c.category LIKE 'Mystery'") or die('query failed');
         if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
         ?>
               <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                  <div class="content item">
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
   <section class="spec-books">
      <div class="spec-heading title">Travel</div>
      <div class="spec-container owl-carousel owl-theme">
         <?php
         $select_book = mysqli_query($conn, "SELECT b.*,c.* FROM `books` b, `category` c WHERE b.shows = '1' and c.id = b.category_id AND c.category LIKE 'Travel'") or die('query failed');
         if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
         ?>
               <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                  <div class="content item">
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
   </section> -->
    <section class="spec-books">
        <div class="spec-heading title">latest Books</div>
        <div class="spec-container owl-carousel owl-theme">
            <?php
         $select_book = mysqli_query($conn, "SELECT * FROM `books` where `shows` = '1'") or die('query failed');
         if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
         ?>
            <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                <div class="content item">
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




    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <!-- <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p> -->
            <a href="contact.php" class="white-btn">contact us</a>
        </div>

    </section>





    <?php include 'footer.php'; ?>
    <script src="plugin/assets/vendors/jquery.min.js"></script>
    <script src="plugin/assets/owlcarousel/owl.carousel.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>