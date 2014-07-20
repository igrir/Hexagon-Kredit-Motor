-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2014 at 01:21 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hexagon`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsur`
--

CREATE TABLE IF NOT EXISTS `angsur` (
  `id_angsur` int(100) NOT NULL AUTO_INCREMENT,
  `pembayaran_ke` int(11) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `tgl_tenggat` date DEFAULT NULL,
  `biaya` double NOT NULL,
  `denda` double NOT NULL,
  `id_kredit` int(100) NOT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `sudah_bayar` int(11) NOT NULL COMMENT '0 = belum bayar,  1 = sudah bayar',
  PRIMARY KEY (`id_angsur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=888 ;

--
-- Dumping data for table `angsur`
--

INSERT INTO `angsur` (`id_angsur`, `pembayaran_ke`, `tgl_bayar`, `tgl_tenggat`, `biaya`, `denda`, `id_kredit`, `penerima`, `sudah_bayar`) VALUES
(855, 1, '2013-04-16', '2013-04-16', 1030909.09091, 0, 50, '', 1),
(856, 2, '0000-00-00', '2013-05-16', 1030909.09091, 0, 50, '', 0),
(857, 3, '0000-00-00', '2013-06-16', 1030909.09091, 0, 50, '', 0),
(858, 4, '0000-00-00', '2013-07-16', 1030909.09091, 0, 50, '', 0),
(859, 5, '0000-00-00', '2013-08-16', 1030909.09091, 0, 50, '', 0),
(860, 6, '0000-00-00', '2013-09-16', 1030909.09091, 0, 50, '', 0),
(861, 7, '0000-00-00', '2013-10-16', 1030909.09091, 0, 50, '', 0),
(862, 8, '0000-00-00', '2013-11-16', 1030909.09091, 0, 50, '', 0),
(863, 9, '0000-00-00', '2013-12-16', 1030909.09091, 0, 50, '', 0),
(864, 10, '0000-00-00', '2014-01-16', 1030909.09091, 0, 50, '', 0),
(865, 11, '0000-00-00', '2014-02-16', 1030909.09091, 0, 50, '', 0),
(866, 1, '2013-04-16', '2013-06-29', 1030909.09091, 0, 51, '', 1),
(867, 2, '0000-00-00', '2013-07-29', 1030909.09091, 0, 51, '', 0),
(868, 3, '0000-00-00', '2013-08-29', 1030909.09091, 0, 51, '', 0),
(869, 4, '0000-00-00', '2013-09-29', 1030909.09091, 0, 51, '', 0),
(870, 5, '0000-00-00', '2013-10-29', 1030909.09091, 0, 51, '', 0),
(871, 6, '0000-00-00', '2013-11-29', 1030909.09091, 0, 51, '', 0),
(872, 7, '0000-00-00', '2013-12-29', 1030909.09091, 0, 51, '', 0),
(873, 8, '0000-00-00', '2014-01-29', 1030909.09091, 0, 51, '', 0),
(874, 9, '0000-00-00', '2014-02-28', 1030909.09091, 0, 51, '', 0),
(875, 10, '0000-00-00', '2014-03-29', 1030909.09091, 0, 51, '', 0),
(876, 11, '0000-00-00', '2014-04-29', 1030909.09091, 0, 51, '', 0),
(877, 1, '2013-04-16', '2011-01-01', 1288636.36364, 0, 52, '', 1),
(878, 2, '0000-00-00', '2011-02-01', 1288636.36364, 0, 52, '', 0),
(879, 3, '0000-00-00', '2011-03-01', 1288636.36364, 0, 52, '', 0),
(880, 4, '0000-00-00', '2011-04-01', 1288636.36364, 0, 52, '', 0),
(881, 5, '0000-00-00', '2011-05-01', 1288636.36364, 0, 52, '', 0),
(882, 6, '0000-00-00', '2011-06-01', 1288636.36364, 0, 52, '', 0),
(883, 7, '0000-00-00', '2011-07-01', 1288636.36364, 0, 52, '', 0),
(884, 8, '0000-00-00', '2011-08-01', 1288636.36364, 0, 52, '', 0),
(885, 9, '0000-00-00', '2011-09-01', 1288636.36364, 0, 52, '', 0),
(886, 10, '0000-00-00', '2011-10-01', 1288636.36364, 0, 52, '', 0),
(887, 11, '0000-00-00', '2011-11-01', 1288636.36364, 0, 52, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kredit`
--

CREATE TABLE IF NOT EXISTS `kredit` (
  `id_kredit` int(100) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date NOT NULL,
  `lama_tahun_kredit` int(11) NOT NULL,
  `bunga` float NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_motor` int(11) NOT NULL,
  `dp` double NOT NULL,
  PRIMARY KEY (`id_kredit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `kredit`
--

INSERT INTO `kredit` (`id_kredit`, `tanggal_mulai`, `lama_tahun_kredit`, `bunga`, `id_pelanggan`, `id_motor`, `dp`) VALUES
(50, '2013-04-16', 11, 5, 4, 8, 1200000),
(51, '2013-06-29', 11, 5, 4, 9, 1200000),
(52, '2011-01-01', 11, 5, 4, 11, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE IF NOT EXISTS `kwitansi` (
  `id_kwitansi` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_kwitansi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_angsur` int(11) NOT NULL,
  PRIMARY KEY (`id_kwitansi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`id_kwitansi`, `waktu_kwitansi`, `id_angsur`) VALUES
(38, '2013-04-15 22:19:42', 855),
(39, '2013-04-15 22:21:14', 866),
(40, '2013-04-15 22:21:59', 877);

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE IF NOT EXISTS `motor` (
  `id_motor` int(11) NOT NULL AUTO_INCREMENT,
  `merk_motor` varchar(500) NOT NULL,
  `nama_motor` varchar(500) NOT NULL,
  `tahun` int(11) NOT NULL,
  `no_rangka` varchar(500) NOT NULL,
  `no_mesin` varchar(500) NOT NULL,
  `harga` double NOT NULL,
  `tersedia` int(11) NOT NULL DEFAULT '1' COMMENT '0 = tidak, 1 = tersedia',
  PRIMARY KEY (`id_motor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id_motor`, `merk_motor`, `nama_motor`, `tahun`, `no_rangka`, `no_mesin`, `harga`, `tersedia`) VALUES
(7, 'SUZUKI', 'Matic 1242', 2010, '1414215125', '139015152', 30000000, 1),
(8, 'YAMAHA', 'Mio Y 123', 2013, '10517583810', '810519394710', 12000000, 0),
(9, 'YAMAHA', 'Mio Y 123', 2010, '0180181048201', '2901901840293', 12000000, 0),
(10, 'YAMAHA', 'Mio Y 124', 2013, '1020481048', '01039481019', 14000000, 1),
(11, 'HONDA', 'Beat CS2', 2010, '104019410', '984019124810', 15000000, 0),
(12, 'HONDA', 'Beat CS2 Silver', 2010, '010193840181', '0198017018375', 10000000, 1),
(13, 'SUZUKI', 'SSR X 231', 2010, '149124129084', '12948104', 15000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_telp`, `pekerjaan`, `no_ktp`) VALUES
(4, 'Giri Prahasta Putra', 'Jl. G. Bromo 1 No. 14, Sampit, Kal-Teng, 74312', '085251059399', 'Mahasiswa', '124195001941823');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
