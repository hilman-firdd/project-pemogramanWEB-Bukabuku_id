<?php
require 'function.php';
session_start();


$id_pel = $_GET['id'];
$query4 = "SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian
WHERE pembelian.id_pembelian = '$id_pel'";
$pembayaran = tampil_data($query4);

//jika blm ada data pembayran
if(empty($pembayaran)) {
    echo "<script> alert('belum ada data pembayaran'); </script>";
    echo "<script> location = 'riwayat.php'; </script>";
    exit();
}

//jika data pelanggan yg bayar tidak sesuai dengan logn

// if( $_SESSION['pelanggan']['id_pelanggan'] !== $pembayaran['id_pelanggan']) {
//     echo "<script> alert('anda tidak berhak melihat pembayaran orang lain'); </script>";
//     echo "<script> location = 'riwayat.php'; </script>";
//     exit();
// }

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
    <link rel="stylesheet" href="dist/css/riwayat.css">
    <link rel="icon" type="image/gif" href="bb.ico">

    <title>Perpustakaan - BacaBukuID</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">BacaBukuID</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#respon" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="respon">
             <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="riwayat.php">Riwayat</a>
                </li>         
                </ul>
            </div>
        </div>
    </nav>

    <!-- riwayat -->
    <section class="riwayat mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                <?php if ( isset($catatan) ) { ?>
                    <h1> tidak ada data <i class="fas fa-exclamation-triangle"></i> </h1>
                    <p class="text-center">lakukan transaksi terlebih dahulu.</p>
                <?php }else{ ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        $nomor = 1;
                        ?>
                        <?php foreach ($pembayaran as $data) : ?>
                        <tr>
                            <th scope="row"><?= $nomor++; ?></th>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['bank']; ?></td>
                            <td><?= $data['tanggal']; ?></td>
                            <td>Rp. <?= number_format($data['jumlah']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <div class="col-sm-6">
                    <img src="assets/pembayaran/<?= $pembayaran[0]['bukti']; ?>" alt="" class="img-responsive" width="250">
                </div>
            </div>
        </div>
    </section>
    <!-- akhir riwayat -->



    <!-- footer -->
    <section class="follow mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h4>Jadilah yang pertama tahu berita terbaru event dan penawaran special dari kami.</h4>
                    <input type="text" class="form-control">
                    <button class="btn btn-primary float-right">Daftar</button>
                </div>
                <div class="col-sm-5">
                    <h2>Follow Us</h2>
                    <ul>
                        <li><i class="fab fa-facebook"></i></li>
                        <li><i class="fab fa-twitter-square"></i></li>
                        <li><i class="fab fa-instagram"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h5>Belanja</h5>
                    <ul>
                        <li>Berbelanja</li>
                        <li>Pembayaran</li>
                        <li>Pengiriman</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Tentang Perpustakaan</h5>
                    <ul>
                        <li>Tentang Kami</li>
                        <li>Kerjasama</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Lainnya</h5>
                    <ul>
                        <li>Syarat & Ketentuan</li>
                        <li>Bantuan</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Pembayaran</h5>
                    <ul class="bank">
                        <li><img src="assets/bank/1.png" alt=""></li>
                        <li><img src="assets/bank/2.png" alt=""></li>
                        <li><img src="assets/bank/3.jpg" alt=""></li>
                        <li><img src="assets/bank/4.jpeg" alt=""></li>
                        <li><img src="assets/bank/5.png" alt=""></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Dapatkan Apps Kami</h5>
                    <ul>
                        <li><img src="assets/app/get.png" alt=""></li>
                        <li><img src="assets/app/app.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- akhir footer -->
                <?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="js/dist/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>