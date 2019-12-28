<?php
$cookiePilih=@$_COOKIE['pilih'];
//$cookiePilih=null;
if (isset($cookiePilih) && !empty($cookiePilih)){
/***************awal set variabel************/
    $valueMinMax=array(); $kriteriaArray=array(); $supplierArray=array(); $forminmax=array(); $simpanNormalisasi=array(); $bobotArray=array();
    $querykriteria="SELECT nama_kriteria FROM kriteria";//query tabel kriteria
    //query get data alternative
    $queryAlternative="SELECT peserta.nama_peserta AS nama_peserta,id_peserta FROM nilai_peserta INNER JOIN peserta USING(id_peserta) WHERE id_lomba='$cookiePilih' GROUP BY id_peserta ";
    //query get data bobot
    $queryBobot="SELECT id_kriteria,bobot FROM bobot_kriteria WHERE id_lomba='$cookiePilih'";
    //query get data nilai
    $indexArray=0;//variabel index array
/***************akhir set variabel************/
    $executeBobot=$konek->query($queryBobot);
    if ($executeBobot->num_rows>0) {
        while ($dataBobot=$executeBobot->fetch_array(MYSQLI_ASSOC)) {
            $bobotArray[$dataBobot['id_kriteria']]=@$dataBobot['bobot'];
        }
    }
/////////////////////////////////////////////////////////////////awal set header table matriks keputusan
$executeQueryTabel=$konek->query( $querykriteria);
echo "<div class='panel-middle'>";
echo "<p><b>Matriks Keputusan</b></p><table><tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th></tr><tr>";
while ($data=$executeQueryTabel->fetch_array(MYSQLI_ASSOC)){
    echo "<th>$data[nama_kriteria]</th>";
    array_push($kriteriaArray,$data['nama_kriteria']);//simpan nama nama kriteria ke array
}
echo "</tr>";
/////////////////////////////////////////////////////////////////akhir set header table matriks keputusan
/******awal isi table matriks keputusan****/
$executeGetAlternative=$konek->query($queryAlternative);
$colspan=$executeQueryTabel->num_rows+1;
if ($executeGetAlternative->num_rows > 0){
    while ($dataAlternative=$executeGetAlternative->fetch_array(MYSQLI_ASSOC)){
        echo"<tr id=\"data\"><td>$dataAlternative[namaSupplier]</td>";
        $queryGetNilai="SELECT nilai_kriteria.nilai AS nilai,kriteria.sifat AS sifat,nilai_peserta.id_kriteria AS id_kriteria FROM nilai_peserta JOIN kriteria ON kriteria.id_kriteria=nilai_peserta.id_kriteria JOIN nilai_kriteria ON nilai_kriteria.id_nilaikriteria=nilai_peserta.id_nilaikriteria WHERE (id_lomba='$cookiePilih' AND id_peserta='$dataAlternative[id_peserta]')";
        $executeNilai=$konek->query($queryGetNilai);
        $i=0;
        while ($dataNilai=$executeNilai->fetch_array(MYSQLI_ASSOC)){
            echo "<td>$dataNilai[nilai]</td>";
            $nilaiSupplier[$indexArray][$i]=array("sifat"=>$dataNilai['sifat'],"id_kriteria"=>$dataNilai['id_kriteria']);
            $forminmax[$dataNilai['id_kriteria']][$indexArray]=$dataNilai['nilai'];
            $i++;
        }
            echo "</tr>";
            $supplierArray[$indexArray]=["nama_peserta"=>$dataAlternative['nama_peserta'],"id_peserta"=>$dataAlternative['id_peserta']];
            $indexArray++;
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
/******akhir isi table matriks keputusan****/
/////////////////////////////////////////////////////////////////awal set header table normalisasi
echo "<p><b>Normalisasi Matriks Keputusan</b></p><table><tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th></tr><tr>";
foreach ($kriteriaArray as $nama_kriteria) {
    echo "<th>$nama_kriteria</th>";
}
echo "</tr>";
/////////////////////////////////////////////////////////////////akhir set header table normalisasi
/******awal isi table normalisasi****/
if (!empty($supplierArray)){
    $simpanrangking=array();
    if (!empty($bobotArray)) {
        for ($j=0; $j< count($supplierArray); $j++) { 
            echo "<tr id=\"data\"><td>".$supplierArray[$j]['nama_peserta']."</td>";
                for ($k=0; $k<count($nilai_peserta[$j]) ; $k++) {
                    $idKriteria=$nilai_peserta[$j][$k]['id_kriteria'];
                    echo "<td>".$hasil=normalisasi($forminmax[$idKriteria][$j],$forminmax[$idKriteria],$nilai_peserta[$j][$k]["sifat"])."</td>";
                    $simpanrangking[$j][$k]=floatval($hasil)*$bobotArray[$id_kriteria];
                }
            echo"</tr>";
        }
    }else{
        echo "<tr class='text-center'><td colspan=\"$colspan\"><b>Bobot Kriteria tidak boleh kosong</b></td></tr>";
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
/******akhir isi table normalisasi****/
/////////////////////////////////////////////////////////////////awal set header table perangkingan
echo "<p><b>Normalisasi Matriks Keputusan</b></p> <table> <tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th><th rowspan='2'>Hasil</th></tr><tr>";
foreach ($kriteriaArray as $namaKriteria) {
    echo "<th>$nama_kriteria</th>";
}
echo "</tr>";
/////////////////////////////////////////////////////////////////akhir set header table perangkingan
/******awal isi table perangkingan****/
if (!empty($supplierArray)){
    if (!empty($bobotArray)) {
        for ($j=0; $j< count($supplierArray); $j++) {
            $hasilakhir=0;
            echo "<tr id=\"data\"><td>".$supplierArray[$j]['nama_peserta']."</td>";
                for ($k=0; $k<count($simpanrangking[$j]) ; $k++) {
                    echo "<td>".$hasil=$simpanrangking[$j][$k]."</td>";
                    $hasilakhir+=floatval($hasil);
                }
                    echo "<td>".round($hasilakhir,3)."</td>";
            echo"</tr>";
        }
    }else{
        echo "<tr class='text-center'><td colspan=\"$colspan\"><b>Bobot Kriteria tidak boleh kosong</b></td></tr>";
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
    $queryHasil="SELECT hasil.hasil AS hasil,lomba.nama_lomba,peserta.nama_peserta AS nama_peserta FROM hasil JOIN lomba ON lomba.id_lomba=hasil.id_lomba JOIN peserta ON peserta.id_peserta=hasil.id_peserta WHERE hasil.hasil=(SELECT MAX(hasil) FROM hasil WHERE id_lomba='$cookiePilih')";
    $execute=$konek->query($queryHasil)->fetch_array(MYSQLI_ASSOC);
    echo "<p>Jadi rekomendasi pemilihan supplier <i>$execute[nama_lomba]</i> jatuh pada <i>$execute[nama_peserta]</i> dengan Nilai <b>".round($execute['hasil'],3)."</b></p>";
echo "</div>";
}