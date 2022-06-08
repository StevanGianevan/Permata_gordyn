<?php
include_once 'connection.php';
include_once 'usersdb.php';

$database = new Database();
$db = $database->getConnection();
$usersdb = new UsersDb($db);
session_start();

$update = false;
$prodname='';
$description='';
$prodid='';
$catid='';
$prodprice='';
$prodcolor='';
$image='';
$image2='';
$image3='';


if (isset($_POST['submit'])){
    $target = "product/image1".basename($_FILES['image'] ['name']);
    $prodname = $_POST['prodname'];
    $description = $_POST['description'];
    $prodid = $_POST['prodid'];
    $catid = $_POST['catid'];
    $prodprice = $_POST['prodprice'];
    $prodcolor = $_POST['prodcolor'];
    $image = $_FILES ['image'] ['name'];

    $qry = "INSERT INTO product (category_id, name, prize, colour, image1) VALUES ('$catid', '$prodname', '$prodprice', '$prodcolor', '$image')";
	$insertProduct = $usersdb->conn->prepare($qry);
	$insertProduct->execute();
    

    

    
}