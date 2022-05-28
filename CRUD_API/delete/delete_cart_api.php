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

$product_price = 0;
$quantity = 1;
$existing_cart_id = 0;

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
            $user_id = $data->user_id;
            $product_id = $data->product_id;

            
            // if($query_result == 1){
            $query = "DELETE FROM cart3 WHERE product_id='$product_id' AND user_id = '$user_id'";
            $delete_cart_user = $usersdb->conn->prepare($query);
            $delete_cart_user->execute();  
            $query_result = $delete_cart_user->rowCount();
            
            if($query_result == 0){
                http_response_code(404);
                throw new Exception("No cart deleted");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "Deleted product in cart";
                
                // set response code - 201 created
                http_response_code(201);
                
                // tell the user
                echo json_encode($response);
            }

            // }
            // else{
            //     http_response_code(400);
            //     throw new Exception("User's cart not found!");
            // }

            
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