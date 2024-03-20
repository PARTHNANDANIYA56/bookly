<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

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
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <title>about</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">home</a> / about </p>
    </div>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>About bookly</h3>
                <p>Bookly is an online platfrom the provide an extensive library of books in digital format for free to
                    every one around the world.</p>
                <p>with Bookly you have access to all kind of educational, motivation and career book to keep you going
                    in any areas.</p>
                <p>Over this years, we are still going strong in our mission to provide a valuable service to readers.
                    Bookly has grown into a platform where self-publishing authors have the opportunity to introduce
                    their work to our community.</p>
                <p>if you have any questions or feedback, don't hesitate to contact our editor info.bookly1512@gmail.com
                </p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

        </div>

    </section>
    <!-- 
<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Great selection of ebooks! I found exactly what I was looking for and was able to download it quickly and easily. Highly recommend!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>The website is easy to navigate and I appreciate the variety of genres available. The prices are also very reasonable.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lilly</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>I had a problem with my download and contacted customer service. They were quick to respond and helped me resolve the issue right away. Very satisfied with the service.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Han jue</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Love this ebook website! </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Anjali Maheta</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>The ebooks are high quality and the site is always up-to-date with new releases.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nikhil Shah</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>The selection of free ebooks is great and it's a good resource for finding new authors and titles to read.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sneha</h3>
      </div>

   </div>

</section> -->
    <!-- 
<section class="authors">

   <h1 class="title">greate authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>john deo</h3>
      </div>

   </div>

</section>
 -->






    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>