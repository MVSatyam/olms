<?php
include '../dbconnect.php';
session_start();


if (isset($_POST['user_id']) and isset($_POST['leave_id'])) {
    $user_id = $_POST['user_id'];
    $leave_id = $_POST['leave_id'];

    $user_sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $user_query = mysqli_query($conn, $user_sql);
    $user_row = mysqli_fetch_array($user_query);
    $rem_leaves = $user_row['rem_leaves'];
    $total_leaves = $user_row['total_leaves'];

    $sql = "UPDATE leaves set incoming='yes', report_date_time=now() WHERE user_id='$user_id' and id=$leave_id";
    $query = mysqli_query($conn, $sql);

    $update_sql = "UPDATE users set rem_leaves=$rem_leaves - 1, total_leaves=$total_leaves + 1";
    $update_query = mysqli_query($conn, $update_sql);

    $incoming_leaves_sql = "SELECT * FROM leaves WHERE permission='granted' and incoming='no' and outgoing='yes' ORDER BY id ASC";
    $incoming_leaves_query = mysqli_query($conn, $incoming_leaves_sql);

    $count = mysqli_num_rows($incoming_leaves_query);
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

        $all_incoming_leaves = $all_incoming_leaves . '
                                    <script>
                                    $(document).ready(function() {
                                        //Pagination First/Last Numbers
                                        $("#dt-bordered").DataTable({
                                            "pagingType": "full_numbers"
                                        });
                                    });
                                    </script>
                                ';
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
        while ($leave_row = mysqli_fetch_assoc($incoming_leaves_query)) {

            $all_incoming_leaves = $all_incoming_leaves . '<tr>
                                                <td>' . $leave_row['id'] . '</td>
                                                <td>' . $leave_row['user_id'] . '</td>
                                                <td>' . $leave_row['reason'] . '</td>
                                                <td>' . $leave_row['leave_applied_time'] . '</td>
                                                <td>' . $leave_row['from_time'] . '</td>
                                                <td>' . $leave_row['to_time'] . '</td>
                                                <td>' . $leave_row['left_time'] . '</td>
                                                <td>' . $leave_row['reported_time'] . '</td>
                                                <td class="text-success">' . $leave_row['permission'] . '</td>
                                                <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="markAsGone" style="" data-userid="' . $leave_row['user_id'] . '" data-leaveid="' . $leave_row['id'] . '">Mark</button></td>
                                            </tr>';
        }

        $all_incoming_leaves = $all_incoming_leaves . '</tbody></table></div>';
        $all_incoming_leaves = $all_incoming_leaves . '
                <script>
                $(document).ready(function() {
                    //Pagination First/Last Numbers
                    $("#dt-bordered").DataTable({
                        "pagingType": "full_numbers"
                    });
                });
                </script>
            ';
    }
    echo $all_incoming_leaves;
} else {
    header('location: incoming_leaves.php');
}
