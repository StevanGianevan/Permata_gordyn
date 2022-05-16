<?php
include "coba.php";

testfungsi(1,3);
    if (isset($_POST['signup'])){
        $namesignup = $_POST['names'];
        $emailsignup = $_POST['emails'];
        $passwordsignup = md5($_POST['passwords']);
        $cpasswordsignup = md5($_POST['cpasswords']);
    
            $con = mysqli_connect("localhost", "root", "" , "permata_gordyn");
            $sql = "SELECT id FROM users WHERE email='$emailsignup'"; //
            echo var_dump($sql);
            $query = mysqli_query($con,$sql); //satuin query yang mau diambil dengan tabel menggunakan connection
            echo var_dump($query);
            $num = mysqli_num_rows ($query);
    
            if($num == 1) // ngecek username 
            {
                echo 'email is taken';
            }
            else
            {
                $sql = "INSERT INTO users (role,name,address, email, password, post_code)
                VALUES ('user','$namesignup','', '$emailsignup', '$passwordsignup','')";
                echo var_dump($sql);
    
                if (mysqli_query($con, $sql)) { //menjalankan query yang sudah dilakukan di atas
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
    }
    else if(isset($_POST['login'])){
        echo "hi login form";    
    }
?>