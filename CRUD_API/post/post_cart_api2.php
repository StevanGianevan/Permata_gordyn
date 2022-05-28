<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../connection.php";
include_once "../cart3db.php";
include_once "../productdb.php";
include_once "../usersdb.php";
include_once "../invoicedb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"] = array();
$error_schema = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $cartdb= new Cart3Db($db);
        $productdb = new ProductDb($db);
        $usersdb = new UsersDb($db);
        $invoicedb = new InvoiceDB($db);
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->product_id) && !empty($data->user_id)){
            //end session uji coba
            $quantity = 1;
            $product_id = $data->product_id;
            $cart_id = strtoupper(uniqid());
            $user_id = $data->user_id;
            $create_date = (isset($data->create_date) ? $data->create_date : false);
            $modified_date = (isset($data->modified_date) ? $data->modified_date : false);

            $query = "SELECT * FROM cart3 WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $cart_product = $cartdb->conn->prepare($query);
            $cart_product->execute();
            $query_result = $cart_product->rowCount();
            if($query_result > 0){
                while ($row = $cart_product->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $query = "UPDATE cart3 SET quantity = quantity+1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
                    $update_cart_quantity = $usersdb->conn->prepare($query);
                    $need_to_be_executed = $update_cart_quantity;
                }
            }
            else{
                $query_product = "SELECT price FROM product WHERE id = '$product_id'";
                $get_product = $cartdb->conn->prepare($query_product);
                $get_product->execute();
                $query_result = $get_product->rowCount();
                if($query_result > 0){
                    while ($row = $get_product->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $product_price = $price;
                    }
                    $query = "INSERT INTO cart3 (id, user_id, product_id, quantity, pp, lp, price)VALUE('$cart_id', '$user_id', '$product_id', '$quantity', 1, 1, $product_price)";
                    $create_cart = $cartdb->conn->prepare($query);
                    $need_to_be_executed = $create_cart;
                }

                $invoice_check_query = "SELECT * FROM invoices WHERE user_id = '$user_id'";
                $check_invoice = $invoicedb->conn->prepare($invoice_check_query);
                $check_invoice->execute();
                $query_invoice_result = $check_invoice->rowCount();
                if($query_invoice_result == 0){
                    $invoice_id = "INV-".strtoupper(uniqid());
                    $create_query_invoices = "INSERT INTO invoices (id, user_id, status) VALUE('$invoice_id', '$user_id', 'UNPAID')";
                    $create_invoice = $invoicedb->conn->prepare($create_query_invoices);
                    $create_invoice->execute();
                    $create_invoice_result = $create_invoice->rowCount();

                    if($create_invoice_result == 0){
                        http_response_code(404);
                        throw new Exception("Create Invoice Failed.");
                    }
                }
            }    

            
            if($need_to_be_executed->execute()){
                    // set error schema
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Added to Cart";
                    
                    // set response code - 201 created
                    http_response_code(201);
                    
                    // tell the user
                    echo json_encode($response);
            }
            else{
            
                // set response code - 503 service unavailable
                http_response_code(503);
            
                // tell the user
                throw new Exception("Unable to add cart.");
            }
            
            // register the user
            
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