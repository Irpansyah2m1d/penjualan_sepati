-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Okt 2022 pada 16.16
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `tbl_barang`
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
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama`, `deskripsi`, `warna`, `harga`, `gambar`, `jumlah_produk`) VALUES
('SPT0003', 'Sepatu Ori', 'sangat bagus', 'biru', '90000', '62fd08d75c6e9.jpg', '20'),
('SPT0004', 'Sepatu Kulit', 'Barang Baru dan branded', 'hitam', '120000', '62fd189512fee.jpg', '25'),
('SPT0005', 'Sepatu Wanita', 'Elegant dan Flexibel', 'hitam', '120000', '630174847b1f8.jpeg', '25'),
('SPT0006', 'Nike Hitam Polos', 'Barang simple dan murah', 'hitam', '200000', '62fd1985544c5.jpg', '30'),
('SPT0007', 'Sepatu Spantopel', 'Sangat simple dan mudah digunakan', 'hitam', '100000', '62fdbf1b8cf45.jpg', '30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_user`
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
-- Dumping data untuk tabel `tbl_barang_user`
--

INSERT INTO `tbl_barang_user` (`id_brng_user`, `id_user`, `id_pemesanan`, `nama`, `warna`, `ukuran`) VALUES
(20, 'US0002', 'PSN0005', 'Sepatu Wanita', 'null', '37'),
(23, 'US0004', 'PSN0006', 'Sepatu Kulit', 'merah', '38'),
(24, 'US0004', 'PSN0006', 'Sepatu Ori', 'Hitam', '40'),
(29, 'US0006', 'PSN0008', 'Sepatu Kulit', 'Hitam', '40'),
(30, 'US0006', 'PSN0009', 'Sepatu Ori', 'Merah', '42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
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
-- Dumping data untuk tabel `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_barang`, `id_user`, `nama`, `warna`, `ukuran`, `jumlah`, `total`) VALUES
(18, 'SPT0004', 'US0001', 'Sepatu Kulit', 'Hitam', '40', '3', '360000'),
(19, 'SPT0005', 'US0001', 'Sepatu Wanita', 'null', '38', '3', '360000'),
(23, 'SPT0004', 'US0003', 'Sepatu Kulit', 'null', '35', '33', '3960000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemesanan`
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
-- Dumping data untuk tabel `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id_pemesanan`, `id_user`, `total_harga`, `tgl_pemesanan`, `tgl_pengiriman`, `metode_bayar`, `kode_pembayaran`, `bukti_pembayaran`, `ket`, `qr_code`) VALUES
('PSN0005', 'US0002', '408000', '2022-08-30', '2022-09-04', 'Dana', '002- 297 - 132 - 630 - 1 ', '630d73f70bc6f.png', 3, 'qrcode.png'),
('PSN0006', 'US0004', '402900', '2022-09-22', '2022-09-27', 'Indomaret', '004- 116 - 621 - 927 - 6 ', '-', 1, 'qrcode.png'),
('PSN0008', 'US0006', '306000', '2022-10-24', '2022-10-30', 'Alfamart', '006- 535 - 363 - 398 - 1 ', '63569b612e47d.png', 3, 'qrcode.png'),
('PSN0009', 'US0006', '229500', '2022-10-24', '2022-10-31', 'Alfamart', '006- 133 - 878 - 858 - 6 ', '-', 1, 'qrcode.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
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
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `alamat`, `username`, `password`, `level`) VALUES
('AD0001', 'Admin', '', '', 'admin', '$2y$10$DjlG68kvTqOcR34yDfP7MuEqazQezDmy0QyxPnue6nmgGgr0lQJ7W', 1),
('US0001', 'Irpansyah', 'irpansyah810@gmail.com', 'Desa Air Itam Kecamatan Penukal Kabupaten PALI', 'irpan', '$2y$10$cGVFCml2PEJAar2eLCQz.OWsSuRS0fRGkbz5WCcpN64vHwNH8z0ca', 2),
('US0002', 'Rangga Apriansyah', 'rangga@gmail.com', 'Jln Plaju Palembang', 'rangga', '$2y$10$.kwUQhZiL5buTlaYSl9WLugGCsBMuJ345n86K6aCaRcYd2pZWptlC', 2),
('US0003', 'Dilan', 'dilan@gmail.com', 'Desa Air Itam Kecamatan Penukal', 'dilan', '$2y$10$xP58xloMcaPeOLp0C0KrL.EPhVuca5fmkKuX2aLmqjPNrgVLzRFpO', 2),
('US0004', 'Sadam Husein', 'sadam@gmail.com', 'Jln M. Nurdin Panji Sukarami Palembang', 'sadam', '$2y$10$ehvu3vOzbIVYff8nQjArN.iIV4fBfMRo/WfjusgRf8OgPPFelflxe', 2),
('US0005', 'Alfina', 'alfina@gmail.com', 'Jln. Palembang', 'alfina', '$2y$10$Vre3waW01fzrYah3X0FVyeWEM9pLbP8JDG5IOxXatKrTijQGKN9c.', 2),
('US0006', 'Sindi', 'sindi@gmail.com', 'Jln Plaju Palembang', 'sindi', '$2y$10$gDJipNDO2pkdVBdUY10E2.ATawu2T3U6aE6OzCBQc69LYdQey7eJ.', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_barang_user`
--
ALTER TABLE `tbl_barang_user`
  ADD PRIMARY KEY (`id_brng_user`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_user`
--
ALTER TABLE `tbl_barang_user`
  MODIFY `id_brng_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
