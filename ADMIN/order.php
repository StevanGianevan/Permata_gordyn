<?php 
session_start();

$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_order_invoice_api.php";
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
  <title>Permata Gordyn | Admin Product</title>
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
        <li  class="active">
          <a href="order.php"><i class="bi bi-journal"></i> Order</a>
        </li>
        <li>
          <a href="category.php"><i class="bi bi-box2-fill"></i> Category</a>
        </li>
        <li>
          <a href="product.php"><i class="bi bi-boxes"></i> Product</a>
        </li>
        <li>
          <a href="user.php"><i class="bi bi-person"></i> User</a>
        </li>
      </ul>
    </div>
    <div class="col" id="body-col">
      <div class="box">
        <p>Order</p>
      </div>
    <hr>
    <div class="container p-0" style="max-width: 500px;margin-left:0px;">
      <div class="row">
        <div class="col-sm">
          <label for="validationTooltip01">Search Order by User Name</label>
          <input type="text" class="form-control mb-3" id="user_name" placeholder="Name" style="width: 250px;">
        </div>
        <div class="col-sm">
          <label for="order_option">Status</label>
          <select class="form-control order_status" id="" name="">
            <option value="IN_PROCESS">IN_PROCESS</option>
            <option value="DECLINED">DECLINED</option>
            <option value="PAID">PAID</option>
            <option value="UNPAID">UNPAID</option>
          </select>
        </div>
      </div>
      <button id="" class="btn btn-danger search_order_btn" value="false">Search Orders</button>
    </div>
    <hr>
    <div>
      
        <div id="search_result" class="table table-hover d-none">
        <p class="text-center h3">Search Order</p>
          <table class="table table-hover" id="searched_products">
            <thead class="thead-dark" style="text-transform: uppercase;">
              <tr>
                <th>INVOICE ID</th>
                <th>USER_ID</th>
                <th>Name</th>
                <th>Metode_Pembayaran</th>
                <th>Status</th>
                <th>Action</th>
              </tr> 
            </thead>
            <tbody id="search_body"> </tbody>
          </table>
        </div>
        <hr>
    </div>
    <div class="col" id="body-col">
    <table class="table table-hover">
      <p class="text-center h3">List Order</p>
        <thead class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>Invoice ID</th>
            <th>user_id</th>
            <th>name</th>
            <th>metode_pembayaran</th>
            <th>status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php if ($data['output'] != 'Data not found') { ?>
          <?php foreach ($data['output'] as $row) { ?> 
              <tr>
                <th scope="row"><?php echo $row['id']?></th>
                <th><?php echo $row['user_id']?></th>
                <th><?php echo $row['name']?></th>
                <th><?php echo $row['metode_pembayaran']?></th>
                <th><?php echo $row['status']?></th>
                <th class="col-1 text-center">
                  <button id="<?php echo $row['id']?>" class="btn accept" style="background-color: transparent; color:green"><i class="bi bi-check-lg"></i></button>
                  <button id="<?php echo $row['id']?>" class="btn reject" style="background-color: transparent; color:red"><i class="bi bi-exclamation-lg"></i></button>
                </th>
              </tr>
        <?php }} ?>
        </tbody>
      </table>
  </div>
  </div>
    
  </div>

  
  <script>
    jQuery(document).ready(function () {
      $('.search_order_btn').on('click',function(event){
        $('#search_result').removeClass('d-none');
        var user_name = $('#user_name').val();
        var order_status = $('.order_status').val();
        var data = { 
          user_name: user_name,
          order_status: order_status
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/PermataGordynMain/CRUD_API/get/get_order_invoice_api2.php",
            contentType: "application/json",
            dataType: 'json',
            data: JSON.stringify(data),
            cache: false,
            success: function(dataResult){
              $(dataResult.output).each(function(i, result){
              
                $('#search_body').append($("<tr>")
                  .append($("<td>").append(result.id))
                  .append($("<td>").append(result.user_id))
                  .append($("<td>").append(result.name))
                  .append($("<td>").append(result.metode_pembayaran))
                  .append($("<td>").append(result.status))
                  .append($("<td>").append($(document.createElement('button')).prop({
                      type: 'button',
                      innerHTML: '<i class="bi bi-check-lg"></i>',
                      id: result.id,
                      class: 'approvebtn',
                      style: 'color: green; background-color: transparent; border: none'
                  }),
                  $(document.createElement('button')).prop({
                      type: 'button',
                      innerHTML: '<i class="bi bi-exclamation-lg"></i>',
                      id: result.id,
                      class: 'declinebtn',
                      style: 'color: red; background-color:transparent; border: none; '
                  })
                  )));

                  $('.approvebtn').on('click', function(event){
                    var invoice_id = $(this).attr('id');
                    var status = 'PAID';
                    var data2 = {
                      status : status,
                      invoice_id : invoice_id
                    }
                    $.ajax({
                        type: "PATCH",
                        url: "http://localhost/PermataGordynMain/CRUD_API/update/update_invoice_api.php",
                        contentType: "application/json",
                        dataType: 'json',
                        data: JSON.stringify(data2),
                        cache: false,
                        success: function(dataResult){
                          console.log(dataResult);
                          alert(dataResult.output);
                          location.reload(true);
                        },
                        error: function(response){
                          alert(response.responseJSON.output);
                        }
                    });
                  });

                  $('.declinebtn').on('click', function(event){
                    var invoice_id = $(this).attr('id');
                    var status = 'DECLINED';
                    var data2 = {
                      status : status,
                      invoice_id : invoice_id
                    }
                    $.ajax({
                        type: "PATCH",
                        url: "http://localhost/PermataGordynMain/CRUD_API/update/update_invoice_api.php",
                        contentType: "application/json",
                        dataType: 'json',
                        data: JSON.stringify(data2),
                        cache: false,
                        success: function(dataResult){
                          alert(dataResult.output);
                          location.reload(true);
                        },
                        error: function(response){
                          location.reload(true);
                          alert(response.responseJSON.output);
                        }
                    });
                  });
              });
            },
            error: function(response){
              console.log(response.responseJSON.output);
              alert(response.responseJSON.output);
              
            }
        });
      }); 

      $('.accept').on('click',function(event){
          var invoice_id = $(this).attr('id');
          var status = 'PAID';
          var data = {
            invoice_id: invoice_id,
            status: status
          };
          console.log(invoice_id);
          $.ajax({
              type: "PATCH",
              url: "http://localhost/PermataGordynMain/CRUD_API/update/update_invoice_api.php",
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
      });

      $('.reject').on('click',function(event){
          var invoice_id = $(this).attr('id');
          var status = 'DECLINED';
          var data = {
            invoice_id: invoice_id,
            status: status
          };
          console.log(invoice_id);
          $.ajax({
              type: "PATCH",
              url: "http://localhost/PermataGordynMain/CRUD_API/update/update_invoice_api.php",
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
      });



    });
  </script>
</body>

</html>