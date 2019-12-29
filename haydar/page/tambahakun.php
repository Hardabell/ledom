<div class="panel-top">
    <b class=""><i class="fa fa-plus-circle"></i> Tambah Admin</b>
</div>
<form id="form" method="POST" action="./proses/prosestambah.php">
    <input type="hidden" name="op" value="akun">
    <div class="panel-middle">
        <div class="group-input">
            <label for="supplier" >Nama Admin :</label>
             <input type="text" value="" class="form-custom" required autocomplete="off" placeholder="nama admin" id="nama_admin" name="nama_admin">
            <label for="supplier" >Email :</label>
            <input type="email" value="" class="form-custom" required autocomplete="off" placeholder="Email" id="email_admin" name="email_admin">
            <label for="supplier" >Password :</label>
            <input type="password" value="" class="form-custom" required autocomplete="off" placeholder="Password" id="password" name="password">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>