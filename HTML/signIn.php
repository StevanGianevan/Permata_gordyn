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
    <link rel="stylesheet" href="../CSS/Login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Permata Gordyn | Login Page</title>
</head>

<body>
    <!--Header-->
    <div class="header">
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
                        <a class="nav-link" href="home.html">Home</a>
                    </li>
                    <li class="nav-item products">
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
    </div>

    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="../Image/bw-1.jpg">
                </div>
                <div class="formBx">
                    <form>
                        <h2>Sign In</h2>
                        <input type="text" class="email" placeholder="Email">
                        <input type="password" class="password" placeholder="Password">
                    </form>
                    <button class="signinbtn">Login</button>
                    <p class="signup">Don't have an account ? <a href="#" onclick="toggleForm();">Sign Up</a></p>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form method="post" action="signin.php">
                        <h2>Sign Up</h2>
                        <!-- <div class="alert alert-primary alert_signup" role="alert"></div> -->
                        <input type="text" class="namesignup" placeholder="Name">
                        <input type="email" class="emailsignup" placeholder="Email">
                        <input type="password" class="passwordsignup" placeholder="Create Password">
                        <input type="password" class="cpasswordsignup" placeholder="Confirm Password">
                    </form>
                    <button type="submit" class="signupbtn">Sign Up</button>
                    <p class="signup">Already have an account ? <a href="#" onclick="toggleForm();">Sign In</a></p>
                </div>
                <div class="imgBx">
                    <img src="../Image/bw.jpg">
                </div>
            </div>
    </section>

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
                        <div class="cr mr-auto">Copyright ?? 2022 <a href="#">
                                PermataGordyn</a>. All Right Reserverd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        function toggleForm() {
            var container = document.querySelector('.container');
            container.classList.toggle('active')
        }
        jQuery(document).ready(function () {
            console.log("ready!");
            $('.signupbtn').on('click', function (event) {
                var namesignup = $(".namesignup").val();
                var emailsignup = $(".emailsignup").val();
                var passwordsignup = $(".passwordsignup").val();
                var cpasswordsignup = $(".cpasswordsignup").val();
                if (namesignup == "" || emailsignup =="" || passwordsignup =="" || cpasswordsignup =="")
                {
                    alert('Please Complete the form');
                }
                else if(passwordsignup != cpasswordsignup )
                {   
                    alert('Password not match');
                }
                else{
                    $.ajax(
                        {
                            url: '../BACKEND/index.php', //untuk nembak ke file php nya.
                            type: 'POST',
                            data: {
                                signup : 1,
                                names : namesignup,
                                emails : emailsignup,
                                passwords : passwordsignup,
                                cpasswords : cpasswordsignup,
                            },
                            success:function (data){
                                console.log(data);
                            },
                            dataType: 'text'
                        }
                    );
                }
                // window.location.href = "home.html";
            })
            $('.signinbtn').on('click', function (event) {
                var email = $(".email").val();
                var password = $(".password").val();
                if (email == "" || password =="")
                {
                    alert('Please Complete the form');
                }
                else{
                    $.ajax(
                        {
                            url: '../BACKEND/index.php', //untuk nembak ke file php nya.
                            type: 'POST',
                            data:{
                                login : 1,
                                emails : email,
                                passwords : password,
                            },
                            success:function (response){
                                console.log(response);
                            },
                            dataType: 'text'
                        }
                    );
                }
                // window.location.href = 'home.html';
            })
        });
    </script>
</body>

</html>