<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>

        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda" />
            <input type="submit" value="Buscar" />
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario_logueado" class="bloque">
            <h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
            <a href="entradas.php" class="boton boton-verde">Crear entradas </a>
            <a href="categoria.php" class="boton">Crear categorias </a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos </a>
            <a href="logout.php" class="boton boton-rojo">Cerrar sesión </a>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
    <div id="login" class="bloque">
        <h3>Login</h3>

        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alerta alerta-error">
                <?=$_SESSION['error_login'];?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" />

            <label for="password">Password</label>
            <input type="password" name="password" />

            <input type="submit" value="Entrar" />
        </form>
    </div>            

    <div id="registro" class="bloque">
        <?php if(isset($_SESSION['completado'])) : ?>
            <div class="alerta alerta-exito"><?=$_SESSION['completado']; ?></div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-exito"><?=$_SESSION['errores']['general']; ?></div>
        <?php endif; ?>
         <h3>Registrate</h3>
        <form action="registro.php" method="POST">
                    
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
                    
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

            <label for="email">Email</label>
            <input type="email" name="email" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

            <label for="password">Password</label>
            <input type="password" name="password" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

            <input type="submit" name="submit value="Registrar" />
        </form>
        <?php borrarErrores(); ?>
    </div>
    <?php endif; ?>
</aside>