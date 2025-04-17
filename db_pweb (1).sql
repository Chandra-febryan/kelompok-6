-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2025 at 09:58 AM
-- Server version: 10.4.32-MariaDB-log
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_armada`
--

CREATE TABLE `tb_armada` (
  `id` int(3) NOT NULL,
  `kode_bus` varchar(6) NOT NULL,
  `rute` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_armada`
--

INSERT INTO `tb_armada` (`id`, `kode_bus`, `rute`) VALUES
(1, 'GSK101', 'Gresik-Surabaya'),
(2, 'SBY102', 'Surabaya-Gresik'),
(4, 'SBY103', 'Surabaya-Sidoarjo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_chart`
--

CREATE TABLE `tb_chart` (
  `id` int(11) NOT NULL,
  `minggu` varchar(15) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `user_aktif` int(11) NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_chart`
--

INSERT INTO `tb_chart` (`id`, `minggu`, `bulan`, `user_aktif`, `tgl_buat`) VALUES
(1, 'Minggu 1', 'Maret', 50, '2025-04-01 04:30:29'),
(2, 'Minggu 2', 'Maret', 20, '2025-04-01 04:30:29'),
(3, 'Minggu 3', 'Maret', 30, '2025-04-01 04:32:59'),
(4, 'Minggu 4', 'Maret', 60, '2025-04-01 04:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(3) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `bus_start` time NOT NULL,
  `bus_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id`, `bus_id`, `bus_start`, `bus_end`) VALUES
(1, 1, '06:00:00', '22:00:00'),
(2, 2, '06:00:00', '22:00:00'),
(4, 4, '06:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket`
--

CREATE TABLE `tb_tiket` (
  `id` int(3) NOT NULL,
  `id_rute` int(3) NOT NULL,
  `id_user` int(3) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `harga_umum` varchar(10) NOT NULL,
  `harga_pelajar` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'alex', '$2y$10$XumnRxOo2R0VWMCmEhy6cOe5ZvrV.eXmonfK9rpSivbZyQd0mFcvS', 'user'),
(3, 'glen', '$2y$10$UimqI.gpXq2XO8a5DWsrrOqikefQaJR1CGANmCK5G95MfapvkaTiC', 'admin'),
(5, 'chan', '$2y$10$7S9W6PzPFmKdm9xrnxRQaOgBobG0n6b6JZ8SszEiw3tebTjocYpZ6', 'user'),
(6, 'chanzi', '$2y$10$UzQCtoLIV1PAOAdYkGHlpOC2dHsV2u5Im.z51TUptbZIdEPn9Vuc6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_armada`
--
ALTER TABLE `tb_armada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_chart`
--
ALTER TABLE `tb_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_armada`
--
ALTER TABLE `tb_armada`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_chart`
--
ALTER TABLE `tb_chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `tb_armada` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
