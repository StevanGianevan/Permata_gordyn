<?php
session_start();
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
    <link rel="stylesheet" href="checkout.css"/>
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
    <title>Permata Gordyn | Checkout Page</title>
</head>

<body>
    <!-- header -->

    <?php include "header.php" ?>

    <!-- Checkout -->
    <div class="checkout">
        <div class="row align-content-center justify-content-center">
            <div class="col-md-6">
                
                <div class="card">
                    <div class="card-header">
                        <p>checkout</p>
                    </div>
                    <?php foreach ($data['output'] as $row) { ?> 
                        <div class="card-body">
                            <div class="row align-content-center justify-content-center">
                                <div class="col-lg-6 text-center">
                                    <p>Product Id: <?php echo $row['product_id'] ?></p>
                                </div>
                                
                                <div class="col-lg-6">
                                    <ul>
                                        <li>
                                            <p style="font-weight: 600; text-transform: uppercase;"><?php echo $row['name']?></p>
                                        </li>
                                        <li>
                                            <p>ukuran : <?php echo $row['pp'] ?> m x <?php echo $row['lp'] ?> m</p>
                                        </li>
                                        <!-- <li>
                                            <p>warna : biru</p>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Chart Penjualan
                    </div>
                    <div class="card-body">
                        <div class="pembelian">
                            <p style="text-transform: uppercase;">List Pembelian</p>
                            <hr>
                            <div class="row">
                                <div class="col-sm">
                                    <ul style="list-style-type: circle;" >
                                        <?php foreach ($data['output'] as $row) { ?> 
                                            <li>
                                                <a><?php echo $row['name'] ?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            
                                <div class="col-sm text-right">
                                    <ul>
                                        <?php foreach ($data['output'] as $row) { ?> 
                                            <li>
                                                <a>Rp. <?php echo $row['price'] ?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <?php foreach ($invoice_data['output'] as $row) { ?>
                                <p class="text-right"><strong> Total Harga :</strong> Rp. <?php echo $row['total_price'] ?></p>
                            <?php }  ?>
                        </div>
                        <div class="metode">
                            <p style="text-transform: uppercase;">Metode Pembayaran</p>
                            <hr>
                            <input type="radio" name="metode" value="1" id="bca" onclick="enable()">
                            <label for="bca"><img src="../Image/logo-bcapng-32694.png" width="40" height="auto"> Bank Central Asia</label>
                            <br>
                            <input type="radio" name="metode" value="1" id="ovo" onclick="enable()">
                            <label for="ovo"><img src="../Image/Logo OVO (PNG-240p) - FileVector69.png" width="20" height="auto"> OVO</label>
                            <br>
                            <input type="radio" name="metode" value="1" id="gopay" onclick="enable()">
                            <label for="gopay"><img src="../Image/Logo GoPay (PNG-240p) - FileVector69.png" width="40" height="auto"> GOPAY</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="pembayaran" disabled="true"><i class="bi bi-shield-check"></i> bayar</button>
                    </div>
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
</body>
<script>
    document.getElementById('pembayaran').onclick = function() {
        window.location.href = "bayar.html";
    }
    function enable(){
        var bca = document.getElementById("bca");
        var ovo = document.getElementById("ovo");
        var gopay = document.getElementById("gopay");
        var pembayaran= document.getElementById("pembayaran");

        if (bca.checked){
            pembayaran.removeAttribute("disabled");
        }
        else if(ovo.checked){
            pembayaran.removeAttribute("disabled");
        }
        else if(gopay.checked){
            pembayaran.removeAttribute("disabled");
        }
    }
</script>
</html>