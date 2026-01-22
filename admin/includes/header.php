<?php ob_start(); //output buffere= for redirecting
session_start();

//validate if not admin
if(!isset($_SESSION['user_role']) or $_SESSION['user_role']!=='admin'){
        header("Location: ../index.php");
        exit();
    }

?>
<?php include "../includes/db.php";?>
<?php include "functions.php";?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loader.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.tiny.cloud/1/s78jxmtj9hlchlxcxpe95a4ontby7jj02hah7n75mmwwu6cj/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js" ></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
