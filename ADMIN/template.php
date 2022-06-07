<?php 

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[3];

?>

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
        <li class="<?php if ($first_part=="dashboard.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        </li>
        <li class="<?php if ($first_part=="user.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="user.php"><i class="bi bi-person"></i> User</a>
        </li>
        <li class="<?php if ($first_part=="product.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="product.php"><i class="bi bi-boxes"></i> Product</a>
        </li>
        <li class="<?php if ($first_part=="category.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="category.php"><i class="bi bi-box2-fill"></i> Category</a>
        </li>
        <li class="<?php if ($first_part=="order.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="order.php"><i class="bi bi-journal"></i> Order</a>
        </li>
        <li class="<?php if ($first_part=="delivery.php") {echo "active"; } else  {echo "noactive";}?>">
          <a href="delivery.php"><i class="bi bi-person"></i> Item Delivery</a>
        </li>
      </ul>
    </div>