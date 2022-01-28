<?php
$encontrado = $_POST["inicio"];

include('../control/cone.php');
session_start();
$fecha = date("y/m/d");

$usuario = $_SESSION['usuario_logueado'];
echo $usuario;
$conexion->query("INSERT into cuadres (usuario_inicio, encontrado) values('$usuario' ,$encontrado)");

header("location:../../views/punto_de_facturacion.php?codigo=$codigo");

?>
