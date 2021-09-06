<?php 

include "connection.php";

session_start();


$item_id = $_POST["item_id"];
$user_id = $_SESSION["user_id"];

$sql1="DELETE FROM `cart_items` WHERE user_id = ? AND item_id = ? LIMIT 1;"; 
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$user_id, $item_id);
$stmt1->execute();


?>