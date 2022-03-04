<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($id, $booking_id, $member_id, $booking_date, $check_in, $check_out, $oldCheckIn, $oldCheckOut)
{
    include("../../includes/connection.php");
    $sql = "SELECT booking_id FROM booking ORDER BY booking_id asc";
    $result = $con->query($sql);
    if(strlen($booking_id)!=6 or !like_match("B%",$booking_id) or !is_numeric(substr($booking_id,1))) {
        echo '<script>alert("Invalid Booking ID");window.location.href="../../table/select/bookings.php";</script>';
        return false;
    }
    while ($row = mysqli_fetch_array($result)) {
        if ($row["booking_id"] == $booking_id and $booking_id != $id) {
            echo '<script>alert("Repeat Booking ID");window.location.href="../../table/select/bookings.php";</script>';
            return false;
        }
    }
    if ($booking_date > $check_in or $check_in >= $check_out or $booking_date >= $check_out) {
        echo '<script>alert("Invalid Date");window.location.href="../../table/select/bookings.php";</script>';
        return false;
    }
    $dateSQL = "SELECT check_in, check_out FROM booking WHERE member_id = '".$member_id."'";
    $query = $con->query($dateSQL);
    while ($row = mysqli_fetch_array($query)) {
        if ((($check_in>=$row["check_in"] and $check_in<=$row["check_out"]) or ($check_out>=$row["check_in"] and $check_out<=$row["check_out"]))
            and ($oldCheckIn!=$row["check_in"] and $oldCheckOut!=$row["check_out"])) {
            echo '<script>alert("You are booking room between these date already, so you can not booking");window.location.href="../../table/select/bookings.php";</script>';
            return false;
        }
    }
    return true;
}
if(isset($_POST["id"])) {
    $id = strtoupper(trim($_POST["id"]));
    $booking_id = strtoupper(trim($_POST["bookingID"]));
    $room_id = trim($_POST["roomID"]);
    $member_id = trim($_POST["memberID"]);
    date_default_timezone_set('Asia/Bangkok');
    $t = time();
    $current = date('Y-m-d', $t);
    $oldCheckIn = date('Y-m-d',strtotime(trim($_POST["oldCheckIn"])));
    $oldCheckOut = date('Y-m-d',strtotime(trim($_POST["oldCheckOut"])));
    $booking_date = strlen(trim($_POST["bookingDate"])) > 0 ? date('Y-m-d',strtotime(trim($_POST["bookingDate"]))) : "";
    $check_in = strlen(trim($_POST["checkIn"])) > 0 ? date('Y-m-d',strtotime(trim($_POST["checkIn"]))) : "";
    $check_out = strlen(trim($_POST["checkOut"])) > 0 ? date('Y-m-d',strtotime(trim($_POST["checkOut"]))) : "";
    $status = trim($_POST["status"]) == "Paid" ? 'P' : 'N';
    $bookingSQL =   "UPDATE booking SET 
                    booking_ID = '" .$booking_id ."' ,
                    booking_date = '" .$booking_date ."' ,
                    check_in = '" .$check_in ."' ,
                    check_out = '" .$check_out ."', booking_status = '" .$status. "' 
                    WHERE booking_id = '".$id."'" ;
    $check = checkValid($id, $booking_id, $member_id, $booking_date, $check_in, $check_out, $oldCheckIn, $oldCheckOut);
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
    } else
        echo '<script>alert("Error!!");window.location.href="../../table/select/bookings.php";</script>';
}
else 
    echo '<script>window.history.back();</script>';
mysqli_close($con);
