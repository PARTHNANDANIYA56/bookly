<?php
session_start();
include 'config.php';

$uid = $_GET['uid'];

if (isset($_POST['update_Category'])) {
    $category = $_POST['ucategory'];
    $q = "UPDATE `category` SET `category`='$category' WHERE `id`= $uid";

    $run = mysqli_query($conn, $q) or die('query failed');

    if ($run) {
        $_SESSION['category_status'] = "Category Updated Successfully";
        $_SESSION['category_status_code'] = "success";
        header('location:add_category.php');
    } else {
        $_SESSION['category_status'] = "Category not Updated";
        $_SESSION['category_status_code'] = "error";
        header('location:add_category.php');
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
    <script></script>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Update Category</strong> </h1>
            <form method="POST" action="">
                <?php
                $select_category = mysqli_query($conn, "SELECT * FROM `category` where `id`= $uid") or die('query failed');
                if (mysqli_num_rows($select_category) > 0) {
                    while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                ?>
                        <div class="mb-3">
                            <label for="upadteCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="upadteCategory" name="ucategory" value="<?php echo $fetch_category['category'] ?>">
                        </div>
                        <button type="submit" name="update_Category" class="btn btn-primary" name="add_category">Update</button>
                <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>
            </form>
            <div class="row">

            </div>
    </main>


    <?php include('includes/scripts.php');

    include('includes/footer.php') ?>