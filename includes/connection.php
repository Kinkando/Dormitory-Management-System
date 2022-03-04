<?php
$hostname_db = "localhost";
$userid_db = "root";
$userpwd_db = "";
$db_name = "dormitory";
$con = mysqli_connect($hostname_db, $userid_db, $userpwd_db, $db_name);
if (!$con)
    die("Connection failed: " . mysqli_connect_error());
?>