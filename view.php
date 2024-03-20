<?





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Bookly</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- Flipbook StyleSheet -->
  <link href="./plugin/dflip/css/dflip.min.css" rel="stylesheet" type="text/css">

  <!-- Icons Stylesheet -->
  <link href="./plugin/dflip/css/themify-icons.min.css" rel="stylesheet" type="text/css">
  <!-- bootstrap js file -->

</head>

<body>
  <div class="container">



    <div class="row">
      <div class="col-xs-12" style="padding-bottom:30px;">
        <!--Normal FLipbook-->

        <div class="_df_book" bg="red" height="800" webgl="true" source=<?php
                                                                include 'config.php';
                                                              //   if(!isset($user_id)){
                                                              //     header('location:login.php');
                                                              //  }
                                                                $file = $_GET['file'];
                                                                echo '"./upload/book/' . $file . '"';

                                                                ?> id="df_manual_book">
        </div>

      </div>
    </div>
  </div>

  <!-- jQuery  -->
  <script src="./plugin/dflip/js/libs/jquery.min.js" type="text/javascript"></script>
  <!-- Flipbook main Js file -->
  <script src="./plugin/dflip/js/dflip.min.js" type="text/javascript"></script>
  <script>
    var book_option = {
      stiffness: 3
    };
  </script>

</body>

</html>