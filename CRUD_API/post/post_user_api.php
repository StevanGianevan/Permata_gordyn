<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $usersdb = new UsersDb($db);
        
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        
        // make sure data is not empty
        if(!empty($data->name) && !empty($data->email) && !empty($data->password)){
            $id = strtoupper(uniqid());
            $name = $data->name;
            $email = $data->email;
            $password = md5($data->password);
            
            $query = "INSERT INTO users (id, email, name, password)VALUE('$id', '$email', '$name', '$password')";
            $register_user = $usersdb->conn->prepare($query);
            
            // register the user
            if($register_user->execute()){
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "User was registered.";
                
                $walletId = strtoupper(uniqid());
                // init Main Wallet
                // $query2 = "INSERT INTO wallets(id, user_id, name, is_main, is_favorite) VALUES('$walletId', '$id', 'Main Wallet', 1, 1)";
                // $init_wallet = $walletDto->conn->prepare($query2);
                
                // if(!$init_wallet->execute()){
                //     http_response_code(404);
                //     throw new Exception("Unable to init wallet.");
                // }
                
                // set response code - 201 created
                http_response_code(201);
          
                // tell the user
                echo json_encode($response);
            }
            else{
          
                // set response code - 503 service unavailable
                http_response_code(503);
          
                // tell the user
                throw new Exception("Unable to register user.");
            }
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Missing mandatory field");
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