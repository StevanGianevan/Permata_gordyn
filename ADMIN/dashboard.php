<?php 
session_start();

$sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_product_api.php";
$konten = file_get_contents($sumber);
$data = json_decode($konten, true);
$jumlah_produk = count($data['output']);

$usersumber = "http://localhost/PermataGordynMain/CRUD_API/get/list_user_api.php";
$usercontent = file_get_contents($usersumber);
$userdata = json_decode($usercontent, true);
$jumlah_user = count($userdata['output']);

$odersumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_order_invoice_api.php";
$orderkonten = file_get_contents($odersumber);
$orderdata = json_decode($orderkonten, true);
$jumlah_order = count($orderdata['output']);
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
  <title>Permata Gordyn | Admin Page</title>
</head>

<body>
  <!--Template-->
  <?php include 'template.php'; ?>

    <div class="col" id="body-col">
      <div class="box">
        <p>Dashboard</p>
      </div>
      <div class="row">
        <div class="col-md-2 mb-3">
          <div class="card text-white bg-dark">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold">Product</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_produk?> Produk</div>
                </div>
                <div class="col-auto">
                  <i class="bi bi-boxes" style="font-size: 30px;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="card text-white bg-success">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold">Order</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_order?> order</div>
                </div>
                <div class="col-auto">
                  <i class="bi bi-journal" style="font-size: 30px;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="card text-white bg-warning">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold">Penghasilan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 2.000.000</div>
                </div>
                <div class="col-auto">
                  <i class="bi bi-cash-stack" style="font-size: 30px;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="card text-white bg-danger">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="font-weight-bold">User</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_user?> Orang</div>
                </div>
                <div class="col-auto">
                  <i class="bi bi-person" style="font-size: 30px;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              Chart Penjualan
            </div>
            <div class="card-body">
              <canvas class="chart" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>