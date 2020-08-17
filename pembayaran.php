<?php
    session_start();
    //Database Connection
    include 'koneksi.php';

    //Preventing someone to jump to other pages by URL
    if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
    {
        echo "<script>alert('Silahkan Login');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }

    //Get customer ID
    $idpem = $_GET["id"];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
    $detpem = $ambil->fetch_assoc();

    $id_pelanggan_beli = $detpem["id_pelanggan"];

    $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

    if ($id_pelanggan_login !== $id_pelanggan_beli)
    {
        echo "<script>alert('You cant!');</script>";
        echo "<script>location='history.php';</script>";
        exit();
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pembayaran</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
        <?php include 'menu.php'; ?>

        <div class="container">
            <h2>Konfirmasi Pembayaran</h2>
            <p>Kirim bukti pembayaran Anda di sini</p>
            <div class="alert alert-info">Total tagihan anda<strong> Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>
        

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Penyetor</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Bank</label>
                    <input type="text" class="form-control" name="bank" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" min="1" required>
                </div>
                <div class="form-group">
                    <label>Foto Bukti</label>
                    <input type="file" class="form-control" name="bukti">
                    <p class="text-danger">Foto bukti harus jelas dan berformat JPG</p>
                </div>
                <button class="btn btn-primary" name="kirim">Kirim</button>
            </form>
        </div>

        <?php
            if (isset($_POST["kirim"]))
            {
                $namabukti = $_FILES["bukti"]["name"];
                $lokasibukti = $_FILES["bukti"]["tmp_name"];
                $namafiks = date("YmdHis").$namabukti;
                move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

                $nama = $_POST["nama"];
                $bank = $_POST["bank"];
                $jumlah = $_POST["jumlah"];
                $tanggal = date("Y-m-d");

                $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
                VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

                //Update status data yang sudah kirim pembayaran
                $koneksi->query("UPDATE pembelian SET status_pembelian='Purchasing done'
                WHERE id_pembelian='$idpem'");

                echo "<script>alert('Thanks lads for your purchase. We’re so lucky to have customers like you!');</script>";
                echo "<script>location='riwayat.php';</script>";
            }
        ?>

    </body>
</html>