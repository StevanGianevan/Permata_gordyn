<?php
session_start();
$product_id = $_GET['product_id'];

$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_product_api2.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$payload = json_encode(array("product_id" => $product_id));

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
    <link rel="stylesheet" href="../CSS/style.css">
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
    <title>Permata Gordyn | Products</title>

</head>

<body>
    <!--Header-->
    <?php include "header.php" ?>

    <!-- Detail Product -->
    <div class="container-sm">
        <div class="box detailproductbx" style="background-color: white;">
            <div class="row">
                <div class="col-md-5 pictureproduct p-0">
                    <div >
                        <!-- slides -->
                        <div class="carousel-inner">
                        <?php foreach ($data['output'] as $row) { ?>
                            <div class="carousel-item active">
                                <img src="<?php echo $row['image1'] ?>" alt="Hills">
                            </div>
                        <?php } ?>
                        </div>
                    
                    </div>
                </div>
                <div class="col descriproduct p-0">
                    <div class="descriconten">
                    <?php foreach ($data['output'] as $row) { ?>
                        <h2><?php echo $row['name']?></h2>
                        <p class="harga">Rp. <?php echo number_format($row['price'], 2)?> /m<sup>2</sup></p>
                        <p><strong>Kategori : </strong> Gordyn Lokal</p>
                        <p><strong>Warna : </strong> <?php echo $row['colour']?></p>
                        <p><strong>Ukuran : </strong> <?php echo $row['size']?></p>
                        <p><strong>Deskripsi : </strong> <?php echo $row['description']?></p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary add_to_cart" data-toggle="modal" data-target="#exampleModal">
                            Add to cart
                        </button>
                    <?php }?>
                        <!-- Modal -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="info row">
                <div class="footer_address col-lg-3 mr-auto">
                    <div class="footer_nav_container d-flex flex-sm-row flex-colomn align-items-center 
                        justify-content-lg-start justify-content-center text-center">
                        <ul class="footer_nav">
                            <li>OUR ADDRESS</li>
                            <li>Jl. Giok 2, Blok T2 No. 23 Permata Cimahi, Tanimulya, Kec. Ngamprah, Kabupaten Bandung
                                Barat, Jawa Barat </br>40552</li>
                        </ul>
                    </div>
                </div>
                <div class="footer_products col-lg-3">
                    <div class="footer_nav_container d-flex flex-sm-row flex-colomn align-items-center 
                        justify-content-lg-start justify-content-center text-center">
                        <ul class="footer_nav">
                            <li>OUR PRODUCTS</li>
                            <li><a href="#">Gordyn</a></li>
                            <li><a href="#">Vitrage</a></li>
                            <li><a href="#">Blinds</a></li>
                            <li><a href="#">Kasa Nyamuk</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer_sosmed col-lg-3 mr-auto">
                    <div class="footer_nav_container footer_social d-flex flex-row align-items-center 
                        justify-content-lg-end justify-content-center">
                        <ul>
                            <li>SOCMED</li>
                            <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mx-auto">
                    <div class="footer_nav_container">
                        <div class="cr mr-auto">Copyright © 2022 <a href="#">
                                PermataGordyn</a>. All Right Reserverd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('.addcartbtn').on('click',function(event){
                var str1 = $(".panjang").val();
                var str2 = $(".lebar").val();
                console.log(str1);
                console.log(str2);
                window.location.href = "productdetail.html";
            })

            $('.add_to_cart').on('click', function() {
                console.log("ready!");
                var product_id =  '<?php echo $product_id ?>';
                var user_id = '<?php echo $_SESSION['id'];?>';
                var data = { 
                            product_id: product_id,
                            user_id: user_id
                        };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/post/post_cart_api2.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    // cache: false,
                    success: function(data){
                        alert(data.output);
                    },
                    error: function(dataResult){
                        alert(dataResult.responseJSON.output);
                        
                    }
                });
            });

        });
    </script>
</body>

</html>