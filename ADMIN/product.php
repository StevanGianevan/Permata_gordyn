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
        <li>
          <a href="category.php"><i class="bi bi-box2-fill"></i> Category</a>
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
      <form action="" id="" class="formadmin" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-2 mb-3 mr-auto">
            <label for="validationTooltip01">Produk id</label>
            <input type="text" class="form-control ID"  name = "prodid" id="prodid" placeholder="Produk id" disabled/>
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
              <input type="file" class="custom-file-input" id="prodimage1" name="prodimage1">
              <label class="custom-file-label" for="customFile">Upload Image</label>
              <img src ="" id="image1" height="40" width="40">
            </div>
          </div>
        </div>
        <div class="text-right">
        <button id="" class="btn btn-danger ml-auto addproductbtn" type="submit" value="false">+ Produk</button>
        </div>
      </form>
      
      
      
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
            <th>Image1</th>
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
              <th><img src ="<?php echo $row['image1'] ?>" height="40" width="40"></th>
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

      $('.edit').on('click',function(event){
          var prodid = $(this).attr('id');
          var data = {
            prodid: prodid,
          };
          $.ajax({
              type: "POST",
              url: "http://localhost/PermataGordynMain/CRUD_API/get/get_product_api2.php",
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
                  $("#image1").attr('src', dataResult.output[0].image1);
                  $(".formadmin").attr("id", dataResult.output[0].product_id);
                  $(".addproductbtn").attr("value", "true");
                  $(".addproductbtn").text("Update Product");

                      
              },
              error: function(response){
                  
                console.log(response);
                alert(dataResult.response.responeJSON.output);
                  
              }
                  
      
          });
        });

      $('.formadmin').submit(function (event){
        event.preventDefault();
        console.log("ready");
        // var prodidbefore = $(this).attr('id');
        var buttonupdate = $('.addproductbtn').val();
        console.log(buttonupdate);
        
        if(buttonupdate == "true"){
          let form_data = new FormData();
          let prodidbefore = $(this).attr('id');
          let prodidnew = $('#prodid').val();
          let catid = $('#catid').val();
          let prodname = $('#prodname').val();
          let prodprice = $('#prodprice').val();
          let prodcolour = $('#prodcolour').val();
          let prodsize = $('#prodsize').val();
          let proddesc = $('#proddesc').val();
          let prodimage1 = $('#prodimage1')[0].files;
          let bool_image = false;
          console.log(prodimage1);
          if( document.getElementById("prodimage1").files.length != 0 ){
            bool_image = true;
            form_data.append('prodimage1', prodimage1[0]);
          }
          form_data.append('prodidbefore', prodidbefore);
          form_data.append('prodidnew', prodidnew);
          form_data.append('catid', catid);
          form_data.append('prodname', prodname);
          form_data.append('prodprice', prodprice);
          form_data.append('prodcolour', prodcolour);
          form_data.append('prodsize', prodsize);
          form_data.append('proddesc', proddesc);
          form_data.append('bool_image', bool_image);
          console.log(bool_image);
          $.ajax({
              type: "POST",
              url: "http://localhost/PermataGordynMain/CRUD_API/update/update_product_api.php",
              contentType: false,
              data: form_data,
              cache: false,
              processData: false,
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
          let form_data = new FormData();
          let catid = $('#catid').val();
          let prodname = $('#prodname').val();
          let prodprice = $('#prodprice').val();
          let prodcolour = $('#prodcolour').val();
          let prodsize = $('#prodsize').val();
          let proddesc = $('#proddesc').val();
          let prodimage1 = $('#prodimage1')[0].files;
          let bool_image = false;
          if(document.getElementById("prodimage1").files.length != 0 ){
            bool_image = true;
            form_data.append('prodimage1', prodimage1[0]);
          }

          form_data.append('catid', catid);
          form_data.append('prodname', prodname);
          form_data.append('prodprice', prodprice);
          form_data.append('prodcolour', prodcolour);
          form_data.append('prodsize', prodsize);
          form_data.append('proddesc', proddesc);
          form_data.append('prodimage1', prodimage1[0]);
          form_data.append('bool_image', bool_image);
          console.log(form_data);

          $.ajax({
              type: "POST",
              url: "http://localhost/PermataGordynMain/CRUD_API/post/post_product_api.php",
              contentType: false,
              data: form_data,
              cache: false,
              processData: false,
              success: function(dataResult){
                  console.log(dataResult);
                  alert(dataResult.output);
                  location.reload(true)
              },
              error: function(response){
                console.log(response);
                alert(response.responseJSON.output);
              }
          });
        

        }
      });

      $('.delete').on('click',function(event){
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