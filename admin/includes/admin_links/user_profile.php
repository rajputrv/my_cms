
                  <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php if(isset($_SESSION['username'])) echo $_SESSION['username'] ?>
                            <small>Welcome to the site!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Posts
                            </li>
                        </ol>

<?php
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $user_firstname = $_SESSION['user_firstname'];
    $user_lastname = $_SESSION['user_lastname'];
    $get_user_query= "select * from users where username='{$username}'";
    $get_user = mysqli_query($connection,$get_user_query);
    while($row = mysqli_fetch_assoc($get_user)){
        $user_id = $row['user_id'];
        //$user_firstname= $row['user_firstname'];
        //$user_lastname= $row['user_lastname'];
        $user_email= $row['user_email'];
        $user_password= $row['user_password'];
        $user_image= $row['user_image'];
        $user_role= $row['user_role'];

        update_user($user_id);

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
    <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile" >
    </div>
</form>

<?php }}?>




