<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
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
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        $usersdb= new UsersDb($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // make sure data is not empty
        if(!empty($data->id)){
            $id = $data->id;
            $name = $data->name;
            $email = $data->email;
            $address = $data->address;
            $contact = $data->contact;
            $postcode = $data->postcode;
            $currentpassword = md5($data->currentpassword);  
            $newpassword = $data->newpassword;
            $newcpassword = $data->newcpassword;
            $newmd5password = md5($newpassword);
            $query_check = "SELECT * FROM users WHERE id='$id'";
            $get_user = $usersdb->conn->prepare($query_check);
            $get_user->execute();
            $query_result = $get_user->rowCount();

            if($query_result == '0')
            {
                http_response_code(404);
                throw new Exception("ID not found!");
            }
            
            if(!empty($currentpassword) && !empty($newpassword) && !empty($newcpassword)){
                $query_check2 = "SELECT * FROM users WHERE id='$id' and password='$currentpassword'";
                $get_user_password = $usersdb->conn->prepare($query_check2);
                $get_user_password->execute();
                $query_result2 = $get_user_password->rowCount();

                if($query_result2 == '0'){
                    http_response_code(400);
                    throw new Exception("Current password is not correct!");
                }
                else if($newpassword != $newcpassword){
                    http_response_code(400);
                    throw new Exception("Password does not match confirmation password!");
                }
                
                $query = "UPDATE users SET  password='$newmd5password' WHERE id='$id'";
                $update_user = $usersdb->conn->prepare($query);
            }

            else {
                $query = "UPDATE users SET  name='$name', address='$address', email='$email', postcode=$postcode, contact=$contact WHERE id='$id'";
                $update_user = $usersdb->conn->prepare($query);
            }
            
            // register the user
            if($update_user->execute()){
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
                $response["output"] = "User Updated!";
                
                
                // set response code - 201 created
                http_response_code(201);
          
                // tell the user
                echo json_encode($response);
            }
            else{
          
                // set response code - 503 service unavailable
                http_response_code(503);
          
                // tell the user
                throw new Exception("Unable to update product.");
            }
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Please fill all the data");
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