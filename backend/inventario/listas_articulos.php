<?php

    include('../backend/control/cone.php');

    $usuario = $_SESSION["usuario_logueado"];

    #todos los articulos activos
    $consulta_all = "SELECT nombre, stock, existencia, id, cantidad_disponible,cantidad_en_movimiento, fcv from articulos where status = 'Activo' and borrado_por is null and fecha_borrado is null";
    $query_all = $conexion->query($consulta_all);
   

 ?>