<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $sername = $_POST['sername'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $eid = $_GET['editid'];

        $target_dir = "../images/";
        $imageFileName = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $imageFileName;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
            $query = mysqli_query($con, "UPDATE tblservices SET ServiceName='$sername', Cost='$cost', description='$description', category='$category', imgurl='$imageFileName' WHERE ID='$eid'");
        }else{
            $query = mysqli_query($con, "UPDATE tblservices SET ServiceName='$sername', Cost='$cost', description='$description', category='$category' WHERE ID='$eid'");
        }

        if ($query) {
            $msg = "Service has been Updated.";
        } else {
            $msg = "Something Went Wrong. Please try again";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>BPMS | Update Services</title>
    <script type="application/x-javascript">addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
</head>
<body class="cbp-spmenu-push">
<div class="main-content">
    <?php include_once('includes/sidebar.php');?>
    <?php include_once('includes/header.php');?>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="forms">
                <h3 class="title1">Update Services</h3>
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Update Parlour Services:</h4>
                    </div>
                    <div class="form-body">
                        <form method="post" enctype="multipart/form-data">
                            <p style="font-size:16px; color:red" align="center"><?php if ($msg) { echo $msg; } ?></p>
                            <?php
                            $cid = $_GET['editid'];
                            $ret = mysqli_query($con, "SELECT * FROM tblservices WHERE ID='$cid'");
                            while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Service Name</label>
                                <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" value="<?php echo $row['ServiceName']; ?>" required="true">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Cost</label>
                                <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="<?php echo $row['Cost']; ?>" required="true">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="4" required="true"><?php echo $row['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category</label>
                                <select class="form-control" id="category" name="category" required="true">
                                    <option value="Facial" <?php if ($row['category'] == 'Facial') echo 'selected="selected"'; ?>>Facial Services</option>
                                    <option value="Underarm" <?php if ($row['category'] == 'Underarm') echo 'selected="selected"'; ?>>Underarm Services</option>
                                    <option value="Slimming & Contouring" <?php if ($row['category'] == 'Slimming & Contouring') echo 'selected="selected"'; ?>>Slimming & Contouring/option>
                                    <option value="Semi Permanent Hair Removal" <?php if ($row['category'] == 'Semi Permanent Hair Removal') echo 'selected="selected"'; ?>>Semi Permanent Hair Removal</option>
                                    <option value="Permanent Hair Removal" <?php if ($row['category'] == 'Permanent Hair Removal') echo 'selected="selected"'; ?>>Permanent Hair Removal</option>
                                    <option value="Eyelash Extension" <?php if ($row['category'] == 'Eyelash Extension') echo 'selected="selected"'; ?>>Eyelash Extension</option>
                                    <option value="Hair Threading" <?php if ($row['category'] == 'Hair Threading') echo 'selected="selected"'; ?>>Hair Threading</option>
                                    <option value="Gluthatione Infusion" <?php if ($row['category'] == 'Gluthatione Infusion') echo 'selected="selected"'; ?>>Gluthatione Infusion</option>
                                    <option value="Meso Lipo" <?php if ($row['category'] == 'Meso Lipo') echo 'selected="selected"'; ?>>Meso Lipo</option>
                                    <option value="Botox / Slim Arms / No More Wrinkle" <?php if ($row['category'] == 'Gluthatione Infusion') echo 'selected="selected"'; ?>>Botox / Slim Arms / No More Wrinkle</option>
                                    <option value="Slimming Packages" <?php if ($row['category'] == 'Gluthatione Infusion') echo 'selected="selected"'; ?>>Slimming Packages</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" id="image" name="image" class="form-control" placeholder="Cost" accept="image/*">
                            </div>
                            <?php } ?>
                            <button type="submit" name="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
</div>
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
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php } ?>
