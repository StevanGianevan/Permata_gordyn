<?php 
session_start();

$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/list_user_api.php";
$konten = file_get_contents($sumber);
$data = json_decode($konten, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/style-admin.css">
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>Permata Gordyn | Admin Page</title>
</head>

<body>
  <!--Header-->
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
      <a class="navbar-brand" href="#"><img src="../Image/Logo.png" class="px-3" width="90px" height="auto">Permata
        Gordyn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-person"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- sidebar -->
  <div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
      <ul class="list-group">
        <li>
          <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        </li>
        <li>
          <a href="order.php"><i class="bi bi-journal"></i> Order</a>
        </li>
        <li>
          <a href="category.php"><i class="bi bi-box2-fill"></i> Category</a>
        </li>
        <li>
          <a href="product.php"><i class="bi bi-boxes"></i> Product</a>
        </li>
        <li class="active">
          <a href="user.php"><i class="bi bi-person"></i> User</a>
        </li>
      </ul>
    </div>

    <div class="col" id="body-col">
      <div class="box">
        <p>User</p>
      </div>
      <div class="form-row">
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">ID</label>
          <input type="text" class="form-control" id="userid" placeholder="ID" disabled>
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Role</label>
          <input type="text" class="form-control" id="role" placeholder="Role">
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Name">
        </div> 
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Address</label>
          <input type="text" class="form-control" id="address" placeholder="Address">
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Contact</label>
          <input type="text" class="form-control" id="contact" placeholder="Contact">
        </div> 
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Postcode</label>
          <input type="text" class="form-control" id="postcode" placeholder="Postcode">
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationTooltip02">Email</label>
          <input type="text" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="text-right ml-auto">
          <button id="" class="btn btn-danger adduserbtn" value="false">Add User</button>
        </div>
      </div>
      <hr>
      <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Search by name</label>
          <input type="text" class="form-control mb-3" id="user_name" placeholder="Name">
          <button id="" class="btn btn-danger search_user_btn" value="false">Search User</button>
      </div>
      
      <h4>Searched User</h4>
      <div id="search_result" class="table table-hover">
        <table id="searchedUsers">
          <thead class="thead-dark" style="text-transform: uppercase;">
            <tr>
              <th>ID</th>
              <th>Role</th>
              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Postcode</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="search_body"> </tbody>
        </table>
      </div>
      <hr>
      <table class="table table-hover">
        <p class="text-center h3">List Users</p>
        
        
        <thead id="test_search_head"class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Postcode</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="test_search_body">
        <?php if ($data['output'] != 'Data not found') { ?>
          <?php foreach ($data['output'] as $row) { ?> 
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <th><?php echo $row['role'] ?></th>
              <th><?php echo $row['name'] ?></th>
              <th><?php echo $row['address'] ?></th>
              <th><?php echo $row['email'] ?></th>
              <th><?php echo $row['contact'] ?></th>
              <th><?php echo $row['postcode'] ?></th>
              <th class="col-1 text-center">
                <button id="<?php echo $row['id'] ?>" class="btn edit" style="background-color: transparent;"><i class="bi bi-pencil"></i></button>
                <button id="<?php echo $row['id'] ?>" class="btn delete" style="background-color: transparent;"><i class="bi bi-trash"></i></button>
              </th>
            </tr>
          <?php }}?>
        </tbody>
      </table>
      </div>
      </div>

  <script>

    $('.search_user_btn').on('click',function(event){
          
          var user_name = $('#user_name').val();
          var data = { 
            user_name: user_name
          };
          $.ajax({
              type: "POST",
              url: "http://localhost/PermataGordynMain/CRUD_API/get/get_user_api2.php",
              contentType: "application/json",
              dataType: 'json',
              data: JSON.stringify(data),
              cache: false,
              success: function(dataResult){
                $(dataResult.output).each(function(i, result){
                  $('#search_body').append($("<tr>")
                    .append($("<td>").append(result.id))
                    .append($("<td>").append(result.role))
                    .append($("<td>").append(result.name))
                    .append($("<td>").append(result.address))
                    .append($("<td>").append(result.email))
                    .append($("<td>").append(result.password))
                    .append($("<td>").append(result.contact))
                    .append($("<td>").append(result.postcode))
                    .append($("<td>").append($(document.createElement('button')).prop({
                      type: 'button',
                      innerHTML: 'Edit',
                      id: result.id,
                      class: 'editbtn'
                      }),
                      $(document.createElement('button')).prop({
                          type: 'button',
                          innerHTML: 'Delete',
                          id: result.id,
                          class: 'deletebtn'
                      })


                  )));
                    $('.editbtn').on('click', function(event){
                      var user_id = $(this).attr('id');
                      var data2 = {
                        user_id : user_id
                      };
                      $.ajax({
                          type: "POST",
                          url: "http://localhost/PermataGordynMain/CRUD_API/get/get_user_api2.php",
                          contentType: "application/json",
                          dataType: 'json',
                          data: JSON.stringify(data2),
                          cache: false,
                          success: function(dataResult){
                            $("#userid").attr("value", dataResult.output[0].id);
                            $("#role").attr("value", dataResult.output[0].role);
                            $("#name").attr("value", dataResult.output[0].name);
                            $("#address").attr("value", dataResult.output[0].address);
                            $("#contact").attr("value", dataResult.output[0].contact);
                            $("#postcode").attr("value", dataResult.output[0].postcode);
                            $("#email").attr("value", dataResult.output[0].email);
                            $("#password").attr("value", dataResult.output[0].password);
                            $("#cpassword").attr("value", dataResult.output[0].password);
                            $(".adduserbtn").attr("id", dataResult.output[0].id);
                            $(".adduserbtn").attr("value", "true");
                            $(".adduserbtn").text("Update User");
                            
                          },
                          error: function(response){
                            console.log(response);
                            alert(dataResult.response.responeJSON.output);
                          }
                      });
                    });
      
                    $('.deletebtn').on('click', function(event){
                      var user_id = $(this).attr('id');
                      var data2 = {
                        user_id : user_id
                      };
                      $.ajax({
                          type: "DELETE",
                          url: "http://localhost/PermataGordynMain/CRUD_API/delete/delete_user_api.php",
                          contentType: "application/json",
                          dataType: 'json',
                          data: JSON.stringify(data2),
                          cache: false,
                          success: function(dataResult){
                            console.log(dataResult)
                            alert(dataResult.output);
                            location.reload(true);
                          },
                          error: function(response){
                            console.log(response);
                            alert(dataResult.response.responeJSON.output);
                          }
                      });
                    });
                });
              },
              error: function(response){
                alert(response.responseJSON.output);
                
              }
          });
        });       

    $('.adduserbtn').on('click',function(event){
      var buttonupdate = $(this).val();
      var user_id =  $(this).attr('id');
      if(buttonupdate == "true"){
        var role =  $('#role').val();
        var name = $('#name').val();
        var email =  $('#email').val();
        var address =  $('#address').val();
        var contact = $('#contact').val();
        var postcode = $('#postcode').val();
        var data = {
          id: user_id,
          role: role,
          name: name,
          email: email,
          address: address,
          contact: contact,
          postcode: postcode
        };
        $.ajax({
            type: "PATCH",
            url: "http://localhost/PermataGordynMain/CRUD_API/update/update_user_api.php",
            contentType: "application/json",
            dataType: 'json',
            data: JSON.stringify(data),
            cache: false,
            success: function(dataResult){
              console.log(dataResult);
              alert(dataResult.output);
              location.reload(true);
            },
            error: function(response){
              console.log(response);
              alert(dataResult.response.responeJSON.output);
            }
        });
      }
      else{
        console.log("Creating User");
        var role =  $('#role').val();
        var name = $('#name').val();
        var email =  $('#email').val();
        var address =  $('#address').val();
        var contact = $('#contact').val();
        var postcode = $('#postcode').val();
        var password =  $('#password').val();
        var cpassword = $('#cpassword').val();
        var data = {
          role: role,
          name: name,
          email: email,
          address: address,
          contact: contact,
          postcode: postcode,
          password: password,
          cpassword: cpassword,
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/PermataGordynMain/CRUD_API/post/post_user_api.php",
            contentType: "application/json",
            dataType: 'json',
            data: JSON.stringify(data),
            cache: false,
            success: function(dataResult){
                console.log(dataResult);
                alert(dataResult.output);
                location.reload(true);  
            },
            error: function(response){
              console.log(response);
              alert(dataResult.response.responeJSON.output);
            }
        });
      }
    });


    $('.edit').on('click',function(event){
      var user_id =  $(this).attr('id');
      var data = { 
        user_id: user_id
      };
      $.ajax({
          type: "POST",
          url: "http://localhost/PermataGordynMain/CRUD_API/get/get_user_api2.php",
          contentType: "application/json",
          dataType: 'json',
          data: JSON.stringify(data),
          cache: false,
          success: function(dataResult){
              console.log(dataResult.output[0].id);
              $("#userid").attr("value", dataResult.output[0].id);
              $("#role").attr("value", dataResult.output[0].role);
              $("#name").attr("value", dataResult.output[0].name);
              $("#address").attr("value", dataResult.output[0].address);
              $("#contact").attr("value", dataResult.output[0].contact);
              $("#postcode").attr("value", dataResult.output[0].postcode);
              $("#email").attr("value", dataResult.output[0].email);
              $("#password").attr("value", dataResult.output[0].password);
              $("#cpassword").attr("value", dataResult.output[0].password);
              $(".adduserbtn").attr("id", dataResult.output[0].id);
              $(".adduserbtn").attr("value", "true");
              $(".adduserbtn").text("Update User");
          },
          error: function(response){
            console.log(response);
            alert(dataResult.response.responeJSON.output);
          }
      });
    });

    $('.delete').on('click',function(event){
      var user_id =  $(this).attr('id');
      var data = {user_id: user_id,};
      $.ajax({
          type: "DELETE",
          url: "http://localhost/PermataGordynMain/CRUD_API/delete/delete_user_api.php",
          contentType: "application/json",
          dataType: 'json',
          data: JSON.stringify(data),
          cache: false,
          success: function(dataResult){
            alert(dataResult.output);
            location.reload(true);  
          },
          error: function(response){
            alert(dataResult.response.responeJSON.output);
          }
      });
    });
  </script>
</body>

</html>