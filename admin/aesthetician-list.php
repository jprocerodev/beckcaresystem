<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_GET['action'])){
	if($_GET['action'] == 'delete'){
		$query=mysqli_query($con, "DELETE FROM users where id='$_GET[id]' ");

		if($query){
			echo "<script>alert('Aesthetician has been deleted.');</script>"; 
		}
	}
}

if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Aesthetician List</title>

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
					<h3 class="title1">Aesthetician List</h3>
					
					
				
					<div class="table-responsive bs-example widget-shadow">
						<h4>Aesthetician List:</h4>
						<table class="table table-bordered" id="table"> <thead> <tr> <th>#</th> <th>Name</th> <th>Email</th> <th>Service</th> <th>Availability</th> <th>Action</th> </tr> </thead> <tbody>
						<?php
						$ret=mysqli_query($con,"select * from users INNER JOIN tblavailability ON users.id = tblavailability.aesthetician_id WHERE user_type = 'aesthetician'");
						$cnt=1;
						while ($row=mysqli_fetch_array($ret)) {

						?>

						 <tr> 
						<th scope="row"><?php echo $cnt;?></th> 
						 <td><?php  echo $row['name'];?></td> 
						 <td><?php  echo $row['email'];?></td> 
						 <td>
							<?php  
							$service_ids = json_decode($row['service'], true);
							
							if (!empty($service_ids)) {
								$service_ids_str = implode(',', $service_ids);
								
								$query = "SELECT ServiceName FROM tblservices WHERE ID IN ($service_ids_str)";
								$result = mysqli_query($con, $query);
								
								while ($service_row = mysqli_fetch_array($result)) {
									echo '<span class="badge">' . $service_row['ServiceName'] . '</span> ';
								}
							}
							?>
						</td>
						 <td>
							<?php
							$availability = json_decode($row['availability'], true);
							if (!empty($availability)) {
								foreach ($availability as $time) {
									echo '<span class="badge">' . $time . '</span> ';
								}
							}
							?>
						</td>
						 <td><a href="edit-aesthetician.php?editid=<?php echo $row['aesthetician_id'];?>">Edit</a>  ||  <a href="aesthetician-list.php?action=delete&id=<?php echo $row['id'];?>" style="color:red;">Delete</a></td> 
						 </tr>   <?php 
$cnt=$cnt+1;
}?></tbody> </table> 
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
	$('#table').DataTable({
		"columnDefs": [
			{ "orderable": false, "targets": [4] } 
		]
	});
</script>
</html>
<?php }  ?>