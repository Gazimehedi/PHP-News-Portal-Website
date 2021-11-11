<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                      <?php
                      if(isset($_GET['id'])){
                        $id = $_GET['id'];
                      }
                      $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_id, category.category_name, users.username, users.role FROM post
                      LEFT JOIN category ON post.category = category.category_id
                      LEFT JOIN users ON post.author = users.user_id
                      WHERE post_id = {$id}";
                      $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
                      if(mysqli_num_rows($runquery) > 0){
                        while($row = mysqli_fetch_assoc($runquery)){
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?php echo $row['category']; ?>" ><?php echo $row['category_name']; ?></a>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>
                        </div>
                        <?php
                      }
                    }
                         ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
