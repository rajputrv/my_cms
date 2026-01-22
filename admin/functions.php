<?php

function escape_string($string){
   global $connection;
   return mysqli_real_escape_string($connection, trim($string));
}

//categories
function add_categories(){
    global $connection;
    if (isset($_POST["add_cat_submit"])) {
        $cat_title= escape_string($_POST["add_cat_title"]) ;
        if($cat_title==="" or empty($cat_title)){
            echo "This field should not be empty!";
        }else{
            $add_cat_query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
            $create_category_result = mysqli_query($connection, $add_cat_query);
            if(!$create_category_result){
                die("Can't Add new Query". mysqli_error($create_category_result));
            }
        }
   }
}

function delete_categories(){
    global $connection;
    // query for deletion
    if(isset($_GET['delete'])){
        $del_id = escape_string($_GET['delete']) ;
        $del_cat = "DELETE FROM categories where id={$del_id}";
        $del_query = mysqli_query($connection, $del_cat);
        header("Location: categories.php");
        //because it refresh when we delete so we need to be on same page
        exit();
    }
}

function list_categories(){
    global $connection;
    //query to show list of categories;
   $get_cat = "SELECT * from categories";
   $get_cat = mysqli_query($connection, $get_cat);

   while ($cat = mysqli_fetch_assoc($get_cat)) {
       $cat_id = $cat["id"];
       $cat_title = $cat["cat_title"];

       $del_icon = "<i class='fa fa-solid fa-trash'></i>";
       $edit_icon = "<i class='fa fa-solid fa-pencil'></i>";

       echo "<tr>
        <td>$cat_id</td>
        <td>$cat_title</td>
        <td>
        <a href='categories.php?edit={$cat_id}'>$edit_icon</a>
        </td>
        <td>
        <a href='categories.php?delete={$cat_id}'>$del_icon</a>
        </td>
        </tr>";
   }
}

//posts
function list_all_posts(){
    global $connection;
    $read_posts_query= "select * from posts order by post_id desc";
    $get_all_posts = mysqli_query($connection,$read_posts_query);
    while($row = mysqli_fetch_assoc($get_all_posts)){
        $post_id= $row['post_id'];
        $post_cat_id= $row['post_cat_id'];
        $post_title= $row['post_title'];
        $post_author= $row['post_author'];
        $post_date= $row['post_date'];
        $post_image= $row['post_image'];
        $post_content= $row['post_content'];
        $post_tags= $row['post_tags'];
        $post_status= $row['post_status'];
        $post_view_count= $row['post_view_count'];
        
        // post comment count
        $comment_count_query = "select * from comments where comment_post_id=$post_id";
        $comment_count_result = mysqli_query($connection, $comment_count_query);
        $comment_count = mysqli_num_rows($comment_count_result);

        //read_cat_by_cat_id
        $read_post_cat_query= "select * from categories where id='{$post_cat_id}'";
        $get_post_cat = mysqli_query($connection,$read_post_cat_query);
        while($row = mysqli_fetch_assoc($get_post_cat)){
            $post_cat = $row['cat_title'];
            $del_icon = "<i class='fa fa-solid fa-trash'></i>";
            $edit_icon = "<i class='fa fa-solid fa-pencil'></i>";
            $view_icon = "<i class='fa fa-solid fa-eye'></i>";

        echo "
         <tr>
            <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value=$post_id></td>
            <td>{$post_id}</td>
            <td>{$post_author}</td>
            <td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>
            <td>{$post_cat}</td>
            <td>{$post_status}</td>
            <td><img class='img-responsive' src='../images/post_images/{$post_image}'></td>
            <td>{$post_tags}</td>
            <td><a href='comments.php?p_id=$post_id'>{$comment_count}</a></td>
            <td>{$post_date}</td>
            <td><a href='posts.php?reset=$post_id'>{$post_view_count}</a></td>
            <td><a href='../post.php?p_id=$post_id'>{$view_icon}</a></td>          
            <td>
            <a href='posts.php?source=edit_post&p_id={$post_id}'>$edit_icon</a>
            </td>
            <td>
            <a rel='$post_id' href='javascript:void(0)' class='delete_link' >$del_icon</a>
            </td>

        </tr>
        ";
        }
    }
}
function bulkOptionsonPosts(){
  global $connection;
  if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
      $bulk_option= $_POST['bulk_option'];
      switch ($bulk_option){
        case 'delete':
          $delete_query = "delete from posts where post_id= $postValueId";
          $delete_posts = mysqli_query($connection, $delete_query); 
          break;
        case 'clone':
            $get_posts = "select * from posts where post_id = '$postValueId'";
            $get_posts_res = mysqli_query($connection,$get_posts);
            while($row = mysqli_fetch_assoc($get_posts_res)){
                $post_title = $row['post_title'];
                $post_cat_id = $row['post_cat_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                
                //insert same data to posts again ie clone same post
                $clone_query = "insert into posts(post_cat_id, post_title, post_author, post_date,
                post_image, post_content, post_tags, post_status) ";
                $clone_query.= "values ($post_cat_id,'$post_title','$post_author', now(), 
                '$post_image', '$post_content', '$post_tags', '$post_status')";
                $clone_query_res = mysqli_query($connection,$clone_query);
            }
          break;
        default:
          //in other two options we just need to change status to draft or published
          $update_status_query = "update posts set post_status='$bulk_option' where post_id=$postValueId";
          $update_staus_posts = mysqli_query($connection, $update_status_query); 

      }
    }header("Location: posts.php");
      exit();
  }
}
function reset_post_views(){
  global $connection;
  if(isset($_GET['reset'])){
    $post_id = escape_string($_GET['reset']);
    $query = "update posts set post_view_count=0 where post_id= $post_id";
    $query_run = mysqli_query($connection,$query);
  }
}

