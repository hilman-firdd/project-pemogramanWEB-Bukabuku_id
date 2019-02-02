<?php
require 'function.php';
session_start();




$query3 = "SELECT * FROM pembelian";
$result3 = mysqli_query($conn,$query3);
$check = mysqli_fetch_assoc($result3);

if( isset($_POST['submit']) ) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query1 = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $query2 = "SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'";

    $result1 = mysqli_query($conn,$query1);
    $result2 = mysqli_query($conn,$query2);
    
    $data_admin = mysqli_fetch_assoc($result1);
    $data_pelanggan = mysqli_fetch_assoc($result2);
    
   
    $data_admin_row = mysqli_num_rows($result1);
    $data_pelanggan_row = mysqli_num_rows($result2);

    if ( $data_admin['akses'] == "admin" ) {
        if( $data_admin_row === 1){
            $_SESSION['admin'] = $data_admin;
            echo "<script> alert('Admin login sukses'); </script>";
            echo "<script> location='admin/index.php'; </script>";
        }else{
            echo "<script> alert('Gagal login'); </script>";
        }
    }else if ( $data_pelanggan_row === 1 ){
            echo "<script> alert('Login Pelanggan sukses'); </script>";
            if (isset($check['id_ongkir'])){
               $_SESSION['pelanggan'] = $data_pelanggan;
               echo "<script> location='riwayat.php'; </script>"; 
            }else{
               $_SESSION['pelanggan'] = $data_pelanggan;
               echo "<script> location='index.php'; </script>"; 
            }
            
    }else{
            echo "<script> alert('Gagal login'); </script>";
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
    <link rel="stylesheet" href="dist/css/style.css">
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
                        <a class="nav-link" href="#">Testimoni</a>
                    </li>
                    <?php if ( isset($_SESSION['pelanggan'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal"><i class="fas fa-user"></i>Login</a>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control login" id="email" name="email" placeholder="Masukkan Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control login" id="password" name="password"
                                                    placeholder="Masukkan Password">
                                            </div>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <h6>Belum mendaftar?</h6>
                                        <a href="daftar.php" class="btn btn-dark">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php"><i class="fas fa-shopping-cart"></i>Keranjang<span class="sr-only">(current)</span></a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control" type="search" placeholder="Cari Buku" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>


    <!-- nota -->

    <section class="pembayaran mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h3>Menunggu Pembayaran</h3>
                    <p>Sisa waktu pembayaran anda</p>
                    <h3 id="teks"></h3>
                    <p>Batas akhir durasi pembayaran hanya 1 hari</p>

                
                    <div class="card" style="width:50%; margin:auto;">
                        <div class="card-header">
                            Nota Pelanggan
                        </div>
                        <div class="card-body">
                        <?php 
                        $query1 = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'";
                        $query2 = "SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'";
                        
                        $data = tampil_data($query1);
                        $data2 = tampil_data($query2);

                        ?>
                            <h5 class="card-title">Data Pelanggan</h5>
                            <p class="card-text text-left"><?= $data[0]['nama_pelanggan']; ?></p>
                            <p class="card-text text-left"><?= $data[0]['telepon']; ?></p>
                            <p class="card-text text-left"><?= $data[0]['alamat_pengiriman']; ?></p>
                            <p class="card-text text-left"><?= $data[0]['email_pelanggan']; ?></p> 
                            <a href="riwayat.php?id=<?= $data2[0]['id_produk']; ?>" class="btn btn-success">Check Riwayat Belanja</a>
                            <hr>
                            <h5 class="card-title">Pembelian</h5>
                            <p class="card-text text-left">No. Pembelian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $data[0]['id_pembelian']; ?></p>
                            <p class="card-text text-left">Tanggal Pembelian : <?= $data[0]['tanggal_pembelian']; ?></p>
                            
                            <hr>
                            <h5 class="card-title">Pengiriman</h5>
                            <p class="card-text text-left"><?= $data[0]['nama_kota']; ?></p>
                            <p class="card-text text-left">Rp. <?= number_format($data[0]['tarif']); ?></p>
                        </div>
                    </div>
                    <?php 
                        // $idpelangganyangbeli = $data['id_pelanggan'];
                        // $idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];

                        // if($idpelangganyangbeli !== $idpelangganyanglogin ){
                        //     echo "<script> alert('jangan nakal'); </script>";
                        //     echo "<script> location = 'riwayat.php'; </script>"; 
                        // }
                    ?>
                    <center>
                    <div class="card mt-3" style="width:50%;">
                        <div class="card-header">
                            Informasi Pemesanan
                        </div>
                        <div class="card-body">
                            <p>Tanggal Pembayaran</p>
                            <hr>
                            <p class="card-text"><?= $data[0]['tanggal_pembelian']; ?></p>
                            <hr>
                            <p>Total Pembayaran</p>
                            <hr>
                            <p class="card-text"><img src="assets/bank/4.jpeg" width="100" alt="">
                            </p>
                            <p class="float-left">Total :</p>
                            <p class="float-right">Rp. <?= number_format($data2[0]['subharga']); ?></p>
                            
                        </div>
                        <div class="alert alert-primary " role="alert">
                            Silahkan melakukan pembayaran ke BANK MANDIRI 137-0920202012 AN. Hilman Firdaus
                        </div>
                    </div>
                    </center>


                </div>
            </div>
        </div>
    </section>

    <!-- akhir nota -->
   

    <!-- footer -->
    <!-- <section class="follow">
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
    </footer> -->
    <!-- akhir footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="js/dist/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script>

        const tanggalTujuan = new Date('February 1,2019 21:23:00').getTime();
       

        const hitungMundur = setInterval(function() {
            const sekarang = new Date().getTime();
            const selisih = tanggalTujuan - sekarang;

            // const hari = Math.floor(selisih / ( 1000 * 60 * 60 * 24 ));
            const jam =  Math.floor(selisih % ( 1000 * 60 * 60 * 24) / ( 1000 * 60 * 60 ));
            const menit =  Math.floor(selisih % ( 1000 * 60 * 60) / ( 1000 * 60 ));
            const detik =  Math.floor(selisih % ( 1000 * 60 ) / 1000 );

            const teks = document.getElementById('teks');
            teks.innerHTML = jam + ' jam ' + menit + ' menit ' + detik + ' detik ';
        
           if ( selisih < 0 ){
                clearInterval(hitungMundur);
                teks.innerHTML = 'Waktu anda habis!! <br> Silahkan Memesan kembali';
            }

        }, 1000);
        
        
    </script>
</body>

</html>