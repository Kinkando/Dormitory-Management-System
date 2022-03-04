<?php
session_start();
$check = false;
foreach ($_SESSION as $key => $value)
    if (str_contains($key, "username")) {
        $check = true;
        break;
    }
?>
<header id="header" class="d-flex align-items-center" style="background-color:#e6ffff;">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <a href="index.php"><img src="assets/img/dormitory-icon-blue.png" style="margin-top: -5px;">
                Dormitory <span>Management</span> System</a>
        </h1>
        <?php
        $current = basename($_SERVER['PHP_SELF']);
        $homeTab = str_contains($current, "index") ? "nav-link scrollto active" : "nav-link scrollto";
        $aboutTab = str_contains($current, "about") ? "nav-link scrollto active" : "nav-link scrollto";
        $offerTab = str_contains($current, "offer") ? "nav-link scrollto active" : "nav-link scrollto";
        $signInTab = str_contains($current, "sign") ? "nav-link scrollto active" : "nav-link scrollto";
        $bookTab = str_contains($current, "book") ? "nav-link scrollto active" : "nav-link scrollto";
        $paymentTab = str_contains($current, "payment") ? "nav-link scrollto active" : "nav-link scrollto";
        $accountTab = str_contains($current, "profile") ? "nav-link scrollto active" : "nav-link scrollto";
        ?>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="<?php echo $homeTab; ?>" href="index.php">Home</a></li>
                <li><a class="<?php echo $aboutTab; ?>" href="about.php">About</a></li>
                <li><a class="<?php echo $offerTab; ?>" href="offer.php">Offer</a></li>
                <?php if (!$check) 
                { ?>
                    <li><a class="<?php echo $signInTab; ?>" href="sign-in.php">Sign in</a></li>

                    <?php } else if (($_SESSION['level'] == 'U') == 1)
                {
                    include('connection.php');
                    $detail = "SELECT room_id, memberdetail.member_id FROM memberdetail LEFT JOIN member ON memberdetail.member_id = member.member_id WHERE memberdetail.member_id = '" . $_SESSION["member_id"] . "'";
                    $objQuery = mysqli_query($con, $detail);
                    if ($objQuery->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($objQuery)) {
                            $room_id = $row["room_id"];
                        }
                    }
                    if (strlen($room_id) == 0) { ?>
                        <li><a class="<?php echo $bookTab; ?>" href="book.php">Book</a></li>
                    <?php } else { ?>
                        <li><a class="<?php echo $paymentTab; ?>" href="payment.php">Payment</a></li>
                    <?php } ?>
                    <li class="dropdown">
                        <a class="<?php echo $accountTab; ?>">
                            <img src="assets/img/sign-in-icon.png" class="avatar" alt="Avatar" style="width:20px; height:20px; border-radius: 50%;">
                            &nbsp;<span><?php echo $_SESSION['username']; ?></span> <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <a href="profile.php" class="dropdown-item">&#9863; Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="validate/logout.php" class="dropdown-item">&#10148; Logout</a>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>