<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($room_id, $firstname, $lastname, $member_id, $tel_no) {
    include("../../includes/connection.php");
    $sql = "SELECT member.member_id FROM member ORDER BY member.member_id asc";
    $result = $con->query($sql);
    for($i=0;$i<strlen($tel_no);$i++) {
        if(!is_numeric($tel_no)) {
            echo '<script>alert("Invalid Telephone Number");window.location.href="../../table/select/members.php";</script>';
            return false;
        }
    }
    while ($row = mysqli_fetch_array($result)) {
        if ($row["member_id"] == $member_id) {
            echo '<script>alert("Repeat Member ID");window.location.href="../../table/select/members.php";</script>';
            return false;
        }
    }
    if(strlen($member_id)!=6 || !like_match("M%",$member_id)) {
        echo '<script>alert("Invalid Member ID");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    else if(!is_numeric(substr($member_id,1))) {
        echo '<script>alert("Invalid Member ID");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    else if(strlen($room_id)>6) {
        echo '<script>alert("Invalid Room");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    else if(strlen($firstname)==0 || strlen($lastname)==0){
        echo '<script>alert("Invalid Name");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    else if(strlen($tel_no)!=10) {
        echo '<script>alert("Invalid Telephone Number");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["memberID"])) {
    $member_id = strtoupper(trim($_POST["memberID"]));
    $room_id = trim($_POST["roomID"]);
    $firstname = trim($_POST["firstName"]);
    $lastname = trim($_POST["lastName"]);
    $gender = (like_match('2%',$room_id) or $room_id=="Male") ? "M" : "F";
    $tel_no = trim($_POST["telNO"]);
    $memberdetailSQL = "INSERT INTO memberdetail VALUES( 
                        '". $member_id ."',
                        '" .$firstname ."',
                        '" .$lastname ."',
                        '" .$gender ."',
                        '" .$tel_no ."')" ;
    $memberSQL =   "INSERT INTO member VALUES ('" .$member_id ."', '". $room_id ."')";
    $check = checkValid($room_id, $firstname, $lastname, $member_id, $tel_no) ? "True" : "False";
    if ($check=="True" and mysqli_query($con, $memberdetailSQL)) {
        if(is_numeric($room_id))
            mysqli_query($con, $memberSQL);
        Header("Location: ../../table/select/members.php");
    }
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/members.php";</script>';
}
else 
  echo '<script>window.history.back();</script>';
mysqli_close($con);
?>
