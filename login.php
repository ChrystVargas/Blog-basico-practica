<?php
// Iniciar la sesion y la conexion a la db
require_once 'includes/conexion.php';

//recoger los datos del formulario
if (isset($_POST)) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : false;
    $password = isset($_POST['password']) ? trim($_POST['password']) : false;

    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        // Comprobar la password
        $verificar = password_verify($password, $usuario['password']); 

        if ($verificar) {
            // Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usuario-logueado'] = "El usuario se logeo correctamente";
        } else {
            $_SESSION['error-login'] = "El password es incorrecto";
        }        
    } else {
        $_SESSION['error-login'] = "El email no es valido";
    }    
}

header('Location: index.php');
?>