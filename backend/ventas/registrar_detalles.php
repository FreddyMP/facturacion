<?php
  include('../control/cone.php');

  session_start();
  $usuario = $_SESSION["usuario_logueado"];

  $id_articulo = $_POST["articulo"];
  $cantidad = $_POST["cantidad"];
  $nombre = $_POST["name"];

  //todos los articulos activos

  $consulta_all = "SELECT * from articulos where id=  $id_articulo";
  $query_all = $conexion->query($consulta_all);
  $articulo = $query_all->fetch_assoc();

  //calculos de precio e itbis para las lineas detalle de las ventas

    $impuesto = $_POST['impuesto'];
    
    $consulta_codigo_impuesto = "SELECT porcentaje from impuestos where id = $impuesto and borrado_por is null";
    $query_codigo_impuesto = $conexion->query($consulta_codigo_impuesto);
    $resultado = $query_codigo_impuesto->fetch_assoc();

    $porcentaje_impuesto_real = $resultado['porcentaje'] / 100;
    $itbis = round($articulo["precio_venta"] * $porcentaje_impuesto_real, 2);
    $precio_sin_itbis = round($articulo["precio_venta"], 2);
    $precio_con_itbis = round($precio_sin_itbis + $itbis, 2); 
    $total_itbis= round($itbis * $cantidad, 2);
    $total_sin_itbis = round($precio_sin_itbis * $cantidad, 2);
    $total_con_itbis = round($precio_con_itbis * $cantidad, 2);
    

    $usuario = $_SESSION["usuario_logueado"];
//Inserción de las lineas detalles de las ventas
if(isset($_POST['codigo'])){
    $codigo = $_POST["codigo"];
    $conexion->query("INSERT INTO venta_detalle (id_articulo, articulo, codigo, cantidad, precio_sin_itbis, precio_con_itbis, itbis, total_itbis, total_sin_itbis, total_con_itbis, creado_por)
    values ($id_articulo,'$nombre', '$codigo', $cantidad, $precio_sin_itbis, $precio_con_itbis, $itbis, $total_itbis, $total_sin_itbis, $total_con_itbis, '$usuario')");
}
else{
    $fecha = date("y/m/d/h");
    $codigo = rand(1,60000000000).$fecha;
    $conexion->query("INSERT INTO venta_detalle (id_articulo, articulo, codigo, cantidad, precio_sin_itbis, precio_con_itbis, itbis, total_itbis, total_sin_itbis, total_con_itbis, creado_por)
    values ($id_articulo,'$nombre', '$codigo', $cantidad, $precio_sin_itbis, $precio_con_itbis, $itbis, $total_itbis, $total_sin_itbis, $total_con_itbis, '$usuario')");
}
    $conexion->query("UPDATE articulos SET cantidad_en_movimiento = cantidad_en_movimiento + $cantidad, cantidad_disponible= cantidad_disponible - $cantidad, existencia = existencia - $cantidad where id = $id_articulo");
 header("location:../../views/punto_de_facturacion.php?codigo=$codigo");



 



 
?>