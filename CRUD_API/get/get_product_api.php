<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../productdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $productDb = new ProductDb($db);
        $headers = apache_request_headers();
        
        $query = "SELECT product.id, product.name, product.price, product.category_id, product.size, product.colour, product.image1, product.description, category.id as real_category_id, category.name as category_name
        FROM product JOIN category ON category.id = product.category_id";
        
        $get_product = $productDb->conn->prepare($query);
        $get_product->execute();
        // $query_result = $get_product->rowCount();
        $query_result = $get_product->rowCount();
        
        if($query_result > 0){
            while ($row = $get_product->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                $prodprice = number_format($price, 2);
                $productdata=array(
                    "id" => $id,
                    "name" => $name,
                    "price" => $prodprice,
                    "category_id" => $category_id,
                    "category_name" => $category_name,
                    "size" => $size,
                    "colour" => $colour,
                    "image1" => $image1,
                    "description" =>$description
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
