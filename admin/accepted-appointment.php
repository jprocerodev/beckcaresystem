<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BPMS || Accepted Appointment</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- animate CSS -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <!-- Google Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!--//Datatables -->
    <link href="https://cdn.datatables.net/v/bs/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs/dt-2.1.8/datatables.min.js"></script>
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
                    <h3 class="title1">Accepted Appointment</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Accepted Appointment:</h4>
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Appointment Number</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = mysqli_query($con, "SELECT * FROM tblappointment WHERE Status='1' ORDER BY AptDate DESC, AptTime DESC");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php echo $row['AptNumber'];?></td>
                                    <td><?php echo $row['Name'];?></td>
                                    <td><?php echo $row['PhoneNumber'];?></td>
                                    <td><?php echo $row['AptDate'];?></td>
                                    <td><?php echo $row['AptTime'];?></td>
                                    <td><?php echo $row['PaymentStatus'];?></td>
                                    <td><a href="view-appointment.php?viewid=<?php echo $row['ID'];?>">View || <a href="edit-appointment.php?viewid=<?php echo $row['ID'];?>">Edit</a></a></td>
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
    <script src="js/bootstrap.js"></script>
</body>
<script>
	$('#table').DataTable({
		"columnDefs": [
			{ "orderable": false, "targets": [6] } 
		]
	});
</script>
</html>
<?php } ?>
