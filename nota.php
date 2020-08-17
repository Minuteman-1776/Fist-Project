<?php

session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nota Pembelian</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
<body>

    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <section class="konten">
        <div class="container">
        <h2>Detail Pembelian</h2>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
            ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>

            <pre>
                <?php print_r($detail); ?>
            </pre>

            <div class="row">
                <div class="col-md-4">
                        <strong><?php echo $detail['nama_pelanggan']; ?></strong>
                        <br>
                        Tanggal: <?php echo $detail['tanggal_pembelian']; ?>
                        <br>
                        Total: <?php echo $detail['total_pembelian']; ?>
                </div>
                <div class="col-md-4">
                <strong><? php echo $detail['nama_pelanggan']; ?></strong>
                        <?php echo $detail['telepon_pelanggan']; ?> 
                        <br>
                        <?php echo $detail['email_pelanggan']; ?>
                </div>
                <div class="col-md-4">
                        <strong><?php echo $detail["alamat_tujuan"]; ?></strong>
                        <br>
                        Tarif: <?php echo number_format($detail["tarif"]); ?>
                        <br>
                        Alamat: <?php echo $detail["nama_kota"]; ?>
                </div>
            </div>

            <!-- Security script to prevent some people to see other peoples nota -->
            <?php
            //Mendapatkan id_pelanggan yang beli
            $idpelangganyangbeli = $detail["id_pelanggan"];

            //Mendapatkan id_pelanggan yang login
            $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

            if ($idpelangganyangbeli!==$idpelangganyanglogin)
            {
                echo "<script>alert('You cant');</script>";
                echo "<script>location='riwayat.php';</script>";
                exit();
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1 ?>
                    <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk
                    ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                    <?php while ($pecah=$ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama_produk']; ?></td>
                        <td><?php echo $pecah['harga_produk']; ?></td>
                        <td><?php echo $pecah['jumlah']; ?></td>
                        <td>
                            <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan lakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                            <strong>BANK MANDIRI AN. Alfatah Wibisono No. Rekening 176-001.... Lol just kidding mate we're not goin' so that far :v</strong>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>
</html>