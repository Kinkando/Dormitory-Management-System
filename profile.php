<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/connection.php');
if (isset($_SESSION["username"]) and ($_SESSION['level'] == 'A') == 1) {
    Header("Location: table/select/members.php");
} else if (!isset($_SESSION["username"])) {
    Header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anwari Dormitory - Profile</title>
</head>

<style>
    .info-button:focus {
        background-color: #8080ff;
        outline: none;
    }

    .password-button:focus {
        background-color: #00b300;
        outline: none;
    }

    .info-button {
        margin-top: 5px;
        width: 150px;
        height: 30px;
        border: none;
        background-color: #4e73df;
        font-size: 16px;
        color: #ffffff;
        cursor: pointer;
        text-align: center;
        border-radius: 10px;
    }

    .password-button {
        margin-top: 5px;
        width: 150px;
        height: 30px;
        border: none;
        background-color: #00cc00;
        font-size: 16px;
        color: #ffffff;
        cursor: pointer;
        text-align: center;
        border-radius: 10px;
    }
</style>

<body>
    <div class="bg"><br><br><br><br>
        <div class="container">

            <div class="section-title" data-aos="fade-up"><br>
                <h2>Profile</h2>
                <h3><span><?php print_r($_SESSION['User']); ?></span></h3>
            </div>
            <div class="card shadow mb-4" data-aos="fade-up" style="width:620px; border-radius: 25px; top: 85%; left: 26.5%;">
                <div class="card-header py-3">
                    <div style="text-align:right;">
                        <h5 style="float:left; margin-top: 8px; color:#4e73df;">Member ID : <?php print_r($_SESSION['member_id']); ?></h5>
                        <a href="profile-change-info.php"><input type="submit" name="ChangeInfo" value="Change Info" class="info-button"></a>
                        <a href="profile-change-password.php"><input type="submit" name="ChangePassword" value="Change Password" class="password-button"></a>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;">
                    <?php
                    $infoSQL =  "SELECT firstname, lastname, gender, tel_no, email FROM memberdetail LEFT JOIN account ON memberdetail.member_id = account.member_id 
                                WHERE memberdetail.member_id = '" . $_SESSION['member_id'] . "'";
                    $objQuery = mysqli_query($con, $infoSQL);
                    $row = mysqli_fetch_array($objQuery);
                    ?>
                    <table class="table table-hover" style="width:100%; text-align:left;">
                        <tr>
                            <td>First Name</td>
                            <?php echo "<td>" . $row["firstname"] .  "</td> "; ?>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <?php echo "<td>" . $row["lastname"] .  "</td> "; ?>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <?php echo "<td>" . ($row["gender"] == 'M' ? "Male" : "Female") . "</td> "; ?>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <?php echo "<td>" . $row["email"]    .  "</td> "; ?>
                        </tr>
                        <tr>
                            <td>Telephone Number</td>
                            <?php echo "<td>" . $row["tel_no"]   .  "</td> "; ?>
                        </tr>
                    </table>
                </div>
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