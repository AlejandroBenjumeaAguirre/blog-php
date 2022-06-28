<?php

function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>$errores[$campo]</div>";
    }

    return $alerta;
}

function borrarErrores(){

    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }
    
    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
    }

    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
        unset($_SESSION['errores_entrada']);
    }

    return;
}

function conseguirCategorias($db) {
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($db, $sql);

    $result = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }

    return $result;
}

function conseguirEstradas($conexion, $limit = false, $categoria = null, $busqueda=null){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ";

    if($busqueda){
         $sql = $sql."WHERE e.titulo LIKE '%$busqueda%'";
    }

    if(!empty($categoria)){
        $sql .= "WHERE e.categoria_id = $categoria ";
    }

    $sql .= "ORDER BY e.id DESC ";

    if($limit){
        $sql = $sql."LIMIT 4";
    }

    $entradas = mysqli_query($conexion, $sql);

    $result = array();

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }

    return $result;
}

function conseguirCategoria($db, $id) {
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query($db, $sql);

    $result = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = mysqli_fetch_assoc($categorias);
    }

    return $result;
}

function conseguirEntrada($conexion, $id=null, $busqueda=null){

    $sql = "SELECT e.*, c.nombre as categoria, c.id AS categoria_id, CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e ".
        "INNER JOIN categorias c ON e.categoria_id = c.id ".
        "INNER JOIN usuarios u ON e.usuario_id = u.id ";
    
    if($id){
        $sql = $sql."WHERE e.id = $id;";
    }elseif($busqueda){
        $sql = $sql."WHERE e.titulo LIKE '%$busqueda%'";
    }
   
    $entrada = mysqli_query($conexion, $sql);

    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;
}


