-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2025 at 04:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengelola_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `nama_event` varchar(255) NOT NULL,
  `deskripsi_event` text DEFAULT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kuota` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT 0.00,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penyelenggara` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gambar_event` varchar(255) DEFAULT NULL,
  `status_event` enum('upcoming','active','finished','cancelled') DEFAULT 'upcoming',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `nama_event`, `deskripsi_event`, `tanggal_mulai`, `tanggal_selesai`, `lokasi`, `kuota`, `harga`, `id_kategori`, `id_penyelenggara`, `user_id`, `gambar_event`, `status_event`, `created_at`, `updated_at`) VALUES
(1, 'futsal magelang', '', '2025-07-26 14:52:00', '2025-07-28 14:52:00', 'magelang', NULL, 10000.00, 7, 5, NULL, 'event_1752911623.png', 'finished', '2025-07-19 14:53:43', '2025-07-22 01:39:29'),
(2, '17 agustus', 'anjay mabar', '2025-07-26 15:04:00', '2025-07-28 15:04:00', 'magelang', 500, 10000.00, 8, 6, NULL, 'event_1752912721.png', 'upcoming', '2025-07-19 15:12:01', '2025-07-19 15:12:01'),
(5, 'memasak', 'memasak enak', '2025-07-23 01:35:00', '2025-07-24 01:35:00', 'jakarta', 100, 5000.00, 9, 6, NULL, 'event_1753123021.png', 'active', '2025-07-22 01:37:01', '2025-07-22 01:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Seminar Nasional', 'Event edukasi dengan pembicara ahli dari berbagai bidang.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(2, 'Workshop Kreatif', 'Sesi pelatihan praktis untuk mengembangkan keterampilan baru.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(3, 'Konferensi Internasional', 'Pertemuan besar dengan pembahasan mendalam isu global.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(4, 'Konser Musik', 'Pertunjukan musik dari artis lokal maupun internasional.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(5, 'Pameran Seni', 'Pameran karya seni rupa, patung, dan instalasi.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(6, 'Webinar Edukasi', 'Seminar online yang fokus pada topik pendidikan.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(7, 'Kompetisi Esport', 'Turnamen game online dengan peserta dari berbagai daerah.', '2025-07-19 14:47:02', '2025-07-19 14:47:02'),
(8, 'futsal', '23467vhhjn', '2025-07-19 15:01:42', '2025-07-19 15:01:42'),
(9, 'masak', 'masak masak', '2025-07-22 01:35:02', '2025-07-22 01:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE `penyelenggara` (
  `id` int(11) NOT NULL,
  `nama_penyelenggara` varchar(255) NOT NULL,
  `email_penyelenggara` varchar(100) DEFAULT NULL,
  `telepon_penyelenggara` varchar(50) DEFAULT NULL,
  `alamat_penyelenggara` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyelenggara`
--

INSERT INTO `penyelenggara` (`id`, `nama_penyelenggara`, `email_penyelenggara`, `telepon_penyelenggara`, `alamat_penyelenggara`, `created_at`, `updated_at`) VALUES
(1, 'PT Event Cemerlang', 'info@eventcemerlang.com', '021-1234567', 'Jl. Sudirman No. 123, Jakarta Pusat', '2025-07-19 14:47:13', '2025-07-19 14:47:13'),
(2, 'Yayasan Edukasi Bangsa', 'admin@edukasibangsa.org', '022-7654321', 'Jl. Ganesha No. 10, Bandung', '2025-07-19 14:47:13', '2025-07-19 14:47:13'),
(3, 'Komunitas Developer ID', 'contact@devid.org', '0812-3456-7890', 'Gedung Inkubator Startup, Yogyakarta', '2025-07-19 14:47:13', '2025-07-19 14:47:13'),
(4, 'Universitas Maju Jaya', 'event@umj.ac.id', '0274-112233', 'Jl. Kaliurang KM 10, Sleman, Yogyakarta', '2025-07-19 14:47:13', '2025-07-19 14:47:13'),
(5, 'Dinas Pariwisata & Ekonomi Kreatif', 'pariwisata@kotax.go.id', '024-9876543', 'Kantor Walikota, Semarang', '2025-07-19 14:47:13', '2025-07-19 14:47:13'),
(6, 'ibul', 'sipisipi@gmail.com', '085743767609', 'BOROBUDUR', '2025-07-19 15:03:25', '2025-07-19 15:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'peserta',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `role`, `created_at`, `updated_at`) VALUES
(1, 'iboll', 'bubul@gmail.com', '$2y$10$43YpNPXG71QHqZWe6V1HPO8aNV27GN6zkp8Kxck/NK4EX/8lh6PNu', 'muhammad toyibul', 'peserta', '2025-07-19 01:46:44', '2025-07-19 21:40:00'),
(2, 'admin', 'admin@gmail.com', '$2y$10$EGm8z43TLejCiDKVxy037uO.OW4RMMOTuM95YC9SM9oBIcP7oHs0W', 'Administrator Utama', 'admin', '2025-07-19 13:56:34', '2025-07-19 21:40:22'),
(3, 'event manager', 'manager@gmail.com', '$2y$10$vlvXzQUexsWVkpiDishFn.iQvJMkGd2IKUBcCYOvjqarfa4xOV9Vu', 'toyibul', 'event_manager', '2025-07-19 20:00:55', '2025-07-19 21:40:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penyelenggara` (`id_penyelenggara`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_penyelenggara` (`nama_penyelenggara`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`id_penyelenggara`) REFERENCES `penyelenggara` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
