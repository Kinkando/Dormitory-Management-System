<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/connection.php');
if (isset($_SESSION["username"]) and ($_SESSION['level'] == 'A') == 1) {
    Header("Location: table/select/members.php");
}
else if (!isset($_SESSION['room_id']) or !isset($_SESSION['member_id'])) {
    Header("Location: index.php");
    return;
}
$bookingStatus = "SELECT booking_status FROM booking WHERE member_id = '" . $_SESSION["member_id"] . "'";
$statusQuery = mysqli_query($con, $bookingStatus);
$status = false;
if ($statusQuery->num_rows > 0)
    while ($row = mysqli_fetch_assoc($statusQuery))
        $status = $row["booking_status"] == 'P';
$billCount = 0;
if ($status) {
    $bills = "SELECT count(*) as counts FROM bill WHERE room_id = '" . $room_id . "'";
    $billsQuery = mysqli_query($con, $bills);
    if ($billsQuery->num_rows > 0)
        while ($row = mysqli_fetch_assoc($billsQuery))
            $billCount = $row["counts"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anwari Dormitory - Payment</title>
</head>

<style>
    input[type="button"] {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: #ffffff;
        text-align: left;
        width: 91%;
    }

    button:focus {
        outline: none;
    }

    .paid-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        width: 100px;
        height: 100%;
        border-radius: 25px;
    }

    .not-paid-button {
        background-color: #cc0000;
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        width: 100px;
        height: 100%;
        border-radius: 25px;
    }
</style>

<body>
    <div class="bg"><br><br><br><br>
        <div class="container">
            <div class="section-title" data-aos="fade-up"><br>
                <h2>Payment</h2>
                <h3>Anwari <span>Dormitory</span></h3>
                <?php
                if($billCount==0) {
                ?>
                    <p>Booking Detail</p><br>
                    <?php $sql = "SELECT booking_id, room_id, member_id, booking_date, check_in, check_out, booking_status 
                                  FROM booking WHERE member_id='" . $_SESSION['member_id'] . "' ORDER BY booking_id asc";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result)
                    ?>
                    <div class="card shadow mb-4" data-aos="fade-up" style="width:480px; border-radius: 25px; position: fixed; top: 85%; left: 31.75%;">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary"><?php echo strlen($room_id) > 0 ? "Room : " . $room_id : "Invalid Room"; ?></h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover table-bordered" style="text-align:left;">
                                <tr>
                                    <td>Booking ID</td>
                                    <?php echo "<td>" . $row["booking_id"] .  "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Room ID</td>
                                    <?php echo "<td>" . $row["room_id"] .  "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Member ID</td>
                                    <?php echo "<td>" . $row["member_id"] . "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Booking Date</td>
                                    <?php echo "<td>" . $row["booking_date"]    .  "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Check in</td>
                                    <?php echo "<td>" . $row["check_in"]   .  "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Check out</td>
                                    <?php echo "<td>" . $row["check_out"]   .  "</td> "; ?>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <?php
                                    echo "<td>" . ($row["booking_status"] == 'P' ? "Paid" : "Not Paid");
                                    if ($row["booking_status"] == 'N')
                                        echo "<a href='validate/book-cancel.php?booking=" . $row["booking_id"] . "&id=" . $row["member_id"] . "&room=" . $row["room_id"] . "'>
                                                <button style=float:right name=edit type=submit onclick=\"return confirm('Do you want to cancel your booking contract?')\" class=not-paid-button >Cancel</button></CENTER></a></td></tr>"; ?>
                                </tr>

                            </table>
                        </div>
                    </div>
            </div>
        <?php
                } else {
        ?>
            <p>Bill Details</p><br>
            <?php
                    $getRoom = "SELECT room_id FROM member WHERE member_id = '" . $_SESSION["member_id"] . "'";
                    $getRoomSQL = $con->query($getRoom);
                    $fetch = mysqli_fetch_array($getRoomSQL);
                    $room_id = $getRoomSQL->num_rows > 0 ? $fetch["room_id"] : "";
                    $sql = "SELECT bill_id, month_routine, room_price, net_summary, bill_status, date_format(month_routine,'%M %Y') as MONTH FROM 
                                    bill JOIN room ON bill.room_id = room.room_id WHERE bill.room_id = '" . $room_id . "' ORDER BY bill_id asc";
                    $result = $con->query($sql);
            ?>

            <div class="card shadow mb-4" data-aos="fade-up" style="border-radius:25px;">
                <div class="card-header py-3">
                    <form action="../add/bills_add.php">
                        <h5 class="m-0 font-weight-bold text-primary"><?php echo strlen($room_id) > 0 ? "Room : " . $room_id : "Invalid Room"; ?></h5>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>
                                        <CENTER>Bill ID</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Month Routine</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Room Price</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Water Cost</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>TV Cable</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Electricity</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Net Summary</CENTER>
                                    </th>
                                    <th>
                                        <CENTER>Bill Status</CENTER>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td><CENTER>" . $row["bill_id"] .  "</CENTER></td> ";
                                    echo "<td><CENTER>" . $row["MONTH"] .  "</CENTER></td> ";
                                    echo "<td><CENTER>" . $row["room_price"]  .  "</CENTER></td> ";
                                    echo "<td><CENTER>300</CENTER></td> ";
                                    echo "<td><CENTER>100</CENTER></td> ";
                                    echo "<td><CENTER>" . ($row["net_summary"] - 400 - $row["room_price"])  .  "</CENTER></td> ";
                                    echo "<td><CENTER>" . number_format($row["net_summary"]) .  "</CENTER></td> ";
                                    echo "<td><CENTER><button name=edit type=file class=" . (($row["bill_status"] == 'N')
                                        ? "not-paid-button disabled >Not " : "paid-button disabled >") .
                                        "Paid</button></CENTER></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <?php
                } ?>
        </div>
    </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>

