<?php
include('includes/dbconnection.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('./vendor/autoload.php');
require_once('./PHPMailer/src/PHPMailer.php');
require_once('./PHPMailer/src/Exception.php');
require_once('./PHPMailer/src/SMTP.php');

// Set the default timezone to Asia/Manila (Philippines)
date_default_timezone_set('Asia/Manila');

$message = '';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if the email exists
    $check_user = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' LIMIT 1");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);
        
        // Generate unique reset token and expiry time (1 hour ahead in Manila time)
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));  // Automatically considers Asia/Manila time

        // Store token and expiry in the database
        mysqli_query($con, "UPDATE `users` SET reset_token='$token', reset_expiry='$expiry' WHERE email='$email'");

        // Debugging: Retrieve and display stored token and expiry for verification
        $query = "SELECT reset_token, reset_expiry FROM `users` WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);
        

        // Configure PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'beckcarelounge@gmail.com';
        $mail->Password = 'cwli guxc aubu fuvf';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->isHTML(true);
        $mail->setFrom('beckcarelounge@gmail.com', 'Beckcare Aesthetic Lounge');
        $mail->addAddress($email);

        $mail->Subject = 'Password Reset Request';
        $resetLink = "http://localhost/pa/reset_password.php?token=$token"; // Replace with actual domain/IP
        $mail->Body = "Click the link to reset your password: <a href='$resetLink'>$resetLink</a>";
 
        if ($mail->send()) {
            $message = "Password reset link has been sent to your email.";
        } else {
            $message = "Failed to send email.";
        }
    } else {
        $message = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    </head>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
    
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
    
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

         * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif; /* Font style applied globally */
}

body {
    background-color: #f9ecef; /* Soft pastel pink background */
    background: linear-gradient(to right, #ffdde1, #f9ecef); /* Light gradient for a soothing effect */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container {
    background-color: #ffffff; /* White container */
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Softer shadow for elegance */
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

.container span {
    font-size: 12px;
}

.container a {
    color: #d48c9e; /* Soft rose color */
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button {
    background-color: #d48c9e; /* Soft rose for sign-in button */
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
    transition: background-color 0.3s, transform 0.2s ease-in-out; /* Added transition for hover */
}


.container button:hover {
    background-color: #b86d80; /* Darker rose on hover */
    transform: scale(1.05); /* Slight scale effect on hover */
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
    background-color: #f7f7f7; /* Light grey input fields */
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
    transition: box-shadow 0.2s ease-in-out; /* Transition for focus */
}

.container input:focus {
    box-shadow: 0 0 5px rgba(212, 140, 158, 0.7); /* Rose-colored focus shadow */
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in {
    transform: translateX(100%);
}

.sign-up {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}



.container.active .sign-up {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move {
    0%, 49.99% {
        opacity: 0;
        z-index: 1;
    }
    50%, 100% {
        opacity: 1;
        z-index: 5;
    }
}

.social-icons {
    margin: 20px 0;
}

.social-icons a {
    border: 1px solid #d48c9e; /* Soft rose border */
    border-radius: 50%; /* Circular icons */
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
    transition: background-color 0.3s ease, transform 0.2s ease-in-out; /* Smooth hover transition */
}

.social-icons a i {
    color: #d48c9e; /* Soft rose icons */
    transition: color 0.3s ease-in-out; /* Smooth transition for icon color */
}

.social-icons a:hover {
    background-color: #d48c9e; /* Rose background on hover */
    transform: scale(1.1); /* Slight scale effect */
}

.social-icons a:hover i {
    color: #fff; /* White icon on hover */
}

.toggle-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

button#login {
    background-color: #8b3a4f; /* Soft rose for sign-in button */
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

button#register {
    background-color: #8b3a4f; /* Soft rose for sign-in button */
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


.container.active .toggle-container {
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle {
    background-color: #d48c9e; /* Gradient background for beauty parlor aesthetic */
    background: linear-gradient(to right, #d48c9e, #f1a1b5); /* Soft pink and rose gradient */
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle {
    transform: translateX(50%);
}

.toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left {
    transform: translateX(-200%);
}

.container.active .toggle-left {
    transform: translateX(0);
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right {
    transform: translateX(200%);
}

/* Mobile adaptive styles */
@media only screen and (min-width: 320px) and (max-width: 767px) {
    .container {
        width: 330px;
        min-height: 500px;
    }

    .social-icons a {
        font-size: 10px;
        border-radius: 30%;
        margin: 1px 3px 3px;
        width: 30px;
        height: 30px;
    }

    h1 {
        font-size: 20px;
    }

    .container input {
        padding: 10px 15px;
        font-size: 10px;
        width: 120%;
    }

    .container button {
        padding: 5px 25px;
        font-size: 11px;
    }
}
    
</style>
<body>
<div class="container">
    <form method="POST" action="">
        <h1>Forgot Password</h1>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="submit">Send Reset Link</button>
        <p><?= $message ?></p>
    </form>
</div>

</body>
</html>
