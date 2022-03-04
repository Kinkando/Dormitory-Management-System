<?php
include('../../includes/admin-connection.php');
include('../../includes/connection.php');
include('../../includes/header-admin.php');
include('../../includes/navbar-admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dormitory Management System - Add New Bill Order</title>

    <!-- Custom fonts for this template -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                Dormitory Management System
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- DataTales Example -->
                <div class="card shadow mb-4" style="width:380px;">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary" style="text-align:center;">Add New Bill Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">


                            <form action="../../database/insert/bills_insert.php" method="post">
                                <p><?php echo "Bill ID" . str_repeat("&nbsp;", 33) . "Room ID" ?><br>
                                    <input type="text" class="twice-box-id" onkeyup="this.value = this.value.toUpperCase();" name="billID" required minlength="6" maxlength="6" placeholder="ex : R00001">
                                    <?php echo str_repeat("&nbsp;", 5); ?>
                                    <select class="twice-box" name="roomID">
                                        <option>- Select Room -</option>
                                        <?php
                                        date_default_timezone_set('Asia/Bangkok');
                                        $t = time();
                                        $current = date("Y-m-d", strtotime(date("Y-m-d",$t) ."-1 month"));
                                        $strSQL = "SELECT DISTINCT room_id FROM booking WHERE check_out > '".$current."' and booking_status = 'P' ORDER BY room_id ASC";
                                        $objQuery = $con->query($strSQL);
                                        $room_id_invalid = true;
                                        if ($objQuery->num_rows > 0) {
                                            while ($objResult = mysqli_fetch_array($objQuery)) { ?>
                                                <option><?php echo $objResult["room_id"]; ?></option>
                                        <?php $room_id_invalid = false;
                                            }
                                        } ?>
                                    </select>
                                    <?php
                                    date_default_timezone_set('Asia/Bangkok');
                                    $t = time();
                                    ?>  
                                <p>Month Routine<br><input class="isolation-box" required id="date" name="date" placeholder="Month Year" type="month" value="<?php echo date('Y-m', $t); ?>" /></p>
                                <p>Net Summary<br> <input type="number" required min="4900" max="99999" class="isolation-box" name="netSummary" placeholder="Net Summary"><br></p>
                                <p>Status<br>
                                    <select class="isolation-box" name="status" readonly>
                                        <option>Paid</option>
                                        <option selected='selected'>Not Paid</option>
                                    </select><br>
                                </p>
                                <button type="reset" class="block-reset">Reset</button><?php echo str_repeat("&nbsp;", 6); ?>
                                <input type="submit" class="block-submit" value = "Submit">
                            </form>
                            <form action="../select/bills.php">
                                <br><button type="submit" class="block-back">Back</button>
                            </form>
                            <style>
                                input[name=id] {
                                    border-top-style: hidden;
                                    border-right-style: hidden;
                                    border-left-style: hidden;
                                    border-bottom-style: hidden;
                                    background-color: #ffffff;
                                }

                                input[name=id]:focus {
                                    outline: none !important;
                                    border: none;
                                }

                                .block-back {
                                    display: block;
                                    width: 330px;
                                    height: 30px;
                                    border: none;
                                    background-color: #2aa22a;
                                    font-size: 16px;
                                    color: #ffffff;
                                    cursor: pointer;
                                    text-align: center;
                                }

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
                                }

                                .twice-box-id {
                                    height: 30px;
                                    width: 150px;
                                    text-transform: uppercase;
                                }
                            </style>

                            </form>


                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/modal/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

</body>

</html>