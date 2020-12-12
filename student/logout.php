<?php
include '../dbconnect.php';
session_start();
unset($_SESSION['student']);
header('location: login.php');
?>