<?php
require '../../function.php';

$get = $_GET['id'];
$query1 = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
          WHERE pembelian.id_pembelian = $get";
$data_pembeli = tampil_data($query1);


$query2 = "SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk";
$data_produk = tampil_data($query2);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Detail Pembelian</title>
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
              <a href="../index.php" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Dashboard
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview">
              <a href="produk.php" class="nav-link ">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  Produk
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="pembelian.php" class="nav-link active">
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
              <h1 class="m-0 text-dark">Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <?php 
                $nomor = 1;
                foreach( $data_pembeli as $data ) : ?>
                <div class="card">
                    <div class="card-header text-center">
                        Data Pembelian
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tangggal : <?= $data['tanggal_pembelian']; ?></li>
                        <li class="list-group-item">Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $data['status_pembelian']; ?></li>
                        <li class="list-group-item" style="background-color:salmon; color:#fff;">Total : Rp. <?= number_format($data['total_pembelian']); ?></li>
                    </ul>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="card">
                      <div class="card-header text-center">
                          Data Pelanggan
                      </div>
                      <ul class="list-group list-group-flush">
                          <li class="list-group-item">Nama : <?= $data['nama_pelanggan']; ?></li>
                          <li class="list-group-item">Email : <?= $data['email_pelanggan']; ?></li>
                          <li class="list-group-item">Telpon : <?= $data['telepon']; ?></li>
                          <li class="list-group-item">Alamat : <?= $data['alamat']; ?></li>
                      </ul>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                      <div class="card-header text-center">
                          Data Pengiriman
                      </div>
                      <ul class="list-group list-group-flush">
                          <li class="list-group-item">Nama kota : <?= $data['nama_kota']; ?></li>
                          <li class="list-group-item">Resi Pengiriman : <?= $data['resi_pengiriman']; ?></li>
                          <li class="list-group-item">Alamat : <?= $data['alamat_pengiriman']; ?></li>
                          <li class="list-group-item" style="background-color:salmon; color:#fff;">Tarif : Rp. <?= number_format($data['tarif']); ?></li>
                      </ul>
                  </div>
                 </div>
              </div>

              <?php endforeach; ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah Halaman</th>
                        <th scope="col">Tanggal Terbit</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Lebar</th>
                        <th scope="col">Panjang</th>
                        <th scope="col">Jumlah Buku</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_produk as $data) : ?>
                    <tr>
                        <th scope="row"><?= $nomor++; ?></th>
                        <td><?= $data['nama_produk'];?></td>
                        <td><?= number_format($data['harga_produk']);?></td>
                        <td><?= $data['jumlah_halaman'];?></td>
                        <td><?= $data['tanggal_terbit'];?></td>
                        <td><?= $data['penerbit'];?></td>
                        <td><?= $data['berat'];?></td>
                        <td><?= $data['lebar'];?></td>
                        <td><?= $data['panjang'];?></td>
                        <td><?= $data['jumlah'];?></td>
                        <td><?= number_format($data['harga_produk'] * $data['jumlah']);?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/knob/jquery.knob.js"></script>
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
</body>

</html>