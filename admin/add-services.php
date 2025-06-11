<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $sername = $_POST['sername'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        $target_dir = "../images/";
        $imageFileName = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $imageFileName;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $query = mysqli_query($con, "INSERT INTO tblservices(ServiceName, Cost, Description, Category, imgurl) VALUES ('$sername','$cost','$description','$category', '$imageFileName')");
        if ($query) {
            echo "<script>alert('Service has been added.');</script>";
            echo "<script>window.location.href = 'add-services.php'</script>";
            $msg = "";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>BPMS | Add Services</title>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add Services</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Parlour Services:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                            echo $msg;
                                                                                        }  ?> </p>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Service Name</label>
                                    <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" value="" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cost</label>
                                    <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Description" rows="4" required="true"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="Facial">Facial Services</option>
										<option value="Slimming & Contouring">Slimming % Countouring</option>
										<option value="Semi Permanent Hair Removal Laser">Semi Permanent Hair Removal Laser</option>
                                        <option value="Underarm">Underarm Services</option>
                                        <option value="Permanent Hair Removal Laser">Permanent Hair Removal Laser</option>
										<option value="Eyelash Extension">Eyelash Extension</option>
										<option value="Hair Threading">Hair Threading</option>
										<option value="Gluthatione Infusion">Gluthatione Infusion</option>
										<option value="Meso Lipo">Meso Lipo</option>
										<option value="Botox / Slim Arms / No More Wrinkle">Botox / Slim Arms / No More Wrinkle</option>
										<option value="Slimming Packages">Slimming Packages</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Image</label>
                                    <input type="file" id="image" name="image" class="form-control" placeholder="Cost" accept="image/*" required="true">
                                </div>

                                <button type="submit" name="submit" class="btn btn-default">Add</button>
                            </form>
                        </div>

                    </div>


                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>

</html>
