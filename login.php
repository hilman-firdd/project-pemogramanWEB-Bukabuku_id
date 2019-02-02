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
    <link rel="stylesheet" href="dist/css/daftar.css">
    <link rel="icon" type="image/gif" href="bb.ico">

    <title>Perpustakaan - Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">BacaBukuID</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center"><u>Login</u></h3>
        <div class="row">
            <div class="col">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="sandi">Kata Sandi</label>
                        <input type="password" class="form-control" id="sandi" name="password" placeholder="password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
                </form>
                <hr>
                <p>Belum Mendaftar ? <a href="daftar.php">Daftar</a></p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="js/dist/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                margin: 10,
            })
        });
    </script>
</body>

</html>