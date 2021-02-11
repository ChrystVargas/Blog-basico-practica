<?php
if (isset($_POST)) {
    //Conexion a la base de datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;

    // Array de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {        
    } else {
        $errores['nombre'] = 'El nombre no es valido';
    }
    
    if (count($errores) == 0) {
        // Insertar categoria a la db
        $sql = "INSERT INTO categorias VALUES (null, '$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
}
header('Location: index.php');
?>