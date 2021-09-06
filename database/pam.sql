-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 10:47 AM
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
  `dusun` int(4) NOT NULL,
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
(1, 'AKL000001', 'Rezal Wahyu Pratama', 1, 2, 2, 1, '087721191226', 'pelanggan', '62rc5', 'qrcode_AKL000001_ebcead84b386e809429366544d0b3d5f.png'),
(2, 'KDL000002', 'Rezal Wahyu', 3, 2, 2, 1, '087721191226', 'pelanggan', '7ddn6', 'qrcode_KDL000002_ea3429699807126986797a820838b04e.png'),
(3, 'AKL000003', 'uzumaki naruto', 1, 1, 1, 3, '432472947293', 'pelanggan', 'j4gmp', 'qrcode_AKL000003_9e2ff343ada81cde67fd87c23f9deff1.png');

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
  `awal` int(3) NOT NULL,
  `akhir` int(3) NOT NULL,
  `pemakaian` int(5) NOT NULL,
  `tagihan` int(7) NOT NULL,
  `status` enum('butuh bayar','butuh konfirmasi','lunas') NOT NULL,
  `metode_bayar` enum('transfer','petugas') DEFAULT NULL,
  `tgl_bayar` timestamp NULL DEFAULT NULL,
  `petugas_verifikasi` varchar(50) DEFAULT NULL,
  `file` varchar(500) DEFAULT NULL,
  `foto_meteran` varchar(500) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id`, `id_tagihan`, `id_pelanggan`, `nama`, `tgl_cek`, `awal`, `akhir`, `pemakaian`, `tagihan`, `status`, `metode_bayar`, `tgl_bayar`, `petugas_verifikasi`, `file`, `foto_meteran`, `create_at`) VALUES
(1, 'AKL000001-04-09-2021', '1', 'Rezal Wahyu Pratama', '2021-09-29', 1, 12, 11, 27000, 'lunas', 'transfer', '2021-09-05 02:33:30', 'admin', 'AKL000001-04-09-2021.png', 'AKL000001-04-09-2021.jpeg', '2021-09-04 15:42:31'),
(2, 'KDL000002-04-09-2021', '2', 'Rezal Wahyu', '2021-09-28', 1, 12, 11, 27000, 'butuh bayar', '', NULL, NULL, NULL, 'KDL000002-04-09-2021.jpeg', '2021-09-04 19:43:01'),
(3, 'AKL000001-05-09-2021', '1', 'Rezal Wahyu Pratama', '2021-10-08', 12, 15, 3, 11000, 'butuh konfirmasi', '', '2021-09-05 17:57:31', NULL, 'AKL000001-05-09-2021.jpeg', 'AKL000001-05-09-2021.jpeg', '2021-09-05 10:54:00'),
(4, 'AKL000003-06-09-2021', '3', 'uzumaki naruto', '2021-09-06', 0, 12, 12, 29000, 'lunas', 'transfer', '2021-09-06 03:38:53', 'admin', 'AKL000003-06-09-2021.jpg', 'AKL000003-06-09-2021.jpg', '2021-09-06 08:33:56'),
(5, 'AKL000003-06-09-2021', '3', 'uzumaki naruto', '2021-10-06', 12, 15, 3, 11000, 'butuh bayar', '', NULL, NULL, NULL, 'AKL000003-06-09-2021.jpg', '2021-09-06 08:35:19');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
