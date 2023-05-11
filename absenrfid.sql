-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 09:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(57, '202010370311015', 4, '2023-04-14', '11:14:47', '<strong>Tepat Waktu</strong>'),
(58, '202010370311015', 2, '2023-04-08', '11:15:55', 'Terlambat - -1 menit- -'),
(59, '202010370311015', 1, '2023-04-12', '14:38:03', 'Terlambat - -23 menit- -'),
(60, '202010370311017', 7, '2023-05-06', '09:23:34', 'Terlambat - -9 menit- -'),
(61, '202010370311019', 5, '2023-05-11', '13:24:05', 'Terlambat - -9 menit- -'),
(62, '202010370311015', 1, '2023-05-11', '14:04:16', 'Terlambat - -29 menit- -');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `kelas_praktikum` varchar(30) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL,
  `id_lab` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas_praktikum`, `hari`, `jam`, `id_lab`) VALUES
(1, 'PBO A', 'Thursday', '13:20:00', 1),
(2, 'PBO B', 'Saturday', '11:00:00', 0),
(3, 'PROGDAS A', 'Tuesday', '06:30:23', 0),
(4, 'PROGDAS B', 'Saturday', '11:00:23', 0),
(5, 'PROGDAS C', 'Thursday', '13:00:00', 0),
(6, 'PROGDAS G', 'Friday', '00:00:00', 0),
(7, 'STRUKTUR DATA E', 'Saturday', '09:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(15) NOT NULL,
  `nokartu` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nokartu`, `nama`, `id_kelas`) VALUES
(25, '202010370311015', 'rizky rahmatullah', '1'),
(26, '202010370311017', 'e2e2 2qe 2qe', '7'),
(27, '202010370311019', 'dwad wda wd', '1,2,3,4,5,6,7'),
(28, '202010370311021', 'dw wd wdw d', '7'),
(30, '202210370311015', 'dwadw dwadwadwa', '2,4');

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
('2423424');

-- --------------------------------------------------------

--
-- Table structure for table `tmprfidscan`
--

CREATE TABLE `tmprfidscan` (
  `nokartu` varchar(15) NOT NULL,
  `no_lab` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
