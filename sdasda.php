
<?php
/*
* @filename: cmd_GestAlamcenLoad2_prj_Validar.php
* @version: 17/11/2017
* @author: Diego Aguado (modificado por) 
* @project: Mercasid
* @module: GestAlamcenLoad2
*/
launchExtension("duplicarLin");
$codigoCarga = $_POST['key'];
$fecha = date("Ymd");

if($codigoCarga != "")
{
    $sql4="select Code_Status, Code_Type, Code_Warehouse_Sou, Code_Warehouse_Des from loads_head where Code='".$codigoCarga."' and Delete_Date is null";
    $results4=getFromSQL($sql4);

    if( ($results4[0]['CODE_STATUS'] == "1") || ($results4[0]['CODE_STATUS'] == "5") )
    {
        showMessage(translateName("alreadyDone", "GestAlmacenLoad"));
    }
    else
    {
        $sql2222="delete from warehouses_stock where Delete_Date is not null";
        //updateSQL($sql2222);
        $sql8="select Code_Product,Quantity, Unit_Type from loads_detail where Code='".$codigoCarga."' and Delete_Date is null";
        $results8=getFromSQL($sql8);
        //alert($sql8);

        if($results4[0]['CODE_TYPE'] == "01")
        {
            $avisar=1;
            $array_prod = array();
            for($i=0;$i < count($results8); $i++)
            {
                //unidades del producto
                $sqlProd="select Unit_Measure, Factor_Conversion from products_measure where Code_Product='".$results8[$i]['CODE_PRODUCT']."' and Delete_Date is null";
                $resultsProd=getFromSQL($sqlProd);
                //alert($sqlProd);
                //alert($resultsProd);
                $unidadesProd=array();
                foreach ($resultsProd as $r)
                {
                    $unidadesProd[$r['UNIT_MEASURE']]=$r['FACTOR_CONVERSION'];
                }

                //cantidad convertida que hay en el stock del alamc?n
                $sqlOrigen="select Code_Product, Quantity, Num_Line, Unit_Type from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_SOU']."' and Code_Product='".$results8[$i]['CODE_PRODUCT']."'";
                $resultsOrigen=getFromSQL($sqlOrigen);
                if ($resultsOrigen[0]['UNIT_TYPE']!=$results8[$i]['UNIT_TYPE'])
                {
                    $quantityConverted = ($results8[$i]['QUANTITY']*$unidadesProd[$results8[$i]['UNIT_TYPE']]) / $unidadesProd[$resultsOrigen[0]['UNIT_TYPE']];
                }else{
                    $quantityConverted = $results8[$i]['QUANTITY'];
                }

                //stock reservado
                $sql="select Quantity, Unit_Measure from view_stock_reserved where Code_Product='".$results8[$i]['CODE_PRODUCT']."' and Code_Warehouse_Sou='".$results4[0]['CODE_WAREHOUSE_SOU']."'";
                $resultStockReserved=getFromSQL($sql);
                $stock_reserved = $resultStockReserved[0]['QUANTITY'];
                $stock_reserved_unit = $resultStockReserved[0]['UNIT_MEASURE'];
                if (!$stock_reserved) $stock_reserved = '0';
                if ($resultsOrigen[0]['UNIT_TYPE']!=$stock_reserved_unit)
                {
                    $stock_reserved = ($stock_reserved*$unidadesProd[$stock_reserved_unit]) / $unidadesProd[$resultsOrigen[0]['UNIT_TYPE']];
                }

                if ($quantityConverted>($resultsOrigen[0]['QUANTITY'] - $stock_reserved)){
                    $avisar=0;
                    $sql="select Code_ofClient from products where Code='".$results8[$i]['CODE_PRODUCT']."'";
                    $resultsStock=getFromSQL($sql);
                    $array_prod[] = $resultsStock[0]['CODE_OFCLIENT'];
                }

                $sql="update loads_detail set Quantity_Real = Quantity where Code='".$codigoCarga."'  and Code_Product='".$results8[$i]['CODE_PRODUCT']."'";
                updateSQL($sql);

                //alert($sqlOrigen);

                /*$infoLinea=getFromSQL("select MAX(Num_Line) as maxLinea,count(*) as totalLineas from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."'",0);
                $sigLinea=$infoLinea['MAXLINEA'];
                if($sigLinea=="") $sigLinea=0; $sigLinea++;

                $sql222="select Quantity, Num_Line from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."' and Code_Product='".$results8[$i]['CODE_PRODUCT']."'";
                $resultsDestino=getFromSQL($sql222);

                $sqlProd="select Unit_Type_Inv from products where Code='".$results8[$i]['CODE_PRODUCT']."' and Delete_Date is null";
                $resultsProd=getFromSQL($sqlProd);

                if($resultsDestino[0]['NUM_LINE'] == "")
                {
                $sql="insert into warehouses_stock (Create_User,Create_Date,Modify_User,Modify_Date,Code_Warehouse,Code_Product,Num_Line, Unit_Type,Quantity) values ('".$_POST['userId']."','".$fecha."','".$_POST['userId']."','".$fecha."','".$results4[0]['CODE_WAREHOUSE_DES']."','".$results8[$i]['CODE_PRODUCT']."','".$sigLinea."','".$resultsProd[0]['UNIT_TYPE_INV']."','".$results8[$i]['QUANTITY']."')";
                updateSQL($sql);
                }
                else
                {
                $cantidadNueva = $resultsDestino[0]['QUANTITY'] + $results8[$i]['QUANTITY'];
                $sql="update warehouses_stock set Quantity = '".$cantidadNueva."',Modify_Date='".$fecha."' where Num_Line='".$resultsDestino[0]['NUM_LINE']."' and Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."'";
                updateSQL($sql);
                }

                if($resultsOrigen[0]['NUM_LINE'] == "")
                {
                $sql55="insert into warehouses_stock (Create_User,Create_Date,Modify_User,Modify_Date,Code_Warehouse,Code_Product,Num_Line, Unit_Type,Quantity) values ('".$_POST['userId']."','".$fecha."','".$_POST['userId']."','".$fecha."','".$results4[0]['CODE_WAREHOUSE_SOU']."','".$results8[$i]['CODE_PRODUCT']."','".$sigLineaOrigen."','".$resultsProd[0]['UNIT_TYPE_INV']."','0')";
                updateSQL($sql55);
                }
                else
                {
                $cantidadNueva = $resultsOrigen[0]['QUANTITY'] - $results8[$i]['QUANTITY'];
                if($cantidadNueva == "" || $cantidadNueva < 0) $cantidadNueva = 0;
                $sql55="update warehouses_stock set Quantity = '".$cantidadNueva."',Modify_Date='".$fecha."' where Num_Line='".$resultsOrigen[0]['NUM_LINE']."' and Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_SOU']."'";
                updateSQL($sql55);
                }*/
            }
            $string_prod = implode(", ", $array_prod);
            executeJs('duplicarLin('.$avisar.', \''.$string_prod.'\', \''.$codigoCarga.'\')');
        }
        else
        {
            duplicarLin('descarga',$codigoCarga);
            //for($i=0;$i < count($results8); $i++)
            //{
            /*$infoLineaOrigen=getFromSQL("select MAX(Num_Line) as maxLinea,count(*) as totalLineas from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_SOU']."'",0);
            $sigLineaOrigen=$infoLineaOrigen['MAXLINEA'];
            if($sigLineaOrigen=="") $sigLineaOrigen=0; $sigLineaOrigen++;*/

            /*$sqlOrigen="select Code_Product, Quantity, Num_Line from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_SOU']."' and Code_Product='".$results8[$i]['CODE_PRODUCT']."'";
            $resultsOrigen=getFromSQL($sqlOrigen);*/

            /*$infoLinea=getFromSQL("select MAX(Num_Line) as maxLinea,count(*) as totalLineas from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."'",0);
            $sigLinea=$infoLinea['MAXLINEA'];
            if($sigLinea=="") $sigLinea=0; $sigLinea++;

            $sql222="select Quantity, Num_Line from warehouses_stock where Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."' and Code_Product='".$results8[$i]['CODE_PRODUCT']."'";
            $resultsDestino=getFromSQL($sql222);
            //alert($sql222);

            $sqlProd="select Unit_Type_Inv from products where Code='".$results8[$i]['CODE_PRODUCT']."' and Delete_Date is null";
            $resultsProd=getFromSQL($sqlProd);

            if($resultsDestino[0]['NUM_LINE'] == "")
            {
            $sql="insert into warehouses_stock (Create_User,Create_Date,Modify_User,Modify_Date,Code_Warehouse,Code_Product,Num_Line, Unit_Type,Quantity) values ('".$_POST['userId']."','".$fecha."','".$_POST['userId']."','".$fecha."','".$results4[0]['CODE_WAREHOUSE_DES']."','".$results8[$i]['CODE_PRODUCT']."','".$sigLinea."','".$resultsProd[0]['UNIT_TYPE_INV']."','0')";
            updateSQL($sql);
            }
            else
            {
            $cantidadNueva = $resultsDestino[0]['QUANTITY'] - $results8[$i]['QUANTITY'];
            if($cantidadNueva == "" || $cantidadNueva < 0) $cantidadNueva = 0;
            $sql="update warehouses_stock set Quantity = '".$cantidadNueva."',Modify_Date='".$fecha."' where Num_Line='".$resultsOrigen[0]['NUM_LINE']."' and Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_DES']."'";
            updateSQL($sql);
            }

            if($resultsOrigen[0]['NUM_LINE'] == "")
            {
            $sql55="insert into warehouses_stock (Create_User,Create_Date,Modify_User,Modify_Date,Code_Warehouse,Code_Product,Num_Line, Unit_Type,Quantity) values ('".$_POST['userId']."','".$fecha."','".$_POST['userId']."','".$fecha."','".$results4[0]['CODE_WAREHOUSE_SOU']."','".$results8[$i]['CODE_PRODUCT']."','".$sigLineaOrigen."','".$resultsProd[0]['UNIT_TYPE_INV']."','".$results8[$i]['QUANTITY']."')";
            updateSQL($sql55);
            }
            else
            {
            $cantidadNueva = $resultsOrigen[0]['QUANTITY'] + $results8[$i]['QUANTITY'];
            $sql55="update warehouses_stock set Quantity = '".$cantidadNueva."',Modify_Date='".$fecha."' where Num_Line='".$resultsOrigen[0]['NUM_LINE']."' and Code_Warehouse='".$results4[0]['CODE_WAREHOUSE_SOU']."'";
            updateSQL($sql55);
            }*/
            //}
        }
        $sql9="select Code_Type2 from prj_loads_head where Code='".$codigoCarga."'";
        $results9=getFromSQL($sql9);
        $fooObj=getSqlSystemVars("update");
        $sql="update loads_head set ".$fooObj[0]." where Code='".$codigoCarga."'";
        updateSQL($sql);
        if ($results9[0]['CODE_TYPE2']=='2' && count($array_prod)==0){
            $Code_Type2='8';
            $sql="update loads_head set Code_Status='0' where Code='".$codigoCarga."'";
            updateSQL($sql);
        }else
        $Code_Type2=$results9[0]['CODE_TYPE2'];
        $sql="update prj_loads_head set ".$fooObj[0].", Code_Type2='".$Code_Type2."' where Code='".$codigoCarga."'";
        updateSQL($sql);
        $sql="update prj_loads_detail set ".$fooObj[0]." where Code='".$codigoCarga."'";
        updateSQL($sql);
        showMessage(translateName("success", "GestAlmacenLoad"));
    }
}

//