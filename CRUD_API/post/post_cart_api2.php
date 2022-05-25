<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../cart3db.php";
include_once "../productdb.php";
include_once "../usersdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $cartdb= new Cart3Db($db);
        $productdb = new ProductDb($db);
        $usersdb = new UsersDb($db);
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->product_id) && !empty($data->user_id)){
            //end session uji coba
            $quantity = 1;
            $product_id = $data->product_id;
            $cart_id = strtoupper(uniqid());
            $user_id = $data->user_id;
            $create_date = (isset($data->create_date) ? $data->create_date : false);
            $modified_date = (isset($data->modified_date) ? $data->modified_date : false);

            $query = "SELECT * FROM cart3 WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $cart_product = $cartdb->conn->prepare($query);
            $cart_product->execute();
            $query_result = $cart_product->rowCount();
            if($query_result > 0){
                while ($row = $cart_product->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $existing_quantity = $quantity;
                    $query = "UPDATE cart3 SET quantity = quantity+1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
                    $update_cart_quantity = $usersdb->conn->prepare($query);
                    $need_to_be_executed = $update_cart_quantity;
                
                }
            }
            else{
                $query = "INSERT INTO cart3 (id, user_id, product_id, quantity)VALUE('$cart_id', '$user_id', '$product_id', '$quantity')";
                $create_cart = $cartdb->conn->prepare($query);
                $need_to_be_executed = $create_cart;
            }
            
            
            

            
            if($need_to_be_executed->execute()){
                    // set error schema
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Added to Cart";
                    
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
            
            // register the user
            
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