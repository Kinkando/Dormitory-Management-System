<?php include("../../includes/connection.php");
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
function checkValid($id, $bill_id, $room_id, $month_routine, $net_summary)
{
    include("../../includes/connection.php");
    $sql = "SELECT bill_id, room_price FROM bill JOIN room ON bill.room_id = room.room_id ORDER BY bill_id asc";
    $result = $con->query($sql);
    $month = "SELECT count(*) AS counts FROM bill WHERE room_id = '".$room_id."' AND month_routine = '".$month_routine."' and bill_id != '".$id."'";
    if(strlen($bill_id)!=6 or !like_match("R%",$bill_id) or !is_numeric(substr($bill_id,1))) {
        echo '<script>alert("Invalid Bill ID");window.location.href="../../table/select/bills.php";</script>';
        return false;
    }
    while ($row = mysqli_fetch_array($result)) {
        if ($row["bill_id"] == $bill_id and $bill_id != $id) {
            echo '<script>alert("Repeat Bill ID");window.location.href="../../table/select/bills.php";</script>';
            return false;
        }
        else if ( (int)$net_summary < ($row["room_price"] + 400 )) {
            echo '<script>alert("Invalid Room Price");window.location.href="../../table/select/bills.php";</script>';
            return false;
        }
    }
    $repeatMonth = $con->query($month);
    $useCount = 0;
    while ($row = mysqli_fetch_array($repeatMonth)) 
        $useCount = (int)$row["counts"];
    if ($useCount>0) {
        echo '<script>alert("Repeat Month Routine");window.location.href="../../table/select/bills.php";</script>';
        return false;
    }
    return true;
}
if(isset($_POST["id"])) {
    $id = strtoupper(trim($_POST["id"]));
    $bill_id = strtoupper(trim($_POST["billID"]));
    $room_id = $_POST["roomID"];
    $month_routine = strlen(trim($_POST["date"])) > 0 ? date('Y-m-01',strtotime(trim($_POST["date"]))) : "";
    $net_summary = trim($_POST["netSummary"]);
    $status = trim($_POST["status"]) == "Paid" ? 'P' : 'N';
    $billSQL =   "UPDATE bill SET 
                    bill_ID = '" . $bill_id . "' ,
                    month_routine = '" . $month_routine . "' ,
                    net_summary = " . $net_summary . ",
                    bill_status = '" .$status. "' 
                    WHERE bill_id = '" . $id . "'";
    $check = checkValid($id, $bill_id, $room_id, $month_routine, $net_summary);
    if ($check == "True" and mysqli_query($con, $billSQL)) {
        Header("Location: ../../table/select/bills.php");
    } else
        echo '<script>alert("Error!!");window.location.href="../../table/select/bills.php";</script>';
}
else 
    echo '<script>window.history.back();</script>';
mysqli_close($con);
