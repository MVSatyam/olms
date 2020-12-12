<?php

include '../dbconnect.php';
session_start();

$output = "";
if (isset($_POST['user_id']) and isset($_POST['outing_reason']) and isset($_POST['start_time']) and isset($_POST['end_time'])) {
    $user_id = $_POST['user_id'];
    $outing_reason = $_POST['outing_reason'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $outings_count_sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $outings_count_query = mysqli_query($conn, $outings_count_sql);
    $user_array = mysqli_fetch_array($outings_count_query);
    $rem_outings = $user_array['rem_outings'];

    if ($rem_outings == 0) {
        $output = "Sorry, Your outings are over";
    } else {

        $alredy_applied_sql = "SELECT * FROM outings WHERE user_id = '$user_id' and permission = 'wait...'";
        $alredy_applied_query = mysqli_query($conn, $alredy_applied_sql);

        $count = mysqli_num_rows($alredy_applied_query);

        if ($count == 0) {
            # code...
            $sql_1 = "SELECT * FROM outings WHERE user_id='$user_id' and permission='granted' and outgoing='no' and incoming='no'";
            $query_1 = mysqli_query($conn, $sql_1);
            $cnt = mysqli_num_rows($query_1);
            if ($cnt == 0) {

                $sql = "INSERT INTO outings(user_id, reason, from_time, to_time) VALUES('$user_id','$outing_reason','$start_time','$end_time')";
                $query = mysqli_query($conn, $sql);

                $output = "Outing Request has been sent,Please wait for response";
                // echo $output;
            } else {
                $output = "Sorry, You are already in outing";
            }
        } else {

            $output = "Sorry, You are already in outing";
        }
        // echo $output;
    }
    echo $output;
} else {
    header('location: index.php');
}
