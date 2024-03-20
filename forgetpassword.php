<?php
include "config.php";
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();

$error = array();

require "mail.php";
$mode = "enter_email";
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

	switch ($mode) {
		case 'enter_email':
			// code...
			$email = $_POST['email'];
			//validate email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Please enter a valid email";
			} elseif (!valid_email($email)) {
				$error[] = "That email was not found";
			} else {

				$_SESSION['forgot']['email'] = $email;
				send_email($email);
				header("Location: forgetpassword.php?mode=enter_code");
				die;
			}
			break;

		case 'enter_code':

			$code = $_POST['code'];
			$result = is_code_correct($code);

			if ($result == "the code is correct") {

				$_SESSION['forgot']['code'] = $code;
				header("Location: forgetpassword.php?mode=enter_password");
				die;
			} else {
				$error[] = $result;
			}
			break;

		case 'enter_password':

			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			if (!empty($password) && !empty($password2)) {


				if ($password !== $password2) {
					$error[] = "Passwords do not match";
				} elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
					header("Location: forgetpassword.php");
					die;
				} else {

					save_password($password);
					if (isset($_SESSION['forgot'])) {
						unset($_SESSION['forgot']);
					}

					header("Location: login.php");
					die;
				}
				$error[] = "please enter password";
			}
			break;

		default:

			break;
	}
}

function send_email($email)
{

	global $conn;

	$expire = time() + (60 * 1);
	$code = rand(10000, 99999);
	$email = addslashes($email);

	$query = "INSERT into codes (`email`,`code`,`expire`) values('$email','$code','$expire')";
	mysqli_query($conn, $query);

	send_mail($email, 'Password reset', $code);
}

function save_password($password)
{

	global $conn;

	$password = sha1($password);
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "UPDATE users set `password` = '$password' where email = '$email' limit 1";
	mysqli_query($conn, $query);
}

function valid_email($email)
{
	global $conn;

	$email = addslashes($email);

	$query = "SELECT * from users where email = '$email' limit 1";
	$result = mysqli_query($conn, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
	}

	return false;
}

function is_code_correct($code)
{
	global $conn;

	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
	$result = mysqli_query($conn, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['expire'] > $expire) {

				return "the code is correct";
			} else {
				return "the code is expired";
			}
		} else {
			return "the code is incorrect";
		}
	}

	return "the code is incorrect";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta Tags -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">


	<!--	Title
	=========================================================-->
	<title>Bookly</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>


	<div id="page-wrapper">
		<div class="row">
			<!--	Header start  -->
			<!--	Header end  -->



			<!-- Forgot Password -->
			<?php

			switch ($mode) {
				case 'enter_email':

			?>
					
					<div class="form-container">

						<form action="" method="post" autocomplete="off">
							<h3>Forgot Password</h3>
							<span style="font-size: 12px;color:red;">
								<?php
								foreach ($error as $err) {

									echo $err . "<br>";
								}
								?>
							</span>
							<input type="email" name="email" placeholder="enter your email" required class="box">
							<input class="btn btn-info" type="submit" value="Next">
						</form>

					</div>
				<?php
					break;

				case 'enter_code':

				?>
					
					<div class="form-container">

						<form action="" method="post" autocomplete="off">
							<h3>Forgot Password</h3>
							<span style="font-size: 12px;color:red;">
								<p>Enter Code</p>
								<?php
								foreach ($error as $err) {

									echo $err . "<br>";
								}
								?>
							</span>
							<input type="text" name="code" placeholder="enter code" required class="box">
							<div>
								<a href="forgetpassword.php">
									<input class="btn btn-info" type="button" value="Start Over">
								</a>
								<input class="btn btn-info " type="submit" value="Next">
							</div>
							<!-- <input class="btn btn-info" type="submit" value="Next"> -->
						</form>

					</div>
				<?php
					break;

				case 'enter_password':

				?>
					
					<div class="form-container">

						<form action="" method="post" autocomplete="off">
							<h3>Forgot Password</h3>
							<span style="font-size: 12px;color:red;">
								<p>Enter Your New password</p>
								<?php
								foreach ($error as $err) {

									echo $err . "<br>";
								}
								?>
							</span>
							<input type="password" name="password" class="box" placeholder="Password">
							<input type="password" name="password2" class="box" placeholder="Retype Password">
							<div>
								<a href="forgetpassword.php">
									<input class="btn btn-info" type="button" value="Start Over">
								</a>
								<input class="btn btn-info " type="submit" value="Next">
							</div>
							<!-- <input class="btn btn-info" type="submit" value="Next"> -->
						</form>

					</div>
			<?php
					break;

				default:

					break;
			}

			?>
			<!--	Forgot Password  -->





		</div>
	</div>


	<!-- custom js file link  -->
	<script src="js/script.js"></script>

</body>

</html>