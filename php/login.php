<?php
include "connection.php";

if (isset($_POST["email"]) and $_POST["email"] !="")
	{
		$email = $_POST["email"];
	}else
	{
		die("Try again next time");
	}

if (isset($_POST["password"]) and $_POST["password"] !="")
	{
		$password = hash('sha256', $_POST["password"]);
	}else{
		die("Try again next time");
	}

$sql1="Select * from users where email=? and password=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$email,$password);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

$sql2="Select * from stores where email=? and password=?"; #Check if the email already exists in the database
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ss",$email,$password);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();


if(empty($row) && empty($row2)){
	session_start();
	$_SESSION["login_error"] = true;
	header('location: ../login.php');
}
else{
	session_start();
	$_SESSION["logedin"] = true;

	if (empty($row2)) {
		$_SESSION["name"] = $row["first_name"]." ".$row["last_name"];
	
		if($row["gender"]==0){
		$_SESSION["gender"] = "Mr";
		}else{$_SESSION["gender"] = "Ms";}

		$_SESSION["user_type"] = $row["type"];

	} else {
		$_SESSION["store_id"] = $row2["id"];
		$_SESSION["name"] = $row2["store_name"];
		$_SESSION["gender"] = "";

		$_SESSION["user_type"] = $row2["type"];

	}

	header('location: ../index.php');
}
?>