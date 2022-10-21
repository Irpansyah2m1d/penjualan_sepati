-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 10:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sepatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(70) NOT NULL,
  `warna` enum('merah','biru','hitam') NOT NULL,
  `harga` varchar(30) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `jumlah_produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama`, `deskripsi`, `warna`, `harga`, `gambar`, `jumlah_produk`) VALUES
('SPT0003', 'Sepatu Ori', 'sangat bagus', 'biru', '90000', '62fd08d75c6e9.jpg', '20'),
('SPT0004', 'Sepatu Kulit', 'Barang Baru dan branded', 'hitam', '120000', '62fd189512fee.jpg', '25'),
('SPT0005', 'Sepatu Wanita', 'Elegant dan Flexibel', 'hitam', '120', '62fd194b5b853.jpeg', '25'),
('SPT0006', 'Nike Hitam Polos', 'Barang simple dan murah', 'hitam', '200000', '62fd1985544c5.jpg', '30'),
('SPT0007', 'Sepatu Spantopel', 'Sangat simple dan mudah digunakan', 'hitam', '100000', '62fdbf1b8cf45.jpg', '30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_user`
--

CREATE TABLE `tbl_barang_user` (
  `id_brng_user` int(11) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `id_pemesanan` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang_user`
--

INSERT INTO `tbl_barang_user` (`id_brng_user`, `id_user`, `id_pemesanan`, `nama`, `warna`, `ukuran`) VALUES
(15, 'US0001', 'PSN0001', 'Sepatu Kulit', 'Merah', '38'),
(16, 'US0001', 'PSN0002', 'Sepatu Ori', 'Biru', '39'),
(17, 'US0001', 'PSN0003', 'Sepatu Kulit', 'Merah', '38'),
(18, 'US0001', 'PSN0003', 'Sepatu Ori', 'Hitam', '43'),
(19, 'US0001', 'PSN0004', 'Sepatu Kulit', 'Hitam', '38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_barang` varchar(8) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `warna` varchar(50) NOT NULL DEFAULT 'Hitam',
  `ukuran` varchar(50) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_barang`, `id_user`, `nama`, `warna`, `ukuran`, `jumlah`, `total`) VALUES
(18, 'SPT0004', 'US0001', 'Sepatu Kulit', 'Hitam', '40', '3', '360000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` varchar(8) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `kode_pembayaran` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(128) NOT NULL DEFAULT '-',
  `ket` int(3) NOT NULL DEFAULT 1 COMMENT '1 = Belum Lunas, 2 = Menunggu Pembayaran, 3 = Lunas',
  `qr_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id_pemesanan`, `id_user`, `total_harga`, `tgl_pemesanan`, `tgl_pengiriman`, `metode_bayar`, `kode_pembayaran`, `bukti_pembayaran`, `ket`, `qr_code`) VALUES
('PSN0001', 'US0001', '480000', '2022-08-21', '2022-08-25', 'Indomaret', '001- 427 - 971 - 416 - 4 ', '', 2, 'qrcode.png'),
('PSN0002', 'US0001', '270000', '2022-08-21', '2022-08-26', 'Alfamart', '001- 842 - 778 - 483 - 0 ', '', 2, 'qrcode.png'),
('PSN0003', 'US0001', '459000', '2022-08-21', '2022-08-28', 'Alfamart', '001- 799 - 989 - 861 - 4 ', '-', 2, 'qrcode.png'),
('PSN0004', 'US0001', '102000', '2022-08-21', '2022-08-24', 'COD', '001- 886 - 138 - 198 - 3 ', 'COD', 1, 'qrcode.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `level` int(2) NOT NULL COMMENT '1 = "admin", 2 = "user"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `alamat`, `username`, `password`, `level`) VALUES
('AD0001', 'Admin', '', '', 'admin', '$2y$10$DjlG68kvTqOcR34yDfP7MuEqazQezDmy0QyxPnue6nmgGgr0lQJ7W', 1),
('US0001', 'Irpansyah', 'irpansyah810@gmail.com', 'Desa Air Itam Kecamatan Penukal Kabupaten PALI', 'irpan', '$2y$10$cGVFCml2PEJAar2eLCQz.OWsSuRS0fRGkbz5WCcpN64vHwNH8z0ca', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_barang_user`
--
ALTER TABLE `tbl_barang_user`
  ADD PRIMARY KEY (`id_brng_user`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang_user`
--
ALTER TABLE `tbl_barang_user`
  MODIFY `id_brng_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
