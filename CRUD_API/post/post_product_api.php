<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../productdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $productdb = new ProductDb($db);

        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        
        // make sure data is not empty
        if(!empty($data->prodid) && !empty($data->catid) && !empty($data->prodname)){
            $prodid = $data->prodid;
            $catid = $data->catid;
            $prodname = $data->prodname;
            $prodprice = $data->prodprice;
            $prodcolour = $data->prodcolour;
            $prodsize = $data->prodsize;
            $proddesc = $data->proddesc;

            //check if email exists
            $duplicate = "SELECT * FROM product WHERE id= '$prodid'";
            $get_product = $productdb->conn->prepare($duplicate);
            $get_product->execute();
            $query_result = $get_product->rowCount();

            if($query_result > 0){
                http_response_code(405);
                throw new Exception("Product with that id already Existed!");
            }
            else{
                $query = "INSERT INTO product (id, category_id, name, price, size, colour, description)VALUE('$prodid', $catid, '$prodname', $prodprice, '$prodsize', '$prodcolour', '$proddesc')";
                $add_product= $productdb->conn->prepare($query);
                $add_product->execute();
                $product_result = $add_product->rowCount();

                if($product_result == 0){
                    http_response_code(405);
                    throw new Exception("Something went wrong inserting new product!");
                }
                else{
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Successfully added new product!";
                   
                    http_response_code(201);
                    
                    echo json_encode($response);
                }
            }
        
            // $query_result = $get_product->rowCount();
            
            // if($data->password != $data->cpassword)
            // {
            //     //send error password does not match confirmation password
            //     // echo json_encode(array("statusMessage"=>201));
            //     http_response_code(400);
            //     throw new Exception("Password does not match confirmation password!");
            // }
            // else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            //     http_response_code(400);
            //     throw new Exception("Please enter the correct email format!");
            // }
            // else if ($query_result > 0){
            //     //send error email already exist in database!
            //     // echo json_encode(array("statusMessage"=>202));
            //     http_response_code(400);
            //     throw new Exception("Email already exist!");
            // }
            // else{
            //     $query = "INSERT INTO users (id, email, name, password)VALUE('$id', '$email', '$name', '$password')";
            //     $register_user = $usersdb->conn->prepare($query);
                
            //     // register the user
            //     if($register_user->execute()){
            //         // set error schema
            //         // echo json_encode(array("statusMessage"=>201));
            //         $error_schema["error_code"] = 0;
            //         $error_schema["message"] = "Success";
                    
            //         $response["error_schema"] = $error_schema;
            //         $response["output"] = "Successfully created new user!";
                    
            //         // $walletId = strtoupper(uniqid());
            //         // init Main Wallet
            //         // $query2 = "INSERT INTO wallets(id, user_id, name, is_main, is_favorite) VALUES('$walletId', '$id', 'Main Wallet', 1, 1)";
            //         // $init_wallet = $walletDto->conn->prepare($query2);
                    
            //         // if(!$init_wallet->execute()){
            //         //     http_response_code(404);
            //         //     throw new Exception("Unable to init wallet.");
            //         // }
                    
            //         // set response code - 201 created
            //         http_response_code(201);
            //         // tell the user
            //         echo json_encode($response);
            //     }
            //     else{
          
            //         // set response code - 503 service unavailable
            //         http_response_code(500);
              
            //         // tell the user
            //         throw new Exception("Unable to register user.");
            //     }
            // }
           
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

