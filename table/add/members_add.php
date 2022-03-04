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

  <title>Dormitory Management System - Add New Member</title>

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
            <h5 class="m-0 font-weight-bold text-primary" style="text-align:center;">Add New Member</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <form action="../../database/insert/members_insert.php" method="post">
                  <p><?php echo "Member ID" . str_repeat("&nbsp;", 24) . "Room Type / ID" ?><br>
                  <input type="text" required class="twice-box-id" name="memberID" onkeyup="this.value = this.value.toUpperCase();" placeholder="ex : M00001" minlength="6" maxlength=6>
                  <?php echo str_repeat("&nbsp;", 5); ?>
                  <select class="twice-box" name="roomID">
                    <option>- Select Room -</option>
                    <option>Male</option>
                    <option>Female</option>
                    <?php
                    $strSQL = "SELECT room_id FROM room ORDER BY room_id ASC";
                    $objQuery = $con->query($strSQL);
                    $room_id_invalid = true;
                    if ($objQuery->num_rows > 0) {
                      while ($objResult = mysqli_fetch_array($objQuery)) { ?>
                        <option><?php echo $objResult["room_id"]; ?></option>
                      <?php $room_id_invalid = false;
                      }
                    }?>
                  </select>

                </p>

                </p>
                <p>First Name<br> <input type="text" required pattern="[a-zA-Z]{1,}" maxlength=30 class="isolation-box" name="firstName" placeholder="First Name"><br></p>
                <p>Last Name<br> <input type="text" required pattern="[a-zA-Z]{1,}" maxlength=30 class="isolation-box" name="lastName" placeholder="Last Name"><br></p>
                <p>Telephone Number<br> <input type="text" pattern="[0-9]{1,}" required class="isolation-box" name="telNO" placeholder="Telephone Number" minlength=10 maxlength=10><br></p>
                <button type="reset" class="block-reset" >Reset</button><?php echo str_repeat("&nbsp;", 6); ?>
                <input type="submit" class="block-submit" value = "Submit">
              </form>
              <form action="../select/members.php">
                <br><button type="submit" class="block-back" >Back</button>
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

</body>

</html>