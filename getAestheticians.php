<?php
include('includes/dbconnection.php');

if (isset($_GET['serviceId'])) {
    $service_id = $_GET['serviceId'];

    $sql = "SELECT users.id, users.name, tblavailability.service, tblavailability.availability 
            FROM users 
            INNER JOIN tblavailability ON users.id = tblavailability.aesthetician_id
            WHERE JSON_CONTAINS(tblavailability.service, JSON_QUOTE(?)) 
            AND users.user_type = 'aesthetician'";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $service_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    $available_aestheticians = [];
    while ($row = $result->fetch_assoc()) {
        $available_aestheticians[] = $row;
    }

    // Return data as JSON
    echo json_encode($available_aestheticians);
}

?>
