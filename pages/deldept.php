<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$d_id = $_GET['dept-id'];

$stmt = "UPDATE departments SET dept_active = 0 WHERE dept_id = $d_id";
$conn -> exec($stmt);
header("location:dept.php");