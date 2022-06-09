<?php

if(isset($_POST)){
    require_once 'includes/conexion.php';

    if(!isset($_SESSION)){
        session_start();
    }

    // Recoger los valores del formulario
    $nombre = (isset($_POST['nombre'])) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = (isset($_POST['apellidos'])) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = (isset($_POST['email'])) ? mysqli_real_escape_string($db, $_POST['email']) : false;
    $password = (isset($_POST['password'])) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    // Array de errores
    $errores = array();

    // Validar los datos antes de guardarlos en la BD
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $errores['nombre'] = "El nombre no es valido";
    }

    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validate = true;
    }else{
        $apellido_validate = false;
        $errores['apellido'] = "El apellido no es valido";
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $errores['email'] = "El email no es valido";
    }

    if(!empty($password)){
        $password_validate = true;
    }else{
        $password_validate = false;
        $errores['password'] = "La contraseña esta vacida";
    }

    $guardar_usuario = false;

    if(count($errores) == 0 ){
        $guardar_usuario = true;
        
        // Cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        // Insertamos usuario en la BD
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if($guardar){
            $_SESSION['completado'] = "El registro sae ha compeltado con exito";
        }else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }

    }else {
        $_SESSION['errores'] = $errores;
        
    }

}

header('Location: index.php');
