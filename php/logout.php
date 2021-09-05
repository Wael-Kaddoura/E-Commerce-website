<?php

session_start();

$_SESSION["logedin"] = false;

header("Location:../index.php")

?>