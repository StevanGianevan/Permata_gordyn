<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
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
    if($_SERVER['REQUEST_METHOD']=="PATCH"){
        
        $productdb = new ProductDb($db);
        
        
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // make sure data is not empty
        if(!empty($data->prodid) && !empty($data->update)){
            $prodid = $data->prodid;
            $update = $data->update;

            if($update == "false"){
                $query = "SELECT * FROM product WHERE id='$prodid'";
                $get_product = $productdb->conn->prepare($query);
                $get_product->execute();

                while ($row = $get_product->fetch(PDO::FETCH_ASSOC)){
                    // extract row
                    // this will make $row['name'] to
                    // just $name only
                    extract($row);
                    
                    $productdata=array(
                        "product_id" => $id,
                        "category_id" => $category_id,
                        "name" => $name,
                        "price" => $price,
                        "size" => $size,
                        "colour" => $colour,
                        "description" => $description,
                        "update" => $update
                    );
                    array_push($response["output"], $productdata);
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
            else if ($update == "true"){
                $prodidnew = $data->prodidnew;
                $catid = $data->catid;
                $prodname = $data->prodname;
                $prodprice = $data->prodprice;
                $prodsize = $data->prodsize;
                $prodcolour = $data->prodcolour;
                $proddesc = $data->proddesc;
                //update query
                $query = "UPDATE product SET id='$prodid', category_id=$catid, name='$prodname', price=$prodprice, size='$prodsize', colour='$prodcolour', description='$proddesc' WHERE id='$id'";
                $update_product = $productdb->conn->prepare($query);
                $product_result = $update_product->rowCount();
                if($product_result == 0){
                    http_response_code(405);
                    throw new Exception("Failed to update product");
                }
                else{
                    $error_schema["error_code"] = 0;
                    $error_schema["message"] = "Success";
                    
                    $response["error_schema"] = $error_schema;
                    $response["output"] = "Product updated.";
                    http_response_code(201);
          
                    // tell the user
                    echo json_encode($response);
                }
            }

            
            
            // register the user
            // if($update_product->execute()){
            //     // set error schema
            //     $error_schema["error_code"] = 0;
            //     $error_schema["message"] = "Success";
                
            //     $response["error_schema"] = $error_schema;
            //     $response["output"] = "Product updated.";
                
            //     // $walletId = strtoupper(uniqid());
            //     // init Main Wallet
            //     // $query2 = "INSERT INTO wallets(id, user_id, name, is_main, is_favorite) VALUES('$walletId', '$id', 'Main Wallet', 1, 1)";
            //     // $init_wallet = $walletDto->conn->prepare($query2);
                
            //     // if(!$init_wallet->execute()){
            //     //     http_response_code(404);
            //     //     throw new Exception("Unable to init wallet.");
            //     // }
                
            //     // set response code - 201 created
            //     http_response_code(201);
          
            //     // tell the user
            //     echo json_encode($response);
            // }
            // else{
          
            //     // set response code - 503 service unavailable
            //     http_response_code(503);
          
            //     // tell the user
            //     throw new Exception("Unable to update product.");
            // }
        } else {
            // set response code - 404 Not found
            http_response_code(404);
            throw new Exception("Please fill in product id!");
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