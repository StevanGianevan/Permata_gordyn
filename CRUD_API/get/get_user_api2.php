<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $usersdb = new UsersDb($db);
        $data = json_decode(file_get_contents("php://input"));
        

        if(!empty($data->user_name)){
            $user_name = $data->user_name;
            $query = "SELECT * FROM users WHERE name like '%$user_name%' ";
            $get_user_name = $usersdb->conn->prepare($query);
            $get_user_name->execute();
            $query_result = $get_user_name->rowCount();
            if($query_result > 0){
                while ($row = $get_user_name->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $usernamedata=array(
                        "id" => $id,
                        "role" => $role,
                        "name" => $name,
                        "address" => $address,
                        "email" => $email,
                        "contact" => $contact,
                        "postcode" => $postcode
                    );
                    array_push($response["output"], $usernamedata);
                }
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";

                $response["error_schema"] = $error_schema;
                // set response code - 200 OK
                http_response_code(200);
              
                // show products data in json format
                echo json_encode($response);
            }
            else{
                http_response_code(400);
                throw new Exception("User not found");
            }
        }
        else if(!empty($data->user_id)){
            $user_id = $data->user_id;
            $query = "SELECT * FROM users WHERE id ='$user_id'";
            $get_user = $usersdb->conn->prepare($query);
            $get_user->execute();
            $query_result = $get_user->rowCount();
            if($query_result > 0){
                while ($row = $get_user->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $usersdata=array(
                        "id" => $id,
                        "role" => $role,
                        "name" => $name,
                        "address" => $address,
                        "email" => $email,
                        "password" => $password,
                        "contact" => $contact,
                        "postcode" => $postcode
                    );
                    array_push($response["output"], $usersdata);
                }
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";

                $response["error_schema"] = $error_schema;
                // set response code - 200 OK
                http_response_code(200);
              
                // show products data in json format
                echo json_encode($response);
            }
            else{
                http_response_code(400);
                throw new Exception("User not found");
            }
        }
            
        else{
            http_response_code(400);
            throw new Exception("Need to provide user id.");
        }
    } else {
        throw new Exception("Method not allowed.");
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
