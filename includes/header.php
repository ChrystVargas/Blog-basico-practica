<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Basico</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>" />
</head>

<body>
    <!-- CABECERA -->
    <header id="header">
        <div id="logo">
            <a href="index.php">
                Blog Basico
            </a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php $categorias = conseguirCategorias($db);
                if (!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
                <?php endwhile; 
                endif;?>
                <li><a href="index.php">Sobre mi</a></li>
                <li><a href="index.php">Contacto</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    
    <div id="container">