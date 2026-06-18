-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2026 at 06:47 AM
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
-- Database: `db_simulasi_pbo_ti-1d_fathir-ihza-mahendra`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `asal_sekolah` varchar(150) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(100) DEFAULT NULL,
  `instansi_sponsor` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Jakarta', 85.50, 150000.00, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', 'SMAN 3 Bandung', 92.00, 150000.00, 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Rizky Ramadhan', 'SMAN 2 Surabaya', 78.45, 150000.00, 'Reguler', 'Manajemen', 'Kampus B', NULL, NULL, NULL, NULL),
(4, 'Putri Utami', 'SMAN 1 Yogyakarta', 88.10, 150000.00, 'Reguler', 'Akuntansi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Daffa Alvaro', 'SMAN 5 Semarang', 83.25, 150000.00, 'Reguler', 'Ilmu Komunikasi', 'Kampus B', NULL, NULL, NULL, NULL),
(6, 'Amanda Kayla', 'SMAN 8 Jakarta', 95.00, 150000.00, 'Reguler', 'Kedokteran', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Bintang Pratama', 'SMAN 1 Medan', 80.00, 150000.00, 'Reguler', 'Ilmu Hukum', 'Kampus B', NULL, NULL, NULL, NULL),
(8, 'Citra Kirana', 'SMAN 2 Makassar', 86.75, 150000.00, 'Reguler', 'Psikologi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(9, 'Dimas Setiawan', 'SMAN 4 Malang', 79.90, 150000.00, 'Reguler', 'Teknik Sipil', 'Kampus B', NULL, NULL, NULL, NULL),
(10, 'Elsa Frozenia', 'SMAN 1 Palembang', 91.30, 150000.00, 'Reguler', 'Hubungan Internasional', 'Kampus Utama', NULL, NULL, NULL, NULL),
(11, 'Fajar Siddiq', 'SMAN 3 Yogyakarta', 89.00, 100000.00, 'Prestasi', NULL, NULL, 'Olimpiade Fisika', 'Nasional', NULL, NULL),
(12, 'Gita Gutawa', 'SMAN 1 Surakarta', 87.50, 100000.00, 'Prestasi', NULL, NULL, 'Menyanyi Solo', 'Provinsi', NULL, NULL),
(13, 'Hendra Wijaya', 'SMAN 2 Bandung', 93.20, 100000.00, 'Prestasi', NULL, NULL, 'Badminton', 'Internasional', NULL, NULL),
(14, 'Indah Permata', 'SMAN 1 Denpasar', 85.00, 100000.00, 'Prestasi', NULL, NULL, 'Debat Bahasa Inggris', 'Nasional', NULL, NULL),
(15, 'Kevin Sanjaya', 'SMAN 78 Jakarta', 90.80, 100000.00, 'Prestasi', NULL, NULL, 'Tenis Meja', 'Provinsi', NULL, NULL),
(16, 'Lesti Kejora', 'SMAN 1 Cianjur', 84.15, 100000.00, 'Prestasi', NULL, NULL, 'Tari Tradisional', 'Kabupaten', NULL, NULL),
(17, 'Muhammad Ali', 'SMAN 3 Medan', 88.60, 100000.00, 'Prestasi', NULL, NULL, 'Pencak Silat', 'Nasional', NULL, NULL),
(18, 'Nadya Kayla', 'SMAN 1 Padang', 92.40, 100000.00, 'Prestasi', NULL, NULL, 'Karya Ilmiah Remaja', 'Internasional', NULL, NULL),
(19, 'Oki Setiana', 'SMAN 2 Balikpapan', 81.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-101/KD/2026', 'Kementerian Perhubungan'),
(20, 'Panji Petualang', 'SMAN 1 Bogor', 83.75, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-202/KEMEN/2026', 'Kementerian Dalam Negeri'),
(21, 'Queen Latifa', 'SMAN 5 Surabaya', 87.90, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-303/BKN/2026', 'Badan Kepegawaian Negara'),
(22, 'Ryan Hidayat', 'SMAN 1 Banjarmasin', 80.20, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-404/LAN/2026', 'Lembaga Administrasi Negara'),
(23, 'Sinta Dewi', 'SMAN 2 Denpasar', 86.40, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-505/KEMENKEU/2026', 'Kementerian Keuangan'),
(24, 'Tio Nugroho', 'SMAN 4 Jakarta', 85.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-606/BMKG/2026', 'BMKG'),
(25, 'Utami Lestari', 'SMAN 1 Manado', 89.10, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-707/BPS/2026', 'Badan Pusat Statistik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
