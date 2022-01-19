<?php
    include("../control/cone.php");

    echo $nombre = $_POST["nombre"];
    echo $apellido = $_POST["apellido"];
    echo $nacionalidad = $_POST["hora_ingreso"];
    echo $fecha_ingreso = $_POST["fecha_ingreso"];
    echo $hora_ingreso = $_POST["hora_ingreso"];
    echo $genero = $_POST["genero"];
    echo $peso = $_POST["peso"];
    echo $altura = $_POST["altura"];
    echo $lugar_nacimiento = $_POST["lugar_nacimiento"];
    echo $lugar_vive = $_POST["lugar_vive"];
    echo $direccion =$_POST["direccion"];
    echo $responsable = $_POST["responsable"];
    echo $relacion = $_POST["relacion"];
    echo $tipo_sangre = $_POST["sangre"];
    echo $alergia = $_POST["alergias"];
    echo $origen = $_POST["origen"];
    echo $num_expediente = $_POST["num_expediente"];
    echo $nss  = $_POST["nss"];
    echo $seguro = $_POST["seguro"];
    echo $num_seguro = $_POST["num_seguro"];

    $consulta = "INSERT INTO registro_pacientes (nombres, apellidos, nacionalidad, fecha_ingreso, hora_ingreso, genero, peso, altura, lugar_nacimiento, lugar_vive, direccion, responsable, relacion, tipo_sangre, alergias, origen_admision, num_expediente, nss, seguro, num_seguro) VALUES 
    ('$nombre','$apellido','$nacionalidad', '$fecha_ingreso', '$hora_ingreso','$genero', $peso, $altura, '$lugar_nacimiento', '$lugar_vive', '$direccion', '$responsable', '$relacion', '$tipo_sangre', '$alergia', '$origen', '$num_expediente', '$nss', '$seguro', '$num_seguro')";
    
    
    $registrar =$conexion->query($consulta);


?>