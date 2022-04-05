<?php
include('../control/cone.php');

$factura = $_POST["factura"];

$lineas = "SELECT venta_detalle.id, venta_detalle.cantidad,venta_detalle.id_articulo
 from venta_detalle inner join venta_cabecera on venta_cabecera.codigo_detalles = venta_detalle.codigo
 where venta_cabecera.numero_factura= '$factura' and venta_detalle.borrado_por is null and venta_detalle.fecha_borrado is null";

$query_lineas = $conexion->query($lineas);
$numero_de_lineas = $query_lineas->num_rows;

$numero_registros = 1;
$contando = 1;

while($numero_registros <= $numero_de_lineas){
    if(isset($_POST["articulo".$contando])){
        $id= $_POST["id".$contando];
        $cantidad = $_POST["cantidad".$contando];
        $articulo = $_POST["articulo".$contando];
        echo  $id."<br>";
        echo $articulo."<br>";
        echo $cantidad."<br>";

        $linea_correspondiente = "SELECT id, precio_sin_itbis, precio_con_itbis, cantidad, total_itbis, total_sin_itbis, total_con_itbis FROM venta_detalle where id = $id";
        $resultado = $conexion->query($linea_correspondiente);
        $valores_linea = $resultado->fetch_assoc();

        $id_linea = $valores_linea['id'] ;
        $cantidad_db = $valores_linea['cantidad'];

        $cal_precio_sin_itbis = $valores_linea['precio_sin_itbis'] / $valores_linea['cantidad'] *  $cantidad;
        $nuevo_precio_sin_itbis = $valores_linea['precio_sin_itbis'] - $cal_precio_sin_itbis;

        $cal_precio_con_itbis = $valores_linea['precio_con_itbis'] / $valores_linea['cantidad'] * $cantidad;
        $nuevo_precio_con_itbis = $valores_linea['precio_con_itbis'] - $cal_precio_con_itbis;

        $nueva_cantidad = $valores_linea['cantidad'] - $cantidad;

        $cal_total_itbis = $valores_linea['total_itbis'] / $valores_linea['cantidad'] *  $cantidad;
        $nueva_total_itbis = $valores_linea['total_itbis'] - $cal_total_itbis;

        $cal_total_sin_itbis = $valores_linea['total_sin_itbis'] / $valores_linea['cantidad'] * $cantidad;
        $nuevo_total_sin_itbis = $valores_linea['total_sin_itbis'] - $cal_total_sin_itbis;

        $cal_total_con_itbis = $valores_linea['total_con_itbis'] / $valores_linea['cantidad'] * $cantidad;
        $nuevo_total_con_itbis = $valores_linea['total_con_itbis'] - $cal_total_con_itbis;

        $conexion->query("UPDATE venta_detalle 
        SET precio_sin_itbis = $nuevo_precio_sin_itbis, precio_con_itbis = $nuevo_precio_con_itbis, cantidad =  $nueva_cantidad,
        total_itbis = $nueva_total_itbis, total_sin_itbis = $nuevo_total_sin_itbis, total_con_itbis= $nuevo_total_con_itbis where id = $id_linea ");

        
    }
    $numero_registros ++ ;
    $contando ++;
}
$valores_detalle = "SELECT  SUM(venta_detalle.precio_sin_itbis) AS sin_itbis,  SUM(venta_detalle.precio_con_itbis) AS con_itbis, SUM(venta_detalle.total_itbis) AS itbis 
from venta_detalle inner join";
while($leyendo = $query_lineas->fetch_assoc()){
    $leyendo['sin_itbis']."<br>";
    $leyendo['con_itbis']."<br>";
    $leyendo['itbis']."<br>";
}

$query_factura = $conexion->query("SELECT id from venta_cabecera where numero_factura= '$factura'");
$resultado_factura = $query_factura->fetch_assoc();

echo $resultado_factura["id"];
$id_venta =  $resultado_factura["id"];

$query_insert_devolucion = "INSERT INTO  devoluciones (id_venta_cabecera, tipo_devolucion, numero_factura, creado_por) values ($id_venta,'Artículos', '$factura','$usuario')";
$conexion->query($query_insert_devolucion);
header("location: ../../views/devoluciones.php");

?>