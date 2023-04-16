-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2023 pada 17.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `absensi`
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
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `nokartu`, `id_kelas`, `tanggal`, `jam_absensi`, `keterangan`) VALUES
(57, '202010370311015', 4, '2023-04-14', '11:14:47', '<strong>Tepat Waktu</strong>'),
(58, '202010370311015', 2, '2023-04-08', '11:15:55', 'Terlambat - -1 menit- -'),
(59, '202010370311015', 1, '2023-04-12', '14:38:03', 'Terlambat - -23 menit- -');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `kelas_praktikum` varchar(30) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas_praktikum`, `hari`, `jam`) VALUES
(1, 'PBO A', 'Wednesday', '20:30:00'),
(2, 'PBO B', 'Tuesday', '09:00:00'),
(3, 'PROGDAS A', 'Monday', '02:30:23'),
(4, 'PROGDAS B', 'Wednesday', '00:20:23'),
(5, 'PROGDAS C', 'Thursday', '13:00:00'),
(6, 'PROGDAS G', 'Friday', '00:00:00'),
(7, 'STRUKTUR DATA E', 'Thursday', '15:00:00'),
(8, 'PBO C', 'Saturday', '20:24:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kirimdata`
--

CREATE TABLE `kirimdata` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(15) NOT NULL,
  `nokartu` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nokartu`, `nama`, `id_kelas`) VALUES
(24, '202010370311020', 'babibu', '1,5'),
(25, '202010370311015', 'Test Saja Sample 1', '1,2,3,4,5,'),
(26, '202010370311017', 'e2e2 2qe 2qe', '3,7'),
(27, '202010370311019', 'dwad wda wd', '1,2,5'),
(31, '202210370311011', 'tes', '1'),
(32, '202210370311005', 'tes adada', '1'),
(33, '202210370311015', 'tes adfg', '2'),
(35, '202210370311006', 'tes kirim data', '8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`mode`) VALUES
(1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfiddaftar`
--

CREATE TABLE `tmprfiddaftar` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfidscan`
--

CREATE TABLE `tmprfidscan` (
  `nokartu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kirimdata`
--
ALTER TABLE `kirimdata`
  ADD PRIMARY KEY (`nokartu`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`mode`);

--
-- Indeks untuk tabel `tmprfiddaftar`
--
ALTER TABLE `tmprfiddaftar`
  ADD PRIMARY KEY (`nokartu`);

--
-- Indeks untuk tabel `tmprfidscan`
--
ALTER TABLE `tmprfidscan`
  ADD PRIMARY KEY (`nokartu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
