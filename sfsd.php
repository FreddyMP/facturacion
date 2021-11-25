<?
launchExtension("funciones",$_POST['module']);

if($_POST['filter_Date_Ini']!='') $Date_Ini=$_POST['filter_Date_Ini'];
else if(getFilter('','Date_Ini')!='') $Date_Ini=getFilter('','Date_Ini');
else $Date_Ini='';

if($_POST['filter_Date_Fin']!='') $Date_Fin=$_POST['filter_Date_Fin'];
else if(getFilter('','Date_Fin')!='') $Date_Fin=getFilter('','Date_Fin');
else $Date_Fin='';

if($Date_Ini !=''){
$and_sql.="collections_received.Date_Doc >= ' ".$Date_Ini." ' ";
$and=" AND ";
}
if($Date_Fin !=''){
$and_sql.=$and."collections_received.Date_Doc <= ' ".$Date_Fin." '";
}
/*Comentado por Freddy 
    if($Date_Ini =='' && $Date_Fin ==''){
    $and_sql.=$and."collections_received.Date_Doc >=DATEADD(day, -2, GETDATE())  ";
     }
*/
if($and_sql !=''){
$and_sql.=" collections_received.Canceled<>'1'   ";
} else {
$and_sql.=" collections_received.Canceled<>'1' ";
}
putParamView("customAndSQL",$and_sql);


if($_POST['paramUser1']=="nuevo"){ // relleno por la funcion js
//construccion de los campos a visualizar (los parametros name enganchan con los resultados de la consulta)
$fs=array();
array_push($fs,array("name"=>"Code_Seller","label"=>"Repartidor","type"=>"text"));
array_push($fs,array("name"=>"Code_Account","label"=>"C. Cliente","type"=>"text"));
array_push($fs,array("name"=>"Account","label"=>"Cliente","type"=>"text"));
array_push($fs,array("name"=>"Code_Sales_Org","label"=>"Org. Ventas","type"=>"text"));
array_push($fs,array("name"=>"Order_Num_ofClient","label"=>"Pedido Telynet","type"=>"text"));
array_push($fs,array("name"=>"Order_Date","label"=>"Fecha","type"=>"date"));
array_push($fs,array("name"=>"Code_Product","label"=>"C. Material","type"=>"text"));
array_push($fs,array("name"=>"Product","label"=>"Material","type"=>"text"));
array_push($fs,array("name"=>"Quantity","label"=>"Cantidad","type"=>"text"));
array_push($fs,array("name"=>"Lot_Number","label"=>"Lote","type"=>"date"));
array_push($fs,array("name"=>"Total_Com","label"=>"Comisión","type"=>"text"));
array_push($fs,array("name"=>"Net_Amount","label"=>"Importe Neto","type"=>"text"));
//array_push($fs,array("name"=>"campo2","label"=>"Campo 2","type"=>"text")); // a modificar
// .. añadir los necesarios
$clave="Order_Num"; // a modificar
$and="1=1";
if($Date_Ini!=''){
$and.=" AND prj_orders_header.Order_Date >= '".$Date_Ini."'";
}
if($Date_Fin!=''){
$and.=" AND prj_orders_header.Order_Date <= '".$Date_Fin."'";
}

$sql ="SELECT Order_Num, Num_Line, Orden, Code_Seller, Code_Account, Account, Code_Sales_Org, Order_Num_ofClient, Order_Date, Code_Product, Product, Quantity, Lot_Number, Total_Com, Net_Amount FROM (
SELECT prj_orders_lines.Order_Num, prj_orders_lines.Num_Line, 0 AS Orden, sellers.Description AS Code_Seller, accounts.Code_ofClient AS Code_Account, accounts.Name1 AS Account,
sales_organization.Description AS Code_Sales_Org, prj_orders_header.Order_Num_ofClient, prj_orders_header.Order_Date, products.Code_ofClient AS Code_Product, products.Description AS Product,
CAST(prj_orders_lines.Quantity AS int) AS Quantity, '' AS Lot_Number, prj_orders_lines.Total_Com, prj_orders_lines.Net_Amount 
FROM prj_orders_header 
INNER JOIN prj_orders_lines ON prj_orders_header.Order_Num = prj_orders_lines.Order_Num 
INNER JOIN sellers ON prj_orders_header.Code_Seller = sellers.Code 
INNER JOIN accounts ON prj_orders_header.Code_Account = accounts.Code 
INNER JOIN sales_organization ON prj_orders_header.Code_Sales_Org = sales_organization.Code 
INNER JOIN products ON prj_orders_lines.Code_Product = products.Code 
WHERE ".$and." 
UNION ALL 
SELECT prj_orders_lines_lots.Order_Num,prj_orders_lines_lots.Num_Line,1 AS Orden,'' AS Code_Seller,'' AS Code_Account,'' AS Account,'' AS Code_Sales_Org,'' AS Order_Num_ofClient,'' AS Order_Date,
'' AS Code_Product,'' AS Product,CAST(prj_orders_lines_lots.Quantity AS int) AS Quantity, prj_orders_lines_lots.Lot_Number AS Lot_Number,null AS Total_Com,
null AS Net_Amount FROM prj_orders_header 
INNER JOIN prj_orders_lines_lots ON prj_orders_header.Order_Num = prj_orders_lines_lots.Order_Num 
WHERE ".$and." ) A ORDER BY 1,2,3";

//$sql="select 1 as Id, 'c1' as campo1, 'c2' as campo2 union all select 2 as Id, 'c3' as campo1, 'c4' as campo2"; // a modificar
 
// no modificar nada de aqui hasta el final
$GLOBALS['fields']=array();
constructFields($fs,"search");
putParamView("constructDatagrid","0");
$grid=array();
$results=getFromSQL($sql);
for($i=0;$i<count($results);$i++) {
  $gridPart=array();
  for($j=0;$j<count($fs);$j++) $gridPart[$fs[$j]['name']]=$results[$i][strtoupper($fs[$j]['name'])];
array_push($grid,$gridPart);
}
putGridrows($grid);
putParamView("keyField",$clave);
}