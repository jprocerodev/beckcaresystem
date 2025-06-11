<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
    exit();
}

// Handle adding a new reward
if (isset($_POST['addReward'])) {
    $rewardname = mysqli_real_escape_string($con, $_POST['rewardname']);
    $points_required = intval($_POST['points_required']);
    $query = "INSERT INTO tblrewards (rewardname, points_required) VALUES ('$rewardname', '$points_required')";
    mysqli_query($con, $query);
    header("Location: rewards.php");
}

// Handle updating a reward
if (isset($_POST['updateReward'])) {
    $reward_id = intval($_POST['reward_id']);
    $rewardname = mysqli_real_escape_string($con, $_POST['rewardname']);
    $points_required = intval($_POST['points_required']);
    $query = "UPDATE tblrewards SET rewardname='$rewardname', points_required='$points_required' WHERE reward_id='$reward_id'";
    mysqli_query($con, $query);
    header("Location: rewards.php");
}

// Handle deleting a reward
if (isset($_GET['del_id'])) {
    $reward_id = intval($_GET['del_id']);
    $query = "DELETE FROM tblrewards WHERE reward_id='$reward_id'";
    mysqli_query($con, $query);
    header("Location: rewards.php");
}
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
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>

        <div id="page-wrapper">
            <div class="main-page">
                <h3 class="title1">Manage Rewards</h3>

                <!-- Add Reward Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Reward</div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Reward Name:</label>
                                <input type="text" name="rewardname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Points Required:</label>
                                <input type="number" name="points_required" class="form-control" required>
                            </div>
                            <button type="submit" name="addReward" class="btn btn-success">Add Reward</button>
                        </form>
                    </div>
                </div>

                <!-- Display Rewards -->
                <div class="table-responsive bs-example widget-shadow">
                    <h4>Reward List:</h4>
                    <table class="table table-bordered" id="rewardsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reward Name</th>
                                <th>Points Required</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tblrewards ORDER BY created_at DESC";
                            $result = mysqli_query($con, $query);
                            $cnt = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $cnt . "</td>";
                                echo "<td>" . htmlspecialchars($row['rewardname']) . "</td>";
                                echo "<td>" . $row['points_required'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-primary editBtn' 
                                                data-id='" . $row['reward_id'] . "' 
                                                data-name='" . htmlspecialchars($row['rewardname']) . "' 
                                                data-points='" . $row['points_required'] . "'>Edit</button>
                                        <a href='?del_id=" . $row['reward_id'] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a>
                                      </td>";
                                echo "</tr>";
                                $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Edit Reward Modal -->
                <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Reward</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="reward_id" id="editRewardId">
                                    <div class="form-group">
                                        <label>Reward Name:</label>
                                        <input type="text" name="rewardname" id="editRewardName" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Points Required:</label>
                                        <input type="number" name="points_required" id="editPointsRequired" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="updateReward" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
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
    <script>
        $(document).ready(function() {
            $('#rewardsTable').DataTable();

            // Open edit modal with data prefilled
            $('.editBtn').on('click', function() {
                console.log('Edit button clicked'); // Debug: Check if button is clicked
                $('#editRewardId').val($(this).data('id'));
                $('#editRewardName').val($(this).data('name'));
                $('#editPointsRequired').val($(this).data('points'));
                $('#editModal').modal('show'); // Open modal
            });
        });
    </script>
</body>
</html>
