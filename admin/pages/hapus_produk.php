<?php
require '../../function.php';

$get = $_GET['id'];

if(hapus_produk($get) > 0 ){
    echo "
    <script> 
    alert('data ke hapus'); 
    window.location.href='produk.php';
    </script>";
}else{
    echo "<script> alert('gagal dihapus'); </script>";
}

