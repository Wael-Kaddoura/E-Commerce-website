<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "storedb";

$connection = new mysqli($server, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Failed");
}