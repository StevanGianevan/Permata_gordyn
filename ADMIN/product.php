<?php 
session_start();

$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_product_api.php";
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
              <a class="dropdown-item" href="#">Logout</a>
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
        <li class="active">
          <a href="product.php"><i class="bi bi-boxes"></i> Product</a>
        </li>
        <li>
          <a href="user.php"><i class="bi bi-person"></i> User</a>
        </li>
        <li>
          <a href="history.php"><i class="bi bi-clock-history"></i> History</a>
        </li>
      </ul>
    </div>

    <div class="col" id="body-col">
      <div class="box">
        <p>Product</p>
      </div>
      <div class="form-row">
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Produk id</label>
          <input type="text" class="form-control ID"  name = "prodid" id="prodid" placeholder="Produk id" />
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Kategori id</label>
          <input type="number" class="form-control kategori_id"  name = "prodid" id="catid" placeholder="Kategori id" />
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Nama Produk</label>
          <input type="text" class="form-control nama_produk"  id="prodname" placeholder="Nama Produk" />
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Harga Produk</label>
          <input type="number" class="form-control harga_produk"  id="prodprice" placeholder="Harga Produk" />
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Warna Produk</label>
          <input type="text" class="form-control warna_produk"  id="prodcolour" placeholder="Warna Produk"/>
        </div>
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip02">Size Produk</label>
          <input type="text" class="form-control size_produk"  id="prodsize" placeholder="Size Produk"/>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col">
          <label for="validationTooltip02">Product Description</label>
          <div class="custom-file">
            <input type="text" class="form-control size_produk" id="proddesc">
          </div>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col">
          <label for="validationTooltip02">Gambar Produk 1</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="prodimage1">
            <label class="custom-file-label" for="customFile">Upload Image</label>
          </div>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col">
          <label for="validationTooltip02">Gambar Produk 2</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Upload Image</label>
          </div>
        </div>
      </div>
      <div class="form-row mb-3">
        <div class="col">
          <label for="validationTooltip02">Gambar Produk 3</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Upload Image</label>
          </div>
        </div>
      </div>
      <div class="text-right">
        <button id="" class="btn btn-danger ml-auto addproductbtn" value="false">+ Produk</button>
      </div>
      <hr>
      <table class="table table-hover">
        <p class="text-center h3">List Product</p>
        <thead class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>ID</th>
            <th>Kategori ID</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Warna Produk</th>
            <th>Size Produk</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['output'] as $row) { ?> 
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <th><?php echo $row['category_id'] ?></th>
              <th><?php echo $row['name'] ?></th>
              <th>Rp. <?php echo $row['price'] ?></th>
              <th><?php echo $row['colour'] ?></th>
              <th><?php echo $row['size'] ?></th>
              <th><?php echo $row['description'] ?></th>
              <th class="col-1 text-center">
                <button id="<?php echo $row['id'] ?>" class="btn edit" style="background-color: transparent;"><i class="bi bi-pencil"></i></button>
                <button id="<?php echo $row['id'] ?>" class="btn delete" style="background-color: transparent;"><i class="bi bi-trash"></i></button>
              </th>
            </tr>
          <?php }?>
        </tbody>
        </table>
    </div>
  </div>

  <script type="text/javascript">
    jQuery(document).ready(function () {

      // $('.delete').on('click',function(event){
      //   var prodid =  $(this).attr('id');
      //   var catid = $('#catid').val();
      //   var update =  "true";
      //   var prodname =  $('#prodname').val();
      //   var prodprice = $('#prodprice').val();
      //   var prodcolour = $('#prodcolour').val();
      //   var prodsize =  $('#prodsize').val();
      //   var proddesc =  $('#proddesc').val();
      //   var data = {
      //               update: update,
      //               prodid: prodid,
      //               catid: catid,
      //               prodname: prodname,
      //               prodprice: prodprice,
      //               prodcolour: prodcolour,
      //               prodsize: prodsize,
      //               proddesc: proddesc
      //           };
      //   $.ajax({
      //       type: "POST",
      //       url: "http://localhost/PermataGordynMain/CRUD_API/post/post_product_api.php",
      //       contentType: "application/json",
      //       dataType: 'json',
      //       data: JSON.stringify(data),
      //       cache: false,
      //       success: function(dataResult){
      //           console.log(dataResult);
      //           alert(dataResult.output);

                    
      //       },
      //       error: function(response){
                
      //         console.log(response);
      //         alert(dataResult.response.responeJSON.output);
                
      //       }
                
    
      //   });
      // });

      $('.edit').on('click',function(event){
          var prodid =  $(this).attr('id');
          var update =  "false";
          
          
          var data = { 
                    prodid: prodid,
                    update: update
                  };
          $.ajax({
              type: "PATCH",
              url: "http://localhost/PermataGordynMain/CRUD_API/update/update_product_api.php",
              contentType: "application/json",
              dataType: 'json',
              data: JSON.stringify(data),
              cache: false,
              success: function(dataResult){
                  console.log(dataResult.output[0]);

                  $("#prodid").attr("value", dataResult.output[0].product_id);
                  $("#catid").attr("value", dataResult.output[0].category_id);
                  $("#prodname").attr("value", dataResult.output[0].name);
                  $("#prodprice").attr("value", dataResult.output[0].price);
                  $("#prodcolour").attr("value", dataResult.output[0].colour);
                  $("#prodsize").attr("value", dataResult.output[0].size);
                  $("#proddesc").attr("value", dataResult.output[0].description);
                  $(".addproductbtn").attr("id", dataResult.output[0].product_id);
                  $(".addproductbtn").attr("value", "true");
                  $(".addproductbtn").text("Update Product");

                      
              },
              error: function(response){
                  
                console.log(response);
                alert(dataResult.response.responeJSON.output);
                  
              }
                  
      
          });
        });

      $('.addproductbtn').on('click',function(event){
        console.log("ready");
        var buttonupdate = $(this).val();
        console.log(buttonupdate);
        var prodid =$(this).attr("id")
        if(buttonupdate == "true"){
          var update =  "true";
          console.log("true");
          var prodidnew =  $('#prodid').val();
          var catid = $('#catid').val();
          
          var prodname =  $('#prodname').val();
          var prodprice = $('#prodprice').val();
          var prodcolour = $('#prodcolour').val();
          var prodsize =  $('#prodsize').val();
          var proddesc =  $('#proddesc').val();
          var data = {
                      update: update,
                      prodid: prodid,
                      prodidnew: prodidnew,
                      catid: catid,
                      prodname: prodname,
                      prodprice: prodprice,
                      prodcolour: prodcolour,
                      prodsize: prodsize,
                      proddesc: proddesc
                  };
          $.ajax({
              type: "PATCH",
              url: "http://localhost/PermataGordynMain/CRUD_API/update/update_product_api.php",
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

        else if (buttonupdate == "false"){
          console.log("false");
          var prodid =  $('#prodid').val();
          var catid = $('#catid').val();
          var prodname =  $('#prodname').val();
          var prodprice = $('#prodprice').val();
          var prodcolour = $('#prodcolour').val();
          var prodsize =  $('#prodsize').val();
          var proddesc =  $('#proddesc').val();
          var data = { 
                      prodid: prodid,
                      catid: catid,
                      prodname: prodname,
                      prodprice: prodprice,
                      prodcolour: prodcolour,
                      prodsize: prodsize,
                      proddesc: proddesc
                  
                  };
          $.ajax({
              type: "POST",
              url: "http://localhost/PermataGordynMain/CRUD_API/post/post_product_api.php",
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

      $('.delete').on('click',function(event){
          console.log("THROUGH THIS");
          var product_id =  $(this).attr('id');
          console.log(prodid);
          var data = {product_id: product_id,};
          $.ajax({
              type: "DELETE",
              url: "http://localhost/PermataGordynMain/CRUD_API/delete/delete_product_api.php",
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
                alert(dataResult.response.responeJSON.output);
              }
        });
      });
        
  });
</script>
</body>
</html>