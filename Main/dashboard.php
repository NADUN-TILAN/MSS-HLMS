<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HLMS | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawPriceChart);
      google.charts.setOnLoadCallback(drawpiechart_lockcount);
      google.charts.setOnLoadCallback(drawpiechart_SalseComparison);
      google.charts.setOnLoadCallback(drawpiechart_lockerProgress);

      // locker price comparison
      function drawPriceChart() {
        var price_data = google.visualization.arrayToDataTable([
          ['Locker Type', 'Price'],
          <?php
          $query = mysqli_query($con, "SELECT * FROM tbllockertype");
          $results = array();
          while ($res = $query->fetch_assoc()) {
            $results[] = $res;
          }

          foreach ($results as $result) {
            print("['" . $result['SizeofLocker'] . "', " . (int)$result['Priceoflocker'] . "],");
          }
          ?>
        ]);

        var price_options = {
          title: 'Locks Prices Comparison'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_price'));

        chart.draw(price_data, price_options);
      }


      // locker type wise SALES comparison
      function drawpiechart_SalseComparison() {
        var sales_data = google.visualization.arrayToDataTable([
          ['Locker Type', 'Sales Count'],
          <?php
          $sales_query = mysqli_query($con, "SELECT lt.SizeofLocker, (COUNT(*) * (SELECT ilt.PriceofLocker FROM tbllockertype ilt WHERE ilt.ID=lt.ID) ) AS Total_Sale FROM tblassignlocker al INNER JOIN tbllockertype lt ON lt.ID=al.LockerSize GROUP BY al.LockerSize;");
          $sales_results = array();
          while ($res = $sales_query->fetch_assoc()) {
            $sales_results[] = $res;
          }

          foreach ($sales_results as $result) {
            print("['" . $result['SizeofLocker'] . "', " . (int)$result['Total_Sale'] . "],");
          }
          ?>
        ]);

        var sales_options = {
          title: 'Locker Type Wise Sales Comaprison'
        };

        var sales_chart = new google.visualization.PieChart(document.getElementById('piechart_sales'));

        sales_chart.draw(sales_data, sales_options);
      }




      //piechart_lockcount
      function drawpiechart_lockcount() {
        var lockcount_data = google.visualization.arrayToDataTable([
          ['Locker Type', 'Count'],
          <?php
          $query_lockcount = mysqli_query($con, "SELECT lt.SizeofLocker, (SELECT COUNT(al.LockerSize) FROM tblassignlocker al WHERE al.LockerSize = lt.ID) AS lockerCount FROM tbllockertype lt");
          $results_lockcount = array();
          while ($res = $query_lockcount->fetch_assoc()) {
            $results_lockcount[] = $res;
          }

          foreach ($results_lockcount as $result) {
            print("['" . $result['SizeofLocker'] . "', " . (int)$result['lockerCount'] . "],");
          }
          ?>
        ]);

        var lockcount_options = {
          title: 'Locker Type Wise Counts'
        };

        var chart_lockcount = new google.visualization.PieChart(document.getElementById('piechart_lockcount'));

        chart_lockcount.draw(lockcount_data, lockcount_options);
      }

      //piechart_lockerProgress
      function drawpiechart_lockerProgress() {
        var lockprogress_data = google.visualization.arrayToDataTable([
          ['Locker Progress', 'Count'],
          <?php
          $query_lockprogress = mysqli_query($con, "SELECT IF(al.Status=1, 'Completed', 'In Progress') AS progress, COUNT(*) AS progress_count FROM tblassignlocker al Join tbllockertype lt ON lt.ID=al.LockerSize GROUP BY al.Status;");
          $results_lockprogres = array();
          while ($res = $query_lockprogress->fetch_assoc()) {
            $results_lockprogres[] = $res;
          }

          foreach ($results_lockprogres as $result) {
            print("['" . $result['progress'] . "', " . (int)$result['progress_count'] . "],");
          }
          ?>
        ]);

        var lockprogress_options = {
          title: 'Production Progress'
        };

        var chart_lockprogress = new google.visualization.PieChart(document.getElementById('piechart_lockprogress'));

        chart_lockprogress.draw(lockprogress_data, lockprogress_options);
      }
    </script>

  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">



      <!-- Navbar -->
      <?php include_once('includes/navbar.php'); ?>

      <!-- Main Sidebar Container -->

      <?php include_once('includes/sidebar.php'); ?>
      <!-- Sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

              <?php if ($_SESSION['utype'] == 1) : ?>
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <?php $query = mysqli_query($con, "select id from tblbanker where UserType=0");
                      $subadmincount = mysqli_num_rows($query);
                      ?>
                      <h3><?php echo $subadmincount; ?></h3>
                      <p>Employees</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="manage-subadmins.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              <?php endif; ?>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <?php $query1 = mysqli_query($con, "select ID from tbllockertype");
                    $locktype = mysqli_num_rows($query1);
                    ?>

                    <h3><?php echo $locktype; ?></h3>

                    <p>Listed Locker Types</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-locked"></i>
                  </div>
                  <a href="manage-lockertype.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <?php $query3 = mysqli_query($con, "select ID from tblassignlocker");
                    $activelocker = mysqli_num_rows($query3);
                    ?>
                    <h3><?php echo $activelocker; ?></h3>

                    <p>Sales Lockers</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="manage-locker-form.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <!-- ./col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <section class="content">
          <div class="container-fluid">
            <br>
            <h1 class="m-0">Management KPIs</h1></br>
            <br>
            <div id="piechart_price" style="width: 900px; height: 500px;"></div></br>
            <br>
            <div id="piechart_sales" style="width: 900px; height: 500px;"></div></br>
            <br>
            <div id="piechart_lockcount" style="width: 900px; height: 500px;"></div></br>
            <br>
            <div id="piechart_lockprogress" style="width: 900px; height: 500px;"></div></br>
              </div>
        </section>

          </div>
          <!-- /.content-wrapper -->
          <?php include_once('includes/footer.php'); ?>


      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="../plugins/jquery/jquery.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- ChartJS -->
      <script src="../plugins/chart.js/Chart.min.js"></script>
      <!-- Sparkline -->
      <script src="../plugins/sparklines/sparkline.js"></script>
      <!-- JQVMap -->
      <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
      <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="../plugins/moment/moment.min.js"></script>
      <script src="../plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <!-- Summernote -->
      <script src="../plugins/summernote/summernote-bs4.min.js"></script>
      <!-- overlayScrollbars -->
      <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="../dist/js/pages/dashboard.js"></script>
  </body>

  </html>
<?php } ?>