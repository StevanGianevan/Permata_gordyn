<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../reviewdb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="GET"){
        $reviewdb = new ReviewDB($db);
        $query_review = "SELECT * FROM review";
        $get_review = $reviewdb->conn->prepare($query_review);
        $get_review->execute();
        $query_result = $get_review->rowCount();
        
        if($query_result > 0){
            while ($row = $get_review->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $review_data=array(
                    "id" => $id,
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "invoice_id" => $invoice_id,
                    "description" => $description,
                    "created_date" => $created_date
                );
          
                array_push($response["output"], $review_data);
            }
            $error_schema["error_code"] = 0;
            $error_schema["message"] = "Success";
            $response["error_schema"] = $error_schema;
            http_response_code(200);
            echo json_encode($response);
        } else {
            throw new Exception("Data not found");
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

