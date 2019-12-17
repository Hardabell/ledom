<?php
//action.php
if(isset($_POST["action"]))
{
 include("config.php");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM kriteria";
  $result = mysqli_query($db, $query);
  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="6%">nama Kriteria</th>
     <th width="5%">Bobot</th>
     <th width="7%">Tindakan</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>'.$row['nama_kriteria'].'</td>
     <td>'.$row['bobot_kriteria'].'</td>
     <td><a name="update" href="ModifKriteria.php?idContent='.$row['id_kriteria'].'" class="btn btn-warning bt-xs update" id="'.$row["id_kriteria"].'">Ubah</a><br><br>
     <a class="btn btn-danger bt-xs delete" href="deleteKriteria.php?idContent='.$row['id_kriteria'].'">Hapus</a>
    </tr>
   ';
 }
  $output .= '</table>';
  echo $output;
 }
 //ending if awal

}
?>