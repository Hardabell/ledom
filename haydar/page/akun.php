
<div class="panel">
    <div class="panel-middle" id="judul">
        <div id="judul-text">
            <h2 class="">Admin Model</h2>
        </div>
    </div>
</div>
<!-- judul -->
<div class="row">
   
    <div class="col-8">
        <div class="panel">
            <div class="panel-top">
                <b class="  ">Daftar Admin</b>
            </div>
            <div class="panel-middle">
                <div class="table-responsive">
                    <table >
                        <thead><tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>                 
                       </tr></thead>
                        <tbody>
                        <?php
                        $query="SELECT * FROM account";
                        $execute=$konek->query($query);
                        if ($execute->num_rows > 0){
                            $no=1;
                            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                echo"
                                <tr id='data'>
                                    <td>$no</td>
                                    <td>$data[nama_admin]</td>
                                    <td>$data[emai_admin]</td>
                                    <td>
                                    <div class='norebuttom'>
                                    <a class=\"btn btn-light-green\" href='./?page=akun&aksi=ubah&id=".$data['id_admin']."'><i class='fa fa-pencil-alt'></i></a>
                                    <a class=\"btn btn-yellow\" data-a=".$data['nama_admin']." id='hapus' href='./proses/proseshapus.php/?op=akun&id=".$data['id_admin']."'><i class='fa fa-trash-alt'></i></a>
                                    </div></td>
                                </tr>";
                                $no++;
                            }
                        }else{
                            echo "<tr><td  class='text-center text-green' colspan='3'>Kosong</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-bottom"></div>
        </div>
    </div>
     <div class="col-4">
        <div class="panel">
            <?php
            if (@htmlspecialchars($_GET['aksi'])=='ubah'){
                include 'ubahakun.php';
            }else{
                include 'tambahakun.php';
            }
            ?>
        </div>
    </div>
</div>