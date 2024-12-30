-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 02:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartphone_diagnostics`
--

-- --------------------------------------------------------

--
-- Table structure for table `ciri_kerusakan`
--

CREATE TABLE `ciri_kerusakan` (
  `kode_ciri` varchar(4) NOT NULL,
  `ciri` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciri_kerusakan`
--

INSERT INTO `ciri_kerusakan` (`kode_ciri`, `ciri`) VALUES
('CK01', 'Tidak bisa menampilkan aplikasi dari fasilitas handphone'),
('CK02', 'Tangan ketika menyentuh touchscreen tidak bersih atau basah'),
('CK03', 'Tidak ada reaksi ketika dihidupkan atau mematikan handphone'),
('CK04', 'Daya baterai tidak terisi'),
('CK05', 'Terjadinya kesalahan pada pengaturan bluetooth'),
('CK06', 'LCD blank/hanya cahaya putih'),
('CK07', 'Tidak dapat mengakses aplikasi pada handphone'),
('CK08', 'IMEI dalam keadaan kosong'),
('CK09', 'SD Card kotor dan tergores'),
('CK10', 'Handphone tiba-tiba mati'),
('CK11', 'Foto yang dihasilkan kamera buram'),
('CK12', 'Suara musik terdengar putus-putus'),
('CK13', 'Ponsel tidak dapat mendeteksi Wi-Fi yang tersedia'),
('CK14', 'Ponsel tidak dapat mendeteksi Wi-Fi yang tersedia'),
('CK15', 'Aplikasi peta menunjukkan lokasi yang tidak akurat'),
('CK16', 'Ponsel tidak dapat menangkap sinyal'),
('CK17', 'Kabel charger terasa longgar saat dihubungkan'),
('CK18', 'Kabel charger terasa longgar saat dihubungkan'),
('CK19', 'Kabel charger terasa longgar saat dihubungkan'),
('CK20', 'Kabel charger terasa longgar saat dihubungkan');

-- --------------------------------------------------------

--
-- Table structure for table `detections`
--

CREATE TABLE `detections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conditions` text DEFAULT NULL,
  `result` text DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detections`
--

INSERT INTO `detections` (`id`, `user_id`, `conditions`, `result`, `percentage`, `created_at`, `email`) VALUES
(88, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 90.00, '2024-11-28 21:29:50', 'andrs.ginting@gmail.com'),
(89, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 90.00, '2024-11-28 21:31:00', 'andrs.ginting@gmail.com'),
(90, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 90.00, '2024-11-28 21:31:26', 'andrs.ginting@gmail.com'),
(91, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 90.00, '2024-11-28 21:31:41', 'andrs.ginting@gmail.com'),
(92, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 60.00, '2024-11-28 21:35:49', 'andrs.ginting@gmail.com'),
(93, 4, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 60.00, '2024-11-28 21:38:53', 'ginting@gmail.com'),
(94, 6, 'MK01, MK03, CK01, CK02', 'IC Power, Display/Touch Screen, Mati Total', 60.00, '2024-11-28 21:52:02', 'ginting@gmail.com'),
(95, 6, 'MK01, MK03, CK01, CK02, CK20', 'IC Power, Display/Touch Screen, Mati Total, Motor Getaran', 54.38, '2024-11-28 21:53:38', 'ginting@gmail.com'),
(96, 6, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 60.00, '2024-11-28 22:00:38', 'andrs.ginting@gmail.com'),
(97, 6, 'MK01, MK02, CK01, CK03', 'IC Power, Display/Touch Screen, Mati Total', 60.00, '2024-11-28 22:10:33', 'andrs.ginting@gmail.com'),
(98, 6, 'MK01, CK01, CK02', 'IC Power, Display/Touch Screen', 66.25, '2024-11-29 06:18:16', 'apaaja@gmail.com'),
(99, 6, 'MK04, CK03, CK04, CK05', 'Mati Total, Connector Charge, Bluetooth', 58.50, '2024-11-29 06:20:55', 'theoganteng@gmail.com'),
(100, 6, 'MK04, CK03, CK04, CK05', 'Mati Total, Connector Charge, Bluetooth', 58.50, '2024-11-29 06:39:13', 'theoganteng@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `diagnose`
--

CREATE TABLE `diagnose` (
  `id` int(4) NOT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnose`
--

