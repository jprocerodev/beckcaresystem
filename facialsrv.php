<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>BPMS-Services</title>
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
    <link rel="stylesheet" href="css/custom.css">
</head>

<style>
     .price-text {
    font-weight: bold;
    color: black;
}
 .service-card {
    background-color: #fff;
    border: 1px solid #eaeaea;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.service-img {
    position: relative;
    overflow: hidden;
    height: auto; /* Remove fixed height, allowing the image to adjust */
    width: 100%;
}

.service-img img {
    width: 100%;
    height: 250px; /* Fixed height for image */
    object-fit: cover;
    transition: transform 0.3s ease;
}

.service-card:hover .service-img img {
    transform: scale(1.1); /* Image zoom effect on hover */
}

.service-hover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 15px;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 14px;
    line-height: 1.5;
}

.service-card:hover .service-hover {
    opacity: 1;
}

.service-name {
    padding: 15px;
}

.service-name h5 {
    font-size: 18px;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.price-text {
    font-weight: bold;
    color: #b84c64;
    margin-bottom: 0;
}

.service-description {
    padding: 0 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    max-height: 65px;
    line-height: 20px;
}

</style>
<body>
    <?php include_once('includes/header.php');?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5">
                    <h2 class="mb-0 bread">Services</h2>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Services <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="ftco-section ftco-pricing">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-10 heading-section text-center ftco-animate">
                    <h1 class="big">Pricing</h1>
                    <span class="subheading">Pricing</span>
                    <h2 class="mb-4">Our Service Prices</h2>
                 
                </div>
            </div>
            <div class="row justify-content-center pb-3">
                <div class="col-md-6 text-center">
                    <a href="aptform.php" class="btn btn-primary btn-lg">Appoint Now!</a>
                </div>
            </div>
            <div class="row">
    <?php
    $ret = mysqli_query($con, "SELECT * FROM tblservices");
    while ($row = mysqli_fetch_array($ret)) {
    ?>
    <div class="col-md-3">
        <div class="service-card">
            <div class="service-img">
                <img src="./images/<?php echo $row['imgurl'] != 0 ?  $row['imgurl'] : 'image_4.jpg' ; ?>" alt="<?php echo $row['ServiceName']; ?>" class="img-fluid">
                <div class="service-hover">
                    <p class="service-description"><?php echo $row['description']; ?></p>
                </div>
            </div>
            <div class="service-name">
                <h5><?php echo $row['ServiceName']; ?></h5>
                <p class="price-text">₱<?php echo $row['Cost']; ?>.00</p>
            </div>
        </div>
    </div>
    <?php 
    } 
    ?>
</div>


        </div>
    </section>
    
    <?php include_once('includes/footer.php');?>
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
        </svg>
    </div>

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
