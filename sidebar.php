<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        $limit = 5;
        $query = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_id, category.category_name, users.username, users.role FROM post
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN users ON post.author = users.user_id
        ORDER BY post_id DESC limit {$limit}";
        $runquery = mysqli_query($connect,$query) or die("Query Failed".mysqli_error());
        if(mysqli_num_rows($runquery) > 0){
          while($row = mysqli_fetch_assoc($runquery)){
          ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>">
                <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date']; ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row['post_id']; ?>">read more</a>
            </div>
        </div>
        <?php
      }
    }
         ?>

    </div>
    <!-- /recent posts box -->
</div>
