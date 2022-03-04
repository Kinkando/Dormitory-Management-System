<?php
include('../../includes/admin-connection.php');
include('../../includes/connection.php');
include('../../includes/header-admin.php');
include('../../includes/navbar-admin.php');
if(!isset($_POST['submit'])) {
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

  <title>Dormitory Management System - Add New Account</title>

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
            <h5 class="m-0 font-weight-bold text-primary" style="text-align:center;">Add New <?php echo trim($_POST["submit"]) == 'admin' ? "Admin" : "User" ?></h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <form action="../../database/insert/accounts_insert.php" method="post">
                <input type="hidden" name="level" value="<?php echo trim($_POST["submit"]) == 'admin' ? "A" : "U"; ?>" />
                <p>Username<br>
                  <input type="text" class="isolation-box" required name="username" minlength=6 maxlength=20 placeholder="Username">
                </p>
                <p>Password<br>
                  <input type="text" class="isolation-box" required name="password" minlength=6 maxlength=20 placeholder="Password">
                </p>
                <p>Email<br> <input type="email" required maxlength="50" class="isolation-box" name="email" placeholder="Only Hotmail or Gmail"><br></p>

                <p>Level<br>
                  <input type="text" disabled class="isolation-box" required name="username" placeholder="Level" value="<?php echo trim($_POST["submit"]) == 'admin' ? "Admin" : "User"; ?>">
                
                </p>
                <?php if (trim($_POST["submit"]) == 'user') { ?>
                  <p>Member ID<br>

                    <select class="isolation-box" name="memberID">
                      <option>- Select Member ID -</option>
                      <?php
                      $strSQL = "SELECT DISTINCT member_id FROM memberdetail WHERE member_id NOT IN (SELECT account.member_id FROM account LEFT JOIN memberdetail ON memberdetail.member_id = account.member_id WHERE account.member_id IS NOT NULL);";
                      $objQuery = $con->query($strSQL);
                      if ($objQuery->num_rows > 0) {
                        while ($objResult = mysqli_fetch_array($objQuery)) { ?>
                          <option><?php echo $objResult["member_id"]; ?></option>
                      <?php
                        }
                      } ?>
                    </select>
                  </p>
                <?php } ?>

                <button type="reset" class="block-reset">Reset</button><?php echo str_repeat("&nbsp;", 6); ?>
                <input type="submit" class="block-submit" value="Submit">
              </form>
              <form action="../select/accounts.php">
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