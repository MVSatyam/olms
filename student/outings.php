<?php

include '../dbconnect.php';
session_start();

if ($_SESSION['student'] != NULL) {
    $uesr_id = $_SESSION['student'];

    $sql = "SELECT * FROM outings WHERE user_id = '$uesr_id'";
    $query = mysqli_query($conn, $sql);

    $all_outings = "";

    $count = mysqli_num_rows($query);
    if ($count == 0) {
        $all_outings = $all_outings . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered " cellspacing="0" width="100%">
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
        $all_outings = $all_outings . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered " cellspacing="0" width="100%">
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
        while ($outing_row = mysqli_fetch_assoc($query)) {
            $all_outings = $all_outings . '<tr>
                                            <td>' . $outing_row['id'] . '</td>
                                            <td>' . $outing_row['from_time'] . '</td>
                                            <td>' . $outing_row['to_time'] . '</td>
                                            <td>' . $outing_row['left_time'] . '</td>
                                            <td>' . $outing_row['reported_time'] . '</td>';
            if (($outing_row['incoming'] == 'no' and $outing_row['outgoing'] == 'no') or $outing_row['permission'] == 'wait...') {
                $all_outings = $all_outings . '<td class="text-success">' . $outing_row['permission'] . '&nbsp;<button class="btn btn-link btn-sm text-danger p-1" id="cancelOuting" data-userid=' . $outing_row['user_id'] . ' data-outingid=' . $outing_row['id'] . '>Cancel</button></td>
                                        </tr>';
            } else {
                $all_outings = $all_outings . '<td class="text-success">' . $outing_row['permission'] . '</td>
                                        </tr>';
            }
        }

        $all_outings = $all_outings . '</tbody></table></div>';
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Outings</title>
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
                <a class="navbar-brand" href="#"><b>RGUKT OLMS | Outings</b></a>
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
                            <a class="nav-link text-success" href="#"><i class="fas fa-list"></i> Outings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="leaves.php"><i class="fas fa-list"></i> Leaves</a>
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
                                        <H2>Apply Outing</H2>
                                    </div>
                                    <div class="md-form md-outline">
                                        <textarea class="form-control border-success" name="outing_reason" id="outingReason"></textarea>
                                        <label for="outingReason" class="text-success">Type Reason</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <input placeholder="Start Time" type="text" id="input_starttime" class="form-control timepicker border-success" required>
                                                <label for="input_starttime" class="text-success">Start Time</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <input placeholder="End Time" type="text" id="input_endtime" class="form-control timepicker border-success" disabled>
                                                <label for="input_endtime" class="text-success">End Time</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-success waves-effect submit_outing" data-userid="<?php echo $uesr_id; ?>" name="submit_outing">Submit</button>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-8">
                            <section class="mb-5">
                                <div class="card p-2 border">
                                    <div class="card-title text-center">
                                        <h2>Total Outings</h2>
                                        <?php echo $all_outings; ?>
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
            $('#input_starttime').pickatime({
                twelvehour: true,
                min: "8:00AM",
                max: "9:00PM",
                default: "8:00AM"
            }).val('8:00AM');
            $('#input_endtime').pickatime({
                twelvehour: true,
                min: "8:00AM",
                max: "9:00PM",
            }).val('9:00PM');

            $(document).ready(function() {
                //Pagination First/Last Numbers
                $('#dt-bordered').DataTable({
                    "pagingType": "full_numbers"
                });
            });

            $(document).on('click', '.submit_outing', function() {
                var user_id = $(this).data('userid');
                var outingReason = $('#outingReason').val();
                var startTime = $('#input_starttime').val();
                var endTime = $('#input_endtime').val();

                if (user_id != '' && outingReason != '' && startTime != '' && endTime != '') {
                    // console.log(user_id + '\n' + outingReason + '\n' + startTime + '\n' + endTime);
                    $.alert({
                        title: 'Hello ' + user_id,
                        content: 'Are you sure to apply outing?',
                        theme: 'modern',
                        buttons: {
                            Ok: {
                                btnClass: 'btn-success',
                                action: function() {
                                    $.ajax({
                                        url: 'apply_outing.php',
                                        method: 'post',
                                        data: 'user_id=' + user_id + '&outing_reason=' + outingReason + '&start_time=' + startTime + '&end_time=' + endTime,
                                        success: function(result) {
                                            $.alert({
                                                title: 'Hello ' + user_id,
                                                content: result,
                                                theme: 'modern',
                                                buttons: {
                                                    OK: {
                                                        btnClass: 'btn-success',
                                                        action: function() {
                                                            location.href = "outings.php";
                                                        }
                                                    }
                                                }
                                            });
                                            $('#outingReason').val('');
                                            $('#input_starttime').val('8:00AM');

                                        }
                                    })
                                }
                            },
                            cancel: {
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
                    });
                }
            })

            $(document).on('click', '#cancelOuting', function() {
                var outing_id = $(this).data('outingid');
                var user_id = $(this).data('userid');

                $.alert({
                    title: 'Hello ' + user_id,
                    content: 'Are you sure to cancel outing?',
                    theme: 'modern',
                    buttons: {
                        Ok: {
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: 'cancel_outing.php',
                                    method: 'post',
                                    data: 'outing_id=' + outing_id + '&user_id=' + user_id,
                                    success: function(result) {
                                        $.alert({
                                            title: 'Hello ' + user_id,
                                            content: result,
                                            theme: 'modern',
                                            buttons: {
                                                OK: {
                                                    btnClass: 'btn-success',
                                                    action: function() {
                                                        location.href = "outings.php";
                                                    }
                                                }
                                            }
                                        });
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