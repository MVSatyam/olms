<?php
include '../dbconnect.php';
session_start();

if ($_SESSION['admin'] != NULL) {
    # code...
    $admin_id = $_SESSION['admin'];

    $sql = "SELECT * FROM leaves WHERE permission='wait...' ORDER BY id ASC";
    $query = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($query);
    $all_pending_leaves = "";

    if ($count == 0) {
        # code...
        $all_pending_leaves = $all_pending_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id</th>
                                                    <th class="th-sm">User_Id</th>
                                                    <th class="th-sm">Reason</th>
                                                    <th class="th-sm">FromTime</th>
                                                    <th class="th-sm">ToTime</th>
                                                    <th class="th-sm">Permission</th>
                                                </tr>
                                            </thead> 
                                        </table>
                                    </div>';
    } else {
        $all_pending_leaves = $all_pending_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id</th>
                                                    <th class="th-sm">User_Id</th>
                                                    <th class="th-sm">Reason</th>
                                                    <th class="th-sm">FromTime</th>
                                                    <th class="th-sm">ToTime</th>
                                                    <th class="th-sm">Permission</th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        while ($leave_row = mysqli_fetch_assoc($query)) {

            $all_pending_leaves = $all_pending_leaves . '<tr>
                                            <td>' . $leave_row['id'] . '</td>
                                            <td>' . $leave_row['user_id'] . '</td>
                                            <td>' . $leave_row['reason'] . '</td>
                                            <td>' . $leave_row['from_date'] . '</td>
                                            <td>' . $leave_row['to_date'] . '</td>
                                            <td class="text-danger">' . $leave_row['permission'] . '</td>
                                            <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="grantLeave" style="" data-userid="' . $leave_row['user_id'] . '" data-leaveid="' . $leave_row['id'] . '">Grant</button></td>
                                        </tr>';
        }

        $all_pending_leaves = $all_pending_leaves . '</tbody></table></div>';
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Pending Leaves</title>
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
                <a class="navbar-brand" href="#"><b>RGUKT OLMS | Pending-Leaves</b></a>
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
                                <a class="dropdown-item" href="pending_outings.php">Pending Outings</a>
                                <a class="dropdown-item" href="approved_outings.php">Approved Outings</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="leavesDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list"></i> Leaves</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="leavesDrop">
                                <a class="dropdown-item" href="#">Pending Leaves</a>
                                <a class="dropdown-item" href="approved_leaves.php">Approved Leaves</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i> Notifications</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $admin_id; ?></a>
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
                        <h4 class="card-title text-center"><a>All Pending Leaves</a></h4>
                        <div id="all_pending_leaves">
                            <?php echo $all_pending_leaves; ?>
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

            $(document).on('click', '#grantLeave', function() {
                var user_id = $(this).data('userid');
                var leave_id = $(this).data('leaveid');

                $.ajax({
                    url: 'grant_leave.php',
                    type: 'post',
                    data: 'user_id=' + user_id + '&leave_id=' + leave_id,
                    success: function(result) {
                        // console.log(result);
                        $('#all_pending_leaves').html(result);
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