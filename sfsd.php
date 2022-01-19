<?php 
/*
* @filename: cmd_LoadSellers_createLoad.php 
* @version: 29/09/2017
* @author: Diego Aguado (modificado por) 
* @project: Mercasid
* @module: LoadSellers
*/

/**
 * COMENTARIO LIZBETH DAVIS (24-04-2018):
 * FUE AGREGADA LA FUNCIÓN SLEEP(1) PARA QUE AL FINAL DE LA CONDICIÓN ESPERE UN SEGUNDO 
 * PARA VOLVER A EJECUTARSE.
 */
$time_inicio= date()
$Code=""; $lastCode="";
$i=0;
while (isset($_POST['gridkey_'.$i])){
if ($_POST['gridchange_'.$i]=='1'){
//$claves=explode(',',$_POST['gridkey_'.$i]);
//alert($_POST['gridkey_'.$i]);
$sql="select prj_orders_header.Order_Num, sellers.Description from prj_orders_header inner join sellers on prj_orders_header.Code_Seller_Del=sellers.Code where Code_Seller_Del='".$_POST['gridkey_'.$i]."' and Assigned_Dispatch='1' and Dispatched='0' and Order_Num not in (select Order_Num from loads_orders) and Status='0' and prj_orders_header.Delete_Date is null and prj_orders_header.Order_Type='ZOR'";
$results=getFromSQL($sql);
if (count($results)>0){
alert ("ERROR: Existen pedidos abiertos asignados al repartidor: ".$results[0]['DESCRIPTION']);
}else{
$lastCode=$Code;
$Code = getNewKeySync("numeric",18);
if($Code==$lastCode) {
 sleep(1);
 $Code = getNewKeySync("numeric",18);
}
$sql="select * from view_prj_user_wares where Code_Seller='".$_POST['gridkey_'.$i]."'";
$results=getFromSQL($sql);
$Code_Warhouse_Des=$results[0]['CODE_WARHOUSE_DES'];
if (!$Code_Warhouse_Des)
$Code_Warhouse_Des="NULL";
else
$Code_Warhouse_Des="'".$Code_Warhouse_Des."'";
$Code_Warehouse_Sou=$results[0]['CODE_WAREHOUSE_SOU'];
if (!$Code_Warehouse_Sou)
$Code_Warehouse_Sou="NULL";
else
$Code_Warehouse_Sou="'".$Code_Warehouse_Sou."'";


$sql="select Code_Product, SUM(Quantity_Unit) as Quantity, Lot_Number from (
select prj_orders_lines_lots.Code_Product, prj_orders_lines_lots.Quantity_Unit, prj_orders_lines_lots.Unit_Type_Sel, 
prj_orders_lines_lots.Factor_Conversion, prj_orders_lines_lots.Lot_Number 
from prj_orders_header inner join prj_orders_lines_lots on prj_orders_header.Order_Num=prj_orders_lines_lots.Order_Num 
where code_seller_del='".$_POST['gridkey_'.$i]."' and prj_orders_header.Delete_Date is null and prj_orders_lines_lots.Delete_Date is null and Dispatched='0' 
and Assigned_Dispatch='1' and Status='1' and prj_orders_header.Order_Type = 'ZOR' and
prj_orders_header.Order_Num not in (select order_num from loads_orders where delete_date is null) 
UNION ALL
select prj_orders_packs_lines.Code_Product, prj_orders_packs_lines.Quantity_Unit, prj_orders_packs_lines.Unit_Type_Sel, 
prj_orders_packs_lines.Factor_Conversion, '9999999999' as Lot_Number 
from prj_orders_header inner join prj_orders_packs_lines on prj_orders_header.Order_Num=prj_orders_packs_lines.Order_Num 
where code_seller_del='".$_POST['gridkey_'.$i]."' and prj_orders_header.Delete_Date is null and prj_orders_packs_lines.Delete_Date is null and Dispatched='0' 
and Assigned_Dispatch='1' and Status='1' and prj_orders_header.Order_Type = 'ZOR' and prj_orders_packs_lines.Included = '1' and
prj_orders_header.Order_Num not in (select order_num from loads_orders where delete_date is null)) as Charged_Sell
group by Code_Product, Lot_Number";
$results=getFromSQL($sql);
/*
$rotura_stock=false;
$productos=array();
if(true) {
 $block=50;
 for($j=0;$j<ceil(count($results)/$block);$j++) {
  $condQuantity=array();
  for($z=$j*$block;$z<count($results)&&$z<($j+1)*$block;$z++) {
   $condQuantity[$results[$z]['CODE_PRODUCT']]=$results[$z]['QUANTITY'];
  }
  $sql="select distinct code_product,stock,products.Code_ofClient as ProdSAPID from view_rotura_stock inner join products on view_rotura_stock.code_product=products.code where code_seller_del='".$_POST['gridkey_'.$i]."' and Code_Product in ('".join("','",array_keys($condQuantity))."')";
  $results2=getFromSQL($sql);
  foreach($results2 as $r) {
   if($r['STOCK']<$condQuantity[$r['CODE_PRODUCT']]) {
    $rotura_stock=true;
    $productos[]=$r['PRODSAPID'];
}}}}
else {
 foreach ($results as $r){
  $sql="select distinct code_product, stock, products.Code_ofClient as ProdSAPID from view_rotura_stock inner join products on view_rotura_stock.code_product=products.code where code_seller_del='".$_POST['gridkey_'.$i]."' and Code_Product='".$r['CODE_PRODUCT']."'";
  $results2=getFromSQL($sql);
  if ($results2[0]['STOCK']<$r['QUANTITY']){
   $rotura_stock=true;
   $productos[]=$results2[0]['PRODSAPID'];
}}}
*/
//if (!$rotura_stock){
$date=date('Ymd');
$fooObj=getSqlSystemVars("insert");
$sql="insert into loads_head (".$fooObj[0].", Code_Warehouse_Sou, Code_Warehouse_Des, Code_Type, Date_load, Code_Status, Code) values (".$fooObj[1].", ".$Code_Warehouse_Sou.", ".$Code_Warhouse_Des.", '01', '".$date."', '9', '".$Code."')";
updateSQL($sql);
$sql="insert into prj_loads_head (".$fooObj[0].", Code_Type2, Code) values (".$fooObj[1].", '7', '".$Code."')";
updateSQL($sql);
$sql="select Code_Product, SUM(Quantity) as Quantity, Unit_Type_Sel, Factor_Conversion, Lot_Number from (select prj_orders_lines_lots.Code_Product, prj_orders_lines_lots.Quantity, prj_orders_lines_lots.Unit_Type_Sel, prj_orders_lines_lots.Factor_Conversion, prj_orders_lines_lots.Lot_Number 
from prj_orders_header 
inner join prj_orders_lines_lots on prj_orders_header.Order_Num=prj_orders_lines_lots.Order_Num 
where code_seller_del='".$_POST['gridkey_'.$i]."' and prj_orders_header.Delete_Date is null and prj_orders_lines_lots.Delete_Date is null and Dispatched='0' 
and Assigned_Dispatch='1' and Status='1' and prj_orders_header.Order_Type = 'ZOR' and
prj_orders_header.Order_Num not in (select order_num from loads_orders where delete_date is null) 
UNION ALL
select prj_orders_packs_lines.Code_Product, prj_orders_packs_lines.Quantity, prj_orders_packs_lines.Unit_Type_Sel, prj_orders_packs_lines.Factor_Conversion, '9999999999' as Lot_Number 
from prj_orders_header 
inner join prj_orders_packs_lines on prj_orders_header.Order_Num=prj_orders_packs_lines.Order_Num 
where code_seller_del='".$_POST['gridkey_'.$i]."' and prj_orders_header.Delete_Date is null and prj_orders_packs_lines.Delete_Date is null and Dispatched='0' 
and Assigned_Dispatch='1' and Status='1' and prj_orders_header.Order_Type = 'ZOR' and prj_orders_packs_lines.Included = '1' and
prj_orders_header.Order_Num not in (select order_num from loads_orders where delete_date is null)) as Charged_Sell
group by Code_Product, Unit_Type_Sel, Factor_Conversion, Lot_Number";
$results=getFromSQL($sql);
$num_line=10;
for ($j=0;$j<count($results);$j++){
$Unit_Type_Sel=$results[$j]['UNIT_TYPE_SEL'];
if (!$Unit_Type_Sel)
$Unit_Type_Sel="NULL";
else
$Unit_Type_Sel="'".$Unit_Type_Sel."'";
$Factor_Conversion=$results[$j]['FACTOR_CONVERSION'];
if (!$Factor_Conversion)
$Factor_Conversion="NULL";
else
$Factor_Conversion="'".$Factor_Conversion."'";
$sql="insert into loads_detail (".$fooObj[0].", Code, Num_Line, Code_Product, Quantity, Quantity_Real, Unit_Type, Factor_Conversion, Prepared, Lot_Group) values (".$fooObj[1].", '".$Code."', '".$num_line."', '".$results[$j]['CODE_PRODUCT']."', '".$results[$j]['QUANTITY']."', '".$results[$j]['QUANTITY']."', ".$Unit_Type_Sel.", ".$Factor_Conversion.", '0', '".$results[$j]['LOT_NUMBER']."')";
updateSQL($sql);
$sql="insert into prj_loads_detail (".$fooObj[0].", Code, Num_Line, Promotional) values (".$fooObj[1].", '".$Code."', '".$num_line."', '0')";
updateSQL($sql);
//writeCustomLog($sql);
$num_line+=10;
}
$sql="select distinct prj_orders_header.Order_Num from prj_orders_header where code_seller_del='".$_POST['gridkey_'.$i]."' and prj_orders_header.Delete_Date is null and  Dispatched='0' and Assigned_Dispatch='1' and Status='1' and prj_orders_header.Order_Num not in (select order_num from loads_orders where delete_date is null)";
$results=getFromSQL($sql);
$fooObj2=getSqlSystemVars("update");

$orderNums = "";

for ($j=0;$j<count($results);$j++){
    $sql="insert into loads_orders (".$fooObj[0].", Code_Load, Order_Num) values (".$fooObj[1].", '".$Code."', '".$results[$j]['ORDER_NUM']."')";
    updateSQL($sql);
    if($j == 0){
        $orderNums .= "'". $results[$j]['ORDER_NUM'] . "'";
    }else{
        $orderNums .= ", '". $results[$j]['ORDER_NUM'] . "'";
    }

    /*
$sql="insert into loads_orders (".$fooObj[0].", Code_Load, Order_Num) values (".$fooObj[1].", '".$Code."', '".$results[$j]['ORDER_NUM']."')";
updateSQL($sql);
$sql="update prj_orders_header set ".$fooObj2[0].", Invoiced='1' where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_lines set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_lines_lots set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_packs_header set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_packs_lines set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_packs_taxes set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_promo_list set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);
$sql="update prj_orders_secuences set ".$fooObj2[0]." where Order_Num='".$results[$j]['ORDER_NUM']."'";
updateSQL($sql);*/
} 


$sql="update prj_orders_header set ".$fooObj2[0].", Invoiced='1' where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_lines set ".$fooObj2[0]."  where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_lines_lots set ".$fooObj2[0]."  where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_packs_header set ".$fooObj2[0]." where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_packs_lines set ".$fooObj2[0]." where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_packs_taxes set ".$fooObj2[0]." where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_promo_list set ".$fooObj2[0]." where Order_Num in(".$orderNums.")";
updateSQL($sql);
$sql="update prj_orders_secuences set ".$fooObj2[0]." where Order_Num in(".$orderNums.")";
updateSQL($sql);

/*}else{
$sql="select Description from sellers where Code='".$_POST['gridkey_'.$i]."'";
$results2=getFromSQL($sql);
$productos = implode(",", $productos);
alert ("No se puede hacer carga a este vendedor ".$results2[0]['DESCRIPTION']." porque estos productos no tienen stock: ".$productos);
}*/
}
//writeCustomLog("Espera un segundo");
//sleep(1);
}
$i++;
}

