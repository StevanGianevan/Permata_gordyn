<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../usersdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="DELETE"){
        $usersdb = new UsersDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->user_id)){
            //end session uji coba
            $user_id = $data->user_id;
            $query = "DELETE FROM users WHERE id='$user_id'";
            $delete_user = $usersdb->conn->prepare($query);
            $delete_user->execute();  
            $query_result = $delete_user->rowCount();

            if($query_result == 0){
                http_response_code(404);
                throw new Exception("Failed to delete user.");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "User succesfully Deleted.";
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