INSERT INTO `diagnose` (`id`, `diagnosis`, `percentage`) VALUES
(1, 'IC Power', 90.00),
(2, 'Display/Touch Screen', 85.00),
(3, 'Mati Total', 95.00),
(4, 'Connector Charge', 88.00),
(5, 'Bluetooth', 80.00),
(6, 'LCD Blank', 92.00),
(7, 'Bootloop', 89.00),
(8, 'Imei Hilang', 78.00),
(9, 'SD Card', 76.00),
(10, 'Baterai', 82.00),
(11, 'Kamera', 85.00),
(12, 'Speaker', 80.00),
(13, 'Wi-Fi', 75.00),
(14, 'Sensor Proximity', 82.00),
(15, 'GPS', 78.00),
(16, 'SIM Card', 85.00),
(17, 'Charger', 88.00),
(18, 'Sensor Sidik Jari', 80.00),
(19, 'Microphone', 83.00),
(20, 'Motor Getaran', 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `masalah_kerusakan`
--

CREATE TABLE `masalah_kerusakan` (
  `kode_masalah` varchar(4) NOT NULL,
  `masalah` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masalah_kerusakan`
--

INSERT INTO `masalah_kerusakan` (`kode_masalah`, `masalah`) VALUES
('MK01', 'Handphone hidup mati sendiri'),
('MK02', 'Tidak bisa menekan menu sesuai keinginan'),
('MK03', 'Handphone tidak bisa dihidupkan sama sekali'),
('MK04', 'Tidak bisa di-charge'),
('MK05', 'Mengirim dan menerima file tidak bisa'),
('MK06', 'LCD blank/hanya cahaya putih'),
('MK07', 'Handphone restart sendiri dan hanya sampai logo'),
('MK08', 'Tidak bisa mengirim SMS'),
('MK09', 'Data-data pada SD Card hilang tiba-tiba'),
('MK10', 'Baterai kembung karena terlalu lama dicas'),
('MK11', 'Kamera tidak dapat dibuka atau crash'),
('MK12', 'Tidak ada suara saat menelpon'),
('MK13', 'Wi-Fi tidak dapat diaktifkan'),
('MK14', 'Layar tidak mati saat menelpon'),
('MK15', 'GPS tidak dapat menemukan lokasi'),
('MK16', 'SIM Card tidak dapat dideteksi'),
('MK17', 'Charger apapun tidak bisa digunakan'),
('MK18', 'Ponsel tidak mendeteksi sidik jari yang benar'),
('MK19', 'Microphone tidak dapat mendeteksi input suara'),
('MK20', 'Microphone tidak dapat mendeteksi input suara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'mek@gmail.com', '$2y$10$83aN9b/cSDSPQUDdRAZSKePKqOA8IChBsTM4pdx.edypdGTVNz3BK', 'admin', '2024-11-14 14:27:12', '2024-11-14 17:17:00'),
(3, 'ken@gmail.com', '$2y$10$M/RvWC9GZBM10gQwSiLD2earzUL57/LS3e1RBodNEZS8KUs0O/ZnC', 'user', '2024-11-14 14:41:26', '2024-11-14 14:41:26'),
(4, 'ginting@gmail.com', '$2y$10$TCm4ARNUo8G5M/bZCsiJnOyT2TVqxa2eVtKkb7ZBNLYxsW8tG9EBq', 'user', '2024-11-14 15:39:06', '2024-11-14 15:39:06'),
(5, 'joe@gmail.com', '$2y$10$bUuNLp5h0BqNvSjtPNHQuuPjL6WPMFP/9seSrEDD.dScMHnqUUa92', 'user', '2024-11-14 18:02:04', '2024-11-14 18:02:04'),
(6, 'andrs.ginting@gmail.com', '$2y$10$HH7MKrC1m6t1phElrpmBEO7Aa5YutqCc3Mjk.28k5P1Y42JRSqkCm', 'admin', '2024-11-28 20:51:11', '2024-11-28 21:25:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ciri_kerusakan`
--
ALTER TABLE `ciri_kerusakan`
  ADD PRIMARY KEY (`kode_ciri`);

--
-- Indexes for table `detections`
--
ALTER TABLE `detections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnose`
--
ALTER TABLE `diagnose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masalah_kerusakan`
--
ALTER TABLE `masalah_kerusakan`
  ADD PRIMARY KEY (`kode_masalah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detections`
--
ALTER TABLE `detections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `diagnose`
--
ALTER TABLE `diagnose`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
