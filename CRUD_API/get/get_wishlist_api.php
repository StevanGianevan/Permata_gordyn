<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../wishlistdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $wishlistdb = new WishlistDb($db);
        $query_wishlist = "SELECT wishlist.id, wishlist.user_id, wishlist.product_id, wishlist.created_date, product.name as product_name, product.image1 as product_img, product.description as product_description, product.price as product_price
        FROM wishlist JOIN product ON product.id = wishlist.product_id";
        $get_wishlist = $wishlistdb->conn->prepare($query_wishlist);
        $get_wishlist->execute();
        $query_result = $get_wishlist->rowCount();
        
        if($query_result > 0){
            while ($row = $get_wishlist->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $wishlist_data=array(
                    "id" => $id,
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "created_date" => $created_date,
                    "product_name" => $product_name,
                    "product_img" => $product_img,
                    "product_description" => $product_description,
                    "product_price" => $product_price

                );
        
                array_push($response["output"], $wishlist_data);
            }
            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            $response["error_schema"] = $error_schema;
            http_response_code(200);
            echo json_encode($response);
        }
        else {
            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            $response["error_schema"] = $error_schema;
            http_response_code(200);
            echo json_encode($response);
        }
    } else {
        http_response_code(405);
        throw new Exception("Method not allowed!");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
    // tell the user no products found
    echo json_encode(
        array(
            "error_schema" => $error_schema,
            "output"=> $e-> getMessage()
        )
    );
    
    die();
}

?>

