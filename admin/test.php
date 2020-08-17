<?php
    if (isset($_POST['login']))
    {
        $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
        AND password = '$_POST[pass]'");
        $yangcocok = $ambil->num_rows;
        if ($yangcocok==1)
        {
            $_SESSION['admin']=$ambil->fetch_assoc();
            echo "<div class='alert alert-info'>Login Sukses</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
        else
        {
            echo "<div class='alert alert-danger'>Login Gagal</div>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
        }
    }
?>