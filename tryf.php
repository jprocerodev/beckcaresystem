 
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


  /* Modal styling */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    text-align: center;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    position: relative;
    font-family: 'Work Sans', sans-serif;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 1.8em;
    font-weight: bold;
    color: #333;
    cursor: pointer;
}

/* Header and paragraph styling */
.modal h2 {
    color: #b84c64; /* Custom accent color for the header */
    margin-bottom: 15px;
    font-size: 1.5em;
}

.modal p {
    color: #555;
    margin-bottom: 20px;
    font-size: 1.1em;
}

/* Table styling */
.rewards-table {
    width: 100%;
    border-collapse: collapse;
}

.rewards-table th,
.rewards-table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

.rewards-table th {
    background-color: #b84c64; /* Custom color for table headers */
    color: #fff;
    font-weight: 700;
}

.rewards-table td {
    font-size: 1em;
    color: #333;
}

/* Points highlight styling */
.points-highlight {
    font-weight: bold;
    color: #b84c64; /* Custom color for points highlight */
    font-size: 1.2em;
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
        <button type="submit" class="btn btn-danger" <?php echo $row['PaymentStatus'] == 'Paid' ? 'disabled' : ''; ?>>Cancel</button>
    </form>
</td>

                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
               <!-- Loyalty Points Row with Button in Action Column -->
 <!-- Loyalty Points Table Row with Button in Action Column -->
 <!-- Loyalty Points Row with Button in Action Column -->
<tr>
    <th colspan="12" style="text-align:right; font-weight:bold;">Total Loyalty Points</th>
    <th colspan="1" style="font-weight:bold;">
        <?php echo $total_pts; ?>
    </th>
    <th style="text-align: left;">
        <!-- Button to open the rewards modal -->
        <button class="btn btn-info" id="loyaltyPointsBtn">See Rewards</button>
    </th>
</tr>  
</table>

                                        
<!-- Modal Structure with Styled Table -->
<div id="rewardsModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Rewards for Reaching Loyalty Points</h2>
        <p>Reach these point milestones to unlock rewards:</p>
        <table class="rewards-table">
            <thead>
                <tr>
                    <th>Points</th>
                    <th>Reward</th>
                    <th>Action</th> <!-- Column for action buttons -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="points-highlight">1 Point</span></td>
                    <td>Free Massage</td>
                    <td>
                        <button class="btn btn-success claim-btn" data-points="1">Claim</button>
                    </td>
                </tr>
                <tr>
                    <td><span class="points-highlight">10 Points</span></td>
                    <td>10% discount on next service</td>
                    <td>
                        <button class="btn btn-success claim-btn" data-points="10">Claim</button>
                    </td>
                </tr>
                <tr>
                    <td><span class="points-highlight">20 Points</span></td>
                    <td>Free service upgrade</td>
                    <td>
                        <button class="btn btn-success claim-btn" data-points="20">Claim</button>
                    </td>
                </tr>
                <tr>
                    <td><span class="points-highlight">30 Points</span></td>
                    <td>$20 voucher for next appointment</td>
                    <td>
                        <button class="btn btn-success claim-btn" data-points="30">Claim</button>
                    </td>
                </tr>
                <!-- Add more rewards as needed -->
            </tbody>
        </table>
    </div>
</div>

            
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
    // Adding event listener for claim buttons
    document.querySelectorAll('.claim-btn').forEach(button => {
        button.addEventListener('click', function() {
            const requiredPoints = parseInt(this.getAttribute('data-points'));
            const totalPoints = <?php echo $total_pts; ?>; // Fetch the total points from PHP

            if (totalPoints >= requiredPoints) {
                // Generate a unique code for claiming the reward
                const claimCode = 'CODE-' + Math.random().toString(36).substring(2, 8).toUpperCase();
                
                // You can implement your database logic here to save the claimed reward and code

                alert('Reward claimed! Your code is: ' + claimCode);
                // Optionally, you can disable the button or provide feedback
                this.disabled = true; // Disable the button after claiming
                this.textContent = 'Claimed'; // Change button text
            } else {
                alert('You do not have enough points to claim this reward.');
            }
        });
    });
</script>
  <script>
document.getElementById('loyaltyPointsBtn').onclick = function() {
    document.getElementById('rewardsModal').style.display = 'flex';
};

document.getElementById('closeModal').onclick = function() {
    document.getElementById('rewardsModal').style.display = 'none';
};

// Add click event for claim button
document.getElementById('claimRewardBtn').onclick = function() {
    const totalPoints = <?php echo $total_pts; ?>; // Get total points from PHP
    let rewardCode = '';

    if (totalPoints >= 10 && totalPoints < 20) {
        rewardCode = 'REWARD10'; // Example code for 10 points
    } else if (totalPoints >= 20) {
        rewardCode = 'REWARD20'; // Example code for 20 points
    } else {
        document.getElementById('claimResult').innerText = 'You do not have enough points to claim a reward.';
        return; // Exit if points are not enough
    }

    // Display generated reward code
    document.getElementById('claimResult').innerText = 'Congratulations! Your reward code is: ' + rewardCode;
};
</script>
  <script>
document.getElementById("loyaltyPointsBtn").onclick = function() {
    document.getElementById("rewardsModal").style.display = "flex";
};

document.getElementById("closeModal").onclick = function() {
    document.getElementById("rewardsModal").style.display = "none";
};

// Close modal if clicking outside content
window.onclick = function(event) {
    var modal = document.getElementById("rewardsModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};
</script>
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