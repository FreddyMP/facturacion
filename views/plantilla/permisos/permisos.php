<?php
    $rol = $_SESSION["rol"];
    $consulta_rol = "SELECT  * FROM roles_y_permisos where id = $rol and borrado_por is null and fecha_borrado is null";
    $query_rol = $conexion->query($consulta_rol); 
    $resultado_rol = $query_rol->fetch_assoc();
?>