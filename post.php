<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>
<?php include "includes/feed_entry.php"; ?>
<?php include "admin/functions.php"; ?>



            <?php

            if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];
                $update_views = "update posts set post_view_count= post_view_count + 1 where post_id = {$post_id} ";
                $update_views_result = mysqli_query($connection,$update_views);
                $read_post_query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $read_post_result = mysqli_query($connection,$read_post_query);
                while($post = mysqli_fetch_assoc($read_post_result)){
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = $post['post_content'];
                    $post_view_count = $post['post_view_count'];

            ?>
                <!--post details-->
                <h2>
                <a href='post.php?p_id=<?php echo $post_id?>'> <?php echo $post_title?>  </a>
                </h2>
                <p class='lead'>
                    by <a href='index.php?feed_source=by_author&author=<?php echo $post_author?>'><?php echo $post_author ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date . "<br>" . $post_view_count . " Views"; ?> </p>

                <hr>
                <img class='img-responsive'
                src= "images/post_images/<?php echo $post_image; ?>"
                alt="post_image">
                <hr>
                <p class="lead"> <?php echo $post_content?> </p>
            <?php }

            }else{
                header("Location: index.php");
                exit();
            } ?>

                <!-- Post Content -->
                <p >Extra text to look NICE!!! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php create_comment(); ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" role="form">
                       <div class="form-group">
                       <label for="comment_author">Author</label>
                       <input type="text" class="form-control" name="comment_author" placeholder="Like Admin">
                       </div>
                       <div class="form-group">
                       <label for="comment_email">Email</label>
                       <input type="email" class="form-control" name="comment_email" placeholder="your_email@email.com">
                       </div>
                        <div class="form-group">
                       <label for="comment_content">Your comment</label>
                            <textarea class="form-control" name="comment_content"  rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Create Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                $read_comments_query= "SELECT * FROM comments WHERE comment_post_id={$post_id} ";
                $read_comments_query .= "AND comment_status= 'approved' ";
                $read_comments_query .= "ORDER BY comment_id DESC ";
                $get_comments_query = mysqli_query($connection, $read_comments_query);
                if(!$get_comments_query){
                    die('Cant get comments'. mysqli_error($connection));
                }
                while($comment = mysqli_fetch_assoc($get_comments_query)){
                    $comment_date = $comment['comment_date'];
                    $comment_author = $comment['comment_author'];
                    $comment_content = $comment['comment_content'];


                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="pro_image">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content;?>
                    </div>
                </div>
                <?php }?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->

                    </div>
                </div>
</div>
<?php //include "includes/pager.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/footer.php" ?>

