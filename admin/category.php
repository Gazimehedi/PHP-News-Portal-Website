<?php include "header.php";
if($_SESSION['role'] == 0){
  header("location: {$host}/admin/post.php");
}
 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php
                      $limit = 5;
                      if(isset($_GET['page'])){
                        $page = $_GET['page'];
                      }else{
                        $page = 1;
                      }
                      $offset = ($page - 1) * $limit;
                      $query = "SELECT * FROM category limit {$offset},{$limit}";
                      $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
                      if(mysqli_num_rows($runquery) > 0){
                        $sl = $offset + 1;
                        while($row = mysqli_fetch_assoc($runquery)){
                       ?>
                        <tr>
                            <td class='id'><?php echo $sl; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?cid=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are you sure?')" href='delete-category.php?cid=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                        $sl++;
                      }
                    }
                         ?>
                    </tbody>
                </table>
                <?php
                $query1 = "SELECT * FROM category";
                $runquery1 = mysqli_query($connect,$query1) or die("Query Failed".mysqli_error());
                if(mysqli_num_rows($runquery1) > 0){
                  $total_data = mysqli_num_rows($runquery1);
                  $total_page = ceil($total_data / $limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                    echo "<li><a href='category.php?page=".($page - 1)."' >Prev</a></li>";
                  }
                  for($i = 1;$i <= $total_page;$i++){
                    if($i == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo "<li class='{$active}'><a href='category.php?page={$i}' >{$i}</a></li>";
                  }
                  if($page < $total_page){
                    echo "<li><a href='category.php?page=".($page + 1)."' >Next</a></li>";
                  }
                  echo "</ul>";
                }
                 ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
