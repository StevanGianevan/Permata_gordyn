<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHPCRUD></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../CSS/index.css">
    </head>
    <body>  
        <?php require_once 'productprocess.php'; ?>

        <?php 
            if (isset($_SESSION['message'])): 
        ?>

        <div id= "popup" class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
        </div>


        <?php endif ?>

        <div class="container">
        <?php 
            $conn = new mysqli($host, $user, $pass, $dbdb);
            if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
            } 
            $result = $conn->query("SELECT * FROM category") or die($conn->error);
            //pre_r($result);
            ?>
        
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Product Description</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Delete</a>  
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <?php
            function pre_r( $array){
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>
        <h1 style="center">Admin Page Product</h1>
        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" name="id2" value=" <?php echo $id; ?>">
            <div class="form-group row">
                <label for="prodid" class="col-sm-2 col-form-label">Product Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodid" name="prodid" value="<?php echo $prodid; ?>" placeholder="Product Id">
                </div>
            </div>
            <div class="form-group row">
                <label for="prodid" class="col-sm-2 col-form-label">Category Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="catid" name="catid" value="<?php echo $prodid; ?>" placeholder="Category Id">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodname" name="prodname" value="<?php echo $prodname; ?>" placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Product Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodprice" name="prodprice" value="<?php echo $prodname; ?>" placeholder="Product Price">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Product Color</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodcolor" name="prodcolor" value="<?php echo $prodname; ?>" placeholder="Product Color">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Product Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" value="" placeholder="Product Image">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>" placeholder="Product Description">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                <?php
                    if ($update ==true):
                ?>
                    <input type="submit" value="Update" name="update" class="btn btn-info"/>
                <?php else: ?>
                <input type="submit" value="Add new" name="submit" class="btn btn-primary"/>
                <?php endif; ?>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>