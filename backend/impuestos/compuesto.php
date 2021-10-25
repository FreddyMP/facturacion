<?php
include('../control/cone.php');

 echo $cabecera = $_POST["cabecera"];

 echo $destino = $_POST["destino"];

 echo $porcentaje = $_POST["porcentaje"];

    $conexion->query("INSERT INTO impuestos_detalles (cabecera, porcentaje, destino) values ( $cabecera,$porcentaje,'$destino')");

    $consulta_total = $conexion->query("SELECT SUM(porcentaje) AS porciento FROM impuestos_detalles  WHERE cabecera = $cabecera");
    $recorrido_valor_impuestos = $consulta_total->fetch_assoc();
    $valor_total_impuesto = $recorrido_valor_impuestos['porciento'];

    $conexion->query("UPDATE impuestos SET porcentaje = $valor_total_impuesto where id = $cabecera ");

    header("location:../../views/crear_codigo_detalle.php?id=$cabecera");

 

?>