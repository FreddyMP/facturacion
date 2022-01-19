<?php
include('../control/cone.php');
session_start();
echo $usuario = $_SESSION["usuario_logueado"];
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$stock = $_POST["stock"];
$fcv = $_POST["fcv"];
$estado = $_POST["estado"];
$categoria = $_POST["categoria"];
$precio_venta = $_POST["precio_v"];
$casa = $_POST["casa_productora"];
$status = $_POST["estado"];
$fecha_actual = date("y/m/d");
$almacen = $_POST["almacen"];
$impuesto = $_POST["impuesto"];
$precio_compra = $_POST["precio_c"];

$query="UPDATE articulos set nombre = '$nombre', descripcion = '$descripcion', stock = $stock, almacen = $almacen, fcv = '$fcv', status = '$status',  categoria= '$categoria', precio_compra = $precio_compra,
precio_venta = $precio_venta, codigo_impuesto = $impuesto, casa_productora = '$casa', fecha_modificacion= $fecha_actual, modificado_por = '$usuario' where id = $id";

$update = $conexion->query($query);

header("location:../../views/ver_articulos.php?id=$id");

?>