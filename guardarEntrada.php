<?php
if (isset($_POST)) {
    //Conexion a la base de datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de registro
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, trim($_POST['titulo'])) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, trim($_POST['descripcion'])) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = isset($_SESSION['usuario']) ? (int)$_SESSION['usuario']['id'] : false;

    // Array de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos
    if (empty($titulo)) {
        $errores['titulo'] = 'El titulo no es valido';
    }
    
    if (empty($descripcion)) {
        $errores['descripcion'] = 'La descripcion no es valida';
    }

    if (empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = 'La categoria no es valida';
    }

    if (empty($usuario) && !is_numeric($usuario)) {
        $errores['usuario'] = 'El usuario no es valido';
    }

    if (count($errores) == 0) {
        if (isset($_GET['editar'])) {
            $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria WHERE id = {$_GET['editar']} AND usuario_id = {$_SESSION['usuario']['id']}";
        } else {
            $sql = "INSERT INTO entradas VALUES (null, '$usuario', '$categoria', '$titulo', '$descripcion', CURDATE());";
        }
        // Procesar entrada en la db
        $guardar = mysqli_query($db, $sql);

        header('Location: index.php');
    } else {
        $_SESSION['errores'] = $errores;
        if (isset($_GET['editar'])) {
            header('Location: editarEntrada.php?id='.$_GET['editar']);
        } else {
            header('Location: crearEntrada.php');
        }
    }    
} else {
    header('Location: index.php');
}
?>