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
        
        // if(empty($data->email) && empty($data->password)){
        //     throw new Exception("Missing mandatory field");
        // }
        // check header request
        // if("email", $headers)==false){
        //     throw new Exception("Missing email");
        // }
        // else if(array_key_exists("password", $headers)==false){
        //     throw new Exception("Missing password");
        // }
        
        // $email = $_GET['email'];
        
        $email = $data->email;
        $password = $data->password;
        $realpwd = md5($password);
        // input request validation
        if($email == null){
            throw new Exception("Missing email");
        }
        else if($password == null){
            throw new Exception("Missing password");
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                http_response_code(400);
                throw new Exception("Email is not correct!");
        }
        $query = "SELECT * FROM users WHERE email='$email' and password='$realpwd'";
        
        $get_user = $usersdb->conn->prepare($query);
        $get_user->execute();
        
        $query_result = $get_user->rowCount();
        
        if($query_result > 0){
            $sessionEmail = "";
            $sessionName = "";
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
                $sessionEmail = $email;
                $sessionName = $name;
                $sessionId = $id;
                $address = $address;
                $contact = $contact;
                $postcode = $postcode;
                $response["output"] = $userdata;
            }
            
            // set error schema
            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            
            $response["error_schema"] = $error_schema;
            session_start();
            $_SESSION['email']=$sessionEmail;
			$_SESSION['name']=$sessionName;
            $_SESSION['id']=$sessionId;
            $_SESSION['address']=$address;
            $_SESSION['contact']=$contact;
            $_SESSION['postcode']=$postcode;
            
            // set response code - 200 OK
            http_response_code(200);
          
            // show products data in json format
            echo json_encode($response);
            
        } else {
            http_response_code(400);
            throw new Exception("Invalid Email or Password!");
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
