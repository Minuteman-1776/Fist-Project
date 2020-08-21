<h2>Tambah Pelanggan</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat">
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="number" class="form-control" name="notelepon">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php
    if (isset($_POST['save']))
    {
        $koneksi->query("INSERT INTO pelanggan(nama_pelanggan,email_pelanggan,telepon_pelanggan,password_pelanggan,alamat_pelanggan)
        VALUES('$_POST[nama]','$_POST[email]','$_POST[notelepon]','$_POST[password]','$_POST[alamat]')");

        echo "<div class='alert alert-info'>Data tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
    }
?>