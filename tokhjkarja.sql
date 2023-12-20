-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2022 at 05:01 AM
-- Server version: 10.3.35-MariaDB-log-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smilefoo_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kd_admin` int(6) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kd_admin`, `nama`, `email`, `password`, `gambar`, `status`) VALUES
(6, 'admin', '2017470031@ftumj.ac.id', 'admin', 'Logo Teknologi & Gaming Biru.png', 1),
(11, 'Ferdy', 'Ferdyindrawan7@gmail.com', 'operator123', '20220804_195923.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_jual` int(15) NOT NULL,
  `harga_beli` int(15) NOT NULL,
  `stok` int(4) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `satuan`, `harga_jual`, `harga_beli`, `stok`, `status`) VALUES
('AQUA0001', 'Aqua', 'DUS', 31000, 28000, 370, '0'),
('COLACO01', 'Coca cola', 'DUS', 32000, 28000, 785, '0'),
('FANTA01', 'Fanta', 'DUS', 27000, 23000, 815, '0'),
('HASS01', 'Hass', 'DUS', 20000, 15000, 410, '0'),
('LEMIN001', 'Le minerale', 'DUS', 45000, 38000, 1060, '0'),
('OKJELY01', 'Okky jelly', 'DUS', 33000, 28000, 1050, '0'),
('SPRITE01', 'Sprite', 'DUS', 27000, 24000, 770, '0'),
('TEDS001', 'teds', 'DUS', 23000, 20000, 1460, '0'),
('TEHBOTO1', 'TehBotol', 'DUS', 80000, 76000, 650, '0'),
('TEHRIO00', 'Teh rio', 'DUS', 28000, 25000, 1310, '0'),
('VIDES01', 'Vides', 'DUS', 25000, 20000, 370, '0');

-- --------------------------------------------------------

--
-- Table structure for table `barangp_sementara`
--

