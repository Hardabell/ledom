<div class="panel-top">
    <b class=""><i class="fa fa-plus-circle"></i> Tambah Peserta</b>
</div>
<form id="form" method="POST" action="./proses/prosestambah.php">
    <input type="hidden" name="op" value="peserta">
    <div class="panel-middle">
        <div class="group-input">
            <label for="supplier" >Nama Peserta :</label>
             <input type="text" value="" class="form-custom" required autocomplete="off" placeholder="nama perserta" id="nama_peserta" name="nama_peserta">
            <label for="supplier" >Jenis Kelamin :</label>
            <input type="text" value="" class="form-custom" required autocomplete="off" placeholder="Jenis Kelamin " id="jenis_kelamin" name="jenis_kelamin">
            <label for="supplier" >Tanggal Lahir :</label>
            <input type="date" value="" class="form-custom" required autocomplete="off" placeholder="Tanggal Lahir" id="tgl_lahir" name="tgl_lahir">
            <label for="supplier" >Pekerjaan :</label>
            <input type="text" value="" class="form-custom" required autocomplete="off" placeholder="Pekerjaan" id="pekerjaan" name="pekerjaan">
            <label for="supplier" >Usia :</label>
            <input type="text" value="" class="form-custom" required autocomplete="off" placeholder="Usia" id="usia" name="usia">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>