<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../cart3db.php";
include_once "../invoicedb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();
$price_array = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $cartdb = new Cart3Db($db);
        $invoicedb = new InvoiceDB($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or not
        if(!empty($data->user_id) && !empty($data->metode_pembayaran)){
            $user_id = $data->user_id;
            $metode_pembayaran = $data->metode_pembayaran;

            $query = "SELECT id from invoices WHERE user_id = '$user_id' and status ='UNPAID'";
            $get_inv = $invoicedb->conn->prepare($query);
            $get_inv->execute();
            $query_inv_result = $get_inv->rowCount();
            if($query_inv_result==1){
                while ($row = $get_inv->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $invoice_id = $id;
                }
            }
            else{
                http_response_code(503);
                throw new Exception("Invoice doesn't exist.");
            }

            $query = "UPDATE invoices SET metode_pembayaran='$metode_pembayaran', status='IN_PROCESS' WHERE user_id = '$user_id' and status ='UNPAID'";
            $update_invoice = $invoicedb->conn->prepare($query);
            $update_invoice->execute();
            $query_result = $update_invoice->rowCount();

            if($query_result==1){
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "Invoice Updated!";
                
                // set response code - 201 created
                http_response_code(201);
          
                // tell the user
                echo json_encode($response);
            }
            
            else{
          
                // set response code - 503 service unavailable
                http_response_code(503);
          
                // tell the user
                throw new Exception("Unable to set method payment.");
            }
            
            $remove_cart_query = "UPDATE cart3 SET status='EXPIRED' WHERE invoice_id='$invoice_id'";
            $remove_cart = $cartdb->conn->prepare($remove_cart_query);
            $remove_cart->execute();
            $query_cart_result = $remove_cart->rowCount();
            if($query_cart_result==0){
                http_response_code(400);
                throw new Exception("Unable to update cart.");
            }
        
        } else {
            http_response_code(400);
            throw new Exception("Missing UserID and Payment Method Field");
        }
        
    } else {
        http_response_code(405);
        throw new Exception("Method not allowed");
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
