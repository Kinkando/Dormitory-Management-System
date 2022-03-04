<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($Username, $Level, $Member_ID, $Email) {
    include("../../includes/connection.php");
    $sql = "SELECT username FROM account WHERE username = '".$Username."'";
    $result = $con->query($sql);
    $emailSQL = "SELECT email FROM account WHERE email = '".$Email."'";
    $repeatEmail = $con->query($emailSQL);
    if ($result->num_rows > 0) {
        echo '<script>alert("Repeat Username");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    else if($repeatEmail->num_rows > 0) {
        echo '<script>alert("Repeat Email");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    else if((strlen($Member_ID)!=6 || !like_match("M%",$Member_ID)) and $Level == 'U') {
        echo '<script>alert("Invalid Member ID");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    else if(!str_contains($Email,"@hotmail.com") && !str_contains($Email,"@gmail.com")) {
        echo '<script>alert("Invalid Email");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    $domain = str_contains($Email,"@hotmail.com") ? substr($Email, strpos($Email,"@hotmail.com")) :  
              substr($Email, strpos($Email,"@gmail.com"));
    if(strtolower($domain)!="@hotmail.com" and strtolower($domain)!="@gmail.com" or $Email=="@hotmail.com" or $Email=="@gmail.com") {
        echo '<script>alert("Invalid Email");window.location.href="../../table/select/accounts.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["username"])) {
    $Username = trim($_POST["username"]);
    $Password = trim($_POST["password"]);
    $Level = trim($_POST["level"]);
    $Member_ID = isset($_POST["memberID"]) ? strtoupper(trim($_POST["memberID"])) : "";
    $Email = trim($_POST["email"]);
    $accountSQL = "INSERT INTO account(Username, Password, Email, Level".($Level=='U' ? ", Member_ID" : ""). ") 
                VALUES('$Username', '$Password', '$Email', '$Level'".($Level=='U' ? ", '$Member_ID' " : "").")";  
    $check = checkValid($Username, $Level, $Member_ID, $Email) ? "True" : "False";
    if ($check=="True" and mysqli_query($con, $accountSQL))
        Header("Location: ../../table/select/accounts.php");
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/accounts.php";</script>';
}
else 
  echo '<script>window.history.back();</script>';
mysqli_close($con);
?>
