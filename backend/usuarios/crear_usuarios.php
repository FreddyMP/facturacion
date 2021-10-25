<?php
 echo $nombre = $_POST["nombre"];
 echo $user = $_POST["user"];
 echo $pass=$_POST["contrasena"];
 $rol = $_POST["rol"];


include('../control/cone.php');
$usuario = $_SESSION["usuario_logueado"];

$conexion->query("INSERT INTO usuarios (nombre, user, contrasena, rol, creado_por)
 values ('$nombre','$user','$pass','$rol','$usuario')");

 header('location: ../../views/lista_usuarios.php');
 ?>