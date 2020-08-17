<h2>Data Pembayaran</h2>

<?php
    //Mendapatkan id_pembelian dari URL
    $id_pembeli = $_GET['id'];

    //Mendapatkan data pembayaran berdasarkan id_pembeli
    $ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembeli'");
    $detail = $ambil->fetch_assoc();

    echo "<pre>";
    print_r($detail);
    echo "</pre>";
?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?php echo $detail["nama"]; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detail["bank"]; ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detail["jumlah"]); ?></td>
            </tr>
            <tr>
                <th>Tanngal</th>
                <td><?php echo $detail["tanggal"]; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
    </div>
</div>

<form method="post">
    <div class="form-group">
        <label>No Resi Pengiriman</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih Status</option>
            <option value="Lunas">Lunas</option>
            <option value="Barang dikirim">Barang dikirim</option>
            <option value="Batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
    if (isset($_POST["proses"]))
    {
        $resi = $_POST["resi"];
        $status = $_POST["status"];

        $koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status'
            WHERE id_pembelian='$id_pembeli'");

        echo "<scrit>alert('Data pembelian terupdate'); </script>";
        echo "<script>location='index.php'; </script>";
    }
?> 