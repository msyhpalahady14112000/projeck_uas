-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2023 at 02:03 AM
-- Server version: 8.0.31-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeck_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `no_daftar` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nim` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tanggal_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`no_daftar`, `nim`, `nama`, `alamat`, `telpon`, `email`, `tanggal_daftar`) VALUES
('0121', 'TI18210015', 'M ZAINI', 'mantang', '0897555678', 'zhyyevo@gmail.com', '2023-01-20 00:00:00'),
('0123', 'TI18210009', 'M SYAMSUL HADY', 'BERAIM LAUQ', '087704704888', 'msyhpalahady.mhs@gmaIl.com', '2023-01-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `lokasi_kegiatan` varchar(50) NOT NULL,
  `tanggal_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `lokasi_kegiatan`, `tanggal_kegiatan`) VALUES
(1, 'PELATIHAN CRUD', 'STMIK LOMBOK', '2023-01-21'),
(2, 'HTML FUNDAMENTAL', 'STMIK LOMBOK', '2023-01-19'),
(3, 'DESAIN GRAFIS', 'STMIK LOMBOK', '2023-01-26'),
(4, 'JARINGAN KOMPUTER', 'STMIK LOMBOK', '2023-01-19'),
(5, 'IOT SETTING', 'STMIK LOMBOK', '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('palahady', '$2y$10$WIFKZxSNcNiS4CyD/1KdHuQYJIRBBKnd4CDzlR8XQyOzwBBGeRDKG');

-- --------------------------------------------------------

--
-- Table structure for table `trx_kegiatan`
--

CREATE TABLE `trx_kegiatan` (
  `id_trx` int NOT NULL,
  `id_tutor` int NOT NULL,
  `no_daftar` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kegiatan` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trx_kegiatan`
--

INSERT INTO `trx_kegiatan` (`id_trx`, `id_tutor`, `no_daftar`, `id_kegiatan`, `username`, `tanggal_kegiatan`) VALUES
(7, 13, '0123', 1, 'palahady', '2023-01-13'),
(8, 14, '0123', 4, 'palahady', '2023-01-13'),
(9, 14, '0123', 2, 'palahady', '2023-01-13'),
(10, 12, '0123', 1, 'palahady', '2023-01-06'),
(11, 13, '0121', 2, 'palahady', '2023-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int NOT NULL,
  `nama_tutor` varchar(50) NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `nama_tutor`, `telpon`, `email`) VALUES
(12, 'WIRE BAGYE,S.kom,M.kom', '08764578653', 'wirebagye@gmail.com'),
(13, 'KHAIRUL FAHMI, S.kom M.kom', '08754564563', 'khairulfhm098@gmail.com'),
(14, 'AHMAD TANTONI,S.kom M.kom', '09856453567', 'tontoni132@gmail.com'),
(15, 'MAEMUN SALEH,S.kom', '08564686769', 'maemunslh@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`no_daftar`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `trx_kegiatan`
--
ALTER TABLE `trx_kegiatan`
  ADD PRIMARY KEY (`id_trx`),
  ADD KEY `fk_kegiatan` (`id_kegiatan`),
  ADD KEY `fk_tutor` (`id_tutor`),
  ADD KEY `fk_login` (`username`),
  ADD KEY `fk_daftar` (`no_daftar`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_tutor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trx_kegiatan`
--
ALTER TABLE `trx_kegiatan`
  MODIFY `id_trx` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trx_kegiatan`
--
ALTER TABLE `trx_kegiatan`
  ADD CONSTRAINT `fk_daftar` FOREIGN KEY (`no_daftar`) REFERENCES `daftar` (`no_daftar`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_kegiatan` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`username`) REFERENCES `login` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
