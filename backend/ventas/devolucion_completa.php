<?php
include('../control/cone.php');

session_start();
$usuario = $_SESSION["usuario_logueado"];

$factura = $_GET["factura"];


#$conexion->query("UPDATE venta_detalle SET precio_sin_itbis = 0, precio_con_itbis = 0, cantidad =  0,
#total_itbis = 0, total_sin_itbis = 0, total_con_itbis= 0 where codigo in (SELECT codigo_detalles FROM venta_cabecera WHERE numero_factura = '$factura')");


#$conexion->query("UPDATE venta_cabecera SET neto = 0, itbis = 0, bruto = 0, descuentos = 0  WHERE numero_factura = '$factura'");

$query_factura = $conexion->query("SELECT id from venta_cabecera where numero_factura= '$factura'");
$resultado_factura = $query_factura->fetch_assoc();

echo $resultado_factura["id"];
$id_venta =  $resultado_factura["id"];

$query_insert_devolucion = "INSERT INTO  devoluciones (id_venta_cabecera, tipo_devolucion, numero_factura, creado_por) values ($id_venta,'Completa', '$factura','$usuario')";
$conexion->query($query_insert_devolucion);
   

header("location: ../../views/devoluciones.php"); 

?>