/*
 Navicat Premium Data Transfer

 Source Server         : localMysql
 Source Server Type    : MySQL
 Source Server Version : 80034
 Source Host           : localhost:3306
 Source Schema         : koperasi

 Target Server Type    : MySQL
 Target Server Version : 80034
 File Encoding         : 65001

 Date: 09/08/2024 21:10:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mt_anggota
-- ----------------------------
DROP TABLE IF EXISTS `mt_anggota`;
CREATE TABLE `mt_anggota`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  `jenis_kelamin` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `no_anggota`(`no_anggota`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mt_anggota
-- ----------------------------
INSERT INTO `mt_anggota` VALUES (9, '24070001', 'Arif', '3515132708910003', 'arifbudiarti.08@gmail.com', NULL, 'KETEGAN RT 03 RW 01 TAMAN', 1, '2024-07-27 22:26:53', NULL, '2024-07-27 22:26:53', NULL, NULL, NULL, 1);
INSERT INTO `mt_anggota` VALUES (12, '24070002', 'Dina', '3515132708910010', 'dina@gmail.com', '0888050356364', 'Surabaya', 1, '2024-07-28 13:21:26', NULL, '2024-07-28 13:21:26', NULL, NULL, NULL, 2);
INSERT INTO `mt_anggota` VALUES (13, '24070003', 'admin2', '3515132708910004', 'admin@admin.com', '082356598626', 'Surabaya', 1, '2024-07-30 10:30:08', 3, '2024-07-30 10:39:38', 3, NULL, NULL, 1);
INSERT INTO `mt_anggota` VALUES (14, '24070004', 'test', '3573052503650005', 'sura@hgmail.com', '083561353232323', 'Surabaya', 1, '2024-07-30 10:32:12', 3, '2024-07-30 10:36:37', 3, '2024-07-30 10:36:37', 3, 2);
INSERT INTO `mt_anggota` VALUES (15, '24070005', 'Adminsaja', '3507146909990004', 'admin@gmail.com', '081353598959', 'Malang', 1, '2024-07-30 11:06:01', NULL, '2024-07-30 11:06:01', NULL, NULL, NULL, 1);
INSERT INTO `mt_anggota` VALUES (16, '24070006', 'Admin baru', '3573052503650005', 'admin@gmail.com', '0888050356364', 'Surabaya', 1, '2024-07-30 11:15:44', NULL, '2024-07-30 11:15:44', NULL, NULL, NULL, NULL);
INSERT INTO `mt_anggota` VALUES (17, '24070007', 'User', '028', 'user@gmail.com', '08353568326586', 'Malang', 1, '2024-07-30 15:11:12', NULL, '2024-07-30 15:11:12', NULL, NULL, NULL, NULL);
INSERT INTO `mt_anggota` VALUES (18, '24080008', 'Meika Fatimah', '3515132708910010', 'meika@gmail.com', '085720027080', 'Sidoarjo', 1, '2024-08-09 19:56:02', NULL, '2024-08-09 19:56:02', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mt_petugas
-- ----------------------------
DROP TABLE IF EXISTS `mt_petugas`;
CREATE TABLE `mt_petugas`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tmt` datetime(0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_anggota`(`id_anggota`) USING BTREE,
  CONSTRAINT `mt_petugas_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `mt_anggota` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mt_petugas
-- ----------------------------
INSERT INTO `mt_petugas` VALUES (1, 9, 'KSP924070001', '2024-07-01 00:00:00', 1, '2024-07-30 11:00:12', 3, '2024-07-30 11:04:10', 3, NULL, NULL);
INSERT INTO `mt_petugas` VALUES (2, 13, 'KSP1324070002', '2024-07-30 00:00:00', 1, '2024-07-30 11:04:23', 3, '2024-07-30 11:04:49', 3, '2024-07-30 11:04:49', 3);

-- ----------------------------
-- Table structure for mt_users
-- ----------------------------
DROP TABLE IF EXISTS `mt_users`;
CREATE TABLE `mt_users`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_anggota`(`id_anggota`) USING BTREE,
  CONSTRAINT `mt_users_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `mt_anggota` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mt_users
-- ----------------------------
INSERT INTO `mt_users` VALUES (3, 9, 'arif', '$2y$10$j6c6RYqNCaMfopGuVTXo5upz0jnGStfhv9kis9hlTOZqOebEEGOU.', 1, '2024-07-27 22:26:53', NULL, '2024-07-27 22:26:53', NULL, NULL, NULL);
INSERT INTO `mt_users` VALUES (4, 12, 'dina', '$2y$10$3TAganwiFwR/n6YbqPOAY.zCV.6gw8C1we2KWaK3HUelRtJ00TTf6', 1, '2024-07-28 13:21:26', NULL, '2024-07-28 13:21:26', NULL, NULL, NULL);
INSERT INTO `mt_users` VALUES (5, 9, 'arif2', '12345', 1, '2024-07-30 09:28:15', 3, '2024-07-30 09:31:00', 3, '2024-07-30 09:31:00', 3);
INSERT INTO `mt_users` VALUES (6, 15, 'adminmalang', '$2y$10$t9HuTF7O8HVGrzOCbf145uPws4ONmL5KMNGib9gMdD5B1dywSfgru', 1, '2024-07-30 11:06:01', NULL, '2024-07-30 11:06:01', NULL, NULL, NULL);
INSERT INTO `mt_users` VALUES (7, 16, 'adminbaru', '$2y$10$Rn4n4Kq9PxwoEhMvOY5INO2s77MFq5zdntQw7BWp6UMV5hRqxNFWi', 1, '2024-07-30 11:15:45', NULL, '2024-07-30 11:15:45', NULL, NULL, NULL);
INSERT INTO `mt_users` VALUES (8, 17, 'usercoba', '$2y$10$EyZAu9zLdrtD2UxrzKg97uznNGxtL2GHoZ7wQaQ3VTib22LU4tBMe', 1, '2024-07-30 15:11:12', NULL, '2024-07-30 15:11:12', NULL, NULL, NULL);
INSERT INTO `mt_users` VALUES (9, 18, 'meika', '$2y$10$be4jnBNXTflOgo1uIcZHBOMUD3qtcMm6eFSQaZlDrspwKjT6q1o9q', 1, '2024-08-09 19:56:02', NULL, '2024-08-09 19:56:02', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tc_bayar
-- ----------------------------
DROP TABLE IF EXISTS `tc_bayar`;
CREATE TABLE `tc_bayar`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `id_pinjam` int(0) NULL DEFAULT NULL,
  `kredit` int(0) NULL DEFAULT NULL,
  `nominal` decimal(10, 0) NULL DEFAULT NULL,
  `saldo` decimal(10, 0) NULL DEFAULT NULL,
  `sisa` decimal(10, 0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  `tgl_pembayaran` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tc_bayar
-- ----------------------------
INSERT INTO `tc_bayar` VALUES (1, 18, 3, 1, 229167, 229167, 5270833, 1, '2024-08-09 20:32:06', NULL, '2024-08-09 20:32:06', NULL, NULL, NULL, '2024-08-09 00:00:00');
INSERT INTO `tc_bayar` VALUES (6, 18, 3, 2, 5270833, 5270833, 229167, 1, '2024-08-09 20:53:38', NULL, '2024-08-09 20:53:38', NULL, NULL, NULL, '2024-08-09 00:00:00');

-- ----------------------------
-- Table structure for tc_pinjam
-- ----------------------------
DROP TABLE IF EXISTS `tc_pinjam`;
CREATE TABLE `tc_pinjam`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `tgl_peminjaman` datetime(0) NULL DEFAULT NULL,
  `kredit` int(0) NULL DEFAULT NULL,
  `bunga` double NULL DEFAULT NULL,
  `pokok_cicilan` decimal(10, 0) NULL DEFAULT NULL,
  `pokok_bunga` decimal(10, 0) NULL DEFAULT NULL,
  `pokok_peminjaman` decimal(10, 0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT 1 COMMENT '1: aktif;0:batal;2:selesai',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  `total_cicilan` decimal(10, 0) NULL DEFAULT NULL,
  `total_peminjaman` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tc_pinjam
-- ----------------------------
INSERT INTO `tc_pinjam` VALUES (1, 17, '2024-07-30 00:00:00', 24, 5, 416667, 41667, 10000000, 1, '2024-07-30 15:11:37', 8, '2024-07-30 15:17:52', 3, NULL, NULL, 458333, 11000000);
INSERT INTO `tc_pinjam` VALUES (2, 12, '2024-08-02 00:00:00', 24, 5, 416667, 41667, 10000000, 99, '2024-08-02 20:38:30', 4, '2024-08-09 20:54:48', 3, NULL, NULL, 458333, 11000000);
INSERT INTO `tc_pinjam` VALUES (3, 18, '2024-08-01 00:00:00', 24, 5, 208333, 20833, 5000000, 1, '2024-08-09 20:29:25', 9, '2024-08-09 20:30:44', 3, NULL, NULL, 229167, 5500000);

-- ----------------------------
-- Table structure for tc_simpan
-- ----------------------------
DROP TABLE IF EXISTS `tc_simpan`;
CREATE TABLE `tc_simpan`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `tgl_transaksi` datetime(0) NULL DEFAULT NULL,
  `nominal` decimal(10, 0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_id` int(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for v_bayar
-- ----------------------------
DROP VIEW IF EXISTS `v_bayar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_bayar` AS select `tc_bayar`.`id` AS `id`,`tc_bayar`.`id_anggota` AS `id_anggota`,`tc_bayar`.`id_pinjam` AS `id_pinjam`,`tc_bayar`.`kredit` AS `kredit`,`tc_bayar`.`nominal` AS `nominal`,`tc_bayar`.`saldo` AS `saldo`,`tc_bayar`.`sisa` AS `sisa`,`tc_bayar`.`status` AS `status`,`tc_bayar`.`created_at` AS `created_at`,`tc_bayar`.`created_by` AS `created_by`,`tc_bayar`.`updated_at` AS `updated_at`,`tc_bayar`.`updated_id` AS `updated_id`,`tc_bayar`.`deleted_at` AS `deleted_at`,`tc_bayar`.`deleted_id` AS `deleted_id`,`tc_bayar`.`tgl_pembayaran` AS `tgl_pembayaran`,`mt_anggota`.`nama` AS `nama`,`mt_anggota`.`nik` AS `nik`,`mt_anggota`.`no_anggota` AS `no_anggota`,`mt_anggota`.`email` AS `email`,`mt_anggota`.`no_hp` AS `no_hp`,`mt_anggota`.`jenis_kelamin` AS `jenis_kelamin`,`mt_anggota`.`alamat` AS `alamat` from ((`tc_bayar` join `mt_anggota` on((`tc_bayar`.`id_anggota` = `mt_anggota`.`id`))) join `tc_pinjam` on((`tc_bayar`.`id_pinjam` = `tc_pinjam`.`id`)));

-- ----------------------------
-- View structure for v_petugas
-- ----------------------------
DROP VIEW IF EXISTS `v_petugas`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_petugas` AS select `mt_petugas`.`id` AS `id`,`mt_petugas`.`id_anggota` AS `id_anggota`,`mt_petugas`.`nip` AS `nip`,`mt_petugas`.`tmt` AS `tmt`,`mt_petugas`.`status` AS `status`,`mt_petugas`.`created_at` AS `created_at`,`mt_petugas`.`created_by` AS `created_by`,`mt_petugas`.`updated_at` AS `updated_at`,`mt_petugas`.`updated_id` AS `updated_id`,`mt_petugas`.`deleted_at` AS `deleted_at`,`mt_petugas`.`deleted_id` AS `deleted_id`,`mt_anggota`.`no_anggota` AS `no_anggota`,`mt_anggota`.`nama` AS `nama`,`mt_anggota`.`nik` AS `nik`,`mt_anggota`.`email` AS `email`,`mt_anggota`.`alamat` AS `alamat`,`mt_anggota`.`jenis_kelamin` AS `jenis_kelamin` from (`mt_petugas` join `mt_anggota` on((`mt_petugas`.`id_anggota` = `mt_anggota`.`id`))) where ((`mt_petugas`.`deleted_at` is null) and (`mt_petugas`.`status` = 1));

-- ----------------------------
-- View structure for v_pinjam
-- ----------------------------
DROP VIEW IF EXISTS `v_pinjam`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pinjam` AS select `b`.`no_anggota` AS `no_anggota`,`b`.`nama` AS `nama`,`b`.`alamat` AS `alamat`,`b`.`no_hp` AS `no_hp`,`a`.`id` AS `id`,`a`.`id_anggota` AS `id_anggota`,`a`.`tgl_peminjaman` AS `tgl_peminjaman`,`a`.`kredit` AS `kredit`,`a`.`bunga` AS `bunga`,`a`.`pokok_cicilan` AS `pokok_cicilan`,`a`.`pokok_bunga` AS `pokok_bunga`,`a`.`pokok_peminjaman` AS `pokok_peminjaman`,`a`.`status` AS `status`,`a`.`created_at` AS `created_at`,`a`.`created_by` AS `created_by`,`a`.`updated_at` AS `updated_at`,`a`.`updated_id` AS `updated_id`,`a`.`deleted_at` AS `deleted_at`,`a`.`deleted_id` AS `deleted_id`,`a`.`total_cicilan` AS `total_cicilan`,`a`.`total_peminjaman` AS `total_peminjaman` from (`tc_pinjam` `a` join `mt_anggota` `b` on((`a`.`id_anggota` = `b`.`id`))) order by `a`.`id`;

-- ----------------------------
-- View structure for v_simpan
-- ----------------------------
DROP VIEW IF EXISTS `v_simpan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_simpan` AS select `b`.`id` AS `id`,`b`.`no_anggota` AS `no_anggota`,`b`.`nama` AS `nama`,`b`.`alamat` AS `alamat`,`b`.`no_hp` AS `no_hp`,sum((case when ((`a`.`status` = 1) and (`a`.`deleted_at` is null)) then `a`.`nominal` else 0 end)) AS `saldo` from (`tc_simpan` `a` join `mt_anggota` `b` on((`a`.`id_anggota` = `b`.`id`))) group by `b`.`id`,`b`.`nama`,`b`.`alamat`,`b`.`no_hp`;

-- ----------------------------
-- View structure for v_user
-- ----------------------------
DROP VIEW IF EXISTS `v_user`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_user` AS select `mt_users`.`id` AS `id`,`mt_users`.`id_anggota` AS `id_anggota`,`mt_users`.`username` AS `username`,`mt_users`.`password` AS `password`,`mt_users`.`status` AS `status`,`mt_users`.`created_at` AS `created_at`,`mt_users`.`created_by` AS `created_by`,`mt_users`.`updated_at` AS `updated_at`,`mt_users`.`updated_id` AS `updated_id`,`mt_users`.`deleted_at` AS `deleted_at`,`mt_users`.`deleted_id` AS `deleted_id`,`mt_anggota`.`nama` AS `nama`,`mt_anggota`.`no_anggota` AS `no_anggota`,`mt_anggota`.`email` AS `email`,`mt_anggota`.`jenis_kelamin` AS `jenis_kelamin` from (`mt_users` join `mt_anggota` on((`mt_users`.`id_anggota` = `mt_anggota`.`id`))) where ((`mt_users`.`deleted_at` is null) and (`mt_users`.`status` = 1));

SET FOREIGN_KEY_CHECKS = 1;