CREATE TABLE `barangp_sementara` (
  `id_barangp` int(6) NOT NULL,
  `kd_pembelian` char(8) NOT NULL,
  `nama_barangp` varchar(225) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_barangp` double NOT NULL,
  `item` int(4) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang_pembelian`
--

CREATE TABLE `barang_pembelian` (
  `kd_barang_beli` int(6) NOT NULL,
  `kd_pembelian` char(8) NOT NULL,
  `nama_barang_beli` varchar(225) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga_beli` double NOT NULL,
  `item` int(4) NOT NULL,
  `total` double NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_pembelian`
--

INSERT INTO `barang_pembelian` (`kd_barang_beli`, `kd_pembelian`, `nama_barang_beli`, `satuan`, `harga_beli`, `item`, `total`, `status`) VALUES
(31, 'PEM00019', 'wellfit', 'DUS', 18000, 10, 180000, '1'),
(34, 'PEM00022', 'Granita', 'DUS', 17000, 10, 170000, '1'),
(35, 'PEM00023', '-', '-', 1000, 7, 7000, '0'),
(36, 'PEM00023', '_', '_', 1000, 300, 300000, '0'),
(38, 'PEM00024', 'wellfit', 'DUS', 18000, 100, 1800000, '0'),
(42, 'PEM00028', 'kopi cappucino', 'DUS', 20000, 100, 2000000, '0'),
(46, 'PEM00001', 'Hass', 'DUS', 18000, 100, 1800000, '0'),
(47, 'PEM00002', 'Plastik Kemasan', 'PCS', 50000, 100, 5000000, '0'),
(48, 'PEM00003', 'Vides', 'DUS', 20000, 100, 2000000, '1'),
(49, 'PEM00004', 'Granita', 'DUS', 15000, 10, 150000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `d_pembelian`
--

CREATE TABLE `d_pembelian` (
  `id_pembelian` int(6) NOT NULL,
  `kd_pembelian` char(8) NOT NULL,
  `kd_barang_beli` int(6) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_pembelian`
--

INSERT INTO `d_pembelian` (`id_pembelian`, `kd_pembelian`, `kd_barang_beli`, `jumlah`, `subtotal`) VALUES
(46, 'PEM00001', 46, 100, 1800000),
(47, 'PEM00002', 47, 100, 5000000),
(48, 'PEM00003', 48, 100, 2000000),
(49, 'PEM00004', 49, 10, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `d_penjualan`
--

CREATE TABLE `d_penjualan` (
  `id_penjualan` int(6) NOT NULL,
  `kd_penjualan` char(8) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_penjualan`
--

INSERT INTO `d_penjualan` (`id_penjualan`, `kd_penjualan`, `kd_barang`, `jumlah`, `subtotal`) VALUES
(1, 'PEN00001', 'AQUA0001', 100, 6500000),
(2, 'PEN00002', 'AQUA0001', 400, 26000000),
(3, 'PEN00003', 'AQUA0001', 100, 6500000),
(4, 'PEN00004', 'AQUA0001', 30, 1950000),
(5, 'PEN00005', 'AQUA0001', 25, 1625000),
(6, 'PEN00006', 'AQUA0001', 20, 500000),
(7, 'PEN00007', 'AQUA0001', 15, 375000),
(8, 'PEN00008', 'AQUA0001', 10, 250000),
(9, 'PEN00009', 'TEHRIO00', 50, 1400000),
(10, 'PEN00009', 'AQUA0001', 10, 250000),
(12, 'PEN00010', 'LEMIN001', 15, 675000),
(13, 'PEN00010', 'TEDS001', 20, 460000),
(14, 'PEN00010', 'TEHRIO00', 20, 560000),
(15, 'PEN00011', 'FANTA01', 15, 405000),
(16, 'PEN00011', 'SPRITE01', 20, 540000),
(17, 'PEN00011', 'COLACO01', 20, 540000),
(18, 'PEN00011', 'LEMIN001', 20, 900000),
(19, 'PEN00011', 'TEDS001', 20, 460000),
(22, 'PEN00012', 'COLACO01', 150, 4050000),
(23, 'PEN00012', 'FANTA01', 150, 4050000),
(24, 'PEN00012', 'LEMIN001', 150, 6750000),
(25, 'PEN00012', 'OKJELY01', 150, 4950000),
(26, 'PEN00012', 'SPRITE01', 150, 4050000),
(27, 'PEN00012', 'TEDS001', 150, 3450000),
(28, 'PEN00012', 'TEHRIO00', 120, 3360000),
(29, 'PEN00012', 'TEHBOTO1', 150, 12000000),
(30, 'PEN00012', 'VIDES01', 130, 3250000),
(37, 'PEN00013', 'COLACO01', 120, 3240000),
(38, 'PEN00013', 'FANTA01', 120, 3240000),
(39, 'PEN00013', 'LEMIN001', 100, 4500000),
(40, 'PEN00013', 'LEMIN001', 120, 5400000),
(41, 'PEN00013', 'OKJELY01', 100, 3300000),
(42, 'PEN00013', 'SPRITE01', 150, 4050000),
(43, 'PEN00013', 'TEDS001', 120, 2760000),
(44, 'PEN00013', 'TEHRIO00', 100, 2800000),
(45, 'PEN00013', 'TEHBOTO1', 100, 8000000),
(46, 'PEN00013', 'VIDES01', 100, 2500000),
(52, 'PEN00014', 'VIDES01', 400, 10000000),
(53, 'PEN00014', 'TEHBOTO1', 300, 24000000),
(54, 'PEN00015', 'TEDS001', 10, 230000),
(55, 'PEN00016', 'COLACO01', 10, 270000),
(56, 'PEN00017', 'COLACO01', 10, 270000),
(57, 'PEN00018', 'TEDS001', 20, 460000),
(58, 'PEN00019', 'HASS01', 30, 600000),
(59, 'PEN00020', 'HASS01', 60, 1200000),
(60, 'PEN00021', 'AQUA0001', 10, 310000),
(61, 'PEN00022', 'AQUA0001', 10, 310000),
(62, 'PEN00023', 'SPRITE01', 10, 270000),
(63, 'PEN00024', 'COLACO01', 5, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `eoq`
--

CREATE TABLE `eoq` (
  `kode_eoq` varchar(12) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `periode` varchar(8) NOT NULL,
  `biaya_administrasi` int(12) NOT NULL,
  `lead_time` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eoq`
--

INSERT INTO `eoq` (`kode_eoq`, `nama_barang`, `periode`, `biaya_administrasi`, `lead_time`) VALUES
('Q000003', 'Sprite', '2022-07', 25000, 5),
('Q000004', 'TehBotol', '2022-07', 25000, 5),
('Q000005', 'teds', '2022-07', 25000, 5),
('Q000008', 'teds', '2022-07', 25000, 5),
('Q000010', 'Sprite', '2022-07', 25000, 5),
('Q000009', 'Hass', '2022-07', 25000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `kd_admin` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `waktu` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `kd_admin`, `deskripsi`, `waktu`) VALUES
(4, 6, 'Created Penjualan - Kode Penjualan : PEN00022', '05-08-2022  15:22:11'),
(5, 11, 'Created Penjualan - Kode Penjualan : PEN00023', '06-08-2022  12:02:55'),
(6, 6, 'Created Pembelian - Kode Pembelian : PEM00002', '08-08-2022  09:38:06'),
(7, 6, 'Created Pembelian - Kode Pembelian : PEM00003', '08-08-2022  11:06:37'),
(8, 6, 'Created Pembelian - Kode Pembelian : PEM00004', '08-08-2022  16:06:46'),
(9, 6, 'Created Penjualan - Kode Penjualan : PEN00024', '08-08-2022  16:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kd_pembelian` char(8) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `kd_admin` int(6) NOT NULL,
  `kd_supplier` int(6) NOT NULL,
  `total_pembelian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kd_pembelian`, `tgl_pembelian`, `kd_admin`, `kd_supplier`, `total_pembelian`) VALUES
('PEM00001', '2022-08-06', 11, 3, 1800000),
('PEM00002', '2022-08-08', 6, 3, 5000000),
('PEM00003', '2022-08-08', 6, 3, 2000000),
('PEM00004', '2022-08-08', 6, 3, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kd_penjualan` char(8) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `kd_admin` int(6) NOT NULL,
  `dibayar` double NOT NULL,
  `total_penjualan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kd_penjualan`, `tgl_penjualan`, `kd_admin`, `dibayar`, `total_penjualan`) VALUES
('PEN00001', '2022-06-28', 6, 6500000, 6500000),
('PEN00002', '2022-07-02', 6, 26000000, 26000000),
('PEN00003', '2022-07-02', 6, 6500000, 6500000),
('PEN00004', '2022-07-02', 6, 1950000, 1950000),
('PEN00005', '2022-07-02', 6, 1650000, 1625000),
('PEN00006', '2022-07-04', 6, 550000, 500000),
('PEN00007', '2022-07-04', 6, 400000, 375000),
('PEN00008', '2022-07-05', 6, 300000, 250000),
('PEN00009', '2022-07-04', 6, 1650000, 1650000),
('PEN00010', '2022-07-04', 6, 1700000, 1695000),
('PEN00011', '2022-07-05', 6, 2845000, 2845000),
('PEN00012', '2022-07-05', 6, 45910000, 45910000),
('PEN00013', '2022-07-05', 6, 40000000, 39790000),
('PEN00014', '2022-07-05', 6, 34000000, 34000000),
('PEN00015', '2022-07-12', 6, 235000, 230000),
('PEN00016', '2022-07-25', 6, 300000, 270000),
('PEN00017', '2022-07-26', 6, 300000, 270000),
('PEN00018', '2022-07-26', 6, 500000, 460000),
('PEN00019', '2022-07-29', 6, 600000, 600000),
('PEN00020', '2022-07-29', 6, 1300000, 1200000),
('PEN00021', '2022-08-05', 6, 310000, 310000),
('PEN00022', '2022-08-05', 6, 310000, 310000),
('PEN00023', '2022-08-06', 11, 300000, 270000),
('PEN00024', '2022-08-08', 6, 200000, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_sementara`
--

CREATE TABLE `penjualan_sementara` (
  `id_penjualan_sementara` int(11) NOT NULL,
  `kd_penjualan` char(8) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga` double NOT NULL,
  `item` int(4) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `kd_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `pemilik` varchar(225) NOT NULL,
  `kota` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`kd_perusahaan`, `nama_perusahaan`, `alamat`, `pemilik`, `kota`, `email`) VALUES
(1, 'Toko Hj.Karja', 'Jl. Kalibaru barat 9 Rt 07/06 No 01 cilincing Jakarta Utara', 'Vera Fitriyani', 'Jakarta Utara', 'Ferdyindrawan7@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supplier` int(6) NOT NULL,
  `nama_supplier` varchar(60) NOT NULL,
  `alamat` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nama_supplier`, `alamat`) VALUES
(3, 'ferdy 085555555', 'Joko tingkir cibitung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `barangp_sementara`
--
ALTER TABLE `barangp_sementara`
  ADD PRIMARY KEY (`id_barangp`),
  ADD KEY `kd_pembelian` (`kd_pembelian`);

--
-- Indexes for table `barang_pembelian`
--
ALTER TABLE `barang_pembelian`
  ADD PRIMARY KEY (`kd_barang_beli`);

--
-- Indexes for table `d_pembelian`
--
ALTER TABLE `d_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `kd_pembelian` (`kd_pembelian`),
  ADD KEY `kd_pembelian_2` (`kd_pembelian`),
  ADD KEY `kd_barang_beli` (`kd_barang_beli`),
  ADD KEY `kd_barang_beli_2` (`kd_barang_beli`);

--
-- Indexes for table `d_penjualan`
--
ALTER TABLE `d_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `kd_penjualan` (`kd_penjualan`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `kd_barang_2` (`kd_barang`);

--
-- Indexes for table `eoq`
--
ALTER TABLE `eoq`
  ADD PRIMARY KEY (`kode_eoq`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kd_pembelian`),
  ADD KEY `kd_admin` (`kd_admin`),
  ADD KEY `kd_supplier` (`kd_supplier`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kd_penjualan`),
  ADD KEY `kd_admin` (`kd_admin`);

--
-- Indexes for table `penjualan_sementara`
--
ALTER TABLE `penjualan_sementara`
  ADD PRIMARY KEY (`id_penjualan_sementara`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`kd_perusahaan`),
  ADD KEY `kd_perusahaan` (`kd_perusahaan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `kd_admin` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barangp_sementara`
--
ALTER TABLE `barangp_sementara`
  MODIFY `id_barangp` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `barang_pembelian`
--
ALTER TABLE `barang_pembelian`
  MODIFY `kd_barang_beli` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `d_pembelian`
--
ALTER TABLE `d_pembelian`
  MODIFY `id_pembelian` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `d_penjualan`
--
ALTER TABLE `d_penjualan`
  MODIFY `id_penjualan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penjualan_sementara`
--
ALTER TABLE `penjualan_sementara`
  MODIFY `id_penjualan_sementara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `kd_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kd_supplier` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_pembelian`
--
ALTER TABLE `d_pembelian`
  ADD CONSTRAINT `d_pembelian_ibfk_3` FOREIGN KEY (`kd_pembelian`) REFERENCES `pembelian` (`kd_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_pembelian_ibfk_4` FOREIGN KEY (`kd_barang_beli`) REFERENCES `barang_pembelian` (`kd_barang_beli`);

--
-- Constraints for table `d_penjualan`
--
ALTER TABLE `d_penjualan`
  ADD CONSTRAINT `d_penjualan_ibfk_3` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`),
  ADD CONSTRAINT `d_penjualan_ibfk_4` FOREIGN KEY (`kd_penjualan`) REFERENCES `penjualan` (`kd_penjualan`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`kd_admin`) REFERENCES `admin` (`kd_admin`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kd_admin`) REFERENCES `admin` (`kd_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
