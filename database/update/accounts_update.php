<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($username, $email, $id) {
    include("../../includes/connection.php");
    $sql = "SELECT username FROM account WHERE username = '".$username."'";
    $result = $con->query($sql);
    if ($result->num_rows > 0 and $id != $username) {
        echo '<script>alert("Repeat Username");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    else if(!str_contains($email,"@hotmail.com") && !str_contains($email,"@gmail.com")) {
        echo '<script>alert("Invalid Email");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    $domain = str_contains($email,"@hotmail.com") ? substr($email, strpos($email,"@hotmail.com")) :  
              substr($email, strpos($email,"@gmail.com"));
    if(strtolower($domain)!="@hotmail.com" and strtolower($domain)!="@gmail.com" or $email=="@hotmail.com" or $email=="@gmail.com") {
        echo '<script>alert("Invalid Email");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["user_id"])) {
    $id = trim($_POST["user_id"]);
    $username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$email = trim($_POST["email"]);
	$level = substr($_POST["level"],0,1);
    $member_id = strtoupper(trim($_POST["member_id"]));
    $accountSQL = "UPDATE account SET  
						username = '". $username ."',
						password = '" .$password ."',
						email = '" .$email ."',
						level = '" .$level ."'
                        " .($level=='U' ? (",
						member_id = '" .$member_id ."'")
                        : "" )."
						WHERE username = '".$id."'" ;
    $check = checkValid($username, $email, $id) ? "True" : "False";
    if ($check=="True" and mysqli_query($con, $accountSQL)) 
        Header("Location: ../../table/select/accounts.php");
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/accounts.php";</script>';
}
else 
    echo '<script>window.history.back();</script>';
mysqli_close($con);
?>
