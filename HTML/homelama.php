<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/home.css">
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
    <title>Permata Gordyn | Home Page</title>
</head>

<body>
    <!--Header-->
    <?php include 'header.php'; ?>


    <!-- landing page -->
    <div class="konten1 mt-0" style="background-image: url(../Image/background.jpg);">
        <div class="container fill_hight">
            <div class="row align-items-center fill_hight">
                <div class="col">
                    <div class="konten1_konten">
                        <h2>Permata Gordyn</h2>
                        <h5>Selamat datang di website kami, kami menyediakan bermacam -
                            </br>macam jenis gordyn atau tirai penutup jendela
                        </h5>
                        <button type="button" class="btn btn-secondary">selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sejarah Permata gordyn -->
    <div class="konten2" style="background-color: black;">
        <div class="container">
            <div class="row mx-auto">
                <div class="col" >
                    <div class="row" style="color: white;"><p>picture1</p></div>
                    <div class="row" style="color: white;"><p>picture2</p></div>
                </div>
                <div class="col" >
                    <div class="row" style="color: white;"><p>picture3</p></div>
                    <div class="row" style="color: white;"><p>picture4</p></div>
                </div>
                <div class="col" style="color: white;">
                    <p>picture1</p>
                </div>
                <div class="col" style="color: white;"><p>picture1</p></div>
            </div>
        </div>
    </div>

    <!-- Our Products -->
    <div class="banner">
        <div class="container">
            <p>OUR PRODUCTS</p>
            <div class="row">
                <div class="col-md-4 p-0">
                    <div class="banner_item align-item-center mb-2" style="background-image: url(../Image/Logo.png);">
                        <div class="banner_category">
                            <p class="mb-auto">Gordyn</p>
                            <a class="text-decoration-none" href="#">see details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-0">
                    <div class="banner_item align-item-center" style="background-image: url(../Image/Logo.png);">
                        <div class="banner_category">
                            <p class="mb-auto">Vitrage</p>
                            <a href="#">see details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-0">
                    <div class="banner_item align-item-center" style="background-image: url(../Image/Logo.png);">
                        <div class="banner_category">
                            <p class="mb-auto">rel</p>
                            <a href="#">see details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container">
            <div class="header row align-items-center 
            justify-content-center justify-content-center text-center">
                <div class="col-lg-3">
                    <p>OUR ADDRESS</p>
                </div>
                <div class="col-lg-3">
                    <p>OUR PRODUCTS</p>
                </div>
                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <div class="footer_nav_container">
                        <ul class="footer_nav">
                            <li><i class="fa fa-envelope" aria-hidden="true"></i><a style="margin-left: 10px;">permatagordyn@gmail.com</a></li>
                            <li><i class="bi bi-telephone"></i><a style="margin-left: 10px;">+62 82115475894</a></li>
                            <li>
                                <a href="#" style="margin-right: 10px;"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="#" style="margin-right: 10px;"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                <a href="#" style="margin-right: 10px;"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </li>
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

    <script src="../JQUERY/script.js"></script>
</body>

</html>