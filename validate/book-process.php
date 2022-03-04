<?php
session_start();
include("../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function generate_booking_id()
{
    include("../includes/connection.php");
    $sql = "SELECT booking_id FROM booking ORDER BY booking_id asc";
    $result = $con->query($sql);
    $bookingID = "";
    while ($row = mysqli_fetch_array($result))
        $bookingID = $row['booking_id'];
    $bookingID = strlen($bookingID)==0 ? "B00001" : sprintf('B%05d', ((int)substr($bookingID, 1)) + 1);
    return $bookingID;
}
if (isset($_POST['Submit'])) {
    date_default_timezone_set('Asia/Bangkok');
    $t = time();
    $booking_id = generate_booking_id();
    $member_id = $_SESSION['member_id'];
    $room_id = $_POST['room_id'];
    $booking_date = date('Y-m-d', $t);
    $check_in = trim($_POST['checkIn']);
    $check_out = strlen(trim($check_in)) > 0 ? trim($_POST['checkIn']) : "";
    if (strlen($check_in) > 0) {
        $year = substr($check_in, 0, 4);
        $check_out = date("Y-m-d", strtotime($check_in.'+ 1 years - 1 days'));
    }
    $bookingSQL =   "INSERT INTO booking VALUES ( 
                '" . $booking_id . "' ,'" . $room_id . "' ,'" . $member_id . "' ,
                '" . $booking_date . "' ,'" . $check_in . "' ,'" . $check_out . "', 'N')";
    if (mysqli_query($con, $bookingSQL)) {
        $_SESSION['room_id'] = $_POST['room_id'];
        $priceSQL = "SELECT room_price FROM room WHERE room_id='".$room_id."'";
        $priceQuery = $con->query($priceSQL);
        $price = 0;
        while ($row = mysqli_fetch_array($priceQuery))
            $price = $row['room_price'];
            
        $use_room = "SELECT count(*) as counts FROM member WHERE room_id = '" . $room_id . "'";
        $useSQL = mysqli_query($con, $use_room);
        $use = 0;
        while ($row = mysqli_fetch_array($useSQL))
            $use = $row['counts'];

        $setStatus = (($price==7000 and $use==3) or ($price!=7000 and $use==1)) ? 'U' : 'B' ;

        $memberSQL =   "INSERT INTO member VALUES ('" . $member_id . "' ,'" . $room_id . "')";
        $roomSQL = "UPDATE room SET rental_status = '".$setStatus."' WHERE room_id = '".$room_id."'";        
        mysqli_query($con, $memberSQL);
        mysqli_query($con, $roomSQL);
        Header("Location: ../payment.php");
    } else
        echo '<script>alert("Error!!");window.history.back();</script>';
}
else {
    Header("Location: ../index.php");
    return;
}
mysqli_close($con);