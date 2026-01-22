<?php
if(isset($_GET['category'])){
 $posts_cat_id = $_GET['category'];
    $read_post_query = "SELECT * FROM posts WHERE post_cat_id = {$posts_cat_id}";
    $read_post_result = mysqli_query($connection,$read_post_query);
                while($post = mysqli_fetch_assoc($read_post_result)){
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = $post['post_content'];
?>
                <h2>
                <a href='post.php?p_id=<?php echo $post_id?>'> <?php echo $post_title?>  </a>
                </h2>
                <p class='lead'>
                    by <a href='post.php?p_id=<?php echo $post_id?>'><?php echo $post_author ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class='img-responsive'
                src= "images/<?php echo $post_image; ?>"
                alt="post_image">
                <hr>
                <p> <?php echo $post_content?> </p>
                <a class='btn btn-primary' href='post.php?p_id=<?php echo $post_id?>'>Read More
                <span class='glyphicon glyphicon-chevron-right'></span>
                </a>
                <hr>
        <?php }} ?>
