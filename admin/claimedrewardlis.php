<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BPMS || Claimed Rewards</title>
    <!-- CSS and JavaScript files -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs/dt-2.1.8/datatables.min.js"></script>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- Sidebar and Header -->
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>

        <!-- Main content start -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Claimed Rewards List</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Claimed Rewards:</h4>
                        <table class="table table-bordered" id="claimedRewardsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Reward Name</th>
                                    <th>Points Required</th>
                                    <th>Claim Date</th>
                                    <th>Reward Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "
                                    SELECT u.name AS user_name, u.email, r.rewardname, r.points_required, 
                                           cr.claimed_at, cr.reward_code
                                    FROM tblclaimed_rewards cr
                                    INNER JOIN users u ON cr.user_id = u.id
                                    INNER JOIN tblrewards r ON cr.reward_id = r.reward_id
                                    ORDER BY cr.claimed_at DESC
                                ";
                                $result = mysqli_query($con, $query);
                                $cnt = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $cnt . "</td>";
                                    echo "<td>" . $row['user_name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['rewardname'] . "</td>";
                                    echo "<td>" . $row['points_required'] . "</td>";
                                    echo "<td>" . $row['claimed_at'] . "</td>";
                                    echo "<td>" . $row['reward_code'] . "</td>";
                                    echo "</tr>";
                                    $cnt++;
                                }
                                ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
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
        <!-- Scrolling js -->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"> </script>
    </div>
    <script>
        $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [5] } // Updated the target index for the action column
            ]
        });
    </script>

<script src="js/bootstrap.js"></script>
        <script>
            $(document).ready(function() {
                $('#claimedRewardsTable').DataTable({
                    "order": [[5, "desc"]] // Order by claim date
                });
            });
        </script>
</body>
</html>
<?php } ?>