<?php
require '../../function.php';

$get = $_GET['id'];

$queryBayar = "SELECT * FROM pembayaran WHERE id_pembelian = '$get'";
$dataBayar = tampil_data($queryBayar);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pembelian</title>
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
            <div class="col-sm-12 text-center">
              <h1 class="m-0 text-dark">Data Pembayaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Bank</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal pembelian</th>
                    <th scope="col">Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomor = 1;
                    foreach( $dataBayar as $data ) : ?>
                    <tr>
                        <th scope="row"><?= $nomor++; ?></th>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['bank']; ?></td>
                        <td>Rp. <?= number_format($data['jumlah']); ?></td>
                        <td><?= $data['tanggal']; ?></td>
                        <td><img src="../../assets/pembayaran/<?= $data['bukti']; ?>" alt="" width="100"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          <!-- /.row (main row) -->

          <form action="" method="post">
            <div class="form-group">
                <label for="resi">No Resi Pengiriman</label>
                <input type="text" id="resi" class="form-control" name="resi">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="barang dikirim">Barang dikirim</option>
                    <option value="batal">batal</option>
                </select>
            </div>
            <button class="btn btn-primary" name="proses" type="submit">Proses</button>
          </form>
        </div><!-- /.container-fluid -->
        <?php

        if ( isset($_POST['proses']) ){
            $resi = $_POST['resi'];
            $status = $_POST['status'];
            mysqli_query($conn,"UPDATE pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status' 
            WHERE id_pembelian = '$get'");
            echo "<script> alert('data pembelian terupdate'); </script>";
            echo "<script> location = 'pembelian.php'; </script>";
        }
        ?>
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