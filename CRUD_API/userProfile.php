<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userProfile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
    <link rel="stylesheet" href="../CSS/userProfile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Permata Gordyn | Login Page</title>
</head>












<body>
<?php include "header.php" ?>
<div class="d-flex justify-content-center" style="margin-top: 30px;">
    <div class="col" style="max-width: 1000px;">
        <div class="row">
        <div class="col mb-3">
            <div class="card">
            <div class="card-body">
                <div class="e-profile">
                <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                    <div class="mx-auto" style="width: 140px;">
                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                        <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                        </div>
                    </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Name: <?php echo $_SESSION['name'] ?></h4>
                        <p class="mb-0">Email: <?php echo $_SESSION['email'] ?></p>
                        
                        <div class="mt-2">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-fw fa-camera"></i>
                            <span>Change Photo</span>
                        </button>
                        </div>
                    </div>
                    
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane active">
                    <form class="form" novalidate="">
                        <div class="row">
                        <div class="col">
                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Nama</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="Nama">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" class="form-control" type="text" name="email" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Address</label>
                                <input id="address" class="form-control" type="text" placeholder="Address">
                                </div>
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Post Code</label>
                                <input id="postcode" class="form-control" type="text" placeholder="">
                                </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Contact</label>
                                <input id="contact" class="form-control" type="text" placeholder="">
                                </div>
                            </div>
                            </div>
                        </div>

                        </div>

                        <button id="submitdata" name="submitdata" class="btn btn-primary" type="submit">Save Changes</button>
                        <p> </br> </p>
                        </div>
                        <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-2"><b>Change Password</b></div>
                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Current Password</label>
                                <input id="currentpassword" class="form-control" type="password" placeholder="••••••">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>New Password</label>
                                <input id="newpassword" class="form-control" type="password" placeholder="••••••">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                <input id="newcpassword" class="form-control" type="password" placeholder="••••••"></div>
                            </div>
                            </div>
                        </div>
                        
                        </div>
                    
                        <button id="submit" name="submit" class="btn btn-primary submitpass" type="submit">Save Changes</button>
                        
                    </form>

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>

    <script> 
        $(document).ready(function(){

            $('#submitdata').on('click', function() {
                event.preventDefault();
                console.log("ready");
                var id = "<?php echo $_SESSION['id'];?>";
                var name =  $('#name').val();
                var email =  $('#email').val();
                var address = $('#address').val();
                var postcode= $('#postcode').val();
                var contact = $('#contact').val();
                var data = { 
                            id: id,
                            name: name,
                            email: email,
                            address: address,
                            postcode: postcode,
                            contact: contact
                        };
                $.ajax({
                    type: "PATCH",
                    url: "http://localhost/PermataGordynMain/CRUD_API/update/update_user_api.php",
                    contentType: "application/json",
                    dataType: 'json',
                    data: JSON.stringify(data),
                    cache: false,
                    success: function(dataResult){
                        alert("successfully update user data!");
                        location.reload(true);
                    },
                    error: function(response){
                        console.log(response);
                    }
                        
            
                });
            
            });



            $('#submit').on('click', function() {
                event.preventDefault();
                console.log("ready");
                var id = "<?php echo $_SESSION['id'];?>";
                var name =  $('#name').val();
                var email =  $('#email').val();
                var currentpassword = $('#currentpassword').val();
                var newpassword = $('#newpassword').val();
                var newcpassword = $('#newcpassword').val();
                var address = $('#address').val();
                var postcode= $('#postcode').val();
                var contact = $('#contact').val();
                var data = { 
                            id: id,
                            name: name,
                            email: email,
                            currentpassword: currentpassword,
                            newpassword: newpassword,
                            newcpassword: newcpassword,
                            address: address,
                            postcode: postcode,
                            contact: contact
                        };
                $.ajax({
                    type: "PATCH",
                    url: "http://localhost/PermataGordynMain/CRUD_API/update/update_user_api.php",
                    contentType: "application/json",
                    dataType: 'json',
                    data: JSON.stringify(data),
                    cache: false,
                    success: function(dataResult){
                        alert("successfully update user data!");
                    },
                    error: function(response){
                        alert(response.responseJSON.output);
                    }
                        
            
                });
            
            });

            
            var id = '<?php echo $_SESSION['id'];?>';
            $.ajax({
                url: 'http://localhost/PermataGordynMain/CRUD_API/get/get_userprofile_api.php',
                type: 'GET',
                dataType: 'json',
                cache: false,
                beforeSend: function(xhr){xhr.setRequestHeader('id', id);},
                success: function(dataResult){
                    $("#postcode").attr("value", dataResult.output.postcode);
                    $("#name").attr("value", dataResult.output.name);
                    $("#address").attr("value", dataResult.output.address);
                    $("#email").attr("value", dataResult.output.email);
                    $("#contact").attr("value", dataResult.output.contact);
                },
                error: function(xhr){
                    console.log(xhr.responseJSON.output);
                }

            });
           
                
            






        });

    </script>
</body>
</html>