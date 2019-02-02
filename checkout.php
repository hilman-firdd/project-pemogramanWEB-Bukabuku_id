<?php

require 'function.php';
session_start();

if(!isset($_SESSION['pelanggan'])) {
    header("Location: login.php");
}
if(empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
    echo "<script> alert('silahkan belanja'); </script>";
    echo "<script> location='index.php'; </script> ";
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
    <link rel="stylesheet" href="dist/css/checkout.css">
    <link rel="icon" type="image/gif" href="bb.ico">

    <title>Perpustakaan - BacaBukuID</title>
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

    <!-- isi -->
    <section class="keranjang">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2>Keranjang Belanja</h2>
                    <hr>
                </div>

                <div class="col-md-7">
                    <h2>Pengiriman</h2>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Tujuan Pengiriman
                                    </button>
                                </h2>
                            </div>
                        
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                <form action="" method="POST">
                                   <table>
                                        <tr>
                                           <td>
                                           <div class="form-group">
                                                <label for="nama">Nama Pelanggan</label>
                                                <input type="text" class="form-control" id="nama" value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" disabled>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                           <td>
                                           <div class="form-group">
                                                <label for="telepon">Telepon Pelanggan</label>
                                                <input type="text" class="form-control" id="telepon" value="<?= $_SESSION['pelanggan']['telepon']; ?>" disabled>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                           <td>
                                           <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Alamat Lengkap Pengiriman</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3" cols="100" placeholder="Masukkan alamat lengkap pengiriman ( termasuk kode pos ) "></textarea>
                                            </div>
                                          </td>
                                       </tr>
                                   </table>
                                </div>
                            </div>
                          
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Metode Pengiriman
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                       <select name="id_ongkir" id="" class="form-control">
                                           <option value="">Pilih ongkos kirim</option>

                                           <?php
                                           $query = mysqli_query($conn,"SELECT * FROM ongkir");
                                           while ($ongkir = mysqli_fetch_assoc($query)) {
                                           
                                           ?>
                                           <option value="<?= $ongkir['id_ongkir']; ?>"><?= $ongkir['nama_kota']; ?> - Rp. <?= number_format($ongkir['tarif']); ?></option>
                                           <?php } ?>
                                       </select>
                                </div> 
                            </div>  
                        </div>
                        <button class="btn btn-success mt-3" type="submit" name="checkout">Checkout</button>  
                    </div>
                </div>
                </form>

                <div class="col-md-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                        <?php
                        $total = 0; 
                        foreach( $_SESSION['keranjang'] as $data => $jumlah) : ?>
                            <?php
                            $query = "SELECT * FROM produk WHERE id_produk = '$data'";
                            

                            $tampil = tampil_data($query);
                            $total += $tampil[0]['harga_produk'] * $jumlah;
                            ?>
                            <img src="assets/buku/<?= $tampil[0]['gambar']; ?>" class="card-img-top">
                            <p class="card-text"><?= $tampil[0]['nama_produk']; ?></p>
                            <p class="card-text" style="font-size:12px;"><b>Soft Cover</b></p>
                            <p class="card-text">Jumlah : <?= $jumlah; ?></p>
                            <p class="card-text text-tambahan">Rp. <?= number_format($tampil[0]['harga_produk']); ?></p>
                            <?php endforeach;?>
                        </div>
                         <ul class="list-group list-group-flush">
                            <li class="list-group-item"></li>
                            <li class="list-group-item">Subtotal : <?= number_format($total); ?> </li>
                        </ul>  
                        
                    </div>  
                </div>

                <!-- logik -->
                <?php
                if( isset($_POST['checkout'])) {
                    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                    $id_ongkir    = $_POST['id_ongkir'];
                    $alamat       = $_POST['alamat'];
                    $tanggal      = date("Y-m-d");

                    $data = mysqli_query($conn,"SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                    $data_ongkir = mysqli_fetch_assoc($data);
                    $nama_kota = $data_ongkir['nama_kota'];
                    $tarif = $data_ongkir['tarif'];
                    $total_pembelian = $total + $tarif;

                    mysqli_query($conn,"INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal','$total_pembelian','$nama_kota','$tarif','$alamat')");
                    
                    $id_pembelian = mysqli_insert_id($conn);
                    

                    foreach( $_SESSION['keranjang'] as $id_produk => $jumlah ) {

                        $data = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $ambil = mysqli_fetch_assoc($data);

                        $nama = $ambil['nama_produk'];
                        $harga = $ambil['harga_produk'];
                        $subharga = $ambil['harga_produk'] * $jumlah;

                        mysqli_query($conn,"INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah,nama,harga,subharga) VALUES 
                        ('$id_pembelian','$id_produk','$jumlah','$nama','$harga','$subharga')");
                        //dialihkan

                        mysqli_query($conn,"UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk'");
                    }

                    //kosong keranjang

                    unset($_SESSION['keranjang']);
                    // $queryPembeli = "SELECT * FROM pembelian WHERE id_pembelian = ";
                    // $data_p = mysqli_query($conn,$queryPembeli);
                    // $pecah = mysqli_fetch_assoc($data_p);
                    // $pecahLagi = $pecah['id_pelanggan'];
                    
                    echo "<script> alert('pembelian sukses'); </script>";
                    echo "<script> location='nota.php?id=$id_pembelian'; </script>";
                    
                
                }

                    

                ?>
                <!-- logik -->

              
                
            </div>
        </div>
    </section>
    <!-- akhir isi -->

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
            })
        });
    </script>
</body>

</html>