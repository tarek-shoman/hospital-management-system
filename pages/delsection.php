<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$s_id = $_GET['section-id'];

$stmt = "UPDATE sections SET section_active = 0 WHERE section_id = $s_id";
$conn -> exec($stmt);
header("location:section.php");