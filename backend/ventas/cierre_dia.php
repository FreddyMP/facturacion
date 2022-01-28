<?php

    include('../control/cone.php');
    session_start();

    $usuario = $_SESSION["usuario_logueado"];
    $total = $_POST["total"];
    $id = $_POST["id"];

    $consulta_cuadres = "SELECT fecha_creacion, modificacion_fecha from cuadres where usuario_inicio = '$usuario' and estado='Abierto' ";
    $query_cuadres = $conexion->query($consulta_cuadres);
    $resultados_cuadre = $query_cuadres->fetch_assoc();
    $fecha = $resultados_cuadre['fecha_creacion'];
    $modificacion = $resultados_cuadre['modificacion_fecha'];
    echo   $fecha;
    echo $usuario."<br>";
    echo $modificacion;


    $consulta_ventas = "SELECT sum(neto) as total from venta_cabecera where creado_por = '$usuario' and fecha_creacion > '$fecha'";
    
    $venta_dia = $conexion->query($consulta_ventas);
    $resultado = $venta_dia->fetch_assoc();
    $ventas = $resultado["total"];
    echo $ventas;   

   $cierre_dia = $conexion->query("UPDATE cuadres set usuario_cierre = '$usuario', sistema = $ventas , cierre = $total, estado = 'Cerrado' where id = $id");
   
   header("location:../../views/cuadres.php");
 ?>