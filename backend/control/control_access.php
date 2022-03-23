<?php

    include('cone.php');

    $user_recibido = $_POST["user"];
    $password_recibido = $_POST["pass"];

    $consulta = "SELECT user, contrasena, nombre, id, rol, nombre from usuarios where estado = 1 and user = '$user_recibido' and  contrasena = '".$password_recibido."'"; 
    $query = $conexion->query($consulta);
    $usuario = $query->fetch_assoc();
    if($query->num_rows > 0){
        session_start();
        $_SESSION["usuario_logueado"] = $usuario['user'];
        $_SESSION["rol"] = $usuario['rol'];
        header('location:../../views/crear_articulo.php');
    } else{
        header('location:../../index.php');
    }
    
   
?>