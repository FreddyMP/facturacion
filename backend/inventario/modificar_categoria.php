<?php
include('../control/cone.php');
session_start();
echo $usuario = $_SESSION["usuario_logueado"];
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

$conexion->query("UPDATE categorias set nombre = '$nombre', descripcion = '$descripcion', fecha_modificacion = now(), modificado_por = '$usuario' where id = $id");

header("location:../../views/ver_categoria.php?id=$id");
?>