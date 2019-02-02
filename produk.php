<?php
session_start();
require 'function.php';
$id_get = $_GET['id'];

$query = "SELECT * FROM produk WHERE id_produk = '$id_get'";
$query2 = "SELECT * FROM produk ORDER BY id_produk ASC LIMIT 3";
$data = tampil_data($query);
$data2 = tampil_data($query2);
$id = $data[0]['id_produk'];
if ( isset($_POST['beli'])) {
    // mendapatkan jumlah yang diinputkan
    $jumlah = $_POST['jumlah'];
    //masukkan ke keranajng
    
    $_SESSION['keranjang'][$id] = $jumlah;
    echo "<script> alert('sudah masuk ke keranjang'); </script>";
    echo "<script> location='keranjang.php'; </script>";

}

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
    <link rel="stylesheet" href="dist/css/produk.css">
    <link rel="icon" type="image/gif" href="bb.ico">
    <title>Perpustakaan</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">BacaBukuID</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#respon" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="respon">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Testimoni <span class="sr-only">(current)</span></a>
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

    <!-- isi produk -->
    <section class="produk">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4">
                    <img src="assets/buku/<?= $data[0]['gambar'];?>" alt="" class="rounded-right buku">
                </div>
                <div class="col-lg-6 col-sm-8">
                    <h2 class="ml-5"><?= $data[0]['nama_produk'];?></h2>
                    <p class="ml-5"><?= $data[0]['pengarang'];?></p>
                </div>
                <div class="col-lg-3 col-sm-12 mt-2">
                    <div class="card text-center">
                        <div class="card-header" title="Buku cetak dengan sampul fleksibel tipis. Mudah untuk dibawa bepergian.">
                            Info Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Soft Cover</h5>
                            <p class="card-text text-left">Rp. <?= number_format($data[0]['harga_produk']);?></p>
                            <p class="card-text text-left">Stok : <?= $data[0]['stok_produk'];?></p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary mb-3 pro" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-shopping-cart"></i> Beli Sekarang</a>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Jumlah item bertambah
                                                di keranjang belanja</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="assets/buku/<?= $data[0]['gambar'];?>" alt="" width="100">
                                            <hr>
                                            <h6><?= $data[0]['nama_produk'];?></h6>
                                            <p><?= $data[0]['pengarang'];?></p>
                                            <p>Soft Cover </p>
                                            <p style="color:red;">Rp. <?= number_format($data[0]['harga_produk']);?></p>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="number" min="1" max="<?= $data[0]['stok_produk']; ?>" value="1" autocomplete="off" class="form-control" name="jumlah">
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <ul>
                                            <li> <button type="submit" class="btn btn-secondary ker" data-dismiss="modal">Lanjutkan
                                                    Berbelanja</button></li>
                                                    <li><button type="submit" class="btn btn-primary ker" name="beli">Lanjut ke Keranjang</button>
                                                </form>
                                    </div>
                                    </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                            href="#list-home" role="tab" aria-controls="home">Deskripsi</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                            href="#list-profile" role="tab" aria-controls="profile">Detail</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><?= $data[0]['desk_produk'];?> </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <table class="detail">
                                <tr>
                                    <td>Jumlah Halaman</td>
                                    <th><?= $data[0]['jumlah_halaman'];?></th>
                                </tr>
                                <tr>
                                    <td>Tanggal Terbit</td>
                                    <th><?= $data[0]['tanggal_terbit'];?></th>
                                </tr>
                                <tr>
                                    <td>Bahasa</td>
                                    <th>Indonesia</th>
                                </tr>
                                <tr>
                                    <td>Penerbit</td>
                                    <th><?= $data[0]['penerbit'];?></th>
                                </tr>
                                <tr>
                                    <td>Berat</td>
                                    <th><?= $data[0]['berat'];?></th>
                                </tr>
                                <tr>
                                    <td>Lebar</td>
                                    <th><?= $data[0]['lebar'];?></th>
                                </tr>
                                <tr>
                                    <td>Panjang</td>
                                    <th><?= $data[0]['panjang'];?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- akhir produk -->

    <!-- tawaran -->
    <section class="tawaran mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <h4>Pembeli yang Melihat Produk Ini, Juga Tertarik dengan</h4>
                </div>
                <div class="col-md-3 col-sm-12">
                    <a href="">lihat semua</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="owl-carousel owl-theme">
                <?php foreach ($data2 as $buku) : ?>
                        <div class="item">
                            <img src="assets/buku/<?= $buku['gambar'];?>" class="data" alt="">
                            <h6 class="text-center"><?= $buku['pengarang']; ?></h6>
                            <p>Rp. <?= number_format($data[0]['harga_produk']);?></p>
                            <a href="produk.php?id=<?= $data[0]['id_produk'];?>" class="btn btn-info" style="width:100%;">Beli</a>
                        </div>
                <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir tawaran -->


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
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                margin: 10,
            })
        });
    </script>
</body>

</html>