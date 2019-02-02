<?php

require 'function.php';
$get = $_GET['keyword']; 
$query = "SELECT * FROM produk
          WHERE nama_produk LIKE '%$get%'";
$produk = tampil_data($query);

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
    <link rel="stylesheet" href="dist/css/ajax.css">
    <link rel="icon" type="image/gif" href="bb.ico">

    <title>Perpustakaan - BacaBukuID</title>
</head>
<body>


    <div class="container mt-5">
        <div class="row">
            <?php foreach( $produk as $buku ) : ?>
          <div class="col-sm-4">
                    <div class="item">
                        <a href="produk.php?id=<?= $buku['id_produk'];?>"><img src="assets/buku/<?= $buku['gambar'];?>" class="data" width="250" alt="">
                        <h6 class="text-left mt-5"><?= $buku['pengarang'];?></h6>
                        <p class="text-left">Rp.<?= number_format($buku['harga_produk']); ?></p></a>
                        <a href="beli.php?id=<?= $buku['id_produk']; ?>" class="btn btn-dark">Beli</a>
                    </div>      
          </div>
            <?php endforeach; ?>
        </div>
    </div>
    
<script src="js/dist/jquery-3.3.1.slim.min.js"></script>
<script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
<script src="js/dist/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
</body>

</html>