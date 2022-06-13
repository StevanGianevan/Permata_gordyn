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
    <!--Template-->
    <?php include 'template.php'; ?>

    <div class="col" id="body-col">
        <div class="box">
            <p>Discount Coupon</p>
        </div>
        <div class="form-row">
        <div class="col-md-2 mb-3 mr-auto">
          <label for="validationTooltip01">Discount Code</label>
          <input type="text" class="form-control" id="discount_code" placeholder="LEBARAN20" disabled>
        </div>
        <div class="col-md-4 mb-3 mr-auto">
          <label for="validationTooltip01">Discount Name</label>
          <input type="text" class="form-control" id="discount_name" placeholder="Lebaran">
        </div>
        <div class="col-md-6 mb-3 mr-auto">
          <label for="validationTooltip01">Discount Percentage</label>
          <input type="text" class="form-control" id="discount_percentage" placeholder="20%">
        </div>
        <div class="text-right ml-auto">
          <button id="" class="btn btn-danger activatediscbtn" value="false">Activate Discount</button>
        </div>
        </div>
        <hr>
    </div>
</body>

<script>
    $.ajax({
        type: "GET",
        url: "http://localhost/PermataGordynMain/CRUD_API/get/get_discount_api.php",
        contentType: "application/json",
        dataType: 'json',
        // data: JSON.stringify(data),
        cache: false,
        success: function(dataResult){
            if (dataResult.output[0].active == "TRUE"){
              $(".activatediscbtn").text("DEACTIVE DISCOUNT");
              $("#discount_name").attr("disabled", true);
              $("#discount_percentage").attr("disabled", true);
            }
            else{
              $(".activatediscbtn").text("ACTIVATE DISCOUNT");
            }
            $("#discount_code").attr("value", dataResult.output[0].code);
            $("#discount_name").attr("value", dataResult.output[0].name);
            $("#discount_percentage").attr("value", dataResult.output[0].percentage);
            $(".activatediscbtn").attr("value", dataResult.output[0].active);
            $(".activatediscbtn").attr("id", dataResult.output[0].id);
        },
        error: function(response){
          console.log(response);
          alert(response.responseJSON.output);
        }
    });

    $('.activatediscbtn').on('click',function(event){
      var id =   $(this).attr('id');
      var name =   $("#discount_name").val();
      var percentage =  $("#discount_percentage").val();
      var active = $(this).attr('value');
      var data = {discount_id:id, name: name, percentage: percentage, active: active};
      console.log(data);
      $.ajax({
          type: "PATCH",
          url: "http://localhost/PermataGordynMain/CRUD_API/update/update_discount_api.php",
          contentType: "application/json",
          dataType: 'json',
          data: JSON.stringify(data),
          cache: false,
          success: function(dataResult){
            alert(dataResult.output);
            location.reload(true);
          },
          error: function(response){
            alert(response.responseJSON.output);
          }
      });
    });
</script>