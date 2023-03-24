<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['update'])) {
    $ahname = $_POST['ahname'];
    $emailid = $_POST['emailid'];
    $mobilenumber = $_POST['mobilenumber'];
    $comadd = $_POST['comadd'];
    $occupation = $_POST['occupation'];
    $lockersize = $_POST['lockersize'];
    $instruction = $_POST['instruction'];
    $nomineename = $_POST['nomineename'];
    $nomineerelation = $_POST['nomineerelation'];
    $valuabledetails = $_POST['valuabledetails'];
    $status = $_POST['status'];
    $idcard = $_POST['idcard'];
    $ltid = intval($_GET['ltid']);
    $query = mysqli_query($con, "update tblassignlocker set FullName='$ahname',Email='$emailid',MobileNumber='$mobilenumber',CompleteAddress='$comadd',Occupation='$occupation',LockerSize='$lockersize',Instructions='$instruction',NomineeName='$nomineename',Relationwithnominee='$nomineerelation',ValuableDetails='$valuabledetails',IDcard='$idcard',Status='$status' where ID='$ltid'");
    if ($query) {
      echo "<script>alert('Locker assign updated successfully.');</script>";
      echo "<script type='text/javascript'> document.location = 'manage-locker-form.php'; </script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HLMS | Edit/Update Banker admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!--Function Email Availabilty---->


  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include_once("includes/navbar.php"); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php include_once("includes/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Subbanker Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Subbanker Details</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Update the Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form name="subadmin" method="post">
                    <?php
                    $ltid = intval($_GET['ltid']);
                    $query = mysqli_query($con, " select tbllockertype.ID as blid,tbllockertype.SizeofLocker,tbllockertype.Priceoflocker,tblassignlocker.* from tblassignlocker join tbllockertype on tbllockertype.ID=tblassignlocker.LockerSize where tblassignlocker.ID='$ltid'");
                    $cnt = 1;
                    while ($result = mysqli_fetch_array($query)) {
                    ?>
                      <div class="card-body">
                        <!-- Username-->
                        <div class="card-body">
                          <div class="form-group">
                            <label for="text">Full Name</label>
                            <input type="text" class="form-control" id="ahname" name="ahname" value="<?php echo $result['FullName'] ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="emailid" value="<?php echo $result['Email'] ?>" name="emailid" required>
                          </div>
                          <!-- Sub admin Contact Number---->
                          <div class="form-group">
                            <label for="text">Mobile Number</label>
                            <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" maxlength="10" pattern="[0-9]{10}" value="<?php echo $result['MobileNumber'] ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="text">Complete Address</label>
                            <textarea class="form-control" name="comadd" required='true'><?php echo $result['CompleteAddress'] ?></textarea>

                          </div>
                          <div class="form-group">
                            <label for="text">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $result['Occupation'] ?>" required>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Type of Locker</label>
                            <select class="form-control" id="lockersize" name="lockersize">
                              <option value="<?php echo $result['blid'] ?>"><?php echo $result['SizeofLocker'] ?></option>
                              <?php $query = mysqli_query($con, "select * from tbllockertype");
                              $cnt = 1;
                              while ($row = mysqli_fetch_array($query)) {
                              ?>
                                <option value="<?php echo $row['ID'] ?>"><?php echo $row['SizeofLocker'] ?></option><?php } ?>

                            </select>
                          </div>
                          <div class="form-group">
                            <label for="text">Locker Number</label>
                            <input type="text" class="form-control" id="lockernum" value="<?php echo $result['LockerNumber'] ?>" name="lockernum" readonly='true'>
                          </div>
                          <div class="form-group">
                            <label for="text">Key Number</label>
                            <input type="text" class="form-control" id="keynum" value="<?php echo $result['KeyNumber'] ?>" name="keynum" readonly='true'>
                          </div>
                          <div class="form-group">
                            <label for="text">Instruction(if any)</label>
                            <textarea class="form-control" name="instruction"><?php echo $result['Instructions'] ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="text">Name of Nominee</label>
                            <input type="text" class="form-control" id="nomineename" value="<?php echo $result['NomineeName'] ?>" name="nomineename" required>
                          </div>
                          <div class="form-group">
                            <label for="text">Relation with Nominee</label>
                            <input type="text" class="form-control" id="nomineerelation" value="<?php echo $result['Relationwithnominee'] ?>" name="nomineerelation" required>
                          </div>
                          <div class="form-group">
                            <label for="text">Valuable Details</label>
                            <textarea class="form-control" name="valuabledetails" required='true'><?php echo $result['ValuableDetails'] ?></textarea>

                          </div>
                          <div class="form-group">
                            <label for="text">ID Proof</label>
                            <select class="form-control" name="idcard" required='true'>
                              <option value="<?php echo $result['IDcard'] ?>"><?php echo $result['IDcard'] ?></option>
                              <option value="Aadhar Card">Aadhar Card</option>
                              <option value="Driving Licence">Driving Licence</option>
                              <option value="Voter Card">Voter Card</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <label for="text">View ID Proof</label>

                            <a href="addressproof/<?php echo $result['IDproof'] ?>" width="100" height="100" target="_blank"> <strong style="color: red">View</strong></a>
                            <a href="changeidproof.php?editid=<?php echo $result['ID'] ?>"> &nbsp;<strong style="color: red"> Edit</strong></a>
                          </div>
                          <div class="form-group">
                            <label for="text">View Pic</label>

                            <img src="photo/<?php echo $result['Photo']; ?>" width="100" height="100" value="<?php echo $result['Photo']; ?>>"><a href="changeimage1.php?editid=<?php echo $result['ID']; ?>"> &nbsp; Edit Image</a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="text" style="padding-left: 20px;">Status</label>
                          <?php if ($result['Status'] == "1") { ?>
                            <input type="checkbox" name="status" id="status" value="1" checked="true" />
                          <?php } else { ?>
                            <input type="checkbox" value='1' name="status" id="status" />
                          <?php } ?>
                        </div>
                      <?php } ?>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                      </div>
                      </div>




                </div>
                <!-- /.card-body -->

                </form>
              </div>
              <!-- /.card -->



            </div>
            <!--/.col (left) -->

          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once('includes/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        bsCustomFileInput.init();
      });
    </script>
  </body>

  </html>
<?php } ?>