<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $lockersize = $_POST['lockersize'];
        $lockerprice = $_POST['lockerprice'];
        $namecompany = $_POST['namecompany'];
        $namecountry = $_POST['namecountry'];

        $query = mysqli_query($con, "insert into tblsupplycomp(SizeofLocker,Priceoflocker,Nameofcompany,Nameofcountry) values('$lockersize','$lockerprice','$namecompany','$namecountry')");
        if ($query) {
            echo "<script>alert('Locker type added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'add-supplydep.php'; </script>";
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
        <title>HLMS | Add Suppliers</title>

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
                                <h1>Add New Supplier</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Add New Supplier</li>
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
                                    <form name="supplydep" method="post">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Type of Raw Material</label>
                                                <select class="form-control" id="lockersize" name="lockersize">
                                                    <option value="">Choose Name of Raw Material</option>
                                                    <option value="Metal locker">Metal </option>
                                                    <option value="Plastic locker">Plastic </option>
                                                    <option value="Bike locker">nickel </option>
                                                    <option value="Door locker">steel </option>
                                                    <option value="car locker">brass </option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Price of Raw Material</label>
                                                <input type="number" class="form-control" id="lockerprice" name="lockerprice" title="10 numeric characters only" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Name of Company</label>
                                                <input type="text" class="form-control" id="namecompany" name="namecompany" title="name of the company" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Name of Country</label>
                                                <input type="text" class="form-control" id="namecountry" name="namecountry" title="name of the country" required>
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