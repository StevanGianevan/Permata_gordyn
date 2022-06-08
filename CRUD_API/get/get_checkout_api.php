<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../cartdb.php";
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
        $cartdb = new CartDb($db);
        $invoicedb = new InvoiceDB($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or not
        if(!empty($data->user_id)){
            $user_id = $data->user_id;
            $query = "SELECT * FROM cart3 WHERE user_id ='$user_id'";
            $get_cart = $cartdb->conn->prepare($query);
            $get_cart->execute();
            $query_result = $get_cart->rowCount();
            if($query_result > 0){
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                // set response code - 200 OK
                http_response_code(200);
                echo json_encode($response);
                
            } else {
                throw new Exception("There is no item selected.");
            }
        
        } else {
            http_response_code(400);
            throw new Exception("Missing UserID Field");
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
