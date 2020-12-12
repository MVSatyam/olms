<?php
include '../dbconnect.php';
$result = '';
if (isset($_POST['user_id']) and isset($_POST['outing_id'])) {
    $outing_id = $_POST['outing_id'];
    $usr_id = $_POST['user_id'];

    $sql = "DELETE FROM outings WHERE user_id='$usr_id' and id='$outing_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = 'Outing has been Canceled!!!';
    } else {
        $result =  'Something went wrong!!!';
    }

    echo $result;
} else {
    header('location: outings.php');
}
