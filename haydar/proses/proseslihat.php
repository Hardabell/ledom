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
    case 'subkriteria':
    if (!empty($id)) {
        $where="WHERE nilai_kriteria.id_kriteria='$id'";
    }else{
        $where=null;
    }
    $query="SELECT id_nilaikriteria,nilai,keterangan,nama_kriteria,id_kriteria FROM nilai_kriteria INNER JOIN kriteria USING (id_kriteria) $where ORDER BY id_kriteria,nilai ASC";
    $execute=$konek ->query($query);
    if ($execute->num_rows > 0){
        $no=1;
        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
            echo"
            <tr id='data'>
                <td>$no</td>
                <td>".$data['nama_kriteria']."</td>
                <td>".$data['nilai']."</td>
                <td>".$data['keterangan']."</td>
                <td><div class='norebuttom'>
                <a class=\"btn btn-light-green\" href='./?page=subkriteria&aksi=ubah&id=".$data['id_nilaikriteria']."'><i class='fa fa-pencil-alt'></i></a>
                <a class=\"btn btn-yellow\" data-a=\"nilai $data[nilai] dalam $data[nama_kriteria]\" id='hapus' href='./proses/proseshapus.php/?op=subkriteria&id=".$data['id_nilaikriteria']."'><i class='fa fa-trash-alt'</a></td></div>
            </tr>";
            $no++;
        }
    }else{
        echo "<tr><td  class='text-center text-green' colspan='4'><b>Kosong</b></td></tr>";
    }
        break;
    case 'nilai':
        if (!empty($id)) {
            $where="WHERE nilai_peserta.id_lomba='$id'";
        }else{
            $where=null;
        }
        $query="SELECT id_nilaipeserta,id_peserta,peserta.nama_peserta AS namaSupplier,lomba.id_lomba AS id_jenisbarang,lomba.nama_lomba AS namaBarang FROM nilai_peserta INNER JOIN peserta USING(id_peserta) INNER JOIN lomba USING (id_lomba) $where GROUP BY id_peserta ORDER BY id_lomba,id_peserta ASC";
        $execute=$konek->query($query);
        if ($execute->num_rows > 0){
            $no=1;
            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
               echo"
                <tr id='data'>
                    <td>$no</td>
                    <td>$data[namaBarang]</td>
                    <td>$data[namaSupplier]</td>
                    <td>
                    <div class='norebuttom'>
                    <a class=\"btn btn-green\" href=\"./?page=penilaian&aksi=lihat&a=$data[id_peserta]&b=$data[id_jenisbarang]\"><i class='fa fa-eye'></i></a>
                    <a class=\"btn btn-light-green\" href=\"./?page=penilaian&aksi=ubah&a=$data[id_peserta]&b=$data[id_jenisbarang]\"><i class='fa fa-pencil-alt'></i></a>
                    <a class=\"btn btn-yellow\" data-a=\".$data[namaBarang] - $data[namaSupplier]\" id='hapus' href='./proses/proseshapus.php/?op=nilai&id=".$data['id_peserta']."'><i class='fa fa-trash-alt'></i></a></td>
                </div></tr>";
                $no++;
            }
        }else{
            echo "<tr><td  class='text-center text-green' colspan='4'><b>Kosong</b></td></tr>";
        }
        break;
}