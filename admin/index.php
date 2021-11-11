<?php
session_start();
include "config.php";
if(isset($_SESSION['user'])){
  header("location: {$host}/admin/post.php");
}
$squery = "SELECT * FROM setting";
$srunquery = mysqli_query($connect,$squery) or die("Query Failed");
$srow = mysqli_fetch_assoc($srunquery);
 ?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/<?php echo $srow['logo']; ?>">
                        <h3 class="heading">Admin</h3>

                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        include "config.php";
                        if(isset($_POST['login'])){
                          $username = mysqli_real_escape_string($connect,$_POST['username']);
                          $password = mysqli_real_escape_string($connect, md5($_POST['password']));
                          if(empty($_POST['username']) && empty($_POST['password'])){
                            echo "<p class='alert alert-danger'>Username and Password is required</p>";
                          }else{
                            echo $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
                            $runquery = mysqli_query($connect,$query) or die("Query Failed");
                            echo md5('user');
                            if(mysqli_num_rows($runquery) > 0){
                              while($row = mysqli_fetch_assoc($runquery)){
                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['user'] = $row['username'];
                                $_SESSION['role'] = $row['role'];
                                header("location: {$host}/admin/post.php");
                              }
                            }else{
                              echo "<p class='alert alert-danger'>Username and password don't macth</p>";
                            }
                          }
                        }
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
