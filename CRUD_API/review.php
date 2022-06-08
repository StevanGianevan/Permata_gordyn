<?php
session_start();
$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_cart_api_invoice.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$user_id = $_SESSION['id'];
$invoice_id = $_GET['invoice_id'];
$payload = json_encode(array("user_id" => $user_id, "invoice_id" => $invoice_id));

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/bayar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
    <title>Permata Gordyn | Verification Page</title>
</head>
<body>
    <!--Header-->
    <?php include "header.php" ?>

    <!-- verifikasi pembayaran -->
    <div class="verify">
        <div class="row align-content-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <p>REVIEW PRODUCT</p>
                    </div>
                    <?php if ($data['output'] != 'Data not found') { ?>
                        <?php foreach ($data['output'] as $row) { ?> 
                        <div class="card-body">
                            <div class="row align-content-center justify-content-center">
                                <div class="col-lg-6 text-center">
                                    <p><img src="<?php echo $row['image1']?>" width="150" height="100"></p>
                                </div>
                                <div class="col-lg-6">
                                    <ul>
                                        <li>
                                            <p style="font-weight: 600; text-transform: uppercase;"><?php echo $row['name']?></p>
                                        </li>
                                        <li>
                                            <p>ukuran : <?php echo $row['pp'] ?>m x <?php echo $row['lp'] ?>m</p>
                                        </li>
                                        <li>
                                            <p>Quantity: <?php echo $row['quantity']?></p>
                                        </li>
                                        <li>
                                            Review: 
                                            <input id="id_review_<?php echo trim($row['product_id'])?>" class="form-control" type="text" placeholder="Review Product">
                                        </li>
                                        <li>
                                            <button id="<?php echo $row['product_id'] ?>" type="submit" class="btn btn-primary submitreviewbtn">Submit</button> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php }}?>
                <!-- <h4 style ="text-align: center;" >Pesanan akan di proses dalam jangka waktu 2x24 jam.</h4> -->
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container">
            <div class="row align-items-center 
            justify-content-center justify-content-center text-center">
                <div class="col-lg-3">
                    <p>OUR ADDRESS</p>
                </div>
                <div class="col-lg-3">
                    <p>OUR PRODUCTS</p>
                </div>
                <div class="col-lg-3">
                    <p>SOCMED</p>
                </div>
            </div>
            <div class="konten row align-items-center 
            justify-content-center justify-content-center text-center">
                <div class="col-lg-3">
                    <div class="footer_nav_container">
                        <a href="#">Jl. Giok 2, Blok T2 No. 23 Permata Cimahi, Tanimulya, Kec. Ngamprah, Kabupaten Bandung
                            Barat, Jawa Barat </br>40552</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer_nav_container ">
                        <ul class="footer_nav">
                            <li><a href="#">Gordyn</a></li>
                            <li><a href="#">Vitrage</a></li>
                            <li><a href="#">Blinds</a></li>
                            <li><a href="#">Kasa Nyamuk</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer_nav_container">
                        <ul class="footer_nav">
                            <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright row text-center">
                <div class="col">
                    <div class="footer_nav_container">
                        <div class="cr">Copyright © 2022 <a href="#">
                                PermataGordyn</a>. All Right Reserverd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        jQuery(document).ready(function (){
            $('.submitreviewbtn').on('click', function() {
                console.log("ready!");
                var product_id =  $(this).attr('id');
                var user_id = '<?php echo $_SESSION['id'];?>';
                var description = $('#id_review_'+product_id).val();
                var invoice_id = '<?php echo $invoice_id;?>';
                var data = { 
                    product_id: product_id,
                    user_id: user_id,
                    invoice_id: invoice_id,
                    description: description
                };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/post/post_review_api.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: function(dataResult){
                        alert(dataResult.output);
                        $('#id_review_'+product_id).attr("disabled", true);
                    },
                    error: function(dataResult){
                        console.log(dataResult);
                        console.log("ERORR");
                        alert(dataResult.output);
                    }
                });
            })
        });
    </script>
</body>
</html>