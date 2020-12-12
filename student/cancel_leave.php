<?php
include '../dbconnect.php';
$result = '';
if (isset($_POST['user_id']) and isset($_POST['leave_id'])) {
    $leave_id = $_POST['leave_id'];
    $usr_id = $_POST['user_id'];

    $sql = "DELETE FROM leaves WHERE user_id='$usr_id' and id='$leave_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = 'Leave has been Canceled!!!';
    } else {
        $result =  'Something went wrong!!!';
    }

    echo $result;
} else {
    header('location: leaves.php');
}
