-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2019 at 04:16 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukabuku_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `gambar_admin` varchar(255) NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `nama_lengkap`, `gambar_admin`, `akses`) VALUES
(1, 'hilmanfirdaus11@yahoo.com', 'admin', 'hilman firdaus', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(255) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Bandung', 20000),
(2, 'Cirebon', 25000),
(3, 'Jakarta', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon`, `alamat`) VALUES
(13, 'anton@yahoo.com', 'bandung', 'anton', '8929399442', 'jl surya kencana'),
(14, 'rezeki@yahoo.com', '123', 'rezeki', '892929393', 'jl bali'),
(15, 'abdal@yahoo.com', 'abdal', 'abdal', '829933223', 'jl sukamena'),
(16, 'andri@yahoo.com', 'bandung', 'andri', '893939222', 'almanak rt 02');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(27, 31, 'Mark Jebreg', 'mandiri', 200000, '2019-01-31', '2019013116505646981256_2369747959720957_280942671348891648_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` varchar(255) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(31, 13, 2, '2019-01-31', 155000, 'Cirebon', 25000, 'jl syurga', 'barang dikirim', '1234ABC'),
(32, 13, 1, '2019-01-31', 75000, 'Bandung', 20000, 'walidun', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(29, 31, 8, 1, 'Laskar Pelangi', 50000, 50000),
(30, 31, 9, 2, 'Ayah', 40000, 80000),
(31, 32, 1, 1, 'Struktur Data ( Algoritma )', 55000, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `berat` varchar(50) NOT NULL,
  `lebar` varchar(50) NOT NULL,
  `panjang` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `desk_produk` text NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `pengarang` varchar(20) NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `jumlah_halaman`, `tanggal_terbit`, `penerbit`, `berat`, `lebar`, `panjang`, `gambar`, `desk_produk`, `tipe`, `pengarang`, `stok_produk`) VALUES
(1, 'Struktur Data ( Algoritma )', 55000, 230, '2019-01-15', 'ITB', '200 gram', '7 cm', '23 cm', '2.jpg', 'Pengertian Algoritma Pemrograman. ... Dalam matematika dan ilmu komputer, algoritma adalah urutan atau langkah-langkah untuk penghitungan atau untuk menyelesaikan suatu masalah yang ditulis secara berurutan. Sehingga, algoritma pemrograman adalah urutan atau langkah-langkah untuk menyelesaikan masalah pemrograman komputer.', 'umum', 'rinaldi munir', 2),
(2, 'Pemuda takut dosa', 45000, 120, '2019-01-15', 'yufid tv', '100 gram', '5 cm', '10 cm', '5.jpg', 'ok', 'islami', 'asep', 2),
(3, 'Goblok Pangkal Kaya', 45000, 105, '2019-01-15', 'Redino TM', '100 gram', '10 cm', '10 cm', '1.jpg', '', 'umum', 'Bob Sadino', 3),
(4, 'Penyimpangan Syi\'ah', 55000, 200, '2019-01-22', 'Akhir Zaman Net', '120 gram', '10 cm', '10 cm', '3.jpg', '', 'islami', 'Mui Pusat', 5),
(5, 'Pemuda Al Kahfi', 85000, 280, '2019-01-21', 'Yufid Tv', '200 gram', '15 cm', '10 cm', '4.jpg', '', 'islami', 'Dr. Aam', 5),
(6, 'Edensor', 43000, 120, '2019-01-03', 'Marini Net', '100 gram', '12 cm', '10 cm', '6.jpg', '', 'umum', 'Andrea hirata', 4),
(7, 'La tahzan', 80000, 190, '2019-01-27', 'Qishi Tv', '200 gram', '12 cm', '10 cm', '7.jpg', '', 'islami', 'Dr. Aridh Al-Qurni', 5),
(8, 'Laskar Pelangi', 50000, 120, '2019-01-22', 'Laskar Net', '200 gram', '12 cm', '10 cm', '8.jpg', '', 'umum', 'Andrea hirata', 4),
(9, 'Ayah', 40000, 100, '2019-01-01', 'Kisah Inpsi Net', '120 gram', '12 cm', '10 cm', '9.jpg', '', 'umum', 'Andrea Hirata', 3),
(10, 'Filsafat', 84000, 200, '2018-12-10', 'Redino TM', '120 gram', '20 cm', '10 cm', '10.jpg', '', 'umum', 'Prof. Dr cecep', 5),
(11, 'Cerita Islami Terbaik', 30000, 100, '2019-01-03', 'Ammar TV', '100 gram', '12 cm', '10 cm', '11.jpg', '', 'anak-anak', 'Muhammad Yagir', 5),
(12, '110 Ibadah dan Aktifitas', 38000, 80, '2019-01-23', 'Yuni TV', '90 gram', '10 cm', '8 cm', '12.jpg', '', 'anak-anak', 'Zakir Uday', 5),
(13, 'Anak Muslim', 90000, 200, '2019-01-23', 'muslim net', '120 gram', '13 cm', '10 cm', '13.jpeg', '', 'anak-anak', 'Dr salela', 4),
(14, '50 Kerajaan Islam', 43000, 120, '2019-01-22', 'Dongeng net', '180 gram', '14 cm', '12 cm', '14.jpeg', '', 'anak-anak', 'Dr Syarif', 5),
(15, 'Upin dan Ipin', 60000, 190, '2019-01-29', 'malaysia net', '120 gram', '12 cm', '10 cm', '15.jpeg', '', 'anak-anak', 'kak rose', 5),
(16, 'Lancar membaca buku', 70000, 80, '2019-01-21', 'Rajawali', '180 gram', '12 cm', '13 cm', '16.jpg', '', 'anak-anak', 'Endru zaza', 5),
(17, 'Amalan Harian Muslim', 180000, 230, '2019-01-21', 'Akhir Zaman Net', '150 gram', '20 cm', '15 cm', '17.jpeg', '', 'islami', 'Syeikh Abdul', 4),
(18, 'Panduan Shalat Lengkap', 120000, 180, '2019-01-22', 'Shahih Net', '130 gram', '16 cm', '13 cm', '18.jpg', '', 'islami', 'Imam Syafii', 5),
(19, 'Pacamu Bukan Jodohmu', 30000, 120, '2019-01-14', 'Ammar TV', '100 gram', '10 cm', '10 cm', '19.jpg', '', 'islami', 'Muhammad Ihsan', 5),
(20, '400 Hadist Akhir Zaman', 200000, 300, '2019-01-15', 'Yufid Tv', '300 gram', '13 cm', '8 cm', '20.jpg', '', 'islami', 'Yazid Qomarun', 5),
(21, 'Udah Putusin Aja', 49000, 120, '2019-01-15', 'mrzah net', '120 gram', '20 cm', '10 cm', '21.jpg', '', 'islami', 'Felix Siaw', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
