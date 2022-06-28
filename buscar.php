<?php require_once 'includes/header.php'; 
      require_once 'includes/helpers.php';
?>


<?php 

    if(!isset($_POST['busqueda'])){
        header('Location: index.php');
    }
?>
    
        <!-- SIDEBAR -->
        <?php include_once 'includes/sidebar.php';  ?>
    
    <!-- CONTENIDO PRINCIPAL -->

    <div id="principal">
        <h1>Busqueda: <?=$_POST['busqueda'] ?></h1>

        <?php
            $entradas = conseguirEstradas($db, false, null, $_POST['busqueda']);
            if(!empty($entradas) && mysqli_num_rows($entradas) >=1 ):
                while($entrada = mysqli_fetch_assoc($entradas)):
        ?>

       
            <article class="entrada">
                <a href="detalle-entrada.php?id=<?=$entrada['id'];?>">
                    <h2><?=$entrada['titulo'] ?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <p>
                        <?=substr($entrada['descripcion'], 0, 300)."..."; ?>
                    </p>
                </a>
            </article>
        
        <?php
                endwhile;
            else:
        ?>
        <div class="alerta ">
                No hay entradas en esta categoria
        </div>
        <?php
            endif;
        ?>
        
    </div>
<!-- PIE DE PAGINA -->
<?php include_once 'includes/footer.php' ?>