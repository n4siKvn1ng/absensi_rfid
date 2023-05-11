-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 09:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenrfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nokartu` varchar(15) NOT NULL,
  `id_kelas` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_absensi` time NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `nokartu`, `id_kelas`, `tanggal`, `jam_absensi`, `keterangan`) VALUES
(62, '202210370311408', 1, '2023-05-11', '12:28:01', 'Terlambat - -13 menit- -'),
(63, '202210370311406', 3, '2023-05-11', '12:30:25', 'Terlambat - -15 menit- -');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `kelas_praktikum` varchar(30) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas_praktikum`, `hari`, `jam`) VALUES
(1, 'PBO A', 'Thursday', '12:00:00'),
(2, 'PBO B', 'Tuesday', '09:00:00'),
(3, 'PROGDAS A', 'Thursday', '12:00:23'),
(4, 'PROGDAS B', 'Wednesday', '00:20:23'),
(5, 'PROGDAS C', 'Thursday', '13:00:00'),
(6, 'PROGDAS G', 'Friday', '00:00:00'),
(7, 'STRUKTUR DATA E', 'Thursday', '15:00:00'),
(8, 'PBO C', 'Saturday', '20:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `kirimdata`
--

CREATE TABLE `kirimdata` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(15) NOT NULL,
  `nokartu` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nokartu`, `nama`, `id_kelas`) VALUES
(57, '202210370311408', 'Zul Razak', '1'),
(58, '202210370311406', 'Abdul Salam', '3');

-- --------------------------------------------------------

--
-- Table structure for table `nolab`
--

CREATE TABLE `nolab` (
  `lab` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nolab`
--

INSERT INTO `nolab` (`lab`) VALUES
('');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`mode`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `tmprfiddaftar`
--

CREATE TABLE `tmprfiddaftar` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmprfiddaftar`
--

INSERT INTO `tmprfiddaftar` (`nokartu`) VALUES
('219942953');

-- --------------------------------------------------------

--
-- Table structure for table `tmprfidscan`
--

CREATE TABLE `tmprfidscan` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmprfidscan`
--

INSERT INTO `tmprfidscan` (`nokartu`) VALUES
('202210370311406');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kirimdata`
--
ALTER TABLE `kirimdata`
  ADD PRIMARY KEY (`nokartu`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nolab`
--
ALTER TABLE `nolab`
  ADD PRIMARY KEY (`lab`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`mode`);

--
-- Indexes for table `tmprfiddaftar`
--
ALTER TABLE `tmprfiddaftar`
  ADD PRIMARY KEY (`nokartu`);

--
-- Indexes for table `tmprfidscan`
--
ALTER TABLE `tmprfidscan`
  ADD PRIMARY KEY (`nokartu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
