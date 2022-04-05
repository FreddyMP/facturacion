<?php
function getEXPLTCollectionsReceived($input="string<dataws>")
{
    $layCollection = array(array("ID" => "0", "NUM_INVOICE"=>"0", "NUMDOCUM"=>"0","NUM_LINE" => "0","DATE_DOC"=> "0","CODE_ACCOUNT"=> "0","CODE_TYPE"=> "0","TOTAL_COLLECTED"=> "0","CODE_COLLECTING_TYPE"=> "0", "CODE_PAYMENT"=> "0","NUM_CHECK"=> "0","DATE_EXPIRATION"=> "0","DISCOUNT"=> "0","TOTAL_DISCOUNT"=> "0", "AMOUNT_GROSS"=> "0", "CODE_CURRENCY"=> "0","OBSERVATIONS"=> "0","TRANSFERED"=> "0"));
        $lstSQLCollections = "SELECT TOP 100 collections_received.Id, collections_received.Num_Invoice, collections_received.NumDocum, collections_received.Num_Line, collections_received.Date_Doc, collections_received.Code_Account,
        collections_received.Code_Type , collections_received.Total_Collected, collections_received.Code_Collecting_Type , collections_received.Code_Payment,
        collections_received.Num_Check , collections_received.Date_Expiration, collections_received.Discount ,prj_accounts.Code_Currency , collections_received.Observations, collections_received.transfered,
        prj_collections_received.Total_Discount, Amount_Gross
        FROM collections_received
        inner join prj_collections_received on prj_collections_received.Num_Invoice = collections_received.Num_Invoice and prj_collections_received.NumDocum = collections_received.NumDocum
        inner join prj_accounts on prj_accounts.code = collections_received.Code_Account
        where collections_received.Delete_Date is null and prj_collections_received.Delete_Date is null";
        $layCollectionsSQL = getFromSQL($lstSQLCollections);

        if (count($layCollectionsSQL) > 0) {
            $layCollection = $layCollectionsSQL;
        }
    return (sendParams($layCollection, "string[]<ID,NUM_INVOICE,NUMDOCUM,NUM_LINE,DATE_DOC,CODE_ACCOUNT,CODE_TYPE,TOTAL_COLLECTED,CODE_COLLECTING_TYPE,CODE_PAYMENT,NUM_CHECK,DATE_EXPIRATION,DISCOUNT,TOTAL_DISCOUNT,AMOUNT_GROSS,CODE_CURRENCY,OBSERVATIONS,TRANSFERED>"));
}