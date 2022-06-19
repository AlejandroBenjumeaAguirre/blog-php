<?php require_once 'includes/header.php'; ?>

    
        <!-- SIDEBAR -->
        <?php include_once 'includes/sidebar.php';  ?>
    
    <!-- CONTENIDO PRINCIPAL -->

    <div id="principal">
        <h1>Ultimas entradas</h1>

        <?php
            $entradas = conseguirUltimasEstradas($db);
            if(!empty($entradas)):
                while($entrada = mysqli_fetch_assoc($entradas)):
        ?>

       
            <article class="entrada">
                <h2><?=$entrada['titulo'] ?></h2>
                <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                <p>
                <?=substr($entrada['descripcion'], 0, 300)."..."; ?>
                </p>
            </article>
        
        <?php
                endwhile;
            endif; 
        ?>

        <div id="ver-todas">
            <a href="">Ver todas las entradas</a>
        </div>
        
    </div>
<!-- PIE DE PAGINA -->
<?php include_once 'includes/footer.php' ?>