<?php
/*
 * @filename: plg_Orders_detail_s2.php
 * @version: 12/06/2017
 * @author: Diego Aguado (modificado por: Lizbeth Davis - 16/05/2017). Diego 12/06/2017.
 * @project: Mercasid
 * @module: Orders
 * @view: detail
 * @posición: s2
*/
/*
*
 * COMENTARIO LIZBETH DAVIS (11-04-2018):
 * FUE ACTUALIZADO PARA QUE NO PERMITA HACER PEDIDOS SI EL VENDEDOR NO TIENE COMPROBANTE O SI EL RANGO ES MAYOR AL CONTADOR 
 * FINAL O SI LA VIGENCIA DEL COMPROBANTE ES MAYOR A LA FECHA DE EMISIÓN DE LA FACTURA
 * 
*
 * COMENTARIO LIZBETH DAVIS (25-05-2018):
 * FUE CAMBIADO EL CÓDIGO DEL VENDEDOR POR EL CÓDIGO DEL REPARTO. PARA QUE SE APLIQUE EL CONTROL 
 * CUANDO SE ASIGNE UN REPARTO. TAMBIÉN LE CAMBIÉ EL NOMBRE A LAS ALERTAS, ANTES TENÍA VENDEDOR AHORA
 * TIENE REPARTIDOR.
 * 
 * COMENTARIO LIZBETH DAVIS (29-05-2018):
 * LE MODIFIQUÉ LA CONDICIÓN QUE TENÍA DE CONTADOR_FISCAL = 0, LA MISMA MOSTRABA UN MENSAJE 
 * DICIENDO QUE EL REPARTO NO TENÍA UN COMPROBANTE ASOCIADO. LE PUSE QUE EN EL RESULTADO 
 * DEL QUERY CUANDO COUNT VENGA VACÍO, MUESTRE EL MENSAJE Y QUE NO SE GUARDE. 
 * 
 * TAMBIÉN TIENE LA CONDICIÓN DE QUE SI EL REPARTO TIENE EL CONTADOR MAYOR AL CONTADOR FIN, MUESTRE UN
 * MENSAJE DE ADVERTENCIA Y QUE NO LE DEJE CREAR EL REGISTRO
 * 
 * COMENTARIO LIZBETH DAVIS (13-09-2018):
 * FUE ELIMINADA LA PARTE DE LA VERIFICACIÓN DE QUE SI EL REPARTO TIENE COMPROBANTE YA QUE SE HACE EN EL PLUGIN
 * plg_Orders_detail_s1.php
 * 
 * COMENTARIO LIZBETH DAVIS (17-09-2018):
 * FUE MODIFICADA LAS CONDICIONES DONDE EL CONTROL PRJ_USERS_CONTROL.ACCOUNT_GEN_NI DECÍA
 * QUE DEBE SER MAYOR O IGUAL AL NÚMERO DE PEDIDOS LÍMITE PARA LA APLICACIÓN DEL CONTROL. 
 * SE LO CAMBIÉ A QUE DEBE SER SOLO MAYOR, PARA QUE NO LE APLIQUE AL MONTO IGUAL AL NÚMERO COLOCADO.
 * TAMBIÉN FUE AÑADIDA UNA CONDICIÓN PARA QUE NO PERMITA GUARDAR PEDIDOS A UN CLIENTE GENÉRICO 
 * QUE TIENE UNA CANTIDAD DE PEDIDOS ASIGNADA EN EL CONTROL DE USUARIOS.
 * 
 * COMENTARIO LIZBETH DAVIS (19-09-2018):
 * DESPUÉS DE ACLARAR CON EL CLIENTE, EN EL SELECT ENCARGADO DE CONTAR LAS FACTURAS QUE TIENE
 * UN CLIENTE GENÉRICO POR DÍA, LE QUITÉ LA CONDICIÓN DE QUE TOME EN CUENTA SOLAMENTE EL CONTEO 
 * DE LAS FACTURAS CUANDO EL PEDIDO ESTÉ FACTURADO (and Invoiced='1') YA QUE PARA QUE SE CUMPLA 
 * LA MISMA, EL PEDIDO DEBE DE ESTAR CERRADO Y YA NO APLICARÍA LA CONDICIÓN.
 * 
 * COMENTARIO LIZBETH DAVIS (02-10-2018):
 * FUE COLOCADO EL CÓDIGO QUE ESTABA DESDE EL INICIO CREADO POR DIEGO AGUADO
 */

