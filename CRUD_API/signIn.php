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
    <!-- Header -->
    <?php include 'header.php'; ?>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="../Image/bw-1.jpg">
                </div>
                <div class="formBx">
                    <form action="" method="POST" id="loginfrm">
                        <h2>Sign In</h2>
                        <input id="email_log" name="email" type="email" class="email"  placeholder="Email">
                        <input id="password_log" name="password" type="password" class="password"  placeholder="Password">
                    </form>
                    <button name="submit" class="signinbtn">Login</button>
                    <p class="signup">Don't have an account ? <a href="#" onclick="toggleForm();">Sign Up</a></p>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="" method="POST" id="registerform">
                        <h2>Sign Up</h2>
                        <input id="name" name="name" type="text" class="usernamesignup" placeholder="Username">
                        <input id ="email" name="email" type="email" class="emailsignup" placeholder="Email">
                        <input id="password" name="password" type="password" class="passwordsignup" id="password" placeholder="Create Password">
                        <input id="cpassword" name="cpassword" type="password" class="cpasswordsignup" id="cpassword" placeholder="Confirm Password">
                    </form>
                    <button name="submit" type="submit" class="signupbtn">Sign Up</button>
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
                        <div class="cr mr-auto">Copyright © 2022 <a href="#">
                                PermataGordyn</a>. All Right Reserverd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleForm() {
            var container = document.querySelector('.container');
            container.classList.toggle('active')
        }
        jQuery(document).ready(function () {
        
            $('.signinbtn').on('click', function() {
                console.log("ready!");
                var email =  $('#email_log').val();
                var password = $('#password_log').val();
                var data = { 
                            email: email,
                            password: password
                        };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/get/get_user_api.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    // cache: false,
                    success: function(){
                        location.href = "../CRUD_API/home.php";
                        document.getElementById('loginfrm').reset();
                    },
                    error: function(dataResult){
                        // var result = jQuery.parseJSON( dataResult );
                        alert(dataResult.responseJSON.output);
                        document.getElementById('loginfrm').reset();
                    }
                });
            });

            $('.signupbtn').on('click', function() {
                console.log("ready!");
                var name =  $('#name').val();
                var email =  $('#email').val();
                var password = $('#password').val();
                var cpassword = $('#cpassword').val();
                var data = { 
                            name: name,
                            email: email,
                            password: password,
                            cpassword: cpassword
                        };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/post/post_user_api.php",
                    contentType: "application/json",
                    dataType: 'json',
                    data: JSON.stringify(data),
                    cache: false,
                    success: function(dataResult){
                        // console.log(dataResult)
                        
                        // if(dataResult.statusCode==200){
                        //     alert("Successfully created new user!");				
                        // }
                        // else if(dataResult.statusCode==201){
                        //     alert("Password does not match confirmation password");				
                        // }
                        alert(dataResult.output);
                        document.getElementById('registerform').reset();		
                        // }
                        // else if(dataResult.statusCode==203){
                        //     alert("password does not match confirmation password");				
                        // }

                            
                    },
                    error: function(response){
                        document.getElementById('registerform').reset();
                        console.log(response);
                        alert(response.responseJSON.output);
                        
                        // console.log(response);
                        // var result = JSON.stringify(response.responseText);
                        // var done = JSON.parse(result);
                        // console.log(done.output);
                        
                        
                    }
                        
            
                });
            });
    });

    </script>
</body>

</html>