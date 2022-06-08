<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $reviewdb = new ReviewDB($db);
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->user_id) && !empty($data->product_id) && !empty($data->invoice_id) && !empty($data->description)){
            $review_id = "REV-".strtoupper(uniqid());
            $user_id = $data->user_id;
            $product_id = $data->product_id;
            $description = $data->description;
            $invoice_id = $data->invoice_id;
            
            $check_existing_review_query = "SELECT id FROM review WHERE user_id = '$user_id' AND product_id = '$product_id' AND invoice_id = '$invoice_id'";
            $check_existing_review= $reviewdb->conn->prepare($check_existing_review_query);
            $check_existing_review->execute();
            $check_existing_review_query_results = $check_existing_review->rowCount();
            if ($check_existing_review_query_results == 1){
                while ($row = $check_existing_review->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $existing_review_id = $id;
                }
                $update_review_query = "UPDATE review SET description = '$description' WHERE id='$existing_review_id'";
                $update_review= $reviewdb->conn->prepare($update_review_query);
                $update_review->execute();
                $query_results = $update_review->rowCount();
            }
            else{
                $query = "INSERT INTO review (id, user_id, product_id, invoice_id, description)VALUE('$review_id', '$user_id', '$product_id', '$invoice_id', '$description')";
                $add_review= $reviewdb->conn->prepare($query);
                $add_review->execute();
                $query_results = $add_review->rowCount();
            }



            if($query_results == 0){
                http_response_code(405);
                throw new Exception("Review Error!");
            }
            else{
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                $response["error_schema"] = $error_schema;
                $response["output"] = "Successfully added review!";
                http_response_code(201);
                echo json_encode($response);
            }
           
        } else {
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

