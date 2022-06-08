<?php
include_once 'connection.php';
include_once 'usersdb.php';

$database = new Database();
$db = $database->getConnection();
$usersdb = new UsersDb($db);
session_start();

if ($_POST['type']==1) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$duplicate = "SELECT * FROM users where email='$email'";
	$checkSignUp = $usersdb->conn->prepare($duplicate);
	$checkSignUp->execute();
	$rowCount = $checkSignUp->rowCount();
	if ($rowCount>0)
	{
		echo json_encode(array("statusCode"=>201));
	}
	else{
		$id = strtoupper(uniqid());
		$qry = "INSERT INTO users (id, name, email, password) VALUES ('$id', '$name', '$email', '$password')";
		$insertUser = $usersdb->conn->prepare($qry);
		$insertUser->execute();
		$rowCount = $insertUser->rowCount();

		if ($rowCount==0) {
			echo json_encode(array("statusCode"=>201));
		}else{
			echo json_encode(array("statusCode"=>200));
		}
	}
	
}


if($_POST['type']==2){
	
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	$check = "SELECT * FROM users WHERE email='$email' && password = '$password'";
	$check2 = $usersdb->conn->prepare($check);
	$check2->execute();
	$rowCount = $check2->rowCount();

	if ($rowCount>0)
		{
			while ($row = $check2->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$_SESSION['email']=$email;
				$_SESSION['name']=$name;
				echo json_encode(array("statusCode"=>200));
			}
			

			
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
	

	
	
}