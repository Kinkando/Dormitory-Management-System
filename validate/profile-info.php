<?php 
session_start();
include("../includes/connection.php");?>
<?php
function checkValid($tel_no, $email) {
    for($i=0;$i<strlen($tel_no);$i++) {
        if(!is_numeric($tel_no)) {
            echo '<script>alert("Invalid Telephone Number");window.location.href="../profile-change-info.php";</script>';
            return false;
        }
    }
    if(strlen($tel_no)!=10) {
        echo '<script>alert("Invalid Telephone Number");window.location.href="../profile-change-info.php";</script>';
        return false;
    }
    else if(!str_contains($email,"@hotmail.com") && !str_contains($email,"@gmail.com")) {
        echo '<script>alert("Invalid Email");window.location.href="../profile-change-info.php";</script>';
        return false;
    }
    $domain = str_contains($email,"@hotmail.com") ? substr($email, strpos($email,"@hotmail.com")) :  
              substr($email, strpos($email,"@gmail.com"));
    if(strtolower($domain)!="@hotmail.com" and strtolower($domain)!="@gmail.com" or $email=="@hotmail.com" or $email=="@gmail.com") {
        echo '<script>alert("Invalid Email");window.location.href="../profile-change-info.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST['Submit'])){
    $id = strtoupper(trim($_POST["id"]));
	$firstname = trim($_POST["firstName"]);
	$lastname = trim($_POST["lastName"]);
	$tel_no = trim($_POST["telNO"]);
	$email = trim($_POST["email"]);
    $memberdetailSQL = "UPDATE memberdetail SET  
						firstName = '" .$firstname ."',
						lastName = '" .$lastname ."',
						tel_no = '" .$tel_no ."'
						WHERE member_ID = '".$id."'" ;
    $emailSQL = "UPDATE account SET email = '".$email."' WHERE member_ID = '".$id."'";
    $check = checkValid($tel_no, $email) ? "True" : "False";
    if ($check=="True" and mysqli_query($con, $memberdetailSQL) and mysqli_query($con, $emailSQL)) {
        $_SESSION["User"] = $firstname . " " . $lastname;
        $_SESSION["Firstname"] = $firstname;
        $_SESSION["Lastname"] = $lastname;
        $_SESSION["Tel_no"] = $tel_no;
        $_SESSION["Email"] = $email;
        Header("Location: ../profile.php");
    }
    else
        echo '<script>alert("Error!!");window.location.href="../profile-change-info.php";</script>';
    mysqli_close($con);
}
else{
    echo '<script>window.history.back();</script>';
    return;
}
?>
