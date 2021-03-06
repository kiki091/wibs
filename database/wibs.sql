-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: wibs
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `hadis`
--

DROP TABLE IF EXISTS `hadis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hadis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `awal_hadis` text NOT NULL,
  `perawi_dari_sahabat` varchar(100) NOT NULL,
  `imam_ahlul_hadis` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hadis`
--

LOCK TABLES `hadis` WRITE;
/*!40000 ALTER TABLE `hadis` DISABLE KEYS */;
/*!40000 ALTER TABLE `hadis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `title_description` varchar(45) DEFAULT NULL,
  `tingkatan_id` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kelas_1_idx` (`tingkatan_id`),
  CONSTRAINT `fk_kelas_1` FOREIGN KEY (`tingkatan_id`) REFERENCES `tingkatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (1,'VII','Kelas 7',1,NULL,NULL,NULL),(2,'VIII','Kelas 8',1,NULL,NULL,NULL),(3,'IX','Kelas 9',1,NULL,NULL,NULL),(4,'X','Kelas 10',2,NULL,NULL,NULL),(5,'XI','Kelas 11',2,NULL,NULL,NULL),(6,'XII','Kelas 12',2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kitab`
--

DROP TABLE IF EXISTS `kitab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kitab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `nama_penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun` int(4) DEFAULT NULL,
  `jilid` int(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kitab`
--

LOCK TABLES `kitab` WRITE;
/*!40000 ALTER TABLE `kitab` DISABLE KEYS */;
INSERT INTO `kitab` VALUES (1,'Judul Kitab','Kitab A','Nama Lengkap Penulis','Nama Lengkap Penerbit',2016,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `kitab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privilage_siswa`
--

DROP TABLE IF EXISTS `privilage_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privilage_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilage_siswa`
--

LOCK TABLES `privilage_siswa` WRITE;
/*!40000 ALTER TABLE `privilage_siswa` DISABLE KEYS */;
INSERT INTO `privilage_siswa` VALUES (1,'Privillage Siswa WIBS','Privillage Siswa WIBS','Privillage Siswa WIBS',NULL,NULL);
/*!40000 ALTER TABLE `privilage_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_hafalan_hadits`
--

DROP TABLE IF EXISTS `report_hafalan_hadits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_hafalan_hadits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kedisiplinan` varchar(1) DEFAULT NULL,
  `total_hafalan` int(3) DEFAULT NULL,
  `kekuatan_hafalan` varchar(15) DEFAULT NULL COMMENT '1 = Lemah\n2 = Sedang\n3 = Baik\n4 = Sangat Baik',
  `nilai_hafalan` int(3) DEFAULT NULL,
  `description` text,
  `siswa_id` int(10) NOT NULL,
  `kitab_id` int(2) NOT NULL,
  `report_from` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_hafalan_hadits_1_idx` (`siswa_id`),
  KEY `fk_report_hafalan_hadits_2_idx` (`kitab_id`),
  CONSTRAINT `fk_report_hafalan_hadits_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_report_hafalan_hadits_2` FOREIGN KEY (`kitab_id`) REFERENCES `kitab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_hafalan_hadits`
--

LOCK TABLES `report_hafalan_hadits` WRITE;
/*!40000 ALTER TABLE `report_hafalan_hadits` DISABLE KEYS */;
INSERT INTO `report_hafalan_hadits` VALUES (2,'A',2,'80',80,'KETERANGAN',2,1,'2017-08-29','2017-08-29 17:01:56',NULL,1);
/*!40000 ALTER TABLE `report_hafalan_hadits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_hafalan_quran`
--

DROP TABLE IF EXISTS `report_hafalan_quran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_hafalan_quran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disiplin` varchar(2) NOT NULL,
  `total_hafalan` int(2) NOT NULL,
  `nilai_hafalan` int(3) NOT NULL,
  `nilai_tajwid` int(3) NOT NULL,
  `nilai_mahraj` int(3) NOT NULL,
  `description` text,
  `report_from` date NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_tahfiz_1_idx` (`siswa_id`),
  CONSTRAINT `fk_report_tahfiz_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_hafalan_quran`
--

LOCK TABLES `report_hafalan_quran` WRITE;
/*!40000 ALTER TABLE `report_hafalan_quran` DISABLE KEYS */;
INSERT INTO `report_hafalan_quran` VALUES (1,'A',12,85,86,72,NULL,'2017-07-01',1,NULL,NULL,NULL),(2,'A',7,78,69,77,'Tingkatkan kembali','2017-08-27',2,'2017-08-27 15:04:52',NULL,1);
/*!40000 ALTER TABLE `report_hafalan_quran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_kesehatan`
--

DROP TABLE IF EXISTS `report_kesehatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_kesehatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `berat_badan` int(3) DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL,
  `tensi_darah` varchar(10) DEFAULT NULL,
  `golongan_darah` varchar(2) DEFAULT NULL,
  `riwayat_sakit` varchar(150) DEFAULT NULL,
  `keadaan_siswa` varchar(100) DEFAULT NULL COMMENT '- Sehat Jasmani\n- Kurang begitu sehat\n- Sedang dalam perawatan\n- Lainnya',
  `keadaan_siswa_other` varchar(100) DEFAULT NULL,
  `siswa_id` int(10) NOT NULL,
  `report_from` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_kesehatan_1_idx` (`siswa_id`),
  CONSTRAINT `fk_report_kesehatan_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_kesehatan`
--

LOCK TABLES `report_kesehatan` WRITE;
/*!40000 ALTER TABLE `report_kesehatan` DISABLE KEYS */;
INSERT INTO `report_kesehatan` VALUES (1,60,176,'90/100','A','Flu dan Demam','Sehat Jasmani',NULL,1,'2017-07-01',NULL,NULL,NULL),(2,50,155,'100/90','A','Flu dan demam','Sehat Jasmani','',2,'2017-08-29','2017-08-29 16:35:35',NULL,1);
/*!40000 ALTER TABLE `report_kesehatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_siswa`
--

DROP TABLE IF EXISTS `role_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_siswa` (
  `siswa_id` int(10) NOT NULL,
  `privilage_siswa_id` int(10) NOT NULL,
  PRIMARY KEY (`siswa_id`,`privilage_siswa_id`),
  KEY `fk_role_siswa_2_idx` (`privilage_siswa_id`),
  CONSTRAINT `fk_role_siswa_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_siswa_2` FOREIGN KEY (`privilage_siswa_id`) REFERENCES `privilage_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_siswa`
--

LOCK TABLES `role_siswa` WRITE;
/*!40000 ALTER TABLE `role_siswa` DISABLE KEYS */;
INSERT INTO `role_siswa` VALUES (1,1);
/*!40000 ALTER TABLE `role_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_activitie`
--

DROP TABLE IF EXISTS `score_activitie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_activitie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `value` varchar(15) NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `siswa_id` int(10) NOT NULL,
  `sub_program_id` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score_activitie_1_idx` (`siswa_id`),
  KEY `fk_score_activitie_2_idx` (`sub_program_id`),
  CONSTRAINT `fk_score_activitie_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_score_activitie_2` FOREIGN KEY (`sub_program_id`) REFERENCES `sub_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_activitie`
--

LOCK TABLES `score_activitie` WRITE;
/*!40000 ALTER TABLE `score_activitie` DISABLE KEYS */;
/*!40000 ALTER TABLE `score_activitie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_description`
--

DROP TABLE IF EXISTS `score_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_from` date NOT NULL,
  `description` text,
  `score_activitie_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score_description_1_idx` (`score_activitie_id`),
  CONSTRAINT `fk_score_description_1` FOREIGN KEY (`score_activitie_id`) REFERENCES `score_activitie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_description`
--

LOCK TABLES `score_description` WRITE;
/*!40000 ALTER TABLE `score_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `score_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_scale`
--

DROP TABLE IF EXISTS `score_scale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualitative_score` varchar(20) DEFAULT NULL,
  `quantitative_score` varchar(20) DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `score_activitie_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_score_scale_1_idx` (`score_activitie_id`),
  CONSTRAINT `fk_score_scale_1` FOREIGN KEY (`score_activitie_id`) REFERENCES `score_activitie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_scale`
--

LOCK TABLES `score_scale` WRITE;
/*!40000 ALTER TABLE `score_scale` DISABLE KEYS */;
/*!40000 ALTER TABLE `score_scale` ENABLE KEYS */;
UNLOCK TABLES;

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
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `kewarganegaraan` tinyint(1) NOT NULL COMMENT '1 : WNI\n2 : WNA',
  `anak_ke` tinyint(1) DEFAULT NULL,
  `jumlah_saudara_kandung` tinyint(2) DEFAULT NULL,
  `status_orang_tua` tinyint(1) DEFAULT NULL COMMENT '1 : Yatim\n2 : Yatim Piatu',
  `alamat` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `status_tinggal` tinyint(1) NOT NULL COMMENT '1 : Tinggal dengan orang tua\n2 : Tinggal dengan saudara/i',
  `golongan_darah` varchar(2) DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL COMMENT 'Satuan = CM',
  `berat_badan` int(3) DEFAULT NULL COMMENT 'Satuan = KG',
  `alamat_sekolah` text,
  `tanggal_nomer_sttb` text NOT NULL,
  `lama_belajar` int(2) DEFAULT NULL COMMENT 'Satuan = Tahun',
  `kelas_id` int(3) DEFAULT NULL,
  `tingkatan_id` int(2) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `status_siswa` tinyint(1) NOT NULL COMMENT '1 = Siswa Baru\n2 = Siswa Pindahan',
  `description` text,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis_UNIQUE` (`nis`),
  KEY `fk_siswa_tingkatan_idx` (`tingkatan_id`),
  KEY `fk_siswa_1_idx` (`kelas_id`),
  CONSTRAINT `fk_siswa_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_siswa_tingkatan` FOREIGN KEY (`tingkatan_id`) REFERENCES `tingkatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES (1,'55554444444','Kiki Kurniawan','Kiki',1,'Jakarta',NULL,1,2,2,NULL,'Depok','0812876792909',1,NULL,NULL,NULL,NULL,'12345',NULL,6,2,1,1,'Motifasi saya bersekolah di al-wafi islamic boarding school adalah ingin mempelajari agama lebih mendalam, saya memohon kepada Allah agar saya dapat mengambil ilmu yang bermanfaat untuk saya dan keluarga.','wibs__profile__images5985e04210955_220x220.jpg','kikikurniawan091edit@gmail.com','$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy','nR1sA9EQltrSA2kRiqTxM84ib0UrQeG5rSzRItMTI2HzEvYfHDfThC3488sg',NULL,'2017-08-27 10:51:10',NULL),(2,'55555555555','Febrina','Febri',2,'Bogor',NULL,1,4,5,NULL,'Depok','08963432952',1,NULL,NULL,NULL,NULL,'12344',NULL,5,1,1,1,'Motifasi saya bersekolah di al-wafi islamic boarding school adalah ingin mempelajari agama lebih mendalam, saya memohon kepada Allah agar saya dapat mengambil ilmu yang bermanfaat untuk saya dan keluarga.',NULL,'febrinaniken093@gmail.com','$2y$10$jWqW0ETc23XTaaDtjktAw.XRvdet5BnBHauvmJLPBCWNfbyvI3YNy',NULL,NULL,NULL,NULL),(3,'55553333333','RTURTU','RTURTU',1,'ASFASF','',1,1,2,1,'ALAMAT','62356235',1,'A',155,67,'ALAMAT SEKOLAH ASAL','2323525235',3,4,2,1,2,'KETERANGAN','wibs__profile__images59948cd2a9745_220x220.jpg','kiki@gmail.com','$2y$10$lkDkX3Umgwe9cHcHFj1Xi.GH/rdCOAwXevCq8ndWGyM5Ylcqu.YLK',NULL,'2017-08-16 18:20:02','2017-08-16 18:20:02',1),(4,'3333444666','Test Revisi','Test Revisi',1,'Depok','1992-03-06',1,1,2,1,'Jl. Jati Rt.004/Rw.003 No.2 Sawangan Baru','436734643643',1,'A',155,50,'Jl. Jati Rt.004/Rw.003 No.2 Sawangan Baru','464363467347854845',NULL,2,1,1,1,'KETERANGAN','wibs__profile__images59b6bc699f31b_220x220.jpg','user@gmail.com','$2y$10$EWEYJDTRVs914c91kmTTTOxZUDoHdZLKqQ1be457FjBX/TA6AYWSW',NULL,'2017-09-11 16:40:09','2017-09-11 16:40:09',1);
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
  `alamat_sekolah_lama` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa_pindahan`
--

LOCK TABLES `siswa_pindahan` WRITE;
/*!40000 ALTER TABLE `siswa_pindahan` DISABLE KEYS */;
INSERT INTO `siswa_pindahan` VALUES (1,'ASAL SEKOLAH','ALAMAT SEKOLAH','ALASAN PINDAH',1,'2017-08-16',3,'2017-08-16 18:20:02','2017-08-16 18:20:02',1);
/*!40000 ALTER TABLE `siswa_pindahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_program`
--

DROP TABLE IF EXISTS `sub_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `program_id` int(2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_program_1_idx` (`program_id`),
  CONSTRAINT `fk_sub_program_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_program`
--

LOCK TABLES `sub_program` WRITE;
/*!40000 ALTER TABLE `sub_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_program` ENABLE KEYS */;
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
  `title_alias` varchar(40) DEFAULT NULL,
  `slug` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tingkatan`
--

LOCK TABLES `tingkatan` WRITE;
/*!40000 ALTER TABLE `tingkatan` DISABLE KEYS */;
INSERT INTO `tingkatan` VALUES (1,'SMP','Junior High School','smp',1,NULL,NULL,NULL),(2,'SMA','Senior High School','sma',1,NULL,NULL,NULL);
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
  `nama_lengkap_ayah` varchar(80) NOT NULL,
  `nama_lengkap_ibu` varchar(80) NOT NULL,
  `tempat_lahir_ayah` varchar(100) NOT NULL,
  `tempat_lahir_ibu` varchar(100) NOT NULL,
  `tanggal_lahir_ayah` date NOT NULL,
  `tanggal_lahir_ibu` date NOT NULL,
  `kewarganegaraan_ayah` tinyint(1) NOT NULL,
  `kewarganegaraan_ibu` tinyint(1) NOT NULL,
  `pendidikan_ayah` tinyint(1) DEFAULT NULL,
  `pendidikan_ibu` tinyint(1) DEFAULT NULL,
  `pekerjaan_ayah` tinyint(1) DEFAULT NULL,
  `pekerjaan_ibu` tinyint(1) DEFAULT NULL,
  `penghasilan_bulanan_ayah` int(10) DEFAULT NULL,
  `penghasilan_bulanan_ibu` int(10) DEFAULT '0',
  `email_ayah` varchar(45) DEFAULT NULL,
  `email_ibu` varchar(45) DEFAULT NULL,
  `status_ayah` tinyint(1) DEFAULT NULL COMMENT '1 : Masih Hidup\n2 : Sudah Meninggal',
  `status_ibu` tinyint(1) DEFAULT NULL COMMENT '1 : Masih Hidup\n2 : Sudah Meninggal',
  `siswa_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wali_siswa_1_idx` (`siswa_id`),
  CONSTRAINT `fk_wali_siswa_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wali_siswa`
--

LOCK TABLES `wali_siswa` WRITE;
/*!40000 ALTER TABLE `wali_siswa` DISABLE KEYS */;
INSERT INTO `wali_siswa` VALUES (1,'Mohamad Ali','Jamilah','Depok','Depok','1970-02-07','1971-03-05',1,1,6,5,2,2,8000000,7000000,'email_ayah@gmail.com','email_ibu@gmail.com',1,1,1,'2017-09-11 16:21:36',NULL,1);
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

-- Dump completed on 2017-09-11 23:41:02
