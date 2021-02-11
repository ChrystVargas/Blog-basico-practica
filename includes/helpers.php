<?php
function mostrarErrores($errores, $campo) {
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>". $errores[$campo]."</div>";
    }
    return $alerta;
}

function borrarErrores() {
    $_SESSION['errores'] = null;
    $_SESSION['errores']['general'] = null;
    $_SESSION['completado'] = null;
    $_SESSION['error-login'] = null;
    $_SESSION['usuario-logueado'] = null;
}

function conseguirCategorias($db) {
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($db, $sql);
    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }
    return $resultado;
}

function conseguirEntradas($db, $limit = null, $categoria = null, $busqueda = null) {
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id";
 
    if (!empty($categoria)) {
        $sql .= " WHERE e.categoria_id = $categoria";
    }

    if (!empty($busqueda)) {
        $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
    }
    
    $sql .= " ORDER BY e.id DESC ";

    if ($limit) {
        $sql .= "LIMIT 4";
    }

    $entradas = mysqli_query($db, $sql);
    $resultado = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $resultado;
}

function conseguirCategoria($db, $id) {
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categoria = mysqli_query($db, $sql);

    $resultado = array();
    if ($categoria && mysqli_num_rows($categoria) == 1) {
        $resultado = mysqli_fetch_assoc($categoria);
    }
    return $resultado;
}

function conseguirEntrada($db, $id) {
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id INNER JOIN usuarios u ON e.usuario_id = u.id WHERE e.id = $id";
 
    $entrada = mysqli_query($db, $sql);
    $resultado = array();

    if ($entrada && mysqli_num_rows($entrada) == 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}