function add_post(){
    global $connection;
    if(isset($_POST['create_post'])){
    $post_title = escape_string($_POST['title']) ;
    $post_author = escape_string($_POST['author']);
    $post_category_id = escape_string($_POST['post_category_id']) ;
    $post_status = escape_string($_POST['post_status']) ;
    $post_image = escape_string($_FILES['image']['name']);
    $post_image_temp = escape_string($_FILES['image']['tmp_name']);

    $post_tags =escape_string($_POST['post_tags']) ;
    $post_content = escape_string($_POST['post_content']) ;
    $post_date = date('d-m-y');

    //file chosen will be stored in temporary location
    // we need to move it from temp location and store it in our folder
    // we use befow fn, first param is file in temp , second param is location where to move
    // in second  param, we added the variable storing name of file uploaded, to name the saved file the same name
    move_uploaded_file($post_image_temp, "../images/post_images/$post_image");

    $query = "INSERT INTO posts(post_cat_id, post_title, post_author,
    post_date, post_image, post_content, post_tags, post_status) ";

    $query.= "VALUES({$post_category_id},'{$post_title}','{$post_author}'
    ,now(), '{$post_image}','{$post_content}','{$post_tags}',
    '{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);
    if(!$create_post_query){
        die('Create post query failed'. mysqli_error($connection));
    }
    header("Location: posts.php");
        //because it refresh when we delete so we need to be on same page
    exit();

}
}

//display list of categories in edit and add post
function display_category_list($post_cat_id){
    global $connection;
    $get_all_cat = "SELECT * FROM categories";
        $show_cat_row = mysqli_query($connection, $get_all_cat);
        if (!$show_cat_row) {
            die("Database query failed: " . mysqli_error($connection));
        }
        while($show_cat = mysqli_fetch_assoc($show_cat_row)){
            $cat_id = $show_cat['id'];
            $cat_title = $show_cat['cat_title'];
            echo "
            <option value='{$cat_id}' " ;
            if($post_cat_id== $cat_id) {echo 'selected';}
            echo ">{$cat_title}</option>";
             }
}

function delete_post(){
    global $connection;
    if (isset($_GET['delete'])){
        $post_id = escape_string($_GET['delete']);
        $query = "DELETE FROM posts WHERE post_id='{$post_id}'";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
        //because it refresh when we delete so we need to be on same page
        exit();
    }
}

