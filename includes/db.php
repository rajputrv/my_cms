<?php
$db['host'] = "127.0.0.1";
$db['user'] = 'root';
$db['password']= '';
$db['db_name']= 'cms';

//cpnvert tp const
foreach($db as $key=>$value){
    define(strtoupper($key), $value);
}
$connection = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
if(!$connection){
    die("DB not connected");
}

?>
