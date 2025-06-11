<?php
include('includes/dbconnection.php');
session_start();

$date = $_GET['date'];
$serviceId = $_GET['serviceId']; 
$aestheticianId = $_GET['aestheticianId'];
$user_id =  $_SESSION['user_id'] ?? 0;  // Logged-in user ID or 0 if not logged in

$bookedSlots = [];
$pendingSlots = [];

if ($date && $serviceId) {
    $sql = "SELECT *, tblservices.ID as service_id FROM tblappointment 
            INNER JOIN tblservices ON tblappointment.services = tblservices.ServiceName 
            WHERE AptDate='$date' AND (Status = 1 OR Status = 'Pending')";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        // Booked slots logic
        if ($row['Status'] == 1) {
            // If the appointment is confirmed (Status = 1), add to bookedSlots
            if ($row['user_id'] == 0 || $row['user_id'] == $user_id || 
                ($row['service_id'] == $serviceId && $row['aesthetician_id'] == $aestheticianId)) {
                $bookedSlots[] = $row['AptTime'];
            }
        }

        // Pending slots should be user-specific
        if ($row['Status'] == 'Pending' && $row['user_id'] == $user_id) {
            // Only add pending slots if they belong to the logged-in user
            $pendingSlots[] = $row['AptTime'];
        }
    }
}

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode(['bookedSlots' => $bookedSlots, 'pendingSlots' => $pendingSlots]);

$con->close();
?>
