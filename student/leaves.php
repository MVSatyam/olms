<?php

include '../dbconnect.php';
session_start();

if ($_SESSION['student'] != NULL) {
    $uesr_id = $_SESSION['student'];

    $sql = "SELECT * FROM leaves WHERE user_id = '$uesr_id'";
    $query = mysqli_query($conn, $sql);

    $all_leaves = "";

    $count = mysqli_num_rows($query);
    if ($count == 0) {
        $all_leaves = $all_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id
                                                    </th>
                                                    <th class="th-sm">FromTime
                                                    </th>
                                                    <th class="th-sm">ToTime
                                                    </th>
                                                    <th class="th-sm">LeftTime
                                                    </th>
                                                    <th class="th-sm">ReportTime
                                                    </th>
                                                    <th class="th-sm">Permission
                                                    </th>
                                                </tr>
                                            </thead> 
                                        </table>
                                    </div>';
    } else {
        $all_leaves = $all_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Id
                                                    </th>
                                                    <th class="th-sm">FromTime
                                                    </th>
                                                    <th class="th-sm">ToTime
                                                    </th>
                                                    <th class="th-sm">LeftTime
                                                    </th>
                                                    <th class="th-sm">ReportTime
                                                    </th>
                                                    <th class="th-sm">Permission
                                                    </th>
                                                </tr>
                                            </thead> 
                                        <tbody>';
        while ($leave_row = mysqli_fetch_assoc($query)) {
            $all_leaves = $all_leaves . '<tr>
                                            <td>' . $leave_row['id'] . '</td>
                                            <td>' . $leave_row['from_date'] . '</td>
                                            <td>' . $leave_row['to_date'] . '</td>
                                            <td>' . $leave_row['left_date_time'] . '</td>
                                            <td>' . $leave_row['report_date_time'] . '</td>';
            if (($leave_row['incoming'] == 'no' and $leave_row['outgoing'] == 'no') or $leave_row['permission'] == 'wait...') {
                $all_leaves = $all_leaves . '<td class="text-success">' . $leave_row['permission'] . '&nbsp;<button class="btn btn-link btn-sm text-danger p-1" id="cancelLeave" data-userid=' . $leave_row['user_id'] . ' data-leaveid=' . $leave_row['id'] . '>Cancel</button></td>
                                        </tr>';
            } else {
                $all_leaves = $all_leaves . '<td class="text-success">' . $leave_row['permission'] . '</td>
                                        </tr>';
            }
        }

        $all_leaves = $all_leaves . '</tbody></table></div>';
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Leaves</title>
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
        <!-- Jquery-confirm.min.css -->
        <link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
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
                <a class="navbar-brand" href="#"><b>RGUKT OLMS | Leaves</b></a>
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
                        <li class="nav-item">
                            <a class="nav-link text-success" href="outings.php"><i class="fas fa-list"></i> Outings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#"><i class="fas fa-list"></i> Leaves</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $uesr_id; ?></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit Profile</a>
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
                <section class="mt-2 mb-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <section class="mb-5">
                                <div class="card p-4 border sticky-top" style="top: 85px;">
                                    <div class="card-title text-center">
                                        <H2>Apply Leave</H2>
                                    </div>
                                    <div class="md-form md-outline">
                                        <textarea class="form-control border-success" name="leave_reason" id="leaveReason"></textarea>
                                        <label for="leaveReason" class="text-success">Type Reason</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <input placeholder="Start Date" type="date" id="input_startdate" class="form-control timepicker border-success" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <input placeholder="End Date" type="date" id="input_enddate" class="form-control timepicker border-success" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-success waves-effect submit_leave" data-userid="<?php echo $uesr_id; ?>" name="submit_leave">Submit</button>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-8">
                            <section class="mb-5">
                                <div class="card p-2 border">
                                    <div class="card-title text-center">
                                        <h2>Total Leaves</h2>
                                        <?php echo $all_leaves; ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
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
        <!-- jquery-confirm.min.js -->
        <script type="text/javascript" src="../assets/js/jquery-confirm.min.js"></script>
        <!-- Your custom scripts (optional) -->
        <script type="text/javascript">
            // Time Picker Initialization
            // Time Picker Initialization


            $(document).ready(function() {
                //Pagination First/Last Numbers
                $('#dt-bordered').DataTable({
                    "pagingType": "full_numbers"
                });
            });

            $(document).on('click', '.submit_leave', function() {
                var user_id = $(this).data('userid');
                var leaveReason = $('#leaveReason').val();
                var startDate = $('#input_startdate').val();
                var endDate = $('#input_enddate').val();

                if (user_id != '' && leaveReason != '' && startDate != '' && endDate != '') {
                    // console.log(user_id + '\n' + leaveReason + '\n' + startDate + '\n' + endDate);
                    $.alert({
                        title: 'Hello ' + user_id,
                        content: 'Are you sure to apply Leave?',
                        theme: 'modern',
                        buttons: {
                            Ok: {
                                btnClas: 'btn-success',
                                action: function() {
                                    $.ajax({
                                        url: 'apply_leave.php',
                                        method: 'post',
                                        data: 'user_id=' + user_id + '&leave_reason=' + leaveReason + '&start_date=' + startDate + '&end_date=' + endDate,
                                        success: function(result) {
                                            $.alert({
                                                title: 'Hello ' + user_id,
                                                content: result,
                                                theme: 'modern',
                                                buttons: {
                                                    Ok: {
                                                        btnClass: 'btn-success',
                                                        action: function() {
                                                            location.href = "leaves.php";
                                                        }
                                                    }
                                                }
                                            })
                                        }
                                    })
                                }
                            },
                            Cancel: {
                                btnClass: 'btn-danger'
                            }
                        }
                    })

                } else {
                    $.alert({
                        title: 'Hello ' + user_id,
                        content: 'Please Enter Details',
                        theme: 'modern',
                        buttons: {
                            Ok: {
                                btnClass: 'btn-success'
                            }
                        }
                    })
                }
            })

            $(document).on('click', '#cancelLeave', function() {
                var leave_id = $(this).data('leaveid');
                var user_id = $(this).data('userid');

                $.alert({
                    title: 'Hello ' + user_id,
                    content: 'Are you sure to cancel Leave?',
                    theme: 'modern',
                    buttons: {
                        Ok: {
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: 'cancel_leave.php',
                                    method: 'post',
                                    data: 'leave_id=' + leave_id + '&user_id=' + user_id,
                                    success: function(result) {
                                        $.alert({
                                            title: 'Hello ' + user_id,
                                            content: result,
                                            theme: 'modern',
                                            buttons: {
                                                OK: {
                                                    btnClass: 'btn-success',
                                                    action: function() {
                                                        location.href = "leaves.php";
                                                    }
                                                }
                                            }
                                        })
                                    }
                                })
                            }
                        },
                        Cancel: {
                            btnClass: 'btn-danger'
                        }
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