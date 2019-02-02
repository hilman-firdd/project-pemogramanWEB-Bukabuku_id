<!-- query -->
<?php
require '../../function.php';

$get = $_GET['id'];
$query1 = "SELECT * FROM produk WHERE id_produk = $get";

$data = mysqli_query($conn,$query1);
$pecah = $data->fetch_assoc();


if ( isset($_POST['simpan'])){
  if(ubah_produk($_POST) > 0){
    echo "<script>alert('data diubah tersimpan'); </script>";
  }else{
    echo "<script>alert('gagal'); </script>";
  }
}

?>
<!-- akhir query -->


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ubah Produk</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .call {
        font-size:35px;
        margin-left:5px;
        cursor:pointer;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Dashboard
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview menu-open">
              <a href="produk.php" class="nav-link active">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  Data Produk
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="pembelian.php" class="nav-link">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  Pembelian
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="pelanggan.php" class="nav-link">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  Pelanggan
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="../logout.php" class="nav-link">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  Logout
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Update Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="tambah_produk.php" class="btn btn-primary">Tambah Produk</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?= $pecah['id_produk'];?>">
                <input type="hidden" name="gambarLama" value="<?= $pecah['gambar'];?>">
                
                <div class="form-group">
                    <label for="produk">Nama Produk</label>
                    <input type="text" class="form-control" id="produk" name="nama_produk" value="<?= $pecah['nama_produk'];?>">
                </div>
                <div class="form-group">
                    <label for="pengarang">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $pecah['pengarang'];?>">                
                    </div>
                <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <input type="text" class="form-control" id="harga" name="harga_produk" value="<?= $pecah['harga_produk'];?>">
                </div>
                <div class="form-group">
                    <label for="jumlahhal">Jumlah Halaman</label>
                    <input type="text" class="form-control" id="jumlahhal" name="jumlah_halaman" value="<?= $pecah['jumlah_halaman'];?>">
                </div>
                <div class="form-group">
                    <label for="date">Tanggal Terbit</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="date" name="date" value="<?= $pecah['tanggal_terbit'];?>">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar call" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $pecah['penerbit'];?>">
                </div>
                <div class="form-group">
                    <label for="berat">Berat</label>
                    <input type="text" class="form-control" id="berat" name="berat" value="<?= $pecah['berat'];?>">
                </div>
                <div class="form-group">
                    <label for="lebar">Lebar</label>
                    <input type="text" class="form-control" id="lebar" name="lebar" value="<?= $pecah['lebar'];?>">
                </div>
                <div class="form-group">
                    <label for="panjang">Panjang</label>
                    <input type="text" class="form-control" id="panjang" name="panjang" value="<?= $pecah['panjang'];?>">
                </div>
                <div class="form-group">
                    <img src="../../assets/buku/<?= $pecah['gambar'];?>" alt="" width="100"><br>
                    <label for="gambar">Masukkan Gambar Produk</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar_produk">
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe Buku</label>
                    <select class="form-control" id="tipe" name="tipe">
                    <option><?= $pecah['tipe'];?></option>
                    <option></option>
                    <option></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="desk">Masukkan Deskripsi tentang produk!</label>
                    <textarea class="form-control" id="desk" rows="5" name="desk_produk"><?= $pecah['desk_produk'];?></textarea>
                </div>
                <button type="submit" class="btn btn-success mb-5" name="simpan">Simpan</button>
            </form>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.0-alpha
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $(function(){
    $.widget.bridge('uibutton', $.ui.button);
    $('.datepicker').datepicker({
      dateFormat: 'yy-mm-dd'
    });
  });
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- daterangepicker -->
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
</body>

</html>