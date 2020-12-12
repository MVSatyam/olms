<?php
include '../dbconnect.php';
session_start();


if (isset($_POST['user_id']) and isset($_POST['outing_id'])) {
    $user_id = $_POST['user_id'];
    $outing_id = $_POST['outing_id'];

    $time = date('h:iA');
    $sql = "UPDATE outings set outgoing='yes', left_time='$time' WHERE user_id='$user_id' and id=$outing_id";
    $query = mysqli_query($conn, $sql);

    $outgoing_outings_sql = "SELECT * FROM outings WHERE permission='granted' and outgoing='no' ORDER BY id ASC";
    $outgoing_outings_query = mysqli_query($conn, $outgoing_outings_sql);

    $count = mysqli_num_rows($outgoing_outings_query);
    $all_outgoing_outings = "";

    if ($count == 0) {
        # code...
        $all_outgoing_outings = $all_outgoing_outings . '<div class="table-responsive-sm">
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

        $all_outgoing_outings = $all_outgoing_outings . '
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
        $all_outgoing_outings = $all_outgoing_outings . '<div class="table-responsive-sm">
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
        while ($outing_row = mysqli_fetch_assoc($outgoing_outings_query)) {

            $all_outgoing_outings = $all_outgoing_outings . '<tr>
                                                <td>' . $outing_row['id'] . '</td>
                                                <td>' . $outing_row['user_id'] . '</td>
                                                <td>' . $outing_row['reason'] . '</td>
                                                <td>' . $outing_row['outing_applied_time'] . '</td>
                                                <td>' . $outing_row['from_time'] . '</td>
                                                <td>' . $outing_row['to_time'] . '</td>
                                                <td>' . $outing_row['left_time'] . '</td>
                                                <td>' . $outing_row['reported_time'] . '</td>
                                                <td class="text-success">' . $outing_row['permission'] . '</td>
                                                <td><button class="btn btn-outline-danger btn-sm waves-effect p-1" id="markAsGone" style="" data-userid="' . $outing_row['user_id'] . '" data-outingid="' . $outing_row['id'] . '">Mark</button></td>
                                            </tr>';
        }

        $all_outgoing_outings = $all_outgoing_outings . '</tbody></table></div>';
        $all_outgoing_outings = $all_outgoing_outings . '
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
    echo $all_outgoing_outings;
} else {
    header('location: outgoing_outings.php');
}
