<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
                  if(isset($_GET['search'])){
                    $search_data = $_GET['search'];
                  }
                  echo "<h2 class='page-heading'>Search : {$search_data}</h2>";
                  $limit = 5;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $offset = ($page - 1) * $limit;
                  $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_id, category.category_name, users.username, users.role FROM post
                  LEFT JOIN category ON post.category = category.category_id
                  LEFT JOIN users ON post.author = users.user_id
                  WHERE post.title LIKE '%{$search_data}%'
                  ORDER BY post_id DESC limit {$offset},{$limit}";
                  $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
                  if(mysqli_num_rows($runquery) > 0){
                    while($row = mysqli_fetch_assoc($runquery)){
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($row['description'], 0, 140) ."....."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                  }
                }else{
                  echo "<h4 class='text-center'>Search Result Not Found!</h4>";
                }
                    $query1 = "SELECT * FROM post WHERE title LIKE '%{$search_data}%'";
                    $runquery1 = mysqli_query($connect,$query1) or die("Query Failed".mysqli_error());
                    if(mysqli_num_rows($runquery1) > 0){
                      $total_data = mysqli_num_rows($runquery1);
                      $total_page = ceil($total_data / $limit);
                      echo "<ul class='pagination admin-pagination'>";
                      if($page > 1){
                        echo "<li><a href='search.php?page=".($page - 1)."&search={$search_data}' >Prev</a></li>";
                      }
                      for($i = 1;$i <= $total_page;$i++){
                        if($i == $page){
                          $active = "active";
                        }else{
                          $active = "";
                        }
                        echo "<li class='{$active}'><a href='search.php?page={$i}&search={$search_data}' >{$i}</a></li>";
                      }
                      if($page < $total_page){
                        echo "<li><a href='search.php?page=".($page + 1)."&search={$search_data}' >Next</a></li>";
                      }
                      echo "</ul>";
                    }
                     ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
