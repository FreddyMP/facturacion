<?php
include("../control/cone.php");
$cantidad = $_POST["cantidad"];
$id= $_POST["id"];
$conexion->query("UPDATE articulos set existencia = existencia + $cantidad  , cantidad_disponible= cantidad_disponible + $cantidad  where id = $id");

header("location:../../views/cargas_a_inventario.php");

?>