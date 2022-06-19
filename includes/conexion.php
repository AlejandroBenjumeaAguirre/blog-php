<?php

$server = 'localhost';
$username = 'root';
$password = 'AB120792ab';
$database = 'blog-php';

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la seccion
if(!isset($_SESSION)){
    session_start();
}


?>