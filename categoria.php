<?php require_once 'includes/header.php'; ?>
<?php include_once 'includes/sidebar.php' ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <?php
    $categoriaActual = conseguirCategoria($db, $_GET['id']);
    if (!isset($categoriaActual['id'])) {
        header("Location: index.php");
    }
    ?>
    <h1>Entradas de <?= $categoriaActual['nombre'] ?></h1>

    <?php $entradas = conseguirEntradas($db, null, $_GET['id']);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) : ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id'] ?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <p><?=substr($entrada['descripcion'], 0, 180) . '...'?></p>
                </a>
            </article>
    <?php endwhile;
    else: ?>
        <span style="margin-top: 5%; display: block; font-size: 2em; color: gray;">No hay entradas en esta categoria</span>
    <?php endif;?>
</div> <!-- FIN PRINCIPAL -->

<?php include_once 'includes/footer.php' ?>