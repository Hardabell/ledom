<?php
require '../connect.php';
require '../class/crud.php';

$email   = $_POST['email'];
$pass       = $_POST['pass'];

$user = mysqli_query($konek,"select * from account where emai_admin='$email' and password='$pass'");
$chek = mysqli_num_rows($user);
if($chek>0)
{
	session_start();
    $row = mysqli_fetch_array($user);
    $_SESSION['nama_admin'] = $row['nama_admin'];
	header("location:../?page=beranda");
    echo $_SESSION['nama_admin'];
}else
{
    header("location:../login.php");
}
?>