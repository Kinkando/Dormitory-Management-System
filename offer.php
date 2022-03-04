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
    <title>Anwari Dormitory - Offer</title>
</head>

<body>
    <div class="bg2"><br><br><br><br>
        <div class="container" data-aos="fade-up" style="background: rgba(230, 255, 255, 0.8);display: block; border:none; border-radius: 25px;">
            <div class="section-title">
                <br>
                <h2>Offer</h2>
                <h3>Anwari <span>Dormitory</span></h3>
                <p>In the first time you choose to live in anwari dormitory, you must know these</p>
            </div>

            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-left" data-aos-delay="100">
                    <h3 style="color:red;"><?php echo str_repeat("&nbsp;", 8); ?>Special Offers <?php echo str_repeat('&nbsp;', 20); ?>
                        <img src="assets/img/offer.png" alt="" style="width:150px; height:150px;">
                    </h3>
                    <p class="fst-italic">
                        <?php echo str_repeat("&nbsp;", 15); ?>For new member
                    </p>
                    <ul>
                        <div>
                            <h5>
                                <?php echo str_repeat("&nbsp;", 8); ?>&#10003;&nbsp;Insurance money 10,000 ฿</h5>
                            <h5>
                                <?php echo str_repeat("&nbsp;", 8); ?>&#10003;&nbsp;Room Price</h5>
                            <p><?php echo str_repeat("&nbsp;", 15); ?>- Normal room 4,500 ฿<br>
                                <?php echo str_repeat("&nbsp;", 15); ?>- Corner room 4,800 ฿<br>
                                <?php echo str_repeat("&nbsp;", 15); ?>- VIP room 7,000 ฿</p>
                            <h5>
                                <?php echo str_repeat("&nbsp;", 8); ?>&#10003;&nbsp;Key card 200 ฿ per person</h5>
                            <h5>
                                <?php echo str_repeat("&nbsp;", 8); ?>&#10003;&nbsp;Electricity cost 6 ฿ per unit</h5>
                            <h5>
                                <?php echo str_repeat("&nbsp;", 8); ?>&#10003;&nbsp;Water cost 150 ฿ per person</h5>
                        </div>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-right" data-aos-delay="100">
                    <h3 style="color:blue;">Convenience Equipments <?php echo str_repeat('&nbsp;', 15); ?>
                        <img src="assets/img/furniture.png" alt="" style="width:200px; height:200px;">
                    </h3>
                    </h3>
                    <p class="fst-italic">
                        It consists of standard furniture as follows
                    </p>
                    <ul>
                        <div>
                            <h5>
                                &#10003;&nbsp;Bed (Can set the number up to 2 beds)</h5>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Twin bed (3.5 feet) for 1 person<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Full bed (6 feet) size up to 2 people</p>
                            <h5>
                                &#10003;&nbsp;Wardrobe</h5>
                            <h5>
                                &#10003;&nbsp;Table and Chair 2 sets</h5>
                            <h5>
                                &#10003;&nbsp;TV Cable</h5>
                            <h5>
                                &#10003;&nbsp;Refrigerator</h5>
                            <h5>
                                &#10003;&nbsp;Home phone</h5>
                            <h5>
                                &#10003;&nbsp;Dormitory WiFi (300 ฿ per month)</h5>
                            <h5>
                                &#10003;&nbsp;Bathroom include mirror, toilet, basin and shower</h5>
                        </div>
                    </ul>
                </div>

            </div>

            <div class="section-title">
                <h3><br>Convenience <span>Equipments</span> in the <span>room</span></h3><br>
                <div data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/female-1.jpg" alt="" style="width:510px; height:290px; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/female-2.jpg" alt="" style="width:510px; height:290px; border-radius:25px;"><br><br>
                    <img src="assets/img/female-3.jpg" alt="" style="width:510px; height:290px; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/female-4.jpg" alt="" style="width:510px; height:290px; border-radius:25px;"><br><br>
                    <img src="assets/img/female-5.jpg" alt="" style="width:510px; height:290px; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/female-6.jpg" alt="" style="width:510px; height:290px; border-radius:25px;"><br><br>
                    <img src="assets/img/furniture-1.jpg" alt="" style="width:510px; height:290px; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/furniture-2.jpg" alt="" style="width:510px; height:290px; border-radius:25px;"><br><br>
                    <img src="assets/img/bathroom-1.jpg" alt="" style="width:510px; height:290px; border-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="assets/img/bed-pair-1.jpg" alt="" style="width:510px; height:290px; border-radius:25px;"><br><br>
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