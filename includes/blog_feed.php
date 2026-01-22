
               <?php
                $per_page_posts =5;
                if(isset($_GET['page'])){
                    $page= $_GET['page'];
                    $page_start_post_id = ( ($page-1) * $per_page_posts);
                }else {
                    $page =1;
                    $page_start_post_id=0;
                }
                if(isset($_GET['feed_source'])){
                    $show_feeds = $_GET['feed_source'];


                if ($show_feeds === 'by_category' ){
                    $posts_cat_id = $_GET['category'];
                    $feeds_param_value = $posts_cat_id;
                    $read_posts_query = "SELECT * FROM posts WHERE post_cat_id = {$posts_cat_id} and post_status='published'";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);
                    $total_posts = mysqli_num_rows($read_posts_result);

                    $read_posts_query = "SELECT * FROM posts WHERE post_cat_id = {$posts_cat_id} and post_status='published' order by post_id desc limit $page_start_post_id, $per_page_posts";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);

                }
                else if ($show_feeds === 'by_author' ){
                    $posts_author = $_GET['author'];
                    $feeds_param_value = $posts_author;
                    $read_posts_query = "SELECT * FROM posts WHERE post_author = '{$posts_author}' and post_status='published'";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);
                    $total_posts = mysqli_num_rows($read_posts_result);

                    $read_posts_query = "SELECT * FROM posts WHERE post_author = '{$posts_author}' and post_status='published' order by post_id desc limit $page_start_post_id, $per_page_posts";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);
                }

                }else {
                    $read_posts_query = "SELECT * FROM posts WHERE post_status='published'";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);
                    $total_posts = mysqli_num_rows($read_posts_result);

                    $read_posts_query = "SELECT * FROM posts WHERE post_status='published' order by post_id desc limit $page_start_post_id, $per_page_posts";
                    $read_posts_result = mysqli_query($connection,$read_posts_query);
                }

                if ($total_posts === 0) {
                    echo "<h1 class='text-center'>No Blogs to show. <br> Come Back Later.</h1>";
                    $no_of_pages =0;
                }else {
                $no_of_pages = ceil($total_posts/ $per_page_posts) ;

                while($post = mysqli_fetch_assoc($read_posts_result)){
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = substr($post['post_content'],0,150); //trim to 50char
    ?>
                <h2>
                <a href='post.php?p_id=<?php echo $post_id?>'> <?php echo $post_title?>  </a>
                </h2>
                <p class='lead'>
                    by <a href='index.php?feed_source=by_author&author=<?php echo $post_author?>'><?php echo $post_author ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id?>">
                <img class='img-responsive'
                src= "images/post_images/<?php echo $post_image; ?>"
                alt="post_image"></a>

                <hr>
                <p> <?php echo $post_content?> </p>
                <a class='btn btn-primary' href='post.php?p_id=<?php echo $post_id?>'>Read More
                <span class='glyphicon glyphicon-chevron-right'></span>
                </a>
                <hr>
                <?php }}?>
