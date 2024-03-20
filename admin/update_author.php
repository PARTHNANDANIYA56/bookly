<?php
session_start();
include 'config.php';


$uid = $_GET['uid'];
if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $run = mysqli_query($conn, "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$pass',`user_type`='$user_type' where `id` = $uid") or die('query failed');

    if($run)
    {
        $_SESSION['status']= "Data Successfully Updated";
        $_SESSION['status_code'] ="success";
        header('location:users.php');
    }
    else
    {
        echo 'alert("Data not Updated")';
        $_SESSION['status']= "Data not updated";
        $_SESSION['status_code'] ="error";
        header('location:users.php');
    }
    
}



include('includes/header.php');
include('includes/navbar.php');
?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">

                <li class="nav-item d-flex justify-content-center align-items-center">
                    <div class="text-dark">Hii, <?php echo $_SESSION['admin_name'] . " "; ?></div>
                    <a class="nav-link" href="../logout.php">
                        <button type="button" class="btn btn-outline-dark">
                            Log out
                        </button>
                    </a>

                </li>

            </ul>
        </div>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Update author</strong> </h1>

            <div class="row">




                <!-- User List -->
                <div class="row">
                    <form action="" method="post">
                        <?php 
                         $select_user = mysqli_query($conn, "SELECT * FROM `users` where `id` = $uid") or die('query failed');
                         if (mysqli_num_rows($select_user) > 0) {
                             while ($fetch_user = mysqli_fetch_assoc($select_user)) {
                        ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="enter your name" id="name" value="<?php echo $fetch_user['name']?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="enter your email" value="<?php echo $fetch_user['email']?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?php echo $fetch_user['password']?>">
                            </div>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter your password" value="<?php echo $fetch_user['password']?>">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="user_type">
                                    <option value="user" <?=$fetch_user['user_type'] == 'user' ? ' selected="selected"' : ''; ?>>user</option>
                                    <option value="admin" <?=$fetch_user['user_type'] == 'admin' ? ' selected="selected"' : '';?>>admin</option>
                                    <option value="author" <?=$fetch_user['user_type'] == 'author' ? ' selected="selected"' : '';?>>author</option>
                                </select>
                            </div>
                            <input type="submit" name="update" value="Update" class="update btn btn-primary">
                        </div>
                        <?php }}?>
                    </form>
                </div>

            </div>
    </main>


    <?php include('includes/scripts.php');

    include('includes/footer.php') ?>