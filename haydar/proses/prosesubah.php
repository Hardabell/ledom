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
switch ($op){
    case 'lomba':
        $query="UPDATE lomba SET nama_lomba='$lomba' WHERE id_lomba='$id'";
        $crud->update($query,$konek,'./?page=lomba');
        break;
    case 'peserta':
        $query="UPDATE peserta SET nama_peserta='$nama_peserta',jenis_kelamin='$jenis_kelamin',tgl_lahir='$tgl_lahir',pekerjaan='$pekerjaan',usia='$usia' WHERE id_peserta='$id'";
        $crud->update($query,$konek,'./?page=peserta');
        break;
    case 'kriteria':
        $cek="SELECT nama_kriteria FROM kriteria WHERE nama_kriteria='$kriteria'";
        $query="UPDATE kriteria SET nama_kriteria='$kriteria',sifat='$sifat' WHERE id_kriteria='$id';";
        $crud->multiUpdate($cek,$query,$konek,'./?page=kriteria');
        break;
    case 'subkriteria':
        $cek="SELECT id_nilaikriteria FROM nilai_kriteria WHERE (id_kriteria='$kriteria' AND nilai ='$nilai') OR (id_kriteria='$kriteria' AND keterangan = '$keterangan')";
        $query="UPDATE nilai_kriteria SET id_kriteria='$kriteria',nilai='$nilai',keterangan='$keterangan' WHERE id_nilaikriteria='$id'";
        $crud->multiUpdate($cek,$query,$konek,'./?page=subkriteria');
        break;
    case 'bobot':
        $query=null;
        for ($i=0;$i<count($id);$i++){
            $query.="UPDATE bobot_kriteria SET bobot='$bobot[$i]' WHERE id_bobotkriteria='$id[$i]';";
        }
        $crud->update($query,$konek,'./?page=bobot');
    break;
    case 'nilai':
        $query=null;
        for ($i=0;$i<count($id);$i++){
            $query.="UPDATE nilai_peserta SET id_nilaikriteria='$nilai[$i]' WHERE id_nilaipeserta='$id[$i]';";
        }
        $crud->update($query,$konek,'./?page=penilaian');
    break;
}