<?php
include "config.php";
session_start();
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
$id = $_GET['id'];
$query = "DELETE FROM users WHERE user_id = {$id}";
if(mysqli_query($connect,$query)){
  header("location: users.php");
}else{
  echo "query failed";
}
 ?>
