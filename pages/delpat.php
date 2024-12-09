<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$p_id = $_GET['pat-id'];

$stmt = "UPDATE patients SET pat_active = 0 WHERE pat_id = $p_id";
$conn -> exec($stmt);
header("location:pat.php");