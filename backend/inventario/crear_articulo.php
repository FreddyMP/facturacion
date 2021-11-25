<?php
 echo $nombre = $_POST["nombre"];
 echo $descripcion = $_POST["descripcion"];
 echo $existencia=$_POST["existencia"];
 echo $stock= $_POST["stock"];
 echo $fcc= $_POST["fcc"];
 echo $fcv= $_POST["fcv"];
 echo $almacen= $_POST["almacen"];
 echo $estado = $_POST["estado"];
 echo $categoria = $_POST["categoria"];
 echo $precio_c = $_POST["precio_c"];
 echo $precio_v = $_POST["precio_v"];
 echo $casa_productora = $_POST["casa_productora"];
 echo $cantidad_disponible = $existencia - $stock;
 echo $codigo_impuesto = $_POST["impuestos"];

include('../control/cone.php');
$usuario = $_SESSION["usuario_logueado"];

$conexion->query("INSERT INTO articulos (nombre, descripcion, existencia, stock, codigo_impuesto,  fcv, status, categoria, precio_compra, precio_venta, casa_productora,cantidad_disponible, creado_por, almacen )
 values ('$nombre','$descripcion',$existencia, $stock,$codigo_impuesto,'$fcv','$estado', '$categoria', $precio_c,$precio_v, '$casa_productora', $cantidad_disponible, '$usuario', $almacen)");

 header('location: ../../views/inventario.php');
 ?>