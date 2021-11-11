<?php include "header.php";
$id = $_GET['id'];
$query2 = "SELECT * FROM post WHERE post_id = {$id}";
$runquery2 = mysqli_query($connect,$query2) or die("Query Failed");
$row2 = mysqli_fetch_assoc($runquery2);
if($row2['author'] != $_SESSION['user_id']){
  header("location: {$host}/admin/post.php");
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
      <?php
      $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, category.category_id, category.category_name, users.username FROM post
      LEFT JOIN category ON post.category = category.category_id
      LEFT JOIN users ON post.author = users.user_id
      WHERE post_id = {$id}";
      $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
      if(mysqli_num_rows($runquery) > 0){
        while($row = mysqli_fetch_assoc($runquery)){
        ?>
        <!-- Form for show edit-->
        <form action="update-post-core.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <?php
                  $query1 = "SELECT * FROM category";
                  $runquery1 = mysqli_query($connect,$query1) or die("Query Failed");
                  if(mysqli_num_rows($runquery1) > 0){
                    while($row1 = mysqli_fetch_assoc($runquery1)){
                      if($row['category'] == $row1['category_id']){
                        $selected = "selected";
                      }else{
                        $selected = "";
                      }
                      echo "<option value='{$row1['category_id']}' $selected>{$row1['category_name']}</option>";
                    }
                  }
                   ?>
                </select>
                <input type="hidden" name="old-category" value="<?php echo $row['category']; ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
      }
    }
         ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
