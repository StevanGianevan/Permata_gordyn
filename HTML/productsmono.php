<?php 
session_start();

$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_product_api.php";
$konten = file_get_contents($sumber);
$data = json_decode($konten, true);
phpinfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/product.css">
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
    <title>Permata Gordyn | Products</title>

</head>

<body>
    <!--Header-->
    <!-- <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark py-3">
            <a><img src="../Image/Logo.png" class="px-3" width="90px" height="auto"></a>
            <a class="navbar-brand" href="#">Permata Gordyn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item home">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item products active">
                        <a class="nav-link" href="products.html">Products</a>
                    </li>
                    <li class="nav-item contact">
                        <a class="nav-link" href="contacts.html">Visit Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item cart">
                        <a class="nav-link disabled" href="#"><i class="fa fa-shopping-bag"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item button ml-2">
                        <button type="button" class="btn btn-secondary"><a href="signIn.html">Login</a></button>
                    </li>
                </ul>
            </div>
        </nav>
    </div> -->
    <?php 
        include 'header.php';
    ?>

    <!-- Landing Page Product -->
    <div class="lproduct mx-2 my-2" style="background-color: grey;">
        <div class="container fill_hight">
            <div class="row align-items-center fill_hight">
                <div class="col">
                    <div class="lproduct_konten">
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

    <!-- Slider Product -->
    <div class="silderP">
        <div class="container-sm ">
            <!-- Blind type -->
            <div class="box sliderbx" style="background-color: white;">
                <p>Blinds Type</p>
            </div>
            <div class="accordion blindtype" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                Roller Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <?php foreach ($data['output'] as $row) {
                                            ?>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="<?php echo $row['image1']?>" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $row['name']?></h5>
                                                    <p class="card-text">Rp. <?php echo $row['price']?></p>
                                                    <p class="card-text"><?php echo $row['description']?></p>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Vertical Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                Zebra Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Blinds -->

            <!-- Gordyn -->
            <div class="box sliderbx" style="background-color: white;">
                <p>Blinds Type</p>
            </div>
            <div class="accordion blindtype" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapse-4" aria-expanded="true" aria-controls="collapse-4">
                                Roller Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Vertical Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                Zebra Blind
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body" style="background-color: rgb(186, 185, 185);">
                            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                            <div class="card rounded" style="width: 18rem;">
                                                <img class="card-img-top" src="../Image/Logo.png" alt="Dimout">
                                                <div class="card-body">
                                                    <h5 class="card-title">Dimout</h5>
                                                    <p class="card-text">Rp. 450.000/m<sup>2</sup></p>
                                                    <a href="#">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Gordyn -->
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