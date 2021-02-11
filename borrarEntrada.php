<?php
require_once "includes/conexion.php";

if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    $usuario = $_SESSION['usuario']['id'];
    $entrada = $_GET['id'];
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario AND id = $entrada";
    mysqli_query($db, $sql);
}
header("Location: index.php");
?>