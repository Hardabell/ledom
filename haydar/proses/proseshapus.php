<?php
require '../connect.php';
require '../class/crud.php';
if ($_SERVER['REQUEST_METHOD']=='GET') {
    $id=@$_GET['id'];
    $op=@$_GET['op'];
}else if ($_SERVER['REQUEST_METHOD']=='POST'){
    $id=@$_POST['id'];
    $op=@$_POST['op'];
}
$crud=new crud();
switch ($op){
    case 'barang':
        $query="DELETE FROM lomba WHERE id_lomba='$id'";
        $crud->delete($query,$konek);
        break;
    case 'supplier':
        $query="DELETE FROM peserta WHERE id_peserta='$id'";
        $crud->delete($query,$konek);
        break;
    case 'kriteria':
        $query="DELETE FROM kriteria WHERE id_kriteria='$id'";
        $crud->delete($query,$konek);
        break;
    case 'subkriteria':
        $query="DELETE FROM nilai_kriteria WHERE id_nilaikriteria='$id'";
        $crud->delete($query,$konek);
        break;
    case 'bobot':
        $query="DELETE FROM bobot_kriteria WHERE id_lomba='$id'";
        $crud->delete($query,$konek);
        break;
    case 'nilai':
        $query="DELETE FROM nilai_peserta WHERE id_peserta='$id'";
        $crud->delete($query,$konek);
        break;
	case 'akun':
        $query="DELETE FROM account WHERE id_admin='$id'";
        $crud->delete($query,$konek);
        break;
}