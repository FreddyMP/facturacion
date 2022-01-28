<?php
/*
**CREADO POR: Ivan M Garcia
**FECHA:17-03-2020
**MODULO: Abonos 
**COMANDO: formarXMLNotaC
**PROYECTO: Mercasid
**VERSION PHP: 5.2
*/

$UserId = $_POST['userId'];

if($_POST['key']!='') {
    $key=explode(',', $_POST['key']);
}else {
    $key=explode(',', storedKey());
}

//$key = explode(",",$_POST['key']);
$OrderNum = $key[0];
$CodeS = $_POST['info_Code_Sales_Org'];
$date = date("d.m.y");
$dateHr = date("H:i:s");

$xml_signature_dir_result = getFromSQL("select Description from core_dictionary where code='xmlsignature'");

$XML_Signature_PathDir = $xml_signature_dir_result[0]["DESCRIPTION"];
 writeCustomLog("El directorio de XML traido de la db ".$XML_Signature_PathDir);

if($XML_Signature_PathDir == null || $XML_Signature_PathDir == '') {
    $XML_Signature_PathDir = "C:\telynet\XMLSigner";
}

if(!file_exists($XML_Signature_PathDir)) {
    writeCustomLog("El directorio de XML ".$XML_Signature_PathDir." No existe");
}

$XML_Signature_PathDir = str_replace('/','\\',$XML_Signature_PathDir);

$NCF_Alt = getFromSQL("SELECT NFC_Linked,NFC, Num_Invoice FROM prj_collections_pending WHERE Num_Invoice=$OrderNum");

$Date_D = getFromSQL("SELECT CONVERT(VARCHAR, CONVERT(DATE, Date_Doc, 102), 105)  AS Date_Doc FROM collections_pending WHERE Num_Invoice=$OrderNum");

$Linked = $NCF_Alt[0]['NFC_LINKED'];
$Order_O = explode(",",$Linked);
$NCF_O = $NCF_Alt[0]['NFC'];
$Date_Doc =  $Date_D[0]['DATE_DOC'];

$Order_F  = $Order_O[0];

writeCustomLog("NCF del Doc. Referencia: " .$Order_F);

writeCustomLog("NCF de NC: " .$NCF_O);

$NCF_Alt2 = getFromSQL("SELECT NFC,SUBSTRING(NFC,1,1) as Letra, Num_Invoice FROM prj_collections_pending WHERE Num_Invoice=$OrderNum");

$NCF_F = $NCF_Alt2[0]['NFC'];

$Letra = $NCF_Alt2[0]['LETRA'];

