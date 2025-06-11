<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Initialize variables
$msg = '';

// Check if form is submitted
if (isset($_POST['submit'])) {
    $id = $_SESSION['user_id']; // Get user ID from session
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address']; // Get the address from the form

    // Handle file upload
    $profile_pic = $_FILES['profile_pic']['name'];
    $profile_pic_temp = $_FILES['profile_pic']['tmp_name'];

    if (!empty($profile_pic)) {
        // Define the target directory and file name
        $target_dir = "./images/";
        $target_file = $target_dir . basename($profile_pic);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($profile_pic_temp, $target_file)) {
            // Update user details in database, including profile_pic
            $query = "UPDATE users SET name='$name', email='$email', address='$address', profile_pic='$profile_pic' WHERE id='$id'";
        } else {
            $msg = "Failed to upload the new profile picture.";
        }
    } else {
        // Update user details in database without changing profile_pic
        $query = "UPDATE users SET name='$name', email='$email', address='$address' WHERE id='$id'";
    }

    // Execute the query
    $result = mysqli_query($con, $query);

    if ($result) {
        $msg = "Your profile has been updated successfully.";
    } else {
        $msg = "Failed to update your profile.";
    }
}

// Fetch user details for editing
$id = $_SESSION['user_id']; // Get user ID from session
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>BPMS - Edit Profile</title>
    
    <!-- Custom fonts and styles from example -->
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
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5">
                    <h2 class="mb-0 bread">Edit Profile</h2>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                        <span>Edit Profile <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

     <!-- Main Content -->
     <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Your Profile</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($msg)) { ?>
                                <div class="alert alert-info"><?php echo $msg; ?></div>
                            <?php } ?>
                            <div class="text-center mb-4">
    <?php if (!empty($row['profile_pic'])) { ?>
        <img src="./images/<?php echo $row['profile_pic']?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
    <?php } else { ?>
        <img src="./images/person_0.jpg" alt="Default Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
    <?php } ?>
</div>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>" required>
    </div>
    <div class="form-group">
        <label for="profile_pic">Upload New Profile Picture:</label>
        <input type="file" class="form-control" id="profile_pic" name="profile_pic">
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
