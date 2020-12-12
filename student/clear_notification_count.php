<?php
include '../dbconnect.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $sql = "UPDATE notifications set is_viewed=1 WHERE to_user='$user_id'";
    $query = mysqli_query($conn, $sql);
    echo '';
} else {
    header('location: ./');
}