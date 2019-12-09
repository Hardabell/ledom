<?php

$db = mysqli_connect("localhost", "root", "", "ledom");


if(isset($_POST["submit"])){
	session_start();
	$nama = mysqli_real_escape_string($db, $_POST['nama']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);
	$cpass = mysqli_real_escape_string($db, $_POST['cpass']);
	
	if($pass == $cpass){
		$sql = "INSERT INTO account(nama_admin, emai_admin, password) VALUES('$nama','$email','$pass')";
		mysqli_query($db,$sql);
		$_SESSION['email'] = $email;
		header("location:try.php");
	}
	else{
		echo"<div class='alert alert-danger'>Password tidak cocok</div>";
	}
}
?>