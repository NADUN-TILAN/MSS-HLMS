<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {
    // Code for Update  Sub Admin Details
    if (isset($_POST['update'])) {
        $lockersize = $_POST['lockersize'];
        $lockerprice = $_POST['lockerprice'];
        $namecompany = $_POST['namecompany'];
        $namecountry = $_POST['namecountry'];
        $ltid = intval($_GET['ltid']);
        $query = mysqli_query($con, "update tblsupplycomp set SizeofLocker='$lockersize',Priceoflocker='$lockerprice',Nameofcompany='$namecompany',Nameofcountry='$namecountry' where ID='$ltid'");
        if ($query) {
            echo "<script>alert('Supplier details updated successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-supplydep.php'; </script>";
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
        <title>HLMS | Edit/Update Supplier Details</title>

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
                                <h1>Edit Supplier Details</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Edit Supplier Details</li>
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
                                        $query = mysqli_query($con, "select * from tblsupplycomp where ID='$ltid'");
                                        $cnt = 1;
                                        while ($result = mysqli_fetch_array($query)) {
                                        ?>
                                            <div class="card-body">
                                                <!-- Username-->
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Type of Raw Material</label>
                                                    <select class="form-control" id="lockersize" name="lockersize">
                                                        <option value="<?php echo $result['ID']; ?>"><?php echo $result['SizeofLocker']; ?></option>
                                                        <option value="Metal locker">Metal</option>
                                                        <option value="Plastic locker">Plastic</option>
                                                        <option value="Bike locker">nickel</option>
                                                        <option value="Door locker">steel</option>
                                                        <option value="car locker">brass </option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="text">Price of Raw Material</label>
                                                    <input type="number" class="form-control" id="lockerprice" name="lockerprice" title="10 numeric characters only" required value="<?php echo $result['Priceoflocker']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="text">Name of Company</label>
                                                    <input type="text" class="form-control" id="namecompany" name="namecompany" title="name of the company" required value="<?php echo $result['Nameofcompany']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="text">Name of Country</label>
                                                    <input type="text" class="form-control" id="namecountry" name="namecountry" title="name of the country" required value="<?php echo $result['Nameofcountry']; ?>">
                                                </div>

                                            </div>

                                        <?php } ?>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
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