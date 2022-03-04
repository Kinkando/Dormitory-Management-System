<?php 
session_start();
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($FirstName, $LastName, $Username, $Password, $ConfirmPassword, $Email, $TelNO) {
    include("../includes/connection.php");
    $sql = "SELECT username FROM Account WHERE username='".$Username."'";
    $emailSQL = "SELECT email FROM Account WHERE email='".$Email."'";
    $result = $con->query($sql);
    $resultEmail = $con->query($emailSQL);
    if(mysqli_num_rows($result)==1){
        echo '<script>alert("Repeat Username");window.location.href="../sign-up.php";</script>';
        return false;
    }
    else if(mysqli_num_rows($resultEmail)==1) {
        echo '<script>alert("Repeat Email");window.location.href="../sign-up.php";</script>';
        return false;
    }
    $checkPassword = strcmp($Password,$ConfirmPassword);
    if($checkPassword!=0) {
        echo '<script>alert("Password does not match!!");window.location.href="../sign-up.php";</script>';
        return false;
    }
    else if(!is_numeric($TelNO) or strlen($TelNO)!=10) {
        echo '<script>alert("Invalid Telephone Number");window.location.href="../sign-up.php";</script>';
        return false;
    }
    else if(strlen($FirstName)==0 || strlen($LastName)==0){
        echo '<script>alert("Invalid Name");window.location.href="../sign-up.php";</script>';
        return false;
    }
    else if(!str_contains($Email,"@hotmail.com") && !str_contains($Email,"@gmail.com")) {
        echo '<script>alert("Invalid Email");window.location.href="../sign-up.php";</script>';
        return false;
    }
    $domain = str_contains($Email,"@hotmail.com") ? substr($Email, strpos($Email,"@hotmail.com")) :  
              substr($Email, strpos($Email,"@gmail.com"));
    if(strtolower($domain)!="@hotmail.com" and strtolower($domain)!="@gmail.com" or $Email=="@hotmail.com" or $Email=="@gmail.com") {
        echo '<script>alert("Invalid Email");window.location.href="../sign-up.php";</script>';
        return false;
    }
    return true;
}
function member_id_generate() {
    include("../includes/connection.php");
    $sql = "SELECT member_id FROM memberdetail ORDER BY member_id asc";
    $result = $con->query($sql);
    $memberID = "";
    while ($row = mysqli_fetch_array($result))
        $memberID = $row['member_id'];
    $memberID = strlen($memberID)==0 ? "M00001" : sprintf( 'M%05d', ((int)substr($memberID,1))+1);
    return $memberID;
}

if(isset($_POST['Register'])){
    include("../includes/connection.php");
    $FirstName = trim($_POST['FirstName']);
    $LastName = trim($_POST['LastName']);
    $Username = trim($_POST['Username']);
    $Password = trim($_POST['Password']);
    $ConfirmPassword = trim($_POST['ConfirmPassword']);
    $Email = trim($_POST['Email']);
    $TelNO = trim($_POST['TelNO']);
    $check = false;
    foreach(array_keys($_REQUEST) as $keys) {
        if(str_contains($keys, "check"))
            $check = true;
    }
    foreach($_REQUEST as $key=>$data) {
        if(strlen($data)==0) {
            echo '<script>alert("'.$key.' is required!!");window.location.href="../sign-up.php";</script>';
            return;
        }
    }
    if($check!=1) {
        echo '<script>alert("Gender is required!!");window.location.href="../sign-up.php";</script>';
        return;
    }
    $Gender = substr(trim($_POST['check']),0,1);
    $checks = checkValid($FirstName, $LastName, $Username, $Password, $ConfirmPassword, $Email, $TelNO) ? "True" : "False";;
    $memberID = member_id_generate();
    $userSQL =      "INSERT INTO Account (username, password, email, level, member_id) VALUES (
                    '".$Username."', '".$Password."', '".$Email."', 'U', '".$memberID."')";
    $memberdetailSQL = "INSERT INTO memberdetail VALUES( 
                    '". $memberID ."',
                    '" .$FirstName ."',
                    '" .$LastName ."',
                    '" .$Gender ."',
                    '" .$TelNO ."')" ;
    if ($checks=="True" and mysqli_query($con, $memberdetailSQL) and mysqli_query($con, $userSQL)) {
        Header("Location: ../sign-in.php");
        return;
    }
    else {
        echo '<script>alert("Error!!");window.location.href="../sign-up.php";</script>';
        return;
    }
}
else{
    echo '<script>window.history.back();</script>';
    return;
}
