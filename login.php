<?php
include('includes/dbconnection.php');
session_start();

$message = '';

if (isset($_POST['submit'])) {
    if($_POST['action'] == 'signin'){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, md5($_POST['password']));

        $select_users = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if (mysqli_num_rows($select_users) > 0) {
            $row = mysqli_fetch_assoc($select_users);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:C:\xampp\htdocs\bpms\admin\index.php');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
            }
        } else {
            $message = 'Incorrect email or password!';
        }
    }else{
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, md5($_POST['password']));
        $user_type = $_POST['user_type'];

        $select_users = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $message = 'User already exists!';
        }else{
            mysqli_query($con, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', 'user')") or die('query failed');
            $message = 'Registered successfully!';
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
    <title>Animated Login Form</title>
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
    font-family: 'Montserrat', sans-serif;
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
    transition: background-color 0.3s, transform 0.2s ease-in-out;;
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
    transition: background-color 0.3s, transform 0.2s ease-in-out;;
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
    
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
                <span>or use your email for registration</span>
                <input type="hidden" name="action" value="signup">
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
                <span>or use your email and password</span>
                <input type="hidden" name="action" value="signin">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="forgot_password.php">Forgot Password?</a>

                <button type="submit" name="submit">Login</button>
                <?php if ($message): ?>
                    <p style="color: red;"><?= $message; ?></p>
                <?php endif; ?>
            </form>
        </div>
        <div class="toggle-container">
    <div class="toggle">
        <div class="toggle-panel toggle-left">
            <h1>Welcome to BeckCare Lounge!</h1>
            <p>Log in to access your personalized beauty treatments, special offers, and more at BeckCare Aesthetic Clinic.</p>
            <button class="hidden" id="login">Login</button>
        </div>
        <div class="toggle-panel toggle-right">
            <h1>New to BeckCare?</h1>
            <p>Join us by creating an account to enjoy exclusive services and personalized care at BeckCare Aesthetic Clinic.</p>
            <button class="hidden" id="register">Sign up</button>
        </div>
    </div>
</div>


    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>
</html>



