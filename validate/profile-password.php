<?php 
session_start();
include("../includes/connection.php");
function checkValid($Password, $ConfirmPassword) {
    $checkPassword = strcmp($Password,$ConfirmPassword);
    if($checkPassword!=0) {
        echo '<script>alert("Password does not match!!");window.location.href="../profile-change-password.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST['Submit'])){
    $Password = trim($_POST['Password']);
    $ConfirmPassword = trim($_POST['ConfirmPassword']);
    $checks = checkValid($Password, $ConfirmPassword) ? "True" : "False";;
    $passwordSQL =      "UPDATE Account SET password = '".$Password."' WHERE username = '".$_SESSION["username"]."'";
    if ($checks=="True" and mysqli_query($con, $passwordSQL)) {
        Header("Location: ../profile.php");
        return;
    }
    else {
        echo '<script>alert("Error!!");window.location.href="../profile-change-password.php";</script>';
        return;
    }
}
else{
    echo '<script>window.history.back();</script>';
    return;
}
?>