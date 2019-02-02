<?php

require 'conn.php';


function tampil_data($data) {
    global $conn;
    $query = mysqli_query($conn,$data);
    $rows = [];
    while($row = mysqli_fetch_assoc($query)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah_produk($data) {
    global $conn;
    $nama_produk = $data['nama_produk'];
    $harga_produk = $data['harga_produk'];
    $jumlah_halaman = $data['jumlah_halaman'];
    $date = date('Y-m-d',strtotime($data['date']));
    $penerbit = $data['penerbit'];
    $berat = $data['berat'];
    $lebar = $data['lebar'];
    $panjang = $data['panjang'];
    $gambar = gambar_produk();
    if(!$gambar){
        return false;
    }
    $desk_produk = $data['desk_produk'];
    $tipe = $data['tipe'];
    $pengarang = $data['pengarang'];
    
    $query = "INSERT INTO produk VALUES ('','$nama_produk','$harga_produk',
    '$jumlah_halaman','$date','$penerbit','$berat','$lebar','$panjang'
    ,'$gambar','$desk_produk','$tipe','$pengarang')";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}


function gambar_produk(){
    $namaFile =     $_FILES['gambar_produk']['name'];
    $ukuran =       $_FILES['gambar_produk']['size'];
    $error =        $_FILES['gambar_produk']['error'];
    $tmp_name =     $_FILES['gambar_produk']['tmp_name'];

    if ( $ukuran > 1000000 ){
        echo "<script> alert('ukuran terlalu tinggi'); </script>";
        return false;
    }

    if ( $error === 4 ){
        echo "<script> alert('pilih gambar terlebih dahulu'); </script>";
        return false;
    }

    $gambarArr = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if ( !in_array($ekstensiGambar,$gambarArr) ) {
        echo "<script> alert('yang diupload bukan gambar'); </script>";
        return false;
    }

    $gambarBaru = uniqid();
    $gambarBaru .= '.';
    $gambarBaru .= $ekstensiGambar;
    

    move_uploaded_file($tmp_name,'../../assets/buku/'.$gambarBaru);
    return $gambarBaru;
}

function hapus_produk($id){
    global $conn;
    $query1 = "DELETE FROM produk WHERE id_produk = $id";
    $query2 = "SELECT * FROM produk WHERE id_produk = $id";

    $ambil = mysqli_query($conn,$query2);
    $pecah = $ambil->fetch_assoc();
    $produk_photo = $pecah['gambar'];

    if(file_exists("../../assets/buku/$produk_photo")) {
        unlink("../../assets/buku/$produk_photo");
    }
    
    mysqli_query($conn,$query1);
    return mysqli_affected_rows($conn);
}

function hapus_pelanggan($id){
    global $conn;
    $query1 = "DELETE FROM pelanggan WHERE id_pelanggan = $id";
    mysqli_query($conn,$query1);
    return mysqli_affected_rows($conn);
}

function ubah_produk($data) {
    global $conn;
    $id_produk = $data['id_produk'];
    $nama_produk = $data['nama_produk'];
    $harga_produk = $data['harga_produk'];
    $jumlah_halaman = $data['jumlah_halaman'];
    $date = date('Y-m-d',strtotime($data['date']));
    $penerbit = $data['penerbit'];
    $berat = $data['berat'];
    $lebar = $data['lebar'];
    $panjang = $data['panjang'];

    $gambarLama = $data['gambarLama'];
    if( $_FILES['gambar_produk']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = gambar_produk();
    }
    $desk_produk = $data['desk_produk'];
    $tipe = $data['tipe'];
    $pengarang = $data['pengarang'];

    $query = "UPDATE produk SET 
    nama_produk  = '$nama_produk',
    harga_produk = '$harga_produk',
    jumlah_halaman = '$jumlah_halaman',
    tanggal_terbit = '$date',
    penerbit = '$penerbit',
    berat = '$berat',
    lebar = '$lebar',
    panjang = '$panjang',
    gambar = '$gambar',
    desk_produk = '$desk_produk',
    tipe = '$tipe',
    pengarang = '$pengarang' 
    WHERE id_produk = $id_produk";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


function daftar($data){
    global $conn;
    $email = $data['email'];
    $password1 = $data['password1'];
    $password2 = $data['password2'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $tel = $data['tel'];
    $query1 = mysqli_query($conn,"SELECT * FROM pelanggan");
    $row = mysqli_fetch_assoc($query1);
    if( $password1 != $password2 ){
        echo "<script> alert('password tidak cocok'); </script>";
        return false;
    }
    

    if ($row['email_pelanggan'] == $email ){
        echo "<script> alert('email ada yang sama'); </script>";
        return false;
    }
    

    $query2 = "INSERT INTO pelanggan VALUES('','$email','$password1','$nama',$tel,'$alamat')";
    mysqli_query($conn,$query2);
    return mysqli_affected_rows($conn);


}