<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
  header('location:logout.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS | Admin Dashboard</title>

<script type="application/x-javascript">
  addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  function hideURLbar() { window.scrollTo(0,1); }
</script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/Chart.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/clndr.css" rel="stylesheet" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src="js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js"></script>
<script src="js/site.js"></script>
<link href="css/custom.css" rel="stylesheet">

<script>
  new WOW().init();
</script>
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
  <?php include_once('includes/sidebar.php'); ?>
  <?php include_once('includes/header.php'); ?>

  <!-- main content start-->
  <div id="page-wrapper" class="row calender widget-shadow">
    <div class="main-page">
      <div class="row calender widget-shadow">
        <div class="row-one">
          <div class="col-md-4 widget">
            <?php 
              $query1 = mysqli_query($con, "SELECT * FROM tblcustomers");
              $totalcust = mysqli_num_rows($query1);
            ?>
            <div class="stats-left">
              <h5>Total</h5>
              <h4>Customer</h4>
            </div>
            <div class="stats-right">
              <label><?php echo $totalcust; ?></label>
            </div>
            <div class="clearfix"></div>	
          </div>

          <div class="col-md-4 widget states-mdl">
            <?php 
              $query2 = mysqli_query($con, "SELECT * FROM tblappointment");
              $totalappointment = mysqli_num_rows($query2);
            ?>
            <div class="stats-left">
              <h5>Total</h5>
              <h4>Appointment</h4>
            </div>
            <div class="stats-right">
              <label><?php echo $totalappointment; ?></label>
            </div>
            <div class="clearfix"></div>	
          </div>

          <div class="col-md-4 widget states-last">
            <?php 
              $query3 = mysqli_query($con, "SELECT * FROM tblappointment WHERE Status='1'");
              $totalaccapt = mysqli_num_rows($query3);
            ?>
            <div class="stats-left">
              <h5>Total</h5>
              <h4>Accepted Apt</h4>
            </div>
            <div class="stats-right">
              <label><?php echo $totalaccapt; ?></label>
            </div>
            <div class="clearfix"></div>	
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="row calender widget-shadow">
        <div class="row-one">
          <div class="col-md-4 widget">
            <?php 
              $query4 = mysqli_query($con, "SELECT * FROM tblappointment WHERE Status='1'");
              $totalrejapt = mysqli_num_rows($query4);
            ?>
            <div class="stats-left">
              <h5>Total</h5>
              <h4>Rejected Apt</h4>
            </div>
            <div class="stats-right">
              <label><?php echo $totalrejapt; ?></label>
            </div>
            <div class="clearfix"></div>	
          </div>

          <div class="col-md-4 widget states-mdl">
            <?php 
              $query5 = mysqli_query($con, "SELECT * FROM tblservices");
              $totalser = mysqli_num_rows($query5);
            ?>
            <div class="stats-left">
              <h5>Total</h5>
              <h4>Services</h4>
            </div>
            <div class="stats-right">
              <label><?php echo $totalser; ?></label>
            </div>
            <div class="clearfix"></div>	
          </div>

          <div class="col-md-4 widget states-last"></div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="container mt-5 mb-5">
        <h5 class="text-center">Analytics</h5>
        <div class="form-row">
          <div class="form-group col-md-6">
            <h6 class="text-center">Most and Least Likely Booked Services</h6>
            <div class="alert alert-info" role="alert">
              <?php
              // Query for most booked service
              $sql_most = "SELECT Services, COUNT(*) as count FROM tblappointment GROUP BY Services ORDER BY count DESC LIMIT 1";
              $result_most = mysqli_query($con, $sql_most);
              $most_service = mysqli_fetch_assoc($result_most);
              echo "<strong>Most Booked Service: </strong>" . ($most_service['Services'] ?? 'No data') . " (" . ($most_service['count'] ?? 0) . " appointments)";
              ?>
            </div>
            <div class="alert alert-warning" role="alert">
              <?php
              // Query for least booked service
              $sql_least = "SELECT Services, COUNT(*) as count FROM tblappointment GROUP BY Services ORDER BY count ASC LIMIT 1";
              $result_least = mysqli_query($con, $sql_least);
              $least_service = mysqli_fetch_assoc($result_least);
              echo "<strong>Least Booked Service: </strong>" . ($least_service['Services'] ?? 'No data') . " (" . ($least_service['count'] ?? 0) . " appointments)";
              ?>
            </div>
          </div>

          <div class="form-group col-md-6">
            <h6 class="text-center">Most and Least Likely Booked Aesthetician</h6>
            <div class="alert alert-info" role="alert">
              <?php
              // Most booked aesthetician
              $sql_most_aesthetician = "SELECT users.name, COUNT(*) as count FROM tblappointment JOIN users ON tblappointment.aesthetician_id = users.id WHERE users.user_type = 'aesthetician' GROUP BY aesthetician_id ORDER BY count DESC LIMIT 1";
              $result_most_aesthetician = mysqli_query($con, $sql_most_aesthetician);
              $most_aesthetician = mysqli_fetch_assoc($result_most_aesthetician);
              echo "<strong>Most Booked Aesthetician: </strong>" . ($most_aesthetician['name'] ?? 'No data') . " (" . ($most_aesthetician['count'] ?? 0) . " appointments)";
              ?>
            </div>
            <div class="alert alert-warning" role="alert">
              <?php
              // Least booked aesthetician
              $sql_least_aesthetician = "SELECT users.name, COUNT(*) as count FROM tblappointment JOIN users ON tblappointment.aesthetician_id = users.id WHERE users.user_type = 'aesthetician' GROUP BY aesthetician_id ORDER BY count ASC LIMIT 1";
              $result_least_aesthetician = mysqli_query($con, $sql_least_aesthetician);
              $least_aesthetician = mysqli_fetch_assoc($result_least_aesthetician);
              echo "<strong>Least Booked Aesthetician: </strong>" . ($least_aesthetician['name'] ?? 'No data') . " (" . ($least_aesthetician['count'] ?? 0) . " appointments)";
              ?>
            </div>
          </div>
        </div>

        <!-- Bar Chart for Aesthetician Appointments -->
        <div class="form-row">
          <div class="form-group col-md-12">
            <div id="barchart-aesthetician" style="width: 100%; height: 400px;"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {
                'packages': ['corechart']
              });
              google.charts.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Aesthetician', 'Appointments'],
                  <?php
                  $query_aestheticians = mysqli_query($con, "SELECT users.name, COUNT(*) as count FROM tblappointment JOIN users ON tblappointment.aesthetician_id = users.id WHERE users.user_type = 'aesthetician' GROUP BY aesthetician_id");
                  while ($row = mysqli_fetch_assoc($query_aestheticians)) {
                    echo "['" . $row['name'] . "', " . $row['count'] . "],";
                  }
                  ?>
                ]);
                var options = {
                  title: 'Aesthetician Appointments',
                  width: '100%',
                  height: 400,
                  backgroundColor: '#f7f7f7',
                  legend: { position: 'top' }
                };
                var chart = new google.visualization.BarChart(document.getElementById('barchart-aesthetician'));
                chart.draw(data, options);
              }
            </script>
          </div>
        </div>

		 <!-- Chart 1: Bar Chart of Appointments by Services -->
		 <div class="form-row">
     <div class="form-group col-md-4">
      <div id="barchart-1" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart1);
     function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Service', 'Count'],
          <?php
          $sql = "SELECT Services, COUNT(*) as count FROM tblappointment GROUP BY Services";
          $fire = mysqli_query($con, $sql);
          while ($result = mysqli_fetch_assoc($fire)){
            echo "['".$result['Services']."', ".$result['count']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Appointments by Services'
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart-1'));
        chart.draw(data, options);
     }
     </script>

     <!-- Chart 2: Pie Chart of Services -->
     <div class="form-group col-md-4">
      <div id="piechart-2" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart2);
     function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Service', 'Count'],
          <?php
          $sql = "SELECT ServiceName, COUNT(*) as count FROM tblservices GROUP BY ServiceName";
          $fire = mysqli_query($con, $sql);
          while ($result = mysqli_fetch_assoc($fire)){
            echo "['".$result['ServiceName']."', ".$result['count']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Available Services'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart-2'));
        chart.draw(data, options);
     }
     </script>

     <!-- Chart 3: Pie Chart of Users by User Type -->
     <div class="form-group col-md-4">
      <div id="piechart-3" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart3);
     function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['User Type', 'Count'],
          <?php
          $sql = "SELECT user_type, COUNT(*) as count FROM users GROUP BY user_type";
          $fire = mysqli_query($con, $sql);
          while ($result = mysqli_fetch_assoc($fire)){
            echo "['".$result['user_type']."', ".$result['count']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Users by Type'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart-3'));
        chart.draw(data, options);
     }
     </script>

    </div>

    <br><br>

   <!-- Chart 4: Line Chart of Appointment Costs by Month -->
