<?php
session_start();
include 'config.php';
$user_id = $_SESSION['user_id'];


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $_SESSION['status'] = "User already exist!";
        $_SESSION['status_code'] = "error";
    } else {
        if ($pass != $cpass) {

            $_SESSION['status'] = "Confirm Password not Matched!";
            $_SESSION['status_code'] = "error";
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            $_SESSION['status'] = "User Registeration successfully!";
            $_SESSION['status_code'] = "success";
        }
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
        <div class="container-fluid p-0" id="main-content">
            <h1 class="h3 mb-3"><strong>Users</strong> </h1>

            <div class="row">


                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-outline-dark mb-3 ms-3" data-bs-toggle="modal" data-bs-target="#user" style="width: 138px;">
                    Register User
                </button> -->

                <!-- Add user -->
                <div class="modal fade" id="user" tabindex="-1" aria-labelledby="adduser" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adduser">Register User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="enter your name" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="enter your email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter your password" required>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="user_type" required>
                                            <option value="user">user</option>
                                            <option value="admin">admin</option>
                                            <option value="author">author</option>
                                        </select>
                                    </div>
                                    <input type="submit" name="submit" value="Register now" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Category List -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row" id="example1">

                                <!-- book table start here -->
                                <table id="users" class="table table-bordered" style="width:100%">
                                    <thead class='table-dark'>
                                        <tr>
                                            <th>No.</th>
                                            <td>Name</td>
                                            <td>email</td>
                                            <td>Bookmark</td>
                                            <!-- <td>Password</td> -->
                                            <td>Role</td>
                                            <td>status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="" method="post">
                                            <?php
                                            $select_users = mysqli_query($conn, "SELECT * FROM `users` where user_type = 'user'") or die('query failed');
                                            if (mysqli_num_rows($select_users) > 0) {
                                                while ($fetch_user = mysqli_fetch_assoc($select_users)) {
                                                    $user_id = $fetch_user['id'];
                                                    $result = mysqli_query($conn, "SELECT * FROM `bookmark` where user_id=$user_id");
                                                    $bookmark = mysqli_num_rows($result);
                                            ?>

                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $fetch_user['name'] ?></td>
                                                        <td><?php echo $fetch_user['email'] ?></td>
                                                        <td><?php echo $bookmark ?></td>
                                                        <!-- <td><?php echo $fetch_user['password'] ?></td> -->
                                                        <td><?php echo $fetch_user['user_type'] ?></td>
                                                        <td>

                                                            <div class="form-check form-switch justify-content-center align-items-center d-flex">
                                                                <?php
                                                                // echo $fetch_books['shows'];  
                                                                ?>
                                                                <input class="form-check-input" type="checkbox" name="shows" id="shows" value=<?php echo '"' . $fetch_user['status'] . '"';
                                                                                                                                                if ($fetch_user['status'] == "1") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?> onclick="useractivate(<?php echo $fetch_user['id']; ?>)">

                                                                <!-- <input class="form-check-input" type="checkbox" name="shows" id="shows" value="0" > -->
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <!-- edit button start here -->
                                                                <!-- <a href="update_user.php?uid=<?php echo $fetch_user['id'] ?>">
                                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="user(<?php echo $fetch_user['id'] ?>)">
                                                                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                                    </button>
                                                                </a> -->
                                                                <!-- delete button start here -->
                                                                <button class="btn btn-danger confirm_btn" onclick="deleteUser(<?php echo $fetch_user['id']; ?>)"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo '<p class="empty">no products added yet!</p>';
                                            }
                                            ?>






                                        </form>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
    </main>


    <?php

    include('includes/scripts.php');
    if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
        echo  '<script>
        swal({
        title: "' . $_SESSION['status'] . '",
        icon: "' . $_SESSION['status_code'] . '",
        button: "Ok",
        })
        </script>';
        unset($_SESSION['status']);
    }
    include('includes/footer.php') ?>