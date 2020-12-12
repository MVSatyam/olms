<?php
include '../dbconnect.php';
session_start();


if (isset($_POST['user_id']) and isset($_POST['leave_id'])) {
    $user_id = $_POST['user_id'];
    $leave_id = $_POST['leave_id'];

    $sql = "UPDATE leaves set outgoing='yes', left_date_time=now() WHERE user_id='$user_id' and id=$leave_id";
    $query = mysqli_query($conn, $sql);

    $outgoing_leaves_sql = "SELECT * FROM leaves WHERE permission='granted' and outgoing='no' ORDER BY id ASC";
    $outgoing_leaves_query = mysqli_query($conn, $outgoing_leaves_sql);

    $count = mysqli_num_rows($outgoing_leaves_query);
    $all_outgoing_leaves = "";

    if ($count == 0) {
        # code...
        $all_outgoing_leaves = $all_outgoing_leaves . '<div class="table-responsive-sm">
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

        $all_outgoing_leaves = $all_outgoing_leaves . '
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
        $all_outgoing_leaves = $all_outgoing_leaves . '<div class="table-responsive-sm">
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
        while ($leave_row = mysqli_fetch_assoc($outgoing_leaves_query)) {

            $all_outgoing_leaves = $all_outgoing_leaves . '<tr>
                                                <td>' . $leave_row['id'] . '</td>
                                                <td>' . $leave_row['user_id'] . '</td>
                                                <td>' . $leave_row['reason'] . '</td>
                                                <td>' . $leave_row['leave_applied_date_time'] . '</td>
                                                <td>' . $leave_row['from_date'] . '</td>
                                                <td>' . $leave_row['to_date'] . '</td>
                                                <td>' . $leave_row['left_date_time'] . '</td>
                                                <td>' . $leave_row['report_date_time'] . '</td>
                                                <td class="text-success">' . $leave_row['permission'] . '</td>
                                                <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="markAsGone" style="" data-userid="' . $leave_row['user_id'] . '" data-leaveid="' . $leave_row['id'] . '">Mark</button></td>
                                            </tr>';
        }

        $all_outgoing_leaves = $all_outgoing_leaves . '</tbody></table></div>';
        $all_outgoing_leaves = $all_outgoing_leaves . '
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
    echo $all_outgoing_leaves;
} else {
    header('location: outgoing_leaves.php');
}
