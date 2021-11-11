<?php
session_start();
include "config.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
$id = $_GET['cid'];
$query = "DELETE FROM category WHERE category_id = {$id}";
if(mysqli_query($connect,$query)){
  header("location: {$host}/admin/category.php");
}else{
  echo "query failed";
}
 ?>
