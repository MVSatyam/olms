<?php
include '../dbconnect.php';
session_start();


if (isset($_POST['user_id']) and isset($_POST['leave_id'])) {
    $user_id = $_POST['user_id'];
    $leave_id = $_POST['leave_id'];

    $insert_sql = "INSERT INTO notifications(to_user, message, time, is_viewed) VALUES('$user_id', 'Your request for leave was granted', now(), 0)";
    $insert_query = mysqli_query($conn, $insert_sql);

    $sql = "UPDATE leaves set permission='granted', outgoing='no', incoming='no',admin_remark='Happy Journey', admin_action = now() WHERE user_id='$user_id' and id=$leave_id";
    $query = mysqli_query($conn, $sql);

    $leaves_sql = "SELECT * FROM leaves WHERE permission='wait...' ORDER BY id ASC";
    $leaves_query = mysqli_query($conn, $leaves_sql);

    $count = mysqli_num_rows($leaves_query);
    $all_pending_leaves = "";

    if ($count == 0) {
        # code...
        $all_pending_leaves = $all_pending_leaves . '<div class="table-responsive-sm">
                                        <table id="dt-bordered" class="table table-bordered table-fixed" cellspacing="0" width="100%">
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
        $all_pending_leaves = $all_pending_leaves . '
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
        while ($leave_row = mysqli_fetch_assoc($leaves_query)) {

            $all_pending_leaves = $all_pending_leaves . '<tr>
                                                    <td>' . $leave_row['id'] . '</td>
                                                    <td>' . $leave_row['user_id'] . '</td>
                                                    <td>' . $leave_row['reason'] . '</td>
                                                    <td>' . $leave_row['from_time'] . '</td>
                                                    <td>' . $leave_row['to_time'] . '</td>
                                                    <td class="text-danger">' . $leave_row['permission'] . '</td>
                                                    <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="grantLeave" style="" data-userid="' . $leave_row['user_id'] . '" data-leaveid="' . $leave_row['id'] . '">Grant</button></td>
                                                </tr>';
        }

        $all_pending_leaves = $all_pending_leaves . '</tbody>
                                        </table>
                                    </div>';

        $all_pending_leaves = $all_pending_leaves . '
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

    echo $all_pending_leaves;
} else {
    header('location: all_leaves.php');
}
