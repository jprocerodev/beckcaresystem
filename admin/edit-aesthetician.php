<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

	if (isset($_POST['submit'])) {
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$services = isset($_POST['service']) ? $_POST['service'] : [];
		$timeslots = isset($_POST['timeslot']) ? $_POST['timeslot'] : [];
		$eid = $_GET['editid'];
	
		$query = mysqli_query($con, "UPDATE users SET name='$name', email='$email' WHERE id='$eid'");
		
		if ($query) {
			$services_json = json_encode($services);
			$timeslots_json = json_encode($timeslots);
	
			$check_availability = mysqli_query($con, "SELECT * FROM tblavailability WHERE aesthetician_id='$eid'");
	
			if (mysqli_num_rows($check_availability) > 0) {
				$update_availability = mysqli_query($con, "UPDATE tblavailability 
					SET service='$services_json', availability='$timeslots_json' 
					WHERE aesthetician_id='$eid'");
			} else {
				$insert_availability = mysqli_query($con, "INSERT INTO tblavailability(aesthetician_id, service, availability) 
					VALUES('$eid', '$services_json', '$timeslots_json')");
			}
	
			if ($update_availability || $insert_availability) {
				$msg = "Aesthetician details have been updated.";
			} else {
				$msg = "Failed to update availability. Please try again.";
			}
		} else {
			$msg = "Something went wrong. Please try again.";
		}
	
		echo "<script>alert('$msg');</script>";
		echo "<script>window.location.href = 'aesthetician-list.php'</script>";
	}
	
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS | Update Services</title>

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
				<div class="forms">
					<h3 class="title1">Update Services</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Update Parlour Services:</h4>
						</div>
						<div class="form-body">
							<form method="post">
								<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
  <?php
 $cid=$_GET['editid'];
$ret=mysqli_query($con,"select * from  users INNER JOIN tblavailability ON users.id = tblavailability.aesthetician_id where users.id='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?> 

  
							 <div class="form-group"> <label for="exampleInputEmail1">Name</label> <input type="text" class="form-control" id="name" name="name"  value="<?php  echo $row['name'];?>" required="true"> </div> 
							 <div class="form-group"> <label for="exampleInputPassword1">Email</label> <input type="text" id="email" name="email" class="form-control"  value="<?php  echo $row['email'];?>" required="true"> </div>
							 <div class="form-group">
								<label>Services</label>
								<div class="service-checkboxes">
									<?php
									$selected_services = json_decode($row['service'], true);

									$ret = mysqli_query($con, "select * from tblservices");
									while ($s_row = mysqli_fetch_array($ret)) {

										$s_checked = in_array($s_row['ID'], $selected_services) ? 'checked' : '';
										$s_selected = in_array($s_row['ID'], $selected_services) ? 'selected' : '';

										echo '<div class="badge service-badge ' . $s_selected . '" data-value="' . $s_row['ID'] . '">
												' . $s_row['ServiceName'] . '
											</div>';
										echo '<input type="checkbox" name="service[]" value="' . $s_row['ID'] . '" class="service-checkbox" style="display:none;" ' . $s_checked . '>';
									}
									?>
								</div>
							</div>
							 <div class="form-group">
							<label>Availability Timeslots</label>
							<div class="timeslot-checkboxes">
								<?php
								$selected_timeslots = json_decode($row['availability'], true); 

								$start_time = strtotime("12:00 PM");
								$end_time = strtotime("10:00 PM");

								for ($time = $start_time; $time < $end_time; $time = strtotime('+1 hour', $time)) {
								$start = date("g:i A", $time);
								$end = date("g:i A", strtotime('+1 hour', $time));
								$timeslot = $start . ' - ' . $end;

								$checked = in_array($timeslot, $selected_timeslots) ? 'checked' : '';
								$selected = in_array($timeslot, $selected_timeslots) ? 'selected' : '';

								echo '<div class="badge  timeslot-badge ' . $selected . '" data-value="' . $timeslot . '">
										' . $timeslot . '
										</div>';
								echo '<input type="checkbox" name="timeslot[]" value="' . $timeslot . '" class="timeslot-checkbox" style="display:none;" ' . $checked . '>';
								}
								?>
							</div>
							</div>
							 <?php } ?>
							  <button type="submit" name="submit" class="btn btn-default">Update</button> </form> 
						</div>
						
					</div>
				
				
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
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
		<script>
		$(document).ready(function() {
			$('.timeslot-badge').on('click', function() {
			var $checkbox = $(this).next('.timeslot-checkbox');
			$(this).toggleClass('selected');

			if ($checkbox.is(':checked')) {
				$checkbox.prop('checked', false);
			} else {
				$checkbox.prop('checked', true);
			}
			});
		});
		</script>

		<script>
		$(document).ready(function() {
			$('.service-badge').on('click', function() {
			var $checkbox = $(this).next('.service-checkbox');
			$(this).toggleClass('selected');

			if ($checkbox.is(':checked')) {
				$checkbox.prop('checked', false);
			} else {
				$checkbox.prop('checked', true);
			}
			});
		});
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