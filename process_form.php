<?php
session_start();
include('includes/dbconnection.php'); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    $userId = $_SESSION['user_id'];

    // Generate a unique appointment number
    $aptNumber = generateAppointmentNumber();

    // Retrieve other form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $aptDate = $_POST['aptDate'];
    $aptTime = $_POST['aptTime'];
    $selectedServices = $_POST['services']; // Array of selected services
    $remark = $_POST['remark'];
    $status = 'Pending'; // Set default status

    // Convert selected service IDs to service names
    $services = array();
    foreach ($selectedServices as $serviceId) {
        $sql = "SELECT ServiceName, Cost FROM tblservices WHERE ID='$serviceId'";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $services[] = $row['ServiceName'];
        }
    }
    $servicesStr = implode(', ', $services); // Convert array of service names to comma-separated string

    // Calculate total cost
    $totalCost = calculateTotalCost($selectedServices);

    // Insert appointment into database with auto-generated appointment number, user ID, and other details
    $insertSql = "INSERT INTO tblappointment (user_id, AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, TotalCost, Remark, Status)
                  VALUES ('$user_Id', '$aptNumber', '$name', '$email', '$phoneNumber', '$aptDate', '$aptTime', '$servicesStr', '$totalCost', '$remark', '$status')";

    if (mysqli_query($con, $insertSql)) {
        echo '<script>alert("Appointment saved successfully.");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}

$con->close();

// Function to generate a unique appointment number
function generateAppointmentNumber() {
    // You can customize the format of the appointment number here
    // For example, you can use date and time components along with a random number
    $aptNumber = 'APPT' . date('YmdHis') . mt_rand(100, 999);
    return $aptNumber;
}

// Function to calculate total cost based on selected services
function calculateTotalCost($selectedServices) {
    global $con;
    $totalCost = 0;

    foreach ($selectedServices as $serviceId) {
        $sql = "SELECT Cost FROM tblservices WHERE ID='$serviceId'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalCost += $row['Cost'];
        }
    }

    return $totalCost;
}
?>