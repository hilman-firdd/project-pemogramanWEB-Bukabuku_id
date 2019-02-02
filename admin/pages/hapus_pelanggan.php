<?php
require '../../function.php';

$get = $_GET['id'];

if(hapus_pelanggan($get) > 0 ){
    echo "
    <script> 
    alert('data ke hapus'); 
    window.location.href='pelanggan.php';
    </script>";
}else{
    echo "<script> alert('gagal dihapus'); </script>";
}

