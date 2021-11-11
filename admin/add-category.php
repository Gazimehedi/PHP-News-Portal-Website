<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                if(isset($_POST['save'])){
                  $cat_name = $_POST['cat'];
                  $query = "SELECT category_name FROM category WHERE category_name='{$cat_name}'";
                  $runquery = mysqli_query($connect,$query) or die("Query Failed");
                  if(mysqli_num_rows($runquery) > 0){
                    echo "<p class='alert alert-danger' >Category already taken</p>";
                  }else{
                  $query1 = "INSERT INTO category (category_name) VALUES('{$cat_name}')";
                  if(mysqli_query($connect,$query1)){
                    header("location: {$host}/admin/category.php");
                  }
                }
                }
                 ?>
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
