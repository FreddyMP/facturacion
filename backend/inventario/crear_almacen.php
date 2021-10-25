<?php
 echo $nombre = $_POST["nombre"];
 echo $descripcion = $_POST["descripcion"];

include('../control/cone.php');
$usuario = $_SESSION["usuario_logueado"];

$conexion->query("INSERT INTO almacenes (nombre, descripcion, creado_por) values ('$nombre','$descripcion','$usuario')");

 header('location: ../../views/inventario.php');