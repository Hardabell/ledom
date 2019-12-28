<div class="panel-top">
    <b class=""><i class="fa fa-plus-circle "></i> Tambah data</b>
</div>
<form id="form" method="POST" action="./proses/prosestambah.php">
    <input type="hidden" name="op" value="lomba">
    <div class="panel-middle">
        <div class="group-input">
            <label for="barang" >Nama Lomba :</label>
            <input type="text" class="form-custom" required autocomplete="off" placeholder="Nama Barang" id="lomba" name="lomba">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>