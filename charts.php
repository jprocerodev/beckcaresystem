<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Fetch service names and appointment counts
$query = "SELECT Services, COUNT(*) as count FROM tblappointment GROUP BY Services";
$result = $conn->query($query);

$services = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $services[] = $row['Services'];
    $counts[] = $row['count'];
}

// Send the data as JSON
echo json_encode([
    'services' => $services,
    'counts' => $counts
]);

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Analytics</title>
        
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
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .chart-container {
            width: 60%;
            margin: 0 auto;
        }

        #myChart {
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="chart-container">
    <h2>Appointment Analytics: Services</h2>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Fetch the data dynamically using PHP
    fetch('fetch_service_data.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('myChart').getContext('2d');

        const chartData = {
            labels: data.services, // Service names
            datasets: [{
                label: 'Number of Appointments',
                data: data.counts, // Corresponding service counts
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });
    })
    .catch(error => console.error('Error fetching data:', error));
</script>

</body>
</html>
