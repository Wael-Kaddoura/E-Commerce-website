<?php
include "connection.php";

session_start();

if(isset($_POST["first_name"]) && $_POST["first_name"] != "" && strlen($_POST["first_name"]) >= 3) {
    $first_name = $_POST["first_name"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && strlen($_POST["last_name"]) >= 3) {
    $last_name = $_POST["last_name"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["gender"]) && $_POST["gender"] != "" ) {
    $gender = $_POST["gender"];
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

$user_type = "user";

$sql1="Select * from users where email=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

if(empty($row)){
$sql2 = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `gender`, `type`) VALUES (?,?,?,?,?,?);"; # add the new user to the database
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssssss", $first_name, $last_name, $email, $password, $gender, $user_type);
$stmt2->execute();
$result2 = $stmt2->get_result();

$_SESSION["name"] = $name;
$_SESSION["gender"] = $gender;
$_SESSION["new_account"] = true;

header('location: ../login.php');
}
else{
    $_SESSION["email_used"] = true;
    header('location: ../user-register.php');
}
?>