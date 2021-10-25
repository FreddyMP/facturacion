<?php

    include('../backend/control/cone.php');

    $usuario = $_SESSION["usuario_logueado"];

    #todos los articulos activos
    $consulta_all = "SELECT * from articulos where status = 'Activo' and borrado_por != null and fecha_borrado != null";
    $query_all = $conexion->query($consulta_all);
   

 ?>