<?php

session_start();

$update = false;
$prodname='';
$description='';
$prodid='';
$catid='';
$prodprice='';
$prodcolor='';
$prodsize='';
$image='';
$image2='';
$image3='';
$user = "root";
$pass = "";
$host = "localhost";
$dbdb = "permatagordyn";
    
$conn = new mysqli($host, $user, $pass, $dbdb);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['submit'])){
    $prodid = $_POST['prodid'];
    $prodname = $_POST['prodname'];
    $catid = $_POST['catid'];
    $prodprice = $_POST['prodprice'];
    $prodcolor = $_POST['prodcolor'];
    $prodsize = $_POST['prodsize'];
    $description = $_POST['description'];

    $file = $_FILES['file'];
    $fileName= $_FILES['file']['name'];
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize= $_FILES['file']['size'];
    $fileError= $_FILES['file']['error'];
    $fileType= $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed))
    {
        if($fileError === 0)
        {
            if($fileSize <1000000)
            {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            }else{
                echo "Your file is too large!";
            }

        }else{
            echo "there was an error uploading your file!";
        }
    }else{
        echo "You cannot upload files of this type!";
    }
    header("location: productadd.php?uploadsuccess");
    $productUrl="http://localhost/PermataGordynMain/uploads/".$fileNameNew;
    $conn->query("INSERT INTO product (id, category_id, name, price, colour, description, size, image1) VALUES('$prodid', '$catid','$prodname', '$prodprice', '$prodcolor', '$description', '$prodsize', '$productUrl')") or die($conn->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    
}

if (isset($_GET['delete'])){
    $prodid = $_GET['delete'];
    $conn->query("DELETE FROM product WHERE id=$prodid") or die($conn->error());
    $conn->query("ALTER TABLE product AUTO_INCREMENT=1") or die($conn->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location:productadd.php");

}
if (isset($_GET['edit'])){
    $prodid = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM product WHERE id='$prodid'") or die($conn->error());
    if (count(array($result))==1){
        $row = $result->fetch_array();
        $prodid = $row['id'];
        $prodname = $row['name'];
        $description = $row['description'];
        $prodprice = $row['price'];
        $prodsize = $row['size'];
        $prodcolor = $row['colour'];
        $image = $row['image1'];
    }
}

if (isset($_POST['update'])){
    $prodid = $_POST['prodid'];
    $prodname = $_POST['prodname'];
    $prodprice = $_POST['prodprice'];
    $prodcolor = $_POST['prodcolor'];
    $prodsize = $_POST['prodsize'];
    $description = $_POST['description'];
    $image = $_FILES['file'];
    
    $file = $_FILES['file'];
    $fileName= $_FILES['file']['name'];
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize= $_FILES['file']['size'];
    $fileError= $_FILES['file']['error'];
    $fileType= $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed))
    {
        if($fileError === 0)
        {
            if($fileSize <1000000)
            {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            }else{
                echo "Your file is too large!";
            }

        }else{
            echo "there was an error uploading your file!";
        }
    }else{
        echo "You cannot upload files of this type!";
    }
    $productUrl="http://localhost/PermataGordynMain/uploads/".$fileNameNew;
    $conn->query("UPDATE product SET id= '$prodid', name='$prodname', description='$description', price='$prodprice', colour='$prodcolor', size='$prodsize', image1='$productUrl' WHERE id=$prodid")
    or die($conn->error);

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: productadd.php");
}
?>