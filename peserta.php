<?php
//action.php
if(isset($_POST["action"]))
{
 include("config.php");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM peserta ORDER BY no_peserta";
  $result = mysqli_query($db, $query);
  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="3%">ID</th>
     <th width="6%">nama</th>
     <th width="12%">Jenis Kelamin</th>
     <th width="7%">Tanggal Lahir</th>
     <th width="10%">Pekerjaan</th>
     <th width="5%">Umur</th>
     <th width="7%">Tindakan</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>'.$row['no_peserta'].'</td>
     <td>'.$row['nama_peserta'].'</td>
     <td>'.$row['jenis_kelamin'].'</td>
     <td>'.$row['tgl_lahir'].'</td>
     <td>'.$row['pekerjaan'].'</td>
     <td>'.$row['usia'].'</td>
     <td><a class="btn btn-primary bt-xs" href="AddNilai.php?idContent='.$row['no_peserta'].'">Nilai</a><br><br><a name="update" href="ModifPeserta.php?idContent='.$row['no_peserta'].'" class="btn btn-warning bt-xs update" id="'.$row["no_peserta"].'">Ubah</a><br><br>
     <a class="btn btn-danger bt-xs delete" href="deletePeserta.php?idContent='.$row['no_peserta'].'">Hapus</a>
    </tr>
   ';
 }
  $output .= '</table>';
  echo $output;
 }
 //ending if awal

}
?>