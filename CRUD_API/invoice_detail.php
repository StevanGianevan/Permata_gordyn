<?php 
session_start();
$invoice_id = $_GET['invoice_id'];
$user_id = $_SESSION['id'];

$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_cart_api_invoice.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$payload = json_encode(array("invoice_id" => $invoice_id, "user_id" => $user_id));

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

// // Get Invoice data
$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_invoice_api_bayar.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
// $payload = json_encode(array("user_id" => $user_id));

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
                        <p>INVOICE ID : <?php echo $invoice_id?></p>
                    </div>
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
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    <?php }?>
                <h4 style ="text-align: center;" >Pesanan akan di proses dalam jangka waktu 2x24 jam.</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row align-content-center justify-content-center">
                            <div class="col-sm-2 text-center">
                                <img src="../Image/logo-bcapng-32694.png" width="100px" height="auto">
                            </div>
                            <div class="col-lg-8">
                                
                                <h4 style= "text-align: center;">
                                    METODE PEMBAYARAN DIPILIH
                                </h4>
                                <p>No. Rekening : 1238180457 </br> Nama Rekening : Permata Gordyn </p>
                                
                            </div>
                            <!-- <div class="col-sm-2 text-right">
                                <button type="button" class="btn btn-outline-dark">Salin</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="card tahapan">
                    <div class="card-body">
                        <ul>
                            <li>
                                Gunakan M-Banking / ATM terdekat untuk menyelesaikan pembayaran
                            </li>
                            <li>
                                Upload bukti transfer pada form dibawah yang sudah disediakan
                            </li>
                        </ul>
                        <hr>
                        <div class="form-row mb-3">
                            <div class="col">
                              <label for="validationTooltip02">Bukti Transfer</label>
                              <div class="custom-file">
                                <input type="file" class="input-bukti-trf" id="customFile">
                              </div>
                              <label style="color: lightgrey;">*upload maks 5MB</label>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                                <div>
                                <?php $i=1 ?>
                                <?php foreach ($data['output'] as $row) { ?>
                                    <ul>
                                        <li>
                                            <a><?php echo $i. ". "?><?php echo $row['name']?> </a>
                                        </li>
                                    </ul>
                                <?php $i+=1 ?>
                                <?php }?>
                                </div>
                                <div class="col-sm text-right">
                                <?php foreach ($data['output'] as $row) { ?>
                                    <ul style="list-style-type: circle;">
                                        <li>
                                            <a>Rp. <?php echo $row['price']?></a>
                                        </li>
                                    </ul>
                                <?php }?>
                                </div>
                            </div>
                            <hr>
                        <?php foreach ($invoice_data['output'] as $row) { ?>   
                            <p class="text-right"><strong> Total Harga :</strong> Rp. <?php echo $row['total_price']?></p>
                        </div>
                        <?php }?>
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

    <script type="text/javascript">
    </script>
</body>
</html>