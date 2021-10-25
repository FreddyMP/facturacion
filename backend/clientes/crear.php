<?php
    

    $nombre = $_POST["nombre"] ;
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $celular = $_POST["celular"];
    $cedula = $_POST["cedula"];
    $record = $_POST["record"];
    $previa = $_POST["previa"];
    $proxima = $_POST["proxima"];
    $nota  = $_POST["notas"];

    include('../control/cone.php');
    session_start();
    $usuario = $_SESSION["usuario_logueado"];

    $consulta = "INSERT INTO pacientes (nombre, apellido, telefono, celular, cedula, numero_record, cita_previa, proxima_cita, creado_por, notas)
    values ('$nombre','$apellido','$telefono', '$celular', '$cedula', '$record', '$previa', '$proxima', '$usuario', '$nota')";

    $conexion->query($consulta);

    header("location:../../views/lista_de_clientes.php");


?>