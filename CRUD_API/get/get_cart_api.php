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
            $query = "SELECT * FROM cart WHERE user_id ='$user_id'";
            $get_product_cart = $cartdb->conn->prepare($query);
            $get_product_cart->execute();
            
            $query_result = $get_product_cart->rowCount();
            
            if($query_result > 0){
                while ($row = $get_product_cart->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['name'] to
                    // just $name only
                    extract($row);
            
                    $product_get_cart = $product_ids;
                    // $response["output"] = $product_get_cart;
                }

                $query = "SELECT * FROM product WHERE id =$product_get_cart";
                $get_product = $productdb->conn->prepare($query);
                $get_product->execute();
                
                $query_result = $get_product->rowCount();

                if($query_result > 0){
                    while ($row = $get_product->fetch(PDO::FETCH_ASSOC)){
                        // extract row
                        // this will make $row['name'] to
                        // just $name only
                        extract($row);
                
                        $productdata=array(
                            "name" => $name,
                            "price" => $price,
                            "size" => $size,
                            "colour" => $colour,
                            "image1" => $image1
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
                        
                   
                } else{
                    http_response_code(400);
                    throw new Exception("Product not found");
                }

                
            } else {
                http_response_code(200);
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
