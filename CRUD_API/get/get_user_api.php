<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../usersdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $usersdb = new UsersDb($db);
        $headers = apache_request_headers();
        
        // check header request
        if(array_key_exists("id", $headers)==false){
            throw new Exception("Missing mandatory field");
        }
        
        // $userId = $_GET['userId'];
        $userId = $headers["id"];
        // input request validation
        if($userId == null){
            throw new Exception("Missing mandatory field");
        }
        
        $query = "SELECT * FROM users 
        WHERE id='$userId'";
        
        $get_user = $usersdb->conn->prepare($query);
        $get_user->execute();
        
        $query_result = $get_user->rowCount();
        
        if($query_result > 0){
            while ($row = $get_user->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
          
                $userdata=array(
                    "id" => $id,
                    "name" => $name,
                    "email" => $email
                );
          
                $response["output"] = $userdata;
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
