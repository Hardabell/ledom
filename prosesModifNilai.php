<?php

include("config.php");
	//membuat fungsi convert tanggal


if(isset($_POST['btnModif'])){

	// ambil data dari formulir
	$id = $_POST['id'];
	$introduce = $_POST['introduce'];
	$busana = $_POST['busana'];
	$catwalk = @$_POST['catwalk'];
	$wajah = $_POST['wajah'];
	$berani = $_POST['berani'];
	$qna = $_POST['qna'];
	$bakat = $_POST['bakat']; 

	
	echo '<script>alert("Data berhasil disimpan!")</script>';

	// buat query
	$sql2 = "UPDATE nilai SET introduce='$introduce', kecocokan_busana='$busana', catwalk='$catwalk', ekspresi_wajah='$wajah', keberanian_tampil='$berani', qna='$qna', bakat='$bakat' WHERE no_peserta='$id'";
	$query2 = mysqli_query($db, $sql2);
		// echo "Berhasil";
	
	// apakah query simpan berhasil?
	if( $query2 ) {
		// echo "Berhasil";
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelPeserta.php?status=sukses');
		echo '<script>alert("Data berhasil disimpan!")</script>';
		//tampilkan data
		}
	else {
		echo "Gagal";
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: tabelPeserta.php?status=gagal');
	}
	
	
} else {
	die("Akses dilarang... dua");
}
?>
