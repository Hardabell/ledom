<?php

include("config.php");

	//membuat fungsi convert tanggal


// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['btnAdd'])){

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
	$sql = "INSERT INTO nilai (no_peserta, catwalk, ekspresi_wajah, keberanian_tampil, kecocokan_busana, introduce, qna, bakat) VALUE ('$id', '$catwalk', '$wajah', '$berani', '$busana', '$introduce', '$qna', '$bakat')";
	$query = mysqli_query($db, $sql);

	// apakah query simpan berhasil?
	if( $query ) {

		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelPeserta.php?status=sukses');
		
		//tampilkan data
		}
	else {
		echo "Gagal";
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: AddPeserta.php?status=gagal');
	}
	
	
}