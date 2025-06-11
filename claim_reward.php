<?php
session_start();
include('includes/dbconnection.php');

// Check if the user is logged in and required POST parameters are provided
if (!isset($_SESSION['user_id']) || !isset($_POST['reward_id'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access or missing data']);
    exit();
}

$userID = $_SESSION['user_id'];
$rewardID = $_POST['reward_id'];

// Fetch reward details from tblrewards
$rewardQuery = "SELECT * FROM tblrewards WHERE reward_id = $rewardID";
$rewardResult = mysqli_query($con, $rewardQuery);
if (!$rewardResult || mysqli_num_rows($rewardResult) == 0) {
    echo json_encode(['success' => false, 'error' => 'Reward not found']);
    exit();
}

$reward = mysqli_fetch_assoc($rewardResult);
$pointsRequired = $reward['points_required'];

// Fetch user's total loyalty points
$userPointsQuery = "SELECT SUM(loyalty_points) AS total_points FROM tblappointment WHERE user_id = $userID";
$userPointsResult = mysqli_query($con, $userPointsQuery);
$userPointsRow = mysqli_fetch_assoc($userPointsResult);
$totalLoyaltyPoints = (int) $userPointsRow['total_points'];

// Check if user has enough points
if ($totalLoyaltyPoints < $pointsRequired) {
    echo json_encode(['success' => false, 'error' => 'Not enough points to claim this reward']);
    exit();
}

// Generate unique reward code
$rewardCode = strtoupper('RW-' . substr(md5(uniqid(mt_rand(), true)), 0, 8));

// Insert claim record into tblclaimed_rewards
$claimQuery = "INSERT INTO tblclaimed_rewards (user_id, reward_id, reward_code, claimed_at) 
               VALUES ($userID, $rewardID, '$rewardCode', NOW())";
$claimResult = mysqli_query($con, $claimQuery);

if ($claimResult) {
    // Deduct points (if required by your logic)
    // Update loyalty points for the user if your setup tracks remaining points
    echo json_encode(['success' => true, 'reward_code' => $rewardCode]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error claiming reward']);
}
?>
