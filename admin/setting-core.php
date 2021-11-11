<?php
include "config.php";
session_start();
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
if(empty($_FILES['logo']['name'])){
  $file_name = $_POST['old-logo'];
}else{
  $error = array();
  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_temp = $_FILES['logo']['tmp_name'];
  $file_type = $_FILES['logo']['type'];
  $file_exp = explode('.', $file_name);
  $file_ext = strtolower(end($file_exp));
  $extentions = array('jpg','png','jpeg');
  if(in_array($file_ext,$extentions) == false){
    $error[] = "This file not supported. please upload jpg or png file";
  }
  if($file_size > 2097152){
    $error[] = "File size minimum 2mb lower";
  }
  if(empty($error)){
    move_uploaded_file($file_temp,"images/".$file_name);
  }else{
    print_r($error);
  }
}

$query = "UPDATE setting SET website_name='{$_POST['website_name']}', logo='{$file_name}', footer_info='{$_POST['footer_info']}'";
if(mysqli_multi_query($connect,$query)){
  header("location: {$host}/admin/setting.php");
}else{
  echo "Query Failed";
}
 ?>
