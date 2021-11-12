<?php 

include "connection.php";

session_start();


$item_id = $_POST["item_id"];
$user_id = $_SESSION["user_id"];

$sql1="INSERT INTO `cart_items`(`user_id`, `item_id`) VALUES (?, ?);"; 
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$user_id, $item_id);
$stmt1->execute();


?>