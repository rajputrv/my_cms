<?php add_post();?>
  <form action="" method="post" enctype="multipart/form-data">
   <!--enctype for uploading file, for image-->
    <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select name="post_category_id" id="post_cat">
    <?php display_category_list(); ?>
    </select>
    </div>

    <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="author" >
    </div>

    <div class="form-group">
    <label for="post_status">Post Status</label>
    <select  name="post_status" >
    <option value="draft">Draft</option>
    <option value="published">Published</option>
     </select>
    </div>

    <div class="form-group">
    <label for="image">Post Image</label>
    <input type="file"  name="image" accept="image/*" >
    </div>


    <!-- image preview
    <div class="form-group">
    <img src="../images/post_images/<?php //echo $post_image ?>" width="100" alt="post image">
    </div>
    -->


    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" >
    </div>

    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  class="form-control" name="post_content"  cols="30" rows="10" ></textarea>
    </div>

    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish" >
    </div>
</form>
























