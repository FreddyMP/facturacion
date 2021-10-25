<?php
$id = $_GET['id'];
$codigo = $_GET["codigo"];

include('../control/cone.php');
session_start();
$fecha = date("y/m/d");
echo $codigo. " - ". $id;
$usuario = $_SESSION['usuario_logueado'];

$consulta_return = $conexion->query("SELECT id_articulo, cantidad from venta_detalle where id = $id");
$cantidad_return = $consulta_return->fetch_assoc();

$cantidad_del_articulo_return= $cantidad_return["cantidad"];
$id_articulo=$cantidad_return["id_articulo"];

$conexion->query("UPDATE articulos SET cantidad_en_movimiento = cantidad_en_movimiento - $cantidad_del_articulo_return, cantidad_disponible = cantidad_disponible + $cantidad_del_articulo_return, existencia = existencia+ $cantidad_del_articulo_return where id= $id_articulo");

$consulta = "DELETE FROM venta_detalle WHERE id= $id";
$query= $conexion->query($consulta);    

header("location:../../views/punto_de_facturacion.php?codigo=$codigo");

?>
