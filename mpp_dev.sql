-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: mpp_dev
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.24.04.4

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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mpp_dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

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
  UNIQUE KEY `tanggal_antrean_instansi_awal_id_jenis_antrean_nomor_antrean` (`tanggal_antrean`,`instansi_awal_id`,`jenis_antrean`,`nomor_antrean`),
  KEY `antrean_instansi_awal_id_foreign` (`instansi_awal_id`),
  CONSTRAINT `antrean_instansi_awal_id_foreign` FOREIGN KEY (`instansi_awal_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antrean`
--

LOCK TABLES `antrean` WRITE;
/*!40000 ALTER TABLE `antrean` DISABLE KEYS */;
INSERT INTO `antrean` VALUES (1,'2026-10-15',1,'BIASA',5,'2026-10-15 18:22:19','2026-10-15 18:22:19','2026-10-15 18:22:19'),(2,'2026-10-15',2,'PRIORITAS',5,'2026-10-15 22:47:46','2026-10-15 22:47:47','2026-10-15 22:47:47'),(3,'2026-10-15',3,'PRIORITAS',6,'2026-10-15 22:47:58','2026-10-15 22:47:58','2026-10-15 22:47:58'),(4,'2026-10-15',4,'BIASA',6,'2026-10-15 22:48:23','2026-10-15 22:48:23','2026-10-15 22:48:23'),(5,'2026-10-16',1,'BIASA',5,'2026-10-15 22:49:20','2026-10-15 22:49:20','2026-10-15 22:49:20'),(6,'2026-10-16',2,'PRIORITAS',5,'2026-10-15 22:49:40','2026-10-15 22:49:41','2026-10-15 22:49:41'),(7,'2026-11-03',1,'BIASA',5,'2026-11-03 15:27:19','2026-11-03 15:27:19','2026-11-03 15:27:19'),(8,'2026-11-03',2,'PRIORITAS',5,'2026-11-03 15:29:52','2026-11-03 15:29:52','2026-11-03 15:29:52'),(9,'2026-11-03',3,'BIASA',5,'2026-11-03 15:47:32','2026-11-03 15:47:32','2026-11-03 15:47:32'),(10,'2026-11-03',4,'PRIORITAS',5,'2026-11-03 15:47:42','2026-11-03 15:47:42','2026-11-03 15:47:42'),(11,'2026-11-03',5,'BIASA',5,'2026-11-03 15:47:49','2026-11-03 15:47:49','2026-11-03 15:47:49'),(12,'2026-11-03',6,'BIASA',5,'2026-11-03 15:47:58','2026-11-03 15:47:58','2026-11-03 15:47:58'),(13,'2026-11-03',7,'BIASA',5,'2026-11-03 15:48:04','2026-11-03 15:48:04','2026-11-03 15:48:04'),(14,'2026-11-03',8,'BIASA',5,'2026-11-03 15:48:11','2026-11-03 15:48:11','2026-11-03 15:48:11'),(15,'2026-11-03',9,'BIASA',5,'2026-11-03 15:48:17','2026-11-03 15:48:17','2026-11-03 15:48:17'),(16,'2026-11-03',10,'BIASA',5,'2026-11-03 15:48:24','2026-11-03 15:48:24','2026-11-03 15:48:24'),(17,'2026-11-03',11,'BIASA',5,'2026-11-03 15:48:30','2026-11-03 15:48:30','2026-11-03 15:48:30'),(18,'2026-11-03',12,'PRIORITAS',5,'2026-11-03 15:48:37','2026-11-03 15:48:37','2026-11-03 15:48:37'),(19,'2026-11-03',13,'BIASA',5,'2026-11-03 15:50:44','2026-11-03 15:50:44','2026-11-03 15:50:44'),(20,'2026-11-03',14,'PRIORITAS',5,'2026-11-03 15:50:57','2026-11-03 15:50:57','2026-11-03 15:50:57'),(21,'2026-11-09',1,'BIASA',26,'2026-11-09 08:30:43','2026-11-09 08:30:43','2026-11-09 08:30:43'),(22,'2026-11-09',2,'BIASA',27,'2026-11-09 08:31:27','2026-11-09 08:31:27','2026-11-09 08:31:27'),(23,'2026-11-09',3,'BIASA',5,'2026-11-09 08:46:38','2026-11-09 08:46:38','2026-11-09 08:46:38'),(24,'2026-11-10',1,'BIASA',6,'2026-11-10 09:09:25','2026-11-10 09:09:25','2026-11-10 09:09:25'),(25,'2026-11-10',2,'PRIORITAS',6,'2026-11-10 09:10:46','2026-11-10 09:10:46','2026-11-10 09:10:46'),(26,'2026-11-16',1,'BIASA',6,'2026-11-16 14:45:51','2026-11-16 14:45:51','2026-11-16 14:45:51'),(27,'2026-11-16',2,'PRIORITAS',6,'2026-11-16 14:46:42','2026-11-16 14:46:42','2026-11-16 14:46:42'),(28,'2026-11-16',3,'BIASA',5,'2026-11-16 14:50:37','2026-11-16 14:50:37','2026-11-16 14:50:37'),(29,'2026-11-16',4,'PRIORITAS',5,'2026-11-16 14:51:06','2026-11-16 14:51:06','2026-11-16 14:51:06'),(30,'2026-11-17',1,'BIASA',4,'2026-11-17 09:38:50','2026-11-17 09:38:50','2026-11-17 09:38:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grup`
--

LOCK TABLES `grup` WRITE;
/*!40000 ALTER TABLE `grup` DISABLE KEYS */;
INSERT INTO `grup` VALUES (1,1,'Grup 1','2026-10-13 11:01:23','2026-10-13 11:01:23'),(2,2,'Grup 2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(3,2,'Grup 3','2026-10-13 11:01:23','2026-10-13 11:01:23'),(4,2,'Grup 4','2026-10-13 11:01:23','2026-10-13 11:01:23'),(5,2,'Grup 5','2026-10-13 11:01:23','2026-10-13 11:01:23'),(6,1,'Grup 6','2026-10-13 11:01:23','2026-10-13 11:01:23'),(7,1,'Bank Banten','2026-10-13 11:01:23','2026-10-13 11:01:23'),(8,1,'Bank BJB','2026-10-13 11:01:23','2026-10-13 11:01:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hari_libur`
--

LOCK TABLES `hari_libur` WRITE;
/*!40000 ALTER TABLE `hari_libur` DISABLE KEYS */;
INSERT INTO `hari_libur` VALUES (2,'2026-11-10','Hari Pahlawan','Nasional',NULL,'2026-11-10 09:22:38','2026-11-10 09:22:38'),(3,'2026-11-11','Libur Testing','Khusus MPP',NULL,'2026-11-10 15:11:47','2026-11-10 15:11:47'),(4,'2026-11-12','Libur Testing','Khusus MPP',NULL,'2026-11-10 15:11:47','2026-11-10 15:11:47');
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
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `instansi_grup_id_foreign` (`grup_id`),
  CONSTRAINT `instansi_grup_id_foreign` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansi`
--

LOCK TABLES `instansi` WRITE;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` VALUES (1,1,'SAMSAT',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Samsat.mp3','Aktif'),(2,1,'BPJS KESEHATAN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','BPJS Kesehatan.mp3','Aktif'),(3,1,'DISNAKER',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Disnaker.mp3','Aktif'),(4,1,'ATR BPN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','ATR BPN.mp3','Aktif'),(5,2,'BAPENDA',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Bapenda.mp3','Aktif'),(6,2,'BPKD',NULL,'2026-10-13 11:01:23','2026-11-10 09:10:40','BPKD.mp3','Aktif'),(7,2,'BPJS TK',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','BPJS TK.mp3','Aktif'),(8,2,'KEJARI',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','KEJARI.mp3','Aktif'),(9,3,'DUKCAPIL',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','DUKCAPIL.mp3','Aktif'),(10,3,'DITJEN AHU',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Ditjen AHU.mp3','Aktif'),(11,3,'PENGADILAN AGAMA',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Pengadilan Agama.mp3','Aktif'),(12,3,'PELAYANAN PBG',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Pelayanan PBG.mp3','Aktif'),(13,4,'DPUPR',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','DPUPR.mp3','Aktif'),(14,4,'PERKIM',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PERKIM.mp3','Aktif'),(15,4,'DISHUB',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','DISHUB.mp3','Aktif'),(16,4,'BNN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','BNN.mp3','Aktif'),(17,5,'POLRES',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','POLRES.mp3','Aktif'),(18,5,'PT. POS INDONESIA',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PT. POS INDONESIA.mp3','Aktif'),(19,5,'TASPEN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','TASPEN.mp3','Aktif'),(20,5,'PLN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PLN.mp3','Aktif'),(21,5,'PDAM',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PDAM.mp3','Aktif'),(22,6,'BPOM',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','BPOM.mp3','Aktif'),(23,6,'DINAS LINGKUNGAN HIDUP',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','DINAS LINGKUNGAN HIDUP.mp3','Aktif'),(24,6,'PTSP 1',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PTSP 1.mp3','Aktif'),(25,6,'PTSP 2',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','PTSP 2.mp3','Aktif'),(26,7,'BANK BANTEN',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Bank Banten.mp3','Aktif'),(27,8,'BANK BJB',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Bank BJB.mp3','Aktif'),(28,8,'BAZNAS',NULL,'2026-10-13 11:01:23','2026-11-03 14:29:55','Baznas.mp3','Aktif');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_akses`
--

LOCK TABLES `ip_akses` WRITE;
/*!40000 ALTER TABLE `ip_akses` DISABLE KEYS */;
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
  `suara` tinyint unsigned DEFAULT '1' COMMENT 'Jalur suara/display: 1 atau 2',
  `status_panggilan` enum('IDLE','PLAYING') COLLATE utf8mb4_unicode_ci DEFAULT 'IDLE',
  `riwayat_panggilan_aktif_id` int unsigned DEFAULT NULL,
  `token_panggilan` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_kunci` datetime DEFAULT NULL,
  `display_heartbeat_at` datetime DEFAULT NULL,
  `display_audio_ready` tinyint unsigned DEFAULT '0',
  `display_session_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_kelompok` (`nama_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelompok`
--

LOCK TABLES `kelompok` WRITE;
/*!40000 ALTER TABLE `kelompok` DISABLE KEYS */;
INSERT INTO `kelompok` VALUES (1,'Kelompok 1','2026-10-13 11:01:23','2026-11-03 14:30:26',1,'IDLE',NULL,NULL,NULL,'2026-11-17 09:07:03',1,'1ad2531b60371be0283e6725cb96e64dd7c241078de1aca49aba9ff4b04674f1'),(2,'Kelompok 2','2026-10-13 11:01:23','2026-11-03 14:30:26',2,'PLAYING',7,'b5bdcf25eaa1d896f22e618a287289b5298903423a8bfc64cf76e4d42c32aa58','2026-11-03 15:52:06','2026-11-16 15:02:06',1,'8fd235a1c395e8452ad98358ba5d3f423b6d044bf7af03800bcc4694d09b30dc');
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
  `kuota_layanan` int unsigned DEFAULT '100',
  `kuota_booking` int unsigned DEFAULT '30',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kuota_instansi_tanggal` (`instansi_id`,`tanggal`),
  CONSTRAINT `kuota_instansi_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuota_instansi`
--

LOCK TABLES `kuota_instansi` WRITE;
/*!40000 ALTER TABLE `kuota_instansi` DISABLE KEYS */;
INSERT INTO `kuota_instansi` VALUES (1,5,'2026-11-09',50,30,50,30,'2026-11-09 15:20:07','2026-11-09 15:20:07'),(2,6,'2026-11-10',50,30,50,30,'2026-11-10 09:08:26','2026-11-10 09:10:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layanan`
--

LOCK TABLES `layanan` WRITE;
/*!40000 ALTER TABLE `layanan` DISABLE KEYS */;
INSERT INTO `layanan` VALUES (1,1,'Perpanjangan STNK','2026-10-13 11:01:23','2026-10-13 11:01:23'),(2,2,'Layanan BPJS Kesehatan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(3,3,'Pembuatan Kartu Kuning (AK-1)','2026-10-13 11:01:23','2026-10-13 11:01:23'),(4,3,'Informasi dan Konsultasi Lowongan Pekerjaan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(5,3,'Informasi dan Konsultasi Perekrutan Karyawan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(6,3,'Permohonan Tanda Daftar BKK','2026-10-13 11:01:23','2026-10-13 11:01:23'),(7,3,'Pengajuan Rekom ID CPMI','2026-10-13 11:01:23','2026-10-13 11:01:23'),(8,3,'Pendaftaran Pelatihan Kewirausahaan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(9,3,'Pendaftaran Pelatihan BLK','2026-10-13 11:01:23','2026-10-13 11:01:23'),(10,4,'Layanan Peningkatan Hak','2026-10-13 11:01:23','2026-10-13 11:01:23'),(11,4,'Roya BPN KKPR','2026-10-13 11:01:23','2026-10-13 11:01:23'),(12,4,'Izin Berusaha BPN','2026-10-13 11:01:23','2026-10-13 11:01:23'),(13,22,'Layanan BPOM','2026-10-13 11:01:23','2026-10-13 11:01:23'),(14,23,'Penilaian AMDAL','2026-10-13 11:01:23','2026-10-13 11:01:23'),(15,23,'Penilaian UKL UPL','2026-10-13 11:01:23','2026-10-13 11:01:23'),(16,24,'Layanan PTSP 1','2026-10-13 11:01:23','2026-10-13 11:01:23'),(17,25,'Layanan PTSP 2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(18,26,'Layanan Bank Banten','2026-10-13 11:01:23','2026-10-13 11:01:23'),(19,27,'Layanan Bank BJB','2026-10-13 11:01:23','2026-10-13 11:01:23'),(20,28,'Testing Baznas','2026-10-13 11:01:23','2026-10-13 11:01:23'),(21,28,'Dua','2026-10-13 11:01:23','2026-10-13 11:01:23'),(22,28,'Tiga','2026-10-13 11:01:23','2026-10-13 11:01:23'),(23,5,'Pendaftaran SPPT PBB-P2 Objek Pajak Baru','2026-10-13 11:01:23','2026-10-13 11:01:23'),(24,5,'Permohonan SPPT-PBB-P2 Mutasi Sebagian/Seluruhnya Objek dan Subjek','2026-10-13 11:01:23','2026-10-13 11:01:23'),(25,5,'Permohonan Surat Keterangan NJOP','2026-10-13 11:01:23','2026-10-13 11:01:23'),(26,5,'Permohonan Salinan SPPT PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(27,5,'Permohonan Keterangan Lunas PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(28,5,'Permohonan Penundaan Jatuh Tempo Pembayaran PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(29,5,'Permohonan Pengurangan PBB-2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(30,5,'Permohonan Keberatan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(31,5,'Permohonan Pengembalian','2026-10-13 11:01:23','2026-10-13 11:01:23'),(32,5,'Permohonan Pembatalan SPPT PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(33,5,'Permohonan Pembetulan SPPT SPPT PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(34,5,'Permohonan Pengurangan Sanksi Administrasi SPPT PBB-P2','2026-10-13 11:01:23','2026-10-13 11:01:23'),(35,5,'Permohonan Pembayaran Angsuran Pajak','2026-10-13 11:01:23','2026-10-13 11:01:23'),(36,5,'Permohonan Kompensasi','2026-10-13 11:01:23','2026-10-13 11:01:23'),(37,5,'Permohonan Aktivasi NOPD','2026-10-13 11:01:23','2026-10-13 11:01:23'),(38,5,'Pelayanan Permohonan penelitian/Validasi SSPD BPHTB','2026-10-13 11:01:23','2026-10-13 11:01:23'),(39,5,'Pelayanan Permohonan Pengurangan BPHTB','2026-10-13 11:01:23','2026-10-13 11:01:23'),(40,5,'Pelayanan Permohonan Resitusi/Pengembalian Pembayaran BPHTB','2026-10-13 11:01:23','2026-10-13 11:01:23'),(41,6,'Informasi dan Konsultasi Pajak Reklame','2026-10-13 11:01:23','2026-10-13 11:01:23'),(42,6,'Informasi dan Konsultasi Pajak Air Tanah','2026-10-13 11:01:23','2026-10-13 11:01:23'),(43,6,'Informasi dan Konsultasi Pajak Barang dan Jasa Tertentu (PBJT) – Restoran','2026-10-13 11:01:23','2026-10-13 11:01:23'),(44,6,'Informasi dan Konsultasi Pajak Penerangan jalan umum','2026-10-13 11:01:23','2026-10-13 11:01:23'),(45,6,'Informasi dan Konsultasi Pajak Hotel','2026-10-13 11:01:23','2026-10-13 11:01:23'),(46,6,'Informasi dan Konsultasi Pajak Parkir','2026-10-13 11:01:23','2026-10-13 11:01:23'),(47,6,'Informasi dan Konsultasi Pajak Hiburan (reflexiologi,karaoke,mandi uap, spa, permainan ketangkasan, permainan anak2,dll)','2026-10-13 11:01:23','2026-10-13 11:01:23'),(48,7,'Layanan BPJS Tenaga Kerja','2026-10-13 11:01:23','2026-10-13 11:01:23'),(49,8,'E-Tilang & Konsultasi Hukum','2026-10-13 11:01:23','2026-10-13 11:01:23'),(50,9,'Akta Kelahiran','2026-10-13 11:01:23','2026-10-13 11:01:23'),(51,9,'Akta Kematian','2026-10-13 11:01:23','2026-10-13 11:01:23'),(52,9,'Kartu Keluarga','2026-10-13 11:01:23','2026-10-13 11:01:23'),(53,9,'Pindah/Datang','2026-10-13 11:01:23','2026-10-13 11:01:23'),(54,9,'Cetak KTP','2026-10-13 11:01:23','2026-10-13 11:01:23'),(55,9,'Perekaman E-KTP','2026-10-13 11:01:23','2026-10-13 11:01:23'),(56,9,'Kartu Identitas Anak (KIA)','2026-10-13 11:01:23','2026-10-13 11:01:23'),(57,10,'Informasi AHU','2026-10-13 11:01:23','2026-10-13 11:01:23'),(58,10,'Konsultasi AHU','2026-10-13 11:01:23','2026-10-13 11:01:23'),(59,11,'Layanan Informasi P. Agama','2026-10-13 11:01:23','2026-10-13 11:01:23'),(60,11,'Layanan Pengaduan P. Agama','2026-10-13 11:01:23','2026-10-13 11:01:23'),(61,11,'Pendaftaran E-Court P. Agama','2026-10-13 11:01:23','2026-10-13 11:01:23'),(62,11,'Pengambilan Produk Pengadilan P. Agama','2026-10-13 11:01:23','2026-10-13 11:01:23'),(63,12,'Layanan PBG','2026-10-13 11:01:23','2026-10-13 11:01:23'),(64,13,'Informasi Umum Tata Ruang','2026-10-13 11:01:23','2026-10-13 11:01:23'),(65,13,'Informasi Pengesahan Rencana Tapak','2026-10-13 11:01:23','2026-10-13 11:01:23'),(66,13,'Informasi KKPR Non-berusaha','2026-10-13 11:01:23','2026-10-13 11:01:23'),(67,13,'Informasi KKPR Berusaha OSS','2026-10-13 11:01:23','2026-10-13 11:01:23'),(68,13,'Informasi Surat Keterangan Peruntukan Lahan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(69,13,'Informasi Surat Rekomendasi Teknis Peil Banjir','2026-10-13 11:01:23','2026-10-13 11:01:23'),(70,13,'Informasi Surat Rekomendasi Teknis Utilitas','2026-10-13 11:01:23','2026-10-13 11:01:23'),(71,13,'Informasi Surat Rekomendasi Penurunan Trotoar / Pembongkaran Trotoar','2026-10-13 11:01:23','2026-10-13 11:01:23'),(72,13,'Informasi Surat Rekomendasi Pembangunan Jembatan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(73,13,'Infomasi terkait Pemeliharaan Jalan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(74,13,'Informasi terkait Pemeliharaan Drainase','2026-10-13 11:01:23','2026-10-13 11:01:23'),(75,13,'Informasi pengujian kelayakan jalan','2026-10-13 11:01:23','2026-10-13 11:01:23'),(76,14,'Pelayanan Informasi PBG dan SLF','2026-10-13 11:01:24','2026-10-13 11:01:24'),(77,14,'Pelayanan Informasi Air Minum Air Limbah','2026-10-13 11:01:24','2026-10-13 11:01:24'),(78,15,'Layanan DISHUB','2026-10-13 11:01:24','2026-10-13 11:01:24'),(79,16,'Pelayanan BNN','2026-10-13 11:01:24','2026-10-13 11:01:24'),(80,17,'Perpanjangan SIM','2026-10-13 11:01:24','2026-10-13 11:01:24'),(81,17,'Pembuatan SIM Baru','2026-10-13 11:01:24','2026-10-13 11:01:24'),(82,17,'Layanan SKCK','2026-10-13 11:01:24','2026-10-13 11:01:24'),(83,18,'POS','2026-10-13 11:01:24','2026-10-13 11:01:24'),(84,19,'Pelayanan TASPEN','2026-10-13 11:01:24','2026-10-13 11:01:24'),(85,20,'Layanan Pasang Baru dan Tambah Daya','2026-10-13 11:01:24','2026-10-13 11:01:24'),(86,21,'Pendaftaran PDAM','2026-10-13 11:01:24','2026-10-13 11:01:24');
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_user_login`
--

LOCK TABLES `log_user_login` WRITE;
/*!40000 ALTER TABLE `log_user_login` DISABLE KEYS */;
INSERT INTO `log_user_login` VALUES (1,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 11:41:16'),(2,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 11:41:18'),(3,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 13:40:15'),(4,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 13:40:16'),(5,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 13:54:14'),(6,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 13:54:16'),(7,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-19 16:13:35'),(8,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-19 16:13:37'),(9,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 08:27:01'),(10,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-20 13:56:37'),(11,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-26 09:12:58'),(12,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-27 14:50:43'),(13,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-30 10:19:33'),(14,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-30 17:19:41'),(15,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-30 17:19:43'),(16,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-30 17:45:09'),(17,1,'admin',NULL,'Login Gagal','127.0.0.1','Edge / Windows 10','2026-10-30 17:45:15'),(18,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-30 17:45:20'),(19,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-10-30 18:26:10'),(20,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-30 18:26:31'),(21,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-10-30 18:26:35'),(22,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-10-30 18:26:38'),(23,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 08:42:33'),(24,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-02 09:22:50'),(25,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 09:22:59'),(26,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-02 09:23:13'),(27,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 09:23:15'),(28,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-02 09:23:57'),(29,3,'petugas_bpkd',6,'Login Gagal','127.0.0.1','Edge / Windows 10','2026-11-02 09:24:32'),(30,1,'admin',NULL,'Login Gagal','127.0.0.1','Edge / Windows 10','2026-11-02 09:24:36'),(31,3,'petugas_bpkd',6,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 09:24:46'),(32,3,'petugas_bpkd',6,'Logout','127.0.0.1','Edge / Windows 10','2026-11-02 09:24:51'),(33,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 09:25:06'),(34,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-02 09:29:30'),(35,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-02 09:29:33'),(36,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 08:34:41'),(37,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 14:07:19'),(38,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 14:07:26'),(39,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 14:49:37'),(40,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 14:49:39'),(41,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 15:28:06'),(42,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 15:28:14'),(43,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 15:31:20'),(44,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 15:31:22'),(45,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 15:43:55'),(46,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 15:44:56'),(47,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 15:53:34'),(48,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 15:53:40'),(49,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 15:54:43'),(50,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 15:54:50'),(51,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 16:03:37'),(52,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 16:03:38'),(53,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 16:11:59'),(54,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 16:12:08'),(55,2,'petugas_bapenda',5,'Logout','127.0.0.1','Edge / Windows 10','2026-11-03 16:16:36'),(56,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-03 16:16:38'),(57,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-09 08:29:44'),(58,1,'admin',NULL,'Login Gagal','127.0.0.1','Chrome / Windows 10','2026-11-09 08:39:48'),(59,1,'admin',NULL,'Login Gagal','127.0.0.1','Chrome / Windows 10','2026-11-09 08:40:01'),(60,1,'admin',NULL,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 08:40:14'),(61,1,'admin',NULL,'Logout','127.0.0.1','Chrome / Windows 10','2026-11-09 08:40:23'),(62,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 08:40:47'),(63,2,'petugas_bapenda',5,'Logout','127.0.0.1','Chrome / Windows 10','2026-11-09 11:30:47'),(64,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 11:30:58'),(65,2,'petugas_bapenda',5,'Logout','127.0.0.1','Chrome / Windows 10','2026-11-09 11:32:44'),(66,2,'petugas_bapenda',5,'Login Gagal','127.0.0.1','Chrome / Windows 10','2026-11-09 11:32:52'),(67,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 11:33:03'),(68,2,'petugas_bapenda',5,'Logout','127.0.0.1','Chrome / Windows 10','2026-11-09 11:35:35'),(69,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 11:35:46'),(70,2,'petugas_bapenda',5,'Logout','127.0.0.1','Chrome / Windows 10','2026-11-09 11:42:11'),(71,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-09 11:43:03'),(72,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-09 14:53:52'),(73,1,'admin',NULL,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-10 09:03:54'),(74,3,'petugas_bpkd',6,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-10 09:04:11'),(75,1,'admin',NULL,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-10 15:10:38'),(76,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-10 16:01:16'),(77,1,'admin',NULL,'Logout','127.0.0.1','Edge / Windows 10','2026-11-10 16:02:39'),(78,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-10 16:02:46'),(79,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-16 11:48:31'),(80,2,'petugas_bapenda',5,'Login Berhasil','127.0.0.1','Chrome / Windows 10','2026-11-16 11:50:05'),(81,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-16 14:49:42'),(82,1,'admin',NULL,'Login Berhasil','127.0.0.1','Edge / Windows 10','2026-11-17 09:01:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-09-21-041446','App\\Database\\Migrations\\CreateRolesTable','default','App',1791862495,1),(2,'2026-09-21-042108','App\\Database\\Migrations\\CreateKelompokTable','default','App',1791862495,1),(3,'2026-09-21-042225','App\\Database\\Migrations\\CreateGrupTable','default','App',1791862495,1),(4,'2026-09-21-042312','App\\Database\\Migrations\\CreateInstansiTable','default','App',1791862496,1),(5,'2026-09-21-042355','App\\Database\\Migrations\\CreateUsersTable','default','App',1791862496,1),(6,'2026-09-21-042425','App\\Database\\Migrations\\CreateLayananTable','default','App',1791862496,1),(7,'2026-09-21-042452','App\\Database\\Migrations\\CreateHariLiburTable','default','App',1791862496,1),(8,'2026-09-21-065404','App\\Database\\Migrations\\CreateSequenceAntreanTable','default','App',1791862496,1),(9,'2026-09-21-065451','App\\Database\\Migrations\\CreateAntreanTable','default','App',1791862496,1),(10,'2026-09-21-065509','App\\Database\\Migrations\\CreateRiwayatLayananTable','default','App',1791862496,1),(11,'2026-09-21-065521','App\\Database\\Migrations\\CreateRiwayatPanggilanTable','default','App',1791862496,1),(12,'2026-09-22-030912','App\\Database\\Migrations\\UpdateStatusLayananPending','default','App',1791862714,2),(13,'2026-10-08-085548','App\\Database\\Migrations\\CreateKuotaInstansiTable','default','App',1791862714,2),(14,'2026-10-13-030223','App\\Database\\Migrations\\AddStatusAndLastLoginToUsers','default','App',1791862714,2),(15,'2026-10-19-042711','App\\Database\\Migrations\\CreateLogUserLogin','default','App',1792384429,3),(16,'2026-10-19-042719','App\\Database\\Migrations\\CreateIpAksesAndStatusLayar','default','App',1792384429,3),(17,'2026-10-19-042910','App\\Database\\Migrations\\AddColumnsForHolidayGroupAndInstansi','default','App',1792384429,3),(18,'2026-10-19-033813','App\\Database\\Migrations\\AddPengaturanLoketToKuotaInstansi','default','App',1793689148,4),(19,'2026-10-19-065038','App\\Database\\Migrations\\AddSuaraToKelompok','default','App',1793689615,5),(20,'2026-10-30-115932','App\\Database\\Migrations\\AddStatusPanggilanToKelompok','default','App',1793689616,5),(21,'2026-11-01-123512','App\\Database\\Migrations\\AddDisplayMonitoringToKelompok','default','App',1793689616,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_layanan`
--

LOCK TABLES `riwayat_layanan` WRITE;
/*!40000 ALTER TABLE `riwayat_layanan` DISABLE KEYS */;
INSERT INTO `riwayat_layanan` VALUES (1,1,5,NULL,2,'DILAYANI','2026-10-15 18:22:19','2026-10-15 23:28:12',NULL,'Antrean hari ini','2026-10-15 18:22:19','2026-10-15 23:28:12'),(2,2,5,39,2,'SELESAI','2026-10-15 22:47:46','2026-10-15 23:36:15','2026-10-15 23:37:15','Pelayanan selesai','2026-10-15 22:47:47','2026-10-15 23:37:15'),(3,3,6,NULL,NULL,'MENUNGGU','2026-10-15 22:47:58',NULL,NULL,'Antrean hari ini','2026-10-15 22:47:58','2026-10-15 22:47:58'),(4,4,6,NULL,NULL,'MENUNGGU','2026-10-15 22:48:23',NULL,NULL,'Antrean hari ini','2026-10-15 22:48:23','2026-10-15 22:48:23'),(5,5,5,NULL,NULL,'MENUNGGU','2026-10-15 22:49:20',NULL,NULL,'Booking antrean hari selanjutnya','2026-10-15 22:49:20','2026-10-15 22:49:20'),(6,6,5,NULL,NULL,'MENUNGGU','2026-10-15 22:49:40',NULL,NULL,'Booking antrean hari selanjutnya','2026-10-15 22:49:41','2026-10-15 22:49:41'),(7,7,5,NULL,NULL,'MENUNGGU','2026-11-03 15:27:19',NULL,NULL,'Antrean hari ini','2026-11-03 15:27:19','2026-11-03 15:27:19'),(8,8,5,35,2,'SELESAI','2026-11-03 15:29:52','2026-11-03 15:45:46','2026-11-03 15:49:03','kwkkwkkw','2026-11-03 15:29:52','2026-11-03 15:49:03'),(9,9,5,NULL,NULL,'MENUNGGU','2026-11-03 15:47:32',NULL,NULL,'Antrean hari ini','2026-11-03 15:47:32','2026-11-03 15:47:32'),(10,10,5,NULL,2,'PENDING','2026-11-03 15:47:42','2026-11-03 15:49:29',NULL,'ga nyaut','2026-11-03 15:47:42','2026-11-03 15:49:54'),(11,11,5,NULL,NULL,'MENUNGGU','2026-11-03 15:47:49',NULL,NULL,'Antrean hari ini','2026-11-03 15:47:49','2026-11-03 15:47:49'),(12,12,5,NULL,NULL,'MENUNGGU','2026-11-03 15:47:58',NULL,NULL,'Antrean hari ini','2026-11-03 15:47:58','2026-11-03 15:47:58'),(13,13,5,NULL,NULL,'MENUNGGU','2026-11-03 15:48:04',NULL,NULL,'Antrean hari ini','2026-11-03 15:48:04','2026-11-03 15:48:04'),(14,14,5,NULL,NULL,'MENUNGGU','2026-11-03 15:48:11',NULL,NULL,'Antrean hari ini','2026-11-03 15:48:11','2026-11-03 15:48:11'),(15,15,5,NULL,NULL,'MENUNGGU','2026-11-03 15:48:17',NULL,NULL,'Antrean hari ini','2026-11-03 15:48:17','2026-11-03 15:48:17'),(16,16,5,NULL,NULL,'MENUNGGU','2026-11-03 15:48:24',NULL,NULL,'Antrean hari ini','2026-11-03 15:48:24','2026-11-03 15:48:24'),(17,17,5,NULL,NULL,'MENUNGGU','2026-11-03 15:48:30',NULL,NULL,'Antrean hari ini','2026-11-03 15:48:30','2026-11-03 15:48:30'),(18,18,5,27,2,'SELESAI','2026-11-03 15:48:37','2026-11-03 15:50:06','2026-11-03 15:52:28','jkfnkja','2026-11-03 15:48:37','2026-11-03 15:52:28'),(19,19,5,NULL,NULL,'MENUNGGU','2026-11-03 15:50:44',NULL,NULL,'Antrean hari ini','2026-11-03 15:50:44','2026-11-03 15:50:44'),(20,20,5,NULL,NULL,'MENUNGGU','2026-11-03 15:50:57',NULL,NULL,'Antrean hari ini','2026-11-03 15:50:57','2026-11-03 15:50:57'),(21,21,26,NULL,NULL,'MENUNGGU','2026-11-09 08:30:43',NULL,NULL,'Antrean hari ini','2026-11-09 08:30:43','2026-11-09 08:30:43'),(22,22,27,NULL,NULL,'MENUNGGU','2026-11-09 08:31:27',NULL,NULL,'Antrean hari ini','2026-11-09 08:31:27','2026-11-09 08:31:27'),(23,23,5,NULL,NULL,'MENUNGGU','2026-11-09 08:46:38',NULL,NULL,'Antrean hari ini','2026-11-09 08:46:38','2026-11-09 08:46:38'),(24,24,6,NULL,NULL,'MENUNGGU','2026-11-10 09:09:25',NULL,NULL,'Antrean hari ini','2026-11-10 09:09:25','2026-11-10 09:09:25'),(25,25,6,NULL,NULL,'MENUNGGU','2026-11-10 09:10:46',NULL,NULL,'Antrean hari ini','2026-11-10 09:10:46','2026-11-10 09:10:46'),(26,26,6,NULL,NULL,'MENUNGGU','2026-11-16 14:45:51',NULL,NULL,'Antrean hari ini','2026-11-16 14:45:51','2026-11-16 14:45:51'),(27,27,6,NULL,NULL,'MENUNGGU','2026-11-16 14:46:42',NULL,NULL,'Antrean hari ini','2026-11-16 14:46:42','2026-11-16 14:46:42'),(28,28,5,NULL,NULL,'MENUNGGU','2026-11-16 14:50:37',NULL,NULL,'Antrean hari ini','2026-11-16 14:50:37','2026-11-16 14:50:37'),(29,29,5,NULL,NULL,'MENUNGGU','2026-11-16 14:51:06',NULL,NULL,'Antrean hari ini','2026-11-16 14:51:06','2026-11-16 14:51:06'),(30,30,4,NULL,NULL,'MENUNGGU','2026-11-17 09:38:50',NULL,NULL,'Antrean hari ini','2026-11-17 09:38:50','2026-11-17 09:38:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_panggilan`
--

LOCK TABLES `riwayat_panggilan` WRITE;
/*!40000 ALTER TABLE `riwayat_panggilan` DISABLE KEYS */;
INSERT INTO `riwayat_panggilan` VALUES (1,2,2,'PANGGIL','2026-10-15 23:24:23',NULL,'2026-10-15 23:24:23','2026-10-15 23:24:23'),(2,2,2,'PANGGIL','2026-10-15 23:25:10','Panggilan ulang','2026-10-15 23:25:10','2026-10-15 23:25:10'),(3,1,2,'PANGGIL','2026-10-15 23:28:12',NULL,'2026-10-15 23:28:12','2026-10-15 23:28:12'),(4,2,2,'PANGGIL','2026-10-15 23:36:15','Panggil antrean pending','2026-10-15 23:36:15','2026-10-15 23:36:15'),(5,8,2,'PANGGIL','2026-11-03 15:45:46','Panggilan pertama','2026-11-03 15:45:46','2026-11-03 15:45:46'),(6,10,2,'PANGGIL','2026-11-03 15:49:29','Panggilan pertama','2026-11-03 15:49:29','2026-11-03 15:49:29'),(7,18,2,'PANGGIL','2026-11-03 15:50:06','Panggilan pertama','2026-11-03 15:50:06','2026-11-03 15:50:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2026-10-13 11:01:23','2026-10-13 11:01:23'),(2,'Petugas','2026-10-13 11:01:23','2026-10-13 11:01:23');
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
INSERT INTO `sequence_antrean` VALUES ('2026-10-15',4,'2026-10-15 22:48:23'),('2026-10-16',2,'2026-10-15 22:49:40'),('2026-11-03',14,'2026-11-03 15:50:57'),('2026-11-09',3,'2026-11-09 08:46:38'),('2026-11-10',2,'2026-11-10 09:10:46'),('2026-11-16',4,'2026-11-16 14:51:06'),('2026-11-17',1,'2026-11-17 09:38:50');
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
  CONSTRAINT `status_layar_kelompok_id_foreign` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,NULL,'admin','$2y$10$U5jDY1Gmm2d4d38/hd/f/.eKmSDTwgepAKUSqf6W9Mz6EDfN2/6bO','2026-10-13 11:01:24','2026-10-13 11:01:24','Aktif',NULL),(2,2,5,'petugas_bapenda','$2y$10$U5jDY1Gmm2d4d38/hd/f/.eKmSDTwgepAKUSqf6W9Mz6EDfN2/6bO','2026-10-13 11:01:24','2026-10-13 11:01:24','Aktif',NULL),(3,2,6,'petugas_bpkd','$2y$10$U5jDY1Gmm2d4d38/hd/f/.eKmSDTwgepAKUSqf6W9Mz6EDfN2/6bO','2026-10-13 11:01:24','2026-10-13 11:01:24','Aktif',NULL);
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

-- Dump completed on 2026-11-17  9:43:16
