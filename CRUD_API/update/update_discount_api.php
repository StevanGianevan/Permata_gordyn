<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../discountdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        $discountdb = new DiscountDB($db);
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->discount_id)){
            $discount_id = $data->discount_id;
            $discount_percentage = $data->percentage;
            $discount_name = $data->name;
            
            $arr = explode(' ',trim($discount_name));
            $first_name = $arr[0];
            $discount_code = strtoupper($first_name.$discount_percentage);

            if ($data->active == 'FALSE'){
                $active = "TRUE";
            }
            else {
                $active = "FALSE";
            }

            $update_disc_query = "UPDATE discount SET code='$discount_code', name='$discount_name', percentage=$discount_percentage, active='$active' WHERE id='$discount_id'";
            $update_discount= $discountdb->conn->prepare($update_disc_query);
            $update_discount->execute();
            $query_results = $update_discount->rowCount();

            if($query_results == 0){
                http_response_code(405);
                throw new Exception("Activate Discount Error!");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                $response["error_schema"] = $error_schema;
                $response["output"] = "Successfully Activate Discount!";
                http_response_code(201);
                echo json_encode($response);
            }
        } else {
            throw new Exception("Missing some requirement fields");
        }
    } else {
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

