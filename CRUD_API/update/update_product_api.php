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
        // // get posted data
        $prodidbefore = $_POST['prodidbefore'];
        $prodidnew = $_POST['prodidnew'];
        $catid = $_POST['catid'];
        $prodname = $_POST['prodname'];
        $prodprice = $_POST['prodprice'];
        $prodcolour = $_POST['prodcolour'];
        $prodsize = $_POST['prodsize'];
        $proddesc = $_POST['proddesc'];
        $bool_image = $_POST['bool_image'];

        if ($bool_image == 'true') { 
            $fileName= $_FILES['prodimage1']['name'];
            $fileTmpName= $_FILES['prodimage1']['tmp_name'];
            $fileSize= $_FILES['prodimage1']['size'];
            $fileError= $_FILES['prodimage1']['error'];
            $fileType= $_FILES['prodimage1']['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
            
            if(in_array($fileActualExt, $allowed))
            {
                if($fileError === 0)
                {
                    if($fileSize <1000000)
                    {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "../media/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        
                    }else{
                        http_response_code(405);
                        throw new Exception("Your file is too large!");
                    }

                }else{
                    http_response_code(405);
                    throw new Exception("there was an error uploading your file");
                }
            }else{
                http_response_code(405);
                throw new Exception("You cannot upload files of this type!");
            }
            
            $productUrl="http://localhost/PermataGordynMain/CRUD_API/media/".$fileNameNew;
            $query = "UPDATE product SET id='$prodidnew', category_id='$catid', name='$prodname', price=$prodprice, size='$prodsize', colour='$prodcolour', description='$proddesc', image1='$productUrl'
            WHERE id='$prodidbefore'";
        } 
        else{
            $query = "UPDATE product SET id='$prodidnew', category_id='$catid', name='$prodname', price=$prodprice, size='$prodsize', colour='$prodcolour', description='$proddesc'
            WHERE id='$prodidbefore'";
        }
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