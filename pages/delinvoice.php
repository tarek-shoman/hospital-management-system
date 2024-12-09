<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$i_id = $_GET['invoice-id'];

$stmt = "UPDATE invoice SET invoice_active = 0 WHERE invoice_id = $i_id";
$conn -> exec($stmt);
header("location:invoice.php");