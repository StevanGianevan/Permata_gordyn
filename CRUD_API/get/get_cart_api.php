<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../cartdb.php";
include_once "../productdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $cartdb = new CartDb($db);
        $productdb = new ProductDb($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or not
        if(!empty($data->user_id)){
            $user_id = $data->user_id;
            $query = "SELECT cart3.id AS cart_id, cart3.product_id, cart3.pp, cart3.lp, product.name, cart3.price as cart_price, product.image1, cart3.quantity FROM cart3 JOIN product ON product.id = cart3.product_id WHERE cart3.user_id ='$user_id' AND cart3.status='AVAILABLE'";
            $get_product_cart = $cartdb->conn->prepare($query);
            $get_product_cart->execute();
            
            $query_result = $get_product_cart->rowCount();
            
            
            if($query_result > 0){
                while ($row = $get_product_cart->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['name'] to
                    // just $name only
                    extract($row);
                    $cartprice = number_format($cart_price, 2);
                    $productdata=array(
                        "cart_id" => $cart_id,
                        "product_id" => $product_id,
                        "price" => $cartprice,
                        "name" => $name,
                        "image1" => $image1,
                        "pp" => $pp,
                        "lp" => $lp,
                        "quantity" => $quantity
                    );
                    array_push($response["output"], $productdata);
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
            http_response_code(400);
            throw new Exception("Missing UserID Field");
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
