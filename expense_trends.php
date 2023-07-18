<?php
include("session.php");

$expenses = mysqli_query($con, "SELECT expensedate, SUM(expense) as total_expense FROM expenses WHERE user_id = '$userid' GROUP BY expensedate ORDER BY expensedate");
$dates = array();
$amounts = array();

while ($row = mysqli_fetch_array($expenses)) {
    $dates[] = $row['expensedate'];
    $amounts[] = $row['total_expense'];
}

$dates = json_encode($dates);
$amounts = json_encode($amounts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

    <title>Expense Manager - Expense Trends</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="expense_trends.php" class="list-group-item list-group-item-action-active "><span data-feather="bar-chart-2"></span> Expenses Trends</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action sidebar"><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i> Notifications
                                <?php
                                $query = "SELECT * FROM notifications WHERE user_id = '$userid' AND `read` = 0";
                                if ($result = mysqli_query($con, $query)) {
                                    $num_unread = mysqli_num_rows($result);
                                    if ($num_unread > 0) {
                                        echo "<span class='badge badge-danger'>$num_unread</span>";
                                    }
                                } else {
                                    echo "Query failed: " . mysqli_error($con);
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <?php
                                $query = "SELECT * FROM notifications WHERE user_id = '$userid' ORDER BY date DESC";
                                $result = mysqli_query($con, $query) or die("Something Went Wrong!");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<a class="dropdown-item" href="#">' . $row['message'] . " (" . $row['date'] . ")</a>";
                                    }
                                } else {
                                    echo '<a class="dropdown-item" href="#">No notifications</a>';
                                }
                                ?>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <h3 class="mt-4 text-center">Expense Trends</h3>
                <hr>
                <div class="row ">
                    <div class="col-md-12" style="margin:0 auto;">
                        <canvas id="chart"></canvas>
                        <div class="text-center">
                            <button id="saveButton" class="btn btn-primary">Save as Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        feather.replace()
    </script>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $dates; ?>,
                datasets: [{
                    label: 'Expenses',
                    data: <?php echo $amounts; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script src="/FileSaver.js/src/FileSaver.js"></script>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $dates; ?>,
                datasets: [{
                    label: 'Expenses',
                    data: <?php echo $amounts; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        document.getElementById('saveButton').addEventListener('click', function() {
            ctx.canvas.toBlob(function(blob) {
                saveAs(blob, 'chart.png');
            });
        });
    </script>
</body>

</html>