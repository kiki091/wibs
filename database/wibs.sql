-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: wibs
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `nama_panggilan` varchar(30) DEFAULT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL COMMENT '1 : Laki-laki\n2 : Perempuan',
  `tempat_lahir` varchar(50) NOT NULL,
  `agama` tinyint(1) NOT NULL COMMENT '1 : Islam\n2 : Kristen Katolik\n3 : Kristen Protestan\n4 : Hindu\n5 : Budha\n6 : Lainnya',
  `kewarganegaraan` tinyint(1) NOT NULL COMMENT '1 : WNI\n2 : WNA',
  `anak_ke` tinyint(1) DEFAULT NULL,
  `jumlah_saudara_kandung` tinyint(2) DEFAULT NULL,
  `jumlah_saudara_tiri` tinyint(2) DEFAULT NULL,
  `status_orang_tua` tinyint(1) DEFAULT NULL COMMENT '1 : Yatim\n2 : Yatim Piatu',
  `jenis_bahasa` varchar(40) DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `status_tinggal` tinyint(1) NOT NULL COMMENT '1 : Tinggal dengan orang tua\n2 : Tinggal dengan saudara/i',
  `asrama_kost` text,
  `jarak_rumah` varchar(40) DEFAULT NULL,
  `golongan_darah` varchar(2) DEFAULT NULL,
  `derita_penyakit` varchar(100) DEFAULT NULL,
  `kelainan_jasmani` varchar(100) DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL COMMENT 'Satuan = CM',
  `berat_badan` int(3) DEFAULT NULL COMMENT 'Satuan = KG',
  `pendidikan_sebelumnya` varchar(80) NOT NULL,
  `lulusan_dari` varchar(100) DEFAULT NULL,
  `alamat_sekolah` text,
  `tanggal_nomer_sttb` text NOT NULL,
  `lama_belajar` int(2) DEFAULT NULL COMMENT 'Satuan = Tahun',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `tingkatan_id` int(2) NOT NULL,
  `kelas` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis_UNIQUE` (`nis`),
  KEY `fk_siswa_tingkatan_idx` (`tingkatan_id`),
  CONSTRAINT `fk_siswa_tingkatan` FOREIGN KEY (`tingkatan_id`) REFERENCES `tingkatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa_pindahan`
--

DROP TABLE IF EXISTS `siswa_pindahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa_pindahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `alamat_sekolah` text,
  `alasan_pindah` varchar(200) DEFAULT NULL,
  `status_berpindah` int(1) DEFAULT NULL COMMENT 'true or false',
  `tanggal_masuk` date NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_siswa_pindahan_idx` (`siswa_id`),
  CONSTRAINT `fk_siswa_pindahan` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa_pindahan`
--

LOCK TABLES `siswa_pindahan` WRITE;
/*!40000 ALTER TABLE `siswa_pindahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `siswa_pindahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tingkatan`
--

DROP TABLE IF EXISTS `tingkatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tingkatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `slug` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tingkatan`
--

LOCK TABLES `tingkatan` WRITE;
/*!40000 ALTER TABLE `tingkatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tingkatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wali_siswa`
--

DROP TABLE IF EXISTS `wali_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wali_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(80) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` tinyint(1) NOT NULL,
  `kewarganegaraan` tinyint(1) NOT NULL,
  `pendidikan` tinyint(1) NOT NULL,
  `pekerjaan` tinyint(1) NOT NULL,
  `penghasilan_bulanan` varchar(15) DEFAULT NULL,
  `alamat_kantor` text,
  `telpon_kantor` varchar(15) DEFAULT NULL,
  `alamat_rumah` text,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(55) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 : Masih Hidup\n2 : Sudah Meninggal',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `siswa_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wali_siswa_idx` (`siswa_id`),
  CONSTRAINT `fk_wali_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wali_siswa`
--

LOCK TABLES `wali_siswa` WRITE;
/*!40000 ALTER TABLE `wali_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `wali_siswa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-04 17:48:20