//Vamos a meter datos....
$orderType = $_POST['info_Order_Type'];
$key = storedKey();
writeCustomLog("key: " . print_r($key, true));
if($key!='' && $orderType != '' && $orderType == 'ZCOT'){
   $c = getFromSQL("select Code_Trademark from prj_pricing_sc_trademark where Code_Unit_Org = '".$_POST['info_Code_Unit_Org']."' and Code_Sales_Org = '".$_POST['info_Code_Sales_Org']."' and Code_Type = 'ZCOT' ");
  
writeCustomLog("cursor trademark: " . print_r($c, true));

  if($c != null && $c != '-1' && count($c) > 0){
        $query = "update prj_orders_header set Code_Trademark = '".$c[0]["CODE_TRADEMARK"]."' where Order_Type = 'ZCOT' and Order_Num = '".$key."' ";
writeCustomLog("query: " . $query);
        updateSQL($query);
  }

}
//9130_postStore_v1.php
//Plugin para guardar la price list y el payment way

/** 30/01/2017: cerrar pedidos**/
if($_POST['key']!=''){
if ((($_POST['info_Order_Type']=='ZOR' && $_POST['info_Invoiced']=='1') || ($_POST['info_Order_Type']=='ZDEV')) && ($_POST['info_Status']=='1')){
$sql="update prj_orders_header set Dispatched='1', Charged='1', To_Charge='1' where Order_Num='".$_POST['key']."'";
updateSQL($sql);
}
}else{
//Ver que price list corresponde
     
    $fooObj=getSqlSystemVars("update");
    $sql="update users_counter set ".$fooObj[0].", N_Counter=N_Counter+1 where Code_User='".$_POST['userId']."' and cast(Series as varchar)+''+cast(N_Counter as varchar) = '".$_POST['info_Order_Num_ofClient']."'";    
 
    
//$results=getFromSQL($sql);

$order_num=storedKey();
$Code_Price_List='';
$sql="select PRJ_PRICE_LIST_CLASSB.Code_Price_List from PRJ_PRICE_LIST_CLASSB inner join accounts on PRJ_PRICE_LIST_CLASSB.Code_ClassificationB=accounts.Code_ClassificationB where accounts.Code='".$_POST['info_Code_Account']."'";
$results=getFromSQL($sql);
if ($results[0]['CODE_PRICE_LIST']){
$Code_Price_List = $results[0]['CODE_PRICE_LIST'];
}else{
$sql="select PRJ_PRICE_LIST_CLASSA.Code_Price_List from PRJ_PRICE_LIST_CLASSA inner join accounts on PRJ_PRICE_LIST_CLASSA.Code_ClassificationA=accounts.Code_ClassificationB where accounts.Code='".$_POST['info_Code_Account']."'";
$results=getFromSQL($sql);
if ($results[0]['CODE_PRICE_LIST']){
$Code_Price_List = $results[0]['CODE_PRICE_LIST'];
}else{
$sql="select PRJ_PRICE_LIST_POTENTIAL.Code_Price_List from PRJ_PRICE_LIST_POTENTIAL inner join accounts on PRJ_PRICE_LIST_POTENTIAL.Code_Potential=accounts.Code_Potential where accounts.Code='".$_POST['info_Code_Account']."'";
$results=getFromSQL($sql);
if ($results[0]['CODE_PRICE_LIST']){
$Code_Price_List = $results[0]['CODE_PRICE_LIST'];
}else{
$sql="select Code_Price_List from prj_accounts_organization where Code_Account='".$_POST['info_Code_Account']."' and delete_date is null";
$results=getFromSQL($sql);
if ($results[0]['CODE_PRICE_LIST']){
$Code_Price_List = $results[0]['CODE_PRICE_LIST'];
}else{
$sql="select Code_Prince_List1, Code_Prince_List2 from prj_users where Code_User='".$_POST['userId']."'";
$results=getFromSQL($sql);
if ($_POST['info_Order_Type']=='ZDEV'){
$Code_Price_List = $results[0]['CODE_PRINCE_LIST1'];
}else{
$Code_Price_List = $results[0]['CODE_PRINCE_LIST2'];
}
}
}
}
}
if ($Code_Price_List)
$Code_Price_List = "'".$Code_Price_List."'";
else
$Code_Price_List = "NULL";
if ($_POST['info_Code_Seller_Del'])
$Assigned_Dispatch = '1';
else
$Assigned_Dispatch = '0';
$sql="update prj_orders_header set Code_Price_List=".$Code_Price_List.", Assigned_Dispatch='".$Assigned_Dispatch."' where Order_Num='".$order_num."'";
updateSQL($sql);
}
/** **/


