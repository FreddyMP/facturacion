<?php
$id = $_GET['id'];
include('../control/cone.php');
session_start();
$fecha = date("y/m/d");
echo $fecha;
$usuario = $_SESSION['usuario_logueado'];

$consulta = "UPDATE articulos SET fecha_borrado= '$fecha', borrado_por = '$usuario' where id = $id";
$query= $conexion->query($consulta);    

header("location:../../views/inventario.php");

?>