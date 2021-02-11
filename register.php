<?php
if (isset($_POST['submit'])) {
    //Conexion a la base de datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, trim($_POST['apellidos'])) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;

    // Array de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {
        $nombreValidado = true;
    } else {
        $nombreValidado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }
    
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)) {
        $apellidosValidado = true;
    } else {
        $apellidosValidado = false;
        $errores['apellidos'] = 'Los apellidos no son valido';
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailValidado = true;
    } else {
        $emailValidado = false;
        $errores['email'] = 'El email no es valido';
    }

    if (!empty($password)) {
        $passwordValidado = true;
    } else {
        $passwordValidado = false;
        $errores['password'] = 'El password esta vacio';
    }

    $guardarUsuario = false;

    if (count($errores) == 0) {
        $guardarUsuario = true;
        // Cifrar la password
        $passwordSegura = password_hash($password, PASSWORD_BCRYPT, ['const' => 4]);
        // Insertar usuario a la db
        $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$passwordSegura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            $_SESSION['completado'] = "El registro se a completado con exito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }        
    } else {
        $_SESSION['errores'] = $errores;
    }    
}
header('Location: index.php');
?>