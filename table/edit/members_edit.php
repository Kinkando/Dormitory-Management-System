<?php
include('../../includes/admin-connection.php');
include('../../includes/connection.php');
include('../../includes/header-admin.php');
include('../../includes/navbar-admin.php');
$count = 0;
foreach ($_GET as $key => $value)
    if (str_contains($key, "input1") or str_contains($key, "input2") or str_contains($key, "input3") or str_contains($key, "input4") or 
    str_contains($key, "input5") or str_contains($key, "input6")) 
        $count++;
if($count!=6) {
  echo '<script>window.history.back();</script>';
  return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dormitory Management System - Edit Member</title>

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
            <h5 class="m-0 font-weight-bold text-primary" style="text-align:center;">Edit Member</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <form action="../../database/update/members_update.php" method="post">
                <input type="hidden" name="id" value="<?php echo trim($_GET["input1"]); ?>" />
                <input type="hidden" name="oldRoomID" value="<?php echo trim($_GET["input2"])==NULL ? trim($_GET["input5"]) : trim($_GET["input2"]); ?>" />
                <input type="hidden" name="oldFirstName" value="<?php echo trim($_GET["input3"]); ?>" />
                <input type="hidden" name="oldLastName" value="<?php echo trim($_GET["input4"]); ?>" />
                <var name="memberID" value=<?php echo trim($_GET["input1"]); ?>></var>
                <p><?php echo "Member ID" . str_repeat("&nbsp;", 24) . "Room Type / ID"; ?><br>
                  <input type="text" required minlength="6" maxlength="6" onkeyup="this.value = this.value.toUpperCase();" class="twice-box-id" name="memberID" maxlength=6 value="<?php echo trim($_GET["input1"]); ?>" placeholder="ex : M00001">
                  <?php echo str_repeat("&nbsp;", 5); ?>
                    <select class="twice-box" name="roomID">
                      <?php
                      $prefixRoom = (strlen(trim($_GET["input2"])) == 4 ? "" : trim($_GET["input5"]) == 'F') ? "1" : "2";
                      $strSQL = "SELECT room_id FROM room WHERE room_id LIKE '" . $prefixRoom . "%' ORDER BY room_id ASC";
                      $objQuery = $con->query($strSQL);
                      if (strlen(trim($_GET["input2"])) == 4) { ?>
                        <option><?php echo trim($_GET["input2"]); ?></option>
                        <option>Cancel</option>
                      <?php } else { ?>
                        <option <?= (trim($_GET["input5"]) == 'M') ? 'selected="selected"' : '' ?>>Male</option>
                        <option <?= (trim($_GET["input5"]) == 'F') ? 'selected="selected"' : '' ?>>Female</option>
                        <?php while ($objResult = mysqli_fetch_array($objQuery)) { ?>
                          <option><?php echo $objResult["room_id"]; ?></option>
                      <?php
                        }
                      } ?>
                    </select>
                </p>

              </p>
              <p>First Name<br> <input type="text" pattern="[a-zA-Z]{1,}" maxlength=30 class="isolation-box" name="firstName" placeholder="First Name" value="<?php echo trim($_GET["input3"]); ?>"><br></p>
              <p>Last Name<br> <input type="text" pattern="[a-zA-Z]{1,}" maxlength=30 class="isolation-box" name="lastName" placeholder="Last Name" value="<?php echo trim($_GET["input4"]); ?>"><br></p>
              <p>Telephone Number<br> <input type="text" required pattern="[0-9]{1,}" minlength="10" maxlength="10" class="isolation-box" name="telNO" placeholder="Telephone Number" maxlength=10 value="<?php echo trim($_GET["input6"]); ?>"><br></p>
              <button type="reset" class="block-reset">Reset</button><?php echo str_repeat("&nbsp;", 6); ?>
              <input type="submit" class="block-submit" value = "Submit">
              </form>
              <form action="../select/members.php">
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

</body>

</html>