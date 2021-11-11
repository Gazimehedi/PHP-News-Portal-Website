<?php
session_start();
include "admin/config.php";
$url = $_SERVER['PHP_SELF'];
$page_name = basename($url);
switch ($page_name) {
  case 'author.php':
    $page_title = "Author Page";
    break;
  case 'author.php':
    $page_title = "Author Page";
    break;
  case 'author.php':
    $page_title = "Author Page";
    break;

  default:
    $page_title = "News Site";
    break;
}

$squery = "SELECT * FROM setting";
$srunquery = mysqli_query($connect,$squery) or die("Query Failed");
$srow = mysqli_fetch_assoc($srunquery);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $srow['logo']; ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                  <?php
                    $mquery = "SELECT * FROM category WHERE post > 0";
                    $mrunqurey = mysqli_query($connect,$mquery) or die("Query Failed");
                    if(mysqli_num_rows($mrunqurey) > 0){
                      while($mrow = mysqli_fetch_assoc($mrunqurey)){
                        echo "<li><a href='category.php?cid={$mrow['category_id']}'>{$mrow['category_name']}</a></li>";
                      }
                    }
                   ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
