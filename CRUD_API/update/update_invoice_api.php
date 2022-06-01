<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../cartdb.php";
include_once "../productdb.php";
include_once "../invoicedb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();
$price_array = array();

try {
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        $invoicedb = new InvoiceDB($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or no
        if(!empty($data->invoice_id) && (!empty($data->status))){
            $invoice_id = $data->invoice_id;
            $query_invoice_id = "SELECT * FROM invoices WHERE id='$invoice_id'";
            $query_invoice_id = $invoicedb->conn->prepare($query_invoice_id);
            $query_invoice_id->execute();
            // $query_result = $get_product->rowCount();
            $query_result = $query_invoice_id->rowCount();
            
            if($query_result > 0){
                $status = $data->status;
                $update_invoice_id = "UPDATE invoices SET status='$status' WHERE id='$invoice_id'";
                $update_invoice_id = $invoicedb->conn->prepare($update_invoice_id);
                $update_invoice_id->execute();
                $update_query_result = $query_invoice_id->rowCount();
                // set error schema
                if($update_query_result > 0){
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Success confirming user payment!";
                    // set response code - 200 OK
                    http_response_code(200);
                    
                    // show products data in json format
                    echo json_encode($response);
                }
                else{
                    http_response_code(405);
                    throw new Exception("Failed confirming user");
                }
               
                
            } else {
                http_response_code(405);
                throw new Exception("Invoice not found");
            }
        
        } else {
            http_response_code(405);
            throw new Exception("Invoice ID Empty!");
        }
    }
    else {
        http_response_code(405);
        throw new Exception("Not authorized access");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
    
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array(
            "error_schema" => $error_schema,
            "output" => $e->getMessage()
        )
    );
    
    die();
}

?>
