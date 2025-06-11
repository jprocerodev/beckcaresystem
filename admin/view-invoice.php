<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>BPMS || Appointment Details</title>

        <!-- Include your CSS files -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
        <script src="js/wow.min.js"></script>
        <script> new WOW().init(); </script>

        <script src="js/metisMenu.min.js"></script>
        <script src="js/custom.js"></script>
        <link href="css/custom.css" rel="stylesheet">
    </head>
    <body class="cbp-spmenu-push">
        <div class="main-content">
            <!-- Left Fixed Navigation -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- Header -->
            <?php include_once('includes/header.php'); ?>
            <!-- Main Content -->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="tables" id="exampl">
                        <h3 class="title1">Appointment Details</h3>

                        <?php
                        // Get the appointment ID from the URL
                        $aptId = intval($_GET['appointmentid']);
                        $query = "SELECT a.AptNumber, a.Name, a.Email, a.PhoneNumber, a.AptDate, a.AptTime, a.TotalCost, a.PaymentStatus, a.Remark, a.PaymentMethod, a.loyalty_points, s.ServiceName, s.Cost 
                                  FROM tblappointment a 
                                  JOIN tblservices s ON FIND_IN_SET(s.ID, a.Services) > 0
                                  WHERE a.ID = '$aptId'";

                        $ret = mysqli_query($con, $query);

                        if (mysqli_num_rows($ret) > 0) {
                            while ($row = mysqli_fetch_array($ret)) {
                        ?>

                        <div class="table-responsive bs-example widget-shadow">
                            <h4>Appointment #<?php echo $row['AptNumber']; ?></h4>
                            <table class="table table-bordered" width="100%" border="1"> 
                                <tr>
                                    <th colspan="2">Customer Details</th>    
                                </tr>
                                <tr> 
                                    <th>Name</th> 
                                    <td><?php echo $row['Name']; ?></td> 
                                    <th>Phone Number</th> 
                                    <td><?php echo $row['PhoneNumber']; ?></td>
                                    <th>Email</th> 
                                    <td><?php echo $row['Email']; ?></td>
                                </tr> 
                                <tr> 
                                    <th>Appointment Date</th> 
                                    <td><?php echo $row['AptDate']; ?></td> 
                                    <th>Appointment Time</th> 
                                    <td><?php echo $row['AptTime']; ?></td> 
                                </tr> 
                                <tr> 
                                    <th>Total Cost</th> 
                                    <td><?php echo $row['TotalCost']; ?></td> 
                                    <th>Payment Status</th> 
                                    <td><?php echo $row['PaymentStatus']; ?></td>
                                </tr>
                                <tr>
                                    <th>Remark</th>
                                    <td colspan="3"><?php echo $row['Remark']; ?></td>
                                </tr>
                                <tr>
                                    <th>Loyalty Points</th>
                                    <td><?php echo $row['loyalty_points']; ?></td>
                                </tr>
                            </table> 

                            <h4>Services</h4>
                            <table class="table table-bordered" width="100%" border="1">
                                <tr>
                                    <th>#</th>
                                    <th>Service Name</th>
                                    <th>Cost</th>
                                </tr>
                                
                                <?php
                                // Get the list of services for this appointment
                                $services = explode(',', $row['Services']);
                                $cnt = 1;
                                $gtotal = 0;
                                foreach ($services as $serviceId) {
                                    $serviceQuery = "SELECT ServiceName, Cost FROM tblservices WHERE ID = '$serviceId'";
                                    $serviceResult = mysqli_query($con, $serviceQuery);
                                    $serviceRow = mysqli_fetch_array($serviceResult);

                                    if ($serviceRow) {
                                        echo "<tr>";
                                        echo "<td>" . $cnt . "</td>";
                                        echo "<td>" . $serviceRow['ServiceName'] . "</td>";
                                        echo "<td>" . $serviceRow['Cost'] . "</td>";
                                        echo "</tr>";
                                        $gtotal += $serviceRow['Cost'];
                                        $cnt++;
                                    }
                                }
                                ?>

                                <tr>
                                    <th colspan="2" style="text-align:center">Grand Total</th>
                                    <th><?php echo $gtotal; ?></th>    
                                </tr>
                            </table>

                            <p style="margin-top:1%" align="center">
                                <i class="fa fa-print fa-2x" style="cursor: pointer;" onclick="CallPrint()"></i>
                            </p>
                        </div>
                        <?php
                            }
                        } else {
                            echo "No appointment found for the given ID.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
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

    <script>
    function CallPrint() {
        var prtContent = document.getElementById("exampl");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
    </script>

    </body>
    </html>
<?php } ?>
