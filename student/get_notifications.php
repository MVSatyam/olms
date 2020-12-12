<?php
include '../dbconnect.php';
session_start();
if ($_SESSION['student'] != NULL) {
    $output = '';
    $user_id = $_SESSION['student'];

    $sql = "SELECT * FROM notifications WHERE to_user='$user_id'";
    $query = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($query);

    if ($count > 0) {
        while ($notification_row = mysqli_fetch_assoc($query)) {
            $output = $output.'<div class="dropdown-item">'.$notification_row['message'].'</div>';
        }
    }
    else{
        $output = $output.'<div class="dropdown-item">No New Notifications</div>';
    }
    echo $output;
}
