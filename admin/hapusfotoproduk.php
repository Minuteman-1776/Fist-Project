<?php
$id_foto = $_GET["idfoto"];
$id_produk = $_GET["idproduk"];

//Ambil dulu datanya
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto'");
$semuafoto = $ambilfoto->fetch_assoc();

$namafilefoto = $semuafoto["nama_produk_foto"];
//Hapus file foto dari folder
unlink("../foto_produk/".$namafilefoto);
//Hapus data di Mysql
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");

//Tampilkan Pesan
echo "<script>alert('Foto produk berhasil terhapus')</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";

// echo "<pre>";
// print_r($namafilefoto);
// echo "</pre>";

?>
