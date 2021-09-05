<?php
include "connection.php";

session_start();

if (isset($_POST["item_name"]) and $_POST["item_name"] !="")
	{
		$item_name = $_POST["item_name"];
	}else
	{
		die("Try again next time Item Name");
	}

if (isset($_POST["item_desc"]) and $_POST["item_desc"] !="")
	{
		$item_desc = $_POST["item_desc"];
	}else{
		die("Try again next time Item Desc");
	}

    if (isset($_POST["price"]) and $_POST["price"] !="")
	{
		$price = $_POST["price"];
	}else{
		die("Try again next time Item Price");
	}    

    if (isset($_POST["item_image"]) and $_POST["item_image"] !="")
	{
		$item_image = $_POST["item_image"];
	}else{
		die("Try again next time Item Image");
	}

	$item_category = $_POST["item_category"];

$store_id = $_SESSION["store_id"];

$sql1="INSERT INTO `items`(`name`, `description`, `category`, `price`, `store_id`, `item_image`) VALUES (?,?,?,?,?,?);"; 
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ssssss",$item_name,$item_desc,$item_category, $price,$store_id, $item_image);
$stmt1->execute();

header("Location:../index.php");

?>