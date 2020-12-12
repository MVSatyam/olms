<?php

include '../dbconnect.php';
session_start();

$output = "";
if (isset($_POST['user_id']) and isset($_POST['leave_reason']) and isset($_POST['start_date']) and isset($_POST['end_date'])) {
    $user_id = $_POST['user_id'];
    $leave_reason = $_POST['leave_reason'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $leaves_count_sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $leaves_count_query = mysqli_query($conn, $leaves_count_sql);
    $user_array = mysqli_fetch_array($leaves_count_query);
    $rem_leaves = $user_array['rem_leaves'];

    if ($rem_leaves == 0) {
        $output = "Sorry, Your outings are over";
    } else {
        $alredy_applied_sql = "SELECT * FROM leaves WHERE user_id = '$user_id' and permission = 'wait...'";
        $alredy_applied_query = mysqli_query($conn, $alredy_applied_sql);

        $count = mysqli_num_rows($alredy_applied_query);

        if ($count == 0) {
            # code...
            $sql_1 = "SELECT * FROM leaves WHERE user_id='$user_id' and permission='granted' and outgoing='no' and incoming='no'";
            $query_1 = mysqli_query($conn, $sql_1);
            $cnt = mysqli_num_rows($query_1);
            if ($cnt == 0) {

                $sql = "INSERT INTO leaves(user_id, reason, from_date, to_date) VALUES('$user_id','$leave_reason','$start_date','$end_date')";
                $query = mysqli_query($conn, $sql);

                $output = "Request for leave has been sent, Please wait for response";
                // echo $output;
            } else {
                $output = "Sorry, You are already in Leave";
            }
        } else {

            $output = "Sorry, You are already in Leave";
        }
        // echo $output;
    }
    echo $output;
} else {
    header('location: index.php');
}
