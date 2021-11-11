<?php
session_start();
include "config.php";
if(empty($_FILES['new-image']['name'])){
  $target = $_POST['old-image'];
}else{
  $error = array();
  $file_name = $_FILES['new-image']['name'];
  $file_size = $_FILES['new-image']['size'];
  $file_temp = $_FILES['new-image']['tmp_name'];
  $file_type = $_FILES['new-image']['type'];
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

$query = "UPDATE post SET title='{$_POST['post_title']}', description='{$_POST['postdesc']}', category='{$_POST['category']}', post_img='{$target}' WHERE post_id={$_POST['post_id']};";
if($_POST['category'] != $_POST['old-category']){
  $query .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old-category']};";
  $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']}";
}
if(mysqli_multi_query($connect,$query)){
  header("location: {$host}/admin/post.php");
}else{
  echo "Query Failed";
}
 ?>
