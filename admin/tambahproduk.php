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

<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori" id="" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value): ?>

            <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
            
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Harga (Rp.)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Berat (Kg)</label>
        <input type="number" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
            <input type="file" class="form-control" name="foto[]">
        </div>

        <span class="btn btn-primary btn-tambah">
                <i class="fa fa-plus"></i>
        </span>
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>   

<?php
if (isset($_POST['save']))
{
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasifoto[0], "../foto_produk/".$namafoto[0]);

    $koneksi->query("INSERT INTO produk(nama_produk,id_kategori,harga_produk,berat_produk,foto_produk,stok_produk,deskripsi_produk)
    VALUES('$_POST[nama]','$_POST[kategori]','$_POST[harga]','$_POST[berat]','$namafoto[0]','$_POST[stok]','$_POST[deskripsi]')");

    //Mendapatkan ID produk barusan
    $id_produk_barusan = $koneksi->insert_id;

    //perulangan untuk menyimpan foto
    foreach ($namafoto as $key => $value)
    {
        $tiap_lokasi = $lokasifoto[$key];

        move_uploaded_file($tiap_lokasi,"../foto_produk/".$value);

        //Simpan ke SQL (Tapi harus tau_id produknya berapa
        $koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto)
        VALUES ('$id_produk_barusan','$value') ");
    }

    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

    // echo "<pre>";
    // print_r($_FILES["foto"]);
    // echo "</pre>";
}
?>

<!-- Jquery tambah kolom -->
<script>
    $(document).ready(function(){
        $(".btn-tambah").on("click", function(){ 
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
        })
    })
</script>

 