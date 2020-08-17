<h3>Data Kategori</h3>
<hr>

<?php
    $semuadataarray = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($semuadata = $ambil->fetch_assoc())
    {
        $semuadataarray[] = $semuadata;
    }

    echo "<pre>";
    print_r($semuadataarray);
    echo "</pre>";
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($semuadataarray as $key => $value): ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value["nama_kategori"] ?></td>
            <td>
                <a href="" class="btn btn-warning btn-sm">Ubah</a>
                <a href="" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="" class="btn btn-primary">Tambah Data</a>