<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$itemID = $_GET['q'];
$uID = $_SESSION['userid'];

$stmt = $conn -> prepare("INSERT INTO cart(user_userid, item_id)
VALUES(?,?)");

$stmt -> execute([$uID, $itemID]);

$cart_num = $conn -> query("SELECT COUNT(cart_id) FROM cart
WHERE user_userid = $uID") -> fetchAll(PDO::FETCH_COLUMN);

echo $cart_num[0];