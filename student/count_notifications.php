<?php
    include '../dbconnect.php';
    session_start();
    if ($_SESSION['student'] != NULL) {
        $user_id = $_SESSION['student'];

        $sql = "SELECT * FROM notifications WHERE to_user='$user_id'";
        $query = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($query);
        echo $count;
    }