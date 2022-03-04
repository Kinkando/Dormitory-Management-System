<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($booking_id, $member_id, $booking_date, $check_in, $check_out /*, $room_id */)
{
    include("../../includes/connection.php");
    $sql = "SELECT booking_id FROM booking ORDER BY booking_id asc";
    $result = $con->query($sql);
    if (strlen($booking_id) != 6 or !like_match("B%", $booking_id) or !is_numeric(substr($booking_id, 1))) {
        echo '<script>alert("Invalid Booking ID");window.location.href="../../table/select/bookings.php";</script>';
        return false;
    }
    while ($row = mysqli_fetch_array($result)) {
        if ($row["booking_id"] == $booking_id) {
            echo '<script>alert("Repeat Booking ID");window.location.href="../../table/select/bookings.php";</script>';
            return false;
        }
    }
    if (strlen($member_id) != 6) {
        echo '<script>alert("Invalid Member ID");window.location.href="../../table/select/bookings.php";</script>';
        return false;
    }
    else if ($booking_date > $check_in or $check_in >= $check_out or $booking_date >= $check_out) {
        echo '<script>alert("Invalid Date");window.location.href="../../table/select/bookings.php";</script>';
        return false;
    }
    // without Room ID POST method
    $dateSQL = "SELECT check_in, check_out FROM booking WHERE member_id = '".$member_id."'";
    $query = $con->query($dateSQL);
    while ($row = mysqli_fetch_array($query)) {
        if (($check_in>=$row["check_in"] and $check_in<=$row["check_out"]) or ($check_out>=$row["check_in"] and $check_out<=$row["check_out"])) {
            echo '<script>alert("You are booking room between these date already, so you can not booking");window.location.href="../../table/select/bookings.php";</script>';
            return false;
        }
    }
    // end of without Room ID POST method
    // with Room ID POST method
    /*
    $roomMatch = "SELECT room_id FROM member WHERE member_id = '" . $member_id . "'";
    $match = $con->query($roomMatch);
    while ($row = mysqli_fetch_array($match)) {
        if($row['room_id'] != $room_id) {
            echo '<script>alert("Room ID does not match with Member ID");window.location.href="../../table/select/bookings.php";</script>';
            return false;
        }
    }
    */
    // end of with Room ID POST method
    return true;
}
if(isset($_POST["bookingID"])) {
    $booking_id = strtoupper(trim($_POST["bookingID"]));
    $member_id = strtoupper(trim($_POST["memberID"]));
    //$room_id = trim($_POST['roomID]);
    $room_id = "";
    date_default_timezone_set('Asia/Bangkok');
    $t = time();
    $current = date('Y-m-d', $t);
    $booking_date = strlen(trim($_POST["bookingDate"])) > 0 ? date('Y-m-d', strtotime(trim($_POST["bookingDate"]))) : "";
    $check_in = strlen(trim($_POST["checkIn"])) > 0 ? date('Y-m-d', strtotime(trim($_POST["checkIn"]))) : "";
    $check_out = strlen(trim($_POST["checkOut"])) > 0 ? date('Y-m-d', strtotime(trim($_POST["checkOut"]))) : "";
    $status = substr(trim($_POST["status"]), 0, 1);
    // Query Room ID From member Table
    if (strlen($member_id) == 6) {
        $roomSQL = "SELECT member_id, room_id FROM member WHERE member_id = '" . $member_id . "' ORDER BY member_id asc";
        $result = $con->query($roomSQL);
        while ($row = mysqli_fetch_array($result))
            $room_id = $row['room_id'];
    }
    // End of query
    $bookingSQL =   "INSERT INTO booking VALUES ( 
                    '" . $booking_id . "' ,'" . $room_id . "' ,'" . $member_id . "' ,
                    '" . $booking_date . "' ,'" . $check_in . "' ,'" . $check_out . "', '" . $status . "')";

    $check = checkValid($booking_id, $member_id, $booking_date, $check_in, $check_out /*, $room_id */);
    if ($check == "True" and mysqli_query($con, $bookingSQL)) {
        $count = 0;
        $price = 0;
        $residentSQL = "SELECT count(*) AS counts, room_price FROM room JOIN booking ON 
                        room.room_id = booking.room_id WHERE room.room_id = '".$room_id."'
                        AND check_out > '".$current."'";
        $resident = $con->query($residentSQL);
        while ($row = mysqli_fetch_array($resident)) {
            $count = (int)$row["counts"];
            $price = (int)$row["room_price"];
        }
        $rental = "A";
        if($current<$check_out)
            $rental = (($price==7000 and $count==4) or ($price!=7000 and $count==2)) ? "U" : "B";
        else
            $rental = $count==0 ? "A" : "B";
        $changeSQL = "UPDATE room SET rental_status = '".$rental."' WHERE room_id = '".$room_id."'";
        mysqli_query($con, $changeSQL);
        Header("Location: ../../table/select/bookings.php");
    } 
    else
        echo '<script>alert("Error!!");window.location.href="../../table/select/bookings.php";</script>';
}
else 
  echo '<script>window.history.back();</script>';
mysqli_close($con);
