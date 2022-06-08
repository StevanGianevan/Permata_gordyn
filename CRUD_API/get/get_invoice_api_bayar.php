<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once "../connection.php";
include_once "../cartdb.php";
include_once "../productdb.php";
include_once "../invoicedb.php";

$database = new Database();
$db = $database->getConnection();

$response = array();
$response["error_schema"]=array();
$response["output"]=array();
$error_schema = array();
$price_array = array();

try {
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $cartdb = new CartDb($db);
        $productdb = new ProductDb($db);
        $invoicedb = new InvoiceDB($db);
        $data = json_decode(file_get_contents("php://input"));
        //check request empty or not
        if(!empty($data->user_id)){
            $user_id = $data->user_id;

            if(!empty($data->invoice_id)){
                $invoice_id = $data->invoice_id;
                $query_invoice_data = "SELECT metode_pembayaran FROM invoices WHERE id = '$invoice_id'";
                $query_invoice_data = $invoicedb->conn->prepare($query_invoice_data);
                $query_invoice_data->execute();
                while ($row = $query_invoice_data->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $metode_pembayaran = $metode_pembayaran;
                }
            }
            else {
                $query_invoice_id = "SELECT id, metode_pembayaran FROM invoices WHERE user_id = '$user_id' AND status='IN_PROCESS'";
                $query_invoice_id = $invoicedb->conn->prepare($query_invoice_id);
                $query_invoice_id->execute();
                while ($row = $query_invoice_id->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $invoice_id = $id;
                    $metode_pembayaran = $metode_pembayaran;
                }
            }

            $query = "SELECT * FROM cart3 WHERE invoice_id='$invoice_id'";
            $get_cart = $cartdb->conn->prepare($query);
            $get_cart->execute();
            $query_result = $get_cart->rowCount();
            if($query_result > 0){
                while ($row = $get_cart->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $cart_data=array(
                        "price" => $price,
                    );
                    array_push($price_array, $cart_data);
                }
                $total_price = 0;
                foreach($price_array as $array){
                    foreach($array as $key=>$value){
                        $total_price += $value;
                    }
                }
                $total_price = number_format($total_price, 2);
                // set error schema
                $error_schema["error_code"] = 0;
                $error_schema["message"] = "Success";
                
                $response["error_schema"] = $error_schema;
              
                // set response code - 200 OK
                http_response_code(200);
              
                // show products data in json format
                $invoice_data=array(
                    "total_price" => $total_price,
                    "metode_pembayaran" => $metode_pembayaran
                );
                session_start();
                $_SESSION['total_price'] = $total_price;
                array_push($response['output'], $invoice_data);
                echo json_encode($response);
                
            } else {
                throw new Exception("Data not found");
            }
        
        } else {
            http_response_code(400);
            throw new Exception("Missing UserID Field");
        }
        
    } else {
        http_response_code(405);
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
