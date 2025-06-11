<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobilenum = $_POST['mobilenum'];
        $gender = $_POST['gender'];
        $details = $_POST['details'];

        $eid = $_GET['editid'];

        // Using prepared statements for security
        $stmt = $con->prepare("UPDATE tblcustomers SET Name=?, Email=?, MobileNumber=?, Gender=?, Details=? WHERE ID=?");
        $stmt->bind_param("ssssss", $name, $email, $mobilenum, $gender, $details, $eid);

        if ($stmt->execute()) {
            $msg = "Customer detail has been updated.";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
        $stmt->close();
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>BPMS | Update Services</title>
    <script type="application/x-javascript">
        addEventListener("load", function () {
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
                    <h3 class="title1">Update Services</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Update Parlour Services:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"><?php if ($msg) {
                                    echo $msg;
                                } ?></p>
                                <?php
                                $cid = $_GET['editid'];
                                $ret = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$cid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mobile Number</label>
                                    <input type="text" id="mobilenum" name="mobilenum" class="form-control" value="<?php echo htmlspecialchars($row['MobileNumber']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gender</label>
                                    <div>
                                        <input type="radio" id="genderMale" name="gender" value="Male" <?php echo ($row['Gender'] == "Male") ? 'checked' : ''; ?>> Male
                                        <input type="radio" id="genderFemale" name="gender" value="Female" <?php echo ($row['Gender'] == "Female") ? 'checked' : ''; ?>> Female
                                        <input type="radio" id="genderTransgender" name="gender" value="Transgender" <?php echo ($row['Gender'] == "Transgender") ? 'checked' : ''; ?>> Transgender
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea class="form-control" id="details" name="details" placeholder="Details" required rows="12" cols="4"><?php echo htmlspecialchars($row['Details']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Creation Date</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['CreationDate']); ?>" readonly>
                                </div>

                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-default">Update</button>
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

        showLeftPush.onclick = function () {
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
<?php } ?>
