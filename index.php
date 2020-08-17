<?php
    session_start();
    //koneksi ke database
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Online Shop</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
    
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <!-- Konten -->
    <seciotn class="konten">
        <div class="container">
            <h1>Produk Terbaru</h1>
            

            <div class="row">
                
                <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while($perproduk = $ambil->fetch_assoc()){ ?>

                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" width="150">
                        <div class="caption">
                            <h3><?php echo $perproduk['nama_produk']; ?></h3>  
                            <h6><?php echo $perproduk['deskripsi_produk']; ?></h6>  
                            <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5> 
                            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                            <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default">Detail</a>          
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </seciotn>
    </body>
</html>