<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM regtable WHERE ID = '".$_GET['user_del']."'");
header("location:all_users.php");  

?>
