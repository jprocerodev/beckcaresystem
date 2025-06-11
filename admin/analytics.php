<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE html>
<html>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
 <head>
  <!-- Load the Google Charts library -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
  <!-- Load the Google Charts library -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
 </head>
 <body>
 <?php include_once('includes/sidebar.php');?>
		
        <?php include_once('includes/header.php');?>
           
  <div id="page-wrapper">
   <div class="container mt-5 mb-5">
    <div class="col-lg-12">
     <h5 style="text-align:center">Google Chart Generation</h5>
    </div>

    <!-- Section: Most and Least Likely Services and Aesthetician -->
    <div class="form-row">
      <div class="form-group col-md-6">
        <h6 style="text-align:center">Most and Least Likely Booked Services</h6>
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
        <h6 style="text-align:center">Most and Least Likely Booked Aesthetician</h6>
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
        <div id="barchart-aesthetician" style="width: 100%; height: 500px;"></div>
      </div>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartAesthetician);
      function drawChartAesthetician() {
        var data = google.visualization.arrayToDataTable([
          ['Aesthetician', 'Appointments'],
          // SQL data fetch start...
          <?php
          $sql_aesthetician_chart = "SELECT users.name, COUNT(*) as count FROM tblappointment JOIN users ON tblappointment.aesthetician_id = users.id WHERE users.user_type = 'aesthetician' GROUP BY aesthetician_id";
          $fire_aesthetician_chart = mysqli_query($con, $sql_aesthetician_chart);
          while ($result = mysqli_fetch_assoc($fire_aesthetician_chart)){
            echo "['".$result['name']."', ".$result['count']."],";
          }
          ?>
          // SQL data fetch end...
        ]);

        var options = {
          title: 'Appointments per Aesthetician'
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart-aesthetician'));
        chart.draw(data, options);
      }
      </script>
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
          $sql = "SELECT MONTH(AptDate) as month, SUM(TotalCost) as total FROM tblappointment GROUP BY MONTH(AptDate)";
          $fire = mysqli_query($con, $sql);
          while ($result = mysqli_fetch_assoc($fire)){
            echo "['".$result['month']."', ".$result['total']."],";
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"/>
   </body>
  </html>
