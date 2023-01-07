<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {
  // Code for update the Contact us content
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobnum = $_POST['mobnum'];
    $pagetitle = $_POST['pagetitle'];
    $pagedes = $con->real_escape_string($_POST['pagedes']);
    $query = mysqli_query($con, "update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes',Email='$email',MobileNumber='$mobnum' where  PageType='contactus'");
    if ($query) {
      echo '<script>alert("Contact Us has been updated.")</script>';
    } else {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HLMS | Contact us</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">


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
                <h1>Contact us</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Contact us</li>
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
                    <h3 class="card-title">Fill the Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form name="subadmin" method="post">
                    <div class="card-body">
                      <?php
                      $ret = mysqli_query($con, "select * from  tblpage where PageType='contactus'");
                      $cnt = 1;
                      while ($row = mysqli_fetch_array($ret)) {
                      ?>
                        <!--Page Title--->
                        <div class="form-group">
                          <label for="exampleInputFullname">Page Title</label>
                          <input type="text" class="form-control" name="pagetitle" value="<?php echo $row['PageTitle']; ?>" required='true'>
                        </div>


                        <!--Description--->
                        <div class="form-group">
                          <label for="exampleInputFullname">Page Description</label>
                          <textarea name="pagedes" class="form-control" required='true' cols="140" rows="5"><?php echo $row['PageDescription']; ?></textarea>
                        </div>

                        <!--Email Address--->
                        <div class="form-group">
                          <label for="exampleInputFullname">Email Address</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" required='true'>
                        </div>


                        <!--Mobile Number--->
                        <div class="form-group">
                          <label for="exampleInputFullname">Mobile Number</label>
                          <input type="text" class="form-control" name="mobnum" value="<?php echo $row['MobileNumber']; ?>" required='true' maxlength="10" pattern='[0-9]+'>
                        </div>

                      <?php } ?>

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
    <script src="nic.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        bsCustomFileInput.init();
      });
    </script>
  </body>

  </html>
<?php } ?>