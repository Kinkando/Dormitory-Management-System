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

    <title>Dormitory Management System - Bill Table</title>

    <!-- Custom fonts for this template -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<style>
    .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
    .icon-button {
        margin-top: 5px;
        width: 110px;
        height: 30px;
        border: none;
        background-color: #4e73df;
        font-size: 16px;
        color: #ffffff;
        cursor: pointer;
        text-align: center;
        float: right;
        border-radius: 5px;
    }
    .edit-button {
        background: none; 
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    .delete-button {
        background: none;
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    .icon-button:focus,
    .edit-button:focus,
    .delete-button:focus{
        outline:none;
    }
</style>
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

                <?php $sql = "SELECT bill_id, bill.room_id, month_routine, net_summary, bill_status, room_price, date_format(month_routine, '%M %Y') as MONTH 
                              FROM bill JOIN room ON bill.room_id = room.room_id ORDER BY bill_id asc, month_routine asc";
                $result = $con->query($sql);
                ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <form action="../add/bills_add.php">
                            <h5 class="m-0 font-weight-bold text-primary">Bill Table
                                <?php echo str_repeat("&nbsp;", 1); ?>
                                <button name=add type=submit value=Add class=icon-button><img src=../../assets/img/add-icon-2.png> Add Bill</button>
                            </h5>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Bill ID</th>
                                        <th>Room ID</th>
                                        <th>Month Routine</th>
                                        <th>Net Summary</th>
                                        <th>Bill Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["bill_id"] .  "</td> ";
                                        echo "<td>" . $row["room_id"]  .  "</td> ";
                                        echo "<td>" . $row["MONTH"] .  "</td> ";
                                        echo "<td>" . number_format($row["net_summary"]) .  "</td> ";
                                        echo "<td>" .( $row["bill_status"] == 'P' ? "Paid" : "Not Paid" ).  "</td> ";
                                        echo "<td><a href='../edit/bills_edit.php?input1=" . $row["bill_id"] . "
                                            &input2=" . $row["room_id"] . "
                                            &input3=" . $row["month_routine"] . "
                                            &input4=" . $row["net_summary"] . "
                                            &input5=" . $row["bill_status"] . "
                                            &input6=" . $row["room_price"] . "'>
                                            <CENTER><button name=edit type=submit value=Edit class=edit-button><img src=../../assets/img/edit-icon.png></button></CENTER></a></td> ";
                                        echo "<td><a href='../../database/delete/delete.php?ID=" . $row["bill_id"] . "
                                            &table=bill
                                            &condition=bill_id
                                            &directory=bills.php
                                            'onclick=\"return confirm('Do you want to delete this record? !!!')\">
                                            <CENTER><button name=delete input type=submit value=Delete class=delete-button><img src=../../assets/img/delete-icon.png></button></CENTER></a></td> ";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>

</body>

</html>