//Nuevo pedido
/*if($_POST['key']=='')
{
    $order_num=storedKey();
    
    $fooObj=getSqlSystemVars("update");
    //TODO EDU: Se actualiza la cabecera del pedido utilizando la cuenta qu suceder�a si la cuenta pertenece a m�s de una una tupla uo,us?
    $sql="update prj_orders_header "
            . "set ".$fooObj[0].""
            . ",prj_orders_header.Order_Num_ofClient=prj_orders_header.Order_Num"
            . ",prj_orders_header.Code_Paymentway=prj_accounts_organization.Code_Payment"
            . ",prj_orders_header.Code_Price_List_default=prj_accounts_organization.Code_Price_List"
            . ",prj_orders_header.Code_Price_List=prj_accounts_organization.Code_Price_List "
            . "from prj_orders_header "
            . "inner join prj_accounts_organization "
            . "on prj_orders_header.Code_Account=prj_accounts_organization.Code_Account "
            . "and prj_orders_header.Code_Unit_Org=prj_accounts_organization.Code_Unit_Org "
            . "and prj_orders_header.Code_Sales_Org=prj_accounts_organization.Code_Sales_Org "
            . "where prj_orders_header.Order_Num='$oder_num'";
    
    updateSQL($sql);
    
    //grabamos los descuentos del cliente en la cabecera del pedido
    $sql="UPDATE prj_orders_header "
            . "SET ".$fooObj[0].""
            . ", prj_orders_header.Special_discount = prj_accounts.Special_discount"
            . ", prj_orders_header.Pp_discount = prj_accounts.Pp_discount"
            . ", prj_orders_header.Volume_discount = prj_accounts.Volume_discount"
            . ", prj_orders_header.Units_discount = prj_accounts.Units_discount "
            . "FROM prj_accounts "
            . "WHERE prj_accounts.Code = '" . $_POST['info_Code_Account'] . "' "
            . "AND prj_orders_header.Order_Num='$oder_num' "
            . "AND prj_orders_header.Code_Account = prj_accounts.Code";
    updateSQL($sql);
    
    $hoy=date("Ymd");
    
    $sql="select Code "
            . "from prj_visits_cap "
            . "where Code_Account='" . $_POST['info_Code_Account'] . "' "
            . "and Date_Captured='" . $hoy . "' and Code_Status='O'";
    $results=getFromSQL($sql);
    
    if($results[0]['CODE'])
    {
        $fooObj=getSqlSystemVars("insert");
        $sql="insert into prj_visits_entities "
                . "(".$fooObj[0].", Code_Visit, Code_Entity, Code_Type_Entity) "
                . "values (".$fooObj[1].", '" . $results[0]['CODE'] . "', '$oder_num', 'OR')";
        updateSQL($sql);
    }
    
    if($_POST['info_Code_Activity'])
    {
        $fooObj=getSqlSystemVars("insert");
        $sql="insert into prj_activities_entities (".$fooObj[0].", Code_Activity, Code_Entity, Code_Type_Entity) "
                . "values (".$fooObj[1].", '" . $_POST['info_Code_Activity'] . "', '$oder_num', 'OR')";
        updateSQL($sql);
    }
}
else
{
    $sql="select prj_activities_entities.Code_Activity, prj_activities.Description "
            . "from prj_activities_entities "
            . "inner join prj_activities "
            . "on prj_activities_entities.Code_Activity=prj_activities.Code "
            . "where Code_Entity='" . $_POST['key'] . "' "
            . "and Code_Type_Entity='OR' "
            . "and Code_Activity='" . $_POST['info_Code_Activity'] . "'";
    $results=getFromSQL($sql);
    //$Code_Activity=$results[0]['CODE_ACTIVITY'];
    
    if(count($results)>0)
    {
        $fooObj=getSqlSystemVars("delete");
        $sql="update prj_activities_entities "
                . "set ".$fooObj[0]." "
                . "where Code_Entity='" . $_POST['key'] . "' and Code_Type_Entity='OR'";
        updateSQL($sql);
        if($_POST['info_Code_Activity']!='')
        {
            $fooObj=getSqlSystemVars("update");
            $sql="update prj_activities_entities "
                    . "set ".$fooObj[0].""
                    . ", Delete_Date=NULL"
                    . ", Delete_User=NULL "
                    . "where Code_Entity='" . $_POST['key'] . "' "
                    . "and Code_Type_Entity='OR' "
                    . "and Code_Activity='" . $_POST['info_Code_Activity'] . "'";
            updateSQL($sql);
        }
    }
    //No hay actividad planificada pero si definida en cabecera
    else
    {
        if($_POST['info_Code_Activity']!='')
        {
            $fooObj=getSqlSystemVars("delete");
            $sql="update prj_activities_entities "
                    . "set ".$fooObj[0]." "
                    . "where Code_Entity='" . $_POST['key'] . "' "
                    . "and Code_Type_Entity='OR'";
            updateSQL($sql);
            $fooObj=getSqlSystemVars("insert");
            $sql="insert into prj_activities_entities "
                    . "(".$fooObj[0].", Code_Activity, Code_Entity, Code_Type_Entity) "
                    . "values (".$fooObj[1].", '" . $_POST['info_Code_Activity'] . "', '" . $_POST['key'] . "', 'OR')";
            updateSQL($sql);
        }
    }
}

*/

