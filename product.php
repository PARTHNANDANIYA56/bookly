<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
$pid = $_GET['pid'];


if (isset($_POST['add_to_cart'])) {

    $book_name = $_POST['book_name'];
    $book_price = "free";
    $book_image = $_POST['book_image'];

    if ($user_id == "") {
        header('location:login.php');
    } else {
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `bookmark` WHERE name = '$book_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_cart_numbers) > 0) {
            // $message[] = 'already added to cart!';
            $_SESSION['cartMsg'] = "already Bookmarked";
            $_SESSION['cartMsg_code'] = "info";
        } else {
            mysqli_query($conn, "INSERT INTO `bookmark`(`user_id`, `name`, `price`,`image`,`pid`) VALUES('$user_id', '$book_name', '$book_price','$book_image','$pid')") or die('query failed');
            $message[] = 'Book added to cart!';
            $_SESSION['cartMsg'] = "Book added to Bookmark!";
            $_SESSION['cartMsg_code'] = "success";
        }
    }
}


$mydate = getdate(date('U'));
$date = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";

$sqlr = $conn->query("SELECT id FROM rate where `pid`='$pid'");
$numR = $sqlr->num_rows;


$sqlr = $conn->query("SELECT SUM(userReview) AS total FROM rate where `pid`='$pid'");
$rData = $sqlr->fetch_array();
$total = $rData['total'];

