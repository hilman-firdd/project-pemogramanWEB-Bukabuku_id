
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

$query = "SELECT * FROM produk";
$data_buku = tampil_data($query);

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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="riwayat.php">Riwayat Belanja</a>
                    </li> -->
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
                        <a class="nav-link" href="keranjang.php"><i class="fas fa-shopping-cart"></i>Keranjang<span class="sr-only">(current)</span></a>
                    </li>

                    

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control" type="search" placeholder="Cari Buku" aria-label="Search" id="search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit" id="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- corousel -->
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/diskon.jpg" style="width: 100%;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/gramedia.jpg" style="width: 100%;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/promo.jpg" style="width: 100%;" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- akhir corousel -->

    <!-- buku populer -->
    <div id="container">
    <section class="buku_populer">
        <div class="container">
            <div class="data-buku">
                <a href="" class="banyak">Lihat Semua</a>
                <h1>Buku Paling Populer</h1>
                <div class="row">
                    <div class="col-md-3">
                        <img src="assets/Product_List_Banner-07.jpg" class="banner" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="owl-carousel owl-theme">
                            <?php 
                            foreach( $data_buku as $buku ) {
                                if($buku['tipe'] == "umum"){ ?>
                                    <div class="item">
                                        <a href="produk.php?id=<?= $buku['id_produk']; ?>"><img src="assets/buku/<?= $buku['gambar'];?>" class="data" alt="">
                                        <h6 class="text-center"><?= $buku['pengarang'];?></h6>
                                        <p>Rp.<?= number_format($buku['harga_produk']); ?></p></a>
                                        <a href="beli.php?id=<?= $buku['id_produk']; ?>" class="btn btn-info">Beli</a>
                                    </div>

                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir buku populer -->

    <!-- buku islami -->
    <section class="buku_islami">
        <div class="container">
            <div class="data-buku">
                <a href="" class="banyak">Lihat Semua</a>
                <h1>Buku Islami</h1>
                <div class="row">
                    <div class="col-md-3">
                        <img src="assets/Product_List_Banner-08.jpg" class="banner" alt="">
                    </div>
                    <div class="col-md-9 ">
                        <div class="owl-carousel owl-theme">
                        <?php 
                            foreach( $data_buku as $buku ) {
                                if($buku['tipe'] == "islami"){ ?>
                                    <div class="item">
                                        <a href="produk.php?id=<?= $buku['id_produk'];?>"><img src="assets/buku/<?= $buku['gambar'];?>" class="data" alt="">
                                        <h6 class="text-center"><?= $buku['pengarang'];?></h6>
                                        <p>Rp.<?= number_format($buku['harga_produk']); ?></p></a>
                                        <a href="beli.php?id=<?= $buku['id_produk']; ?>" class="btn btn-info">Beli</a>
                                    </div>

                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir buku islami -->

    <!-- buku si kecil -->
    <section class="buku_anak">
        <div class="container">
            <div class="data-buku">
                <a href="" class="banyak">Lihat Semua</a>
                <h1>Buku Si Kecil</h1>
                <div class="row">
                    <div class="col-md-3">
                        <img src="assets/Product_List_Banner-09.jpg" class="banner" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="owl-carousel owl-theme">
                            <?php 
                            foreach( $data_buku as $buku ) {
                                if($buku['tipe'] == "anak-anak"){ ?>
                                    <div class="item">
                                        <a href="produk.php?id=<?= $buku['id_produk'];?>"><img src="assets/buku/<?= $buku['gambar'];?>" class="data" alt="">
                                        <h6 class="text-center"><?= $buku['pengarang'];?></h6>
                                        <p>Rp.<?= number_format($buku['harga_produk']); ?></p></a>
                                        <a href="beli.php?id=<?= $buku['id_produk']; ?>" class="btn btn-info">Beli</a>                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <!-- akhir buku si kecil -->

    <!-- footer -->
    <section class="follow">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="js/dist/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src='dist/js/sweetalert.min.js'></script>

    
    <script>
    
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });


            const tombol = document.getElementById('container');
            const cari   = document.getElementById('search');
            const submit = document.getElementById('submit');

            cari.addEventListener('keyup', function() {
                const xhr = new XMLHttpRequest();

                //check kesiapan ajax
                xhr.onreadystatechange = function () {
                    if ( xhr.readyState == 4 && xhr.status == 200 ){
                        tombol.innerHTML = xhr.responseText;
                    }
                }

                xhr.open('GET', 'data_ajax.php?keyword='+ cari.value,true);
                xhr.send();

            })
        });
    </script>
</body>

</html>