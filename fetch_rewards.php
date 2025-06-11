<?php
// Include your database connection
include 'dbconnection.php'; // Make sure the path is correct

try {
    // Prepare and execute the SQL query
    $stmt = $pdo->query("SELECT rewardname, points_required, reward_code FROM tblrewards");
    $rewards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return the results as JSON
    echo json_encode($rewards);
} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