<div class="form-row">
  <div class="form-group col-md-6">
    <div id="linechart" style="width: 600px; height: 400px;"></div>
  </div>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart4);
    
    function drawChart4() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Total Cost'],
        <?php
        $months = [
          1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
          5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
          9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $sql = "SELECT MONTH(AptDate) as month, SUM(TotalCost) as total FROM tblappointment GROUP BY MONTH(AptDate)";
        $fire = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_assoc($fire)) {
          $monthName = $months[$result['month']];
          echo "['$monthName', ".$result['total']."],";
        }
        ?>
      ]);

      var options = {
        title: 'Total Appointment Costs by Month',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('linechart'));
      chart.draw(data, options);
    }
  </script>
</div>


     <!-- Chart 5: Column Chart of Appointment Costs by Year -->
     <div class="form-group col-md-4">
      <div id="columnchart_values" style="width: 600px; height: 400px;"></div>
     </div>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart5);
     function drawChart5() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Total Cost'],
          <?php
          $sql = "SELECT YEAR(AptDate) as year, SUM(TotalCost) as total FROM tblappointment GROUP BY YEAR(AptDate)";
          $fire = mysqli_query($con, $sql);
          while ($result = mysqli_fetch_assoc($fire)){
            echo "['".$result['year']."', ".$result['total']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Total Appointment Costs by Year'
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
        chart.draw(data, options);
     }
     </script>
    </div>

      </div>
    </div>
  </div>
  <!-- //main content end-->
  <div class="footer">
    <p>&copy; 2024 BPMS. All Rights Reserved | Design by <a href="http://example.com" target="_blank">Your Company</a></p>
  </div>
</div>

<script src="js/bootstrap.js"> </script>
</body>
</html>
