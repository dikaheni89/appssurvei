/*
Navicat MySQL Data Transfer

Source Server         : database
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_survei

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-02-04 01:32:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_berita
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berita`;
CREATE TABLE `tbl_berita` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategorimenu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seo` varchar(255) NOT NULL,
  `headline` int(1) DEFAULT NULL COMMENT '1: ya, 2: tidak',
  `deskripsi` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_berita
-- ----------------------------
INSERT INTO `tbl_berita` VALUES ('4', '5', 'Berita Kominfo', 'berita-kominfo', '1', '<p>jajal</p>', '1.PNG', '2020-12-31 00:07:52', null, null);
INSERT INTO `tbl_berita` VALUES ('5', '5', 'sadasda', 'sadasda', '1', '<p>sdadasd</p>', 'bg.png', '2021-01-25 22:52:42', null, null);
INSERT INTO `tbl_berita` VALUES ('6', '5', 'sdasdasdas', 'sdasdasdas', '1', '<p>sdasdsad</p>', 'KOP.PNG', '2021-01-25 22:53:04', null, null);
INSERT INTO `tbl_berita` VALUES ('7', '5', 'dsadsad', 'dsadsad', '1', '<p>sdsadasd</p>', 'profil.png', '2021-01-25 22:53:27', null, null);

-- ----------------------------
-- Table structure for tbl_galeri
-- ----------------------------
DROP TABLE IF EXISTS `tbl_galeri`;
CREATE TABLE `tbl_galeri` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seo` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_galeri
-- ----------------------------
INSERT INTO `tbl_galeri` VALUES ('1', '2', 'test', 'test', 'jajal', '93521669_114336440237884_7760558363984789504_o.jpg', '2020-10-01 17:36:23', '2020-10-06 04:15:20', null);
INSERT INTO `tbl_galeri` VALUES ('2', '1', 'test', 'test', 'jajal', '1_2.png', '2020-10-01 18:59:02', '2020-10-06 04:15:26', null);

-- ----------------------------
-- Table structure for tbl_halaman
-- ----------------------------
DROP TABLE IF EXISTS `tbl_halaman`;
CREATE TABLE `tbl_halaman` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `seo` varchar(255) DEFAULT NULL,
  `deskripsi` text CHARACTER SET armscii8 NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_halaman
-- ----------------------------
INSERT INTO `tbl_halaman` VALUES ('7', 'Visi dan Misi', 'visi-dan-misi', '<p>VISI &amp; MISI</p><p>VISI</p><p>\"Kabupaten Pandeglang Menuju Smart City Tahun 2021\"</p><p>MISI</p><p>1. Meningkatkan Sumberdaya Manusia yang handal dan Profesional</p><p>2. Meningkatkan Kualitas dan Kuantitas sarana Prasarana Komunikasi, Informatika, sandi dan statistik</p><p>3. Meningkatkan Sistem Informasi pelayanan jasa komunikasi, Informatika, Sandi dan statistik</p>', null, '2020-12-30 12:56:23', '2020-12-30 13:44:31', null);

-- ----------------------------
-- Table structure for tbl_input
-- ----------------------------
DROP TABLE IF EXISTS `tbl_input`;
CREATE TABLE `tbl_input` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `idnmsurvei` int(11) NOT NULL,
  `nm_input` varchar(100) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_input
-- ----------------------------
INSERT INTO `tbl_input` VALUES ('1', '2', 'SD');
INSERT INTO `tbl_input` VALUES ('2', '2', 'SLTP');
INSERT INTO `tbl_input` VALUES ('4', '2', 'SLTA');
INSERT INTO `tbl_input` VALUES ('5', '3', 'SD');
INSERT INTO `tbl_input` VALUES ('6', '3', 'SLTP');
INSERT INTO `tbl_input` VALUES ('7', '3', 'SLTA');
INSERT INTO `tbl_input` VALUES ('8', '4', 'SD');
INSERT INTO `tbl_input` VALUES ('9', '4', 'SLTP');
INSERT INTO `tbl_input` VALUES ('10', '4', 'SLTA');
INSERT INTO `tbl_input` VALUES ('11', '5', 'SD');
INSERT INTO `tbl_input` VALUES ('12', '5', 'SLTP');
INSERT INTO `tbl_input` VALUES ('13', '5', 'SLTA');
INSERT INTO `tbl_input` VALUES ('14', '6', 'Jumlah Pekerja');
INSERT INTO `tbl_input` VALUES ('15', '6', 'Lembaga Non Pemerintahan');
INSERT INTO `tbl_input` VALUES ('16', '7', 'Pengangguran Terbuka');
INSERT INTO `tbl_input` VALUES ('17', '8', 'Bupati/Walkot');
INSERT INTO `tbl_input` VALUES ('18', '8', 'Wakil Bupati/Walkot');
INSERT INTO `tbl_input` VALUES ('19', '9', 'Laki-Laki');
INSERT INTO `tbl_input` VALUES ('20', '9', 'Perempuan');
INSERT INTO `tbl_input` VALUES ('21', '10', 'Laki-Laki');
INSERT INTO `tbl_input` VALUES ('22', '10', 'Perempuan');
INSERT INTO `tbl_input` VALUES ('23', '11', 'Eselon I');
INSERT INTO `tbl_input` VALUES ('24', '11', 'Eselon II');
INSERT INTO `tbl_input` VALUES ('25', '11', 'Eselon III');
INSERT INTO `tbl_input` VALUES ('26', '11', 'Eselon IV');
INSERT INTO `tbl_input` VALUES ('27', '11', 'Eselon V');
INSERT INTO `tbl_input` VALUES ('28', '11', 'Fungsional Umum');
INSERT INTO `tbl_input` VALUES ('29', '11', 'Fungsional Tertentu');
INSERT INTO `tbl_input` VALUES ('30', '12', 'Golongan I');
INSERT INTO `tbl_input` VALUES ('31', '12', 'Golongan II');
INSERT INTO `tbl_input` VALUES ('32', '12', 'Golongan III');
INSERT INTO `tbl_input` VALUES ('33', '12', 'Golongan IV');
INSERT INTO `tbl_input` VALUES ('34', '13', 'Laki-Laki');
INSERT INTO `tbl_input` VALUES ('35', '13', 'Perempuan');
INSERT INTO `tbl_input` VALUES ('36', '14', 'Caleg');
INSERT INTO `tbl_input` VALUES ('37', '14', 'Pengurus Harian Parpol');
INSERT INTO `tbl_input` VALUES ('38', '15', 'Jumlah Pengurus Kaukus Perempuan Politik');
INSERT INTO `tbl_input` VALUES ('39', '15', 'Jumlah Anggota Kaukus Perempuan Politik');
INSERT INTO `tbl_input` VALUES ('42', '16', 'Laki-Laki');
INSERT INTO `tbl_input` VALUES ('43', '16', 'Perempuan');

-- ----------------------------
-- Table structure for tbl_kategorimenus
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategorimenus`;
CREATE TABLE `tbl_kategorimenus` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `seo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_kategorimenus
-- ----------------------------
INSERT INTO `tbl_kategorimenus` VALUES ('5', 'Berita Kegiatan', 'berita-kegiatan', '2020-12-31 00:07:15', null, null);

-- ----------------------------
-- Table structure for tbl_kategorisurvei
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategorisurvei`;
CREATE TABLE `tbl_kategorisurvei` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `kt_survei` varchar(100) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_kategorisurvei
-- ----------------------------
INSERT INTO `tbl_kategorisurvei` VALUES ('2', 'Format Data Terpilah Gender dan Anak Terbaru');
INSERT INTO `tbl_kategorisurvei` VALUES ('3', '	FORMAT DATA GENDER DAN ANAK ( I. DATA UMUM & II. BIDANG KESEHATAN )');
INSERT INTO `tbl_kategorisurvei` VALUES ('4', 'FORMAT DATA GENDER DAN ANAK ( IX. DATA ANAK )');
INSERT INTO `tbl_kategorisurvei` VALUES ('5', 'FORMAT DATA GENDER DAN ANAK ( VIII. KEKERASAN )');
INSERT INTO `tbl_kategorisurvei` VALUES ('6', 'FORMAT DATA GENDER DAN ANAK ( V. BIDANG EKONOMI DAN KETENAGAKERJAAN )');
INSERT INTO `tbl_kategorisurvei` VALUES ('7', 'FORMAT DATA GENDER DAN ANAK ( VI. BIDANG POLITIK DAN PENGAMBILAN KEPUTUSAN )');
INSERT INTO `tbl_kategorisurvei` VALUES ('8', 'FORMAT DATA GENDER DAN ANAK ( III. BIDANG PENDIDIKAN & IV. BIDANG SUMBER DAYA ALAM (SDA) DAN LINGKUN');
INSERT INTO `tbl_kategorisurvei` VALUES ('9', 'FORMAT DATA GENDER DAN ANAK ( IX. DATA ANAK )');
INSERT INTO `tbl_kategorisurvei` VALUES ('10', 'FORMAT DATA GENDER DAN ANAK ( VII. BIDANG HUKUM DAN SOSIAL BUDAYA )');

-- ----------------------------
-- Table structure for tbl_level
-- ----------------------------
DROP TABLE IF EXISTS `tbl_level`;
CREATE TABLE `tbl_level` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_level
-- ----------------------------
INSERT INTO `tbl_level` VALUES ('1', 'Administrator');
INSERT INTO `tbl_level` VALUES ('2', 'Dikbud');
INSERT INTO `tbl_level` VALUES ('3', 'Discapil');
INSERT INTO `tbl_level` VALUES ('4', 'Disnaker');

-- ----------------------------
-- Table structure for tbl_menus
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menus`;
CREATE TABLE `tbl_menus` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `uri` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `is_main` int(11) NOT NULL,
  `is_aktif` int(1) NOT NULL DEFAULT 1,
  `order` int(2) DEFAULT 0,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_menus
-- ----------------------------
INSERT INTO `tbl_menus` VALUES ('1', 'Manage Users', '#', 'fas fa-th', '0', '1', '2');
INSERT INTO `tbl_menus` VALUES ('2', 'Users', 'admin/users', '', '1', '1', '1');
INSERT INTO `tbl_menus` VALUES ('3', 'Level Users', 'admin/level', '', '1', '1', '2');
INSERT INTO `tbl_menus` VALUES ('4', 'Setting Website', '#', 'fas fa-cogs', '0', '1', '2');
INSERT INTO `tbl_menus` VALUES ('5', 'Manage Menu', 'admin/menu', '', '4', '1', '1');
INSERT INTO `tbl_menus` VALUES ('6', 'Manage Kategori', 'admin/kategori', '', '4', '1', '2');
INSERT INTO `tbl_menus` VALUES ('7', 'Post', '#', 'fas fa-newspaper', '0', '1', '3');
INSERT INTO `tbl_menus` VALUES ('8', 'Halaman Statis', 'admin/halaman', '', '7', '1', '1');
INSERT INTO `tbl_menus` VALUES ('9', 'Halaman Berita', 'admin/berita', '', '7', '1', '2');
INSERT INTO `tbl_menus` VALUES ('10', 'Video', 'admin/videos', '', '7', '1', '3');
INSERT INTO `tbl_menus` VALUES ('13', 'Data Survei', '#', 'fas fa-poll', '0', '1', '4');
INSERT INTO `tbl_menus` VALUES ('14', 'Show Data Survei', 'admin/survei', '', '13', '1', '1');
INSERT INTO `tbl_menus` VALUES ('15', 'Data Survei', 'admin/datasurvei', '', '13', '1', '2');
INSERT INTO `tbl_menus` VALUES ('20', 'Data Master', '#', 'fas fa-info-circle', '0', '1', '1');
INSERT INTO `tbl_menus` VALUES ('21', 'Kategori Survei', 'admin/kategorisurvei', '', '20', '1', '1');
INSERT INTO `tbl_menus` VALUES ('22', 'Kategori Input', 'admin/kategoriinput', '', '20', '1', '3');
INSERT INTO `tbl_menus` VALUES ('23', 'Nama Survei', 'admin/namasurvei', '', '20', '1', '2');
INSERT INTO `tbl_menus` VALUES ('24', 'Kategori Subinput', 'admin/kategorisubinput', '', '20', '1', '4');

-- ----------------------------
-- Table structure for tbl_menusweb
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menusweb`;
CREATE TABLE `tbl_menusweb` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `_parent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_menusweb
-- ----------------------------
INSERT INTO `tbl_menusweb` VALUES ('1', 'Home', 'fas fa-home', '/', '0', '1', '2020-11-24 23:51:30', null, null);
INSERT INTO `tbl_menusweb` VALUES ('2', 'Profil', 'fas fa-user', '#', '0', '2', '2020-11-24 23:52:31', '2021-01-25 22:43:23', null);
INSERT INTO `tbl_menusweb` VALUES ('3', 'Tentang', 'fas fa-info-circle', '#', '0', '7', '2020-11-24 23:53:10', '2021-01-25 22:43:12', null);
INSERT INTO `tbl_menusweb` VALUES ('4', 'Visi dan Misi', '', '/website/profil/visi-dan-misi', '2', '3', '2020-11-24 23:53:24', '2021-01-25 22:43:25', null);
INSERT INTO `tbl_menusweb` VALUES ('5', 'Tugas dan Fungsi', '', '/website/profil/tugas-dan-fungsi', '2', '4', '2020-11-24 23:55:41', '2021-01-25 22:43:25', null);
INSERT INTO `tbl_menusweb` VALUES ('6', 'Berita', 'fas fa-newspaper', '/website/berita', '0', '5', '2020-11-24 23:57:29', '2020-11-27 16:18:17', null);
INSERT INTO `tbl_menusweb` VALUES ('10', 'Data Statisik', 'fas fa-poll', '/website/statistik', '0', '6', '2020-11-25 02:11:39', '2021-01-25 22:43:12', null);

-- ----------------------------
-- Table structure for tbl_namasurvei
-- ----------------------------
DROP TABLE IF EXISTS `tbl_namasurvei`;
CREATE TABLE `tbl_namasurvei` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_survei` varchar(100) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_namasurvei
-- ----------------------------
INSERT INTO `tbl_namasurvei` VALUES ('2', 'ANGKA PARTISIPASI KASAR(APK) MENURUT JENJANG PENDIDIKAN, JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('3', 'ANGKA PARTISIPASI MURNI(APM) MENURUT JENJANG PENDIDIKAN, JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('4', 'JUMLAH SISWA PUTUS SEKOLAH MENURUT JENIS KELAMIN, JENJANG PENDIDIKAN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('5', 'JUMLAH PEKERJA DI LEMBAGA PEMERINTAHAN MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('6', 'JUMLAH PEKERJA DI LEMBAGA NON PEMERINTAHAN MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA TAHUN');
INSERT INTO `tbl_namasurvei` VALUES ('7', 'JUMLAH PENGANGGURAN TERBUKA MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('8', 'JUMLAH BUPATI/WALIKOTA DAN WAKIL BUPATI/WALIKOTA MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('9', 'JUMLAH CAMAT MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('10', 'JUMLAH KEPALA DESA/LURAH MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('11', 'JUMLAH PEJABAT MENURUT JENIS JABATAN, JENIS KELAMIN, DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('12', 'JUMLAH PNS MENURUT GOLONGAN, JENIS KELAMIN, DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('13', 'JUMLAH ANGGOTA DPRD MENURUT JENIS KELAMIN, DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('14', 'JUMLAH CALON LEGISLATIF DAN PENGURUS HARIAN PARTAI POLITIK MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('15', 'JUMLAH PENGURUS DAN ANGGOTA KAUKUS PEREMPUAN POLITIK MENURUT KABUPATEN/KOTA');
INSERT INTO `tbl_namasurvei` VALUES ('16', 'JUMLAH PEKERJA ANAK(BERUMUR 10-17 TAHUN) MENURUT JENIS KELAMIN DAN KABUPATEN/KOTA');

-- ----------------------------
-- Table structure for tbl_subinput
-- ----------------------------
DROP TABLE IF EXISTS `tbl_subinput`;
CREATE TABLE `tbl_subinput` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `idinput` int(11) NOT NULL,
  `nm_subinput` varchar(150) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_subinput
-- ----------------------------
INSERT INTO `tbl_subinput` VALUES ('1', '1', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('2', '1', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('3', '2', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('4', '2', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('5', '4', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('6', '4', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('7', '5', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('8', '5', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('9', '6', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('10', '6', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('11', '7', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('12', '7', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('13', '8', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('14', '8', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('15', '9', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('16', '9', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('17', '10', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('18', '10', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('19', '11', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('20', '11', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('21', '12', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('22', '12', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('23', '13', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('24', '13', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('25', '14', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('26', '14', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('27', '15', 'Laki - Laki ');
INSERT INTO `tbl_subinput` VALUES ('28', '15', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('29', '16', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('30', '16', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('31', '17', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('32', '17', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('33', '18', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('34', '18', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('35', '23', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('36', '23', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('37', '24', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('38', '24', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('39', '25', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('40', '25', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('41', '26', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('42', '26', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('43', '27', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('44', '27', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('45', '30', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('46', '30', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('47', '31', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('48', '31', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('49', '32', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('50', '32', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('51', '33', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('52', '33', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('53', '36', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('54', '36', 'Perempuan');
INSERT INTO `tbl_subinput` VALUES ('55', '37', 'Laki - Laki');
INSERT INTO `tbl_subinput` VALUES ('56', '37', 'Perempuan');

-- ----------------------------
-- Table structure for tbl_survei
-- ----------------------------
DROP TABLE IF EXISTS `tbl_survei`;
CREATE TABLE `tbl_survei` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `idkategorisurvei` int(11) NOT NULL,
  `idnmsurvei` int(11) NOT NULL,
  `idinput` int(11) NOT NULL,
  `idsubinput` int(11) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tgl_survei` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_survei
-- ----------------------------
INSERT INTO `tbl_survei` VALUES ('1', '2', '2', '1', '1', '100', '2021-02-08', '2021-02-04 00:54:34', null, null);
INSERT INTO `tbl_survei` VALUES ('2', '2', '2', '1', '2', '200', '2021-02-08', '2021-02-04 00:55:58', '2021-02-04 00:56:58', null);
INSERT INTO `tbl_survei` VALUES ('3', '2', '2', '2', '3', '200', '2021-02-08', '2021-02-04 00:57:18', null, null);
INSERT INTO `tbl_survei` VALUES ('4', '2', '2', '2', '4', '300', '2021-02-08', '2021-02-04 00:57:37', null, null);
INSERT INTO `tbl_survei` VALUES ('5', '2', '2', '4', '5', '300', '2021-02-08', '2021-02-04 00:58:31', null, null);
INSERT INTO `tbl_survei` VALUES ('6', '2', '2', '4', '6', '400', '2021-02-08', '2021-02-04 00:58:49', null, null);
INSERT INTO `tbl_survei` VALUES ('7', '2', '3', '5', '7', '300', '2021-02-08', '2021-02-04 00:59:22', null, null);
INSERT INTO `tbl_survei` VALUES ('8', '2', '3', '5', '8', '400', '2021-02-08', '2021-02-04 00:59:40', null, null);
INSERT INTO `tbl_survei` VALUES ('9', '2', '3', '6', '9', '400', '2021-02-08', '2021-02-04 01:00:08', null, null);
INSERT INTO `tbl_survei` VALUES ('10', '2', '3', '6', '10', '400', '2021-02-08', '2021-02-04 01:00:23', null, null);
INSERT INTO `tbl_survei` VALUES ('11', '2', '3', '7', '11', '300', '2021-02-08', '2021-02-04 01:00:45', null, null);
INSERT INTO `tbl_survei` VALUES ('12', '2', '3', '7', '12', '300', '2021-02-08', '2021-02-04 01:01:03', null, null);

-- ----------------------------
-- Table structure for tbl_userlevel
-- ----------------------------
DROP TABLE IF EXISTS `tbl_userlevel`;
CREATE TABLE `tbl_userlevel` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_userlevel
-- ----------------------------
INSERT INTO `tbl_userlevel` VALUES ('1', '1', '1');
INSERT INTO `tbl_userlevel` VALUES ('2', '1', '2');
INSERT INTO `tbl_userlevel` VALUES ('3', '1', '3');
INSERT INTO `tbl_userlevel` VALUES ('4', '1', '4');
INSERT INTO `tbl_userlevel` VALUES ('5', '1', '5');
INSERT INTO `tbl_userlevel` VALUES ('6', '1', '6');
INSERT INTO `tbl_userlevel` VALUES ('7', '1', '7');
INSERT INTO `tbl_userlevel` VALUES ('8', '1', '8');
INSERT INTO `tbl_userlevel` VALUES ('9', '1', '9');
INSERT INTO `tbl_userlevel` VALUES ('10', '1', '10');
INSERT INTO `tbl_userlevel` VALUES ('13', '1', '13');
INSERT INTO `tbl_userlevel` VALUES ('14', '1', '14');
INSERT INTO `tbl_userlevel` VALUES ('15', '2', '13');
INSERT INTO `tbl_userlevel` VALUES ('16', '2', '15');
INSERT INTO `tbl_userlevel` VALUES ('17', '3', '13');
INSERT INTO `tbl_userlevel` VALUES ('18', '3', '15');
INSERT INTO `tbl_userlevel` VALUES ('19', '4', '13');
INSERT INTO `tbl_userlevel` VALUES ('20', '4', '15');
INSERT INTO `tbl_userlevel` VALUES ('23', '1', '20');
INSERT INTO `tbl_userlevel` VALUES ('24', '1', '21');
INSERT INTO `tbl_userlevel` VALUES ('25', '1', '22');
INSERT INTO `tbl_userlevel` VALUES ('26', '1', '23');
INSERT INTO `tbl_userlevel` VALUES ('27', '1', '24');

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0 COMMENT '0 = InAvtive, 1 = Active ',
  `is_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', 'survei@gmail.com', 'muhammad alan', '$2y$04$3BqJhoiFWABfmp8zAR6aJ.kGSzOcaZUT7tx6rtF3KB3uEHcaoXSu.', '083813131178', '', '1', '1', '2020-01-06 15:00:19', '2020-11-24 02:56:39', null);
INSERT INTO `tbl_users` VALUES ('41', 'dikbud', 'dikbud@gmail.com', 'Dinas Pendidikan dan Kebudayaan', '$2y$10$zhUi4jStCKIWaW74d3TC0OK.6t50MNs.in1cs4KP.h7WYvok/qjpC', '0831312321333', '', '1', '2', '2020-12-30 14:02:18', null, null);
INSERT INTO `tbl_users` VALUES ('42', 'discapil', 'discapil@gmail.com', 'Dinas Kependudukan dan Pencatatan Sipil', '$2y$10$PayG40ue66CzQ1rByRA2xOucv79thiVghLNsXDoOvQLdpq5uo5xr2', '0873213122111', '', '1', '3', '2020-12-30 14:03:02', null, null);
INSERT INTO `tbl_users` VALUES ('43', 'disnaker', 'disnaker@gmail.com', 'Dinas Ketenagakerjaan dan Transmigrasi', '$2y$10$GzmCS.3AgpEiS5YGCTBMoOaEW2pL0KlkxByX6zHv/X.CP1xkFHb6S', '0813121112331', '', '1', '4', '2020-12-30 14:03:42', '2020-12-30 14:04:53', null);

-- ----------------------------
-- Table structure for tbl_videos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_videos`;
CREATE TABLE `tbl_videos` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_videos
-- ----------------------------
INSERT INTO `tbl_videos` VALUES ('6', 'test', 'InViUI45UlE', '2020-12-31 00:17:40', null, null);
