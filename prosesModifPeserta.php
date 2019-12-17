<?php

include("config.php");
	//membuat fungsi convert tanggal
function formatTanggal($date){
	$pisah = explode('/', $date);
	$urutkan = array($pisah[2], $pisah[1], $pisah[0]);
	$satukan = implode('-', $urutkan);
	return $satukan;
}

if(isset($_POST['btnModif'])){

	// ambil data dari formulir
	$id = $_POST['idContent'];
	$nama = $_POST['nama'];
	$gender = $_POST['kategori'];
	$ttl = @$_POST['ttl'];
	$pekerjaan = $_POST['pekerjaan'];
	$usia = $_POST['usia'];

	$ubahTanggal = formatTanggal($ttl);
	echo '<script>alert("Data berhasil disimpan!")</script>';

	// buat query
	$sql2 = "UPDATE peserta SET nama_peserta='$nama', jenis_kelamin='$gender', tgl_lahir='$ubahTanggal', pekerjaan='$pekerjaan', usia='$usia' WHERE no_peserta='$id'";
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
