<?php
include('includes/header.php');
include('includes/navbar.php');
if (isset($_SESSION["username"]) and ($_SESSION['level'] == 'A') == 1) {
    Header("Location: table/select/members.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anwari Dormitory - Home</title>
</head>

<body>
    <div class="bg">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1 style="color:black;"><br><br><br><br><br><br><b>Welcome to <span>Anwari Dormitory</b><br><br></span></h1>
            <?php
            include('includes/navicon.php');
            ?>
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