<?php
include('includes/dbconnection.php');

$message = '';
if (isset($_GET['token']) && isset($_POST['submit'])) {
    $token = $_GET['token'];
    $new_password = mysqli_real_escape_string($con, md5($_POST['new_password']));

    // Debug: Show token from URL
 

    // Validate token and check expiry with case-sensitive and trimmed match
    $query = "SELECT * FROM `users` WHERE BINARY TRIM(reset_token) = BINARY TRIM('$token') AND reset_expiry >= NOW() LIMIT 1";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Database query error: " . mysqli_error($con));
    }

    // Debugging output for the database retrieval
  

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

      

        // Update password and clear token if match found
        $update_query = "UPDATE `users` SET password='$new_password', reset_token=NULL, reset_expiry=NULL WHERE id='{$user['id']}'";
        if (mysqli_query($con, $update_query)) {
            $message = "Password updated successfully!";
        } else {
            $message = "Failed to update password. Please try again.";
        }
    } else {
        $message = "Invalid or expired reset link.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f9ecef;
            background: linear-gradient(to right, #ffdde1, #f9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container a {
            color: #d48c9e;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #d48c9e;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease-in-out;
        }

        .container button:hover {
            background-color: #b86d80;
            transform: scale(1.05);
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #f7f7f7;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            transition: box-shadow 0.2s ease-in-out;
        }

        .container input:focus {
            box-shadow: 0 0 5px rgba(212, 140, 158, 0.7);
        }

        .container p {
            color: #333;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <h1>Reset Password</h1>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="submit">Reset Password</button>
            <p><?= $message ?></p>
        </form>
    </div>
</body>
</html>
