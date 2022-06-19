<?php
require_once 'includes/redirect.php';
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

?>

<div id="principal">
    <h1>Crear Categorias</h1>
    <h2>
        Añade nuevas categorias al Blog
    </h2>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre" />

        <input type="submit" value="Guardar" />
    </form>
    
</div>

<?php require_once 'includes/footer.php' ?>