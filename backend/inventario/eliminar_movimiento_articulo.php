<?php
    include('../control/cone.php');

    $id = $_GET["id"];
    $cantidad = $_GET["cantidad"];

    $conexion->query("UPDATE articulos set cantidad_en_movimiento = 0, cantidad_disponible = cantidad_disponible + $cantidad, existencia = existencia + $cantidad 
    where id = $id");

    header("location:../../views/articulos_en_movimiento.php");

?>