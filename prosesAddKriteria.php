<?php

include("config.php");




// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['btnAdd'])){

	// ambil data dari formulir
	$nama = $_POST['nama'];
	$bobot = $_POST['bobot'];
	
	echo '<script>alert("Data berhasil disimpan!")</script>';
	// buat query
	$sql = "INSERT INTO kriteria (nama_kriteria, bobot_kriteria) VALUE ('$nama', '$bobot')";
	$query = mysqli_query($db, $sql);

	// apakah query simpan berhasil?
	if( $query ) {

		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelKriteria.php?status=sukses');
		
		//tampilkan data
		}
	else {
		echo "Gagal";
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: AddKriteria.php?status=gagal');
	}
	
	
}