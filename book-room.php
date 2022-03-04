<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/connection.php');
if (isset($_SESSION["username"]) and ($_SESSION['level'] == 'A') == 1) {
    Header("Location: table/select/members.php");
}
else if (isset($_SESSION['room_id']) or !isset($_SESSION['member_id'])) {
    Header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anwari Dormitory - Book Room</title>
</head>
<script>
    function myFunction() {
        window.history.back();
}
    </script>
<body>
    <div class="bg"><br><br>
        <div class="cardz">
            <div class="container" data-aos="fade-up">
                <div class="section-title"><br><br>
                    <h2>Book Room</h2>
                    <h3>Anwari <span>Dormitory</span></h3>
                    <p>
                        <?php
                        echo "Room : " . $_POST['room_id'];
                        ?>
                    </p>
                </div>
                <div class="section-title" data-aos="zoom-out" data-aos-delay="100">
                    <form action="validate/book-process.php" method="post">
                        <?php
                        date_default_timezone_set('Asia/Bangkok');
                        $t = time();
                        ?>
                        <input type='hidden' name='room_id' value="<?php echo $_POST['room_id']; ?>">
                        <div class="form-group">Check in<br>
                            <input class="isolation-box" style="text-align:center;padding-left: 50px; padding-top: 10px;" required id="checkIn" name="checkIn" placeholder="Year-Month-Day" type="date" min="<?php echo date('Y-m-d', $t); ?>" value="<?php echo date('Y-m-d', $t); ?>" />
                        </div><br>
                        <button type="reset" class="block-reset">Reset</button><?php echo str_repeat("&nbsp;", 6); ?>
                        <input type="submit" class="block-submit" name="Submit" value="Submit" onclick="return confirm('Your booking contract is valid for a period of 1 year.')">
                    </form>
                    <br><input type="submit" class="block-back" name="Back" value="Back" onclick="myFunction()">
                    <style>
                        .block-reset {
                            margin-top: 5px;
                            width: 150px;
                            height: 30px;
                            border: none;
                            background-color: #cc0000;
                            font-size: 16px;
                            color: #ffffff;
                            cursor: pointer;
                            text-align: center;
                            border-radius: 50px;
                        }

                        .block-back {
                            margin-top: 5px;
                            width: 330px;
                            height: 30px;
                            border: none;
                            background-color: #2aa22a;
                            font-size: 16px;
                            color: #ffffff;
                            cursor: pointer;
                            text-align: center;
                            border-radius: 50px;
                        }

                        .block-submit {
                            margin-top: 5px;
                            width: 150px;
                            height: 30px;
                            border: none;
                            background-color: #4e73df;
                            font-size: 16px;
                            color: #ffffff;
                            cursor: pointer;
                            text-align: center;
                            border-radius: 50px;
                        }

                        .block-reset:focus,
                        .block-back:focus,
                        .block-submit:focus {
                            outline: none;
                        }

                        .combobox-size {
                            height: 30px;
                        }

                        .twice-box {
                            height: 30px;
                            width: 150px;
                        }

                        .isolation-box {
                            height: 30px;
                            width: 330px;
                            border: none;
                            border-bottom: 2px solid black;
                            background-color: rgba(255, 255, 255, 0);
                            padding-left: 10px;
                        }

                        .isolation-box:focus {
                            outline: none;
                        }

                        .twice-box-id {
                            height: 30px;
                            width: 150px;
                            text-transform: uppercase;
                        }

                        .cardz {
                            width: 450px;
                            height: 420px;
                            text-align: center;
                            background: rgba(230, 255, 255, 0.8);
                            display: block;
                            margin-top: 100px;
                            margin-left: auto;
                            margin-right: auto;
                            border-radius: 50px;
                        }
                    </style>
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