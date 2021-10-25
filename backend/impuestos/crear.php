<?php
include('../control/cone.php');
 session_start();
 $usuario = $_SESSION["usuario_logueado"];

 $nombre = $_POST["nombre"];
 $tipo = $_POST["tipo"];

    $porcentaje = $_POST["porcentaje"];
    if($porcentaje > 0 ){
        $conexion->query("INSERT INTO impuestos (nombre, tipo, porcentaje, creado_por) values ('$nombre','$tipo',$porcentaje,'$usuario')");
    }
    else{
        $conexion->query("INSERT INTO impuestos (nombre, tipo, creado_por) values ('$nombre','$tipo','$usuario')");
       
    }

    $consulta_ultimo = "SELECT * from impuestos WHERE creado_por = '$usuario' order by id desc limit 1";
    $query_ultimo = $conexion->query($consulta_ultimo);
    $resultado_id = $query_ultimo->fetch_assoc();
    $id= $resultado_id["id"];

    if($tipo == "Simple"){
        $conexion->query("INSERT INTO impuestos_detalles (cabecera, porcentaje, destino) values ('$id','$porcentaje','$nombre')");
         header("location:../../views/crear_codigo.php");
    }else{

        header("location:../../views/crear_codigo_detalle.php?id=$id");
    }
    

 

 //

?>