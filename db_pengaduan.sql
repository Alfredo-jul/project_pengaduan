-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 09:13 AM
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
-- Database: `db_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(100) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `nim`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '202211420027', 'Alfredo', '123456789', 'admin', '2025-07-15 13:14:20', '2025-08-04 08:40:21'),
(2, '202211420063', 'Nabil', '12345', 'mahasiswa', '2025-07-15 13:14:53', '2025-07-15 13:14:53'),
(3, '202211420073', 'Jose', '11111', 'dosen', '2025-07-15 13:15:23', '2025-07-15 13:15:23'),
(4, '202211420006', 'Ilona', '123', 'mahasiswa', '2025-07-24 14:49:07', '2025-07-24 14:49:07'),
(5, '202211420057', 'Prass', '22222', 'dosen', '2025-07-24 16:31:08', '2025-07-24 16:31:08'),
(6, '202211420092', 'Alif', '33333', 'mahasiswa', '2025-07-29 03:44:23', '2025-07-29 03:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `status` enum('belum_dibaca','dibaca') NOT NULL DEFAULT 'belum_dibaca',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `username`, `role`, `isi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jose', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: <strong>diproses</strong>', '', '2025-07-24 16:19:37', '2025-07-24 16:29:42'),
(2, 'Prass', 'admin', 'Akun baru telah mendaftar dengan username: Prass', '', '2025-07-24 16:31:08', '2025-07-24 16:35:06'),
(3, 'Ilona', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: selesai', '', '2025-07-24 16:38:14', '2025-07-24 16:38:45'),
(4, 'Ilona', 'admin', 'Pengaduan baru dari Ilona', '', '2025-07-24 16:42:08', '2025-07-24 16:42:26'),
(5, 'Ilona', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: diproses', '', '2025-07-24 17:39:01', '2025-07-26 06:57:32'),
(6, 'Ilona', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: diproses', '', '2025-07-24 17:56:39', '2025-07-26 06:57:32'),
(7, 'nabil', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: selesai', '', '2025-07-26 04:44:42', '2025-07-26 06:57:45'),
(8, '', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: pengajuan', '', '2025-07-26 05:47:52', '2025-07-26 06:57:32'),
(9, 'Prass', 'admin', 'Pengaduan baru dari Prass', '', '2025-07-29 02:20:33', '2025-07-29 03:48:41'),
(10, 'Alif', 'admin', 'Akun baru telah mendaftar dengan username: Alif', '', '2025-07-29 03:44:23', '2025-07-29 03:48:41'),
(11, 'Alif', 'admin', 'Pengaduan baru dari Alif', '', '2025-07-29 03:45:33', '2025-07-29 03:48:41'),
(12, 'Prass', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: diproses', 'belum_dibaca', '2025-07-29 03:47:49', '2025-07-29 03:47:49'),
(13, 'Alif', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: selesai', 'belum_dibaca', '2025-07-29 03:48:21', '2025-07-29 03:48:21'),
(14, 'Alif', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: diproses', 'belum_dibaca', '2025-07-29 03:48:28', '2025-07-29 03:48:28'),
(15, 'Nabil', 'admin', 'Pengaduan baru dari Nabil', '', '2025-08-05 02:39:44', '2025-08-05 07:01:09'),
(16, 'Nabil', 'admin', 'Pengaduan baru dari Nabil', '', '2025-08-05 02:50:09', '2025-08-05 07:01:09'),
(17, 'Prass', 'admin', 'Pengaduan baru dari Prass', '', '2025-08-05 02:52:01', '2025-08-05 07:01:09'),
(18, 'Prass', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: diproses', 'belum_dibaca', '2025-08-05 02:53:36', '2025-08-05 02:53:36'),
(19, 'Prass', 'mahasiswa', 'Status pengaduan Anda telah diperbarui menjadi: selesai', 'belum_dibaca', '2025-08-05 02:53:49', '2025-08-05 02:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tipe` enum('Keamanan','Layanan','Fasilitas') NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` enum('pengajuan','diproses','selesai') NOT NULL DEFAULT 'pengajuan',
  `foto` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `username`, `tipe`, `deskripsi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'alfredo', 'Fasilitas', 'ac rusak', 'selesai', 'uploads/1752492690_77132e09fd2146a62126.png', '2025-07-14 11:31:30', '2025-07-21 03:32:57'),
(2, 'nabil', 'Keamanan', 'helm hilang', 'selesai', 'uploads/1752492980_11248f26b764be575d73.png', '2025-07-14 11:36:20', '2025-07-26 04:44:42'),
(3, 'Jose', 'Fasilitas', 'Proyektor rusak', 'selesai', 'uploads/1753063125_578c4f1dd86579bbfa1a.png', '2025-07-21 01:58:45', '2025-07-24 13:11:09'),
(5, 'Ilona', 'Fasilitas', 'converter hdmi proyektor rusak', 'diproses', 'uploads/1753368611_bf2974951eb9fb179d47.png', '2025-07-24 14:50:11', '2025-07-24 18:08:52'),
(7, 'Prass', 'Fasilitas', 'Kamar mandi kotor', 'diproses', 'uploads/1753755633_4bb9c89754e41e384284.png', '2025-07-29 02:20:33', '2025-07-29 03:47:49'),
(8, 'Alif', 'Fasilitas', 'ac rusak', 'diproses', 'uploads/1753760732_702275ce21d1986838d2.png', '2025-07-29 03:45:32', '2025-07-29 03:48:28'),
(9, 'Nabil', 'Fasilitas', 'wc kotor', 'pengajuan', 'uploads/1754361583_427305f456179999a5c8.png', '2025-08-05 02:39:43', '2025-08-05 02:39:43'),
(10, 'Nabil', 'Keamanan', 'motor hilang', 'pengajuan', 'uploads/1754362209_5d1305f440b5871d2cf1.png', '2025-08-05 02:50:09', '2025-08-05 02:50:09'),
(11, 'Prass', 'Fasilitas', 'ac kurang dingin', 'selesai', 'uploads/1754362321_67573092d8552bb2f183.png', '2025-08-05 02:52:01', '2025-08-05 02:53:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
