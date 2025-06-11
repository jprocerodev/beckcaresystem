<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Customer List</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
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
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php');?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php');?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Invoice List</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Invoice List:</h4>
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Invoice Id</th> 
                                    <th>Customer Name</th> 
                                    <th>Appointment Date</th> 
                                    <th>Total Cost</th>
                                    <th>Payment Status</th>
                                    <th>Service Name</th> <!-- Added Service Name -->
                                    <th>Action</th>
                                </tr> 
                            </thead> 
                            <tbody>
<?php
// Modify the query to get data from tblappointment and join with tblservices
$ret = mysqli_query($con, "SELECT a.*, s.ServiceName, s.description FROM tblappointment a 
                           LEFT JOIN tblservices s ON FIND_IN_SET(s.ServiceName, a.Services) > 0 
                           ORDER BY a.ID DESC");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
                             <tr> 
                                <th scope="row"><?php echo $cnt;?></th> 
                                <td><?php echo $row['AptNumber'];?></td>
                                <td><?php echo $row['Name'];?></td>
                                <td><?php echo $row['AptDate'];?></td> 
                                <td><?php echo $row['TotalCost'];?></td> 
                                <td><?php echo $row['PaymentStatus'];?></td>
                                <td><?php echo $row['ServiceName']; ?> - <?php echo $row['description']; ?></td> <!-- Show service and description -->
                                <td><a href="view-invoice.php?appointmentid=<?php echo $row['AptNumber']; ?>">View</a></td>

                             </tr>   
<?php 
$cnt = $cnt + 1;
}?>
                        </tbody> 
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <?php include_once('includes/footer.php');?>
    <!--//footer-->
</div>
<!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>
