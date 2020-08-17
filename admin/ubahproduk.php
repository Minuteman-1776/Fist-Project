<h2>Ubah Produk</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<?php
    $datakategori=array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($semuadata = $ambil->fetch_assoc())
    {
        $datakategori[] = $semuadata;
    }

    // echo "<pre>";
    // print_r($datakategori);
    // echo "<pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori" id="" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value): ?>

            <option value="<?php echo $value["id_kategori"] ?>" <?php if($pecah["id_kategori"]==$value["id_kategori"]){echo "selected"; } ?> >
            <?php echo $value["nama_kategori"] ?>
            </option>
            
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Harga Rp</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="number" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10">
            <?php echo $pecah['deskripsi_produk']; ?>
        </textarea>    
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
    if (isset($_POST['ubah']))
    {
        $namafoto=$_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        //jika foto diubah
        if (!empty($lokasifoto))
        {
            move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

            $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',id_kategori='$_POST[kategori]',
            harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',
            foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]'
            WHERE id_produk='$_GET[id]'");
        }
        else //jika foto tidak diganti, maka tidak butuh script upload
        {
            $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',id_kategori='$_POST[kategori]',
            harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',
            deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
        }
        //show alert notification
        echo "<script>alert('Data produk telah diubah');</script>";
        //redirect page
        echo "<script>location='index.php?halaman=produk';</script>";
    }
?>
