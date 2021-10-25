<?php
include('../control/cone.php');
 session_start();
 $usuario = $_SESSION["usuario_logueado"];

 $nombre = $_POST["nombre"];
 $codigo = $_POST["codigo"];
 $proximo = $_POST["proximo"];
 $limite = $_POST["limite"];
 
 $conexion->query("INSERT INTO tipos_comprobantes (nombre, codigo, proximo, limite, creado_por) values ('$nombre','$codigo',$proximo,$limite,'$usuario')");
  
 header("location:../../views/crear_comprobante.php");

    

 

 //

?>