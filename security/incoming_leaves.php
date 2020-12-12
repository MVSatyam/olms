<?php
include '../dbconnect.php';
session_start();

if ($_SESSION['security'] != NULL) {
    # code...
    $security_id = $_SESSION['security'];

    $sql = "SELECT * FROM leaves WHERE permission='granted' and outgoing='yes' and incoming='no' ORDER BY id ASC";
    $query = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($query);
    $all_incoming_leaves = "";

    if ($count == 0) {
        # code...
        $all_incoming_leaves = $all_incoming_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered table-fixed" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id</th>
                                                    <th class="th-sm">User_Id</th>
                                                    <th class="th-sm">Reason</th>
                                                    <th class="th-sm">Applied-Date</th>
                                                    <th class="th-sm">From</th>
                                                    <th class="th-sm">To</th>
                                                    <th class="th-sm">Left</th>
                                                    <th class="th-sm">Report</th>
                                                    <th class="th-sm">Permission</th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead> 
                                        </table>
                                    </div>';
    } else {
        $all_incoming_leaves = $all_incoming_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered table-fixed" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id</th>
                                                    <th class="th-sm">User_Id</th>
                                                    <th class="th-sm">Reason</th>
                                                    <th class="th-sm">Applied-Date</th>
                                                    <th class="th-sm">From</th>
                                                    <th class="th-sm">To</th>
                                                    <th class="th-sm">Left</th>
                                                    <th class="th-sm">Report</th>
                                                    <th class="th-sm">Permission</th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        while ($leave_row = mysqli_fetch_assoc($query)) {

            $all_incoming_leaves = $all_incoming_leaves . '<tr>
                                            <td>' . $leave_row['id'] . '</td>
                                            <td>' . $leave_row['user_id'] . '</td>
                                            <td>' . $leave_row['reason'] . '</td>
                                            <td>' . $leave_row['leave_applied_date_time'] . '</td>
                                            <td>' . $leave_row['from_date'] . '</td>
                                            <td>' . $leave_row['to_date'] . '</td>
                                            <td>' . $leave_row['left_date_time'] . '</td>
                                            <td>' . $leave_row['report_date_time'] . '</td>
                                            <td class="text-success">' . $leave_row['permission'] . '</td>
                                            <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="markAsLeaveDone" style="" data-userid="' . $leave_row['user_id'] . '" data-leaveid="' . $leave_row['id'] . '">Mark as Done</button></td>
                                        </tr>';
        }

        $all_incoming_leaves = $all_incoming_leaves . '</tbody></table></div>';
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Incoming Leaves</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../assets/css/mdb.min.css" rel="stylesheet">

        <link href="../assets/css/mdb_pro_min.css" rel="stylesheet">
        <link href="../assets/css/addons/datatables2.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link rel="stylesheet" href="../assets/css/style.css">

        <style>
            th {
                text-align: center;
            }

            td {
                text-align: center;
            }
        </style>

    </head>

    <body class="skin-light">
        <header>
            <!--Navbar-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top scrolling-navbar">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#"><b>RGUKT OLMS | Outgoing-Leaves</b></a>
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">
                    <!-- Links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-success" href="index.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="outingsDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list"></i> Outings</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="outingsDrop">
                                <a class="dropdown-item" href="outgoing_outings.php">Outgoing Outings</a>
                                <a class="dropdown-item" href="incoming_outings.php">Incoming Outings</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="leavesDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list"></i> Leaves</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="leavesDrop">
                                <a class="dropdown-item" href="outgoing_leaves.php">Outgoing Leaves</a>
                                <a class="dropdown-item" href="#">Incoming Leaves</a>
                            </div>
                        </li>

                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $security_id; ?></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> LogOut</a>
                            </div>
                        </li>
                    </ul>
                    <!-- Links -->
                </div>
                <!-- Collapsible content -->
            </nav>

        </header>

        <main>
            <div class="container" style="margin-top: 100px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center"><a>All Incoming Leaves</a></h4>
                        <div id="all_incoming_leaves">
                            <?php echo $all_incoming_leaves; ?>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- jquery.min.3.3.1.js -->
        <!-- <script type="text/javascript" src="assets/js/jquery.3.1.1.min.js"></script> -->
        <!-- jQuery -->
        <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
        <script type="text/javascript" src="../assets/js/picker-time.js"></script>
        <script type="text/javascript" src="../assets/js/addons/datatables2.min.js"></script>
        <!-- Your custom scripts (optional) -->
        <script type="text/javascript">
            $(document).ready(function() {
                //Pagination First/Last Numbers
                $('#dt-bordered').DataTable({
                    "pagingType": "full_numbers"
                });
            });

            $(document).on('click', '#markAsLeaveDone', function() {
                var user_id = $(this).data('userid');
                var leave_id = $(this).data('leaveid');

                $.ajax({
                    url: 'mark_as_leave_done.php',
                    type: 'post',
                    data: 'user_id=' + user_id + '&leave_id=' + leave_id,
                    success: function(result) {
                        // console.log(result);
                        $('#all_incoming_leaves').html(result);
                    }
                })
            })
        </script>
    </body>

    </html>
<?php
} else {
    header('location: login.php');
}
?>