-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2024 at 04:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukm`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_ukm_gradasi`
--

CREATE TABLE `kegiatan_ukm_gradasi` (
  `id` int UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rincian_kegiatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_ukm_gradasi`
--

INSERT INTO `kegiatan_ukm_gradasi` (`id`, `nama_kegiatan`, `rincian_kegiatan`, `reg_date`) VALUES
(3, 'Pertrmuan Pertama', '123123123', '2024-06-28 16:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `nim`, `jurusan`, `email`, `no_telepon`, `jenis_kelamin`, `password`, `reset_token`, `token_created_at`) VALUES
(30, 'I Putu Gede Surya Diatmika', '2301010328', 'TI-MTI', 'suryadiatmika095@gmail.com', '085738573608', 'Laki-laki', '$2y$10$fi3iQ2ZUGXEhFpxnGkueouiuwkSnNKn7tzC8qSwDPAPG1gIisf7VS', NULL, NULL),
(31, 'I Nyoman Bagus Aditya Adnyana', '2301010347', 'TI-MTI', 'bagusadityaadnyana@gmail.com', '081337150426', 'Laki-laki', '$2y$10$Aa86PXPecTbfiMPMIeZiP.Ojv5EU4Kktxw.n5ATPX.W.cvXIQlADm', NULL, NULL),
(32, 'Kadek Krisna Sandi Arta', '2301010045', 'TI-MTI', 'sedapmalam@gmail.com', '08131383812', 'Laki-laki', '$2y$10$a.CNdEJGoaYjyc3JECDsbOKFZNwAoCSg.GU4sNQyQ1g7HhplvW9im', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan_ukm_gradasi`
--
ALTER TABLE `kegiatan_ukm_gradasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan_ukm_gradasi`
--
ALTER TABLE `kegiatan_ukm_gradasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
