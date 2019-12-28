<?php
$id=htmlspecialchars(@$_GET['id']);
$query="SELECT id_lomba,nama_lomba FROM lomba WHERE id_lomba='$id'";
$execute=$konek->query($query);
if ($execute->num_rows > 0){
    $data=$execute->fetch_array(MYSQLI_ASSOC);
}else{
    header('location:./?page=barang');
}
?>
<div class="panel-top panel-top-edit">
    <b><i class="fa fa-pencil-alt"></i> Ubah data</b>
</div>
<form id="form" method="POST" action="./proses/prosesubah.php">
    <input type="hidden" name="op" value="lomba">
    <input type="hidden" name="id" value="<?php echo $data['id_lomba']; ?>">
    <div class="panel-middle">
        <div class="group-input">
            <label for="barang" >Nama Lomba :</label>
            <input type="text" value="<?php echo $data['nama_lomba']; ?>" class="form-custom" required autocomplete="off" placeholder="Nama Barang" id="lomba" name="lomba">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>