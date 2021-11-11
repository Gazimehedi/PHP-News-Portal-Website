<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
      if(isset($_GET['id'])){
        $user_id = $_GET['id'];
      }
      if(isset($_POST['update'])){
        $fname = mysqli_real_escape_string($connect,$_POST['f_name']);
        $lname = mysqli_real_escape_string($connect,$_POST['l_name']);
        $username = mysqli_real_escape_string($connect,$_POST['username']);
        $role = mysqli_real_escape_string($connect,$_POST['role']);
          $query = "UPDATE users SET first_name='{$fname}',last_name='{$lname}',username='{$username}',role={$role} WHERE user_id = {$user_id}";
          if(mysqli_query($connect,$query)){
            header("location: {$host}/admin/users.php");
          }else{
            die("query failed". mysqli_error());
          }
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  $query1 = "SELECT * FROM users WHERE user_id = {$user_id}";
                  $runquery1 = mysqli_query($connect,$query1) or die("Query Failed". mysqli_error());
                  if(mysqli_num_rows($runquery1) > 0){
                    while($row = mysqli_fetch_assoc($runquery1)){
                  ?>
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <?php
                            if($row['role'] == 1){
                              echo '<option value="0">User</option>
                                    <option value="1" selected>Admin</option>';
                            }else{
                              echo '<option value="0" selected>User</option>
                                    <option value="1">Admin</option>';
                            }
                             ?>
                          </select>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                }
              }
                   ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