//***************Verificar si prj_accounts_organization, tien code_provider lleno */
$Account = $_POST['info_Code_Account'];
$Almacen = $_POST['info_Code_Warehouse'];

$WareH = getFromSQL("SELECT p.Code as Code,pp.Code_User as Code_User FROM warehouses w
LEFT JOIN providers p ON w.Code_ofClient=p.Code_ofClient
INNER JOIN prj_providers pp ON p.Code=pp.Code
WHERE w.Code= $Almacen");


writeCustomLog("Query de Almacen: ".$WareH);

$Provider = $WareH[0]['CODE'];
$UserP = $WareH[0]['CODE_USER'];

writeCustomLog("Usuario Provider: ".$UserP);

$a_org = getFromSQL("SELECT Code_Segment,Code_Provider FROM prj_accounts_organization WHERE Code_Account= $Account ");

$View_Prov = $a_org[0]['CODE_PROVIDER'];

if($View_Prov ==NULL && $View_Prov=='')
{
    $fooObj=getSqlSystemVars("update");
            $sql="update prj_accounts_organization "
                    . "set Code_Provider=".$Provider." "
                    . "where Code_Account='" . $Account . "' ";
            updateSQL($sql);
}

//***************************************actualizar NCF********************************************************
$OrderT = $_POST['info_Order_Type'];
$Invoiced = $_POST['info_Invoiced'];
$NCF_3 = $_POST['info_Notes_3'];
$userId = $_POST['userId'];


$QueryA = "SELECT Code_Segment,Code_Account FROM prj_accounts_organization WHERE Code_Account = '".$Account."' ";
$resultQA = getFromSQL ($QueryA);

$Client = $resultQA[0]['CODE_SEGMENT'];

$sql0 = "select f.Code_User as usuario, f.Type, f.Base as base, f.N_Counter as counter, f.Counter_Fin 
from prj_users_fiscal f 
inner join prj_users h on h.Code_User = '".$UserP."' 
inner join prj_providers p on cast(p.Code as varchar(20)) = h.Code_Provider  and p.Code_User = f.Code_User
where Type = '".$Client."' and f.Delete_Date is null";

$res0 = getFromSQL ($sql0);

$UserT = $res0[0]['TYPE'];

if($OrderT == 'ZOR' && $Invoiced =='1' && $NCF_3=='')
{       
    
    if($UserT == NULL || $UserT == ""){
        exitView("El usuario no tiene NCF Asignado, correspondiente al cliente seleccionado.");
        avoidAutoUpdate();
        cancelStore();
        return;
    }

     $query = "SELECT Code_Segment FROM prj_accounts_organization WHERE Code_Account = '".$_POST['info_Code_Account']."' AND Delete_Date IS NULL";
     $resQuery = getFromSQL($query);
     $type = $resQuery[0]['CODE_SEGMENT'];

     $queryL = "SELECT Secuence_Longitude AS Longitud FROM Prj_Fiscal_Type_Control WHERE Code_Type = '".$type."' ";
     $resQueryL = getFromSQL($queryL);
     
     $Longitud = $resQueryL[0]['LONGITUD'];

     writeCustomLog("Toma el tipo de comprobante fiscal del cliente: ".$type);

    if($type == null || $type == '')
    {
       showMessage("Este cliente no tiene tipo de comprobante valido definido");
       avoidAutoUpdate();
       return;
    }
            
            
    if($OrderT == 'ZOR' && $Invoiced =='1' && $NCF_3=='')
    {
      
            $cmd = "exec sp_actualizarNCFFactura '".$key."'";

        updateSQL($cmd);
          
    }

}else {
    writeCustomLog("No genera comprobante fiscal");
} 

//********************************************fin actualizar NCF******************************************

//HISTORDERHEADER - Comandos - Comando [cargarSB,5908]
launchExtension("cargarSB");