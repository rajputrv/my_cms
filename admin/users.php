<?php 
if(!is_admin($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
?>
<?php include "includes/header.php"?>
<?php include "includes/navigation.php"?>
<?php include "includes/admin_links/view_all_users.php"; ?>
<?php include "includes/footer.php";?>
