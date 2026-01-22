<?php
session_start();
include "db.php";
global $connection;
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // cleaning for sql query for injectin
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username='{$username}'";
        $select_user_query= mysqli_query($connection, $query);
        if(!$select_user_query){
            die("Can't find user with this username". mysqli_error($connection));
            echo "Can't find user with this username";
        }
        while($row= mysqli_fetch_assoc($select_user_query)){
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }
        //echo "\n". password_verify($password,$db_password);
        //$password_encrypted = password_hash($password, PASSWORD_BCRYPT);
        if($username === $db_username && password_verify($password,$db_password)){
            //create a sessin
            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            header("Location: ../admin");
            exit();
        }else  {
            header("Location: ../index.php");
            exit();
        }
    }
?>


