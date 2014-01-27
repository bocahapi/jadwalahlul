-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2014 at 06:40 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jadwaldosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `setting` varchar(20) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`setting`, `value`) VALUES
('Request', 'on'),
('TA', 'ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE IF NOT EXISTS `fakultas` (
  `id_fak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fak`, `nama_fakultas`) VALUES
(2, 'Fakultas Teknik'),
(3, 'Fakultas Ilmu Komunikasi dan Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE IF NOT EXISTS `hari` (
  `id_hari` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(10) NOT NULL,
  `jam` int(11) NOT NULL,
  PRIMARY KEY (`id_hari`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `hari`, `jam`) VALUES
(1, 'Senin', 15),
(2, 'Selasa', 15),
(3, 'Rabu', 15),
(4, 'Kamis', 15),
(5, 'Jumat', 15),
(6, 'Sabtu', 15);

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id_help` int(11) NOT NULL AUTO_INCREMENT,
  `help` text NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_help`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id_help`, `help`, `judul`, `id_user`) VALUES
(2, '<p>1&nbsp; :&nbsp; 07.00 - 07.50<br />2&nbsp; :&nbsp; 07.50 - 08.40<br />3&nbsp; :&nbsp; 08.40 - 09.30<br />4&nbsp; :&nbsp; 09.30 - 10.20<br />5&nbsp; :&nbsp; 10.20 - 11.10<br />6&nbsp; :&nbsp; 11.10 - 12.00<br />7&nbsp; :&nbsp; 12.30 - 13.20<br />8&nbsp; :&nbsp; 13.20 - 14.10<br />9&nbsp; :&nbsp; 14.10 - 15.00<br />10 :&nbsp; 15.20 - 16.10<br />11 :&nbsp; 16.10 - 17.00<br />12 :&nbsp; 17.00 - 17.50</p>\r\n<p>KHUSUS HARI JUMAT</p>\r\n<p>Jam ke 7 dan seterusnya diundur 30 menit, menjadi :</p>\r\n<p>7&nbsp; :&nbsp; 13.00-13.50 &nbsp;&nbsp;&nbsp; &nbsp;<br />8&nbsp; :&nbsp; 13.50-14.40 &nbsp;&nbsp;&nbsp; &nbsp;<br />9&nbsp; :&nbsp; 14.40-15.30 &nbsp;&nbsp;&nbsp; &nbsp;<br />10 :&nbsp; 16.00-16.50 &nbsp;&nbsp;&nbsp; &nbsp;<br />11 :&nbsp; 16.50-17.40 &nbsp;&nbsp;&nbsp; &nbsp;<br />12 :&nbsp; 17.40-18.30</p>', 'Kode Jam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jad` int(11) NOT NULL AUTO_INCREMENT,
  `id_hari` int(11) NOT NULL,
  `jam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_fak` int(11) NOT NULL,
  `id_jur` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `semester` int(5) NOT NULL,
  PRIMARY KEY (`id_jad`),
  KEY `users` (`id_user`,`id_kelas`,`id_matkul`,`id_fak`,`id_jur`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_matkul` (`id_matkul`),
  KEY `id_fak` (`id_fak`),
  KEY `id_jur` (`id_jur`),
  KEY `id_ruang` (`id_ruang`),
  KEY `id_hari` (`id_hari`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jad`, `id_hari`, `jam`, `id_user`, `id_kelas`, `id_matkul`, `id_fak`, `id_jur`, `id_ruang`, `semester`) VALUES
(10, 1, 2, 32, 1, 124, 2, 2, 14, 4),
(11, 1, 3, 32, 1, 124, 2, 2, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_full`
--

CREATE TABLE IF NOT EXISTS `jadwal_full` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `jamkelas` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `id_fak` int(11) NOT NULL,
  `id_jur` int(11) NOT NULL,
  `semester` int(5) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_hari` (`id_hari`,`id_matkul`),
  KEY `id_kelas` (`id_kelas`,`id_ruang`,`id_fak`,`id_jur`),
  KEY `id_user` (`id_user`),
  KEY `id_matkul` (`id_matkul`),
  KEY `id_ruang` (`id_ruang`),
  KEY `id_fak` (`id_fak`),
  KEY `id_jur` (`id_jur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jadwal_full`
--

INSERT INTO `jadwal_full` (`id_jadwal`, `jamkelas`, `id_user`, `id_hari`, `id_matkul`, `id_kelas`, `id_ruang`, `id_fak`, `id_jur`, `semester`) VALUES
(5, '2-3', 32, 1, 124, 1, 14, 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jur` int(11) NOT NULL AUTO_INCREMENT,
  `id_fak` int(11) NOT NULL,
  `nama_jurusan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jur`),
  KEY `id_fak` (`id_fak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jur`, `id_fak`, `nama_jurusan`) VALUES
(2, 2, 'Teknik Elektro'),
(3, 3, ' Ilmu Komunikasi '),
(4, 3, ' Informatika ');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(2) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H'),
(9, 'I'),
(10, 'J'),
(11, 'K'),
(12, 'L'),
(13, 'M'),
(14, 'X');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE IF NOT EXISTS `matkul` (
  `id_fak` int(11) NOT NULL,
  `id_jur` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `semester` int(5) NOT NULL,
  `sks` int(3) NOT NULL,
  `session` varchar(8) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `status` enum('on','off') NOT NULL,
  PRIMARY KEY (`id_matkul`),
  KEY `id_fak` (`id_fak`),
  KEY `id_jur` (`id_jur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_fak`, `id_jur`, `id_matkul`, `kode_matkul`, `nama_matkul`, `semester`, `sks`, `session`, `type`, `status`) VALUES
(2, 2, 108, 'UMS101', 'Ilmu Sosial dan Budaya Dasar', 2, 2, 'ganjil', 'teori', 'on'),
(2, 2, 109, 'UMS104', 'Al Islam 2', 2, 2, 'ganjil', 'teori', 'on'),
(2, 2, 110, 'TKE114', 'Komputasi Numerik', 8, 3, 'ganjil', '', 'on'),
(2, 2, 111, 'TKE115', 'Fisika Listrik', 2, 2, 'ganjil', 'teori', 'on'),
(2, 4, 112, 'TKE116', 'Pengantar Teknologi Informasi', 2, 2, 'ganjil', 'teori', 'on'),
(2, 4, 113, 'TKE117', 'Elektronika Analog Dasar', 2, 2, 'ganjil', 'teori', 'on'),
(2, 4, 114, 'TKE118', 'Dasar Teknik Digital', 2, 2, 'ganjil', 'Praktikum', 'on'),
(2, 2, 115, 'TKE119', 'Rangkaian Listrik Lanjut', 2, 2, 'ganjil', 'teori', 'on'),
(2, 2, 116, 'TKE117P', 'Prak. Elektronika Analog Dasar', 2, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 117, 'TKE118P', 'Prak. Dasar Teknik Digital', 2, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 118, 'UMS205', 'Al Islam 3', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 119, 'TEK215', 'Bahasa Indonesia', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 120, 'TKE216', 'Manajemen Industri', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 121, 'TKE217', 'Kewirausahaan', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 122, 'TKE218', 'Ilmu Kealaman Dasar', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 123, 'TKE235', 'Mesin Listrik Lanjut', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 124, 'TKE236', 'Elektronika Daya', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 125, 'TKE237', 'Sistem Pembangkit', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 126, 'TKE238', 'Analisis Sitem Tenaga Listrik', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 127, 'TKE235P', 'Prak. Mesin Listrik', 4, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 128, 'TKE252', 'Jaringan Komputer dan Internet', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 129, 'TKE253', 'Elektronika Analog Lanjut', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 130, 'TKE254', 'Arsitektur Sistem Komputer', 4, 2, 'ganjil', 'teori', 'on'),
(2, 2, 131, 'TKE253P', 'Prak. Elektronika Analog Lanjut', 4, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 132, 'TKE311', 'Praktek Kerja Nyata', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 133, 'TKE312', 'Metedologi Penelitian', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 134, 'TKE336', 'Perlengkapan Sistem Tenaga Listrik', 6, 3, 'ganjil', 'teori', 'on'),
(2, 2, 135, 'TKE337', 'Penggunaan Motor Listrik Dalam Industri', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 136, 'TKE338', 'Komputerisasi Sistem Tenaga Listrik', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 137, 'TKE339', 'Teknik Pengendalian Mesin Listrik', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 138, 'TKE338P', 'Prak. Komputerisasi Sistem Tenaga Listrik', 6, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 139, 'TKE339P', 'Prak. Pengendalian Mesin Listrik', 6, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 140, 'TKE355', 'Instrumentasi Elektronis', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 141, 'TKE356', 'Sistem Pengolahan Sinyal', 6, 3, 'ganjil', 'teori', 'on'),
(2, 2, 142, 'TKE357', 'Perangkat Lunak Sistem Embedded', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 143, 'TKE358', 'Komunikasi Data', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 144, 'TKE359', 'Teknik Antar Muka', 6, 2, 'ganjil', 'teori', 'on'),
(2, 2, 145, 'TKE359P', 'Prak. Teknik Antar Muka', 6, 1, 'ganjil', 'praktik', 'on'),
(2, 2, 146, 'TKE411', 'Skripsi', 8, 3, 'ganjil', 'teori', 'on'),
(2, 2, 147, 'TKE412', 'Pendadaran', 8, 3, 'ganjil', 'teori', 'on'),
(2, 2, 148, 'TKE413', 'Tugas Pengganti Skripsi', 8, 3, 'ganjil', 'teori', 'on'),
(2, 2, 149, 'TKE414', 'Ujian Komprehensif', 8, 3, 'ganjil', 'teori', 'on'),
(2, 2, 150, 'TKE437', 'Teknik Tegangan Tinggi', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 151, 'TKE438', 'Teknologi Gardu Induk', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 152, 'TKE439', 'Kualitas Sistem Daya', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 153, 'TKE440', 'Kompatibilitas Elektromagnetik', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 154, 'TKE441', 'Keandalan Sistem Tenaga Listrik', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 156, 'TKE456', 'Jaringan Syaraf Tiruan', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 157, 'TKE457', 'Teknik Audio Video', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 158, 'TKE458', 'Elektronika Komunikasi', 0, 3, 'ganjil', 'teori', 'on'),
(2, 2, 159, 'TKE459', 'Instrumen Otomotif', 0, 3, 'ganjil', 'teori', 'on'),
(3, 3, 160, 'UMSDL002', 'Dasar Logika', 0, 2, NULL, 'teori', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE IF NOT EXISTS `mengajar` (
  `id_mengajar` int(11) NOT NULL AUTO_INCREMENT,
  `id_jur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status` enum('on','off') NOT NULL,
  PRIMARY KEY (`id_mengajar`),
  KEY `id_user` (`id_user`),
  KEY `id_jur` (`id_jur`),
  KEY `id_matkul` (`id_matkul`,`id_kelas`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id_mengajar`, `id_jur`, `id_user`, `id_matkul`, `id_kelas`, `status`) VALUES
(77, 2, 32, 124, 1, 'off'),
(78, 2, 32, 124, 2, 'on'),
(79, 2, 32, 124, 3, 'on'),
(80, 2, 34, 110, 1, 'off'),
(81, 2, 34, 110, 2, 'on'),
(82, 2, 34, 110, 3, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `id_ruang` int(11) NOT NULL AUTO_INCREMENT,
  `id_fak` int(11) NOT NULL,
  `id_jur` int(11) NOT NULL,
  `nama_ruang` varchar(25) NOT NULL,
  PRIMARY KEY (`id_ruang`),
  KEY `id_fak` (`id_fak`),
  KEY `id_jur` (`id_jur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruang`, `id_fak`, `id_jur`, `nama_ruang`) VALUES
(14, 2, 2, 'F.2.1'),
(16, 2, 2, 'F.2.2'),
(17, 2, 2, 'F.2.3'),
(18, 2, 2, 'F.2.4');

-- --------------------------------------------------------

--
-- Table structure for table `sekretaris`
--

CREATE TABLE IF NOT EXISTS `sekretaris` (
  `id_sekretaris` int(11) NOT NULL AUTO_INCREMENT,
  `id_fak` int(11) NOT NULL,
  `id_jur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_sekretaris`),
  KEY `id_fak` (`id_fak`,`id_jur`,`id_user`),
  KEY `id_jur` (`id_jur`),
  KEY `id_users` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sekretaris`
--

INSERT INTO `sekretaris` (`id_sekretaris`, `id_fak`, `id_jur`, `id_user`) VALUES
(4, 3, 4, 32);

-- --------------------------------------------------------

--
-- Table structure for table `status_dosen`
--

CREATE TABLE IF NOT EXISTS `status_dosen` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `stats_dosen` varchar(15) NOT NULL,
  `tgl_mulai` varchar(10) NOT NULL,
  `tgl_selesai` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status_dosen`
--

INSERT INTO `status_dosen` (`id_status`, `stats_dosen`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 'Tetap', '01/01/2014', '02/01/2014'),
(2, 'Kontrak', '01/01/2014', '02/01/2014'),
(3, 'Tidak Tetap', '01/01/2014', '02/01/2014');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(15) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_level`, `level`) VALUES
(1, 'Administrator'),
(2, 'Dosen'),
(3, 'Sekjur');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `NIDN` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `hash_pass` varchar(40) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `NIDN`, `nama`, `username`, `password`, `id_status`, `id_level`, `hash_pass`) VALUES
(1, '', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, ''),
(32, '883', 'Wakhid Wicaksono', '883', '210f760a89db30aa72ca258a3483cc7f', 1, 3, '883'),
(33, '9980', 'Kuncora', '9980', 'a5329a91ef79db75900bd9cab3d96e43', 1, 2, '9980'),
(34, '9999', 'Santosa', '9999', 'fa246d0262c3925617b0c72bb20eeb1d', 1, 2, '9999');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `help`
--
ALTER TABLE `help`
  ADD CONSTRAINT `help_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_5` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_6` FOREIGN KEY (`id_ruang`) REFERENCES `ruangan` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_7` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_full`
--
ALTER TABLE `jadwal_full`
  ADD CONSTRAINT `jadwal_full_ibfk_1` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_4` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_5` FOREIGN KEY (`id_ruang`) REFERENCES `ruangan` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_6` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_full_ibfk_7` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matkul_ibfk_2` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_3` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `ruangan_ibfk_1` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ruangan_ibfk_2` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sekretaris`
--
ALTER TABLE `sekretaris`
  ADD CONSTRAINT `sekretaris_ibfk_1` FOREIGN KEY (`id_fak`) REFERENCES `fakultas` (`id_fak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sekretaris_ibfk_2` FOREIGN KEY (`id_jur`) REFERENCES `jurusan` (`id_jur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sekretaris_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status_dosen` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `user` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
