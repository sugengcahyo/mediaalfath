-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Nov 2018 pada 01.17
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alfath`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `a_id` char(6) NOT NULL,
  `a_name` varchar(45) NOT NULL,
  `a_jid` char(5) NOT NULL,
  `a_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `a_restored_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `a_created_by` char(5) NOT NULL,
  `a_updated_by` char(5) NOT NULL,
  `a_deleted_by` char(5) NOT NULL,
  `a_restored_by` char(5) NOT NULL,
  `a_is_deleted` enum('TRUE','FALSE') NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`a_id`, `a_name`, `a_jid`, `a_created_at`, `a_updated_at`, `a_deleted_at`, `a_restored_at`, `a_created_by`, `a_updated_by`, `a_deleted_by`, `a_restored_by`, `a_is_deleted`) VALUES
('AC001', 'Pengajian Rutin', 'JE002', '2018-10-29 11:08:04', '2018-10-29 15:10:04', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', 'xB3gG', '', '', 'FALSE'),
('AC002', 'Peringatan Hari Besar Islam', 'JE001', '2018-10-29 15:15:29', '2018-10-29 15:15:29', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC003', 'Peringatan Hari Besar Nasional', 'JE002', '2018-10-29 15:15:54', '2018-10-29 15:15:54', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC004', 'Pemasukan Donatur Bulanan', 'JE003', '2018-10-29 15:16:20', '2018-10-29 15:16:20', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC005', 'Operasional Ibadah Jumat', 'JE001', '2018-10-29 17:58:03', '2018-10-29 17:58:03', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC006', 'Infaq Jumat', 'JE007', '2018-11-06 14:05:28', '2018-11-06 14:05:28', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC007', 'Kotak Infaq Masjid', 'JE007', '2018-11-06 14:05:51', '2018-11-06 14:05:51', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE'),
('AC008', 'Perawatan Alat', 'JE005', '2018-11-06 14:06:26', '2018-11-06 14:43:15', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', 'xB3gG', '', '', 'FALSE'),
('AC009', 'Pembaruan', 'JE004', '2018-11-06 14:43:47', '2018-11-06 14:43:47', '2018-11-07 01:28:28', '2018-11-07 01:31:01', 'xB3gG', '', '', '', 'FALSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8a5740a6f04c86f21ecae5d844ae09191daa1c42', '::1', 1542215576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323231353535353b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('4b5acede87611e917a445a672f129bf590ad0b63', '::1', 1542443666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323434333438373b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('7ff97989dd0fcc740703174bfce2934735d6bdc4', '192.168.1.3', 1542451559, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323435313535393b),
('0838d20df6730a95fc32048ce7746f76f65c195c', '192.168.1.3', 1542454980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323435343938303b),
('43633b0fb6ebd69848c7c83ccd11ed634ab1fcc3', '::1', 1542625419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323632353333323b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('73396efbd582aafdd73c092a7f1c391946cd9c4f', '::1', 1542683834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323638333830313b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('e1ac0bfe63926672707d454fee1d71d5937034b6', '127.0.0.1', 1542867824, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323836373632323b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('d8ff057e48f7e6253ff8bffa5b87a8dd87e506b8', '127.0.0.1', 1542871191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323837313138343b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('15bfddf149f862c4a277f29aeae5dcde2d081c81', '::1', 1542888648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323838383634373b),
('552af4778a311c96f04d8463b3765ef69a040254', '::1', 1542893372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323839333337313b),
('4373cdab8fc0df275f16004cbb592d4d6c54a2c6', '127.0.0.1', 1543138430, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333133383335363b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('bb95a97c7a7b350823162797e99bff9382c0652d', '127.0.0.1', 1543335861, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333333353737343b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('5182ecaf796416749cf1cbd6805edc8587fb1631', '127.0.0.1', 1543370262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333337303031363b),
('e9759d2ac4cc520c5136959af3177dceaeb262b4', '127.0.0.1', 1543391871, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333339313836303b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('7e09557e0cb840d609969f2cfb9c9087b182e0e4', '127.0.0.1', 1543396257, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333339363234363b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('c6e276b6148a006a2c925701ad9d3efedabf5eac', '127.0.0.1', 1543401737, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333430313439373b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('595b7d5a6e6476e0e6bbdc2bed79f1e49f4a6d49', '127.0.0.1', 1543415321, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333431353332303b),
('dfb761d63a619e2557f0f1e9745952504f2f1d10', '127.0.0.1', 1543419879, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333431393837393b),
('56fb09b096a61c07959d7ccb75deb6d0df7f1e7e', '127.0.0.1', 1543421525, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333432313530313b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('471434877e522eb0e8010c42c2a38085a6291266', '127.0.0.1', 1543428640, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333432383435363b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('7713efa89f2b34379db18e04e51977e7eeff6ef9', '127.0.0.1', 1543450616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333435303631363b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `j_id` char(5) NOT NULL,
  `j_name` varchar(50) DEFAULT NULL,
  `j_transaksi` char(5) NOT NULL,
  `j_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `j_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `j_deleted_at` timestamp NULL DEFAULT NULL,
  `j_restored_at` timestamp NULL DEFAULT NULL,
  `j_created_by` char(5) DEFAULT NULL,
  `j_updated_by` char(5) DEFAULT NULL,
  `j_deleted_by` char(5) DEFAULT NULL,
  `j_restored_by` char(5) DEFAULT NULL,
  `j_is_deleted` enum('TRUE','FALSE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`j_id`, `j_name`, `j_transaksi`, `j_created_at`, `j_updated_at`, `j_deleted_at`, `j_restored_at`, `j_created_by`, `j_updated_by`, `j_deleted_by`, `j_restored_by`, `j_is_deleted`) VALUES
('JE001', 'Belanja Sekretariat', '1', '2018-10-24 11:21:45', '2018-10-29 15:03:52', '2018-10-24 11:37:49', NULL, 'xB3gG', 'xB3gG', 'xB3gG', NULL, 'FALSE'),
('JE002', 'Belanja Kegiatan', '1', '2018-10-24 13:02:09', '2018-10-29 12:36:11', NULL, NULL, NULL, 'xB3gG', NULL, NULL, 'FALSE'),
('JE003', 'Donatur Tetap', '2', '2018-10-24 13:17:14', '2018-10-29 15:02:56', '2018-10-24 15:00:48', '2018-10-24 15:02:02', NULL, 'xB3gG', 'xB3gG', 'xB3gG', 'FALSE'),
('JE004', 'Aset Tetap (beli)', '1', '2018-10-29 03:48:10', '2018-10-29 15:04:47', NULL, NULL, NULL, 'xB3gG', NULL, NULL, 'FALSE'),
('JE005', 'Aset Lancar (perawatan)', '1', '2018-10-29 15:06:32', '2018-10-29 15:06:32', NULL, NULL, NULL, NULL, NULL, NULL, 'FALSE'),
('JE006', 'Modal', '2', '2018-10-29 15:07:42', '2018-10-29 15:07:42', NULL, NULL, NULL, NULL, NULL, NULL, 'FALSE'),
('JE007', 'Pemasukan', '2', '2018-10-29 15:08:08', '2018-10-29 15:08:29', '2018-10-29 15:08:23', '2018-10-29 15:08:29', NULL, NULL, 'xB3gG', 'xB3gG', 'FALSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `jur_id` varchar(12) NOT NULL,
  `jur_name` varchar(50) NOT NULL,
  `jur_dot` date NOT NULL,
  `jur_nominal` double NOT NULL DEFAULT '0',
  `jur_debit` double DEFAULT NULL,
  `jur_kredit` double DEFAULT NULL,
  `jur_transaksi` int(11) NOT NULL,
  `jur_akun` char(5) NOT NULL,
  `jur_sof` char(5) NOT NULL,
  `jur_sisa` double NOT NULL,
  `jur_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jur_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jur_deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jur_restored_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jur_created_by` char(5) NOT NULL,
  `jur_updated_by` char(5) NOT NULL,
  `jur_deleted_by` char(5) NOT NULL,
  `jur_restored_by` char(5) NOT NULL,
  `jur_is_deleted` enum('TRUE','FALSE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`jur_id`, `jur_name`, `jur_dot`, `jur_nominal`, `jur_debit`, `jur_kredit`, `jur_transaksi`, `jur_akun`, `jur_sof`, `jur_sisa`, `jur_created_at`, `jur_updated_at`, `jur_deleted_at`, `jur_restored_at`, `jur_created_by`, `jur_updated_by`, `jur_deleted_by`, `jur_restored_by`, `jur_is_deleted`) VALUES
('18112900001', '{b!t{zlbnbbn', '2018-11-29', 12312312, 12312312, 0, 0, 'AC002', 'SD004', 0, '2018-11-28 17:38:52', '2018-11-28 17:38:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sof`
--

