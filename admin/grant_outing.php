<?php
include '../dbconnect.php';
session_start();


if (isset($_POST['user_id']) and isset($_POST['outing_id'])) {
    $user_id = $_POST['user_id'];
    $outing_id = $_POST['outing_id'];

    $insert_sql = "INSERT INTO notifications(to_user, message, time, is_viewed) VALUES('$user_id', 'Your request for outing was granted', now(), 0)";
    $insert_query = mysqli_query($conn, $insert_sql);

    $sql = "UPDATE outings set permission='granted', outgoing='no', incoming='no',admin_remark='Happy Journey', admin_action = now() WHERE user_id='$user_id' and id=$outing_id";
    $query = mysqli_query($conn, $sql);

    $outings_sql = "SELECT * FROM outings WHERE permission='wait...' ORDER BY id ASC";
    $outings_query = mysqli_query($conn, $outings_sql);

    $count = mysqli_num_rows($outings_query);
    $all_pending_outings = "";

    if ($count == 0) {
        # code...
        $all_pending_outings = $all_pending_outings . '<div class="table-responsive-sm">
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
                                        </table>
                                    </div>';
        $all_pending_outings = $all_pending_outings . '
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
        $all_pending_outings = $all_pending_outings . '<div class="table-responsive-sm">
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
        while ($outing_row = mysqli_fetch_assoc($outings_query)) {

            $all_pending_outings = $all_pending_outings . '<tr>
                                                    <td>' . $outing_row['id'] . '</td>
                                                    <td>' . $outing_row['user_id'] . '</td>
                                                    <td>' . $outing_row['reason'] . '</td>
                                                    <td>' . $outing_row['from_time'] . '</td>
                                                    <td>' . $outing_row['to_time'] . '</td>
                                                    <td class="text-danger">' . $outing_row['permission'] . '</td>
                                                    <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="grantOuting" style="" data-userid="' . $outing_row['user_id'] . '" data-outingid="' . $outing_row['id'] . '">Grant</button></td>
                                                </tr>';
        }

        $all_pending_outings = $all_pending_outings . '</tbody>
                                        </table>
                                    </div>';

        $all_pending_outings = $all_pending_outings . '
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

    echo $all_pending_outings;
} else {
    header('location: all_outings.php');
}
