can u put a delete in here:

<?php 
session_start();
include('includes/dbconnection.php');

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php'); // Redirect to the login page
    exit(); // Stop script execution
}

// Get the user ID from the session
$userID = $_SESSION['user_id'];
// Handle delete request
if (isset($_POST['delete_id'])) {
    $deleteID = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM tblappointment WHERE ID='$deleteID' AND user_id='$userID'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        $deleteMsg = "Appointment deleted successfully.";
    } else {
        $deleteError = "Error deleting appointment.";
    }
}


// Fetch appointments for the specific user
$query = "SELECT * FROM tblappointment WHERE user_id='$userID'";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    $errorMsg = "No appointments found for this user.";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BPMS||Home Page</title>
        
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">

  </head>
  <style>

    
    
body {
    font-family: 'Work Sans', sans-serif;
    background-color: #f0f4f8; /* Light background color for the body */
}

.table-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 20px auto;
}

.table {
    width: 100%;
    max-width: 800px; /* Adjusted max width */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    border-collapse: collapse;
    background: linear-gradient(135deg, #ffffff, #f0f4f8); /* Gradient background */
}

.table thead {
    background-color: #4A90E2; /* Header background color */
    border-bottom: 2px solid #3e7bca; /* Bottom border for the header */
}

.table th {
    font-weight: 600;
    text-align: center;
    padding: 12px;
    font-size: 16px;
    color: #b84c64; /* Header text color */
}

.table tbody {
    background-color: #ffffff; /* White background for body */
}

.table td {
    text-align: center;
    padding: 10px;
    border-bottom: 1px solid #dddddd;
    font-size: 14px;
}

.table tr:hover {
    background-color: #e3f2fd; /* Light blue highlight on hover */
    transition: background-color 0.3s ease;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9; /* Zebra stripes for even rows */
}

.table tr:nth-child(odd) {
    background-color: #ffffff; /* Odd rows background */
}

.table th,
.table td {
    border: 1px solid #e0e0e0; /* Border for cells */
}

.table th {
    position: sticky; /* Keeps header fixed on scroll */
    top: 0; /* Position header on top */
}

.no-data {
    text-align: center;
    padding: 20px;
    font-size: 18px;
    color: #999999;
}

/* Responsive design */
@media (max-width: 600px) {
    .table-container {
        margin: 10px; /* Reduce margin for smaller screens */
    }

    .table {
        width: 100%; /* Full width for smaller screens */
    }

    .table th, .table td {
        font-size: 12px; /* Smaller font size for mobile */
    }
}



  </style>
  <body>
	  <?php include_once('includes/header.php');?>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5">
            <h2 class="mb-0 bread">Appointment History</h2>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Appointment History <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
    <section>
    <div class="container table-container">
        <?php if (isset($errorMsg)): ?>
            <div class="no-data"><?php echo $errorMsg; ?></div>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Appointment Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Total Cost</th>
                        <th>Services</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th>Loyalty Pts</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    $total_pts = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['Status'] == 1){
                            $total_pts++;
                        }
                    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $row['AptNumber']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['PhoneNumber']; ?></td>
                            <td><?php echo $row['AptDate']; ?></td>
                            <td><?php echo $row['AptTime']; ?></td>
                            <td><?php echo $row['TotalCost']; ?></td>
                            <td><?php echo $row['Services']; ?></td>
                            <td>
                                <?php if ($row['PaymentStatus'] != 'Paid' && $row['PaymentMethod'] != 0) { ?>
                                    <button class="btn <?php echo $row['Status']  == 'Pending' || $row['Status']  == '2' ? 'btn-secondary' : 'btn-primary' ?> pay-btn" data-amount="<?php echo $row['TotalCost']; ?>" data-booking-id="<?php echo $row['ID']; ?>" data-email="<?php echo $row['Email']; ?>" <?php echo $row['Status'] == 'Pending' || $row['Status']  == '2' ? 'disabled' : '' ?>>Pay</button>
                                <?php } else {
                                    echo $row['PaymentStatus'];
                                } ?>
                            </td>
                            <td><?php echo $row['PaymentMethod'] == 0 ? 'Walk-In Payment' : 'Online Payment'; ?></td>
                            <td><?php echo getStatusText($row['Status']); ?></td>
                            <td><?php echo $row['Remark']; ?></td>
                            <td><?php echo $row['Status'] == 1 ? '+1' : '0'; ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['ID']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
                <tr>
                    <th colspan="12" style="text-align:right; font-weight:bold;">Total Loyalty Points</th>
                    <th colspan="2" style="font-weight:bold;"><?php echo $total_pts; ?></th>
                </tr>
            </table>
            
        <?php endif; ?>
    </div>

<?php
function getStatusText($statusCode) {
    if ($statusCode == 1) {
        return "Approved";
    } elseif ($statusCode == 2) {
        return "Cancelled";
    } else {
        return "Pending";
    }
}
?>
</section>




   <?php include_once('includes/footer.php');?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
  <script>
    $('.pay-btn').on('click', function(){
        let amount = $(this).data('amount')
        let email = $(this).data('email')
        let bookingId = $(this).data('booking-id')

        $('#ftco-loader').addClass('show')

        $.ajax({
            url: './payment_processor.php?action=process_payment',
            type: 'POST',
            data: {amount: amount},
            success: function(response) {
                var data = JSON.parse(response);
                if (data.error) {
                    $('#ftco-loader').removeClass('show');
                    alert('Error: ' + data.error);
                    return;
                }

                var paymentWindow = window.open(data.checkout_url, '_blank', 'width=800,height=600');
                
                var checkWindowClosed = setInterval(function() {
                    if (paymentWindow.closed) {
                        clearInterval(checkWindowClosed);
                        checkPaymentStatus(data.reference_number, bookingId, email);
                    }
                }, 1000);
            }
        })
    });

    function checkPaymentStatus(referenceNumber, bookingId, email) {
        var maxAttempts = 300; 
        var interval = 1000; 

        var attempts = 0;

        var intervalId = setInterval(function() {
            attempts++;

            $.ajax({
                url: './payment_processor.php?action=check_payment',
                type: 'GET',
                data: { reference: referenceNumber },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status === 'paid') {
                        clearInterval(intervalId); 
                        $.ajax({
                            url: './payment_processor.php?action=update_payment',
                            type: 'POST',
                            data: { bookingId: bookingId, email: email },
                            success: function(response) {
                                if (response === 'payment-success') {
                                    $('#ftco-loader').removeClass('show');
                                    alert('Payment Success!');
                                    window.location.reload();
                                } else {
                                    $('#ftco-loader').removeClass('show');
                                    alert('Payment Failed');
                                }
                            }
                        });
                    }
                }
            });

            if (attempts >= maxAttempts) {
                clearInterval(intervalId); 
                $('#ftco-loader').removeClass('show');
                alert('Payment Failed! Timeout reached.');
            }
        }, interval); 
    }

  </script>
</html>