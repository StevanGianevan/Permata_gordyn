<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
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
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        
        $cartdb= new CartDb($db);
        $productdb = new ProductDb($db);
        $usersdb = new UsersDb($db);
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->product_ids) && !empty($data->user_id)){
            //end session uji coba
            $user_id = $data->user_id;
            $product_ids = $data->product_ids;

            $cart_product_id_row = "cart.product_ids";
            $cart_product_id_row = "cart.product_ids2";
            $cart_product_id_row = "cart.product_ids3";


            // $query = "SELECT cart.id, cart.user_id, cart.product_ids, cart.lp1, cart.lp2, cart.lp3, cart.wp1, cart.wp2, cart.wp3, cart.product_ids,  cart.product_ids2, cart.product_ids3, cart.prices, cart.prices2, cart.prices3, cart.quantity, cart.quantity2, cart.quantity3, cart.create_date, cart.modified_date, cart.total_prices, product.price 
            // FROM cart INNER JOIN product ON $cart_product_id_row = product.id WHERE cart.user_id='$user_id' and $cart_product_id_row = product.id";
            $query = "SELECT * FROM cart where user_id = '$user_id'";
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
                    $prices = $prices;
                    $prices2 = $prices2;
                    $prices3 = $prices3;
                }
                $product_ids_to_be_updated = $data->product_ids;

                $prod_query = "SELECT * FROM product WHERE id ='$product_ids_to_be_updated'";
                $get_product_data = $productdb->conn->prepare($prod_query);
                $get_product_data->execute();
                $query_result = $get_product_data->rowCount();
                if($query_result > 0){
                    while ($row = $get_product_data->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $product_price = $price;
                    }
                }

                
                $lp = $data->lp;
                $wp = $data->wp;
                $quantity = $data->quantity;

                if ($product_ids == $product_ids_to_be_updated){
                    $lp_row = "lp1";
                    $wp_row = "wp1";
                    $price_row = "prices";
                    $quantity_row = "quantity";
                    $price_to_be_updated = ($lp * $wp * $quantity) * $product_price;               
                }
                else if ($product_ids2 == $product_ids_to_be_updated){
                    $lp_row = "lp2";
                    $wp_row = "wp2";
                    $price_row = "prices2";
                    $quantity_row = "quantity2";
                    $price_to_be_updated = ($lp * $wp * $quantity) * $product_price;               
                }
                else if ($product_ids3 == $product_ids_to_be_updated){
                    $lp_row = "lp3";
                    $wp_row = "wp3";
                    $price_row = "prices3";
                    $quantity_row = "quantity3";
                    $price_to_be_updated = ($lp * $wp * $quantity) * $product_price;               
                }
                else{
                    http_response_code(400);
                    throw new Exception("Invalid ID.");
                }

                $query = "UPDATE cart SET $price_row = $price_to_be_updated, $quantity_row = $quantity, $lp_row = $lp, $wp_row = $wp WHERE id='$existing_cart_id'";
                $update_cart_user = $usersdb->conn->prepare($query);
                $update_cart_user->execute();
                $need_to_be_executed = $update_cart_user;            
            }

            else{
                http_response_code(400);
                throw new Exception("Invalid cart!");
            }
            if($need_to_be_executed->execute()){
                    // set error schema
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $productdata=array(
                        "caltulated_price" => $price_to_be_updated,
                    );
                    $response["output"] = $productdata;
                    
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