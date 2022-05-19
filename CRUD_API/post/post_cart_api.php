<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../cartdb.php";
include_once "../productdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

$product_price = 0;
$quantity = 1;

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $cartdb= new CartDb($db);
        $productdb = new ProductDb($db);
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        
        // make sure data is not empty
        if(!empty($data->product_ids) && !empty($data->user_id)){
            $id = strtoupper(uniqid());
            $user_id = $data->user_id;
            $product_ids = $data->product_ids;
            $create_date = (isset($data->create_date) ? $data->create_date : false);
            $modified_date = (isset($data->modified_date) ? $data->modified_date : false);

            $query = "SELECT * FROM product WHERE id='$product_ids'";
        
            $get_product_data = $productdb->conn->prepare($query);
            $get_product_data->execute();
            
            
            while ($row = $get_product_data->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                
                $product_price = $price;
            }
            


            $query = "INSERT INTO cart (id, user_id, product_ids, prices, quantity, total_prices)VALUE('$id', '$user_id', $product_ids, $product_price, $quantity, $product_price)";
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