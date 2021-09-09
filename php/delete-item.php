<?php
include "connection.php";

session_start();

$store_id = $_SESSION["store_id"];
$item_id = $_POST["item_id"];

$sql1="DELETE FROM `items` WHERE id = ? AND store_id = ?;"; 
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("is", $item_id, $store_id);
$stmt1->execute();



?>