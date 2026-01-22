<?php
    if(isset($_GET['edit'])){
        $the_user_id = $_GET['edit'];

    $edit_user_query= "select * from users where user_id={$the_user_id}";
    $get_edit_user = mysqli_query($connection,$edit_user_query);
    while($row = mysqli_fetch_assoc($get_edit_user)){
        $username= $row['username'];
        $user_firstname= $row['user_firstname'];
        $user_lastname= $row['user_lastname'];
        $user_email= $row['user_email'];
        $user_password= $row['user_password'];
        $user_role= $row['user_role'];
        $user_image= $row['user_image'];

        update_user($the_user_id);


?>
    <form action="" method="post" enctype="multipart/form-data">
   <!--enctype for uploading file, for image-->
    <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php if(isset($user_firstname)) {echo $user_firstname;} ?>" >
    </div>

    <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php if(isset($user_lastname)) {echo $user_lastname;} ?>" >
    </div>

    <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php if(isset($user_email)) {echo $user_email;} ?>" >
    </div>

     <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php if(isset($username)) {echo $username;} ?>">
    </div>

    <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" >
    </div>

    <div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" id="role">
    <option <?php if(isset($user_role) and $user_role==='subscriber') {echo 'selected';} ?> value="subscriber">Subscriber</option>
    <option <?php if(isset($user_role) and $user_role==='admin') {echo 'selected';} ?> value="admin">Admin</option>
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
    <input type="submit" class="btn btn-primary" name="update_user" value="Update User" >
    </div>
</form>

<?php }}?>
