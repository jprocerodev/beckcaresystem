<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['delid'])) {
        $userId = intval($_GET['delid']);
        $query = mysqli_query($con, "DELETE FROM users WHERE id='$userId'");

        if ($query) {
            $_SESSION['msg'] = "User deleted successfully";
        } else {
            $_SESSION['msg'] = "Something went wrong. Please try again.";
        }

        header('location:customer-list.php'); // Redirect back to user list page
        exit();
    }
}
?>
