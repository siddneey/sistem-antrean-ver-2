-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: mpp
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.22.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `antrean`
--

DROP TABLE IF EXISTS `antrean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `antrean` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_antrean` date NOT NULL,
  `nomor_antrean` int unsigned NOT NULL,
  `jenis_antrean` enum('BIASA','PRIORITAS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_awal_id` int unsigned NOT NULL,
  `waktu_ambil` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_antrean_nomor` (`tanggal_antrean`,`instansi_awal_id`,`jenis_antrean`,`nomor_antrean`),
  KEY `idx_antrean_tanggal` (`tanggal_antrean`),
  KEY `idx_antrean_instansi_awal` (`instansi_awal_id`),
  KEY `idx_antrean_tanggal_instansi` (`tanggal_antrean`,`instansi_awal_id`),
  CONSTRAINT `fk_antrean_instansi_awal` FOREIGN KEY (`instansi_awal_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grup`
--

DROP TABLE IF EXISTS `grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grup` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kelompok_id` int unsigned NOT NULL,
  `nama_grup` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_grup_kelompok_nama` (`kelompok_id`,`nama_grup`),
  KEY `idx_grup_kelompok_id` (`kelompok_id`),
  CONSTRAINT `fk_grup_kelompok` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hari_libur`
--

DROP TABLE IF EXISTS `hari_libur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hari_libur` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_hari_libur_tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `instansi`
--

DROP TABLE IF EXISTS `instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instansi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `grup_id` int unsigned NOT NULL,
  `nama_instansi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_instansi_grup_id` (`grup_id`),
  CONSTRAINT `fk_instansi_grup` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kelompok`
--

DROP TABLE IF EXISTS `kelompok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelompok` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kelompok_nama` (`nama_kelompok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kuota_instansi`
--

DROP TABLE IF EXISTS `kuota_instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kuota_instansi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `instansi_id` int unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `kuota_biasa` int unsigned NOT NULL DEFAULT '50',
  `kuota_prioritas` int unsigned NOT NULL DEFAULT '5',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kuota_instansi_tanggal` (`instansi_id`,`tanggal`),
  KEY `idx_kuota_instansi_id` (`instansi_id`),
  CONSTRAINT `fk_kuota_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `layanan`
--

DROP TABLE IF EXISTS `layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `layanan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `instansi_id` int unsigned NOT NULL,
  `nama_layanan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_layanan_instansi_nama` (`instansi_id`,`nama_layanan`),
  KEY `idx_layanan_instansi_id` (`instansi_id`),
  CONSTRAINT `fk_layanan_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `riwayat_layanan`
--

DROP TABLE IF EXISTS `riwayat_layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_layanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `antrean_id` bigint unsigned NOT NULL,
  `instansi_id` int unsigned NOT NULL,
  `layanan_id` int unsigned DEFAULT NULL,
  `petugas_id` int unsigned DEFAULT NULL,
  `status_layanan` enum('MENUNGGU','DIPANGGIL','DILAYANI','SELESAI','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MENUNGGU',
  `waktu_masuk` datetime NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_riwayat_antrean` (`antrean_id`),
  KEY `idx_riwayat_instansi` (`instansi_id`),
  KEY `idx_riwayat_layanan` (`layanan_id`),
  KEY `idx_riwayat_petugas` (`petugas_id`),
  KEY `idx_riwayat_status` (`status_layanan`),
  CONSTRAINT `fk_riwayat_antrean` FOREIGN KEY (`antrean_id`) REFERENCES `antrean` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_riwayat_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_riwayat_layanan` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_riwayat_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `riwayat_panggilan`
--

DROP TABLE IF EXISTS `riwayat_panggilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_panggilan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `riwayat_layanan_id` bigint unsigned NOT NULL,
  `petugas_id` int unsigned NOT NULL,
  `aksi` enum('PANGGIL','SKIP') COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` datetime NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_panggilan_riwayat` (`riwayat_layanan_id`),
  KEY `idx_panggilan_petugas` (`petugas_id`),
  KEY `idx_panggilan_aksi` (`aksi`),
  CONSTRAINT `fk_panggilan_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_panggilan_riwayat` FOREIGN KEY (`riwayat_layanan_id`) REFERENCES `riwayat_layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_roles_nama_role` (`nama_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sequence_antrean`
--

DROP TABLE IF EXISTS `sequence_antrean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sequence_antrean` (
  `tanggal` date NOT NULL,
  `nomor_terakhir` int unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `instansi_id` int unsigned DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_username` (`username`),
  KEY `idx_users_role_id` (`role_id`),
  KEY `idx_users_instansi_id` (`instansi_id`),
  CONSTRAINT `fk_users_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-12 14:55:51
