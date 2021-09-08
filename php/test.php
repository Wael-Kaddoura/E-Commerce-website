<?php 

include "connection.php";

session_start();


$query1 = "SELECT *, COUNT(items.id) AS count FROM `items`, cart_items WHERE cart_items.user_id = 6 AND items.id = cart_items.item_id group BY items.id";
$stmt1 = $connection->prepare($query1);
$stmt1->execute();
$result1= $stmt1->get_result();
$row = $result1 -> fetch_assoc();

$item_id = $row['store_id'];

print_r($row);
echo "hello";
echo $item_id;
?>