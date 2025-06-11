<?php
session_start();
include('includes/dbconnection.php');

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

    // Retrieve form data and sanitize inputs to prevent SQL injection
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $selectedDate = mysqli_real_escape_string($con, $_POST['selectedDate']);
    $services = $_POST['services']; // Assuming $services is an array
    $timeSlots = $_POST['timeSlots']; // Assuming $timeSlots is an array
    $aestheticians = $_POST['aestheticians']; // Assuming $aestheticians is an array
    $method = mysqli_real_escape_string($con, $_POST['method']);
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    // Generate a unique appointment number
    $aptNumber = generateAppointmentNumber($con);

    // Set default status
    $status = $userId == 1 ? '1' : 'Pending';
    $success = true;

    foreach ($services as $serviceId) {
        // Calculate the cost for each service
        $sql = "SELECT ServiceName, Cost FROM tblservices WHERE ID='$serviceId'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $serviceName = $row['ServiceName'];
            $cost = $row['Cost'];
            $timeSlot = mysqli_real_escape_string($con, $timeSlots[$serviceId]);
            $aestheticianId = mysqli_real_escape_string($con, $aestheticians[$serviceId]);

            // Check if the selected time slot is available for the current service
            $checkSql = "SELECT * FROM tblappointment WHERE AptDate='$selectedDate' AND AptTime='$timeSlot' AND aesthetician_id='$aestheticianId'";
            $checkResult = mysqli_query($con, $checkSql);
            
            if (mysqli_num_rows($checkResult) == 0) {
                // Insert appointment into the database
                $insertSql = "INSERT INTO tblappointment (user_id, AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, aesthetician_id, Services, TotalCost, Remark, PaymentMethod, Status)
                              VALUES ('$userId', '$aptNumber', '$name', '$email', '$phoneNumber', '$selectedDate', '$timeSlot', '$aestheticianId', '$serviceName', '$cost', '$remark', '$method', '$status')";
                $success = $success && mysqli_query($con, $insertSql);
            }
        }
    }

    if ($success) {
        // Redirect to the appropriate page after successful submission
        if ($userId == 1) {
            header('Location: admin/calendar.php');
        } else {
            header('Location: AppointmentHistory.php');
        }
        exit();
    } else {
        // Log error in case of failure
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}

// Close the database connection
mysqli_close($con);

// Function to generate a unique appointment number
function generateAppointmentNumber($con) {
    do {
        $aptNumber = 'APPT' . date('YmdHis') . mt_rand(100, 999);
        $result = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber = '$aptNumber'");
    } while (mysqli_num_rows($result) > 0);

    return $aptNumber;
}
?>
