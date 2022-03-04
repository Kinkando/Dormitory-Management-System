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
    <title>Anwari Dormitory - Book</title>
</head>

<style>
    .available {
        border: none;
        width: 80px;
        height: 40px;
        background-color: #4e73df;
        color: #ffffff;
    }

    .can-booking {
        border: none;
        width: 80px;
        height: 40px;
        background-color: #2aa22a;
        color: #ffffff;
    }

    .not-booking {
        border: none;
        width: 80px;
        height: 40px;
        background-color: #cc0000;
        color: #ffffff;
    }

    .tooltipz {
        position: relative;
        display: inline-block;
    }

    .tooltipz .tooltiptextz {
        visibility: hidden;
        width: 80px;
        background-color: orange;
        color: black;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -40px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltipz .tooltiptextz::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: orange transparent transparent transparent;
    }

    .tooltipz:hover .tooltiptextz {
        visibility: visible;
        opacity: 1;
    }

    .cardz {
        width: 1000px;
        height: <?php echo ($_SESSION["Gender"] == 'M' ? "740px" : "525px") ?>;
        background: rgba(230, 255, 255, 0.0);
        display: block;
        margin-top: 35px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 50px;
    }
</style>

<body>
    <div class="bg"><br><br><br>
        <div class="cardz">
            <div class="container">
                <div class="section-title" data-aos="fade-up"><br>
                    <h2>Book</h2>
                    <h3>Anwari <span>Dormitory</span></h3>
                    <p>
                        <?php
                        $gender = $_SESSION["Gender"];
                        echo $gender == 'M' ? "Male Section" : "Female Section";
                        ?>
                    </p>
                </div>

                <div class="card-header py-3" style="background: rgba(230, 255, 255, 0.8);display: block; border:none; border-radius: 25px;" data-aos="zoom-in">
                    <div data-aos="zoom-out">
                        <p style="text-align: right;">Floor :
                            <select class="combobox-size" style="width:80px;" name="gender" OnChange="window.location='?item='+this.value;" readonly>
                                <?php
                                $unselected = false;
                                foreach ($_GET as $key => $value) {
                                    if (str_contains($key, "item")) {
                                        $unselected = true;
                                        break;
                                    }
                                }
                                $floorSQL = "SELECT DISTINCT substr(room_id,2,1) AS floors FROM room WHERE room_id like '" . ($_SESSION["Gender"] == 'M' ? '2%' : '1%') . "' ORDER BY room_id ASC";
                                $objQuery = $con->query($floorSQL);
                                $room_id_invalid = true;
                                if ($objQuery->num_rows > 0) {
                                    while ($objResult = mysqli_fetch_array($objQuery)) { ?>
                                        <option <?= ($unselected and str_contains($_GET["item"], $objResult["floors"]) or $objResult["floors"] == '1')
                                                    ? 'selected="selected"'  : '' ?>><?php echo $objResult["floors"]; ?></option>

                                <?php $room_id_invalid = false;
                                    }
                                } ?>
                            </select>
                        </p>
                        <?php
                        $unselected = false;
                        foreach ($_GET as $key => $value) {
                            if (str_contains($key, "item")) {
                                $unselected = true;
                                break;
                            }
                        }
                        date_default_timezone_set('Asia/Bangkok');
                        $t = time();
                        $current = date('Y-m-d', $t);
                        $strSQL = "SELECT room_id, room_price FROM room WHERE room_id like '" . ($gender == 'M' ? '2' : '1') . ($unselected ? $_GET["item"] : '1') . '__' . "' ";
                        $objQuery = mysqli_query($con, $strSQL);
                        if ($objQuery->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($objQuery)) {
                                $array[] = $row;
                                $use_room = "SELECT count(*) as counts FROM member JOIN booking ON member.member_id = booking.member_id WHERE booking.room_id = '" . $row['room_id'] . "' AND check_out > '".$current."'";
                                $useSQL = mysqli_query($con, $use_room);
                                $use = mysqli_fetch_array($useSQL);
                                $use_num[] = $use;
                            }
                        }
                        $prefix = ($gender == 'M' ? "2" : "1") . ($unselected ? $_GET['item'] : 1);
                        ?>
                        <? if($unselected) {?>
                        <form action='book-room.php' class="section-title" method='post'>
                            <?php if ($gender == 'M') { ?>
                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[22]['counts'] == 2 ? "not-booking" : ($use_num[22]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[22]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '23'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[22]['room_price'] . " ฿<br>" . $use_num[22]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 192); ?>
                                <input type='hidden' class="not-booking" disabled style='margin-bottom: 5px;'><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[21]['counts'] == 2 ? "not-booking" : ($use_num[21]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[21]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '22'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[21]['room_price'] . " ฿<br>" . $use_num[21]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 192); ?>
                                <input type='hidden' class="not-booking" disabled style='margin-bottom: 5px;'><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[20]['counts'] == 2 ? "not-booking" : ($use_num[20]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[20]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '21'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[20]['room_price'] . " ฿<br>" . $use_num[20]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 192); ?>
                                <input type='hidden' class="not-booking" disabled style='margin-bottom: 5px;'><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[19]['counts'] == 2 ? "not-booking" : ($use_num[19]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[19]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '20'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[19]['room_price'] . " ฿<br>" . $use_num[19]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 20); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[18]['counts'] == 4 ? "not-booking" : ($use_num[18]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[18]['counts'] == 4 ? "disabled" : "" ?> value="<?php echo $prefix . '19'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[18]['room_price'] . " ฿<br>" . $use_num[18]['counts'] . "/4"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 152); ?>
                                <input type='hidden' class="not-booking" disabled style='margin-bottom: 5px;'><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[17]['counts'] == 2 ? "not-booking" : ($use_num[17]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[17]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '18'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[17]['room_price'] . " ฿<br>" . $use_num[17]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 20); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[16]['counts'] == 2 ? "not-booking" : ($use_num[16]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[16]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '17'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[16]['room_price'] . " ฿<br>" . $use_num[16]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 152); ?>
                                <input type='hidden' class="not-booking" disabled style='margin-bottom: 5px;'><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[15]['counts'] == 2 ? "not-booking" : ($use_num[15]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[15]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '16'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[15]['room_price'] . " ฿<br>" . $use_num[15]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 20); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[14]['counts'] == 2 ? "not-booking" : ($use_num[14]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[14]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '15'; ?>" style='margin-bottom: 5px;'>
                                    <span class="tooltiptextz"><?php echo $array[14]['room_price'] . " ฿<br>" . $use_num[14]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 30); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[9]['counts'] == 2 ? "not-booking" : ($use_num[9]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[9]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '10'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[9]['room_price'] . " ฿<br>" . $use_num[9]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[8]['counts'] == 2 ? "not-booking" : ($use_num[8]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[8]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '09'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[8]['room_price'] . " ฿<br>" . $use_num[8]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[6]['counts'] == 2 ? "not-booking" : ($use_num[6]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[6]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '07'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[6]['room_price'] . " ฿<br>" . $use_num[6]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[4]['counts'] == 2 ? "not-booking" : ($use_num[4]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[4]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '05'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[4]['room_price'] . " ฿<br>" . $use_num[4]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[2]['counts'] == 2 ? "not-booking" : ($use_num[2]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[2]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '03'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[2]['room_price'] . " ฿<br>" . $use_num[2]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[0]['counts'] == 2 ? "not-booking" : ($use_num[0]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[0]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '01'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[0]['room_price'] . " ฿<br>" . $use_num[0]['counts'] . "/2"; ?></span>
                                </div><br><br><br><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[13]['counts'] == 2 ? "not-booking" : ($use_num[13]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[13]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '14'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[13]['room_price'] . " ฿<br>" . $use_num[13]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[12]['counts'] == 2 ? "not-booking" : ($use_num[12]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[12]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '13'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[12]['room_price'] . " ฿<br>" . $use_num[12]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[11]['counts'] == 2 ? "not-booking" : ($use_num[11]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[11]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '12'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[11]['room_price'] . " ฿<br>" . $use_num[11]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[10]['counts'] == 2 ? "not-booking" : ($use_num[10]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[10]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '11'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[10]['room_price'] . " ฿<br>" . $use_num[10]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 50); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[7]['counts'] == 2 ? "not-booking" : ($use_num[7]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[7]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '08'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[7]['room_price'] . " ฿<br>" . $use_num[7]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[5]['counts'] == 2 ? "not-booking" : ($use_num[5]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[5]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '06'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[5]['room_price'] . " ฿<br>" . $use_num[5]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[3]['counts'] == 2 ? "not-booking" : ($use_num[3]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[3]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '04'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[3]['room_price'] . " ฿<br>" . $use_num[3]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[1]['counts'] == 2 ? "not-booking" : ($use_num[1]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[1]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '02'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[1]['room_price'] . " ฿<br>" . $use_num[1]['counts'] . "/2"; ?></span>
                                </div>

                            <?php } else { ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[18]['counts'] == 2 ? "not-booking" : ($use_num[18]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[18]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '19'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[18]['room_price'] . " ฿<br>" . $use_num[18]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[16]['counts'] == 2 ? "not-booking" : ($use_num[16]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[16]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '17'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[16]['room_price'] . " ฿<br>" . $use_num[16]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[14]['counts'] == 2 ? "not-booking" : ($use_num[14]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[14]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '15'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[14]['room_price'] . " ฿<br>" . $use_num[14]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[13]['counts'] == 2 ? "not-booking" : ($use_num[13]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[13]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '14'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[13]['room_price'] . " ฿<br>" . $use_num[13]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[12]['counts'] == 2 ? "not-booking" : ($use_num[12]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[12]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '13'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[12]['room_price'] . " ฿<br>" . $use_num[12]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[10]['counts'] == 2 ? "not-booking" : ($use_num[10]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[10]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '11'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[10]['room_price'] . " ฿<br>" . $use_num[10]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[8]['counts'] == 2 ? "not-booking" : ($use_num[8]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[8]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '09'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[8]['room_price'] . " ฿<br>" . $use_num[8]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[6]['counts'] == 2 ? "not-booking" : ($use_num[6]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[6]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '07'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[6]['room_price'] . " ฿<br>" . $use_num[6]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[4]['counts'] == 2 ? "not-booking" : ($use_num[4]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[4]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '05'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[4]['room_price'] . " ฿<br>" . $use_num[4]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[2]['counts'] == 2 ? "not-booking" : ($use_num[2]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[2]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '03'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[2]['room_price'] . " ฿<br>" . $use_num[2]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[0]['counts'] == 2 ? "not-booking" : ($use_num[0]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[0]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '01'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[0]['room_price'] . " ฿<br>" . $use_num[0]['counts'] . "/2"; ?></span>
                                </div><br><br><br><br>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[19]['counts'] == 2 ? "not-booking" : ($use_num[19]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[19]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '20'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[19]['room_price'] . " ฿<br>" . $use_num[19]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[17]['counts'] == 2 ? "not-booking" : ($use_num[17]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[17]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '18'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[17]['room_price'] . " ฿<br>" . $use_num[17]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[15]['counts'] == 2 ? "not-booking" : ($use_num[15]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[15]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '16'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[15]['room_price'] . " ฿<br>" . $use_num[15]['counts'] . "/2"; ?></span>
                                </div><?php echo str_repeat("&nbsp;", 40); ?>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[11]['counts'] == 2 ? "not-booking" : ($use_num[11]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[11]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '12'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[11]['room_price'] . " ฿<br>" . $use_num[11]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[9]['counts'] == 2 ? "not-booking" : ($use_num[9]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[9]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '10'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[9]['room_price'] . " ฿<br>" . $use_num[9]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[7]['counts'] == 2 ? "not-booking" : ($use_num[7]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[7]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '08'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[7]['room_price'] . " ฿<br>" . $use_num[7]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[5]['counts'] == 2 ? "not-booking" : ($use_num[5]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[5]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '06'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[5]['room_price'] . " ฿<br>" . $use_num[5]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[3]['counts'] == 2 ? "not-booking" : ($use_num[3]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[3]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '04'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[3]['room_price'] . " ฿<br>" . $use_num[3]['counts'] . "/2"; ?></span>
                                </div>

                                <div class="tooltipz"><input type='submit' name='room_id' class="<?php echo $use_num[1]['counts'] == 2 ? "not-booking" : ($use_num[1]['counts'] == 0 ? "available" : "can-booking") ?>" <?php echo $use_num[1]['counts'] == 2 ? "disabled" : "" ?> value="<?php echo $prefix . '02'; ?>">
                                    <span class="tooltiptextz"><?php echo $array[1]['room_price'] . " ฿<br>" . $use_num[1]['counts'] . "/2"; ?></span>
                                </div>

                            <?php } ?>
                        </form>
                        <?}?>
                    </div>
                <div style="text-align:center;">
                    <input type='submit' class='available' disabled value="Available">
                    <input type='submit' class='can-booking' disabled value="Booking">
                    <input type='submit' class='not-booking' disabled value="Full">
                </div>
                </div>
                <br>
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