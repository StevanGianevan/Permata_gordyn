<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $productdb = new ProductDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
    

        // make sure data is not empty
        if(!empty($data->product_id)){
            $product_id = $data->product_id;

            $query = "SELECT * FROM product WHERE id='$product_id'";
            $get_product = $productdb->conn->prepare($query);
            $get_product->execute();

            while ($row = $get_product->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                // $prodprice = number_format($price, 2);
                $productdata=array(
                    "product_id" => $id,
                    "category_id" => $category_id,
                    "name" => $name,
                    "price" => $price,
                    "size" => $size,
                    "colour" => $colour,
                    "description" => $description,
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
            
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Not authorized access");
        }
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