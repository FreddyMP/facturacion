<?php
function getOrders($input="string<Dataws>")
{
    $layOrder = array(array("ID" => "0","Order_Num" => "0", "Num_Line" => "0", "Order_Num_ofClient" => "0", "Delivery_Date" => "0", "Order_Date" => "0",  "Code_Account" => "0",  
    "Code_Product" => "0", "Lot_Number" => "0", "Quantity" => "0", "Quantity_Order" => "0",  "Unit_Measure" => "0",  "Price_Br" => "0",  "Price" => "0",   "Total_Amount" => "0", 
    "Por_Discount1" => "0", "Amount_Discount1" => "0",  "Por_Discount2" => "0", "Amount_Discount2" => "0", "Por_Discount3" => "0","Amount_Discount3" => "0", "Por_Tax1" => "0", 
    "Amount_Tax1" => "0", "Por_Tax2" => "0", "Amount_Tax2" => "0", "Code_Currency" => "0", "Order_Num_Cli" => "0", "Code_Paymentway" => "0", "Code_Seller" => "0", "Order_Type" => "0", 
    "Sale_Type" => "0", "Code_ReturnCause" => "0", ));

        $lstSQLOrder = "SELECT  prj_orders_header.id, prj_orders_header.Order_Num, prj_orders_header.Order_Num_ofClient, prj_orders_header.Delivery_Date, prj_orders_header.Order_Date,
        prj_orders_header.Code_Account, prj_orders_header.Total_Amount, prj_orders_header.Code_Currency, prj_orders_header.Order_Num_Cli, prj_orders_header.Code_Paymentway,
        prj_orders_header.Code_Seller, prj_orders_header.Order_Type, prj_orders_header.Code_ReturnCause, prj_orders_header.Code_Promotion, prj_orders_header.Transfered,
        prj_orders_header.Status from prj_orders_header inner join prj_orders_lines on prj_orders_lines.order_num  = prj_orders_header.order_num
        where prj_orders_header.delete_date is null  and prj_orders_lines.delete_date is null order by prj_orders_header.id desc";

        $layOrderSQL = getFromSQL($lstSQLOrder);

        if (count($layOrderSQL) > 0) {
            $layOrder = $layOrderSQL;
        }

    return (sendParams($layOrder, "string[]<ID_CLOSE,CODE_ROUTE,RUTA,CODE_SELLER,VENDEDOR,DATE_ROUTE,DATE_SAPSEND,STATUS,CIERRE,STATUS_SAP,CIERRESAP>"));
}   