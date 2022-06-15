<?php 
session_start();

$wishlist_sumber = "http://localhost/PermataGordynMain/CRUD_API/get/get_wishlist_api.php";
$wishlist_konten = file_get_contents($wishlist_sumber);
$wishlist_data = json_decode($wishlist_konten, true);

$filterBy = $_SESSION['id'];
$user_wishlist_data = array_filter($wishlist_data['output'], function ($var) use ($filterBy) {
    return ($var['user_id'] == $filterBy);
});
?>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Permata Gordyn | Login Page</title>
</head>

<body>
    <!--Header-->
    <?php include 'header.php'; ?>

    <!-- Landing Page Wishlist -->
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
           <div class="col-md-10">
            <h4 class="mt-4 mb-5"><strong>Wishlist</strong></h4>
            <?php if (!empty($user_wishlist_data)) { ?>
                <?php foreach ($user_wishlist_data as $row) { ?>
                <div class="card card-body">
                    <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                        <div class="mr-2 mb-3 mb-lg-0">
                                <img src="<?php echo $row['product_img']?>" width="150" height="150" alt="">
                        </div>

                        <div class="media-body">
                            <h6 class="media-title font-weight-semibold">
                                <a href="productdetail.php?product_id=<?php echo $row['product_id']?>" data-abc="true"><?php echo $row['product_name']?></a>
                            </h6>

                            <hr>

                            <p class="mb-3"><?php echo $row['product_description']?></p>
                            
                            <hr>

                            <ul class="list-inline list-inline-dotted mb-0">
                                <!-- <li class="list-inline-item">All items from <a href="#" data-abc="true">Mobile point</a></li> -->
                                <li class="list-inline-item">You want this since  <?php echo $row['created_date']?> </li>
                            </ul>
                        </div>

                        <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                            <h3 class="mb-0 font-weight-semibold">Rp. <?php echo number_format($row['product_price'], 2)?></h3>

                            <div>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>

                            </div>
                            <div class="text-muted">1985 reviews</div>

                            <button type="button" id="<?php echo $row['product_id']?>" class="btn btn-warning mt-4 text-white add_to_cart" value="<?php echo $row['id']?>"> <i class="icon-cart-add mr-2"></i> Add to cart</button>
                            <button id="<?php echo $row['id']?>" type="button" class="btn btn-warning mt-4 text-white removebutton" data-mdb-toggle="tooltip"title="Remove item"><i class="fas fa-trash"></i></button>

                        </div>
                    </div>
                </div>
            <?php }}?>
        </div>                     
        </div>
    </div>

    <script>
        jQuery(document).ready(function () { 
            $('.removebutton').on('click', function() {
                console.log("ready!");
                var wishlist_id =  $(this).attr('id');
                var data = {wishlist_id: wishlist_id};
                $.ajax({
                    type: "DELETE",
                    url: "http://localhost/PermataGordynMain/CRUD_API/delete/delete_wishlist_api.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    // cache: false,
                    success: function(data){
                        alert(data.output);
                        location.reload(true);
                    },
                    error: function(dataResult){
                        alert(dataResult.responseJSON.output);
                        
                    }
                });
            });

            $('.add_to_cart').on('click', function() {
                console.log("ready!");
                var wishlist_id = $(this).attr('value');
                var product_id =  $(this).attr('id');
                var user_id = '<?php echo $_SESSION['id'];?>';
                var data = { 
                            product_id: product_id,
                            user_id: user_id,
                            wishlist_id: wishlist_id
                        };
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PermataGordynMain/CRUD_API/post/post_cart_api2.php",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: function(data){
                        alert(data.output);
                        location.reload(true);
                    },
                    error: function(dataResult){
                        alert(dataResult.responseJSON.output);
                        
                    }
                });
            });

        });
    </script>