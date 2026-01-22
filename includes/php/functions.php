<?php
    function cat_listing(){
        global $connection;
            $get_cat = "SELECT cat_title FROM categories";
            $selected_cat = mysqli_query($connection, $get_cat);
            $i =0;
            while($cat_title = mysqli_fetch_row($selected_cat) and $i++<5){
            echo "<li>
                <a href='#'>$cat_title[0]</a>
                </li>";
                }
}

function user_li_on_navbar(){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
        echo "<li><a href='admin'>Admin</a></li>";
    }else if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='subscriber'){
        echo "<li><a href='admin'>Dashboard</a></li>";
    }
}

function edit_post_li_on_navbar(){
    // to take user to edit post page for editing post when user is in specific post page
    if(isset($_SESSION['user_role']  )){
        if(isset($_GET['p_id']))
        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$_GET['p_id']}'>Edit Post</a></li>";
    }
}

function register_li_on_navbar(){
    if(!isset($_SESSION['username']  )){
        echo "<li><a href='registration.php'>Register</a></li>";
    }
}


function registration(){
    global $connection;
    if(isset($_POST['reg_submit'])){
        $username = escape_strings($_POST['reg_username']);
        $email = escape_strings($_POST['reg_email']);
        $password = escape_strings($_POST['reg_password']);

            if(validate_registration($username, $email, $password)){
                    //encrypt the password
                    $password = password_hash($password, PASSWORD_BCRYPT);

                    // generate the user
                    $create_user_q = "insert into users (username, user_email, user_password,user_role) ";
                    $create_user_q .= "values ('$username','$email','$password','subscriber') ";
                    $user_created = mysqli_query($connection, $create_user_q);
                    if(!$user_created){
                        die("Query failed". mysqli_error($connection));
                    }

                        echo "<p class='text-success text-center'>You have registered successfully.</p>";

                }
        
    }
}
function escape_strings($string){
   global $connection;
   return mysqli_real_escape_string($connection, trim($string));
}

function contact (){
    if(isset($_POST['submit'])){
        
        $to = "pinak@duck.com";
        $subject = escape_strings($_POST['subject']);
        $subject= wordwrap( $subject ,70);
        $body = escape_strings($_POST['body']) ;
        $header = 'From:' . escape_strings($_POST['email']);

        
        $success = mail($to, $subject, $body,$header);
        if (!$success) {
        $errorMessage = error_get_last()['message'];
        }
        
    }
}

function validate_registration($username, $email, $password){
    global $connection;
    if(empty($username) or empty($email) or empty($password)){
        echo "<p class='text-danger text-center'>These fields cannot be empty. Please fill all the fields</p>";
        return false; }

    $username_query = "select * from users where username='$username'";
    $username_res = mysqli_query($connection, $username_query);
    $check_duplicate_username = mysqli_num_rows($username_res);
    if($check_duplicate_username >0) {
        echo "<p class='text-danger text-center'>This username exists. Choose a different username.</p>";
        return false;}
    
    $user_email_query = "select * from users where user_email='$email'";
    $user_email_res = mysqli_query($connection, $user_email_query);
    $check_duplicate_user_email = mysqli_num_rows($user_email_res);
    if($check_duplicate_user_email >0) {
        echo "<p class='text-danger text-center'>This email is already registered with another username. Choose a different email.</p>";
        return false;}
    
    if(strlen($password) <6 or strlen($password)>12){
        echo "<p class='text-danger text-center'>Password must be larger than 6 characters and smaller than 12 characters</p>";
        return false;
    }
    $common_pw = ['123456','1234567','12345678','123456789'.'1234567890','111111'];
    if(in_array($password, $common_pw)){
        echo "<p class='text-danger text-center'>Too common Password. Choose a strong password.</p>";
        return false;
    }
    return true;
}











    ?>
