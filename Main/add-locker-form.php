<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $ahname = $_POST['ahname'];
    $emailid = $_POST['emailid'];
    $mobilenumber = $_POST['mobilenumber'];
    $comadd = $_POST['comadd'];
    $occupation = $_POST['occupation'];
    $lockersize = $_POST['lockersize'];
    $lockernum = $_POST['lockernum'];
    $keynum = $_POST['keynum'];
    $instruction = $_POST['instruction'];
    $nomineename = $_POST['nomineename'];
    $nomineerelation = $_POST['nomineerelation'];
    $valuabledetails = $_POST['valuabledetails'];
    $status = $_POST['status'];
    $idcard = $_POST['idcard'];
    $photo = $_FILES["photo"]["name"];
    $extension1 = substr($photo, strlen($photo) - 4, strlen($photo));
    $addressproof = $_FILES["addressproof"]["name"];
    $extension2 = substr($addressproof, strlen($addressproof) - 4, strlen($addressproof));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", ".pdf", ".PDF");
    if (!in_array($extension1, $allowed_extensions)) {
      echo "<script>alert('Pics has Invalid format. Only jpg / jpeg/ png /gif /pdf format allowed.');</script>";
    }
    // if(!in_array($extension2,$allowed_extensions))
    // {
    // echo "<script>alert('Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    // }

    else {


      $photo = md5($photo) . time() . $extension1;
      $addressproof = md5($addressproof) . time() . $extension2;
      move_uploaded_file($_FILES["photo"]["tmp_name"], "photo/" . $photo);
      $ret = mysqli_query($con, "select Email from tblassignlocker where LockerNumber='$lockernum' || KeyNumber='$keynum'");
      $result = mysqli_fetch_array($ret);
      if ($result > 0) {

        echo "<script>alert('This Locker Number or Key Number already associated with another account holder');</script>";
      } else {
        move_uploaded_file($_FILES["addressproof"]["tmp_name"], "addressproof/" . $addressproof);
        $query = mysqli_query($con, "insert into tblassignlocker(FullName,Email,MobileNumber,CompleteAddress,Occupation,LockerSize,LockerNumber,KeyNumber,Instructions,NomineeName,Relationwithnominee,ValuableDetails,IDcard,IDproof,Photo,Status) values('$ahname','$emailid','$mobilenumber','$comadd','$occupation','$lockersize','$lockernum','$keynum','$instruction','$nomineename','$nomineerelation','$valuabledetails','$idcard','$addressproof','$photo','$status')");
        if ($query) {
          echo "<script>alert('Locker has been alloted successfully.');</script>";
          echo "<script type='text/javascript'> document.location = 'add-locker-form.php'; </script>";
        } else {
          echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
      }
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HLMS | Add Locker Type</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!--Function Email Availabilty---->
    <script>
      function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "check_availability.php",
          data: 'username=' + $("#sadminusername").val(),
          type: "POST",
          success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }
    </script>

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
                <h1>Add Locker Form</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Locker Form</li>
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
                    <h3 class="card-title">Fill the Info of Account Holder</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form name="lockerform" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="text">Full Name</label>
                        <input type="text" class="form-control" id="ahname" name="ahname" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter email" required>
                      </div>
                      <!-- Sub admin Contact Number---->
                      <div class="form-group">
                        <label for="text">Mobile Number</label>
                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter email" maxlength="10" pattern="[0-9]{10}" title="10 numeric characters only" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Complete Address</label>
                        <textarea class="form-control" name="comadd" required='true'></textarea>

                      </div>
                      <div class="form-group">
                        <label for="text">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Type of Locker</label>
                        <select class="form-control" id="lockersize" name="lockersize">
                          <option value="">Choose Name of Locker</option>
                          <?php $query = mysqli_query($con, "select * from tbllockertype");
                          $cnt = 1;
                          while ($result = mysqli_fetch_array($query)) {
                          ?>
                            <option value="<?php echo $result['ID'] ?>"><?php echo $result['SizeofLocker'] ?></option><?php } ?>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="text">Locker Number</label>
                        <input type="text" class="form-control" id="lockernum" name="lockernum" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Key Number</label>
                        <input type="text" class="form-control" id="keynum" name="keynum" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Instruction(if any)</label>
                        <textarea class="form-control" name="instruction"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="text">Name of Nominee</label>
                        <input type="text" class="form-control" id="nomineename" name="nomineename" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Relation with Nominee</label>
                        <input type="text" class="form-control" id="nomineerelation" name="nomineerelation" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Valuable Details</label>
                        <textarea class="form-control" name="valuabledetails" required='true'></textarea>

                      </div>
                      <div class="form-group">
                        <label for="text">ID Proof</label>
                        <select class="form-control" name="idcard" required='true'>
                          <option value="">Choose ID Proof</option>
                          <option value="Aadhar Card">Aadhar Card</option>
                          <option value="Driving Licence">Driving Licence</option>
                          <option value="Voter Card">Voter Card</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="text">Upload ID Proof</label>
                        <input type="file" class="form-control" id="addressproof" name="addressproof" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Upload Pic</label>
                        <input type="file" class="form-control" id="photo" name="photo" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" style="padding-left: 20px;">Status</label>
                      <input type="checkbox" name="status" id="status" value="1" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                </div>
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