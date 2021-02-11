<?php
if (isset($_POST['submit'])) {
    //Conexion a la base de datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, trim($_POST['apellidos'])) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

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

    $guardarUsuario = false;

    if (count($errores) == 0) {
        $guardarUsuario = true;

        // Comprobar si el Email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $resultado_email = mysqli_query($db, $sql);
        $existe_usuario = mysqli_fetch_assoc($resultado_email);

        if ($existe_usuario['id'] == $_SESSION['usuario']['id'] || empty($existe_usuario)) {
            // Actualizar usuario a la db
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email' WHERE id = {$_SESSION['usuario']['id']}";
            $guardar = mysqli_query($db, $sql);
            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se han actualizado con exito";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
            }  
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe, Email no valido.";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }    
}
header('Location: misDatos.php');
?>