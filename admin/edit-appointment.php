<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../PHPMailer/src/Exception.php');
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');

session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $cid = $_GET['viewid'];
        $apttime = $_POST['apttime'];
        $aptdate = $_POST['aptdate'];
        $service = $_POST['service'];
        $aesthetician_id = $_POST['aesthetician'];
    
        $checkQuery = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptDate = '$aptdate' AND AptTime = '$apttime' AND Services = '$service' AND ID != '$cid' AND Status = 1");
        if (mysqli_num_rows($checkQuery) > 0) {
            $msg = "This time slot is already booked.";
        } else {

            $query = mysqli_query($con, "UPDATE tblappointment SET AptDate = '$aptdate', AptTime = '$apttime', Services = '$service', aesthetician_id = '$aesthetician_id' WHERE ID='$cid'");
            if ($query) {
                $msg = "Appointment has been updated.";
            } else {
                $msg = "Something went wrong. Please try again.";
            }
        }
    }
    
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>BPMS || Edit Appointment</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <link href="css/custom.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- animate CSS -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <!-- Google Fonts -->
    <!-- <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">View Appointment</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <p style="font-size:16px; color:red" align="center"><?php if(isset($msg)) { echo $msg; } ?></p>
                        <h4>View Appointment:</h4>
                        <?php
                            $cid = $_GET['viewid'];
                            $ret = mysqli_query($con, "SELECT * FROM tblappointment WHERE ID='$cid'");
                            while ($row = mysqli_fetch_array($ret)) {
                                $date = $row['AptDate'];
                                $time = $row['AptTime'];
                                $service = $row['Services'];
                                $apttime = $row['AptTime'];
                                $aptdate = $row['AptDate'];
                                $aesthetician = $row['aesthetician_id'];
                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Appointment Number</th>
                                <td><?php echo $row['AptNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $row['Name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $row['Email']; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Appointment Date</th>
                                <td><?php echo $row['AptDate']; ?></td>
                            </tr>
                            <tr>
                                <th>Appointment Time</th>
                                <td><?php echo $row['AptTime']; ?></td>
                            </tr>
                            <tr>
                                <th>Services</th>
                                <td><?php echo $row['Services']; ?></td>
                            </tr>
                            <tr>
                                <th>Apply Date</th>
                                <td><?php echo $row['ApplyDate']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo getStatusText($row['Status']); ?></td>
                            </tr>
                            <tr>
                                <th>Total Cost</th>
                                <td><?php echo $row['TotalCost']; ?></td>
                            </tr>
                            <tr>
                                <th>Payment Status</th>
                                <td><?php echo $row['PaymentStatus']; ?></td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td><?php echo $row['PaymentMethod'] == 0 ? 'Walk-In Payment' : 'Online Payment'; ?></td>
                            </tr>
                            <tr>
                                <th>UserID</th>
                                <td><?php echo $row['user_id']; ?></td>
                            </tr>
                        </table>
                        <?php } ?>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="datetime" value="<?php echo $date." at ".$time ?>">
                            <div class="form-group">
                                <label for="status">Service:</label>
                                <select name="service" class="form-control" required="true" id="serviceSelect">
                                    <?php
                                        $ret=mysqli_query($con,"select * from tblservices");
                                        while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                        <option value="<?php echo $row['ServiceName'] ?>" data-service-id="<?php echo $row['ID'] ?>" <?php echo $row['ServiceName'] == $service ? 'selected' : '' ?>>
                                            <?php echo $row['ServiceName'] ?>
                                        </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Aesthetician:</label>
                                <select class="form-control" name="aesthetician" id="aesthetician">
                                <?php
                                    $sql = mysqli_query($con, "SELECT * FROM users WHERE user_type = 'aesthetician'");
                                    while ($data = mysqli_fetch_array($sql)) {

                                ?>
                                    <option value="<?php echo $data['id'] ?>" data-aesthetician-id="<?php echo $data['id'] ?>" <?php echo $data['id']  == $aesthetician ? 'selected' : '' ?>> <?php echo $data['name'] ?> </option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Date:</label>
                                <input type="date" name="aptdate" class="form-control" id="aptdate" value="<?php echo $aptdate; ?>">
                            </div>
                            <div class="form-group">
                                <label for="status">Time:</label>
                                <select class="form-control" name="apttime" id="timeSlots">
                                <?php
                                $start_time = strtotime("12:00 PM");
                                $end_time = strtotime("10:00 PM");

                                for ($time = $start_time; $time < $end_time; $time = strtotime('+1 hour', $time)) {
                                    $start = date("g:i A", $time);
                                    $end = date("g:i A", strtotime('+1 hour', $time));
                                    $timeslot = $start . ' - ' . $end; 

                                    echo '<option value="' . $timeslot . '" ' . (($timeslot == $apttime) ? 'selected' : '') . '>' . $timeslot . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>
<script>
    function fetchBookedSlots() {
        var selectedDate = $('#aptdate').val();
        var serviceId = $('#serviceSelect option:selected').data('service-id'); 
        var aestheticianId = $('#aesthetician option:selected').data('aesthetician-id');

        if (selectedDate && serviceId && aestheticianId) {
            $.ajax({
                url: '../getBookedSlots.php',
                type: 'GET',
                data: {
                    date: selectedDate,
                    serviceId: serviceId,
                    aestheticianId: aestheticianId,
                    user_id: 0

                },
                success: function(response) {
                    var bookedSlots = response.bookedSlots;
                    var pendingSlots = response.pendingSlots;

                    $('#timeSlots option').each(function() {
                        var option = $(this);
                        var optionTime = option.val();

                        if (bookedSlots.includes(optionTime)) {
                            option.text(optionTime + ' (Booked)');
                            option.prop('disabled', true); 
                        } else if (pendingSlots.includes(optionTime)) {
                            option.text(optionTime + ' (Pending)');
                            option.prop('disabled', true); 
                        } else {
                            option.prop('disabled', false); 
                            option.text(optionTime);
                        }
                    });
                }
                
            });
        }
    }

    $('#aptdate, #serviceSelect, #aesthetician').on('change', fetchBookedSlots);

    fetchBookedSlots();

</script>
</html>
<?php } ?>

<?php
// Function to calculate total cost based on selected services
function calculateTotalCost($services) {
    global $con;
    $serviceIds = explode(', ', $services);
    $totalCost = 0;

    foreach ($serviceIds as $serviceId) {
        $sql = "SELECT Cost FROM tblservices WHERE ID='$serviceId'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalCost += $row['Cost'];
        }
    }

    return $totalCost;
}

// Function to get status text based on status code
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
