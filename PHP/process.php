<?php

session_start();

$id = 0;
$update = false;
$name='';
$description='';
$product_id='';
$user = "root";
$pass = "";
$host = "localhost";
$dbdb = "permatagordyn";
    
$conn = new mysqli($host, $user, $pass, $dbdb);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['submit'])){
    $product_id = $_POST['prodid'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO category (product_id, name, description) VALUES('$product_id', '$name', '$description')") or die($conn->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM category WHERE id=$id") or die($conn->error());
    $conn->query("ALTER TABLE category AUTO_INCREMENT=1") or die($conn->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");

}
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM category WHERE id=$id") or die($conn->error());
    if (count(array($result))==1){
        $row = $result->fetch_array();
        $product_id = $row['product_id'];
        $name = $row['name'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id2'];
    $product_id = $_POST['prodid'];
    $name= $_POST['name'];
    $description = $_POST['description'];


    $conn->query("UPDATE category SET product_id= '$product_id', name='$name', description='$description' WHERE id=$id")
    or die($conn->error);

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: index.php");
}
?>