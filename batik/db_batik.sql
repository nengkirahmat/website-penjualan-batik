-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2017 at 10:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_batik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`id_admin` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batik`
--

CREATE TABLE IF NOT EXISTS `tbl_batik` (
`id_batik` int(5) NOT NULL,
  `model_batik` varchar(50) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `motif_batik` varchar(30) NOT NULL,
  `daerah_asal` varchar(30) NOT NULL,
  `jenis_bahan` varchar(30) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `berat` int(10) NOT NULL,
  `harga_grosir` int(10) NOT NULL,
  `min_grosir` int(5) NOT NULL,
  `harga_eceran` int(10) NOT NULL,
  `gambar` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batik`
--

INSERT INTO `tbl_batik` (`id_batik`, `model_batik`, `kategori`, `motif_batik`, `daerah_asal`, `jenis_bahan`, `ukuran`, `berat`, `harga_grosir`, `min_grosir`, `harga_eceran`, `gambar`, `keterangan`) VALUES
(4, 'Baju Batik Sarimbit Blus', 'Baju Anak', 'Bunga Suma', 'Batik Pekalongan', 'Katun', 'All Size', 2000, 30000, 10, 33000, 'Metland-Menteng-Jakarta-Timur-Indonesia.jpg', 'sadjsai ooapskdopisa dkjasdoisa doisajdoiasj isajdioa sdsjsaiojd oisaj diosaj dosajdiosajoid sajoidsjaoid joasdj saj diosajd oisaj diosajdiosa jdsajdosa jdosajdoiasj oiasjodsj dsajdoiasj oidj saodjosajd oisajdoisajdk osadsakpdokwopdk poadpskdfpsjdk odsfjoidsjf disjfiodjfioejf sjiodjfis fiusdj fio sdifjsiod foisdjfoisjdiof sdoifj iose jfoisej oifj seoifj oisejfoise foisej iofjseoijfiosej fiose fiosejoifjesiofjiodj fdijfoijewiojfoi sdiojf oidsj foidjf oisdjfiosjdiofjdsfdfds ds fsdf dsfdf dfd sdfdfsdfdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bayar`
--

CREATE TABLE IF NOT EXISTS `tbl_bayar` (
`id_bayar` int(10) NOT NULL,
  `id_trans` int(10) NOT NULL,
  `nama_rek` varchar(50) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `waktu_bayar` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
`id_cart` int(10) NOT NULL,
  `id_pembeli` int(10) NOT NULL,
  `id_trans` int(10) NOT NULL,
  `id_batik` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `total_berat` int(10) NOT NULL,
  `jenis_beli` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori` (
`id_kategori` int(10) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Baju Anak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembeli`
--

CREATE TABLE IF NOT EXISTS `tbl_pembeli` (
`id_pembeli` int(10) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `pos` varchar(10) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

CREATE TABLE IF NOT EXISTS `tbl_trans` (
  `id_trans` int(10) NOT NULL,
  `id_pembeli` int(10) NOT NULL,
  `total_belanja` int(10) NOT NULL,
  `total_berat` int(10) NOT NULL,
  `jasa` varchar(30) NOT NULL,
  `ongkir` varchar(10) NOT NULL,
  `pembayaran` varchar(30) NOT NULL,
  `pesanan` text NOT NULL,
  `catatan` text NOT NULL,
  `jenis_trans` varchar(20) NOT NULL,
  `status_bayar` varchar(30) NOT NULL,
  `waktu_trans` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`id_admin`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_batik`
--
ALTER TABLE `tbl_batik`
 ADD PRIMARY KEY (`id_batik`);

--
-- Indexes for table `tbl_bayar`
--
ALTER TABLE `tbl_bayar`
 ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
 ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
 ADD PRIMARY KEY (`id_kategori`), ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indexes for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
 ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
 ADD PRIMARY KEY (`id_trans`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_batik`
--
ALTER TABLE `tbl_batik`
MODIFY `id_batik` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_bayar`
--
ALTER TABLE `tbl_bayar`
MODIFY `id_bayar` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
MODIFY `id_cart` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
MODIFY `id_pembeli` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
