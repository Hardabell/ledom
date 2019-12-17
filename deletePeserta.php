<?php

include("config.php");

if( isset($_GET['idContent']) ){
	
	// ambil id dari query string
	$id = $_GET['idContent'];
	
	// buat query hapus
	$sql = "DELETE FROM nilai,peserta WHERE no_peserta=$id";
	$query = mysqli_query($db, $sql);
	$sql2 = "DELETE FROM nilai WHERE no_peserta=$id";
	$query2 = mysqli_query($db, $sql2);
	
	// apakah query hapus berhasil?
	if( $query ){
		
		header('Location: tabelPeserta.php');
		}
	else {
		die("gagal menghapus...");
	}
	
} else {
	die("akses dilarang...");
}

?>
