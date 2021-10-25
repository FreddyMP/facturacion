<?php
$consulta_id = "SELECT id from articulos where borrado_por is null and fecha_borrado is null order by id desc  limit 1";
$query_id = $conexion->query($consulta_id);
$resultado = $query_id->fetch_assoc();

$consulta_almacenes = "SELECT id, nombre from almacenes where borrado_por is null and fecha_borrado is null order by id desc ";
$query_almacenes = $conexion->query($consulta_almacenes);


$consulta_categorias = "SELECT id, nombre from categorias where borrado_por is null and fecha_borrado is null order by id desc ";
$query_categorias = $conexion->query($consulta_categorias);

?>