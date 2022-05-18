<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../cartdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $cartdb= new CartDb($db);
        
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        
        // make sure data is not empty
        if(!empty($data->product_ids)){
            $id = strtoupper(uniqid());
            $product_ids = $data->product_ids;
            $prices = $data->prices;
            $quantity = $data->quantity;
            $create_date = $data->create_date;
            $modified_date = $data->modified_date;
            $total_prices = $data->total_prices;
            
            $query = "INSERT INTO cart (id, product_ids, prices, quantity, total_prices)VALUE('$id', $product_ids, $prices, $quantity, $total_prices)";
            $add_cart = $cartdb->conn->prepare($query);
            
            // register the user
            if($add_cart->execute()){
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "Cart successfully added";
                
                // set response code - 201 created
                http_response_code(201);
                
                // tell the user
                echo json_encode($response);
            }
            else{
          
                // set response code - 503 service unavailable
                http_response_code(503);
          
                // tell the user
                throw new Exception("Unable to add cart.");
            }
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Missing mandatory field");
        }
    } else {
        // set response code - 404 Not found
        http_response_code(404);
        throw new Exception("Not authorized access");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
  
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