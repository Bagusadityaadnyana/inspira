-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2024 at 11:09 AM
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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kegiatan_id` int NOT NULL,
  `hadir` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `kegiatan_id`, `hadir`, `created_at`) VALUES
(6, 30, 3, 1, '2024-06-29 05:20:19'),
(7, 31, 3, 0, '2024-06-29 05:22:21'),
(8, 32, 3, 0, '2024-06-29 05:22:30'),
(10, 30, 4, 1, '2024-06-29 08:37:09'),
(11, 31, 4, 1, '2024-06-29 08:37:15'),
(12, 32, 4, 1, '2024-06-29 08:37:20'),
(13, 30, 5, 1, '2024-06-29 08:50:18'),
(14, 31, 5, 0, '2024-06-29 08:50:23'),
(15, 32, 5, 0, '2024-06-29 08:50:30'),
(16, 30, 6, 1, '2024-06-29 08:53:53'),
(17, 31, 6, 0, '2024-06-29 08:54:13'),
(18, 32, 6, 1, '2024-06-29 08:54:22');

-- --------------------------------------------------------

--
-- Stand-in structure for view `absensi_view`
-- (See below for the actual view)
--
CREATE TABLE `absensi_view` (
`nama_lengkap` varchar(100)
,`nama_kegiatan` varchar(50)
,`hadir` tinyint(1)
);

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
(3, 'Pertrmuan Pertama', '123123123', '2024-06-28 16:31:55'),
(4, 'pertemuan kedua', 'membahas apapun', '2024-06-29 02:35:05'),
(5, 'pertemuan ketiga', 'ui/ux', '2024-06-29 08:50:03'),
(6, 'Pertrmuan keempat', 'backend', '2024-06-29 08:53:26');

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

-- --------------------------------------------------------

--
-- Structure for view `absensi_view`
--
DROP TABLE IF EXISTS `absensi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `absensi_view`  AS SELECT `users`.`nama_lengkap` AS `nama_lengkap`, `kegiatan_ukm_gradasi`.`nama_kegiatan` AS `nama_kegiatan`, `absensi`.`hadir` AS `hadir` FROM ((`absensi` join `users` on((`users`.`id` = `absensi`.`user_id`))) join `kegiatan_ukm_gradasi` on((`kegiatan_ukm_gradasi`.`id` = `absensi`.`kegiatan_id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_kegiatan_id` (`kegiatan_id`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kegiatan_ukm_gradasi`
--
ALTER TABLE `kegiatan_ukm_gradasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
