<?php
require('../pdf/fpdf.php');

$factura = $_GET['factura'];
class PDF extends FPDF
{
// Page header
function Header()
{
    include('../backend/control/cone.php');
//Consulta para formar la cabecera
    $factura = $_GET['factura'];
    $consulta_db = "SELECT vc.numero_factura as numero_factura, DATE_FORMAT(vc.fecha_creacion,'%Y-%m-%d') as fecha, ADDDATE(DATE_FORMAT(vc.fecha_creacion,'%Y/%m/%d'), INTERVAL 1 YEAR) as fecha_vencimiento, vc.comprobante as comprobante, vc.condicion_pago as condicion, vc.forma_pago as forma, p.nombre as nombre, vc.codigo_detalles as code_d
    from venta_cabecera vc 
    inner join pacientes p on p.id = vc.cliente  
    where vc.numero_factura = '$factura' ";
    $query_cabecera =  $conexion->query($consulta_db);
    $resultados_cabecera = $query_cabecera->fetch_assoc();

    
    // Logo
    $this->Image('../img/logo.png',10,6,60);
    // Arial bold 15
    $this->SetFont('Arial','',10);
    // Move to the right
    $this->Cell(20);
    $this->Ln(5);
    
    $this->Cell(20,25,utf8_decode('Fáctura'),0,0,'C');
    $this->Cell(73,25,': '.$resultados_cabecera["numero_factura"],0,0,'C');
    $this->Cell(54,25,utf8_decode('Fecha'),0,0,'C');
    $this->Cell(36,25,': '.$resultados_cabecera["fecha"],0,0,'C');
  
    $this->Ln(5);
    $this->Cell(19,25,utf8_decode('Cliente'),0,0,'C');
    $this->Cell(57,25,utf8_decode(': '.$resultados_cabecera["nombre"]),0,0,'C');
    $this->Cell(109,25,'Fecha Vencimiento',0,0,'C');
    $this->Cell(-40,25,': '.$resultados_cabecera["fecha_vencimiento"],0,0,'C');

    $this->Ln(5);
    $this->Cell(29,25,utf8_decode('Comprobante'),0,0,'C');
    $this->Cell(53,25,utf8_decode(': '.$resultados_cabecera["comprobante"]),0,0,'C');
    $this->Cell(90,25,utf8_decode('Forma de pago'),0,0,'C');
    $this->Cell(-20,25, utf8_decode(': '.$resultados_cabecera["forma"]),0,0,'C');

    $this->Ln(5);
    $this->Cell(37,25,utf8_decode('Condición de pago'),0,0,'C');
    $this->Cell(32,25,utf8_decode(': '.$resultados_cabecera["condicion"]),0,0,'C');
    $this->Cell(100,25,utf8_decode('RNC'),0,0,'C');
    $this->Cell(1,25, utf8_decode(': ED0026565W65'),0,0,'C');
    $this->Ln(17);
    $this->Cell(190,10,utf8_decode('Cod. Produc         Nombre                                           Cant.            Itbis                 Precio                Precio total'),1,0,'L');
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
include('../backend/control/cone.php');

$factura = $_GET['factura'];
$consulta_db = "SELECT vc.itbis as full, vd.id_articulo as code_a, vd.articulo as nombre, vd.cantidad as cantidad, vd.itbis as itbis, vd.precio_sin_itbis as precio, vd.precio_con_itbis as precio_full from venta_cabecera vc 
inner join venta_detalle vd on vd.codigo = vc.codigo_detalles 
where vc.numero_factura = '$factura' ";
$query_detalle =  $conexion->query($consulta_db);




$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',11);
$pdf->LN(12);
while($row = $resultados_detalle = $query_detalle->fetch_assoc()){
    $pdf->Cell(28,15,'     '.$row['code_a'],0,0,'c');
    $pdf->Cell(58,14,$row['nombre'],0,0,'c');
    $pdf->Cell(15,14,$row['cantidad'],0,0,'c');
    $pdf->Cell(25,14,'$RD '.$row['itbis'],0,0,'c');
    $pdf->Cell(26,14,'$RD '.$row['precio'],0,0,'c');
    $pdf->Cell(25,14,'$RD '.$row['precio_full'],0,0,'c');
    $pdf->LN(5);
}


$factura = $_GET['factura'];
$consulta_db = "SELECT vc.itbis as itbis_full, vc.neto as neto_full, vc.bruto as bruto_full from venta_cabecera vc
where vc.numero_factura = '$factura' ";
$query_cabecera =  $conexion->query($consulta_db);
$resultados_cabecera = $query_cabecera->fetch_assoc();

$pdf->LN(10);
$pdf->Cell(150,15,'ITBIS TOTAL:',0,0,'R');
$pdf->Cell(28,15,'$RD '.$resultados_cabecera['itbis_full'],0,0,'L');
$pdf->LN(5);
$pdf->Cell(140,15,'BRUTO:',0,0,'R');
$pdf->Cell(29,15,'$RD '.$resultados_cabecera['bruto_full'],0,0,'R');
$pdf->LN(5);
$pdf->Cell(137,15,'NETO:',0,0,'R');
$pdf->Cell(34,15,'$RD '.$resultados_cabecera['neto_full'],0,0,'R');
$pdf->Output();

?>