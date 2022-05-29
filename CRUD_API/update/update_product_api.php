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
        // // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // $prodid = $_POST['prodid'];
        // $prodidnew = $_POST['prodidnew'];
        // $catid = $_POST['catid'];
        // $prodname = $_POST['prodname'];
        // $prodprice = $_POST['prodprice'];
        // $prodcolour = $_POST['prodcolour'];
        // $prodsize = $_POST['prodsize'];
        // $proddesc = $_POST['proddesc'];

        // $fileName= $_FILES['prodimage1']['name'];
        // $fileTmpName= $_FILES['prodimage1']['tmp_name'];
        // $fileSize= $_FILES['prodimage1']['size'];
        // $fileError= $_FILES['prodimage1']['error'];
        // $fileType= $_FILES['prodimage1']['type'];
        // $fileExt = explode('.', $fileName);
        // $fileActualExt = strtolower(end($fileExt));
        // $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        // make sure data is not empty
        if(!empty($data->prodidbefore)){
        

            //update query
            $prodidbefore = $data->prodidbefore;
            $prodidnew = $data->prodidnew;
            $catid = $data->catid;
            $prodname = $data->prodname;
            $prodprice = $data->prodprice;
            $prodcolour = $data->prodcolour;
            $prodsize = $data->prodsize;
            $proddesc = $data->proddesc;
            // $productUrl="http://localhost/PermataGordynMain/CRUD_API/media/".$fileNameNew;
            $query = "UPDATE product SET id='$prodidnew', category_id=$catid, name='$prodname', price=$prodprice, size='$prodsize', colour='$prodcolour', description='$proddesc'
            WHERE id='$prodidbefore'";
            $update_product = $productdb->conn->prepare($query);            
            $update_product->execute();  
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