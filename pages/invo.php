<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                
    $pat_id = $_POST['patid'];
    $inv_id = $_POST['invoice-id'];
    $date = $_POST['i-date'];
    $time = $_POST['i-time'];
    $exam = $_POST['exam'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $amount = $_POST['amount'];
    $total = $_POST['total'];
    $userID = $_SESSION['userid'];
    $emp_id = $_POST['empid'];

    function exam_filter($value){
        return $value != "start";
    }

    $exam_id = array_filter($exam, "exam_filter");

    $sql = $conn -> prepare("INSERT INTO invoice (invoice_id, pat_id, invoice_date, invoice_time,
    invoice_total, emp_id, user_userid) VALUES(?,?,?,?,?,?,?)");
    $sql -> execute([$inv_id, $pat_id, $date, $time, $total, $emp_id, $userID]);

    for( $i = 0; $i < count($exam_id); $i++ ){
        $stmt = $conn -> prepare("INSERT INTO invoice_details (invoice_id, exam_id, price, 
        discount) VALUES(?,?,?,?)");
        $stmt -> execute([$inv_id, $exam_id[$i], $price[$i], $discount[$i]]);
    }

    header("location:invoice.php");
}

else{
    header("location:out.php");
}