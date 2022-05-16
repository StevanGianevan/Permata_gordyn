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
            $cpassword = md5($data->cpassword);

            //check if email exists
            $duplicate = "SELECT * FROM users WHERE email = '$email'";
            $get_user = $usersdb->conn->prepare($duplicate);
            $get_user->execute();
        
            $query_result = $get_user->rowCount();
        
            if($data->password != $data->cpassword)
            {
                //send error password does not match confirmation password
                echo json_encode(array("statusMessage"=>201));
                throw new Exception("Password does not match confirmation password!");
            }
            else if ($query_result > 0){
                //send error email already exist in database!
                echo json_encode(array("statusMessage"=>202));
                throw new Exception("Email already exist!");
            }
            else{
                $query = "INSERT INTO users (id, email, name, password)VALUE('$id', '$email', '$name', '$password')";
                $register_user = $usersdb->conn->prepare($query);
                
                // register the user
                if($register_user->execute()){
                    // set error schema
                    echo json_encode(array("statusMessage"=>201));
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Successfully created new user!";
                    
                    // $walletId = strtoupper(uniqid());
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
            }
           
        } else {
            // send error missing some requirement fields
            throw new Exception("Missing some requirement fields");
            
        }
    } else {
        // set response code - 404 Not found
        http_response_code(404);
        throw new Exception("Error 404 request denied!");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
    // tell the user no products found
    echo json_encode(array("statusMessage"=>202));
    echo json_encode(
        array(
            "error_schema" => $error_schema,
            "output"=> $e-> getMessage()
        )
    );
    
    die();
}

?>
<script>
    Response.write ("<script language=""javascript"" id=""runscript"" name =""runscript"">" & VbCrLf )
    Response.Write ("var " & arrJS & "= new Array(" )

</script>
