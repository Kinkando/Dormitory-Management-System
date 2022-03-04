<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($id, $room_id, $room_price) {
    include("../../includes/connection.php");
    $sql = "SELECT room_id FROM room ORDER BY room_id asc";
    $result = $con->query($sql);
    if(strlen($room_id)!=4 or !is_numeric($room_id) or (substr($room_id,0,1) != "1" and substr($room_id,0,1) != "2")
       or (substr($room_id,1,1) == "0" or substr($room_id,1,1) > "8")) {
        echo '<script>alert("Invalid Room ID");window.location.href="../../table/select/rooms.php";</script>';
        return false;
    }
    while ($row = mysqli_fetch_array($result)) {
        if ($row["room_id"] == $room_id and $room_id != $id) {
            echo '<script>alert("Repeat Room ID");window.location.href="../../table/select/rooms.php";</script>';
            return false;
        }
    }
    if($room_price<4500){
        echo '<script>alert("Invalid Room Price");window.location.href="../../table/select/rooms.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["id"])) {
	$id = trim($_POST["id"]);
    $room_id = trim($_POST["roomID"]);
    $room_price = trim($_POST["roomPrice"]);
    $rental_status = substr(trim($_POST["rentalStatus"]),0,1);
    $check = checkValid($id, $room_id, $room_price) ? "True" : "False";
    $room_price = (int)$room_price;
	$roomSQL =   "UPDATE room SET 
					room_id = '". $room_id ."', 
					room_price = " .$room_price ."
					,rental_status = '". $rental_status."' 
					WHERE room_id = '".$id."'" ;
    $checkAutoCheckOut = "SELECT member_id FROM member WHERE room_id = '" . $room_id . "'";
    if ($check=="True" and mysqli_query($con, $roomSQL))
        Header("Location: ../../table/select/rooms.php");
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/rooms.php";</script>';
}
else 
    echo '<script>window.history.back();</script>';
mysqli_close($con);
?>
