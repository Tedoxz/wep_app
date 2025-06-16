-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 03:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loker_perusahaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `inisial` varchar(10) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nama`, `inisial`, `id_user`) VALUES
(1, 'Frontend Developer', 'HRD', 5),
(2, 'Web Developer', 'HRD', 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_tahapan`
--

CREATE TABLE `detail_tahapan` (
  `id_detail` int(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_tahapan` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_tahapan`
--

INSERT INTO `detail_tahapan` (`id_detail`, `id_periode`, `id_tahapan`, `urutan`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(2, 2, 3, 1, '2025-06-03', '2025-06-05'),
(3, 2, 5, 2, '2025-06-06', '2025-06-08'),
(4, 2, 4, 3, '2025-06-09', '2025-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id_lamar` int(11) NOT NULL,
  `id_pelamar` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_detail` int(11) DEFAULT NULL,
  `status` enum('daftar','seleksi','diterima','ditolak') DEFAULT NULL,
  `id_lowongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lamaran`
--

INSERT INTO `lamaran` (`id_lamar`, `id_pelamar`, `tanggal`, `id_detail`, `status`, `id_lowongan`) VALUES
(1, 3, '2025-06-01', NULL, 'daftar', 3),
(2, 1, '2025-06-04', NULL, NULL, 3),
(3, 1, '2025-06-04', NULL, NULL, 3),
(4, 4, '2025-06-04', NULL, 'daftar', 3),
(5, 5, '2025-06-04', NULL, 'daftar', 3),
(6, 6, '2025-06-05', NULL, 'daftar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `id_department` int(11) DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kualifikasi` text DEFAULT NULL,
  `tanggal_buka` date DEFAULT NULL,
  `tanggal_tutup` date DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `id_department`, `posisi`, `deskripsi`, `kualifikasi`, `tanggal_buka`, `tanggal_tutup`, `kuota`, `id_periode`) VALUES
(3, 1, 'frontend developer', 'Mengembangkan website lowongan kerja.', 'S1 Teknik Informatika\r\nMenguasai PHP', '2025-06-01', '2025-06-30', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `id_lowongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `id_user`, `nama`, `email`, `no_hp`, `alamat`, `cv_file`, `id_lowongan`) VALUES
(1, 3, 'Asludin Azami', 'asludinazami@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1748614010_XYZ.jpg', NULL),
(2, 3, 'Asludin Azami', 'asludinazami@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1748749808_XYZ.jpg', NULL),
(3, 3, 'Asludin Azami', 'asludinazami@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1748749862_XYZ.jpg', NULL),
(4, 3, 'Muzammil', 'muzammil@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1749020458_XYZ.jpg', 3),
(5, 3, 'Muzammil', 'muzammil@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1749020540_XYZ.jpg', 3),
(6, 10, 'Asludin Azami', 'asludinazami@gmail.com', '081247794119', 'Jl. Tanjung ria dok IX', '../uploads/cv/1749123868_XYZ.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `periode`, `status`) VALUES
(2, 'Periode Juni 2025', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama`, `alamat`, `email`, `telepon`, `deskripsi`, `logo`, `id_user`) VALUES
(1, 'PT.XYZ', 'JL.Tanjung Ria Dok IX', 'info@xyz.co.id', '021-12345678', 'Perusahaan kami bergerak di bidang teknologi dan pengembangan sumber daya manusia.', 'logo.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tahapan`
--

CREATE TABLE `tahapan` (
  `id_tahapan` int(11) NOT NULL,
  `tahapan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahapan`
--

INSERT INTO `tahapan` (`id_tahapan`, `tahapan`) VALUES
(3, 'Seleksi Administrasi'),
(4, 'Wawancara'),
(5, 'Tes Tulis');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `akses` enum('admin','user','departemen') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`, `akses`) VALUES
(3, 'asludin', '$2y$10$Tyhz5spHOJ31TVv3VneFcOwa9YGtaj1t9HYigV1e5CerUmiNX438u', 'user'),
(4, 'admin', '$2y$10$mj4eh5AitgK1hcCMB0wbPuFLk59yp0mY047AqhLY.YcyY0jPwd6OS', 'admin'),
(5, 'departemen', '$2y$10$t4hiDl4oMea2YVvPxutM1OlnkBAp9Gn1I3VuAUMAbt6i/CtLLb3E.', 'departemen'),
(7, 'azami', '$2y$10$Swltx4cwuadxk7H87PNpcevaHGfaf0VBYDJbTdGX296nSvc9pzcUq', 'user'),
(8, 'Ele', '$2y$10$dNVc4EzqoSD/9ufdfFjKOeCdagWCHxZ4JKtw6m9hrP8s/QnhgBbfq', 'departemen'),
(9, 'deni', '$2y$10$alxu34.EozbS56wUJDDexe4CmEPoX3Aj/rVYQD8DbGw7HWj8jCXXG', 'user'),
(10, 'Asludin Azami', '$2y$10$MDYkZLdPEj4dES.T8rwQ6u2D5l43864Nhj2SezsGsaFo.ZnpjSNZa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_tahapan`
--
ALTER TABLE `detail_tahapan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_tahapan` (`id_tahapan`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id_lamar`),
  ADD KEY `id_pelamar` (`id_pelamar`),
  ADD KEY `id_detail` (`id_detail`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`),
  ADD KEY `id_department` (`id_department`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahapan`
--
ALTER TABLE `tahapan`
  ADD PRIMARY KEY (`id_tahapan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_tahapan`
--
ALTER TABLE `detail_tahapan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id_lamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahapan`
--
ALTER TABLE `tahapan`
  MODIFY `id_tahapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `detail_tahapan`
--
ALTER TABLE `detail_tahapan`
  ADD CONSTRAINT `detail_tahapan_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_tahapan_ibfk_2` FOREIGN KEY (`id_tahapan`) REFERENCES `tahapan` (`id_tahapan`) ON DELETE CASCADE;

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE,
  ADD CONSTRAINT `lamaran_ibfk_2` FOREIGN KEY (`id_detail`) REFERENCES `detail_tahapan` (`id_detail`) ON DELETE SET NULL;

--
-- Constraints for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `lowongan_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
