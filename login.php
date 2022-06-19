<?php

require_once 'includes/conexion.php';

if(isset($_POST)){

    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1;";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){

        $usuario = mysqli_fetch_assoc($login);
        
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            $_SESSION['usuario'] = $usuario;

        }else {
            $_SESSION['error_login'] = "Email o contraseña incorrecto";
        }

    }else {
        $_SESSION['error_login'] = "Email o contraseña incorrecta";
    }
}

header('Location: index.php');