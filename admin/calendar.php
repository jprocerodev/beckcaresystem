<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Calendar</title>

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
<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
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

<link rel="stylesheet" href="./schedule/fullcalendar/lib/main.min.css">
<script src="./schedule/fullcalendar/lib/main.min.js"></script>
<script src="./schedule/js/jquery-3.6.0.min.js"></script>

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body class="cbp-spmenu-push <?php echo $_SESSION['role'] == 'admin' ? '' : 'cbp-spmenu-push-toright';?>">
	<div class="main-content">
		<!--left-fixed -navigation-->
		
		 <?php echo $_SESSION['role'] == 'admin' ? include_once('includes/sidebar.php') : '';?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="container" id="page-container">
						<div class="col-md-12">
							<div id="calendar"></div>
						</div>
				</div>

				<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content rounded-0">
							<div class="modal-header rounded-0">
								<h5 class="modal-title">Schedule Details</h5>
							</div>
							<div class="modal-body rounded-0">
								<div class="container-fluid">
									<dl>
										<dt class="text-muted">Customer</dt>
										<dd id="title" class="fw-bold fs-4"></dd>
										<dt class="text-muted">Services</dt>
										<dd id="description" class=""></dd>
										<dt class="text-muted">Aesthetician</dt>
										<dd id="aesthetician" class=""></dd>
										<dt class="text-muted">Date</dt>
										<dd id="apt_date" class=""></dd>
										<dt class="text-muted">Time</dt>
										<dd id="apt_time" class=""></dd>
										<dt class="text-muted">Total Cost</dt>
										<dd id="total_cost" class=""></dd>
										<dt class="text-muted">Payment Status</dt>
										<dd id="payment_status" class=""></dd>
									</dl>
								</div>
							</div>
							<div class="modal-footer rounded-0">
								<div class="text-end">
									<?php if($_SESSION['role'] == 'admin'){ ?>
										<a href=""><button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button></a>
									<?php } ?>
									<!-- <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button> -->
									<button type="button" class="btn btn-secondary btn-sm rounded-0" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php 
				if($_SESSION['role'] == 'admin'){
					$schedules = $con->query("SELECT tblappointment.ID as id, tblappointment.Name as title, Services as description, AptDate as apt_date, AptTime as apt_time, TotalCost as total_cost, PaymentStatus as payment_status, users.name as aesthetician FROM `tblappointment` LEFT JOIN users ON tblappointment.aesthetician_id = users.id WHERE Status = 1");
				}else{
					$schedules = $con->query("SELECT tblappointment.ID as id, tblappointment.Name as title, Services as description, AptDate as apt_date, AptTime as apt_time, TotalCost as total_cost, PaymentStatus as payment_status, users.name as aesthetician FROM `tblappointment` LEFT JOIN users ON tblappointment.aesthetician_id = users.id WHERE Status = 1 AND users.id =  '".$_SESSION['bpmsaid']."'");
				}
				$sched_res = [];
				foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
					$timeRange = explode(' - ', $row['apt_time']);
					$startTime = date("H:i:s", strtotime($timeRange[0]));
					$endTime = date("H:i:s", strtotime($timeRange[1]));

					$row['sdate'] = date("Y-m-d", strtotime($row['apt_date'])); // Date in Y-m-d format
					$row['start_time'] = $startTime; // Start time in H:i:s format
					$row['end_time'] = $endTime; // End time in H:i:s format
					$sched_res[$row['id']] = $row;
				}
				?>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
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
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./schedule/js/script.js"></script>
</html>
<?php }  ?>