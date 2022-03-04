<?php
session_start();
include("../includes/connection.php");
$check = false;
$count = 0;
foreach ($_GET as $key => $value)
    if (str_contains($key, "booking") or str_contains($key, "id") or str_contains($key, "room"))
        $count++;
$check = $count == 3;
if (!$check) {
    echo '<script>window.history.back();</script>';
    return;
}
$booking_id = trim($_GET['booking']);
$member_id = trim($_GET['id']);
$room_id = trim($_GET['room']);
$bookingSQL =   "DELETE FROM booking WHERE booking_id = '" . $booking_id . "'";
$memberSQL = "DELETE FROM member WHERE member_id = '" . $member_id . "'";
if (mysqli_query($con, $bookingSQL) and mysqli_query($con, $memberSQL)) {
    unset($_SESSION['room_id']);
    $use_room = "SELECT count(*) as counts FROM member WHERE room_id = '" . $room_id . "'";
    $useSQL = mysqli_query($con, $use_room);
    $use = 0;
    while ($row = mysqli_fetch_array($useSQL))
        $use = $row['counts'];

    $setStatus = $use==0 ? 'A' : 'B' ;
    
    $roomSQL = "UPDATE room SET rental_status = '".$setStatus."' WHERE room_id = '".$room_id."'";
    mysqli_query($con, $roomSQL);

    Header("Location: ../book.php");
} else
    echo '<script>window.history.back();</script>';
mysqli_close($con);