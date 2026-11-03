-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: mpp_dev
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
-- Current Database: `mpp_dev`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mpp_dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `mpp_dev`;

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
  UNIQUE KEY `uq_antrean_tanggal_nomor` (`tanggal_antrean`,`nomor_antrean`),
  KEY `antrean_instansi_awal_id_foreign` (`instansi_awal_id`),
  CONSTRAINT `antrean_instansi_awal_id_foreign` FOREIGN KEY (`instansi_awal_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antrean`
--

LOCK TABLES `antrean` WRITE;
/*!40000 ALTER TABLE `antrean` DISABLE KEYS */;
INSERT INTO `antrean` VALUES (1,'2026-10-15',1,'BIASA',1,'2026-10-15 17:02:28','2026-10-15 17:02:28','2026-10-15 17:02:28'),(2,'2026-10-15',2,'BIASA',1,'2026-10-15 17:03:52','2026-10-15 17:03:52','2026-10-15 17:03:52'),(3,'2026-10-15',3,'PRIORITAS',5,'2026-10-15 17:04:47','2026-10-15 17:04:47','2026-10-15 17:04:47'),(4,'2026-10-20',1,'PRIORITAS',2,'2026-10-19 13:52:24','2026-10-19 13:52:24','2026-10-19 13:52:24'),(5,'2026-10-20',2,'BIASA',2,'2026-10-19 13:59:41','2026-10-19 13:59:41','2026-10-19 13:59:41'),(6,'2026-10-20',3,'PRIORITAS',5,'2026-10-19 14:43:11','2026-10-19 14:43:11','2026-10-19 14:43:11'),(7,'2026-10-19',1,'BIASA',5,'2026-10-19 14:51:15','2026-10-19 14:51:15','2026-10-19 14:51:15'),(8,'2026-10-19',2,'PRIORITAS',5,'2026-10-19 14:51:20','2026-10-19 14:51:20','2026-10-19 14:51:20'),(9,'2026-10-19',3,'PRIORITAS',5,'2026-10-19 15:47:56','2026-10-19 15:47:56','2026-10-19 15:47:56'),(10,'2026-10-19',4,'PRIORITAS',5,'2026-10-19 15:48:01','2026-10-19 15:48:01','2026-10-19 15:48:01'),(11,'2026-10-19',5,'PRIORITAS',5,'2026-10-19 15:48:07','2026-10-19 15:48:07','2026-10-19 15:48:07'),(12,'2026-10-19',6,'BIASA',5,'2026-10-19 15:51:52','2026-10-19 15:51:52','2026-10-19 15:51:52'),(13,'2026-10-20',4,'BIASA',26,'2026-10-20 09:39:35','2026-10-20 09:39:35','2026-10-20 09:39:35'),(14,'2026-10-20',5,'PRIORITAS',5,'2026-10-20 09:39:45','2026-10-20 09:39:45','2026-10-20 09:39:45'),(15,'2026-10-22',1,'PRIORITAS',5,'2026-10-20 10:18:16','2026-10-20 10:18:16','2026-10-20 10:18:16'),(16,'2026-10-20',6,'BIASA',6,'2026-10-20 10:28:48','2026-10-20 10:28:48','2026-10-20 10:28:48'),(17,'2026-10-20',7,'PRIORITAS',6,'2026-10-20 10:28:52','2026-10-20 10:28:52','2026-10-20 10:28:52'),(18,'2026-10-20',8,'BIASA',6,'2026-10-20 14:50:08','2026-10-20 14:50:08','2026-10-20 14:50:08');
/*!40000 ALTER TABLE `antrean` ENABLE KEYS */;
UNLOCK TABLES;

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
  KEY `grup_kelompok_id_foreign` (`kelompok_id`),
  CONSTRAINT `grup_kelompok_id_foreign` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grup`
--

LOCK TABLES `grup` WRITE;
/*!40000 ALTER TABLE `grup` DISABLE KEYS */;
INSERT INTO `grup` VALUES (1,1,'Grup 1','2026-10-15 15:57:59','2026-10-15 15:57:59'),(2,2,'Grup 2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(3,2,'Grup 3','2026-10-15 15:57:59','2026-10-15 15:57:59'),(4,2,'Grup 4','2026-10-15 15:57:59','2026-10-15 15:57:59'),(5,2,'Grup 5','2026-10-15 15:57:59','2026-10-15 15:57:59'),(6,1,'Grup 6','2026-10-15 15:57:59','2026-10-15 15:57:59'),(7,1,'Bank Banten','2026-10-15 15:57:59','2026-10-15 15:57:59'),(8,1,'Bank BJB','2026-10-15 15:57:59','2026-10-15 15:57:59');
/*!40000 ALTER TABLE `grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hari_libur`
--

DROP TABLE IF EXISTS `hari_libur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hari_libur` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` enum('Nasional','Khusus MPP') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hari_libur`
--

LOCK TABLES `hari_libur` WRITE;
/*!40000 ALTER TABLE `hari_libur` DISABLE KEYS */;
INSERT INTO `hari_libur` VALUES (1,'2026-10-18','hari hijau','Nasional','hari hijau nasional','2026-10-18 22:14:10','2026-10-18 22:14:10'),(2,'2026-10-21','hari hari','Khusus MPP','ya libur','2026-10-19 11:53:16','2026-10-19 11:53:16');
/*!40000 ALTER TABLE `hari_libur` ENABLE KEYS */;
UNLOCK TABLES;

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
  `audio_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instansi_grup_id_foreign` (`grup_id`),
  CONSTRAINT `instansi_grup_id_foreign` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansi`
--

LOCK TABLES `instansi` WRITE;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` VALUES (1,1,'SAMSAT',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(2,1,'BPJS KESEHATAN',NULL,'2026-10-15 15:57:59','2026-10-19 08:58:58','instansi_2_4e17ef1f0a7c6167.mp3'),(3,1,'DISNAKER',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(4,1,'ATR BPN',NULL,'2026-10-15 15:57:59','2026-10-18 19:36:16','instansi_4_a40b0f3282222bfc.mp3'),(5,2,'BAPENDA',NULL,'2026-10-15 15:57:59','2026-10-18 22:15:45','instansi_5_ace4ea6b229d470d.mp3'),(6,2,'BPKD',NULL,'2026-10-15 15:57:59','2026-10-19 08:59:51','instansi_6_bd22d519ff25a422.mp3'),(7,2,'BPJS TK',NULL,'2026-10-15 15:57:59','2026-10-19 08:59:40','instansi_7_5103eb2991e52909.mp3'),(8,2,'KEJARI',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(9,3,'DUKCAPIL',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(10,3,'DITJEN AHU',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(11,3,'PENGADILAN AGAMA',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(12,3,'PELAYANAN PBG',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(13,4,'DPUPR',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(14,4,'PERKIM',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(15,4,'DISHUB',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(16,4,'BNN',NULL,'2026-10-15 15:57:59','2026-10-19 08:58:37','instansi_16_d71e7511ad68b497.mp3'),(17,5,'POLRES',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(18,5,'PT. POS INDONESIA',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(19,5,'TASPEN',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(20,5,'PLN',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(21,5,'PDAM',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(22,6,'BPOM',NULL,'2026-10-15 15:57:59','2026-10-19 09:00:00','instansi_22_080ece3288a61437.mp3'),(23,6,'DINAS LINGKUNGAN HIDUP',NULL,'2026-10-15 15:57:59','2026-10-19 09:00:22','instansi_23_ceaa22693c412eb9.mp3'),(24,6,'PTSP 1',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(25,6,'PTSP 2',NULL,'2026-10-15 15:57:59','2026-10-15 15:57:59',NULL),(26,7,'BANK BANTEN',NULL,'2026-10-15 15:57:59','2026-10-18 19:36:43','instansi_26_cd43f11816ed1283.mp3'),(27,8,'BANK BJB',NULL,'2026-10-15 15:57:59','2026-10-18 19:37:00','instansi_27_8d68e64499c517db.mp3'),(28,8,'Baznas',NULL,'2026-10-15 15:57:59','2026-10-19 08:58:25','instansi_28_9b1f407be021cfa5.mp3');
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_akses`
--

DROP TABLE IF EXISTS `ip_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ip_akses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_akses`
--

LOCK TABLES `ip_akses` WRITE;
/*!40000 ALTER TABLE `ip_akses` DISABLE KEYS */;
INSERT INTO `ip_akses` VALUES (1,'192.168.1.7','2026-10-18 21:58:12');
/*!40000 ALTER TABLE `ip_akses` ENABLE KEYS */;
UNLOCK TABLES;

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
  `suara` tinyint unsigned NOT NULL DEFAULT '1' COMMENT 'Jalur suara/display: 1 atau 2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_kelompok` (`nama_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelompok`
--

LOCK TABLES `kelompok` WRITE;
/*!40000 ALTER TABLE `kelompok` DISABLE KEYS */;
INSERT INTO `kelompok` VALUES (1,'Kelompok 1','2026-10-15 15:57:59','2026-10-15 15:57:59',1),(2,'Kelompok 2','2026-10-15 15:57:59','2026-10-15 15:57:59',2);
/*!40000 ALTER TABLE `kelompok` ENABLE KEYS */;
UNLOCK TABLES;

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
  `kuota_prioritas` int unsigned NOT NULL DEFAULT '30',
  `kuota_layanan` int unsigned DEFAULT '50',
  `kuota_booking` int unsigned DEFAULT '30',
  `status_loket` enum('BUKA','TUTUP') COLLATE utf8mb4_unicode_ci DEFAULT 'BUKA',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kuota_instansi_tanggal` (`instansi_id`,`tanggal`),
  CONSTRAINT `kuota_instansi_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuota_instansi`
--

LOCK TABLES `kuota_instansi` WRITE;
/*!40000 ALTER TABLE `kuota_instansi` DISABLE KEYS */;
INSERT INTO `kuota_instansi` VALUES (1,5,'2026-10-19',50,30,1,1,'BUKA','2026-10-19 11:13:31','2026-10-19 15:47:44'),(4,5,'2026-10-20',50,30,1,1,'BUKA','2026-10-20 09:47:09','2026-10-20 10:17:50');
/*!40000 ALTER TABLE `kuota_instansi` ENABLE KEYS */;
UNLOCK TABLES;

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
  CONSTRAINT `layanan_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layanan`
--

LOCK TABLES `layanan` WRITE;
/*!40000 ALTER TABLE `layanan` DISABLE KEYS */;
INSERT INTO `layanan` VALUES (1,1,'Perpanjangan STNK','2026-10-15 15:57:59','2026-10-15 15:57:59'),(2,2,'Layanan BPJS Kesehatan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(3,3,'Pembuatan Kartu Kuning (AK-1)','2026-10-15 15:57:59','2026-10-15 15:57:59'),(4,3,'Informasi dan Konsultasi Lowongan Pekerjaan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(5,3,'Informasi dan Konsultasi Perekrutan Karyawan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(6,3,'Permohonan Tanda Daftar BKK','2026-10-15 15:57:59','2026-10-15 15:57:59'),(7,3,'Pengajuan Rekom ID CPMI','2026-10-15 15:57:59','2026-10-15 15:57:59'),(8,3,'Pendaftaran Pelatihan Kewirausahaan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(9,3,'Pendaftaran Pelatihan BLK','2026-10-15 15:57:59','2026-10-15 15:57:59'),(10,4,'Layanan Peningkatan Hak','2026-10-15 15:57:59','2026-10-15 15:57:59'),(11,4,'Roya BPN KKPR','2026-10-15 15:57:59','2026-10-15 15:57:59'),(12,4,'Izin Berusaha BPN','2026-10-15 15:57:59','2026-10-15 15:57:59'),(13,22,'Layanan BPOM','2026-10-15 15:57:59','2026-10-15 15:57:59'),(14,23,'Penilaian AMDAL','2026-10-15 15:57:59','2026-10-15 15:57:59'),(15,23,'Penilaian UKL UPL','2026-10-15 15:57:59','2026-10-15 15:57:59'),(16,24,'Layanan PTSP 1','2026-10-15 15:57:59','2026-10-15 15:57:59'),(17,25,'Layanan PTSP 2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(18,26,'Layanan Bank Banten','2026-10-15 15:57:59','2026-10-15 15:57:59'),(19,27,'Layanan Bank BJB','2026-10-15 15:57:59','2026-10-15 15:57:59'),(20,28,'Testing Baznas','2026-10-15 15:57:59','2026-10-15 15:57:59'),(21,28,'Dua','2026-10-15 15:57:59','2026-10-15 15:57:59'),(22,28,'Tiga','2026-10-15 15:57:59','2026-10-15 15:57:59'),(23,5,'Pendaftaran SPPT PBB-P2 Objek Pajak Baru','2026-10-15 15:57:59','2026-10-15 15:57:59'),(24,5,'Permohonan SPPT-PBB-P2 Mutasi Sebagian/Seluruhnya Objek dan Subjek','2026-10-15 15:57:59','2026-10-15 15:57:59'),(25,5,'Permohonan Surat Keterangan NJOP','2026-10-15 15:57:59','2026-10-15 15:57:59'),(26,5,'Permohonan Salinan SPPT PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(27,5,'Permohonan Keterangan Lunas PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(28,5,'Permohonan Penundaan Jatuh Tempo Pembayaran PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(29,5,'Permohonan Pengurangan PBB-2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(30,5,'Permohonan Keberatan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(31,5,'Permohonan Pengembalian','2026-10-15 15:57:59','2026-10-15 15:57:59'),(32,5,'Permohonan Pembatalan SPPT PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(33,5,'Permohonan Pembetulan SPPT SPPT PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(34,5,'Permohonan Pengurangan Sanksi Administrasi SPPT PBB-P2','2026-10-15 15:57:59','2026-10-15 15:57:59'),(35,5,'Permohonan Pembayaran Angsuran Pajak','2026-10-15 15:57:59','2026-10-15 15:57:59'),(36,5,'Permohonan Kompensasi','2026-10-15 15:57:59','2026-10-15 15:57:59'),(37,5,'Permohonan Aktivasi NOPD','2026-10-15 15:57:59','2026-10-15 15:57:59'),(38,5,'Pelayanan Permohonan penelitian/Validasi SSPD BPHTB','2026-10-15 15:57:59','2026-10-15 15:57:59'),(39,5,'Pelayanan Permohonan Pengurangan BPHTB','2026-10-15 15:57:59','2026-10-15 15:57:59'),(40,5,'Pelayanan Permohonan Resitusi/Pengembalian Pembayaran BPHTB','2026-10-15 15:57:59','2026-10-15 15:57:59'),(41,6,'Informasi dan Konsultasi Pajak Reklame','2026-10-15 15:57:59','2026-10-15 15:57:59'),(42,6,'Informasi dan Konsultasi Pajak Air Tanah','2026-10-15 15:57:59','2026-10-15 15:57:59'),(43,6,'Informasi dan Konsultasi Pajak Barang dan Jasa Tertentu (PBJT) – Restoran','2026-10-15 15:57:59','2026-10-15 15:57:59'),(44,6,'Informasi dan Konsultasi Pajak Penerangan jalan umum','2026-10-15 15:57:59','2026-10-15 15:57:59'),(45,6,'Informasi dan Konsultasi Pajak Hotel','2026-10-15 15:57:59','2026-10-15 15:57:59'),(46,6,'Informasi dan Konsultasi Pajak Parkir','2026-10-15 15:57:59','2026-10-15 15:57:59'),(47,6,'Informasi dan Konsultasi Pajak Hiburan (reflexiologi,karaoke,mandi uap, spa, permainan ketangkasan, permainan anak2,dll)','2026-10-15 15:57:59','2026-10-15 15:57:59'),(48,7,'Layanan BPJS Tenaga Kerja','2026-10-15 15:57:59','2026-10-15 15:57:59'),(49,8,'E-Tilang & Konsultasi Hukum','2026-10-15 15:57:59','2026-10-15 15:57:59'),(50,9,'Akta Kelahiran','2026-10-15 15:57:59','2026-10-15 15:57:59'),(51,9,'Akta Kematian','2026-10-15 15:57:59','2026-10-15 15:57:59'),(52,9,'Kartu Keluarga','2026-10-15 15:57:59','2026-10-15 15:57:59'),(53,9,'Pindah/Datang','2026-10-15 15:57:59','2026-10-15 15:57:59'),(54,9,'Cetak KTP','2026-10-15 15:57:59','2026-10-15 15:57:59'),(55,9,'Perekaman E-KTP','2026-10-15 15:57:59','2026-10-15 15:57:59'),(56,9,'Kartu Identitas Anak (KIA)','2026-10-15 15:57:59','2026-10-15 15:57:59'),(57,10,'Informasi AHU','2026-10-15 15:57:59','2026-10-15 15:57:59'),(58,10,'Konsultasi AHU','2026-10-15 15:57:59','2026-10-15 15:57:59'),(59,11,'Layanan Informasi P. Agama','2026-10-15 15:57:59','2026-10-15 15:57:59'),(60,11,'Layanan Pengaduan P. Agama','2026-10-15 15:57:59','2026-10-15 15:57:59'),(61,11,'Pendaftaran E-Court P. Agama','2026-10-15 15:57:59','2026-10-15 15:57:59'),(62,11,'Pengambilan Produk Pengadilan P. Agama','2026-10-15 15:57:59','2026-10-15 15:57:59'),(63,12,'Layanan PBG','2026-10-15 15:57:59','2026-10-15 15:57:59'),(64,13,'Informasi Umum Tata Ruang','2026-10-15 15:57:59','2026-10-15 15:57:59'),(65,13,'Informasi Pengesahan Rencana Tapak','2026-10-15 15:57:59','2026-10-15 15:57:59'),(66,13,'Informasi KKPR Non-berusaha','2026-10-15 15:57:59','2026-10-15 15:57:59'),(67,13,'Informasi KKPR Berusaha OSS','2026-10-15 15:57:59','2026-10-15 15:57:59'),(68,13,'Informasi Surat Keterangan Peruntukan Lahan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(69,13,'Informasi Surat Rekomendasi Teknis Peil Banjir','2026-10-15 15:57:59','2026-10-15 15:57:59'),(70,13,'Informasi Surat Rekomendasi Teknis Utilitas','2026-10-15 15:57:59','2026-10-15 15:57:59'),(71,13,'Informasi Surat Rekomendasi Penurunan Trotoar / Pembongkaran Trotoar','2026-10-15 15:57:59','2026-10-15 15:57:59'),(72,13,'Informasi Surat Rekomendasi Pembangunan Jembatan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(73,13,'Infomasi terkait Pemeliharaan Jalan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(74,13,'Informasi terkait Pemeliharaan Drainase','2026-10-15 15:57:59','2026-10-15 15:57:59'),(75,13,'Informasi pengujian kelayakan jalan','2026-10-15 15:57:59','2026-10-15 15:57:59'),(76,14,'Pelayanan Informasi PBG dan SLF','2026-10-15 15:57:59','2026-10-15 15:57:59'),(77,14,'Pelayanan Informasi Air Minum Air Limbah','2026-10-15 15:57:59','2026-10-15 15:57:59'),(78,15,'Layanan DISHUB','2026-10-15 15:57:59','2026-10-15 15:57:59'),(79,16,'Pelayanan BNN','2026-10-15 15:57:59','2026-10-15 15:57:59'),(80,17,'Perpanjangan SIM','2026-10-15 15:57:59','2026-10-15 15:57:59'),(81,17,'Pembuatan SIM Baru','2026-10-15 15:57:59','2026-10-15 15:57:59'),(82,17,'Layanan SKCK','2026-10-15 15:57:59','2026-10-15 15:57:59'),(83,18,'POS','2026-10-15 15:57:59','2026-10-15 15:57:59'),(84,19,'Pelayanan TASPEN','2026-10-15 15:57:59','2026-10-15 15:57:59'),(85,20,'Layanan Pasang Baru dan Tambah Daya','2026-10-15 15:57:59','2026-10-15 15:57:59'),(86,21,'Pendaftaran PDAM','2026-10-15 15:57:59','2026-10-15 15:57:59');
/*!40000 ALTER TABLE `layanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_user_login`
--

DROP TABLE IF EXISTS `log_user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_user_login` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_id` int unsigned DEFAULT NULL,
  `aktivitas` enum('Login Berhasil','Login Gagal','Logout') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perangkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_instansi_id` (`instansi_id`),
  KEY `idx_aktivitas` (`aktivitas`),
  KEY `idx_waktu` (`waktu`),
  KEY `idx_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_user_login`
--

LOCK TABLES `log_user_login` WRITE;
/*!40000 ALTER TABLE `log_user_login` DISABLE KEYS */;
INSERT INTO `log_user_login` VALUES (1,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-18 22:23:35'),(2,1,'admin',NULL,'Login Gagal','127.0.0.1','Edge / Windows 10','2026-10-18 22:23:41'),(3,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-18 22:32:01'),(4,1,'admin',NULL,'Login Gagal','127.0.0.1','Edge / Windows 10','2026-10-19 08:14:01'),(5,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 08:14:09'),(6,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 09:29:02'),(7,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 09:29:15'),(8,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 11:11:31'),(9,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 11:11:40'),(10,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 11:12:54'),(11,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 11:13:06'),(12,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 11:13:38'),(13,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 11:13:45'),(14,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 13:29:21'),(15,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 13:41:55'),(16,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 13:52:38'),(17,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 13:52:49'),(18,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 08:02:06'),(19,1,'admin',NULL,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-10-20 08:43:57'),(20,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-10-20 09:52:00'),(21,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 10:17:43'),(22,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 10:26:50'),(23,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-20 10:28:11'),(24,3,'petugas_bpkd',6,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 10:28:22'),(25,3,'petugas_bpkd',6,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-26 09:17:31');
/*!40000 ALTER TABLE `log_user_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-09-21-041446','App\\Database\\Migrations\\CreateRolesTable','default','App',1792054665,1),(2,'2026-09-21-042108','App\\Database\\Migrations\\CreateKelompokTable','default','App',1792054665,1),(3,'2026-09-21-042225','App\\Database\\Migrations\\CreateGrupTable','default','App',1792054666,1),(4,'2026-09-21-042312','App\\Database\\Migrations\\CreateInstansiTable','default','App',1792054666,1),(5,'2026-09-21-042355','App\\Database\\Migrations\\CreateUsersTable','default','App',1792054666,1),(6,'2026-09-21-042425','App\\Database\\Migrations\\CreateLayananTable','default','App',1792054666,1),(7,'2026-09-21-042452','App\\Database\\Migrations\\CreateHariLiburTable','default','App',1792054666,1),(8,'2026-09-21-065404','App\\Database\\Migrations\\CreateSequenceAntreanTable','default','App',1792054666,1),(9,'2026-09-21-065451','App\\Database\\Migrations\\CreateAntreanTable','default','App',1792054666,1),(10,'2026-09-21-065509','App\\Database\\Migrations\\CreateRiwayatLayananTable','default','App',1792054666,1),(11,'2026-09-21-065521','App\\Database\\Migrations\\CreateRiwayatPanggilanTable','default','App',1792054666,1),(12,'2026-09-22-030912','App\\Database\\Migrations\\UpdateStatusLayananPending','default','App',1792054666,1),(13,'2026-10-08-085548','App\\Database\\Migrations\\CreateKuotaInstansiTable','default','App',1792054666,1),(14,'2026-10-13-030223','App\\Database\\Migrations\\AddStatusAndLastLoginToUsers','default','App',1792054666,1),(15,'2026-10-19-033813','App\\Database\\Migrations\\AddPengaturanLoketToKuotaInstansi','default','App',1792381127,2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

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
  `status_layanan` enum('MENUNGGU','DIPANGGIL','DILAYANI','PENDING','SELESAI') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MENUNGGU',
  `waktu_masuk` datetime NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_layanan_antrean_id_foreign` (`antrean_id`),
  KEY `instansi_id` (`instansi_id`),
  KEY `layanan_id` (`layanan_id`),
  KEY `petugas_id` (`petugas_id`),
  KEY `status_layanan` (`status_layanan`),
  CONSTRAINT `riwayat_layanan_antrean_id_foreign` FOREIGN KEY (`antrean_id`) REFERENCES `antrean` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `riwayat_layanan_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `riwayat_layanan_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE RESTRICT ON UPDATE SET NULL,
  CONSTRAINT `riwayat_layanan_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_layanan`
--

LOCK TABLES `riwayat_layanan` WRITE;
/*!40000 ALTER TABLE `riwayat_layanan` DISABLE KEYS */;
INSERT INTO `riwayat_layanan` VALUES (1,1,1,NULL,NULL,'MENUNGGU','2026-10-15 17:02:28',NULL,NULL,'Antrean hari ini','2026-10-15 17:02:28','2026-10-15 17:02:28'),(2,2,1,NULL,NULL,'MENUNGGU','2026-10-15 17:03:52',NULL,NULL,'Antrean hari ini','2026-10-15 17:03:52','2026-10-15 17:03:52'),(3,3,5,NULL,2,'PENDING','2026-10-15 17:04:47','2026-10-15 18:53:13',NULL,'Ditunda sementara','2026-10-15 17:04:47','2026-10-15 19:18:12'),(4,4,2,NULL,NULL,'MENUNGGU','2026-10-19 13:52:24',NULL,NULL,'Booking antrean hari selanjutnya','2026-10-19 13:52:24','2026-10-19 13:52:24'),(5,5,2,NULL,NULL,'MENUNGGU','2026-10-19 13:59:41',NULL,NULL,'Booking antrean hari selanjutnya','2026-10-19 13:59:41','2026-10-19 13:59:41'),(6,6,5,36,2,'SELESAI','2026-10-19 14:43:11','2026-10-20 08:02:41','2026-10-20 08:42:06','','2026-10-19 14:43:11','2026-10-20 08:42:06'),(7,7,5,NULL,2,'DILAYANI','2026-10-19 14:51:15','2026-10-19 15:18:05',NULL,'Antrean hari ini','2026-10-19 14:51:15','2026-10-19 15:18:05'),(8,8,5,NULL,2,'PENDING','2026-10-19 14:51:20','2026-10-19 15:17:11',NULL,'','2026-10-19 14:51:20','2026-10-19 15:18:03'),(9,9,5,NULL,NULL,'MENUNGGU','2026-10-19 15:47:56',NULL,NULL,'Antrean hari ini','2026-10-19 15:47:56','2026-10-19 15:47:56'),(10,10,5,NULL,NULL,'MENUNGGU','2026-10-19 15:48:01',NULL,NULL,'Antrean hari ini','2026-10-19 15:48:01','2026-10-19 15:48:01'),(11,11,5,NULL,NULL,'MENUNGGU','2026-10-19 15:48:07',NULL,NULL,'Antrean hari ini','2026-10-19 15:48:07','2026-10-19 15:48:07'),(12,12,5,NULL,NULL,'MENUNGGU','2026-10-19 15:51:52',NULL,NULL,'Antrean hari ini','2026-10-19 15:51:52','2026-10-19 15:51:52'),(13,13,26,NULL,NULL,'MENUNGGU','2026-10-20 09:39:35',NULL,NULL,'Antrean hari ini','2026-10-20 09:39:35','2026-10-20 09:39:35'),(14,14,5,38,2,'SELESAI','2026-10-20 09:39:45','2026-10-20 10:25:59','2026-10-20 10:26:34','ooo','2026-10-20 09:39:45','2026-10-20 10:26:34'),(15,15,5,NULL,NULL,'MENUNGGU','2026-10-20 10:18:16',NULL,NULL,'Booking antrean hari selanjutnya','2026-10-20 10:18:16','2026-10-20 10:18:16'),(16,14,2,NULL,NULL,'MENUNGGU','2026-10-20 10:26:34',NULL,NULL,NULL,'2026-10-20 10:26:34','2026-10-20 10:26:34'),(17,16,6,NULL,3,'DILAYANI','2026-10-20 10:28:48','2026-10-20 14:42:38',NULL,'Antrean hari ini','2026-10-20 10:28:48','2026-10-20 14:42:38'),(18,17,6,42,3,'SELESAI','2026-10-20 10:28:52','2026-10-20 10:29:00','2026-10-20 10:29:19','','2026-10-20 10:28:52','2026-10-20 10:29:19'),(19,18,6,NULL,NULL,'MENUNGGU','2026-10-20 14:50:08',NULL,NULL,'Antrean hari ini','2026-10-20 14:50:08','2026-10-20 14:50:08');
/*!40000 ALTER TABLE `riwayat_layanan` ENABLE KEYS */;
UNLOCK TABLES;

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
  KEY `riwayat_panggilan_riwayat_layanan_id_foreign` (`riwayat_layanan_id`),
  KEY `petugas_id` (`petugas_id`),
  KEY `aksi` (`aksi`),
  CONSTRAINT `riwayat_panggilan_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `riwayat_panggilan_riwayat_layanan_id_foreign` FOREIGN KEY (`riwayat_layanan_id`) REFERENCES `riwayat_layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_panggilan`
--

LOCK TABLES `riwayat_panggilan` WRITE;
/*!40000 ALTER TABLE `riwayat_panggilan` DISABLE KEYS */;
INSERT INTO `riwayat_panggilan` VALUES (1,3,2,'PANGGIL','2026-10-15 18:53:13',NULL,'2026-10-15 18:53:13','2026-10-15 18:53:13'),(2,8,2,'PANGGIL','2026-10-19 15:17:11','Panggilan pertama','2026-10-19 15:17:11','2026-10-19 15:17:11'),(3,8,2,'PANGGIL','2026-10-19 15:17:24','Panggilan ulang','2026-10-19 15:17:24','2026-10-19 15:17:24'),(4,8,2,'PANGGIL','2026-10-19 15:17:47','Panggilan ulang','2026-10-19 15:17:47','2026-10-19 15:17:47'),(5,7,2,'PANGGIL','2026-10-19 15:18:05','Panggilan pertama','2026-10-19 15:18:05','2026-10-19 15:18:05'),(6,7,2,'PANGGIL','2026-10-19 15:19:35','Panggilan ulang','2026-10-19 15:19:35','2026-10-19 15:19:35'),(7,7,2,'PANGGIL','2026-10-19 15:21:44','Panggilan ulang','2026-10-19 15:21:44','2026-10-19 15:21:44'),(8,7,2,'PANGGIL','2026-10-19 15:44:01','Panggilan ulang','2026-10-19 15:44:01','2026-10-19 15:44:01'),(9,7,2,'PANGGIL','2026-10-19 15:44:02','Panggilan ulang','2026-10-19 15:44:02','2026-10-19 15:44:02'),(10,7,2,'PANGGIL','2026-10-19 15:44:02','Panggilan ulang','2026-10-19 15:44:02','2026-10-19 15:44:02'),(11,7,2,'PANGGIL','2026-10-19 15:44:03','Panggilan ulang','2026-10-19 15:44:03','2026-10-19 15:44:03'),(12,7,2,'PANGGIL','2026-10-19 15:44:03','Panggilan ulang','2026-10-19 15:44:03','2026-10-19 15:44:03'),(13,7,2,'PANGGIL','2026-10-19 15:44:03','Panggilan ulang','2026-10-19 15:44:03','2026-10-19 15:44:03'),(14,7,2,'PANGGIL','2026-10-19 15:44:03','Panggilan ulang','2026-10-19 15:44:03','2026-10-19 15:44:03'),(15,7,2,'PANGGIL','2026-10-19 15:44:05','Panggilan ulang','2026-10-19 15:44:05','2026-10-19 15:44:05'),(16,7,2,'PANGGIL','2026-10-19 15:44:25','Panggilan ulang','2026-10-19 15:44:25','2026-10-19 15:44:25'),(17,7,2,'PANGGIL','2026-10-19 15:44:25','Panggilan ulang','2026-10-19 15:44:25','2026-10-19 15:44:25'),(18,7,2,'PANGGIL','2026-10-19 15:44:25','Panggilan ulang','2026-10-19 15:44:25','2026-10-19 15:44:25'),(19,7,2,'PANGGIL','2026-10-19 15:44:26','Panggilan ulang','2026-10-19 15:44:26','2026-10-19 15:44:26'),(20,7,2,'PANGGIL','2026-10-19 15:44:26','Panggilan ulang','2026-10-19 15:44:26','2026-10-19 15:44:26'),(21,7,2,'PANGGIL','2026-10-19 15:44:26','Panggilan ulang','2026-10-19 15:44:26','2026-10-19 15:44:26'),(22,7,2,'PANGGIL','2026-10-19 15:44:26','Panggilan ulang','2026-10-19 15:44:26','2026-10-19 15:44:26'),(23,7,2,'PANGGIL','2026-10-19 15:44:26','Panggilan ulang','2026-10-19 15:44:26','2026-10-19 15:44:26'),(24,7,2,'PANGGIL','2026-10-19 15:44:27','Panggilan ulang','2026-10-19 15:44:27','2026-10-19 15:44:27'),(25,7,2,'PANGGIL','2026-10-19 15:47:11','Panggilan ulang','2026-10-19 15:47:11','2026-10-19 15:47:11'),(26,7,2,'PANGGIL','2026-10-19 15:47:12','Panggilan ulang','2026-10-19 15:47:12','2026-10-19 15:47:12'),(27,7,2,'PANGGIL','2026-10-19 15:47:12','Panggilan ulang','2026-10-19 15:47:12','2026-10-19 15:47:12'),(28,7,2,'PANGGIL','2026-10-19 15:47:13','Panggilan ulang','2026-10-19 15:47:13','2026-10-19 15:47:13'),(29,7,2,'PANGGIL','2026-10-19 15:47:13','Panggilan ulang','2026-10-19 15:47:13','2026-10-19 15:47:13'),(30,7,2,'PANGGIL','2026-10-19 15:48:19','Panggilan ulang','2026-10-19 15:48:19','2026-10-19 15:48:19'),(31,7,2,'PANGGIL','2026-10-19 15:48:37','Panggilan ulang','2026-10-19 15:48:37','2026-10-19 15:48:37'),(32,7,2,'PANGGIL','2026-10-19 15:48:38','Panggilan ulang','2026-10-19 15:48:38','2026-10-19 15:48:38'),(33,7,2,'PANGGIL','2026-10-19 15:48:38','Panggilan ulang','2026-10-19 15:48:38','2026-10-19 15:48:38'),(34,7,2,'PANGGIL','2026-10-19 15:48:39','Panggilan ulang','2026-10-19 15:48:39','2026-10-19 15:48:39'),(35,7,2,'PANGGIL','2026-10-19 15:48:39','Panggilan ulang','2026-10-19 15:48:39','2026-10-19 15:48:39'),(36,7,2,'PANGGIL','2026-10-19 15:48:39','Panggilan ulang','2026-10-19 15:48:39','2026-10-19 15:48:39'),(37,7,2,'PANGGIL','2026-10-19 15:48:39','Panggilan ulang','2026-10-19 15:48:39','2026-10-19 15:48:39'),(38,7,2,'PANGGIL','2026-10-19 15:48:39','Panggilan ulang','2026-10-19 15:48:39','2026-10-19 15:48:39'),(39,7,2,'PANGGIL','2026-10-19 15:48:40','Panggilan ulang','2026-10-19 15:48:40','2026-10-19 15:48:40'),(40,7,2,'PANGGIL','2026-10-19 15:48:40','Panggilan ulang','2026-10-19 15:48:40','2026-10-19 15:48:40'),(41,7,2,'PANGGIL','2026-10-19 15:48:40','Panggilan ulang','2026-10-19 15:48:40','2026-10-19 15:48:40'),(42,7,2,'PANGGIL','2026-10-19 15:48:40','Panggilan ulang','2026-10-19 15:48:40','2026-10-19 15:48:40'),(43,7,2,'PANGGIL','2026-10-19 15:48:41','Panggilan ulang','2026-10-19 15:48:41','2026-10-19 15:48:41'),(44,7,2,'PANGGIL','2026-10-19 15:48:41','Panggilan ulang','2026-10-19 15:48:41','2026-10-19 15:48:41'),(45,7,2,'PANGGIL','2026-10-19 15:48:41','Panggilan ulang','2026-10-19 15:48:41','2026-10-19 15:48:41'),(46,7,2,'PANGGIL','2026-10-19 15:56:18','Panggilan ulang','2026-10-19 15:56:18','2026-10-19 15:56:18'),(47,7,2,'PANGGIL','2026-10-19 15:56:19','Panggilan ulang','2026-10-19 15:56:19','2026-10-19 15:56:19'),(48,7,2,'PANGGIL','2026-10-19 15:56:19','Panggilan ulang','2026-10-19 15:56:19','2026-10-19 15:56:19'),(49,7,2,'PANGGIL','2026-10-19 15:56:19','Panggilan ulang','2026-10-19 15:56:19','2026-10-19 15:56:19'),(50,6,2,'PANGGIL','2026-10-20 08:02:41','Panggilan pertama','2026-10-20 08:02:41','2026-10-20 08:02:41'),(51,6,2,'PANGGIL','2026-10-20 08:02:44','Panggilan ulang','2026-10-20 08:02:44','2026-10-20 08:02:44'),(52,6,2,'PANGGIL','2026-10-20 08:17:22','Panggilan ulang','2026-10-20 08:17:22','2026-10-20 08:17:22'),(53,6,2,'PANGGIL','2026-10-20 08:17:22','Panggilan ulang','2026-10-20 08:17:22','2026-10-20 08:17:22'),(54,6,2,'PANGGIL','2026-10-20 08:17:23','Panggilan ulang','2026-10-20 08:17:23','2026-10-20 08:17:23'),(55,6,2,'PANGGIL','2026-10-20 08:17:23','Panggilan ulang','2026-10-20 08:17:23','2026-10-20 08:17:23'),(56,6,2,'PANGGIL','2026-10-20 08:17:23','Panggilan ulang','2026-10-20 08:17:23','2026-10-20 08:17:23'),(57,6,2,'PANGGIL','2026-10-20 08:17:24','Panggilan ulang','2026-10-20 08:17:24','2026-10-20 08:17:24'),(58,6,2,'PANGGIL','2026-10-20 08:17:59','Panggilan ulang','2026-10-20 08:17:59','2026-10-20 08:17:59'),(59,6,2,'PANGGIL','2026-10-20 08:19:50','Panggilan ulang','2026-10-20 08:19:50','2026-10-20 08:19:50'),(60,6,2,'PANGGIL','2026-10-20 08:20:05','Panggilan ulang','2026-10-20 08:20:05','2026-10-20 08:20:05'),(61,6,2,'PANGGIL','2026-10-20 08:20:06','Panggilan ulang','2026-10-20 08:20:06','2026-10-20 08:20:06'),(62,6,2,'PANGGIL','2026-10-20 08:23:51','Panggilan ulang','2026-10-20 08:23:51','2026-10-20 08:23:51'),(63,6,2,'PANGGIL','2026-10-20 08:23:51','Panggilan ulang','2026-10-20 08:23:51','2026-10-20 08:23:51'),(64,6,2,'PANGGIL','2026-10-20 08:23:52','Panggilan ulang','2026-10-20 08:23:52','2026-10-20 08:23:52'),(65,6,2,'PANGGIL','2026-10-20 08:23:52','Panggilan ulang','2026-10-20 08:23:52','2026-10-20 08:23:52'),(66,6,2,'PANGGIL','2026-10-20 08:23:52','Panggilan ulang','2026-10-20 08:23:52','2026-10-20 08:23:52'),(67,6,2,'PANGGIL','2026-10-20 08:23:52','Panggilan ulang','2026-10-20 08:23:52','2026-10-20 08:23:52'),(68,6,2,'PANGGIL','2026-10-20 08:31:08','Panggilan ulang','2026-10-20 08:31:08','2026-10-20 08:31:08'),(69,6,2,'PANGGIL','2026-10-20 08:31:08','Panggilan ulang','2026-10-20 08:31:08','2026-10-20 08:31:08'),(70,6,2,'PANGGIL','2026-10-20 08:31:09','Panggilan ulang','2026-10-20 08:31:09','2026-10-20 08:31:09'),(71,6,2,'PANGGIL','2026-10-20 08:31:10','Panggilan ulang','2026-10-20 08:31:10','2026-10-20 08:31:10'),(72,14,2,'PANGGIL','2026-10-20 10:25:59','Panggilan pertama','2026-10-20 10:25:59','2026-10-20 10:25:59'),(73,18,3,'PANGGIL','2026-10-20 10:29:00','Panggilan pertama','2026-10-20 10:29:00','2026-10-20 10:29:00'),(74,18,3,'PANGGIL','2026-10-20 10:29:06','Panggilan ulang','2026-10-20 10:29:06','2026-10-20 10:29:06'),(75,18,3,'PANGGIL','2026-10-20 10:29:06','Panggilan ulang','2026-10-20 10:29:06','2026-10-20 10:29:06'),(76,18,3,'PANGGIL','2026-10-20 10:29:07','Panggilan ulang','2026-10-20 10:29:07','2026-10-20 10:29:07'),(77,18,3,'PANGGIL','2026-10-20 10:29:08','Panggilan ulang','2026-10-20 10:29:08','2026-10-20 10:29:08'),(78,18,3,'PANGGIL','2026-10-20 10:29:09','Panggilan ulang','2026-10-20 10:29:09','2026-10-20 10:29:09'),(79,18,3,'PANGGIL','2026-10-20 10:29:09','Panggilan ulang','2026-10-20 10:29:09','2026-10-20 10:29:09'),(80,17,3,'PANGGIL','2026-10-20 14:42:38','Panggilan pertama','2026-10-20 14:42:38','2026-10-20 14:42:38'),(81,17,3,'PANGGIL','2026-10-20 14:42:40','Panggilan ulang','2026-10-20 14:42:40','2026-10-20 14:42:40'),(82,17,3,'PANGGIL','2026-10-20 14:50:29','Panggilan ulang','2026-10-20 14:50:29','2026-10-20 14:50:29'),(83,17,3,'PANGGIL','2026-10-20 14:55:12','Panggilan ulang','2026-10-20 14:55:12','2026-10-20 14:55:12');
/*!40000 ALTER TABLE `riwayat_panggilan` ENABLE KEYS */;
UNLOCK TABLES;

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
  UNIQUE KEY `nama_role` (`nama_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2026-10-15 15:57:59','2026-10-15 15:57:59'),(2,'Petugas','2026-10-15 15:57:59','2026-10-15 15:57:59');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `sequence_antrean`
--

LOCK TABLES `sequence_antrean` WRITE;
/*!40000 ALTER TABLE `sequence_antrean` DISABLE KEYS */;
INSERT INTO `sequence_antrean` VALUES ('2026-10-15',3,'2026-10-15 17:04:47'),('2026-10-19',6,'2026-10-19 15:51:52'),('2026-10-20',8,'2026-10-20 14:50:08'),('2026-10-22',1,'2026-10-20 10:18:16');
/*!40000 ALTER TABLE `sequence_antrean` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_layar`
--

DROP TABLE IF EXISTS `status_layar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_layar` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kelompok_id` int unsigned NOT NULL,
  `login_terakhir` datetime DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelompok_id` (`kelompok_id`),
  CONSTRAINT `status_layar_ibfk_1` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_layar`
--

LOCK TABLES `status_layar` WRITE;
/*!40000 ALTER TABLE `status_layar` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_layar` ENABLE KEYS */;
UNLOCK TABLES;

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
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_instansi_id_foreign` (`instansi_id`),
  CONSTRAINT `users_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,NULL,'admin','$2y$10$W6TIznh5KQ1okB2JS9BlXeRhblGQGa1.Q6SfEu3std0oQjOf2mS3C','2026-10-15 15:57:59','2026-10-15 15:57:59','Aktif',NULL),(2,2,5,'petugas_bapenda','$2y$10$W6TIznh5KQ1okB2JS9BlXeRhblGQGa1.Q6SfEu3std0oQjOf2mS3C','2026-10-15 15:57:59','2026-10-15 15:57:59','Aktif',NULL),(3,2,6,'petugas_bpkd','$2y$10$W6TIznh5KQ1okB2JS9BlXeRhblGQGa1.Q6SfEu3std0oQjOf2mS3C','2026-10-15 15:57:59','2026-10-15 15:57:59','Aktif',NULL),(5,2,2,'petugas_bpjs','$2y$10$/oH6qRyBkIRvCq08IkrAOeqU3i/WvISdUe4X1ijWnlz9.krMqrYU.','2026-10-18 19:41:29','2026-10-18 19:41:29','Aktif',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-27  8:34:41
