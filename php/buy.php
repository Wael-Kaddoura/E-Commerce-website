<?php 

include "connection.php";

session_start();


$user_id = $_SESSION["user_id"];

$query1 = "SELECT *, COUNT(items.id) AS count FROM `items`, cart_items WHERE cart_items.user_id = ? AND items.id = cart_items.item_id group BY items.id";
$stmt1 = $connection->prepare($query1);
$stmt1 -> bind_param("s", $user_id);
$stmt1->execute();
$result1= $stmt1->get_result();

while ($row = $result1->fetch_assoc()) {
    $total_price = floatval($row["count"]) * floatval($row["price"]);

    $store_id = $row["store_id"];

    $query2 = "UPDATE `stores` SET `revenue`=revenue + $total_price WHERE id = ?";
    $stmt2 = $connection->prepare($query2);
    $stmt2 -> bind_param("i", $store_id);
    $stmt2->execute();

    $item_id = $row["item_id"];
    $item_count = $row['count'];

    $query3 = "UPDATE `items` SET `qty`= qty - $item_count  WHERE id = ?;";
    $stmt3 = $connection->prepare($query3);
    $stmt3 -> bind_param("i", $item_id);
    $stmt3->execute();
}

$query4 = 'DELETE FROM `cart_items` WHERE user_id = ?;';
$stmt4 = $connection->prepare($query4);
$stmt4 -> bind_param("i", $user_id);
$stmt4->execute();

$_SESSION["new_purchase"] = true;

header("Location:../show-cart-items.php")

?>