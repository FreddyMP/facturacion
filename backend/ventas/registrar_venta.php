<?php
  include('../control/cone.php');

  session_start();
  $usuario = $_SESSION["usuario_logueado"];

  $detalle = $_POST["codigo"];
  $cliente = $_POST["cliente"];
  $forma_pago = $_POST["forma"];
  $condicion_pago = $_POST["condicion"];
  $tipo_comprobante = $_POST["comprobante"];

  $consulta_detalle ="SELECT SUM(total_itbis) as itbis,SUM(total_sin_itbis) as bruto, SUM(total_con_itbis) as neto from venta_detalle where codigo = '$detalle'";
  $query_detalle = $conexion->query($consulta_detalle);
  $resultado_detalle= $query_detalle->fetch_assoc();

  $itbis = $resultado_detalle["itbis"];
  $bruto = $resultado_detalle["bruto"];
  $neto = $resultado_detalle["neto"];

  /*Aquí consulto los tipos de comprobantes para armar el numero de comprobante perteneciente a la factura de la siguiente forma:
   el codigo del tipo de comprobante (Ej: b02), obtengo la longitud del proximo(Eje: 1 su longitud es de 1 a diferencia de 32 que su longitud serian 2), la cantidad de 0  por defecto es 8
   pero se quitara la cantidad de ceros en base a la longitud del proximo(Eje: El proximo es el 12, ceros = 000000  Eje2": El proximo es 125 ceros =  00000   Eje4: El proximo es 2540 ceros = 0000)

   Luego de obtener el codigo del comprobante, el proximo numero de comprobante, tener la cantidad de ceros que lleva se concatenan Codigo de comprobate + cantidad ceros + proximo 
   resultando eje: B020000052
  */
    $consulta_comprobante = "SELECT codigo, proximo, limite from tipos_comprobantes where id = $tipo_comprobante and borrado_por is null";
    $query_comprobante = $conexion->query($consulta_comprobante);
    $resultado_compobante = $query_comprobante->fetch_assoc();
    
   
    $longitud_proximo= strlen($resultado_compobante['proximo']);
    $ceros = substr("00000001", 0, -$longitud_proximo);
    $proximo = $resultado_compobante['proximo'];

    echo $comprobante = $resultado_compobante['codigo'].$ceros.$proximo;

    //---------------------------------------------------------------------------------------------------------------------------------------------------------

    $consulta_ultima_factura = "SELECT id from venta_cabecera order by id desc";
    $query_ultima_factura = $conexion->query($consulta_ultima_factura);
    $resultado_ultima_factura = $query_ultima_factura->fetch_assoc();

    $longitud_proxima_f= strlen($resultado_ultima_factura['id']);
    $ceros_factura = substr("00000001", 0, -$longitud_proxima_f);
    

    echo "<br>";
   $numero_de_factura = date("n").date("j").$ceros_factura.date("y").$resultado_ultima_factura['id'] + 1;

   $conexion->query("INSERT INTO venta_cabecera (codigo_detalles, numero_factura, cliente, forma_pago, condicion_pago, comprobante, neto, bruto,itbis, descuentos, creado_por)
   values ('$detalle', '$numero_de_factura', $cliente,'$forma_pago','$condicion_pago','$comprobante',$neto,$bruto, $itbis,0, '$usuario')");

    $conexion ->query("UPDATE tipos_comprobantes SET  proximo = proximo + 1 where id = $tipo_comprobante");

    //http://localhost/facturacion/views/factura.php?factura=1230000002130
 header("location:../../views/factura.php?factura=$numero_de_factura");

?>