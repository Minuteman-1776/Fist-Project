<?php include 'koneksi.php'; ?>
<?php 
$keywords = $_GET["keyword"];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keywords%' 
    OR deskripsi_produk LIKE '%$keywords%'");
while ($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";

?>
<!DOCTYPE html>
    <head>
        <title>Hasil Pencarian</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
        <?php include 'menu.php' ?>
        <div class="container">
            <h3>Hasil Pencarian : <?php echo $keywords ?></h3>
            <!-- Jika Pencarian Kosong -->
            <?php if(empty($semuadata)): ?>
                <div class="alert alert-danger">Pencarian <strong><?php echo $keywords ?></strong> tidak ditemukan</div>
            <?php endif ?>
            
            <!-- Pencarian Ditemukan -->
            <div class="row">
                <?php foreach ($semuadata as $key => $value): ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
                            <div class="caption">
                                <h3><?php echo $value["nama_produk"] ?></h3>
                                <h6><?php echo $value["deskripsi_produk"] ?></h6>
                                <h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
                                <a href="beli.php?=id<?php echo $value ['id_produk'] ?>" class="btn btn-primary">Beli</a>
                                <a href="detail.php?=id<?php echo $value ['id_produk'] ?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </body>