if($Letra =='E')
{

//SACAR XML QUE VIENE DEL MOVIL

$sqlCabecera = "SELECT DISTINCT poh.Net_Amount as importeTotal,
poh.Platform as Platform,
poh.Notes_3 as NCF,
isnull(cast(poh.Xml_Signature1 AS VARCHAR(MAX)), '') as Xml_Signature1,
isnull(cast(poh.Xml_Signature2 AS VARCHAR(MAX)), '') as Xml_Signature2,
isnull(cast(poh.Xml_Signature3 AS VARCHAR(MAX)), '') as Xml_Signature3,
--CONVERT(VARCHAR,CONVERT(DATE,poh.Date_Expired), 105) as DateExpired,
--CONVERT(VARCHAR,CONVERT(DATE,poh.Date_Fiscal), 105) as Date_Fiscal,
poh.xml_generate AS Xml_Generate,
pao.Code_Segment,
SUBSTRING(poh.Notes_3,1,1) AS Tipo_Comprobante
FROM prj_orders_header poh
    LEFT JOIN sales_organization so
    ON poh.Code_Sales_Org = so.Code 
    LEFT JOIN accounts a
    ON poh.Code_Account = a.Code
    LEFT JOIN prj_accounts pa
    ON poh.Code_Account = pa.Code
    LEFT JOIN sellers s
    ON poh.Code_Seller = s.Code
    LEFT JOIN sellers sel
    ON poh.Code_Seller_Del = sel.Code
    LEFT JOIN route_sellers rs
    ON s.Code = rs.Code_Seller
    LEFT JOIN route_accounts ra
    ON ra.Code_Route = rs.Code_Route
    LEFT JOIN prj_payment_terms ppt
    ON poh.Code_Paymentway  = ppt.Code
    LEFT JOIN prj_configuration pc
    ON pc.Code_Unit_Org = poh.Code_Unit_Org
    AND pc.Code_Sales_Org = poh.Code_Sales_Org
    LEFT JOIN prj_accounts_organization pao
    ON pao.Code_Account = a.Code
    LEFT JOIN prj_des_array pda
    ON pda.Code = pao.Code_Segment
    AND pda.Type = '111'
    inner join PRJ_ORDERS_TYPE pot
        on poh.Order_type = pot.Code
WHERE poh.Delete_Date is NULL
    AND so.Delete_Date is NULL
    AND a.Delete_Date is NULL
AND poh.Notes_3 IS NOT NULL AND poh.Platform<>4 AND poh.Order_Num='".$OrderNum."'
    ";
$cabeceraPedido2 = getFromSQL($sqlCabecera);

writeCustomLog("Numero de pedido: " .$OrderNum);

$Plat = $cabeceraPedido2[0]['PLATFORM'];
$TipoC = $cabeceraPedido2[0]['TIPO_COMPROBANTE'];
$eNCF = $cabeceraPedido2[0]['NCF'];
$Code_Segment = $cabeceraPedido2[0]['CODE_SEGMENT'];
//Si el XML es del Movil y necesitan generarlo manualmente
if($Plat==4 && $TipoC =='E')
{
    for($i = 0; $i < count($cabeceraPedido2); $i++){
        $Plat = $cabeceraPedido2[$i]['PLATFORM'];
        $XML1 = $cabeceraPedido2[$i]['XML_SIGNATURE1'];
        $XML2 = $cabeceraPedido2[$i]['XML_SIGNATURE2'];
        $XML3 = $cabeceraPedido2[$i]['XML_SIGNATURE3'];
        $eNCF = $cabeceraPedido2[$i]['NCF'];
        $xGener = $cabeceraPedido2[$i]['XML_GENERATE'];
        $TipoC = $cabeceraPedido2[$i]['TIPO_COMPROBANTE'];
    
        if($XML3 != '')
        {
            $XML = $XML1.$XML2.$XML3;
        }
        else
        {
            $XML = $XML1.$XML2;
        }
        //Verificar que cumpla las condiciones para formar el XML
        if($Plat==4 && $TipoC =='E' && $xGener !=1 && ($XML != ''))
        {
                //Creamos el nombre del fichero, con 
                // $fichero = 'C:\telynet\XMLSigner\tmp\in_'.$eNCF.'.xml';
                $fichero = $XML_Signature_PathDir.'\tmp\in_'.$eNCF.'.xml';
                //Validamos si el campo XML_SIGNATURE3 contiene datos
                //$XML = $XML1.$XML2.$XML3;
               
    
                $file = file_put_contents($fichero, $XML);
    
                $sql = "UPDATE prj_orders_header SET xml_generate=1 WHERE Note_3='" . $eNCF . "' AND  xml_generate<>1 AND Xml_Signature1 IS NOT NULL";
                updateSQL($sql);
    
        }
    
    }
}

/////////////////////////////////////////////////////////////

//SACAR XML GENERADO DESDE HYDRA
$sqlCabeceraH = 
"SELECT DISTINCT  
odh.Platform,       
odh.Order_Num,
odh.Order_Num_ofClient as Num_Invoice,
-------------------------
--IdDoc--
-------------------------
ao.Code_Segment  AS 'TipoeCF',
RTRIM(odh.Notes_3) AS 'eNCF',
CONVERT(VARCHAR, CONVERT(DATE, odh.Date_Fiscal, 102), 105) AS 'FechaVencimientoSecuencia',
 '0' AS 'IndicadorMontoGravado',
 (CASE WHEN DATEDIFF(day, odh.Order_Date, GETDATE()) > 30 THEN 1   ELSE 0 END) AS 'IndicadorNotaCredito',--Si la fecha de emisión de la NC es igual o menor a 30 días de haberse generado la factura, entonces el indicador nota de crédito debe ser 0 si es mayor 1
 '01' AS 'TipoIngresos',
 (CASE WHEN ppt.Credit = '0' THEN '2' ELSE '1' END)   AS 'TipoPago',
 (CASE WHEN ppt.Credit = '1' THEN CONVERT(VARCHAR, CONVERT(DATE, odh.Delivery_Date, 102), 105)   --CONVERT(VARCHAR, CONVERT(DATE, col.Date_End, 102), 105) 
 ELSE  
 CONVERT(VARCHAR, CONVERT(DATE, puf.date_end, 102), 105) END) AS 'FechaLimitePago',
 -------------------------
 --Emisor--
 -------------------------

 REPLACE(RTRIM(pvd.NIF),'-','') AS 'RNCEmisor',
 RTRIM(pvd.Name1) AS 'RazonSocialEmisor',
 RTRIM(pvd.Address1) AS 'DireccionEmisor',
 CONVERT(VARCHAR, CONVERT(DATE, odh.Order_Date , 102), 105)  AS 'FechaEmision',
 CONVERT(VARCHAR, CONVERT(DATE, cp.Date_Doc, 102), 105)  'FechaEmicionNCFModificado',
 SUBSTRING(odh.delivery_date,1,4) AS 'AnoEmision',

 -------------------------
 --Comprador--
 -------------------------
 RTRIM(acc.NIF) AS 'RNCComprador',           
 RTRIM(acc.Name1) AS 'RazonSocialComprador',

 -------------------------
 --Totales--
 -------------------------
 0.00 AS  'MontoGravadoTotal',
 0.00 AS 'MontoGravadoI1',
 0.00 AS 'MontoGravadoI2',
 '0.00' AS 'MontoGravadoI3',
 SUM(CAST(CASE WHEN tax.Value = 0 THEN odl.Net_Amount ELSE 0.00 END AS DECIMAL(18,2))) AS  'MontoExento',
 '18' AS 'ITBIS1',
 '16' AS 'ITBIS2',
 '0'  AS 'ITBIS3',
 0.00 AS 'TotalITBIS', 
 0.00 AS 'MontoGravadoI1',
 0.00 AS 'MontoGravadoI2',
 '0' AS 'MontoGravadoI3',
 SUM(CONVERT(DECIMAL(18,2),odl.Total_Amount)) AS 'MontoTotal'

 -------------------------
 --Otros Interno--
 -------------------------
 ,ao.Code_Segment
,odh.Order_Date
FROM prj_Orders_Header odh
 left join collections_pending cp ON odh.Order_Num = cp.Num_Invoice
 left JOIN dbo.Accounts acc ON (acc.Code = odh.Code_Account)
 left JOIN prj_accounts_organization ao ON CONVERT(VARCHAR,odh.Code_Account)=CONVERT(VARCHAR,ao.Code_Account) AND ao.Delete_Date IS NULL
 left JOIN dbo.prj_accounts pac ON (pac.Code = acc.Code)
 left JOIN dbo.Warehouses wrh ON (pac.Code_Warehouse = wrh.Code)
 left JOIN dbo.prj_payment_terms ppt ON (ppt.code = odh.Code_Paymentway) AND ppt.Delete_Date IS NULL AND odh.Code_Sales_Org=ppt.Code_Sales_Org
 --INNER JOIN dbo.collections_pending col on (CONVERT(VARCHAR,ODH.Order_Num) = col.Num_Invoice)
 --left JOIN dbo.prj_Users_Fiscal  puf   ON (puf.Code_User COLLATE DATABASE_DEFAULT = odh.Code_Seller_Del AND puf.Delete_Date IS NULL and puf.date_end IS NOT NULL)
 left JOIN dbo.Providers pvd on (pvd.Code_ofClient = wrh.Code_ofClient)
 left JOIN prj_providers ppvd ON pvd.Code=ppvd.Code
 left JOIN prj_users_fiscal puf ON ppvd.Code_User=puf.Code_User AND SUBSTRING(odh.Notes_3,1,3)=puf.Base
 left JOIN prj_orders_lines odl ON (odl.Order_Num = odh.Order_Num)
 left JOIN dbo.products pro ON (pro.Code = odl.Code_Product)
 --INNER JOIN dbo.prj_Products_Tax ptx ON (ptx.Code_Product = pro.Code)
 left JOIN dbo.prj_orders_secuences tax ON tax.TYpe = 'T' and odl.Order_Num = tax.Order_Num and odl.Num_Line = tax.Num_Line
WHERE 
odh.Order_Num =$Order_F AND odh.Delete_Date IS NULL --AND puf.date_end IS NOT NULL
GROUP BY    
odh.Order_Num, 
puf.date_end,
odh.Order_Num_ofClient,
ao.Code_Segment , 
odh.Notes_3 , --puf.date_end, 
ppt.Credit,
odh.Platform, 
odh.Order_Date,
cp.Date_Doc,
odh.Date_Fiscal,
pvd.NIF, pvd.Name1, pvd.Address1, odh.Delivery_Date, acc.NIF, acc.Name1";
$cabeceraPedidoH = getFromSQL($sqlCabeceraH);


//------------SUSTITUCION------

//query para obtener el MontoGravadoTotal
// $Magr = getFromSQL("select isnull(sum(CONVERT(DECIMAL(18,2),o.Net_Amount)),0.00) as Monto from prj_orders_lines o where o.Quantity > 0.0 and Order_Num=".$OrderNum);

// $MontoGravadoTotalF = $Magr[0]['MONTO'];
$MontoGravadoTotalF = '0.00';

// //--Query para obtener el MontoGravadoI1

$MontoGravadoI1F = '0.00';

// $MontoGravadoI2F =  $Magr2[0]['MONTO'];
$MontoGravadoI2F =  '0.00';

// $MontoExentoF =  $MontoEx[0]['MONTO'];
$MontoEx =getFromSQL('SELECT isnull(sum(CONVERT(DECIMAL(18,2), Total_Amount * -1)),0.00)  as Monto FROM collections_pending WHERE Num_Invoice = '.$OrderNum);

$MontoExentoF =  $MontoEx[0]['MONTO'];
$MontoTotalF =  $MontoEx[0]['MONTO'];

// $TotalITBIS1F =  $TItbis1[0]['MONTO'];
$TotalITBIS1F =  '0.00';

// //--Query para obtener el TotalITBIS2
$TotalITBIS2F =  '0.00';

//------SUSTITUCION----FIN-

$Detalle = "SELECT
convert(varchar, getdate(), 105)+' '+convert(varchar, getdate(), 108) as FechaHoraFirma,
ROW_NUMBER() OVER(ORDER BY cp.Num_Invoice ASC) AS 'NumeroLinea',
'4' AS 'IndicadorFacturacion',
ISNULL(cp.Observations, 'Nota de Credito Fiscal') AS 'NombreItem',
'1' AS 'IndicadorBienoServicio',
'1.00' AS 'CantidadItem',
CONVERT(DECIMAL(18,2),cp.Total_Amount * -1) AS 'PrecioUnitarioItem',
'0.00' AS 'DescuentoMonto',
'<SubDescuento><TipoSubDescuento>$</TipoSubDescuento><MontoSubDescuento>0.00</MontoSubDescuento></SubDescuento>' AS 'TablaSubDescuento',
'X' AS 'OtraMonedaDetalle',
CONVERT(DECIMAL(18,2),cp.Total_Amount* -1) AS 'MontoItem'
FROM collections_pending cp
WHERE cp.[Num_Invoice] =" . $OrderNum;
writeCustomLog("El query detalle es: " . $Detalle);
$DetalleSQL = getFromSQL($Detalle);

//Query que saca los ITBIS
$Itbis = "select distinct CAST(CASE WHEN s.Value = '18' THEN sum(o.Taxes_Amount) ELSE '0.00' END AS DECIMAL(18,2)) AS TotalITBIS1,CAST(CASE WHEN s.Value = '16' THEN sum(o.Taxes_Amount) ELSE '0.00' END  AS DECIMAL(18,2)) AS TotalITBIS2
,'0.00' AS TotalITBIS3
from prj_orders_lines o
inner join prj_orders_secuences s on s.Order_Num = o.Order_Num and s.Num_Line = o.Num_Line 
where s.Type = 'T'  and o.Order_Num = $Order_F 
group by s.Value";
$ItbisSql = getFromSQL($Itbis);
writeCustomLog("Detalle: " . print_r($Detalle, true));


//DATOS PARA HYDRA
$TipoeCF = $cabeceraPedidoH[0]['TIPOECF'];
$OrderDate = $cabeceraPedidoH[0]['ORDER_DATE'];
$eNCF = $cabeceraPedidoH[0]['ENCF'];
$FechaVenSec = $cabeceraPedidoH[0]['FECHAVENCIMIENTOSECUENCIA'];
$IndicadorMontoGrv = $cabeceraPedidoH[0]['INDICADORMONTOGRAVADO'];
$IndicadorNotaCredito = $cabeceraPedidoH[0]['INDICADORNOTACREDITO'];
$TipoIngreso = $cabeceraPedidoH[0]['TIPOINGRESOS'];
$TipoPago = $cabeceraPedidoH[0]['TIPOPAGO'];
$FechaLimitePago = $cabeceraPedidoH[0]['FECHALIMITEPAGO'];
$RNCEmisor = $cabeceraPedidoH[0]['RNCEMISOR'];
$RazonSocialEmisor = $cabeceraPedidoH[0]['RAZONSOCIALEMISOR'];
$DireccionEmisor = $cabeceraPedidoH[0]['DIRECCIONEMISOR'];
$FechaEmision = $cabeceraPedidoH[0]['FECHAEMISION'];
$FechaEmicionNCFModificado = $cabeceraPedidoH[0]['FECHAEMICIONNCFMODIFICADO'];
$RNCComprador = $cabeceraPedidoH[0]['RNCCOMPRADOR'];
$RazonSocialComprador = $cabeceraPedidoH[0]['RAZONSOCIALCOMPRADOR'];
$MontoGravadoTotal = $cabeceraPedidoH[0]['MONTOGRAVADOTOTAL'];
$MontoGravadoI1 = $cabeceraPedidoH[0]['MONTOGRAVADOI1'];
$MontoGravadoI2 = $cabeceraPedidoH[0]['MONTOGRAVADOI2'];
$MontoGravadoI3 = $cabeceraPedidoH[0]['MONTOGRAVADOI3'];
$MontoExento = $cabeceraPedidoH[0]['MONTOEXENTO'];
$TotalITBIS = $cabeceraPedidoH[0]['TOTALITBIS'];


if($FechaEmicionNCFModificado == null || $FechaEmicionNCFModificado == "") {
$FechaEmicionNCFModificado = $FechaEmision;
}

$MontoTotal = $cabeceraPedidoH[0]['MONTOTOTAL'];
$NumeroLinea = $DetalleSQL[0]['NUMEROLINEA'];
$IndicadorFacturacion = $DetalleSQL[0]['INDICADORFACTURACION'];
$NombreItem = $DetalleSQL[0]['NOMBREITEM'];
$IndicadorBienoServicio = $DetalleSQL[0]['INDICADORBIENOSERVICIO'];
$CantidadItem = $DetalleSQL[0]['CANTIDADITEM'];
$PrecioUnitarioItem = $DetalleSQL[0]['PRECIOUNITARIOITEM'];
$DescuentoMonto = $DetalleSQL[0]['DESCUENTOMONTO'];
$TablaSubDescuento = $DetalleSQL[0]['TABLASUBDESCUENTO'];
$OtraMonedaDetalle = $DetalleSQL[0]['OTRAMONEDADETALLE'];
$MontoItem = $DetalleSQL[0]['MONTOITEM'];
$FechaHoraFirma = $DetalleSQL[0]['FECHAHORAFIRMA'];



//ALTERNATIVA XML ------------------------------------------
$xml = new DOMDocument("1.0","UTF-8");
//$xml->loadXML($filename);
$xml->preserveWhiteSpace = true;
$xml->formatOutput = true;

/*
$xmlElement = $xml->createElement('xml');
$xmlElement->setAttribute('version', '1.0');
$xmlElement->setAttribute('encoding', 'UTF-8');
*/
$ECFElement = $xml->createElement('ECF');

writeCustomLog("Probar XML: " . print_r($xml, true));

$EncabezadoElement = $xml->createElement('Encabezado');

$VersionElement = $xml->createElement('Version', '1.0');
$EncabezadoElement->appendChild($VersionElement);

$IdDocElement = $xml->createElement('IdDoc');
$EncabezadoElement->appendChild($IdDocElement);

$TipoeCFElement = $xml->createElement('TipoeCF', '34');
$IdDocElement->appendChild($TipoeCFElement);

$eNCFElement = $xml->createElement('eNCF',$NCF_O);
$IdDocElement->appendChild($eNCFElement);

//$FechaVencimientoSecuenciaElement = $xml->createElement('FechaVencimientoSecuencia', $FechaVenSec);

// $IndicadorNotaCreditoElement = $xml->createElement('IndicadorNotaCredito', '0');
// $IdDocElement->appendChild($IndicadorNotaCreditoElement);

$IndicadorNotaCreditoElement = $xml->createElement('IndicadorNotaCredito', $IndicadorNotaCredito);
$IdDocElement->appendChild($IndicadorNotaCreditoElement);

/*
$FechaVencimientoSecuenciaElement = $xml->createElement('FechaVencimientoSecuencia', '31-12-2020');
$IdDocElement->appendChild($FechaVencimientoSecuenciaElement);
*/
$IndicadorMontoGravadoElement = $xml->createElement('IndicadorMontoGravado', $IndicadorMontoGrv);
$IdDocElement->appendChild($IndicadorMontoGravadoElement);

$TipoIngresosElement = $xml->createElement('TipoIngresos', $TipoIngreso);
$IdDocElement->appendChild($TipoIngresosElement);

$TipoPagoElement = $xml->createElement('TipoPago', $TipoPago);
$IdDocElement->appendChild($TipoPagoElement);

// $FechaLimitePagoElement = $xml->createElement('FechaLimitePago', $FechaLimitePago);
// $IdDocElement->appendChild($FechaLimitePagoElement);
$FechaLimitePagoElement = $xml->createElement('FechaLimitePago', $Date_Doc);
$IdDocElement->appendChild($FechaLimitePagoElement);

$EmisorElement = $xml->createElement('Emisor');
$EncabezadoElement->appendChild($EmisorElement);

$RNCEmisorElement = $xml->createElement('RNCEmisor', $RNCEmisor);
$EmisorElement->appendChild($RNCEmisorElement);

$RazonSocialEmisorElement = $xml->createElement('RazonSocialEmisor', $RazonSocialEmisor);
$EmisorElement->appendChild($RazonSocialEmisorElement);

$DireccionEmisorElement = $xml->createElement('DireccionEmisor', $DireccionEmisor);
$EmisorElement->appendChild($DireccionEmisorElement);

$FechaEmisionElement = $xml->createElement('FechaEmision', $Date_Doc);
$EmisorElement->appendChild($FechaEmisionElement);

$CompradorElement = $xml->createElement('Comprador');
$EncabezadoElement->appendChild($CompradorElement);

$RNCCompradorElement = $xml->createElement('RNCComprador', $RNCComprador);
$CompradorElement->appendChild($RNCCompradorElement);

$RazonSocialCompradorElement = $xml->createElement('RazonSocialComprador', $RazonSocialComprador);
$CompradorElement->appendChild($RazonSocialCompradorElement);

$TotalesElement = $xml->createElement('Totales');
$EncabezadoElement->appendChild($TotalesElement);

$MontoGravadoTotalElement = $xml->createElement('MontoGravadoTotal', $MontoGravadoTotalF);
$TotalesElement->appendChild($MontoGravadoTotalElement);

$MontoGravadoI1Element = $xml->createElement('MontoGravadoI1', $MontoGravadoI1F);
$TotalesElement->appendChild($MontoGravadoI1Element);

$MontoGravadoI2Element = $xml->createElement('MontoGravadoI2', $MontoGravadoI2F);
$TotalesElement->appendChild($MontoGravadoI2Element);

$MontoGravadoI3Element = $xml->createElement('MontoGravadoI3', $MontoGravadoI3);
$TotalesElement->appendChild($MontoGravadoI3Element);

$MontoExentoElement = $xml->createElement('MontoExento', $MontoExentoF);
$TotalesElement->appendChild($MontoExentoElement);

$ITBIS1Element = $xml->createElement('ITBIS1', '18');
$TotalesElement->appendChild($ITBIS1Element);

$ITBIS2Element = $xml->createElement('ITBIS2', '16');
$TotalesElement->appendChild($ITBIS2Element);

$ITBIS3Element = $xml->createElement('ITBIS3', '0');
$TotalesElement->appendChild($ITBIS3Element);

$TotalITBISElement = $xml->createElement('TotalITBIS', $TotalITBIS);
$TotalesElement->appendChild($TotalITBISElement);

$TotalITBIS1Element = $xml->createElement('TotalITBIS1', '0.00');
$TotalesElement->appendChild($TotalITBIS1Element);

$TotalITBIS2Element = $xml->createElement('TotalITBIS2', '0.00');
$TotalesElement->appendChild($TotalITBIS2Element);

$TotalITBIS3Element = $xml->createElement('TotalITBIS3', '0.00');
$TotalesElement->appendChild($TotalITBIS3Element);

$MontoTotalElement = $xml->createElement('MontoTotal', $MontoTotalF);
$TotalesElement->appendChild($MontoTotalElement);

$DetallesItemsElement = $xml->createElement('DetallesItems');


//INICIO DE FOREACH
foreach ($DetalleSQL as $row) 
{
//writeCustomLog('Esto es El Foreach: ', print_r($ItemElement,true));
$ItemElement = $xml->createElement('Item');

//writeCustomLog('Esto es El NumeroLineaElement: ', print_r($NumeroLineaElement,true));
$NumeroLineaElement = $xml->createElement('NumeroLinea', $row['NUMEROLINEA']);
$ItemElement->appendChild($NumeroLineaElement);

//writeCustomLog('Esto es El IndicadorFacturacionElement: ', print_r($IndicadorFacturacionElement,true));
$IndicadorFacturacionElement = $xml->createElement('IndicadorFacturacion', $row['INDICADORFACTURACION']);
$ItemElement->appendChild($IndicadorFacturacionElement);

//writeCustomLog('Esto es El NombreItemElement: ', print_r($NombreItemElement,true));
$NombreItemElement = $xml->createElement('NombreItem', $row['NOMBREITEM']);
$ItemElement->appendChild($NombreItemElement);

$IndicadorBienoServicioElement = $xml->createElement('IndicadorBienoServicio', $row['INDICADORBIENOSERVICIO']);
$ItemElement->appendChild($IndicadorBienoServicioElement);

$CantidadItemElement = $xml->createElement('CantidadItem', $row['CANTIDADITEM']);
$ItemElement->appendChild($CantidadItemElement);

$PrecioUnitarioItemElement = $xml->createElement('PrecioUnitarioItem', $row['PRECIOUNITARIOITEM']);
$ItemElement->appendChild($PrecioUnitarioItemElement);

$DescuentoMontoElement = $xml->createElement('DescuentoMonto', $row['DESCUENTOMONTO']);
$ItemElement->appendChild($DescuentoMontoElement);

$TablaSubDescuentoElement = $xml->createElement('TablaSubDescuento');
$ItemElement->appendChild($TablaSubDescuentoElement);

$SubDescuentoElement = $xml->createElement('SubDescuento');
$TablaSubDescuentoElement->appendChild($SubDescuentoElement);

$TipoSubDescuentoElement = $xml->createElement('TipoSubDescuento', '$');
$SubDescuentoElement->appendChild($TipoSubDescuentoElement);

$MontoSubDescuentoElement = $xml->createElement('MontoSubDescuento', $row['DESCUENTOMONTO']);
$SubDescuentoElement->appendChild($MontoSubDescuentoElement);

$OtraMonedaDetalleElement = $xml->createElement('OtraMonedaDetalle');
$ItemElement->appendChild($OtraMonedaDetalleElement);

$PrecioOtraMonedaElement = $xml->createElement('PrecioOtraMoneda', '0.00');
$OtraMonedaDetalleElement->appendChild($PrecioOtraMonedaElement);

$DescuentoOtraMonedaElement = $xml->createElement('DescuentoOtraMoneda', '0.00');
$OtraMonedaDetalleElement->appendChild($DescuentoOtraMonedaElement);

$MontoItemOtraMonedaElement = $xml->createElement('MontoItemOtraMoneda', '0.00');
$OtraMonedaDetalleElement->appendChild($MontoItemOtraMonedaElement);

$MontoItemElement = $xml->createElement('MontoItem', $row['MONTOITEM']);
$ItemElement->appendChild($MontoItemElement);

$DetallesItemsElement->appendChild($ItemElement);

}//FIN DE FOREACH

//$EncabezadoElement->appendChild($IdDocElement);
$ECFElement->appendChild($EncabezadoElement);
$ECFElement->appendChild($DetallesItemsElement);

//Informacion de documento de referencia de Nota de Credito
$InformacionReferenciaElement = $xml->createElement('InformacionReferencia');

$NCFModificadoElement = $xml->createElement('NCFModificado', $eNCF);
$InformacionReferenciaElement->appendChild($NCFModificadoElement);

$FechaNCFModificadoElement = $xml->createElement('FechaNCFModificado', $FechaEmicionNCFModificado);
$InformacionReferenciaElement->appendChild($FechaNCFModificadoElement);

$CodigoModificacionElement = $xml->createElement('CodigoModificacion', '3');
$InformacionReferenciaElement->appendChild($CodigoModificacionElement);

$ECFElement->appendChild($InformacionReferenciaElement);

$FechaHoraFirmaElement = $xml->createElement('FechaHoraFirma', $FechaHoraFirma);
writeCustomLog("Este es el FechaHoraFirmaElement: " . print_r($FechaHoraFirmaElement, true));
$ECFElement->appendChild($FechaHoraFirmaElement);


//ALTERNATIVA XML ----------------FIN--------------------------

$sql = getFromSQL("SELECT 
CONVERT(VARCHAR(MAX),Qr_signature_Key) as CertC,CONVERT(VARCHAR(MAX),Certificate_Key) as KeyC FROM prj_configuration_bk WHERE Code_Sales_Org='01'");

$certificate = $sql[0]['CERTC'];
$key = $sql[0]['KEYC'];

writeCustomLog('Trae Cert: '.$certificate);

//$decodeC = base64_decode($certificate);
//$decodek = base64_decode($key);

//$filename = $xml->outputMemory();
//$filename = $xml;
writeCustomLog("Este es el filename: " . print_r($filename, true));

$xml->appendChild($ECFElement);
$data = $xml->saveXML();

writeCustomLog("Verificar llenado xml: " . print_r($data, true));

$data = mb_convert_encoding($data, 'UTF-8', 'OLD-ENCODING'); 

writeCustomLog("Verificar encode-utf-8 xml: " . print_r($data, true));

$filename = $data;

writeCustomLog("FileName ver si esta: " . print_r($filename, true));


//Meter XML en un fichero
// $fichero = 'C:\telynet\XMLSigner\tmp\in_NC.xml';
$fichero = $XML_Signature_PathDir.'\tmp\in_NC.xml';
//$fichero = 'C:\tmp\in_'.$eNCF.'.xml';
$actual = file_get_contents($fichero);
$actual = $filename;
$archivo = file_put_contents($fichero, $actual);
//Meter XML en un fichero -FIN-

//Copiar en directorio el KEY
// $fichero = 'C:\telynet\XMLSigner\mercasid-privatekey2.key';
$fichero = $XML_Signature_PathDir.'mercasid-privatekey2.key';
$actual = $key;
$archivo = file_put_contents($fichero, $actual);

//Copiar en directorio el Certificado
// $ficheroCert = 'C:\telynet\XMLSigner\mercasid-cert.pem';
$ficheroCert = $XML_Signature_PathDir.'\mercasid-cert.pem';
$actualCert = $certificate;
$archivoCert = file_put_contents($ficheroCert, $actualCert);


//Ponemos la zona horaria de Santo Domingo
date_default_timezone_set('America/Santo_Domingo');
writeCustomLog("HORA ACTUAL SERVER: ".date('Y-m-d H:i:s'));
writeCustomLog("HORA EJECUCION WFM: ".date("Y-m-d H:i:s", time() + 20));

//Actualizamos el flujo que va a ejecutar el exe
$query = "update core_workflows_ask set Ask_Time = CONVERT(DATETIME,'".date("Y-m-d H:i:s", time() + 20)."') where id_workflow in (select id from core_workflows where description='firmarXMLNC')";
$result = updateSQL($query);

//writeCustomLog("Resultado: " . $resultado);
//Esperamos 30 segundos a que el flujo sea ejecutado
sleep(50);

// $fichero2 = 'C:\telynet\XMLSigner\tmp\out_NC.xml';

$fichero2 = $XML_Signature_PathDir.'\tmp\out_NC.xml';
$actual2 = file_get_contents($fichero2);

$contar = strlen($actual2);

writeCustomLog("Contador XML: " . $contar);
writeCustomLog("Trajo XML: " . $actual2);

$sqlM = getFromSQL("SELECT NFC_Linked,Xml_Signature1 FROM prj_collections_pending WHERE Num_Invoice = '".$OrderNum."'");

$Link = $sqlM[0]['NFC_LINKED'];
$Sing = $sqlM[0]['XML_SIGNATURE1'];


//INSERTAR DATOS EN LA TABLA DONDE SE GUARDAN LOS XML  Autor:Ivan M. Garcia Fecha: 14-04-2020
$ver = getFromSQL("Select Count(Num_Invoice) as num From prj_collections_xml Where Num_Invoice= '".$OrderNum."' ");

$Count = $ver[0]['NUM'];
writeCustomLog("Contador trajo: " . $Count);


if($Count<>1)
{
    $defOOl = getSqlSystemVars("insert");
    $query = "INSERT INTO prj_collections_xml (".$defOOl[0].",Num_Invoice,Code_Seller,Xml_Content,Num_Line) values(".$defOOl[1].",".$OrderNum.",".$UserId.",'".$actual2."',1)";
    $result = updateSQL($query);

    writeCustomLog("Veamos que que va a Insertar: " . $query);
}


sleep(10);
unlink($fichero);
unlink($fichero2);

}