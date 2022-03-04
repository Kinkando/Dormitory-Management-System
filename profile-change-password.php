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
    <title>Anwari Dormitory - Change Password</title>
</head>

<style>
    .back-button:focus {
        background-color: #ff1a1a;
        outline: none;
    }

    .submit-button:focus {
        background-color: #3399ff;
        outline: none;
    }

    .back-button {
        margin-top: 5px;
        width: 100px;
        height: 30px;
        border: none;
        background-color: #ff4d4d;
        font-size: 16px;
        color: #ffffff;
        cursor: pointer;
        text-align: center;
        border-radius: 10px;
    }

    .submit-button {
        margin-top: 5px;
        width: 100px;
        height: 30px;
        border: none;
        background-color: #66b3ff;
        font-size: 16px;
        color: #ffffff;
        cursor: pointer;
        text-align: center;
        border-radius: 10px;
    }

    .isolation-box {
        height: 30px;
        width: 260px;
    }

    .isolation-box:focus {
        outline: none;
    }

    form[name="Form"],
    input[name="Submit"],
    input[name="Back"] {
        display: inline;
    }
</style>

<body>
    <div class="bg"><br><br><br><br>
        <div class="container">

            <div class="section-title" data-aos="fade-up"><br>
                <h2>Change Password</h2>
                <h3><span><?php print_r($_SESSION['User']); ?></span></h3>
            </div>
            <div class="card shadow mb-4" data-aos="fade-up" style="width:620px; border-radius: 25px; top: 85%; left: 26.5%;">
                <div class="card-header py-3">
                    <div style="text-align:right;">
                        <h5 style="float:left; margin-top: 8px; color:#4e73df;">Member ID : <?php print_r($_SESSION['member_id']); ?></h5>
                        <a href="profile.php"><input type="submit" name="Back" value="Back" class="back-button"></a>
                        <form action="validate/profile-password.php" method="post" name="Form">
                            <input type="submit" name="Submit" value="Submit" class="submit-button">
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo trim($_SESSION["member_id"]); ?>" />

                    <p>&nbsp;&nbsp;New Password<?php echo str_repeat("&nbsp;", 48); ?>Confirm New Password<br>
                    <p style="margin-top:-10px;">
                        &nbsp;&nbsp;<input type="password" style="padding-left: 15px; border-radius: 25px; border-style:solid; border-width:1px;" required minlength=6 maxlength=20 class="isolation-box" name="Password" placeholder="New Password">
                        <?php echo str_repeat("&nbsp;", 10); ?>
                        <input type="password" style="padding-left: 15px; border-radius: 25px; border-style:solid; border-width:1px;" required minlength=6 maxlength=20 class="isolation-box" name="ConfirmPassword" placeholder="Confirm New Password"><br>
                    </p>
                    </form>
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