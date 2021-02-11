<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php' ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Categoria</h1>
    <p>Agrega nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas</p>
    <br>
    <form action="guardarCategoria.php" method="POST">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre">

        <input type="submit" value="Guardar">
    </form>

</div> <!-- FIN PRINCIPAL -->

<?php include_once 'includes/footer.php' ?>