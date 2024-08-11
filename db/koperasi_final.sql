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

 Date: 30/07/2024 16:01:59
*/

SET NAMES latin1;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mt_anggota
-- ----------------------------
DROP TABLE IF EXISTS `mt_anggota`;
CREATE TABLE `mt_anggota`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mt_petugas
-- ----------------------------
DROP TABLE IF EXISTS `mt_petugas`;
CREATE TABLE `mt_petugas`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mt_users
-- ----------------------------
DROP TABLE IF EXISTS `mt_users`;
CREATE TABLE `mt_users`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(0) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for v_bayar
-- ----------------------------
DROP VIEW IF EXISTS `v_bayar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_bayar` AS select `tc_bayar`.`id` AS `id`,`tc_bayar`.`id_anggota` AS `id_anggota`,`tc_bayar`.`id_pinjam` AS `id_pinjam`,`tc_bayar`.`kredit` AS `kredit`,`tc_bayar`.`nominal` AS `nominal`,`tc_bayar`.`saldo` AS `saldo`,`tc_bayar`.`sisa` AS `sisa`,`tc_bayar`.`status` AS `status`,`tc_bayar`.`created_at` AS `created_at`,`tc_bayar`.`created_by` AS `created_by`,`tc_bayar`.`updated_at` AS `updated_at`,`tc_bayar`.`updated_id` AS `updated_id`,`tc_bayar`.`deleted_at` AS `deleted_at`,`tc_bayar`.`deleted_id` AS `deleted_id`,`tc_bayar`.`tgl_pembayaran` AS `tgl_pembayaran`,`tc_pinjam`.`total_peminjaman` AS `total_peminjaman`,`mt_anggota`.`nama` AS `nama`,`mt_anggota`.`no_anggota` AS `no_anggota`,`mt_anggota`.`email` AS `email`,`mt_anggota`.`no_hp` AS `no_hp`,`mt_anggota`.`alamat` AS `alamat` from ((`tc_bayar` join `mt_anggota` on((`tc_bayar`.`id_anggota` = `mt_anggota`.`id`))) join `tc_pinjam` on((`tc_bayar`.`id_pinjam` = `mt_anggota`.`id`))) where ((`tc_bayar`.`deleted_at` is null) and (`mt_anggota`.`status` = 1));

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
