<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
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
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $invoicedb = new InvoiceDB($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or no

        $query_invoice_id = "SELECT invoices.id, invoices.user_id, users.name, invoices.metode_pembayaran, invoices.status FROM invoices
        JOIN users on invoices.user_id = users.id";
        $query_invoice_id = $invoicedb->conn->prepare($query_invoice_id);
        $query_invoice_id->execute();
        // $query_result = $get_product->rowCount();
        $query_result = $query_invoice_id->rowCount();
        
        if($query_result > 0){
            while ($row = $query_invoice_id->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
          
                $invoicedata=array(
                    "id" => $id,
                    "user_id" => $user_id,
                    "name" => $name,
                    "metode_pembayaran" => $metode_pembayaran,
                    "status" => $status
                );
          
                array_push($response["output"], $invoicedata);
            }
            
            // set error schema
            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            
            $response["error_schema"] = $error_schema;
          
            // set response code - 200 OK
            http_response_code(200);
          
            // show products data in json format
            echo json_encode($response);
            
        } else {
            throw new Exception("Data not found");
        }
        
    } else {
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
