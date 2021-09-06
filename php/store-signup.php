<?php
include "connection.php";

if(isset($_POST["store_name"]) && $_POST["store_name"] != "" && strlen($_POST["store_name"]) >= 3) {
    $store_name = $_POST["store_name"];
}else{
    die ("Enter a valid input");
}


if(isset($_POST["email"]) && $_POST["email"] != "" && strlen($_POST["email"]) > 5 && strrpos($_POST["email"], ".") > strrpos($_POST["email"], "@") && strrpos($_POST["email"], "@") != -1) {
    $email = $_POST["email"];
}else{
    die ("Enter a valid input");
}


if(isset($_POST["password"]) && $_POST["password"] != "" && $_POST["password"] == $_POST["confirmPassword"] && strlen($_POST["password"]) > 5) {
    $password = hash("sha256", $_POST["password"]);
}else{
    die ("Enter a valid input");
}

if(isset($_POST["confirmPassword"]) && $_POST["confirmPassword"] != "" ) {
    $confirmPassword = $_POST["confirmPassword"];
}else{
    die ("Enter a valid input");
}

$user_type = "store";


$sql1="Select * from stores where email=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

if(empty($row)){
$sql2 = "INSERT INTO `stores`(`store_name`, `email`, `password`, `type`) VALUES (?,?,?,?);"; #add the new user to the database
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss", $store_name, $email, $password, $user_type);
$stmt2->execute();
$result2 = $stmt2->get_result();

session_start();
$_SESSION["store_name"] = $store_name;
$_SESSION["new_account"] = true;

header('location: ../login.php');
}
else{
    session_start();
    $_SESSION["email_used"] = true;
    header('location: ../store-register.php');
}
?>