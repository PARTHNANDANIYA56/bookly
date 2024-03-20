<?php

include 'config.php';
session_start();

$email = $_SESSION['user_email'];

if (isset($_POST['submit'])) {
   $oldpass =  sha1($_POST['old_password']);
   $newpass =  sha1($_POST['new_password']);
   $cpass =  sha1($_POST['new_cpassword']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $row = mysqli_fetch_assoc($select_users);
      if ($row['password'] === $oldpass) {
         if ($newpass == $cpass) {
            mysqli_query($conn, "UPDATE `users` SET `password`='$cpass' WHERE email = '$email'") or die('query failed');
            header('location:login.php');
            $message[] = 'Change Password Successfully!';
         } else {
            $message[] = 'The New Password and Confirm New Password Do not Match';
         }
      } else {
         $message[] = 'Old Password is Incorrect';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <div class="form-container">

      <form action="" method="post">
         <h3>Change Password</h3>
         <input type="password" name="old_password" placeholder="Enter your Old password" required class="box">
         <input type="password" name="new_password" placeholder="Enter your New password" class="box" required>
         <input type="password" name="new_cpassword" placeholder="Confirm your New password" class="box" required>
         <input type="submit" name="submit" value="Change Password" class="btn">
         <p><a href="forgetpassword.php">Forget Password ?</a></p>

      </form>

   </div>

</body>

</html>