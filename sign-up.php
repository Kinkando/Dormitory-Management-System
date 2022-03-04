<?php
include('includes/header.php');
include('includes/navbar.php');
if(isset($_SESSION["username"]) and ($_SESSION['level']=='A')==1) {
    Header("Location: table/select/members.php"); 
}
foreach ($_SESSION as $key => $value) 
    if (str_contains($key, "username")) 
        Header("Location: validate/logout.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anwari Dormitory - Sign up</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<style>
    body {
        background-image: url('assets/img/dormitory.jpg');
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-background-size: cover;
        background-size: cover;
        background-attachment: fixed;
        height: 840px;
        overflow: scroll;
        background-color: rgba(255, 255, 255, 0.6);
        background-blend-mode: overlay;
    }

    .signup {
        width: 750px;
        background-color: #ffffff;
        box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
        margin: 100px auto;
    }

    .signup h1 {
        text-align: center;
        color: #5b6574;
        font-size: 24px;
        padding: 20px 0 20px 0;
        border-bottom: 1px solid #dee0e4;
    }

    .signup form {
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 20px;
    }

    .signup form label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #3274d6;
        color: #ffffff;
    }

    .signup form input[type="password"],
    .signup form input[type="text"],
    .signup form input[type="email"],
    .signup form input[name="Gender"] {
        width: 310px;
        height: 50px;
        border: 1px solid #dee0e4;
        margin-bottom: 20px;
        padding: 0 15px;
    }

    .signup form input[type="submit"] {
        width: 100%;
        padding: 15px;
        margin-top: 20px;
        background-color: #3274d6;
        border: 0;
        cursor: pointer;
        font-weight: bold;
        color: #ffffff;
        transition: background-color 0.2s;
    }

    .signup form input[type="submit"]:hover {
        background-color: #2868c7;
        transition: background-color 0.2s;
    }
    .signup form input[type="submit"]:focus {
        background-color: #3333ff;
        transition: background-color 0.2s;
    }

    .signup form input[type="Username"],
    .signup form input[name="FirstName"],
    .signup form input[name="Password"],
    .signup form input[name="Email"] {
        margin-right: 10px;
    }
</style>

<script>
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }
</script>

<body><br>
    <div class="signup" data-aos="zoom-out" data-aos-delay="100" style="border-radius: 25px;">
        <h1><img src="assets/img/log-in-icon.png" alt="" style="width:30px; height:30px; margin-top:-5px;"> Sign up</h1>
        <form action="validate/register.php" method="post">
            <?php echo str_repeat("&nbsp;", 8); ?><input type="text" name="Username" title="Username" required placeholder="Username" minlength=6 maxlength=20>
            <?php echo str_repeat("&nbsp;", 11); ?>Gender :
            <?php echo str_repeat("&nbsp;", 4); ?><input type="checkbox" id="check" name="check" value="Male" onclick="onlyOne(this)"> Male
            <?php echo str_repeat("&nbsp;", 3); ?><input type="checkbox" id="check" name="check" value="Female" onclick="onlyOne(this)"> Female
            <br><?php echo str_repeat("&nbsp;", 8); ?><input type="password" name="Password" title="Password" required placeholder="Password" minlength=6 maxlength=20>
            <?php echo str_repeat("&nbsp;", 8); ?><input type="password" name="ConfirmPassword" title="Confirm Password" required placeholder="Confirm Password" minlength=6 maxlength=20>
            <br><?php echo str_repeat("&nbsp;", 8); ?><input type="text" name="FirstName" title="First Name" required pattern="[a-zA-Z]{1,}" placeholder="First Name">
            <?php echo str_repeat("&nbsp;", 8); ?><input type="text" name="LastName" title="Last Name" required pattern="[a-zA-Z]{1,}" placeholder="Last Name">
            <br><?php echo str_repeat("&nbsp;", 8); ?><input type="email" name="Email" title="Email" required placeholder="Email Address" maxlength=50>
            <?php echo str_repeat("&nbsp;", 8); ?><input type="text" name="TelNO" title="Telephone Number" required pattern="[0-9]{1,}" placeholder="Telephone Number" minlength=10 maxlength=10><br>
            <h6 style="float:center;text-align:center;"><a class="small" href="sign-in.php">Have an account already? <span>Go to sign in</span></a></h6>
            <input type="submit" name="Register" value="Register" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 23px;outline:none;">
        </form>
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