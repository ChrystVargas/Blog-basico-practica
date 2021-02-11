<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php';?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Entrada</h1>
    <p>Agrega nuevas entradas al blog para que los usuario puedan leerlas y disfrutar de nuestro contenido.</p>
    <br>
    
    <form action="guardarEntrada.php" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'titulo') : ''?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" cols="100" rows="7"></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'descripcion') : ''?>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="">
            <?php $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
                while($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
                <?php endwhile; 
            endif;?>
        </select>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'categoria') : ''?>

        <input type="submit" value="Guardar">
    </form>
</div> <!-- FIN PRINCIPAL -->
<?php borrarErrores(); ?>
<?php include_once 'includes/footer.php' ?>