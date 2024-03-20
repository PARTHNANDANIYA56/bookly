<?php
include 'config.php';
$pid = 32;
$select_book = mysqli_query($conn, "SELECT * FROM `books` where `id` = $pid") or die('query failed');


if ($select_book) {

    $fetch_books = mysqli_fetch_assoc($select_book);
    
        // echo "./upload/book".$fetch_books['file'];
        

        echo "Number Of Pages ".$number;

}
?>
<section class="books">
      <h1 class="title">latest Books</h1>

      <div class="box-container">

         <?php
         $select_book = mysqli_query($conn, "SELECT * FROM `books` where `shows` = '1' LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_book)) {
         ?>

               <div class="box">
                  <div class="image">
                     <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                        <img class="img" src="./upload/cover/<?php echo $fetch_books['cover']; ?>" alt="">
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
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">load more</a>
      </div>

   </section>
