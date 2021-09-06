<?php

session_start();

$_SESSION["logedin"] = false;

session_destroy();

header("Location:../index.php")

?>