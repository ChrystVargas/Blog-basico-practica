<!-- BARRA LATERAL -->
<aside id="sidebar">
    <!-- Buscador -->
    <div id="login" class="block-aside">
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
    <div id="usuario-logueado" class="block-aside">
        <h3>Bienvenido, <?=$_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'];?></h3>
        <a class="boton boton-verde" href="crearEntrada.php">Crear entradas</a>
        <a class="boton" href="crearCategoria.php">Crear categoria</a>
        <a class="boton boton-naranja" href="misDatos.php">Mis datos</a>
        <a class="boton boton-rojo" href="cerrarSesion.php">Cerrar Sesion</a>
    </div>
    <?php elseif(!isset($_SESSION['usuario'])): ?>

    <div id="login" class="block-aside">
        <h3>Identificate</h3>

        <!-- Mostrar errores -->
        <?php if(isset($_SESSION['usuario-logueado'])): ?>
        <div class="alerta"><?=$_SESSION['usuario-logueado']?></div>
        <?php elseif(isset($_SESSION['error-login'])): ?>
        <div class="alerta alerta-error"><?= $_SESSION['error-login'] ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <input type="submit" value="Entrar">
        </form>
    </div>

    <div id="register" class="block-aside">
        <h3>Registrate</h3>

        <!-- Mostrar errores -->
        <?php if(isset($_SESSION['completado'])): ?>
        <div class="alerta"><?= $_SESSION['completado'] ?></div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error"><?= $_SESSION['errores']['general'] ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''?>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''?>

            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''?>

            <label for="password">Password</label>
            <input type="password" name="password">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ''?>

            <input type="submit" value="Registrar" name="submit">
        </form>
    </div>
    <?php borrarErrores(); ?>
    <?php endif;?>
</aside>