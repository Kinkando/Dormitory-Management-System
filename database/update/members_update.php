<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($id, $member_id, $tel_no) {
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
        if ($row["member_id"] == $member_id && $member_id!=$id) {
            echo '<script>alert("Repeat Member ID");window.location.href="../../table/select/members.php";</script>';
            return false;
        }
    }
    if(strlen($member_id)!=6 or !like_match("M%",$member_id) or !is_numeric(substr($member_id,1))) {
        echo '<script>alert("Invalid Member ID");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    else if(strlen($tel_no)!=10) {
        echo '<script>alert("Invalid Telephone Number");window.location.href="../../table/select/members.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["id"])) {
    $id = strtoupper(trim($_POST["id"]));
    $member_id = strtoupper(trim($_POST["memberID"]));
    $room_id = trim($_POST["roomID"]);
	$gender = (like_match('2%',$room_id) or $room_id=="Male") ? "M" : "F";
    $oldRoomID = strtoupper(trim($_POST["oldRoomID"]));
    if(strlen($oldRoomID)==1)
        $oldRoomID = $oldRoomID=='M' ? "Male" : "Female";
	$firstname = strlen(trim($_POST["firstName"]))>0 ? trim($_POST["firstName"]) : trim($_POST["oldFirstName"]);
	$lastname = strlen(trim($_POST["lastName"]))>0 ? trim($_POST["lastName"]) : trim($_POST["oldLastName"]);
	$tel_no = trim($_POST["telNO"]);
    $memberdetailSQL = "UPDATE memberdetail SET  
						member_ID = '". $member_id ."',
						firstName = '" .$firstname ."',
						lastName = '" .$lastname ."'
                        ".($room_id=="Cancel" ? "" : ",gender = '".$gender."'")."
                        ,tel_no = '" .$tel_no ."' 
						WHERE member_ID = '".$id."'" ;
    $check = checkValid($id, $member_id, $tel_no) ? "True" : "False";
    if ($check=="True" and mysqli_query($con, $memberdetailSQL)) {
        if($room_id=="Cancel" and is_numeric($oldRoomID)) { 
            $cancelRoom = "DELETE FROM member WHERE member_id = '".$member_id."'";
            mysqli_query($con, $cancelRoom);
        }
        else if(is_numeric($room_id) and !is_numeric($oldRoomID)) {
            $addRoom =   "INSERT INTO member VALUES ('" .$member_id ."', '". $room_id ."')";
            mysqli_query($con, $addRoom);
        }
        Header("Location: ../../table/select/members.php");
    }
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/members.php";</script>';
}
else 
    echo '<script>window.history.back();</script>';
mysqli_close($con);
?>
