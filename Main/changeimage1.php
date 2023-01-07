<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['update'])) {
    $eid = $_GET['editid'];
    $photo = $_FILES["photo"]["name"];
    $extension1 = substr($photo, strlen($photo) - 4, strlen($photo));

    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", ".pdf", ".PDF");
    if (!in_array($extension1, $allowed_extensions)) {
      echo "<script>alert('Pics has Invalid format. Only jpg / jpeg/ png /gif /pdf format allowed.');</script>";
    } else {


      $photo = md5($photo) . time() . $extension1;
      move_uploaded_file($_FILES["photo"]["tmp_name"], "photo/" . $photo);
      $query = mysqli_query($con, "update tblassignlocker set Photo='$photo' where ID='$eid'");
      if ($query) {
        echo "<script>alert('Locker assign updated successfully.');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-locker-form.php'; </script>";
      } else {
        echo "<script>alert('Something went wron. Please try again.');</script>";
      }
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
                  <form name="subadmin" method="post" enctype="multipart/form-data">
                    <?php
                    $eid = $_GET['editid'];
                    $query = mysqli_query($con, " select * from tblassignlocker where tblassignlocker.ID='$eid'");
                    $cnt = 1;
                    while ($result = mysqli_fetch_array($query)) {
                    ?>
                      <div class="card-body">
                        <!-- Username-->
                        <div class="card-body">
                          <div class="form-group">
                            <label for="text">Full Name</label>
                            <input type="text" class="form-control" id="ahname" name="ahname" value="<?php echo $result['FullName'] ?>" readonly>
                          </div>

                          <div class="form-group">
                            <label for="text">Old Photo</label>

                            <img src="photo/<?php echo $result['Photo']; ?>" width="100" height="100" value="<?php echo $result['Photo']; ?>>">
                          </div>

                          <div class="form-group">
                            <label for="text">New Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" required='true'>
                          </div>
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