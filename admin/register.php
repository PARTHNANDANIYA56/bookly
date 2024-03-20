<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, sha1($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, sha1($_POST['cpassword']));
   $user_type = $_POST['user_type'];
   $status = $_POST['status'];
   
   

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $_SESSION['status'] = "User already exist!";
      $_SESSION['status_code'] = "error";
  } else {
      if ($pass != $cpass) {

          $_SESSION['status'] = "confirm password not matched!";
          $_SESSION['status_code'] = "error";
      } else {
          mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, status) VALUES('$name', '$email', '$cpass', '$user_type','$status')") or die('query failed');
          $message[] = 'registered successfully!';
          $_SESSION['status'] = "Registered successfully!";
          $_SESSION['status_code'] = "success";
          header('location:login.php');
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>



    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

    <div class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" placeholder="enter your name" required class="box">
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="password" name="cpassword" placeholder="confirm your password" required class="box">

            <input type="text" name="user_type" value='admin' required class="box" readonly>

            <input type="hidden" name="status" value="1" />
            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>

    </div>

</body>

</html>