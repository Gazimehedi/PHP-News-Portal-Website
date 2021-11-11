<?php
session_start();
include "config.php";
if(isset($_FILES['fileToUpload'])){
  $error = array();
  $file_name = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_temp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_exp = explode('.', $file_name);
  $file_ext = strtolower(end($file_exp));
  $extentions = array('jpg','png','jpeg');
  if(in_array($file_ext,$extentions) == false){
    $error[] = "This file not supported. please upload jpg or png file";
  }
  if($file_size > 2097152){
    $error[] = "File size minimum 2mb lower";
  }
  $time = time();
  $target = $time."-".$file_name;
  if(empty($error)){
    move_uploaded_file($file_temp,"upload/".$target);
  }else{
    print_r($error);
  }
}
$title = mysqli_real_escape_string($connect, $_POST['post_title']);
$description = mysqli_real_escape_string($connect, $_POST['postdesc']);
$category = mysqli_real_escape_string($connect, $_POST['category']);
$post_date = date("d M, Y");
$author = $_SESSION['user_id'];

$query = "INSERT INTO post (title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}','{$category}','{$post_date}','{$author}','{$target}');";
$query .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";
if(mysqli_multi_query($connect,$query)){
  header("location: {$host}/admin/post.php");
}else{
  echo "Query Failed".mysqli_error($connect);
}
 ?>
