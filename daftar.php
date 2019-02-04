<?php
session_start();
require 'function.php';



if ( isset($_POST['submit'])) {
   if( daftar($_POST) > 0 ){
    echo "<script> alert('data tersimpan'); </script>";
    echo "<script> location = 'login.php'; </script>";
   }else{
    echo "<script> alert('data gagal disimpan'); </script>";
   }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="dist/js/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="dist/js/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="dist/css/daftar.css">
    <link rel="icon" type="image/gif" href="bb.ico">
    <title>Perpustakaan - Pendaftaran</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">BacaBukuID</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center"><u>Daftar</u></h3>
        <div class="row">
            <div class="col">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="sandi">Kata Sandi</label>
                        <input type="password" class="form-control" id="sandi" name="password1" placeholder="Kata Sandi">
                    </div>
                    <div class="form-group">
                        <label for="sandi">Kata Sandi Lagi</label>
                        <input type="password" class="form-control" id="sandi" name="password2" placeholder="Kata Sandi">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="tel" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="tel">No Handphone</label>
                        <input type="tel" class="form-control" id="tel" name="tel" placeholder="Masukkan no handphone">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="cek">
                        <label class="form-check-label" for="cek">Dengan pembuatan akun,anda menyetujui <u>syarat &
                                ketentuan</u> BacaBukuID</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary daftar">Daftar</button>
                </form>
                <hr>
                <p>Sudah Mendaftar? <a href="login.php">Masuk</a></p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="js/dist/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script>
            const button = document.querySelector('button');
            const cek = document.getElementById('cek');

            cek.addEventListener('click',function () {
                button.classList.toggle('daftar');
            });
        
    </script>
</body>

</html>