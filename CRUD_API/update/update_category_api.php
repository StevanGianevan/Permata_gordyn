<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../categorydb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();
$price_array = array();

try {
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        $categorydb = new CategoryDb($db);
        $data = json_decode(file_get_contents("php://input"));
        if(!empty($data->id) && (!empty($data->name)) && (!empty($data->description))){
            $id = $data->id;
            $name = $data->name;
            $description = $data->description;

            $query = "UPDATE category SET name='$name', description='$description' WHERE id='$id'";
            $update_category = $categorydb->conn->prepare($query);
            $update_category->execute();
            $update_query_result = $update_category->rowCount();
            // set error schema
            if($update_query_result > 0){
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "Success update category!";
                // set response code - 200 OK
                http_response_code(200);
                
                // show products data in json format
                echo json_encode($response);
            }
            else{
                http_response_code(405);
                throw new Exception("Failed update category");
            }
        
        } else {
            http_response_code(405);
            throw new Exception("ID, NAME, DESCRIPTION is required!");
        }
    }
    else {
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
