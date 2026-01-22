<?php add_user();?>
  <form action="" method="post" enctype="multipart/form-data">
   <!--enctype for uploading file, for image-->
    <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" >
    </div>

    <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" >
    </div>

    <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" >
    </div>

     <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" >
    </div>

    <div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" id="role">
    <option selected value="subscriber">Subscriber</option>
    <option value="admin">Admin</option>
    </select>
    </div>

    <!--
    <div class="form-group">
    <label for="image">User Image</label>
    <input type="file"  name="image" accept="image/*" >
    </div>
    -->


    <!-- image preview
    <div class="form-group">
    <img src="../images/post_images/<?php //echo $post_image ?>" width="100" alt="post image">
    </div>
    -->

    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Create User" >
    </div>
</form>
























