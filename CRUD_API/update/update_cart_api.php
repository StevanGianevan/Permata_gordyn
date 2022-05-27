<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
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
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        
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
            $query = "SELECT cart3.id AS cart_id, cart3.product_id, product.name, product.price as product_price, product.image1, cart3.quantity
            FROM cart3 JOIN product ON product.id = cart3.product_id WHERE cart3.user_id ='$user_id' AND product.id = '$product_id'";
            $update_cart_user = $usersdb->conn->prepare($query);
            $update_cart_user->execute();  
            $query_result = $update_cart_user->rowCount();
        
            if($query_result == 1){
                $pp = $data->pp;
                $lp = $data->lp;
                $newquantity = $data->quantity;

                while ($row = $update_cart_user->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['name'] to
                    // just $name only
                    extract($row);
                }
                $price_after_calculation = ($pp * $lp * $product_price) * $newquantity;
                $query = "UPDATE cart3 SET pp=$pp, lp=$lp, quantity = $newquantity, price=$price_after_calculation WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $update_cart = $cartdb->conn->prepare($query);
                $update_cart->execute();  
                $query_result = $update_cart->rowCount();
                
                if($query_result = 0)
                {
                    http_response_code(400);
                    throw new Exception("Failed to update cart!");
                }
                else{
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $cart_data=array(
                        "cart_id" => "Success Calculating Price",
                        "price_after_calculation" => $price_after_calculation
                    );

                    $response["error_schema"] = $error_schema;
                    $response["output"] = $cart_data;
                    
                    // set response code - 201 created
                    http_response_code(201);
                    
                    // tell the user
                    echo json_encode($response);
                }
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