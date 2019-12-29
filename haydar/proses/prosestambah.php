<?php
require '../connect.php';
require '../class/crud.php';
$crud=new crud($konek);

if ($_SERVER['REQUEST_METHOD']=='GET') {
    $id=@$_GET['id'];
    $op=@$_GET['op'];
}else if ($_SERVER['REQUEST_METHOD']=='POST'){
    $id=@$_POST['id'];
    $op=@$_POST['op'];
}
$lomba=@$_POST['lomba'];
$nama_peserta=@$_POST['nama_peserta'];
$jenis_kelamin=@$_POST['jenis_kelamin'];
$tgl_lahir=@$_POST['tgl_lahir'];
$pekerjaan=@$_POST['pekerjaan'];
$usia=@$_POST['usia'];
$kriteria=@$_POST['kriteria'];
$sifat=@$_POST['sifat'];
$nilai=@$_POST['nilai'];
$keterangan=@$_POST['keterangan'];
$bobot=@$_POST['bobot'];
$nama_admin=@$_POST['nama_admin'];
$email_admin=@$_POST['email_admin'];
$password=@$_POST['password'];
switch ($op){
    case 'lomba'://tambah data barang
        $query="INSERT INTO lomba (nama_lomba) VALUES ('$lomba')";
        $crud->addData($query,$konek);
    break;
	case 'akun'://tambah data barang
        $query="INSERT INTO account (nama_admin, emai_admin, password) VALUES ('$nama_admin', '$email_admin', '$password')";
        $crud->addData($query,$konek);
    break;
    case 'peserta': //tambah data supplier
        $query="INSERT INTO peserta (nama_peserta,jenis_kelamin,tgl_lahir,pekerjaan,usia) VALUES ('$nama_peserta','$jenis_kelamin','$tgl_lahir','$pekerjaan','$usia')";
        $crud->addData($query,$konek);
    break;
    case 'kriteria'://tambah data kriteria
        $cek="SELECT nama_kriteria FROM kriteria WHERE nama_kriteria='$kriteria'";
        $query=null;
        $query="INSERT INTO kriteria (nama_kriteria,sifat) VALUES ('$kriteria','$sifat')";
        $crud->multiAddData($cek,$query,$konek);
    break;
    case 'subkriteria'://tambah data sub kriteria
        $cek="SELECT id_nilaikriteria FROM nilai_kriteria WHERE (id_kriteria='$kriteria' AND nilai ='$nilai') OR (id_kriteria='$kriteria' AND keterangan = '$keterangan')";
        $query=null;
        $query.="INSERT INTO nilai_kriteria (id_kriteria,nilai,keterangan) VALUES ('$kriteria','$nilai','$keterangan');";
        $crud->multiAddData($cek,$query,$konek);
    break;
    case 'bobot'://tambah data bobot
        $cek="SELECT id_bobotkriteria FROM bobot_kriteria WHERE id_lomba='$lomba'";
        $query=null;
        for ($i=0;$i<count($kriteria);$i++){
            $query.="INSERT INTO bobot_kriteria (id_lomba,id_kriteria,bobot) VALUES ('$lomba','$kriteria[$i]','$bobot[$i]');";
        }
        $crud->multiAddData($cek,$query,$konek);
    break;
    case 'nilai'://tambah data nilai
        $cek="SELECT id_peserta FROM nilai_peserta WHERE id_peserta='$nama_peserta'";
        $query=null;
        for ($i=0;$i<count($nilai);$i++){
            $query.="INSERT INTO nilai_peserta (id_peserta,id_lomba,id_kriteria,id_nilaikriteria) VALUES ('$nama_peserta','$lomba','$kriteria[$i]','$nilai[$i]');";
        }
        $crud->multiAddData($cek,$query,$konek);
    break;
}