CREATE TABLE `sof` (
  `s_id` char(5) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_inisial` varchar(7) NOT NULL,
  `s_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `s_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `s_deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_restored_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_created_by` char(5) NOT NULL,
  `s_updated_by` char(5) NOT NULL,
  `s_deleted_by` char(5) NOT NULL,
  `s_restored_by` char(5) NOT NULL,
  `s_is_deleted` enum('TRUE','FALSE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sof`
--

INSERT INTO `sof` (`s_id`, `s_name`, `s_inisial`, `s_created_at`, `s_updated_at`, `s_deleted_at`, `s_restored_at`, `s_created_by`, `s_updated_by`, `s_deleted_by`, `s_restored_by`, `s_is_deleted`) VALUES
('SD001', 'Kotak infaq', 'KINFQ', '2018-10-29 07:51:00', '2018-10-29 07:51:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('SD002', 'Donatur tetap', 'DOTTP', '2018-10-29 07:51:26', '2018-10-29 07:51:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('SD003', 'Sumbangan', 'SUMBG', '2018-10-29 15:09:18', '2018-10-29 15:09:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('SD004', 'Sponsor', 'SPONS', '2018-11-06 14:13:54', '2018-11-06 14:13:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('SD005', 'Bantuan pemerintah', 'BAPEM', '2018-11-06 14:14:13', '2018-11-06 14:14:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('SD006', 'Bantuan swasta', 'BASWA', '2018-11-06 14:14:27', '2018-11-06 14:14:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`t_id`, `t_name`) VALUES
(1, 'DEBIT'),
(2, 'KREDIT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `u_id` char(5) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_fpass` varchar(35) NOT NULL,
  `u_fname` varchar(50) NOT NULL,
  `u_level` enum('Administrator','User','Ketua','Bendahara','Sekretaris','Remaja Masjid','Takmir') NOT NULL DEFAULT 'User',
  `u_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_created_by` char(5) NOT NULL,
  `u_updated_by` char(5) NOT NULL,
  `u_password_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `u_last_logged_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `u_ip_address` varchar(50) NOT NULL,
  `u_is_active` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_pass`, `u_fpass`, `u_fname`, `u_level`, `u_created_at`, `u_updated_at`, `u_created_by`, `u_updated_by`, `u_password_updated_at`, `u_last_logged_in`, `u_ip_address`, `u_is_active`) VALUES
('dKECw', 'paijo', '$2y$05$IHleCvARdUSdl7Dwe1WccOn63irCH2NNI5eES6ZpbFeEIx26fxnjS', 'passulang', 'Paijo bin Bejo', 'Takmir', '2018-10-19 17:22:43', '2018-11-07 06:11:16', 'xB3gG', 'xB3gG', '2018-11-07 06:11:16', '2018-10-24 11:56:42', '192.168.43.1', 'Tidak Aktif'),
('Hfe93', 'bendahara', '$2y$05$ApiBTEzEgVmkXe94g4UPGe1v6tkj75fl6YEdqxn8TMZQpR..vYE1q', 'bendahara', 'Jujun', 'Bendahara', '2018-11-08 13:03:08', '2018-11-12 13:28:03', 'xB3gG', '', '0000-00-00 00:00:00', '2018-11-12 13:28:03', '192.168.1.17', 'Aktif'),
('olAir', 'sams97', '$2y$05$XGqcjumd5/g8PsQxn2t0H.2c0utd.WvaPcWJPFGRF9CZtf7SOG1dW', 'passulang', 'Samsul Arif', 'Sekretaris', '2018-10-22 12:50:09', '2018-11-07 07:33:37', 'xB3gG', 'xB3gG', '2018-11-07 06:11:12', '2018-11-07 07:33:37', '::1', 'Aktif'),
('xB3gG', 'admin', '$2y$05$mm2FEXmR3E384n9MrIVv/.JPKcl7H9M7HugrjNZNjwbJ0hML7Jily', 'admin', 'Sugeng', 'Administrator', '2018-10-18 17:31:03', '2018-11-29 00:01:44', '', '2018-', '2018-11-12 13:04:49', '2018-11-29 00:01:44', '127.0.0.1', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`a_id`);

--
-- Indeks untuk tabel `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_session_timestamp` (`timestamp`) USING BTREE;

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`j_id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`jur_id`);

--
-- Indeks untuk tabel `sof`
--
ALTER TABLE `sof`
  ADD PRIMARY KEY (`s_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`t_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
