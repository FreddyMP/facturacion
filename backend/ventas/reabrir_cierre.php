<?php

    include('../control/cone.php');
    session_start();

    $id = $_GET["id"];

    
   $cierre_dia = $conexion->query("UPDATE cuadres set  estado = 'Abierto' where id = $id");
   
   header("location:../../views/cuadres.php");
 ?>