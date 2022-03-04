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
    <title>Anwari Dormitory - Sign in</title>
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

    .login {
        width: 400px;
        background-color: #ffffff;
        box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
        margin: 100px auto;
    }

    .login h1 {
        text-align: center;
        color: #5b6574;
        font-size: 24px;
        padding: 20px 0 20px 0;
        border-bottom: 1px solid #dee0e4;
    }

    .login form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 20px;
    }

    .login form label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #3274d6;
        color: #ffffff;
    }

    .login form input[type="password"],
    .login form input[type="text"] {
        width: 310px;
        height: 50px;
        border: 1px solid #dee0e4;
        margin-bottom: 20px;
        padding: 0 15px;
    }

    .login form input[type="submit"] {
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

    .login form input[type="submit"]:hover {
        background-color: #2868c7;
        transition: background-color 0.2s;
    }
    .login form input[type="submit"]:focus {
        background-color: #3333ff;
        transition: background-color 0.2s;
    }
</style>

<body><br>
    <div class="login" data-aos="zoom-out" data-aos-delay="100" style="border-radius: 25px;">
        <h1><img src="assets/img/log-in-icon.png" alt="" style="width:30px; height:30px; margin-top:-5px;"> Sign in</h1>
        <form action="validate/login.php" method="post">
            <input type="text" name="Username" placeholder="Enter username or email" id="username" title="Username or email" required >
            <input type="password" name="Password" placeholder="Enter password" id="password" title="Password" required >
            <h6 style="float:center;text-align:center;"><a class="small" href="sign-up.php">Create an account!</a></h6>
            <input type="submit" name="Login" value="Login" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 23px;outline:none;">
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