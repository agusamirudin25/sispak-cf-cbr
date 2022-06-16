/*
 Navicat Premium Data Transfer

 Source Server         : kominfo
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : db_sispak_cf

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 17/06/2022 02:01:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_bobot
-- ----------------------------
DROP TABLE IF EXISTS `tb_bobot`;
CREATE TABLE `tb_bobot`  (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_bobot`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_bobot
-- ----------------------------
INSERT INTO `tb_bobot` VALUES (1, 'Tidak', '0');
INSERT INTO `tb_bobot` VALUES (2, 'Tidak Tahu', '0.2');
INSERT INTO `tb_bobot` VALUES (3, 'Sedikit Yakin', '0.4');
INSERT INTO `tb_bobot` VALUES (4, 'Cukup Yakin', '0.6');
INSERT INTO `tb_bobot` VALUES (5, 'Yakin', '0.8');
INSERT INTO `tb_bobot` VALUES (6, 'Sangat Yakin', '1');

-- ----------------------------
-- Table structure for tb_diagnosis
-- ----------------------------
DROP TABLE IF EXISTS `tb_diagnosis`;
CREATE TABLE `tb_diagnosis`  (
  `id_diagnosis` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `data_gejala` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kerusakan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai_cf` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai_cbr` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_diagnosis`) USING BTREE,
  INDEX `email`(`username`) USING BTREE,
  INDEX `kerusakan`(`kerusakan`) USING BTREE,
  CONSTRAINT `email` FOREIGN KEY (`username`) REFERENCES `tb_pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kerusakan` FOREIGN KEY (`kerusakan`) REFERENCES `tb_kerusakan` (`id_kerusakan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_diagnosis
-- ----------------------------
INSERT INTO `tb_diagnosis` VALUES (1, 'maulana', '[\"G01\",\"G02\",\"G03\",\"G04\",\"G05\"]', 'K01', '0.850299904', '0.6', '2022-05-22 04:45:25');
INSERT INTO `tb_diagnosis` VALUES (2, 'maulana', '[\"G01\",\"G02\",\"G03\",\"G04\"]', 'K01', '0.616', '0.6', '2022-06-07 01:44:49');
INSERT INTO `tb_diagnosis` VALUES (3, 'maulana', '[\"G01\",\"G02\",\"G03\",\"G04\",\"G05\",\"G07\"]', 'K01', '1', '0.6', '2022-06-17 01:59:40');

-- ----------------------------
-- Table structure for tb_gejala
-- ----------------------------
DROP TABLE IF EXISTS `tb_gejala`;
CREATE TABLE `tb_gejala`  (
  `id_gejala` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gejala` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_gejala`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_gejala
-- ----------------------------
INSERT INTO `tb_gejala` VALUES ('G01', 'Bahan bakar boros\r\n', 1, '2022-05-15 01:09:19', '2022-05-15 01:09:22');
INSERT INTO `tb_gejala` VALUES ('G02', 'Mesin tersendat-sendat', 1, '2022-05-15 01:18:46', '2022-05-15 01:19:11');
INSERT INTO `tb_gejala` VALUES ('G03', 'Idling mesin buruk', 1, '2022-05-15 01:19:34', '2022-05-15 01:19:51');
INSERT INTO `tb_gejala` VALUES ('G04', 'Akselerasi buruk', 1, '2022-05-15 01:20:28', '2022-05-15 01:23:21');
INSERT INTO `tb_gejala` VALUES ('G05', 'Mesin susah hidup', 1, '2022-05-20 17:39:13', NULL);
INSERT INTO `tb_gejala` VALUES ('G06', 'Temperatur mesin tidak normal', 1, '2022-05-20 17:39:25', NULL);
INSERT INTO `tb_gejala` VALUES ('G07', 'Uap air menyembur kelaur radiator', 1, '2022-05-20 17:39:34', NULL);
INSERT INTO `tb_gejala` VALUES ('G08', 'Oli bercampur dengan air', 1, '2022-05-20 17:39:46', NULL);
INSERT INTO `tb_gejala` VALUES ('G09', 'Suara mesin knocking', 1, '2022-05-20 17:39:55', NULL);
INSERT INTO `tb_gejala` VALUES ('G10', 'Mesin mogok', 1, '2022-05-20 17:40:06', '2022-05-20 17:40:41');
INSERT INTO `tb_gejala` VALUES ('G11', 'Tarikan mesin lemah', 1, '2022-05-20 17:41:02', NULL);
INSERT INTO `tb_gejala` VALUES ('G12', 'Oli mesin berkurang', 1, '2022-05-20 17:41:30', NULL);
INSERT INTO `tb_gejala` VALUES ('G13', 'Mesin mengeluarkan asap', 1, '2022-05-20 17:42:22', NULL);
INSERT INTO `tb_gejala` VALUES ('G14', 'Lampu hidup terus', 1, '2022-05-20 17:42:44', NULL);
INSERT INTO `tb_gejala` VALUES ('G15', 'Mesin tidak dapat berputar', 1, '2022-05-20 17:43:04', NULL);
INSERT INTO `tb_gejala` VALUES ('G16', 'Suara mesin kasar', 1, '2022-05-20 17:43:39', NULL);
INSERT INTO `tb_gejala` VALUES ('G17', 'Mesin Overheat', 1, '2022-05-20 17:47:49', NULL);
INSERT INTO `tb_gejala` VALUES ('G18', 'Mesin tidak bisa hidup', 1, '2022-05-20 17:48:07', NULL);
INSERT INTO `tb_gejala` VALUES ('G19', 'Air radiator berkurang', 1, '2022-05-20 17:48:19', NULL);
INSERT INTO `tb_gejala` VALUES ('G20', 'Putaran mesin tidak sinkron', 1, '2022-05-30 16:12:33', NULL);
INSERT INTO `tb_gejala` VALUES ('G21', 'Gigi tidak mau masuk', 1, '2022-05-20 17:49:21', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G22', 'Gigi tidak berpindah', 1, '2022-05-20 17:49:27', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G23', 'Putaran mesin berisik', 1, '2022-05-20 17:49:29', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G24', 'Mesin tidak bisa disetel rendah', 1, '2022-05-20 17:49:31', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G25', 'Kecepatan mobil tertahan dikecepatan tertentu', 1, '2022-05-20 17:49:34', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G26', 'Perpindahan gigi lambat', 1, '2022-05-20 17:49:38', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G27', 'Perpindahan gigi kasar', 1, '2022-05-20 17:49:41', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G28', 'Gigi sudah masuk, ketika gigi sudah masuk, mobil tersebut loncat', 1, '2022-05-20 17:49:43', '2022-05-20 17:50:15');
INSERT INTO `tb_gejala` VALUES ('G29', 'Mobil tidak ada power', 1, '2022-05-20 17:49:45', '2022-05-20 17:50:15');

-- ----------------------------
-- Table structure for tb_jawaban_konsultasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_jawaban_konsultasi`;
CREATE TABLE `tb_jawaban_konsultasi`  (
  `id_jawaban_konsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_konsultasi` int(11) NULL DEFAULT NULL,
  `jawaban` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pakar` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_jawaban_konsultasi`) USING BTREE,
  INDEX `id_kon`(`id_konsultasi`) USING BTREE,
  CONSTRAINT `id_kon` FOREIGN KEY (`id_konsultasi`) REFERENCES `tb_konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_kasus_baru
-- ----------------------------
DROP TABLE IF EXISTS `tb_kasus_baru`;
CREATE TABLE `tb_kasus_baru`  (
  `id_kasus_baru` int(11) NOT NULL AUTO_INCREMENT,
  `kode_gejala` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kasus_baru`) USING BTREE,
  INDEX `kd_gejala`(`kode_gejala`) USING BTREE,
  CONSTRAINT `kd_gejala` FOREIGN KEY (`kode_gejala`) REFERENCES `tb_gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_kasus_baru
-- ----------------------------
INSERT INTO `tb_kasus_baru` VALUES (1, 'G02');
INSERT INTO `tb_kasus_baru` VALUES (2, 'G05');
INSERT INTO `tb_kasus_baru` VALUES (3, 'G16');
INSERT INTO `tb_kasus_baru` VALUES (4, 'G17');
INSERT INTO `tb_kasus_baru` VALUES (5, 'G21');

-- ----------------------------
-- Table structure for tb_kerusakan
-- ----------------------------
DROP TABLE IF EXISTS `tb_kerusakan`;
CREATE TABLE `tb_kerusakan`  (
  `id_kerusakan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kerusakan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `solusi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alat` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_kerusakan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_kerusakan
-- ----------------------------
INSERT INTO `tb_kerusakan` VALUES ('K01', 'Busi', 'Ganti busi yang sudah tidak bisa dipakai lagi, lalu diganti dengan yang baru dan sesuaikan untuk mobil yang sedang diperbaiki.', 'Kunci busi, kunci pas 10.', NULL, 1, '2022-05-15 00:15:17', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K02', 'Radiator', 'Cek kondisi kelayakan karet tutup radiator, jika terlepas rusak atau bocor maka harus ganti tutup radiator.', 'Tang jepit, kunci 10, kunci 12, obeng plat/min.', NULL, 1, '2022-05-15 00:57:04', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K03', 'Pompa bahan bakar', 'Dilakukan pergantian pompa bahan bakar agar mobil kembali dalam kondisi yang prima (Sangat baik).', 'Obeng plat/min, kunci 10, kunci 12.', NULL, 1, '2022-05-15 01:03:08', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K04', 'Ring piston', 'Terlebih dahulu ukur diameter silinder, selanjutnya cek ringpiston terhadap silinder, sekira nya kerusakan tersebut sudah diluar toleransi maka ganti ring sealer sesuai dengan ukuran diameter.', 'Obeng plat/min, kunci 10, kunci 12, kunci 14, kunci torsi.', NULL, 1, '2022-05-15 01:03:21', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K05', 'Waterpump', 'Dilakukannya pergantian waterpump, jika waterpump tidak bisa diperbaiki secara komponen beda dengan dinamo di riper, untuk semua komponen nya mati tidak bisa di bongkar jadi harus di ganti.', 'Tang, kunci 10, kunci 12.', NULL, 1, '2022-05-15 01:03:29', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K06', 'Thermostat', 'Cek kondisi thermostat, jika benda tersebut macet tidak bisa buka tutp, maka yang terjadi mampet tidak mengalir, thermostat dilepas lalu diganti dengan yang baru.', 'Tang, kunci 10, kunci 12.', NULL, 1, '2022-05-15 01:03:39', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K07', 'Plat kopling', 'Dilakukan nya pergantian, karena itu kampas rem sudah haus.', 'Tang, obeng +-, kunci 10, kunci 12, kunci 14, kunci 17.', NULL, 1, '2022-05-15 01:03:48', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K08', 'Selenoid valve', 'Jika selenoid valve sudah rusak, maka perlu diganti dengan yang baru.', 'Kunci 10.', NULL, 1, '2022-05-15 01:04:02', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K09', 'Speed sensor', 'Speed sensor merupakan alat baca, ketika speed sensor salah baca, atau salah data atau speed nya rusak maka perlu di ganti dengan yang baru.', 'Kunci 10.', NULL, 1, '2022-05-15 01:04:08', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K10', 'Body Valve', 'Jika Frame valve nya kotor maka harus di bersihkan dan ganti oli yang baru.', 'Kunci 10', NULL, 1, '2022-05-15 01:04:14', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K11', 'Seal hidrolik', 'Jika karet seal hidrolik sudah tidak bisa di pakai maka harus diganti.', 'Obeng +-, tang, kunci 8, kunci 10, kunci 12, kunci 14, kunci 15, kunci 16, kunci 17.', NULL, 1, '2022-05-15 01:04:45', '2022-05-20 17:51:58');
INSERT INTO `tb_kerusakan` VALUES ('K12', 'Torque converter', 'Jika torque converter rusak maka harus di ganti dengan yang baru.', 'Obeng +-, tang, kunci 8, kunci 10, kunci 12, kunci 14, kunci 15, kunci 16, kunci 17.', NULL, 1, '2022-05-15 01:04:59', '2022-05-20 17:51:58');

-- ----------------------------
-- Table structure for tb_konsultasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_konsultasi`;
CREATE TABLE `tb_konsultasi`  (
  `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pertanyaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_konsultasi`) USING BTREE,
  INDEX `email_pengguna`(`username`) USING BTREE,
  CONSTRAINT `email_pengguna` FOREIGN KEY (`username`) REFERENCES `tb_pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_pengetahuan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengetahuan`;
CREATE TABLE `tb_pengetahuan`  (
  `id_pengetahuan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_gejala` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_kerusakan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bobot` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_pengetahuan`) USING BTREE,
  INDEX `kd_gjl`(`kode_gejala`) USING BTREE,
  INDEX `kd_krs`(`kode_kerusakan`) USING BTREE,
  CONSTRAINT `kd_gjl` FOREIGN KEY (`kode_gejala`) REFERENCES `tb_gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kd_krs` FOREIGN KEY (`kode_kerusakan`) REFERENCES `tb_kerusakan` (`id_kerusakan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pengetahuan
-- ----------------------------
INSERT INTO `tb_pengetahuan` VALUES (1, 'G01', 'K01', '0.2', '2022-05-15 11:41:12');
INSERT INTO `tb_pengetahuan` VALUES (2, 'G02', 'K01', '1', '2022-05-15 12:29:17');
INSERT INTO `tb_pengetahuan` VALUES (3, 'G03', 'K01', '0.4', '2022-05-20 17:57:20');
INSERT INTO `tb_pengetahuan` VALUES (4, 'G04', 'K01', '0.6', '2022-05-20 17:57:26');
INSERT INTO `tb_pengetahuan` VALUES (5, 'G05', 'K01', '0.8', '2022-05-20 17:57:50');
INSERT INTO `tb_pengetahuan` VALUES (6, 'G02', 'K02', '0.8', '2022-05-20 17:58:13');
INSERT INTO `tb_pengetahuan` VALUES (7, 'G06', 'K02', '1', '2022-05-20 17:58:34');
INSERT INTO `tb_pengetahuan` VALUES (8, 'G07', 'K02', '0.6', '2022-05-20 17:58:35');
INSERT INTO `tb_pengetahuan` VALUES (9, 'G08', 'K02', '0.2', '2022-05-20 17:58:37');
INSERT INTO `tb_pengetahuan` VALUES (10, 'G09', 'K02', '0.4', '2022-05-20 17:58:40');
INSERT INTO `tb_pengetahuan` VALUES (11, 'G02', 'K03', '0.8', '2022-05-21 14:17:55');
INSERT INTO `tb_pengetahuan` VALUES (12, 'G05', 'K03', '0.6', '2022-05-21 14:17:57');
INSERT INTO `tb_pengetahuan` VALUES (13, 'G10', 'K03', '0.4', '2022-05-21 14:18:00');
INSERT INTO `tb_pengetahuan` VALUES (14, 'G11', 'K03', '0.2', '2022-05-21 14:18:02');
INSERT INTO `tb_pengetahuan` VALUES (15, 'G12', 'K04', '1', '2022-05-21 14:18:58');
INSERT INTO `tb_pengetahuan` VALUES (16, 'G13', 'K04', '0.4', '2022-05-21 14:19:00');
INSERT INTO `tb_pengetahuan` VALUES (17, 'G14', 'K04', '0.8', '2022-05-21 14:19:02');
INSERT INTO `tb_pengetahuan` VALUES (18, 'G15', 'K04', '0.6', '2022-05-21 14:19:03');
INSERT INTO `tb_pengetahuan` VALUES (19, 'G16', 'K04', '0.2', '2022-05-21 14:19:04');
INSERT INTO `tb_pengetahuan` VALUES (20, 'G16', 'K05', '0.8', '2022-05-21 14:19:38');
INSERT INTO `tb_pengetahuan` VALUES (21, 'G17', 'K05', '0.4', '2022-05-21 14:19:40');
INSERT INTO `tb_pengetahuan` VALUES (22, 'G18', 'K05', '0.6', '2022-05-21 14:19:41');
INSERT INTO `tb_pengetahuan` VALUES (23, 'G16', 'K06', '0.8', '2022-05-21 14:19:42');
INSERT INTO `tb_pengetahuan` VALUES (24, 'G17', 'K06', '0.4', '2022-05-21 14:19:44');
INSERT INTO `tb_pengetahuan` VALUES (25, 'G18', 'K06', '0.6', '2022-05-21 14:20:40');
INSERT INTO `tb_pengetahuan` VALUES (26, 'G19', 'K06', '0.2', '2022-05-21 14:20:42');
INSERT INTO `tb_pengetahuan` VALUES (27, 'G20', 'K07', '0.8', '2022-05-21 14:21:08');
INSERT INTO `tb_pengetahuan` VALUES (28, 'G21', 'K07', '1', '2022-05-21 14:21:10');
INSERT INTO `tb_pengetahuan` VALUES (29, 'G21', 'K08', '1', '2022-05-21 14:21:30');
INSERT INTO `tb_pengetahuan` VALUES (30, 'G22', 'K08', '0.6', '2022-05-21 14:21:33');
INSERT INTO `tb_pengetahuan` VALUES (31, 'G22', 'K09', '1', '2022-05-21 14:22:07');
INSERT INTO `tb_pengetahuan` VALUES (32, 'G25', 'K09', '0.2', '2022-05-21 14:22:08');
INSERT INTO `tb_pengetahuan` VALUES (33, 'G26', 'K10', '0.6', '2022-05-21 14:22:43');
INSERT INTO `tb_pengetahuan` VALUES (34, 'G27', 'K10', '1', '2022-05-21 14:22:44');
INSERT INTO `tb_pengetahuan` VALUES (35, 'G21', 'K11', '0.8', '2022-05-21 14:23:03');
INSERT INTO `tb_pengetahuan` VALUES (36, 'G28', 'K11', '0.6', '2022-05-21 14:23:05');
INSERT INTO `tb_pengetahuan` VALUES (37, 'G21', 'K12', '0.6', '2022-05-21 14:23:06');
INSERT INTO `tb_pengetahuan` VALUES (38, 'G29', 'K12', '0.8', '2022-05-21 14:23:08');
INSERT INTO `tb_pengetahuan` VALUES (43, 'G01', 'K03', '0', '2022-06-03 00:02:09');

-- ----------------------------
-- Table structure for tb_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengguna`;
CREATE TABLE `tb_pengguna`  (
  `username` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` int(2) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`username`) USING BTREE,
  INDEX `role`(`tipe`) USING BTREE,
  CONSTRAINT `role` FOREIGN KEY (`tipe`) REFERENCES `tb_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pengguna
-- ----------------------------
INSERT INTO `tb_pengguna` VALUES ('admin', 'Admin', '$2y$10$XcQledQ4ovCMMMOBNgvc7ehUoRV1Q./NsS9QtTL4oFuTd1t3Rr.6m', 1, 1, '2022-04-14 13:29:33', '2022-06-17 01:45:28');
INSERT INTO `tb_pengguna` VALUES ('astuti', 'Astuti', '$2y$10$KhBqSHmFmwMhVH5wv.KWzOnGTwvJYb79djJYzM//SL1aRRtszOcB2', 3, 1, '2022-06-17 01:46:57', NULL);
INSERT INTO `tb_pengguna` VALUES ('maman', 'Maman Abdurahman', '$2y$10$VWxrG0kN.VkLvF5Lf9kEF./vSovNRYbnBZTWW3nhKioaLWp3Unhmi', 2, 1, '2022-05-22 03:24:41', '2022-06-17 01:45:33');
INSERT INTO `tb_pengguna` VALUES ('maulana', 'Maulanas', '$2y$10$2Cgk1ryQhuD6LGtxyIVwWO4lWLWCGccCt63iWmaX9DPyNmI.feyKC', 3, 1, '2022-05-22 03:52:28', '2022-06-17 01:45:36');

-- ----------------------------
-- Table structure for tb_role
-- ----------------------------
DROP TABLE IF EXISTS `tb_role`;
CREATE TABLE `tb_role`  (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_role
-- ----------------------------
INSERT INTO `tb_role` VALUES (1, 'Admin', '2022-05-15 03:21:05');
INSERT INTO `tb_role` VALUES (2, 'Pakar', '2022-05-15 03:22:25');
INSERT INTO `tb_role` VALUES (3, 'Customer', '2022-05-15 03:22:29');

SET FOREIGN_KEY_CHECKS = 1;
