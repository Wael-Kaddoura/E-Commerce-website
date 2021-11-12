<?php 

include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$query3 = "SELECT *, COUNT(items.id) AS count FROM `items`, cart_items WHERE cart_items.user_id = ? AND items.id = cart_items.item_id group BY items.id";
$stmt3 = $connection->prepare($query3);
$stmt3 -> bind_param("s", $_SESSION["user_id"]);
$stmt3->execute();
$result3 = $stmt3->get_result();

$total_price = 0;

while ($row = $result3->fetch_assoc()) {
$total_price += floatval($row["count"]) * floatval($row["price"]);
}

$total_price = round($total_price, 2);
echo json_encode(array('total_price' => $total_price));

?>