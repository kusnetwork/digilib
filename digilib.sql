-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2013 at 11:01 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digilib`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

DROP TABLE IF EXISTS `tb_buku`;
CREATE TABLE IF NOT EXISTS `tb_buku` (
  `kodeBuku` int(20) NOT NULL AUTO_INCREMENT,
  `judul` text NOT NULL,
  `kodePenerbit` int(20) NOT NULL,
  `kodePengarang` int(20) NOT NULL,
  `tahun` int(4) NOT NULL,
  `edisi` varchar(20) NOT NULL,
  `issn_isbn` varchar(30) NOT NULL,
  `seri` varchar(10) NOT NULL,
  `abstraksi` text NOT NULL,
  `kodeKategori` int(4) NOT NULL,
  `tglInput` datetime NOT NULL,
  `tglUpdate` datetime NOT NULL,
  `image` text NOT NULL,
  `lastUpdateBy` int(10) NOT NULL,
  PRIMARY KEY (`kodeBuku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`kodeBuku`, `judul`, `kodePenerbit`, `kodePengarang`, `tahun`, `edisi`, `issn_isbn`, `seri`, `abstraksi`, `kodeKategori`, `tglInput`, `tglUpdate`, `image`, `lastUpdateBy`) VALUES
(1, 'Lord of The Rings', 1, 2, 2006, '2010', '', '17', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\nDonec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\nDonec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\nDonec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.\r\nDonec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 1, '2013-03-22 00:00:00', '2013-03-30 00:26:36', '', 1),
(2, 'Angels and Demons', 1, 1, 2006, '5', '', '', '', 1, '2013-03-22 00:00:00', '2013-03-22 00:00:00', '', 1),
(6, 'The Hobbit', 1, 2, 2000, '1', '1', '1', 'adadasd', 1, '2013-03-30 00:46:46', '2013-03-30 00:46:46', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

DROP TABLE IF EXISTS `tb_dosen`;
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `kodeDosen` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateInput` datetime NOT NULL,
  `dateUpdate` datetime NOT NULL,
  `tempatLahir` varchar(40) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`kodeDosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`kodeDosen`, `username`, `password`, `nama`, `email`, `dateInput`, `dateUpdate`, `tempatLahir`, `tanggalLahir`, `alamat`, `image`) VALUES
(1, 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'Pak Dosen', 'dosen@eepis-its.edu', '2013-03-22 00:00:00', '2013-03-22 00:00:00', 'Surabaya', '1980-10-08', 'Surabaya', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `kodeKategori` int(4) NOT NULL AUTO_INCREMENT,
  `namaKategori` varchar(50) NOT NULL,
  PRIMARY KEY (`kodeKategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kodeKategori`, `namaKategori`) VALUES
(1, 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

DROP TABLE IF EXISTS `tb_mahasiswa`;
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `kodeMhs` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateInput` datetime NOT NULL,
  `dateUpdate` datetime NOT NULL,
  `tempatLahir` varchar(40) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` text NOT NULL,
  `image` text NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  PRIMARY KEY (`kodeMhs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`kodeMhs`, `username`, `password`, `nama`, `email`, `dateInput`, `dateUpdate`, `tempatLahir`, `tanggalLahir`, `alamat`, `image`, `jurusan`) VALUES
(1, 'deny', '05afb6ce69b9cef1bd6ece7e4745f96c', 'Deny Herianto', 'deny.hrnt@gmail.com', '2013-03-22 00:00:00', '2013-03-22 00:00:00', 'Surabaya', '1993-10-06', 'Surabaya', '', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerbit`
--

DROP TABLE IF EXISTS `tb_penerbit`;
CREATE TABLE IF NOT EXISTS `tb_penerbit` (
  `kodePenerbit` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`kodePenerbit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_penerbit`
--

INSERT INTO `tb_penerbit` (`kodePenerbit`, `nama`, `alamat`, `telp`, `email`) VALUES
(1, 'Gramedia', 'Jl. Jakarta', '0899', 'office@gramedia.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengarang`
--

DROP TABLE IF EXISTS `tb_pengarang`;
CREATE TABLE IF NOT EXISTS `tb_pengarang` (
  `kodePengarang` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`kodePengarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_pengarang`
--

INSERT INTO `tb_pengarang` (`kodePengarang`, `nama`) VALUES
(1, 'Dan Brown'),
(2, 'J.R.R. Tolkien'),
(4, 'Deny Herianto');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

DROP TABLE IF EXISTS `tb_petugas`;
CREATE TABLE IF NOT EXISTS `tb_petugas` (
  `kodePetugas` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` text NOT NULL,
  `dateInput` datetime NOT NULL,
  `dateUpdate` datetime NOT NULL,
  `tempatLahir` varchar(40) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`kodePetugas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`kodePetugas`, `username`, `password`, `nama`, `email`, `dateInput`, `dateUpdate`, `tempatLahir`, `tanggalLahir`, `alamat`, `image`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin@eepis-its.edu', '2013-03-22 00:00:00', '2013-03-22 00:00:00', 'Surabaya', '1990-10-06', 'Surabaya', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

DROP TABLE IF EXISTS `tb_pinjam`;
CREATE TABLE IF NOT EXISTS `tb_pinjam` (
  `kodePinjam` int(20) NOT NULL,
  `kodePetugas` int(10) NOT NULL,
  `kodePeminjam` int(10) NOT NULL,
  `tipePeminjam` int(1) NOT NULL,
  `tglPinjam` datetime NOT NULL,
  `tglKembali` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`kodePinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`kodePinjam`, `kodePetugas`, `kodePeminjam`, `tipePeminjam`, `tglPinjam`, `tglKembali`, `keterangan`, `status`) VALUES
(2013033021, 0, 1, 2, '2013-03-30 10:16:36', '0000-00-00 00:00:00', '', 1),
(2013033031, 1, 1, 3, '2013-03-30 10:17:47', '0000-00-00 00:00:00', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjamdetail`
--

DROP TABLE IF EXISTS `tb_pinjamdetail`;
CREATE TABLE IF NOT EXISTS `tb_pinjamdetail` (
  `kodePinjamDetail` int(11) NOT NULL AUTO_INCREMENT,
  `kodePinjam` int(20) NOT NULL,
  `kodeBuku` int(20) NOT NULL,
  PRIMARY KEY (`kodePinjamDetail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tb_pinjamdetail`
--

INSERT INTO `tb_pinjamdetail` (`kodePinjamDetail`, `kodePinjam`, `kodeBuku`) VALUES
(17, 2013033021, 2),
(18, 2013033021, 1),
(19, 2013033031, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
