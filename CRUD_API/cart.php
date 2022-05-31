<?php 
session_start();
// include "Model/productModel.php";
if (!isset($_SESSION['email'])){
    header("location: signIn.php");
}
// HTTP REQUEST TO API
$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_cart_api.php';
// Create a new cURL resource
$ch = curl_init($url);
// Setup request to send json via POST
$user_id = $_SESSION['id'];
$payload = json_encode(array("user_id" => $user_id));
// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Execute the POST request
$result = curl_exec($ch);
// Close cURL resource
curl_close($ch);
$my_array = array();
$data = json_decode($result, true);
// Get Invoice data
$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_invoice_api.php';
// Create a new cURL resource
$ch = curl_init($url);
// Setup request to send json via POST
$payload = json_encode(array("user_id" => $user_id));
// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Execute the POST request
$result = curl_exec($ch);
// Close cURL resource
curl_close($ch);
$my_array = array();
$invoice_data = json_decode($result, true);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Permata Gordyn | Login Page</title>
</head>

<body>
    <?php include "header.php" ?>
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Cart</h5>
                </div>
                <div class="card-body">
                <?php foreach ($data['output'] as $row) { ?> 
                        <!-- Single item -->
                        <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                            <!-- Image -->
                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                            <img src="<?php echo $row['image1']?>" width="150" height="100">
                            <a href="#!">
                                <div class="mask" style="background-color: black"></div>
                            </a>
                            </div>
                            <!-- Image -->
                        </div>

                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                            <!-- Data -->
                            <p><strong><?php echo $row['name']?></strong></p>
                            <button id="<?php echo $row['product_id']?>" type="button" class="btn btn-primary btn-sm me-1 mb-2 removebutton" data-mdb-toggle="tooltip"
                            title="Remove item">
                            <i class="fas fa-trash"></i>
                            </button>
                            
                            <!-- Data -->
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <!-- Quantity -->
                            <form id="<?php echo $row['product_id'] ?>" action="" name="formprd" class="form" method="POST">
                            <div class="d-flex mb-4" style="max-width: 300px">
                                <label class="form-label" for="form1">Panjang</label>
                                <input id="panjang_id_<?php echo trim($row['product_id'])?>" min="0" name="panjang" type="number" class="form-control" value="<?php echo $row['pp'] ?>" />
                                <label class="form-label" for="form1">Lebar</label>
                                <input id="lebar_id_<?php echo trim($row['product_id'])?>" min="0" name="lebar" type="number" class="form-control" value="<?php echo $row['lp'] ?>" />
                            </div>
                            <div class="d-flex mb-4" style="max-width: 300px">
                            

                            <div class="form-outline">
                                <input id="quantity_id_<?php echo trim($row['product_id'])?>"  min="0" name="quantity" value="<?php echo $row['quantity'] ?>" type="number" class="form-control" />
                                <label class="form-label" for="form1">Quantity</label>
                            </div>
                            <button id="<?php echo $row['product_id'] ?>" type="submit" class="btn btn-primary calculatebtn">Calculate</button>
                            </div>
                            </form>
                            <!-- Quantity -->

                            <!-- Price -->
                            <p class="text-start text-md-center">
                            <p>Calculated Price: Rp. <?php echo $row['price']?></p>
                            </p>
                            <!-- Price -->
                            </div>
                        </div>
            <?php }?>
                
                    <!-- Single item -->
                    <!-- Single item -->
                </div>
                </div>
                <div class="card mb-4">
                <div class="card-body">
                    
                    <p><strong>Shipping Address</strong> <a href="userProfile.php">Edit</a> </p> 
                    <p><strong>Address :</strong> <?php echo $_SESSION['address']?></p>
                    <p><strong>Post Code : </strong> <?php echo $_SESSION['postcode']?></p>
                    <p><strong>Contact:  </strong> <?php echo $_SESSION['contact']?></p>
                </div>
                </div>
                <!-- <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                    <p><strong>We accept</strong></p>
                    <img class="me-2" width="45px"
                    src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                    alt="Visa" />
                    <img class="me-2" width="45px"
                    src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                    alt="American Express" />
                    <img class="me-2" width="45px"
                    src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                    alt="Mastercard" />
                    <img class="me-2" width="45px"
                    src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
                    alt="PayPal acceptance mark" />
                </div>
                </div> -->
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach ($invoice_data['output'] as $row) { ?> 
                      
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Products
                        <span>Rp. <?php echo $row['total_price']?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Shipping
                        <span>Gratis</span>
                    </li>
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                        <strong>Total amount</strong>
                        <strong>
                            <p class="mb-0">(including VAT)</p>
                        </strong>
                        </div>
                        <span><strong>Rp. <?php echo $row['total_price']?></strong></span>
                    </li>
                    </ul>
                <?php }  ?>
                <button id="checkout" type="submit" class="btn btn-primary">Checkout</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    
    <script>

        jQuery(document).ready(function () {
            
            $('#checkout').on('click', function() {
                console.log("ready!");
                var user_id =  '<?php echo $_SESSION['id'] ?>';
                var data = { 
                            user_id: user_id
                        };
                $.ajax({
                type: "POST",
                url: "http://localhost/PermataGordynMain/CRUD_API/get/get_checkout_api.php",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify(data),
                // cache: false,
                success: function(data){
                    console.log("SUCCESS");
                    window.location.href = "checkout.php";
                },
                error: function(dataResult){
                    console.log("ERORR");
                    alert(dataResult.responseJSON.output);
                    
                }
                });
            });
                   
            $('.removebutton').on('click', function() {
                console.log("ready!");
                var product_id =  $(this).attr('id');
                var user_id = '<?php echo $_SESSION['id'];?>';
                var data = { 
                            product_id: product_id,
                            user_id: user_id
                        };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/delete/delete_cart_api.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    // cache: false,
                    success: function(data){
                        alert(data.output);
                        location.reload(true);
                    },
                    error: function(dataResult){
                        alert(dataResult.responseJSON.output);
                        
                    }
                });
            });
            
            $('.form').submit(function(event) {
                event.preventDefault();
                console.log("ready!");
                var product_id =  $(this).attr('id');
                var user_id = '<?php echo $_SESSION['id'];?>';
                var pp = $('#panjang_id_'+product_id).val();
                var lp= $('#lebar_id_'+product_id).val();
                var quantity = $('#quantity_id_'+product_id).val();
                console.log(product_id);
                console.log(pp);
                console.log(lp);
                console.log(quantity);
                var data = { 
                            product_id: product_id,
                            user_id: user_id,
                            pp: pp,
                            lp: lp,
                            quantity: quantity
                        };
                $.ajax({
                    type: "PATCH",
                    url: "http://localhost/PermataGordynMain/CRUD_API/update/update_cart_api.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    // cache: false,
                    success: function(data){
                        console.log("SUCCESS");
                        alert("Success Calculating Price!");
                        console.log(data);
                        $("#calcprice").text(data.output.price_after_calculation);
                        location.reload(true);
                        
                    },
                    error: function(dataResult){
                        console.log(dataResult);
                        alert(dataResult.responseJSON.output);
                        
                        
                    }
                });
            });

            

        });

    </script>
  


</body>
</html>