function update_post($the_post_id){
    global $connection;
    if(isset($_POST['update_post'])){
    $post_title = escape_string($_POST['title']);
    $post_author = escape_string($_POST['author']);
    $post_cat_id =escape_string($_POST['post_category_id']) ;
    $post_status = escape_string($_POST['post_status']);

    $post_image = escape_string($_FILES['image']['name']);
    $post_image_temp = escape_string($_FILES['image']['tmp_name']);

    $post_tags = escape_string($_POST['post_tags']);
    $post_content = escape_string($_POST['post_content']);

    move_uploaded_file($post_image_temp, "../images/post_images/$post_image");
    if(empty($post_image)){
        $query = "SELECT * from posts where post_id = {$the_post_id}";
        $selected_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($selected_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query.= "post_title = '{$post_title}', ";
    $query.= "post_cat_id = '{$post_cat_id}', ";
    $query.= "post_date = now(), ";
    $query.= "post_author = '{$post_author}', ";
    $query.= "post_status = '{$post_status}', ";
    $query.= "post_tags = '{$post_tags}', ";
    $query.= "post_content = '{$post_content}', ";
    $query.= "post_image = '{$post_image}' ";
    $query.= "WHERE post_id = {$the_post_id} ";


    $update_post_query = mysqli_query($connection, $query);
    if(!$update_post_query){
        die('Update post query failed'. mysqli_error($connection));
    }
        header("Location: posts.php");
        exit();
    }
}


//Comments
function list_all_comments(){
    global $connection;
    if(isset($_GET['p_id'])){
    $post_id = escape_string($_GET['p_id']);
     $read_comments_query= "select * from comments where comment_post_id=$post_id";
    }else{
        $read_comments_query= "select * from comments";

    }
    $get_all_comments = mysqli_query($connection,$read_comments_query);
    while($row = mysqli_fetch_assoc($get_all_comments)){
        $comment_id= $row['comment_id'];
        $comment_post_id= $row['comment_post_id'];
        $comment_email= $row['comment_email'];
        $comment_author= $row['comment_author'];
        $comment_date= $row['comment_date'];
        $comment_content= $row['comment_content'];
        $comment_status= $row['comment_status'];

        //read_cat_by_cat_id
        $read_comment_post_query= "select * from posts where post_id='{$comment_post_id}'";
        $get_comment_post = mysqli_query($connection,$read_comment_post_query);
        while($row = mysqli_fetch_assoc($get_comment_post)){
            $comment_post = $row['post_title'];

            $del_icon = "<i class='fa fa-solid fa-trash'></i>";
            $edit_icon = "<i class='fa fa-solid fa-pencil'></i>";
            $approve_icon = "<i class='fa fa-solid fa-check'></i>";
            $unapprove_icon = "<i class='fa fa-solid fa-ban'></i>";

            if(isset($_GET['p_id'])){
            $second_param = "&p_id=".escape_string($_GET['p_id']);
        }else { $second_param="";}
        
        echo "
         <tr>
            <td>{$comment_id}</td>";
            $comment_id.= $second_param;
        echo"
            <td>{$comment_author}</td>
            <td>{$comment_content}</td>
            <td>{$comment_email}</td>
            <td>{$comment_status}</td>
            <td>{$comment_date}</td>
            <td><a href='../post.php?p_id={$comment_post_id}'>{$comment_post}</a></td>
            <td>
            <a href='comments.php?approve={$comment_id}'>$approve_icon</a>
            </td>
            <td>
            <a href='comments.php?unapprove={$comment_id}'>$unapprove_icon</a>
            </td>
            <td>
            <a href='comments.php?edit={$comment_id}'>$edit_icon</a>
            </td>
            <td>
            <a href='comments.php?delete={$comment_id}'>$del_icon</a>
            </td>

        </tr>
        ";
        }
    }
}

function create_comment(){
    global $connection;
    if(isset($_POST['create_comment'])){
        $the_post_id = escape_string($_GET['p_id']);
        $comment_author = escape_string($_POST['comment_author']);
        $comment_email = escape_string($_POST['comment_email']);
        $comment_content = escape_string($_POST['comment_content']);

        $query = "INSERT INTO `comments`
        (`comment_id`, `comment_post_id`, `comment_author`,
        `comment_email`, `comment_content`, `comment_status`, `comment_date`) ";
        $query .= "VALUES (NULL, {$the_post_id}, '{$comment_author}',
        '{$comment_email}', '{$comment_content}', 'unapproved', now() )";

        $create_comment_query = mysqli_query($connection, $query);

        if(!$create_comment_query){
            die("create query failed". mysqli_error($connection));
        }

    }
}

function delete_comment(){
    global $connection;
    if (isset($_GET['delete'])){
        if(isset($_GET['p_id'])){
            $second_param = "?p_id=".escape_string($_GET['p_id']);
        }else { $second_param="";}
        $comment_id = escape_string($_GET['delete']);
        $query = "DELETE FROM comments WHERE comment_id='{$comment_id}'";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php".$second_param);
        exit();
    }
}

function unapprove_comment(){
    global $connection;
    if (isset($_GET['unapprove'])){
        if(isset($_GET['p_id'])){
            $second_param = "?p_id=".escape_string($_GET['p_id']);
        }else { $second_param="";}
        $comment_id = escape_string($_GET['unapprove']);
        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='{$comment_id}'";
        $unapprove_query = mysqli_query($connection, $query);
        header("Location: comments.php".$second_param);
        exit();
    }
}

function approve_comment(){
    global $connection;
    if (isset($_GET['approve'])){
        if(isset($_GET['p_id'])){
            $second_param = "?p_id=".escape_string($_GET['p_id']);
        }else { $second_param="";}
        $comment_id = escape_string($_GET['approve']);
        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id='{$comment_id}'";
        $approve_query = mysqli_query($connection, $query);
        header("Location: comments.php".$second_param);
        exit();
    }
}

function list_all_users(){
    global $connection;
    $read_users_query= "select * from users";
    $get_all_users = mysqli_query($connection,$read_users_query);
    while($row = mysqli_fetch_assoc($get_all_users)){
        $user_id= $row['user_id'];
        $username= $row['username'];
        $user_firstname= $row['user_firstname'];
        $user_lastname= $row['user_lastname'];
        $user_email= $row['user_email'];
        $user_role= $row['user_role'];

        //read_cat_by_cat_id
        //$read_comment_post_query= "select * from users where post_id='{$comment_post_id}'";
        //$get_comment_post = mysqli_query($connection,$read_comment_post_query);
        //while($row = mysqli_fetch_assoc($get_comment_post)){
        //    $comment_post = $row['post_title'];

            $del_icon = "<i class='fa fa-solid fa-trash'></i>";
            $edit_icon = "<i class='fa fa-solid fa-pencil'></i>";
        echo "
         <tr>
            <td>{$user_id}</td>
            <td>{$username}</td>
            <td>{$user_firstname}</td>
            <td>{$user_lastname}</td>
            <td>{$user_email}</td>
            <td>{$user_role}</td>
            <td>
            <a href='users.php?make_admin={$user_id}'>Make admin</a>
            </td>
            <td>
            <a href='users.php?make_sub={$user_id}'>Make Sub</a>
            </td>
            <td>
            <a href='users.php?source=edit_user&edit={$user_id}'>$edit_icon</a>
            </td>
            <td>
            <a href='users.php?delete={$user_id}'>$del_icon</a>
            </td>

        </tr>
        ";
        }
}

function add_user(){
    global $connection;
    if(isset($_POST['create_user'])){
    $user_firstname = escape_string($_POST['user_firstname']);
    $user_lastname = escape_string($_POST['user_lastname']);
    $user_email = escape_string($_POST['user_email']);
    $username = escape_string($_POST['username']);
    $user_password = escape_string($_POST['user_password']);
    $user_role = escape_string($_POST['user_role']);

    //$post_image = $_FILES['image']['name'];
    //$post_image_temp = $_FILES['image']['tmp_name'];

    //move_uploaded_file($post_image_temp, "../images/post_images/$post_image");

    $query = "INSERT INTO `users` (`user_id`, `username`, `user_password`,
    `user_firstname`, `user_lastname`, `user_email`,
    `user_image`, `user_role`)   ";

    $query.=  "VALUES (NULL, '{$username}', '{$user_password}',
    '{$user_firstname}', '{$user_lastname}', '{$user_email}', '', '{$user_role}')";

    $create_user_query = mysqli_query($connection, $query);
    if(!$create_user_query){
        die('Create post query failed'. mysqli_error($connection));
    }
    header("Location: users.php");
    exit();
}
}

