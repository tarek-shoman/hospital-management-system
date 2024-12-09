<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$pat_id = $_GET['q'];

$treat_info = $conn -> query("SELECT treat_id, treat_name FROM patients 
INNNER JOIN treat_doctors USING(treat_id)
WHERE pat_id = $pat_id") -> fetchAll(PDO::FETCH_KEY_PAIR);

echo $treat_info[$pat_id];