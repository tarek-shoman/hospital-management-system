<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$j_id = $_GET['job-id'];

$stmt = "UPDATE jobs SET job_active = 0 WHERE job_id = $j_id";
$conn -> exec($stmt);
header("location:jobs.php");