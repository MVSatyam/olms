<?php
include '../dbconnect.php';
session_start();
unset($_SESSION['security']);
header('location: login.php');
?>