$avg = '';
if ($numR != 0) {
    if (is_nan(round(($total / $numR), 1))) {
        $avg = 0;
    } else {
        $avg = round(($total / $numR), 1);
    }
} else {
    $avg = 0;
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
    <link rel="stylesheet" href="css/rate.css">
    <link rel="stylesheet" href="js/fontawesome/css/all.css">
    <script src="js/jquery/jquery.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="product">
        <?php
        $select_book = mysqli_query($conn, "SELECT * FROM `books` where `id` = $pid") or die('query failed');


        if (mysqli_num_rows($select_book) > 0) {

            while ($fetch_books = mysqli_fetch_assoc($select_book)) {


                $pdf = file_get_contents("upload/book/" . $fetch_books['file']);
                $number = preg_match_all("/\/Page\W/", $pdf, $dummy);



        ?>
        <div class="book-container">
            <div class="book-cover">
                <img class="" src="./upload/cover/<?php echo $fetch_books['cover']; ?>" alt="">
            </div>
            <div class="book-details">
                <h1 class="book-title"><?php echo $fetch_books['title']; ?></h1>

                <h2 class="book-author">Written By <?php echo $fetch_books['author']; ?></h2>
                <p class="book-description"><?php echo $fetch_books['description']; ?></p>
                <ul class="book-metadata">
                    <li><strong>Format:</strong> PDF</li>

                    <li><strong>Pages:</strong> <?php echo $number; ?></li>

                    <?php
                            $cid = $fetch_books['category_id'];
                            $select_category = mysqli_query($conn, "SELECT * FROM `category` where `id` = $cid") or die('query failed');

                            if (mysqli_num_rows($select_category) > 0) {
                                while ($fetch_category = mysqli_fetch_assoc($select_category)) {
                            ?>
                    <li><strong>Category:</strong> <?php echo $fetch_category['category']; ?></li>
                    <?php
                                }
                            }
                            ?>
                    <li><strong>ISBN:</strong> <?php echo $fetch_books['isbn']; ?></li>
                    <li><strong>Publisher:</strong> <?php echo $fetch_books['publisher']; ?></li>
                    <!-- <li><strong>Views:</strong> <?php echo $fetch_books['views']; ?></li> -->
                    <!-- <li><strong>Publication Date:</strong> January 1, 2023</li> -->
                    <!-- <li><strong>Pages:</strong> 200</li> -->
                </ul>
                <div class="book-price">
                    <form action="" method="post">
                        <span>
                            <button class="btn btn-primary" name="read">
                                <a href="view.php?id=<?php echo $pid ?>&file=<?php echo $fetch_books['file']; ?>"
                                    class="text-light" target="_blank">
                                    Read
                                </a>
                            </button>
                        </span>
                        <button class="btn btn-primary">
                            <a href=<?php
                                                if (!isset($user_id)) {
                                                    // header('location:login.php');
                                                    echo 'login.php';
                                                } else {
                                                    echo '"./upload/book/' . $fetch_books['file'].'"';
                                                    echo "Download";
                                                }
                                                ?> target="_blank" name="download">
                                Download
                            </a>
                        </button>
                        <input type="hidden" name="book_image" value="<?php echo $fetch_books['cover']; ?>">
                        <input type="hidden" name="book_name" value="<?php echo $fetch_books['title']; ?>">
                        <button class="btn btn-primary" name="add_to_cart">Bookmark</button>
                    </form>

                </div>

            </div>
        </div>
        <?php
            }
        } else {
            echo '';
        }
        ?>
    </section>

    <section class="rating-review" id="ratingSection">
        <div class="tri table-flex">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="rnb rvl">
                                <h3><?php echo $avg; ?>/5.0</h3>
                            </div>
                            <div class="pdt-rate">
                                <div class="pro-rating">
                                    <div class="clearfix rating marT8 ">
                                        <div class="rating-stars ">
                                            <div class="grey-stars"></div>
                                            <div class="filled-stars" style="width:<?php echo ($avg * 20) ?>%"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rnrn">
                                <p class="rars"> <?php if ($numR == 0) {
                                                        echo "No";
                                                    } else {
                                                        echo $numR;
                                                    }; ?> Reviews</p>
                            </div>
                        </td>



                        <?php

                        if (isset($user_id)) {
                            echo '<td><div class="rrb">
<p>Give Review about Book</p>
<button class="rbtn opmd">Review</button>
</div></td>';
                        }
                        ?>


                    </tr>

                </tbody>
            </table>
            <div class="review-modal" style="display:none">
                <div class="review-bg"></div>
                <div class="rmp">

                    <div class="rpc">
                        <span><i class="far fa-times"></i></span>
                    </div>
                    <div class="rps" align="center">
                        <i class="fa fa-star" data-index="0" style="display:none"></i>
                        <i class="fa fa-star" data-index="1"></i>
                        <i class="fa fa-star" data-index="2"></i>
                        <i class="fa fa-star" data-index="3"></i>
                        <i class="fa fa-star" data-index="4"></i>
                        <i class="fa fa-star" data-index="5"></i>
                    </div>
                    <input type="hidden" value="" class="starRateV">
                    <input type="hidden" value="<?php echo $date ?>" class="rateDate">

                    <div class="rptf" align="center">
                        <input type="text" class="raterName" value="<?php echo $_SESSION['user_name'] ?>" disabled>
                    </div>

                    <div class="rptf" align="center">
                        <textarea name="rate-field" id="rate-field" class="rateMsg"
                            placeholder="Describe Your Experience (optional)"></textarea>
                    </div>
                    <div class="rate-error" align="center"></div>
                    <div class="rpsb" align="center">
                        <button class="rpbtn">Add Review</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="bri">
            <div class="uscm">
                <?php
                $sqlp = "SELECT * FROM rate where `pid`='$pid'";
                $resultp = $conn->query($sqlp);
                if (mysqli_num_rows($resultp) > 0) {
                    while ($row = $resultp->fetch_assoc()) {
                ?>
                <div class="uscm-secs">
                    <div class="us-img">
                        <p><?= substr($row['userName'], 0, 1); ?></p>
                    </div>
                    <div class="uscms">
                        <div class="us-rate">
                            <div class="pdt-rate">
                                <div class="pro-rating">
                                    <div class="clearfix rating marT8 ">
                                        <div class="rating-stars ">
                                            <div class="grey-stars"></div>
                                            <div class="filled-stars" style="width:<?= $row['userReview'] * 20 ?>%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="us-cmt">
                            <p><?= $row['userMessage'] ?></p>
                        </div>
                        <div class="us-nm">
                            <p><i> By <span class="cmnm"><?= $row['userName'] ?></span> on <span
                                        class="cmdt"><?= $row['dateReviewed'] ?></span> </i></p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }

                ?>


            </div>
        </div>
    </section>
    <section class="spec-books">
        <div class="spec-heading title">Latest Books</div>
        <div class="spec-container" style="flex-wrap: wrap;">
            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `books` where `shows` = '1' LIMIT 4") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_books = mysqli_fetch_assoc($select_book)) {
            ?>
            <a href="product.php?pid=<?php echo $fetch_books['id']; ?>" rel="noopener noreferrer">
                <div class="content">
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



    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script src="js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php

    if (isset($_SESSION['cartMsg']) && $_SESSION['cartMsg'] != "") {
        echo  '<script>
swal({
title: "' . $_SESSION['cartMsg'] . '",
icon: "' . $_SESSION['cartMsg_code'] . '",
button: "Ok",
})
</script>';
        unset($_SESSION['cartMsg']);
    }


    ?>

</body>

</html>