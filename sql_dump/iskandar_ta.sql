-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 02:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iskandar_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id_biodata` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `alamat` text,
  `id_divisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id_biodata`, `nama`, `tgl_lahir`, `jk`, `alamat`, `id_divisi`) VALUES
(1, 'Hrd JogjaBay', '1990-07-01', 'L', 'Jogja', NULL),
(2, 'Juairia Lestari', '1991-07-01', 'P', 'Banda Aceh', NULL),
(3, 'Novita', '1995-07-22', 'P', 'Banda Aceh', 3),
(4, 'Nila', '1994-07-22', 'P', 'Banda aceh', 2),
(5, 'Fitri', '1993-07-22', 'P', 'Banda aceh', 4),
(6, 'Dian', '1990-07-22', 'P', 'Banda aceh', 4),
(7, 'Ari', '1992-07-22', 'L', 'Banda aceh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Security'),
(2, 'Kasir'),
(3, 'Staff Logistik & Purchasing'),
(4, 'Pramuniaga'),
(5, 'Chief Security'),
(6, 'Part Timer'),
(7, 'Magang');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `bobot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `bobot`) VALUES
(1, 'Attitude', NULL),
(2, 'Grooming', NULL),
(3, 'Kinerja', NULL),
(4, 'Integritas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `id_kategori`) VALUES
(1, 'Ketelitian', 0.5, 3),
(2, 'Service excellent', 0.7, 3),
(3, 'Personal Selling', 0.6, 3),
(4, 'Kerjasama Tim', 0.4, 3),
(5, 'Kedisiplinan', 0.2, 4),
(6, 'Kejujuran', 0.3, 4),
(7, 'Inisiatif', 0.1, 4),
(8, 'Attitude', 0.8, 1),
(9, 'Grooming', 0.9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `id_nilai_akhir` int(11) NOT NULL,
  `kuisioner` varchar(100) DEFAULT NULL,
  `rata_rata` varchar(100) DEFAULT NULL,
  `total_awal` varchar(100) DEFAULT NULL,
  `id_penilaian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `ketelitian` varchar(50) DEFAULT NULL,
  `servis_excellent` text,
  `personal_selling` text,
  `id_nilai_akhir` int(11) DEFAULT NULL,
  `kerjasama_team` varchar(15) DEFAULT NULL,
  `kedisiplinan` varchar(35) DEFAULT NULL,
  `kejujuran` text,
  `inisiatif` text,
  `id_biodata` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` enum('karyawan','manajer','hrd') DEFAULT NULL,
  `id_biodata` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `password`, `level`, `id_biodata`) VALUES
(1, 'hrd', 'hrd', 'hrd', 1),
(2, 'manajer', 'manajer', 'manajer', 2),
(4, 'karyawan1', 'karyawan', 'karyawan', 3),
(5, 'karyawan2', 'karyawan', 'karyawan', 4),
(6, 'karyawan3', 'karyawan', 'karyawan', 5),
(7, 'karyawan4', 'karyawan', 'karyawan', 6),
(8, 'karyawan5', 'karyawan', 'karyawan', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id_nilai_akhir`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
