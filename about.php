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
    <title>Anwari Dormitory - About</title>
</head>

<body>
    <div class="bg2"><br><br><br><br>
        <div class="container" data-aos="fade-up" style="background: rgba(230, 255, 255, 0.8);display: block; border:none; border-radius: 25px;">
            <div class="section-title">
                <br>
                <h2>About</h2>
                <h3>Anwari <span>Dormitory</span></h3>
                <p>Have 2 buildings that separate with male and female gender</p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <img src="assets/img/tivalai-2.jpg" class="img-fluid" alt="" style="height:120; overflow:none; border-radius:25px;">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">

                    <h3><?php echo str_repeat("&nbsp;", 15); ?>About Room
                        <?php echo str_repeat("&nbsp;", 2); ?><img src="assets/img/room.png" class=class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" alt="" style="width:200px; height:200px; ">
                    </h3>
                    <p class="fst-italic"><?php echo str_repeat("&nbsp;", 18); ?>
                        Have 3 different prices that depend on room type such as
                    </p>
                    <ul>
                        <div>
                            <h5>Normal room (4500 ฿) for 2 people</h5>
                            <p>The total area is approximately 23 square meters.</p>
                        </div>
                        <div>
                            <h5>Corner room (4800 ฿) for 2 people</h5>
                            <p>The total area is approximately 28 square meters.
                                Corner room is wider than normal room and have a big balcony that no wall on one side.</p>
                        </div>
                        <div>
                            <h5>VIP room (7000 ฿) for 4 people</h5>
                            <p>The total area is approximately 45 square meters. The widest special room can accommodate a maximum of 4 people.</p>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="section-title">
                <h3><br><br>Surrounding <span>Dormitory</span> Environment</h3><br>
                <div style="text-align: center;" data-aos="fade-right" data-aos-delay="100">

                    <div class="row justify-content-center">
                        <ul>
                            <p>There is a laundry shop under the dormitory</p>
                            <p>There are many tables for sitting or resting</p>
                            <p>There is a car park in front of the dormitory</p>
                            <p>There is a motorcycle parking under the dormitory</p>
                            <p>There are 10 washing machines under the dormitory</p>
                            <p>There is a convenience store in front of the dormitory (7-Eleven)<br><br></p>
                        </ul>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">\
                    <img src="assets/img/Tivalai-3.jpg" alt="" style="width:40%; height:40%; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/Tivalai-4.jpg" alt="" style="width:40%; height:40%; border-radius:25px;"><br><br>
                    <img src="assets/img/Tivalai-5.jpg" alt="" style="width:40%; height:40%; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/Tivalai-8.jpg" alt="" style="width:40%; height:385px; border-radius:25px;"><br><br>
                    <img src="assets/img/Tivalai-7.jpg" alt="" style="width:40%; height:40%; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/Tivalai-6.jpg" alt="" style="width:40%; height:40%; border-radius:25px;"><br><br>
                </div>
            </div>
        </div><br>
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