<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$pat_id = $_GET['q'];

$mob_info = $conn -> query("SELECT pat_mob FROM patients
WHERE pat_id = $pat_id") -> fetchAll(PDO::FETCH_COLUMN);

echo $mob_info[0];