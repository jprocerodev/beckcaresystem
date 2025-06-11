<?php
include('includes/dbconnection.php');

$aestheticianId = $_GET['aestheticianId'];

// Query to get the aesthetician's availability
$sql = "SELECT availability FROM tblavailability WHERE aesthetician_id = '$aestheticianId'";
$result = mysqli_query($con, $sql);

$availability = [];

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Assuming 'availability' is stored as a JSON string in the database
    $availability = json_decode($row['availability'], true);
}

echo json_encode($availability);
?>
