<?php include("../../includes/connection.php"); ?>
<?php
$ID = trim($_GET["ID"]);
$table = trim($_GET["table"]);
$condition = trim($_GET["condition"]);
$directory = trim($_GET["directory"]);
$SQL = "DELETE FROM " . $table . " WHERE " . $condition . " = '".$ID."'";
$room_id = isset($_GET["room_id"])  ? trim($_GET["room_id"]) : "";
if (mysqli_query($con, $SQL)) {
    if($table=="booking") {
        date_default_timezone_set('Asia/Bangkok');
        $t = time();
        $current = date('Y-m-d', $t);
        $count = 0;
        $residentSQL = "SELECT count(*) AS counts FROM room JOIN booking ON 
                        room.room_id = booking.room_id WHERE room.room_id = '".$room_id."'
                        AND check_out > '".$current."'";
        $resident = $con->query($residentSQL);
        while ($row = mysqli_fetch_array($resident))
            $count = (int)$row["counts"];
        $rental = $count==0 ? "A" : "B";
        $changeSQL = "UPDATE room SET rental_status = '".$rental."' WHERE room_id = '".$room_id."'";
        mysqli_query($con, $changeSQL);
    }
    echo "Delete Successful";
} else {
    echo "Error: " . $SQL . "<br>" . mysqli_error($con);
}
mysqli_close($con);
Header("Location: ../../table/select/".$directory);
?>
