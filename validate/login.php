<?php
session_start();
if (isset($_POST['Login'])) {
    include("../includes/connection.php");
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $sql = "SELECT username, password, email, level, member_id 
                    FROM Account Where (Username='" . $Username . "' or Email='" . $Username . "') and Password='" . $Password . "' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION["level"] = $row["level"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["Email"] = $row["email"];
        $check = strcmp($Password, $row['password']);
        if ($check != 0) {
            echo '<script>alert("Password wrong!!");window.history.back();</script>';
            return;
        } else {
            if ($_SESSION["level"] == "A") { 
                Header("Location: ../table/select/members.php");
            } else {
                $detail = "SELECT Firstname, Lastname, Gender, Tel_no, Room_ID FROM memberdetail LEFT JOIN member on 
                           memberdetail.member_id = member.member_id WHERE memberdetail.member_id = '" . $row["member_id"] . "'";
                $info = mysqli_query($con, $detail);
                $fetch = mysqli_fetch_array($info);
                $_SESSION["member_id"] = $row["member_id"];
                $_SESSION["User"] = $fetch["Firstname"] . " " . $fetch["Lastname"];
                $_SESSION["Firstname"] = $fetch["Firstname"];
                $_SESSION["Lastname"] = $fetch["Lastname"];
                $_SESSION["Gender"] = $fetch["Gender"];
                $_SESSION["Tel_no"] = $fetch["Tel_no"];
                $_SESSION["room_id"] = $fetch["Room_ID"];
                Header("Location: ../index.php");
            }
            return;
        }
    } else {
        echo "<script>";
        if (strlen($Username) == 0 or strlen($Password) == 0)
            echo "alert(\"Invalid Username or Password!!\");";
        else
            echo "alert(\"Username or Password Wrong!!\");";
        echo "window.history.back()";
        echo "</script>";
        return;
    }
} else {
    Header("Location: logout.php");
    return;
}
