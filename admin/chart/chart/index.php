<?php
include("header.php");
?>
<!DOCTYPE html>
<html>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
 <head>
 </head>
 <body>
  <div id="wrapper">
   <div class="container mt-5 mb-5">
    <div class="col-lg-12">
     <h5 style="text-align:center">Google Chart Generation</h5>
    </div>
    <div class="form-row">
     <div class="form-group col-md-4">
      <!-- Chart 1 start -->
      <div id="barchart-1" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['source', 'source'],
     // sql data fetch start......
     <?php
     $sql = "SELECT source, count(source) FROM tbl_sales group by source ";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['source']."',".$result['count(source)']."],";
     }
     ?>
     // sql data fetch ends......
     ]);
     var options = {
     title: 'Production By Source'
     };
     var chart = new google.visualization.BarChart(document.getElementById('barchart-1'));
     chart.draw(data, options);
     }
     </script>
     <!-- Chart 1 ends -->
     <!-- Chart 2 start -->
     <div class="form-group col-md-4">
      <div id="piechart-2" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['product', 'product' ],
      // sql data fetch start......
     <?php
     $sql = "SELECT product, count(product) FROM tbl_sales group by product";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['product']."',".$result['count(product)']."],";
     }
     ?>
      // sql data fetch end......
     ]);
     var options = {
     title: 'Product Type'
     };
     var chart = new google.visualization.PieChart(document.getElementById('piechart-2'));
     chart.draw(data, options);
     }
     </script>
     <!-- Chart 2 ends -->
     <!-- Chart 3 start -->
     <div class="form-group col-md-4">
      <div id="piechart-3" style="width: 430px; height: 280px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['breed', 'breed' ],
     <?php
     $sql = "SELECT breed, count(breed) FROM tbl_sales group by breed";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['breed']."',".$result['count(breed)']."],";
     }
     ?>
     ]);
     var options = {
     title: 'Animal by Breed'
     };
     var chart = new google.visualization.PieChart(document.getElementById('piechart-3'));
     chart.draw(data, options);
     }
     </script>
    </div>
    <!-- Chart 3 end -->
    <br><br>
    <!-- Chart 4 starts -->
    <div class="form-row">
     <div class="form-group col-md-6">
      <div id="linechart" style="width: 600px; height: 400px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['month', 'amount-ltr' ],
      // sql data fetch start......
     <?php
     $sql = "SELECT month(trn_date), count(amount) FROM tbl_sales  group by month(trn_date) asc";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['month(trn_date)']."',".$result['count(amount)']."],";
     }
     ?>
      // sql data fetch end......
     ]);
     var options = {
     title: 'Milk Sales Trend (ltr/month)',
     curveType: 'function',
     legend: { position: 'bottom' }
     };
     var chart = new google.visualization.AreaChart(document.getElementById('linechart'));
     chart.draw(data, options);
     }
     </script>
     <!-- Chart 4 ends -->

     <!-- Chart 5 Start -->
     <div class="form-group col-md-4">
      <div id="columnchart_values" style="width: 600px; height: 400px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['year', 'amount-ltr' ],
      // sql data fetch start......
     <?php
     $sql = "SELECT year, sum(amount) FROM tbl_sales where product='Milk' group by year";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['year']."',".$result['sum(amount)']."],";
     }
     ?>
      // sql data fetch end......
     ]);
     var options = {
     title: 'Milk Production by Year (Cumulative/ltr)'
     };
     var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
     chart.draw(data, options);
     }
     </script>
    </div>
    <!-- Chart 5 ends -->
    <!-- <script admin lte cdn for div row. you can use bootstrap start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"/>
   <!-- <script cdn ends -->
   </body>
  </html>