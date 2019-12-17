<?php

include("config.php");

	//membuat fungsi convert tanggal
function formatTanggal($date){
	$pisah = explode('/', $date);
	$urutkan = array($pisah[2], $pisah[1], $pisah[0]);
	$satukan = implode('-', $urutkan);
	return $satukan;
}

//fungsi ubah bulan
function konversi_tanggal($format, $tanggal_2="now", $bahasa="id"){
		$en = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Jan", "Feb", "Mar", "Apr", "May","Jun","Jul", "Aug","Sep", "Oct", "Nov", "Dec");
		$id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", " Agustus", "September", "Oktober", "November", "Desember");
		return str_replace($en, $bahasa, date($format.strtotime($tanggal_2)));
}

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['btnAdd'])){

	// ambil data dari formulir
	$nama = $_POST['nama'];
	$gender = $_POST['gender'];
	$ttl = @$_POST['ttl'];
	$pekerjaan = $_POST['pekerjaan'];
	$usia = $_POST['usia'];

	$ubahTanggal = formatTanggal($ttl);
	echo '<script>alert("Data berhasil disimpan!")</script>';
	// buat query
	$sql = "INSERT INTO peserta (nama_peserta, jenis_kelamin, tgl_lahir, pekerjaan, usia) VALUE ('$nama', '$gender', '$ubahTanggal', '$pekerjaan', '$usia')";
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