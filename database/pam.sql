-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 11:23 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pam`
--

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id`, `nama`, `kode`) VALUES
(1, 'Angkatan Lor', 'AKL'),
(2, 'Angaktan Kidul', 'AKD'),
(3, 'Kedalingan', 'KDL');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) NOT NULL,
  `id_pelanggan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nama` char(40) NOT NULL,
  `dusun` char(40) NOT NULL,
  `rt` int(3) NOT NULL,
  `rw` int(3) NOT NULL,
  `no_rumah` int(4) NOT NULL,
  `no_hp` varchar(13) CHARACTER SET latin1 NOT NULL,
  `level` varchar(20) CHARACTER SET latin1 NOT NULL,
  `code` varchar(10) CHARACTER SET latin1 NOT NULL,
  `qrcode` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_pelanggan`, `nama`, `dusun`, `rt`, `rw`, `no_rumah`, `no_hp`, `level`, `code`, `qrcode`) VALUES
(1, 'AKL000001', 'Rezal Wahyu Pratama', 'Angkatan Lor', 1, 4, 15, '087721191226', 'pelanggan', 'gyy8m', 'qrcode_AKL000001_ebcead84b386e809429366544d0b3d5f.png');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(10) NOT NULL,
  `id_tagihan` varchar(21) NOT NULL,
  `id_pelanggan` varchar(10) NOT NULL,
  `nama` char(40) NOT NULL,
  `tgl_cek` date NOT NULL,
  `bulan` date NOT NULL,
  `awal` int(3) NOT NULL,
  `bln_terbilang` varchar(30) NOT NULL,
  `akhir` int(3) NOT NULL,
  `pemakaian` int(5) NOT NULL,
  `tagihan` int(7) NOT NULL,
  `status` varchar(20) NOT NULL,
  `metode_bayar` varchar(30) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `petugas_verifikasi` varchar(50) NOT NULL,
  `file` varchar(500) DEFAULT NULL,
  `waktu` time NOT NULL DEFAULT current_timestamp(),
  `foto_meteran` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id`, `id_tagihan`, `id_pelanggan`, `nama`, `tgl_cek`, `bulan`, `awal`, `bln_terbilang`, `akhir`, `pemakaian`, `tagihan`, `status`, `metode_bayar`, `tgl_bayar`, `petugas_verifikasi`, `file`, `waktu`, `foto_meteran`) VALUES
(14, 'BLR010204-2021-01-08', 'BLR010204', 'Abdul', '2021-01-08', '2021-01-01', 131, 'January 2021', 156, 25, 40500, 'LUNAS', '', NULL, '', NULL, '00:00:00', ''),
(15, 'BLR010204-2021-02-06', 'BLR010204', 'Abdul', '2021-02-06', '2021-02-01', 156, 'February 2021', 175, 19, 31500, 'LUNAS', '', NULL, '', NULL, '00:00:00', ''),
(16, 'BLR010204-2021-03-31', 'BLR010204', 'Abdul', '2021-03-31', '2021-03-01', 175, 'March 2021', 190, 15, 25500, 'LUNAS', '', NULL, '', '../files/3. UPGRIS.png', '00:00:00', ''),
(19, 'SDW020315-2021-01-08', 'SDW020315', 'Yos Aipassa', '2021-01-08', '2021-01-01', 115, 'January 2021', 129, 14, 24000, 'LUNAS', '', NULL, '', NULL, '00:00:00', ''),
(20, 'SDW020315-2021-02-04', 'SDW020315', 'Yos Aipassa', '2021-02-04', '2021-02-01', 129, 'February 2021', 134, 5, 10500, 'LUNAS', '', NULL, '', NULL, '00:00:00', ''),
(85, 'BLR020378-2021-05-01', 'BLR020378', 'Aros Roso', '2021-05-01', '2021-05-01', 10, 'May 2021', 90, 80, 123000, 'PERLU DIBAYAR', 'BELUM DIPILIH', NULL, '', NULL, '00:00:00', 'BLR020378-2021-05-01.png'),
(108, 'BLR010339-2021-04-25', 'BLR010339', 'Wondo', '2021-04-25', '2021-04-01', 1, 'April 2021', 12, 11, 19500, 'PERLU DIBAYAR', 'BELUM DIPILIH', NULL, '', NULL, '23:37:16', 'BLR010339-2021-04-25.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'admin', '1', 'c4ca4238a0b923820dcc509a6f75849b'),
(4, 'Rezal', 'kecank', '2e4640b95d249830692579dc409a577e'),
(5, 'Rezal', 'rezal', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
