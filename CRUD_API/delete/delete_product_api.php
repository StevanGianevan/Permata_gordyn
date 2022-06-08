<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../productdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="DELETE"){
        
        $productdb = new ProductDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->product_id)){
            //end session uji coba
            $product_id = $data->product_id;
            $query = "DELETE FROM product WHERE id='$product_id'";
            $delete_prodcut = $productdb->conn->prepare($query);
            $delete_prodcut->execute();  
            $query_result = $delete_prodcut->rowCount();

            if($query_result == 0){
                http_response_code(404);
                throw new Exception("Failed to delete product.");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "Product succesfully Deleted.";
                // set response code - 201 created
                http_response_code(201);
                // tell the user
                echo json_encode($response);
            }
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Missing product_id field");
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