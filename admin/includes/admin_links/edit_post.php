<?php
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];

    $edit_post_query= "select * from posts where post_id={$the_post_id}";
    $get_edit_post = mysqli_query($connection,$edit_post_query);
    while($row = mysqli_fetch_assoc($get_edit_post)){
        $post_id= $row['post_id'];
        $post_cat_id= $row['post_cat_id'];
        $post_title= $row['post_title'];
        $post_author= $row['post_author'];
        $post_date= $row['post_date'];
        $post_image= $row['post_image'];
        $post_content= $row['post_content'];
        $post_tags= $row['post_tags'];
        //$post_comment_count= $row['post_comment_count'];
        $post_status= $row['post_status'];
    update_post($the_post_id);

?>
  <form action="" method="post" enctype="multipart/form-data">
   <!--enctype for uploading file, for image-->
    <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" value="<?php if(isset($post_title))echo $post_title;?>" >
    </div>

    <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select class="" name="post_category_id" id="post_cat">
    <?php display_category_list($post_cat_id);?>
    </select>
    </div>

    <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="author" value="<?php if(isset($post_author))echo $post_author;?>" >
    </div>

    <div class="form-group">
    <label for="post_status">Post Status</label>
    <select  name="post_status" >
    <option <?php if($post_status ==='published') echo 'selected' ?> value="draft">Draft</option>
    <option <?php if($post_status ==='published') echo 'selected' ?> value="published">Published</option>
     </select>
    </div>

    <div class="form-group">
    <label for="image">Post Image</label>
    <input  type="file"  name="image" value="<?php if(isset($post_image))echo $post_image;?>">
    </div>

    <div class="form-group">
    <img src="../images/post_images/<?php echo $post_image ?>" width="100" alt="post image">
    </div>

    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php if(isset($post_tags))echo $post_tags;?>" >
    </div>

    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  class="form-control" name="post_content"  cols="30" rows="10"><?php if(isset($post_content))echo $post_content;?></textarea>
    </div>

    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Update" >
    </div>
</form>

<?php }}?>
