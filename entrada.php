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
    <h1><?= $entradaActual['titulo'] ?></h1>

    <a href="categoria.php?id=<?= $entradaActual['categoria_id'] ?>">
        <h2><?= $entradaActual['categoria'] ?></h2>
    </a>

    <h4><?= $entradaActual['fecha'] ?> | <?= $entradaActual['usuario'] ?></h4>
    <p><?= $entradaActual['descripcion'] ?></p>

    <?php if($_SESSION['usuario'] && $_SESSION['usuario']['id'] == $entradaActual['usuario_id']): ?>
    <div class="block-aside" style="margin-top: 10%;">
        <a class="boton boton-naranja" href="editarEntrada.php?id=<?=$entradaActual['id']?>">Editar Entrada</a>
        <a class="boton boton-rojo" href="borrarEntrada.php?id=<?=$entradaActual['id']?>">Eliminar Entrada</a>
    </div>
    <?php endif; ?>
</div> <!-- FIN PRINCIPAL -->

<?php include_once 'includes/footer.php' ?>