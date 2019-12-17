<?php

include("config.php");

if( isset($_GET['idContent']) ){
	
	// ambil id dari query string
	$id = $_GET['idContent'];
	
	// buat query hapus
	$sql = "DELETE FROM kriteria WHERE id_kriteria=$id";
	$query = mysqli_query($db, $sql);
	
	// apakah query hapus berhasil?
	if( $query ){
		
		header('Location: tabelKriteria.php');
		}
	else {
		die("gagal menghapus...");
	}
	
} else {
	die("akses dilarang...");
}

?>