function delete_user(){
    global $connection;
    if (isset($_GET['delete'])){
        $user_id = escape_string($_GET['delete']);
        $query = "DELETE FROM users WHERE user_id='{$user_id}'";
        $delete_query = mysqli_query($connection, $query);
        header("Location: users.php");
        exit();
    }
}

function make_admin(){
    global $connection;
    if (isset($_GET['make_admin'])){
        $user_id = escape_string($_GET['make_admin']);
        $query = "UPDATE users SET user_role='admin' WHERE user_id='{$user_id}'";
        $make_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
        exit();
    }
}
function make_sub(){
    global $connection;
    if (isset($_GET['make_sub'])){
        $user_id = escape_string($_GET['make_sub']);
        $query = "UPDATE users SET user_role='subscriber' WHERE user_id='{$user_id}'";
        $make_sub_query = mysqli_query($connection, $query);
        header("Location: users.php");
        //because it refresh when we delete so we need to be on same page
        exit();
    }
}

function update_user($the_user_id){
    global $connection;
    if(isset($_POST['update_user'])){
    $user_firstname = escape_string($_POST['user_firstname']);
    $user_lastname = escape_string($_POST['user_lastname']);
    $user_email = escape_string($_POST['user_email']);
    $username = escape_string($_POST['username']);
    $user_password = escape_string($_POST['user_password']);
    $user_role = escape_string($_POST['user_role']);

    //move_uploaded_file($post_image_temp, "../images/post_images/$post_image");
    //if(empty($post_image)){
    //    $query = "SELECT * from posts where post_id = {$the_post_id}";
    //    $selected_image = mysqli_query($connection, $query);
    //    while($row = mysqli_fetch_array($selected_image)){
    //        $post_image = $row['post_image'];
    //    }
    //}

    $query = "UPDATE users SET ";
    $query.= "user_firstname = '{$user_firstname}', ";
    $query.= "user_lastname = '{$user_lastname}', ";
    $query.= "user_email = '{$user_email}', ";
    $query.= "username = '{$username}', ";
    $query.= "user_password = '{$user_password}', ";
    $query.= "user_role = '{$user_role}' ";
    //$query.= "post_image = '{$post_image}' ";
    $query.= "WHERE user_id = {$the_user_id} ";


    $update_user_query = mysqli_query($connection, $query);
    if(!$update_user_query){
        die('Update User query failed'. mysqli_error($connection));
    }
        header("Location: users.php");
        exit();
    }
}

