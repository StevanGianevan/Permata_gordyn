<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../cartdb.php";
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
        
        $cartdb= new CartDb($db);
        $productdb = new ProductDb($db);
        $usersdb = new UsersDb($db);
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->product_ids) && !empty($data->user_id)){
            //end session uji coba
            $cart_id = strtoupper(uniqid());
            $user_id = $data->user_id;
            $create_date = (isset($data->create_date) ? $data->create_date : false);
            $modified_date = (isset($data->modified_date) ? $data->modified_date : false);

            $query = "SELECT * FROM cart WHERE user_id='$user_id'";
            $get_cart_user = $usersdb->conn->prepare($query);
            $get_cart_user->execute();
            $query_result = $get_cart_user->rowCount();
            
            
            if($query_result == 1){
                while ($row = $get_cart_user->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $existing_cart_id = $id;
                    $product_ids = $product_ids;
                    $product_ids2 = $product_ids2;
                    $product_ids3 = $product_ids3;
                }

                $product_ids_to_be_inputed = $data->product_ids;
                $product_array=array($product_ids, $product_ids2, $product_ids3);

                if (in_array($product_ids_to_be_inputed,$product_array)){
                    http_response_code(400);
                    throw new Exception("Item already added, please choose another one!.");
                }
                else{
                    if (empty($product_ids)){
                        $product_row = 'product_ids';
                    }
                    else if (empty($product_ids2)){
                        $product_row = 'product_ids2';
                    }
                    else if(empty($product_ids3)){
                        $product_row = 'product_ids3';
                    }
                    else{
                        http_response_code(400);
                        throw new Exception("Maximum 3 item in cart reached, cannot add anymore item!.");
                    }
                }



                


                $query = "UPDATE cart SET $product_row = '$product_ids_to_be_inputed' WHERE id='$id'";
                $update_cart_user = $usersdb->conn->prepare($query);
                $update_cart_user->execute();
                $need_to_be_executed = $update_cart_user;            
            }

            else{
                $product_ids = $data->product_ids;
                $query = "INSERT INTO cart (id, user_id, product_ids, prices, quantity, total_prices)VALUE('$cart_id', '$user_id', '$product_ids', $product_price, $quantity, $product_price)";
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