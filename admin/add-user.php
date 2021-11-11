<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
      if(isset($_POST['save'])){
        $fname = mysqli_real_escape_string($connect,$_POST['fname']);
        $lname = mysqli_real_escape_string($connect,$_POST['lname']);
        $username = mysqli_real_escape_string($connect,$_POST['user']);
        $password = mysqli_real_escape_string($connect,md5($_POST['password']));
        $role = mysqli_real_escape_string($connect,$_POST['role']);
        $query = "SELECT username FROM users WHERE username = '{$username}'";
        $runquery = mysqli_query($connect,$query) or die("Query Failed");
        if(mysqli_num_rows($runquery) > 0){
          echo "<p class='alert alert-danger text-center' >Username allready taken</p>";
        }else{
          $query1 = "INSERT INTO users (first_name,last_name,username,password,role) VALUES('{$fname}','{$lname}','{$username}','{$password}','{$role}')";
          if(mysqli_query($connect,$query1)){
            header("location: {$host}/admin/users.php");
          }else{
            die("query failed". mysqli_error());
          }
        }
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
