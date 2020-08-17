<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Pelanggan</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>

    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <!-- Formulir -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button class="btn btn-primary" name="login">Login</button>  
                        </form>                     
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    //** Berikut step step script login **/

    //Jika ada tombol "Login" ditekan
    if (isset($_POST["login"]))
    {
        //Deskarasi variable untuk Email dan Password
        $email = $_POST["email"];
        $password = $_POST["password"];

        //Di dalam variable ambil, melakukan query ngecek akun di table Database
        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

        //Itung atau ambil akun yang cocok, disimpan di variable "akunyangcocok"
        $akunyangcocok = $ambil->num_rows;

        //Jika ada 1 akun yang cocok, maka diloginkan (Boolean)
        if ($akunyangcocok==1)
        {
            //Anda sudah Login
            //Mendapatkan akun dalam bentuk array
            $akun = $ambil->fetch_assoc();
            //Simpan di session pelanggan
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Anda sukses Login');</script>";

            //Jika sudah belanja
            if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
            {
                echo "<script>location='checkout.php';</script>";
            }
            //Kalau belum
            else 
            {
                echo "<script>location='riwayat.php';</script>";
            }
        }
        else
        {
            //Anda gagal Login
            echo "<script>alert('Anda gagal login, periksa akun Anda');</script>";
            echo "<script>location='login.php';</script>";
        }
    }
    ?>

    </body>
</html>