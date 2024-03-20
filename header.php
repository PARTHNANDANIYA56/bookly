<header class="header">

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">
            <img class="logo-image" src="images/logo.png" alt="">
         </a>

         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Books</a>
            <a href="contact.php">Contact</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php

            $select_cart_number = mysqli_query($conn, "SELECT * FROM `bookmark` WHERE `user_id` = '$user_id'") or die('query failed');
            $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <!-- <i class="fa-solid fa-bookmark" style="color: #ffffff;"></i> -->
            <a href="cart.php"> <i class="fa-solid fa-bookmark"></i></i></i> </a>
         </div>

         <div class="user-box">
            <?php if (isset($user_id)) {

            ?>
               <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>

               <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
               <?php
               if ($_SESSION['user_type'] == 'author') {

                  echo '<a href="./author/index.php"><button class="btn">Author Panel</button></a>';
               } elseif ($_SESSION['user_type'] == 'admin') {

                  echo '<a href="./admin/index.php"><button class="btn">Admin Panel</button></a>';
               } else {
               }
               ?>
               <p>
                  <a href="changepassword.php" class="changePassword">Change Password</a>
               </p>
               <a href="logout.php" class="delete-btn m-2">logout</a>
            <?php
            } else { ?>
               <p><a href="login.php">Login</a> | <a href="register.php">Register</a> </p>
            <?php } ?>
         </div>
      </div>
   </div>

</header>