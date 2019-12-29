<?php
$id=htmlspecialchars(@$_GET['id']);
$query="SELECT * FROM account WHERE id_admin='$id'";
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
    <input type="hidden" name="op" value="akun">
    <input type="hidden" name="id" value="<?php echo $data['id_admin']; ?>">
    <div class="panel-middle">
        <div class="group-input">
            <label for="supplier" >Nama Admin :</label>
            <input type="text" value="<?php echo $data['nama_admin']; ?>" class="form-custom" required autocomplete="off" placeholder="nama perserta" id="nama_admin" name="nama_admin">
            <label for="supplier" >Email Admin :</label>
            <input type="email" value="<?php echo $data['emai_admin']; ?>" class="form-custom" required autocomplete="off" placeholder="Jenis Kelamin " id="email_admin" name="email_admin">
            <label for="supplier" >Password :</label>
            <input type="password" value="<?php echo $data['password']; ?>" class="form-custom" required autocomplete="off" placeholder="Tanggal Lahir" id="password" name="password">
            
            
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>