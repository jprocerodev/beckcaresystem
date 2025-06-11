<?php
include('includes/dbconnection.php');
session_start();

$message = '';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, md5($_POST['password']));

    $select_users = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        }
    } else {
        $message = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #b84c64;
    font-family: 'Arial', sans-serif;
}

.form-container {
    max-width: 400px;
    margin: 100px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
}

.form-container h3 {
    margin-bottom: 20px;
    text-align: center;
    font-size: 28px;
    color: #b84c64;
}

.box {
    width: 100%;
    padding: 20px;
    margin-bottom: 30px;
    border: 2px solid #b84c64;
    border-radius: 12px;
    background-color: #f8f9fa;
    color: #333333;
    font-weight: bold;
    transition: border-color 0.3s ease;
    font-size: 18px;
    font-family: 'Arial', sans-serif;
}

.box:focus {
    border-color: #8f3648;
    outline: none;
}

.btn {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 8px;
    background-color: #b84c64;
    color: #fff;
    font-weight: bold;
    transition: background-color 0.3s ease;
    font-size: 18px;
    font-family: 'Arial', sans-serif;
}

.btn:hover {
    background-color: #8f3648;
}

.logo-container {
    text-align: center;
    margin-bottom: 30px;
}

.logo-container img {
    max-width: 150px;
    height: auto;
    border-radius: 50%;
}

p {
    color: #333333;
    text-align: center;
}

a {
    color: #b84c64;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <div class="logo-container">
                    <img src="logo.jpg" alt="Logo">
                </div>
       
                <form action="" method="post">
                    <?php if(!empty($message)) echo '<div class="alert alert-danger">'.$message.'</div>'; ?>
                    <input type="email" name="email" placeholder="Enter your email" required class="box">
                    <input type="password" name="password" placeholder="Enter your password" required class="box">
                    <input type="submit" name="submit" value="Login" class="btn">
                    <p></p>
                    <p>Don't have an account? <a href="register.php">Register Now</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
