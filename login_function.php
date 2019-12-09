<?php

$db = mysqli_connect("localhost", "root", "", "ledom");


if(isset($_POST["submit"])){
	session_start();
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);
	
	$sql = "SELECT * FROM account WHERE emai_admin='$email' AND password='$pass'";
	$ceklogin = mysqli_query($db,$sql);
	
	if(mysqli_num_rows($ceklogin) == 1){
		$_SESSION['email'] = $email;
		header("location:try.php");
	}
	else{
		echo"<div class='alert alert-danger'>Password tidak cocok</div>";
	}
}
?>