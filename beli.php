<?php 

session_start();

$get = $_GET['id'];

if( isset($_SESSION['keranjang'][$get]) ) {
    $_SESSION['keranjang'][$get]+= 1;
}else{
    $_SESSION['keranjang'][$get] = 1;
}

echo "<script> alert('sudah masuk ke keranjang'); </script>";
echo "<script> location='keranjang.php'; </script>";

?>

