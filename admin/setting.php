<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Setting</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
      <?php
      $query = "SELECT * FROM setting";
      $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
      if(mysqli_num_rows($runquery) > 0){
        while($row = mysqli_fetch_assoc($runquery)){
        ?>
        <!-- Form for show edit-->
        <form action="setting-core.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="exampleInputTile">Website Name</label>
                <input type="text" name="website_name"  class="form-control" id="exampleInputUsername" value="<?php echo $row['website_name']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Footer Info</label>
                <textarea name="footer_info" class="form-control"  required rows="5"><?php echo $row['footer_info']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Logo</label>
                <input type="file" name="logo">
                <img  src="images/<?php echo $row['logo']; ?>" height="100px">
                <input type="hidden" name="old-logo" value="<?php echo $row['logo']; ?>">
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
