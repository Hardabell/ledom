<?php
$id=htmlspecialchars(@$_GET['id']);
$query="SELECT * FROM peserta WHERE id_peserta='$id'";
$execute=$konek->query($query);
if ($execute->num_rows > 0){
    $data=$execute->fetch_array(MYSQLI_ASSOC);
}else{
    header('location:./?page=supplier');
}
?>
<div class="panel-top panel-top-edit">
    <b><i class="fa fa-pencil-alt"></i> Ubah data</b>
</div>
<form id="form" method="POST" action="./proses/prosesubah.php">
    <input type="hidden" name="op" value="peserta">
    <input type="hidden" name="id" value="<?php echo $data['id_peserta']; ?>">
    <div class="panel-middle">
        <div class="group-input">
            <label for="supplier" >Nama Peserta :</label>
            <input type="text" value="<?php echo $data['nama_peserta']; ?>" class="form-custom" required autocomplete="off" placeholder="nama perserta" id="nama_peserta" name="nama_peserta">
            <label for="supplier" >Jenis Kelamin :</label>
            <input type="text" value="<?php echo $data['jenis_kelamin']; ?>" class="form-custom" required autocomplete="off" placeholder="Jenis Kelamin " id="jenis_kelamin" name="jenis_kelamin">
            <label for="supplier" >Tanggal Lahir :</label>
            <input type="date" value="<?php echo $data['tgl_lahir']; ?>" class="form-custom" required autocomplete="off" placeholder="Tanggal Lahir" id="tgl_lahir" name="tgl_lahir">
            <label for="supplier" >Pekerjaan :</label>
            <input type="text" value="<?php echo $data['pekerjaan']; ?>" class="form-custom" required autocomplete="off" placeholder="Pekerjaan" id="pekerjaan" name="pekerjaan">
            <label for="supplier" >Usia :</label>
            <input type="text" value="<?php echo $data['usia']; ?>" class="form-custom" required autocomplete="off" placeholder="Usia" id="usia" name="usia">

            
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>