<?php
include "connection.php";

if (isset($_POST["item_name"]) and $_POST["item_name"] !="")
	{
		$item_name = $_POST["item_name"];
	}else
	{
		die("Try again next time");
	}

if (isset($_POST["item_desc"]) and $_POST["item_desc"] !="")
	{
		$item_desc = $_POST["item_desc"];
	}else{
		die("Try again next time");
	}

    if (isset($_POST["price"]) and $_POST["price"] !="")
	{
		$price = $_POST["price"];
	}else{
		die("Try again next time");
	}    

    if (isset($_POST["item_image"]) and $_POST["item_image"] !="")
	{
		$item_image = $_POST["item_image"];
	}else{
		die("Try again next time");
	}
$sql1="Select * from users where email=? and password=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$email,$password);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();


?>