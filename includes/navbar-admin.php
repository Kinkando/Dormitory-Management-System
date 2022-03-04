
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../select/members.php">
            <img class="dormitory-icon" src=../../assets/img/dormitory-icon.png>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>
        <style>
            .dormitory-icon {
                width: 30px;
                height: 30px;
            }
        </style>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Divider -->
        <hr class="sidebar-divider">

        <?php
        $current = basename($_SERVER['PHP_SELF']);
        $memberTabs = str_contains($current, "members") ? "nav-item active" : "nav-item";
        $roomTabs = str_contains($current, "rooms") ? "nav-item active" : "nav-item";
        $billTabs = str_contains($current, "bills") ? "nav-item active" : "nav-item";
        $bookingTabs = str_contains($current, "bookings") ? "nav-item active" : "nav-item";
        $accountTabs = str_contains($current, "accounts") ? "nav-item active" : "nav-item";
        ?>

        <!-- Nav Item - Tables -->
        <li class="<?php echo $memberTabs; ?>">
            <a class="nav-link" href="../select/members.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Member</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="<?php echo $roomTabs; ?>">
            <a class="nav-link" href="../select/rooms.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Room</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="<?php echo $billTabs; ?>">
            <a class="nav-link" href="../select/bills.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Bill</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="<?php echo $bookingTabs; ?>">
            <a class="nav-link" href="../select/bookings.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Booking</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="<?php echo $accountTabs; ?>">
            <a class="nav-link" href="../select/accounts.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Account</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link" href="../../validate/logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                <span>Logout</span></a>
        </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!---<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>--->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../validate/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>