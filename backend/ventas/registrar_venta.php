<?php
  include('../control/cone.php');

  session_start();
  $usuario = $_SESSION["usuario_logueado"];

  $detalle = $_POST["codigo"];
  $cliente = $_POST["cliente"];
  $forma_pago = $_POST["forma"];
  $condicion_pago = $_POST["condicion"];

  $consulta_detalle ="SELECT SUM(total_itbis) as itbis,SUM(total_sin_itbis) as bruto, SUM(total_con_itbis) as neto from venta_detalle where codigo = '$detalle'";
  $query_detalle = $conexion->query($consulta_detalle);
  $resultado_detalle= $query_detalle->fetch_assoc();

  $itbis = $resultado_detalle["itbis"];
  $bruto = $resultado_detalle["bruto"];
  $neto = $resultado_detalle["neto"];

  $conexion->query("INSERT INTO venta_cabecera (codigo_detalles, cliente, forma_pago, condicion_pago, neto, bruto,itbis, descuentos, creado_por)
   values ('$detalle',$cliente,'$forma_pago','$condicion_pago',$neto,$bruto, $itbis,0, '$usuario')");
  
 header("location:../../views/punto_de_facturacion.php");


?>