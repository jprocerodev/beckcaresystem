<?php
 include('includes/dbconnection.php');

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exists!';
    }else{
        if($pass != $cpass){
            $message[] = 'Confirm password not matched!';
        }else{
            mysqli_query($con, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'Registered successfully!';
            header('location:login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #b84c64;
    font-family: 'Montserrat', sans-serif;
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
    font-size: 24px;
    color: #333333;
}

.box {
    width: 100%;
    padding: 20px; /* Increased padding for bigger input fields */
    margin-bottom: 20px;
    border: 2px solid #b84c64;
    border-radius: 10px; /* Increased border radius for a softer look */
    background-color: #f8f9fa;
    color: #333333;
    font-weight: bold;
    transition: border-color 0.3s ease;
}

.box:focus {
    border-color: #0056b3;
    outline: none;
}

.btn {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 5px;
    background-color: #b84c64;
    color: #fff;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #7f2436;
}

p {
    color: #333333;
    text-align: center;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.logo-container {
    text-align: center;
    margin-bottom: 20px;
}

.logo-container img {
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Making the logo circular */
    background-color: #ffffff; /* Adding a white background to the logo */
}
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <div class="logo-container mb-4">
                    <img src="logo.jpg" alt="Logo">
                </div>
                <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '
                            <div class="alert alert-danger">'.$message.'</div>
                        ';
                    }
                }
                ?>
                <form action="" method="post">
                    <input type="text" name="name" placeholder="Enter your name" required class="box">
                    <input type="email" name="email" placeholder="Enter your email" required class="box">
                    <input type="password" name="password" placeholder="Enter your password" required class="box">
                    <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
                    <select name="user_type" class="box">
                        <option value="user">User</option>
                       
                    </select>
                    <input type="submit" name="submit" value="Register Now" class="btn">
                    <p></p>
                    <p>Already have an account? <a href="login.php">Login Now</a></p>
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
