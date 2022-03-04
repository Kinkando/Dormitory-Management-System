<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
    <div class="tooltipz">
        <a href="about.php"><img src="assets/img/about-icon.png" alt="" style="width:100px; height:100px;"></a>
        <span class="tooltiptextz">About</span>
    </div>
    <div class="tooltipz">
        <a href="offer.php"><img src="assets/img/room-icon.png" alt="" style="width:110px; height:100px;"></a>
        <span class="tooltiptextz">Offer</span>
    </div>

    <?php

    $check = false;
    foreach ($_SESSION as $key => $value)
        if (str_contains($key, "username")) {
            $check = true;
            break;
        }
    if (!$check) { ?>
        <div class="tooltipz">
            <a href="sign-in.php"><img src="assets/img/sign-in-icon.png" alt="" style="width:95px; height:95px;"></a>
            <span class="tooltiptextz">Sign in</span>
        </div>
    <?php } else { ?>


        <?php
        include('connection.php');
        $detail = "SELECT room_id, memberdetail.member_id FROM memberdetail LEFT JOIN member ON memberdetail.member_id = member.member_id WHERE memberdetail.member_id = '" . $_SESSION["member_id"] . "'";
        $objQuery = mysqli_query($con, $detail);
        if ($objQuery->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($objQuery)) {
                $room_id = $row["room_id"];
            }
        }
        if (strlen($room_id) == 0) { ?>
            <div class="tooltipz">
                <a href="book.php"><img src="assets/img/book-icon.png" alt="" style="width:95px; height:95px;"></a>
                <span class="tooltiptextz">Book</span>
            </div>
        <?php } else { ?>
            <div class="tooltipz">
                <a href="payment.php"><img src="assets/img/payment-icon.png" alt="" style="width:95px; height:95px;"></a>
                <span class="tooltiptextz">Payment</span>
            </div>
    <?php }
    } ?>

</div>
<style>
    .tooltipz {
        position: relative;
        display: inline-block;
    }

    .tooltipz .tooltiptextz {
        visibility: hidden;
        width: 80px;
        background-color: #555;
        color: #fff;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        bottom: 105%;
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
        border-color: #555 transparent transparent transparent;
    }

    .tooltipz:hover .tooltiptextz {
        visibility: visible;
        opacity: 1;
    }
</style>