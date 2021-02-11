<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php' ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <?php
    $entradaActual = conseguirEntrada($db, $_GET['id']);
    if (!isset($entradaActual['id'])) {
        header("Location: index.php");
    }
    ?>

    <h1>Editar Entrada</h1>
    <p>Edita tu entrada <?= $entradaActual['titulo'] ?></p>
    <br>

    <form action="guardarEntrada.php?editar=<?=$entradaActual['id']?>" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="<?= $entradaActual['titulo'] ?>">
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'titulo') : ''?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" cols="100" rows="7"><?= $entradaActual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'descripcion') : ''?>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="">
            <?php $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
                while($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?=$categoria['id']?>" <?= ($categoria['id'] == $entradaActual['categoria_id']) ? 'selected = "selected"' : '' ?>><?=$categoria['nombre']?></option>
            <?php endwhile; 
            endif;?>
        </select>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'categoria') : ''?>

        <input type="submit" value="Guardar">
    </form>

</div> <!-- FIN PRINCIPAL -->
<?php borrarErrores(); ?>
<?php include_once 'includes/footer.php' ?>