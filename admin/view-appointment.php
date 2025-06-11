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
        $remark = $_POST['remark'];
        $status = $_POST['status'];
        $paymentStatus = $_POST['paymentStatus'];
        $email = $_POST['email'];
        $datetime = $_POST['datetime'];
        $aesthetician_email = $_POST['aesthetician_email'];
    
        $loyalty_points = $_POST['loyalty_points']; // New loyalty points input

        // Update the appointment with remark, status, payment status, and loyalty points
        $query = mysqli_query($con, "UPDATE tblappointment SET Remark='$remark', Status='$status', PaymentStatus='$paymentStatus', loyalty_points='$loyalty_points' WHERE ID='$cid'");
        
        
        if ($query) {
            $mail = new PHPMailer;
    
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'beckcarelounge@gmail.com';
            $mail->Password = 'cwli guxc aubu fuvf';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->isHTML(true); 
            $mail->setFrom('beckcarelounge@gmail.com', 'Beckcare Aesthetic Lounge');
            $mail->addAddress($email); 
    
            if ($status == 1) {
                $message = "Hi there,<br><br>
                    This is to inform you that your appointment request on the date <strong>$datetime</strong> has been <strong>approved!.</strong><br><br>
                    Thanks,<br>
                    Beckcare Aesthetic Lounge";
                    
                $mail->Subject = 'Appointment Approved';
                
                $mailAesthetician = new PHPMailer;
                $mailAesthetician->isSMTP();
                $mailAesthetician->Host = 'smtp.gmail.com';
                $mailAesthetician->SMTPAuth = true;
                $mailAesthetician->Username = 'beckcarelounge@gmail.com';
                $mailAesthetician->Password = 'cwli guxc aubu fuvf';
                $mailAesthetician->SMTPSecure = 'tls';
                $mailAesthetician->Port = 587;
                $mailAesthetician->isHTML(true);
                $mailAesthetician->setFrom('beckcarelounge@gmail.com', 'Beckcare Aesthetic Lounge');
                $mailAesthetician->addAddress($aesthetician_email); 
    
                $messageAesthetician = "Dear Aesthetician,<br><br>
                    The appointment on <strong>$datetime</strong> has been <strong>approved</strong>.<br><br>
                    Please prepare accordingly.<br><br>
                    Thanks,<br>
                    Beckcare Aesthetic Lounge";
    
                $mailAesthetician->Subject = 'New Appointment Approved';
                $mailAesthetician->Body = $messageAesthetician;
                $mailAesthetician->send(); 
            } else {
                $message = "Hi there,<br><br>
                    We regret to inform you that your appointment request on the date <strong>$datetime</strong> has been <strong>rejected.</strong><br><br>
                    Thanks,<br>
                    Beckcare Aesthetic Lounge";
                    
                $mail->Subject = 'Appointment Rejected';
            }
    
            $mail->Body = $message;
            
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
    
            $msg = "All remarks have been updated.";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
    }
    
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>BPMS || View Appointment</title>
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
</head>
<style>.print-logo {
            display: none; /* Hide the logo by default */
        }
        
        @media print {
            .print-logo {
                display: block; /* Show logo only during print */
                text-align: center;
                margin-top: 20px;
            }
        }</style>
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
                            $ret = mysqli_query($con, "SELECT *, tblappointment.Email AS client_email, users.email AS aesthetician_email FROM tblappointment INNER JOIN users ON tblappointment.aesthetician_id = users.id WHERE tblappointment.ID='$cid'");
                            while ($row = mysqli_fetch_array($ret)) {
                                $date = $row['AptDate'];
                                $time = $row['AptTime'];
                                $email = $row['client_email'];
                                $status = $row['Status'];
                                $paystatus = $row['PaymentStatus'];
                                $aesthetician_email = $row['aesthetician_email'];
                        ?>
                        <div id="appointment-details">
                        <table class="table table-bordered">

                        <body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- This logo will only appear in print -->
        <div class="print-logo">
            <img src="images/logo.jpeg" alt="Logo" style="width: 150px; height: auto;">
        </div>
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
                                <td><?php echo $row['client_email']; ?></td>
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
                                <td><?php echo $row['PaymentMethod'] == 0 ? 'Walk-In Paymenr' : 'Online Payment'; ?></td>
                            </tr>
                            <tr>
                                <th>UserID</th>
                                <td><?php echo $row['user_id']; ?></td>
                            </tr>

                            <tr>
                                <th>Loyalty Points</th>
                                <td><?php echo $row['loyalty_points']; ?></td> <!-- Display loyalty points -->
                            </tr>
                        </table>
                        </div>
                        <?php } ?>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="aesthetician_email" value="<?php echo $aesthetician_email ?>">
                            <input type="hidden" name="email" value="<?php echo $email ?>">
                            <input type="hidden" name="datetime" value="<?php echo $date." at ".$time ?>">
                            <div class="form-group">
                                <label for="remark">Remark:</label>
                                <textarea name="remark" class="form-control" rows="4" required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" required="true">
                                <option value="1" <?php echo $status == 1 ? 'selected' : '' ?>>Pending</option>
                                    <option value="1" <?php echo $status == 1 ? 'selected' : '' ?>>Approve</option>
                                    <option value="2" <?php echo $status == 2 ? 'selected' : '' ?>>Cancel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paymentStatus">Payment Status:</label>
                                <select name="paymentStatus" class="form-control" required="true">
                                    <option value="Paid" <?php echo $paystatus == 'Paid' ? 'selected' : '' ?>>Paid</option>
                                    <option value="Not Paid" <?php echo $paystatus == 'Not Paid' ? 'selected' : '' ?>>Not Paid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="loyalty_points">Loyalty Points:</label>
                                <input type="number" name="loyalty_points" class="form-control" placeholder="Enter loyalty points" required>
                            </div>
                               <!-- Print Receipt Button -->
                        <button class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>

                            <button type="submit" name="submit" class="btn btn-primary">Update Remark, Status & Payment Status</button>
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
        function printReceipt() {
    var content = document.getElementById('appointment-details').innerHTML;
    var printWindow = window.open('', '_blank', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Print Receipt</title>');
    printWindow.document.write('<link rel="stylesheet" href="css/bootstrap.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

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
