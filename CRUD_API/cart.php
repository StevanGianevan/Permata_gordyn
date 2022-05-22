<?php 
session_start();
$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_product_api.php";
$konten = file_get_contents($sumber);
$data1 = json_decode($konten, true);

// $user_id = $_SESSION['id']; 



$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_cart_api.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = $_SESSION['id'];
$payload = json_encode(array("user_id" => $data));

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

$data = json_decode($result, true);





// $postData = array(
//     'user_id' => $user_id
// );

// $ch = curl_init("http://localhost/PermataGordynMain/CRUD_API/get/get_product_api.php");
// curl_setopt_array($ch, array(
//     CURLOPT_POST => TRUE,
//     CURLOPT_RETURNTRANSFER => TRUE,
//     CURLOPT_HTTPHEADER => array(
//         'Authorization: ',
//         'method: POST',
//         'Content-Type: application/json'
//     ),
//     CURLOPT_POSTFIELDS => json_encode($postData)
// ));

// // Send the request
// $response = curl_exec($ch);

// // Check for errors
// if($response === FALSE){
//     die(curl_error($ch));
// }

// // Decode the response
// $responseData = json_decode($response, TRUE);

// // Close the cURL handler
// curl_close($ch);

// // Print the date from the response
// echo $responseData['output'];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="cart.css">
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
                    <h5 class="mb-0">Cart - 2 items</h5>
                </div>
                <div class="card-body">
                <?php foreach ($data['output'] as $row) { ?>
                        <!-- Single item -->
                        <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                            <!-- Image -->
                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                            <img src="<?php echo $row["image1"] ?>"
                                class="w-100" alt="Blue Jeans Jacket" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                            </a>
                            </div>
                            <!-- Image -->
                        </div>

                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                            <!-- Data -->
                            <p><strong><?php echo $row['name']?></strong></p>
                            <p>Color: <?php echo $row['colour'] ?></p>
                            <p>Size: <?php echo $row['size'] ?></p>
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                            title="Remove item">
                            <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                            title="Move to the wish list">
                            <i class="fas fa-heart"></i>
                            </button>
                            <!-- Data -->
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <!-- Quantity -->
                            <div class="d-flex mb-4" style="max-width: 300px">
                            <button class="btn btn-primary px-3 me-2" id="qty-button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                <i class="fas fa-minus"></i>
                            </button>

                            <div class="form-outline">
                                <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                                <label class="form-label" for="form1">Quantity</label>
                            </div>

                            <button class="btn btn-primary px-2 ms-2" id="qty-button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                <i class="fas fa-plus"></i>
                            </button>
                            </div>
                            <!-- Quantity -->

                            <!-- Price -->
                            <p class="text-start text-md-center">
                            <strong>Rp. <?php echo $row['price'] ?></strong>
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
                    <p><strong>Expected shipping delivery</strong></p>
                    <p class="mb-0">12.10.2020 - 14.10.2020</p>
                </div>
                </div>
                <div class="card mb-4 mb-lg-0">
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Products
                        <span>$53.98</span>
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
                        <span><strong>$53.98</strong></span>
                    </li>
                    </ul>

                    <button type="button" class="btn btn-primary btn-lg btn-block">
                    Go to checkout
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- <script>

    $(document).ready(function(){

        var id = '';
            $.ajax({
                url: 'http://localhost/PermataGordynMain/CRUD_API/get/get_cart_api.php',
                type: 'GET',
                dataType: 'json',
                cache: false,
                beforeSend: function(xhr){xhr.setRequestHeader('id', id);},
                success: function(dataResult){
                    alert("success fetching result");
                },
                error: function(xhr){
                    
                }

            });


    });



    </script> -->


</body>
</html>