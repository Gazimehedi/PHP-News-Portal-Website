<?php
include "header.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                <?php
                $limit = 5;
                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                }else{
                  $page = 1;
                }
                $offset = ($page - 1) * $limit;
                if($_SESSION['role'] == 1){
                  $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, category.category_id, category.category_name, users.username, users.role FROM post
                  LEFT JOIN category ON post.category = category.category_id
                  LEFT JOIN users ON post.author = users.user_id
                  ORDER BY post_id DESC limit {$offset},{$limit}";
                }else{
                  $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, category.category_id, category.category_name, users.username, users.role FROM post
                  LEFT JOIN category ON post.category = category.category_id
                  LEFT JOIN users ON post.author = users.user_id
                  WHERE post.author = {$_SESSION['user_id']}
                  ORDER BY post_id DESC limit {$offset},{$limit}";
                }
                $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
                if(mysqli_num_rows($runquery) > 0){
                  ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                          $sl = $offset + 1;
                          while($row = mysqli_fetch_assoc($runquery)){

                         ?>
                          <tr>
                              <td class='id'><?php echo $sl; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php if($row['role'] == 1){
                                echo "Admin";
                              }else{
                                echo "User";
                              }
                              ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a onclick="return confirm('Are you sure?')" href='delete-post.php?id=<?php echo $row['post_id']; ?>&cid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                          $sl++;
                        }
                           ?>
                      </tbody>
                  </table>
                  <?php
                }
                if($_SESSION['role'] == 1){
                  $query1 = "SELECT * FROM post";
                }else{
                  $query1 = "SELECT * FROM post WHERE post.author = {$_SESSION['user_id']}";
                }

                  $runquery1 = mysqli_query($connect,$query1) or die("Query Failed".mysqli_error());
                  if(mysqli_num_rows($runquery1) > 0){
                    $total_data = mysqli_num_rows($runquery1);
                    $total_page = ceil($total_data / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                      echo "<li><a href='post.php?page=".($page - 1)."' >Prev</a></li>";
                    }
                    for($i = 1;$i <= $total_page;$i++){
                      if($i == $page){
                        $active = "active";
                      }else{
                        $active = "";
                      }
                      echo "<li class='{$active}'><a href='post.php?page={$i}' >{$i}</a></li>";
                    }
                    if($page < $total_page){
                      echo "<li><a href='post.php?page=".($page + 1)."' >Next</a></li>";
                    }
                    echo "</ul>";
                  }
                   ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
