<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../categorydb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $categorydb = new CategoryDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->name) && !empty($data->description)){
            $id = "CAT-".strtoupper(uniqid());
            $name = $data->name;
            $description = $data->description;
            
            //check if email exists
            $query = "INSERT INTO category (id, name, description) VALUE('$id', '$name', '$description')";
            $add_category = $categorydb->conn->prepare($query);
            $add_category->execute();
            $query_result = $add_category->rowCount();

            if ($query_result == 1){
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                $response["error_schema"] = $error_schema;
                $response["output"] = "Category Added.";
                http_response_code(201);
                echo json_encode($response);
            }
            else {
                http_response_code(400);
                throw new Exception("Cannot add category!.");
            }

        } else {
            // send error missing some requirement fields
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

