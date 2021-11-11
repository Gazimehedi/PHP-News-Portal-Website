<?php
include "config.php";
$id = $_GET['id'];
$cid = $_GET['cid'];
$query =  "SELECT * FROM post WHERE post_id = {$id}";
$runquery = mysqli_query($connect,$query) or die("Query Failed");
$row = mysqli_fetch_assoc($runquery);
unlink("upload/".$row['post_img']);
$query1 = "DELETE FROM post WHERE post_id = {$id};";
$query1 .= "UPDATE Category SET post = post - 1 WHERE category_id = {$cid}";
if(mysqli_multi_query($connect,$query1)){
  header("location: post.php");
}else{
  echo "query failed";
}
 ?>
