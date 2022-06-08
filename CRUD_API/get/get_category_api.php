<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
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

try {
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $categorydb = new CategoryDb($db);
        if(!empty($data->category_id)){
            $query = "SELECT * FROM category WHERE id=$category_id";
        }
        else{
            $query = "SELECT * FROM category";
        }
        $get_category = $categorydb->conn->prepare($query);
        $get_category->execute();
        $query_result = $get_category->rowCount();
        if($query_result > 0){
            while ($row = $get_category->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $categorydata=array(
                    "id" => $id,
                    "name" => $name,
                    "description" =>$description
                );
          
                array_push($response["output"], $categorydata);
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
