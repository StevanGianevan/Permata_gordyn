<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
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
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $discountdb = new DiscountDB($db);
        
        $query = "SELECT * FROM discount";
        $get_discount = $discountdb->conn->prepare($query);
        $get_discount->execute();
        $query_result = $get_discount->rowCount();
        if($query_result > 0){
            while ($row = $get_discount->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $discount_percentage = $percentage;
                $discountdata=array(
                    "id" => $id,
                    "code" => $code,
                    "name" => $name,
                    "percentage" =>$percentage,
                    "description" =>$description,
                    "active" =>$active
                );
                array_push($response["output"], $discountdata);
            }

            // if(!empty($data->return_discount_price)){
            //     if ($data->return_discount_price == "true"){
            //         $discount_amount = $discount_percentage / 100 
            //         $discountdata=array(
            //             "discount_amount" => $discount_amount,
            //         );
            //         array_push($response['output'], $discountdata);
            //     }
            // }


            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            $response["error_schema"] = $error_schema;
            http_response_code(200);
            echo json_encode($response);
        } else {
            throw new Exception("Data not Found!!!");
        }
    } else {
        http_response_code(405);
        throw new Exception("Method not allowed!");
    }
} catch(Exception $e) {
    $error_schema["error_code"] = 1;
    $error_schema["message"] = "Failed";
    echo json_encode(
        array(
            "error_schema" => $error_schema,
            "output"=> $e-> getMessage()
        )
    );
    die();
}

?>

