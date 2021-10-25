<?php
$codigo = $_GET["codigo"];

include('../control/cone.php');

session_start();

$lista_detalles = "SELECT id_articulo, cantidad from venta_detalle where codigo = '$codigo'";
$query_list = $conexion->query($lista_detalles);

while($detalle = $query_list->fetch_assoc()){
   $cantidad_del_articulo_return= $detalle["cantidad"];
    $id_articulo=$detalle["id_articulo"];
    $conexion->query("UPDATE articulos SET cantidad_en_movimiento = cantidad_en_movimiento - $cantidad_del_articulo_return, cantidad_disponible = cantidad_disponible + $cantidad_del_articulo_return, existencia = existencia+ $cantidad_del_articulo_return where id= $id_articulo");
}

$consulta = "DELETE FROM venta_detalle WHERE codigo= '$codigo'";
$query= $conexion->query($consulta);    

header("location:../../views/punto_de_facturacion.php");

?>
