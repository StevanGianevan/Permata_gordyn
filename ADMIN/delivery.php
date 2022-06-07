<?php 
session_start();
$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_invoice_api3.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$user_id = $_SESSION['id'];
$filter_by_status = 'PAID';
$payload = json_encode(array("user_id" => $user_id, "filter_by_status" => $filter_by_status));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
$my_array = array();
$data = json_decode($result, true);

$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_invoice_api3.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$user_id = $_SESSION['id'];
$filter_by_status = 'SENT';
$payload = json_encode(array("user_id" => $user_id, "filter_by_status" => $filter_by_status));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
$my_array = array();
$another_data = json_decode($result, true);

$url = 'http://localhost/PermataGordynMain/CRUD_API/get/get_invoice_api3.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$user_id = $_SESSION['id'];
$filter_by_status = 'COMPLETED';
$payload = json_encode(array("user_id" => $user_id, "filter_by_status" => $filter_by_status));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
$my_array = array();
$another_one_data = json_decode($result, true);

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
  <script src="js/addons/rating.js"></script>
  <title>Permata Gordyn | Admin Page</title>
</head>

<body>
    <!--Template-->
    <?php include 'template.php'; ?>

    <div class="col" id="body-col">
      <div class="box">
        <p>Item Delivery</p>
      </div>
      <hr>
      <table class="table table-hover">
        <p class="text-center h3">Perlu Dikirim</p>
        <thead id="test_search_head"class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>ID</th>
            <th>USER ID</th>
            <th>STATUS</th>
            <th>METODE PEMBAYARAN</th>
            <th>CREATED DATE</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="test_search_body">
        <?php if ($data['output'] != 'Data not found') { ?>
          <?php foreach ($data['output'] as $row) { ?> 
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <th><?php echo $row['user_id'] ?></th>
              <th><?php echo $row['status'] ?></th>
              <th><?php echo $row['metode_pembayaran'] ?></th>
              <th><?php echo $row['created_date'] ?></th>
              <th><button id="<?php echo $row['id'] ?>" class="btn sent" style="background-color: transparent;">SENT<i class="bi bi-check-lg"></i></button></th>
            </tr>
          <?php }}?>
        </tbody>
      </table>
      <hr>
      <table class="table table-hover">
        <p class="text-center h3">Sudah Dikirim</p>
        <thead id="test_search_head"class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>ID</th>
            <th>USER ID</th>
            <th>STATUS</th>
            <th>METODE PEMBAYARAN</th>
            <th>CREATED DATE</th>
          </tr>
        </thead>
        <tbody id="test_search_body">
        <?php if ($another_data['output'] != 'Data not found') { ?>
          <?php foreach ($another_data['output'] as $row) { ?> 
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <th><?php echo $row['user_id'] ?></th>
              <th><?php echo $row['status'] ?></th>
              <th><?php echo $row['metode_pembayaran'] ?></th>
              <th><?php echo $row['created_date'] ?></th>
            </tr>
          <?php }}?>
        </tbody>
      </table>
      <hr>
      <table class="table table-hover">
        <p class="text-center h3">Pesanan Selesai</p>
        <thead id="test_search_head"class="thead-dark" style="text-transform: uppercase;">
          <tr>
            <th>ID</th>
            <th>USER ID</th>
            <th>STATUS</th>
            <th>METODE PEMBAYARAN</th>
            <th>CREATED DATE</th>
            <th>CUSTOMER REVIEW</th>
          </tr>
        </thead>
        <tbody id="test_search_body">
        <?php if ($another_one_data['output'] != 'Data not found') { ?>
          <?php foreach ($another_one_data['output'] as $row) { ?> 
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <th><?php echo $row['user_id'] ?></th>
              <th><?php echo $row['status'] ?></th>
              <th><?php echo $row['metode_pembayaran'] ?></th>
              <th><?php echo $row['created_date'] ?></th>
              <th>Reviewed</th>
            </tr>
          <?php }}?>
        </tbody>
      </table>
      </div>
      </div>

  <script>
    $('.sent').on('click',function(event){
      var invoice_id =  $(this).attr('id');
      var data = { 
        invoice_id: invoice_id,
        status: "SENT"
      };
      console.log(data);
      $.ajax({
          type: "PATCH",
          url: "http://localhost/PermataGordynMain/CRUD_API/update/update_invoice_api.php",
          contentType: "application/json",
          dataType: 'json',
          data: JSON.stringify(data),
          cache: false,
          success: function(dataResult){
              alert("Item SENT.")
              location.reload(true);
          },
          error: function(response){
            console.log(response);
            alert(dataResult.response.responeJSON.output);
          }
      });
    });

  </script>
</body>

</html>