function count_no_of($to_count){
  global $connection;
  $query = "select count(*) from $to_count";
  $run_query = mysqli_query($connection, $query);
  $count = mysqli_fetch_array($run_query);
  return $count[0];
}

function chart_data (){
  global $connection;
  $chart_data=[];
  $post_query = "select count(*) from posts where post_status='draft'";
  $post_run_query = mysqli_query($connection, $post_query);
  $draft_count = mysqli_fetch_array($post_run_query);
  $chart_data['draft_post_count']= $draft_count[0];
  
  $user_query = "select count(*) from users where user_role='subscriber'";
  $user_run_query = mysqli_query($connection, $user_query);
  $user_count = mysqli_fetch_array($user_run_query);
  $chart_data['subscriber_user_count']= $user_count[0];
  
  $comment_query = "select count(*) from comments where comment_status='unapproved'";
  $comment_run_query = mysqli_query($connection, $comment_query);
  $comment_count = mysqli_fetch_array($comment_run_query);
  $chart_data['unapproved_comment_count']= $comment_count[0];
  
  return $chart_data;
}

function users_online(){
    if(isset($_GET['onlineusers'])){
    global $connection;
    if(!$connection){
        include "../includes/db.php";
        $session = session_id(); //get session id stored in session
        $time = time();
        $timeout_in_sec = 30; // if user is inactive for this long, he will be declared inactive or offline
        $timeout = $time - $timeout_in_sec;

        // if session of user is in table ie user was logged in and session not expired
        $user_online_query = "select * from users_online where session='$session'";
        $user_online_result = mysqli_query($connection, $user_online_query);
        $online_user_count = mysqli_num_rows($user_online_result);

        if($online_user_count == null){
            // if session is not stored, user is newly logged in, store its data to mark user as  online
            mysqli_query($connection, "insert into users_online(session, time) values ('$session','$time' ) ");
        }else{
            //if user was online and session is not expired, give him more time to maintan session
            mysqli_query($connection, "update users_online set time= '$time' where session='$session'");
        }

        $online_users_query = "select * from users_online where time> '$timeout'";
        $online_users_result = mysqli_query($connection, $online_users_query);
        echo $online_users_count = mysqli_num_rows($online_users_result);
    }
    }
}
users_online();

function isAdmin($username =''){
    global $connection;
    $query = "select user_role from user where username=$username";
    $get_username= mysqli_query($connection, $query);
    $user_role = mysqli_fetch_array($get_username);
    $user_role = $user_role[0];
    
    if($user_role==='admin'){
        return true;
    }
    return false;
}



?>














