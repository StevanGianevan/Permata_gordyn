<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/contact.css">
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
    <title>Permata Gordyn | Visit Us</title>
</head>

<body>
    <!--Header-->
    <?php include 'header.php'; ?>

    <!-- Landing Page Product -->
    <div class="container-sm">
        <div class="box contactbx" style="background-color: white;">
            <div class="row">
                <div class="col-md-3 contact-us">
                    <h2>Contact Us</h2>
                    <p><img src="../Image/iphone.png" width="30px">No HP</p>
                    <p><img src="../Image/email.png" width="30px">Email@gmail.com</p>
                    <p><img src="../Image/instagram.png" width="30px">@instagram</p>
                    <p><img src="../Image/facebook.png" width="30px">Facebook</p>
                </div>
                <div class="col maps-view">
                    <p><iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.24595017998!2d107.51892671535671!3d-6.861099569034997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e48ee9df4d0b%3A0x4990f1514711debd!2sPermata%20Gordyn!5e0!3m2!1sen!2sid!4v1651817855501!5m2!1sen!2sid"
                            width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>
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