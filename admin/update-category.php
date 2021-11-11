<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
      if(isset($_GET['cid'])){
        $cat_id = $_GET['cid'];
      }
      if(isset($_POST['update'])){
          $cat_name = mysqli_real_escape_string($connect,$_POST['cat_name']);
          $query = "UPDATE category SET category_name='{$cat_name}' WHERE category_id = {$cat_id}";
          if(mysqli_query($connect,$query)){
            header("location: {$host}/admin/category.php");
          }else{
            die("query failed". mysqli_error());
          }
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                $query1 = "SELECT * FROM category WHERE category_id = {$cat_id}";
                $runquery1 = mysqli_query($connect,$query1) or die("Query Failed". mysqli_error());
                if(mysqli_num_rows($runquery1) > 0){
                  while($row = mysqli_fetch_assoc($runquery1)){
                ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                }
              }
                   ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
