<?php 
//Conexion
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_basico';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAME 'utf8'");

// Iniciar sesion
if (!isset($_SESSION)) {
    session_start();
}