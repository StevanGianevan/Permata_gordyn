<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $wishlistdb = new WishlistDb($db);
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->user_id) && !empty($data->product_id)){
            $wishlist_id = "WISH-".strtoupper(uniqid());
            $user_id = $data->user_id;
            $product_id = $data->product_id;
            
            $check_existing_wishlist_query = "SELECT id FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $check_existing_wishlist= $wishlistdb->conn->prepare($check_existing_wishlist_query);
            $check_existing_wishlist->execute();
            $check_existing_wishlist_query_results = $check_existing_wishlist->rowCount();
            if ($check_existing_wishlist_query_results == 1){
                http_response_code(400);
                throw new Exception("Item already in your Wishlist");
            }
            else{
                $query = "INSERT INTO wishlist (id, user_id, product_id)VALUE('$wishlist_id', '$user_id', '$product_id')";
                $add_wishlist= $wishlistdb->conn->prepare($query);
                $add_wishlist->execute();
                $query_results = $add_wishlist->rowCount();
            }

            if($query_results == 0){
                http_response_code(405);
                throw new Exception("Failed to add Wishlist");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                $response["error_schema"] = $error_schema;
                $response["output"] = "Successfully added to Wishlist!";
                http_response_code(201);
                echo json_encode($response);
            }
           
        } else {
            throw new Exception("Missing some requirement fields");
        }
    } else {
        // set response code - 404 Not found
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

