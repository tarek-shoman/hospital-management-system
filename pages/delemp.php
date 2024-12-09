<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$e_id = $_GET['emp-id'];

$stmt = "UPDATE employees SET emp_active = 0 WHERE emp_id = $e_id";
$conn -> exec($stmt);
header("location:emp.php");