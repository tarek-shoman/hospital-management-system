<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$e_id = $_GET['exam-id'];

$stmt = "UPDATE examinations SET exam_active = 0 WHERE exam_id = $e_id";
$conn -> exec($stmt);
header("location:exam.php");