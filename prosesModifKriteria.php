<?php

include("config.php");
	//membuat fungsi convert tanggal


if(isset($_POST['btnModif'])){

	// ambil data dari formulir
	$id = $_POST['idContent'];
	$nama = $_POST['nama'];
	$bobot = $_POST['bobot'];
	echo '<script>alert("Data berhasil disimpan!")</script>';

	// buat query
	$sql2 = "UPDATE kriteria SET nama_kriteria='$nama', bobot_kriteria='$bobot' WHERE id_kriteria='$id'";
	$query2 = mysqli_query($db, $sql2);
		// echo "Berhasil";
	
	// apakah query simpan berhasil?
	if( $query2 ) {
		// echo "Berhasil";
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: tabelKriteria.php?status=sukses');
		echo '<script>alert("Data berhasil disimpan!")</script>';
		//tampilkan data
		}
	else {
		echo "Gagal";
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: tabelKriteria.php?status=gagal');
	}
	
	
} else {
	die("Akses dilarang... dua");
}
?>
