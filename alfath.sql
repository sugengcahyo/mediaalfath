-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 02:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `akun`
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
-- Dumping data for table `akun`
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
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('9kttltc2hid539m5qeerrd6qr6i2n789', '192.168.43.1', 1542028512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323032383235353b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('3hb07eq1vandgdlk9p3felk0rd2ndg87', '192.168.43.19', 1542028515, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323032383239373b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('sr9l6qnvm3358seqrcajhd5d3g5gd7em', '192.168.1.5', 1542028582, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323032383538323b755f69647c733a353a227842336747223b755f6e616d657c733a353a2261646d696e223b755f666e616d657c733a363a22537567656e67223b755f6c6576656c7c733a31333a2241646d696e6973747261746f72223b69735f6c6f676765645f696e7c623a313b),
('opq20chk7bs0ejllhjmkfjef5brr3l7d', '192.168.1.17', 1542029311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323032393233373b755f69647c733a353a224866653933223b755f6e616d657c733a393a2262656e646168617261223b755f666e616d657c733a353a224a756a756e223b755f6c6576656c7c733a393a2242656e646168617261223b69735f6c6f676765645f696e7c623a313b),
('bfl7jbsvs9fqb0ta3g5bhlovilufufbv', '192.168.1.5', 1542029512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323032393438383b);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
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
-- Dumping data for table `jenis`
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
-- Table structure for table `jurnal`
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
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`jur_id`, `jur_name`, `jur_dot`, `jur_nominal`, `jur_debit`, `jur_kredit`, `jur_transaksi`, `jur_akun`, `jur_sof`, `jur_sisa`, `jur_created_at`, `jur_updated_at`, `jur_deleted_at`, `jur_restored_at`, `jur_created_by`, `jur_updated_by`, `jur_deleted_by`, `jur_restored_by`, `jur_is_deleted`) VALUES
('18110500001', 'Pengajian Bulanan', '2018-11-05', 150000, 150000, 0, 0, 'AC001', 'SD001', 0, '2018-11-05 00:46:48', '2018-11-05 00:59:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', 'xB3gG', '', '', 'FALSE'),
('18110500002', 'Sholat Jumat', '2018-11-05', 250000, 250000, 0, 0, 'AC005', 'SD001', 0, '2018-11-05 01:00:31', '2018-11-05 01:00:31', '2018-11-05 01:09:02', '2018-11-05 03:48:29', 'xB3gG', '', 'xB3gG', 'xB3gG', 'FALSE'),
('18110500003', 'Donatur Bulan Oktober', '2018-10-10', 1500000, 0, 1500000, 0, 'AC004', 'SD002', 0, '2018-11-05 01:01:06', '2018-11-05 01:01:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('18110500004', 'Agendaku', '2018-11-05', 185500, 185500, 0, 0, 'AC003', 'SD003', 0, '2018-11-05 04:00:18', '2018-11-05 04:00:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('18110600005', 'Beli Lampu', '2018-11-06', 150000, 150000, 0, 0, 'AC009', 'SD001', 0, '2018-11-06 14:13:22', '2018-11-06 14:13:22', '2018-11-06 14:57:48', '2018-11-06 14:57:55', 'xB3gG', '', 'xB3gG', 'xB3gG', 'FALSE'),
('18110600006', 'Konsumsi Kerja Bakti', '2018-11-03', 250000, 250000, 0, 0, 'AC005', 'SD003', 0, '2018-11-06 16:21:31', '2018-11-06 16:21:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('18110700007', 'Donatur Bulan Nopember', '2018-11-07', 1600000, 0, 1600000, 0, 'AC004', 'SD002', 0, '2018-11-06 17:35:27', '2018-11-06 17:35:27', '2018-11-07 01:18:42', '2018-11-07 01:18:49', 'xB3gG', '', 'xB3gG', 'xB3gG', 'FALSE'),
('18110700008', 'Konsumsi Pengajian Hari Senin', '2018-11-04', 125000, 125000, 0, 0, 'AC001', 'SD001', 0, '2018-11-06 17:38:39', '2018-11-06 17:38:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('18110700009', 'Service Komputer Masjid', '2018-10-03', 600500, 600500, 0, 0, 'AC008', 'SD001', 0, '2018-11-06 17:45:34', '2018-11-06 17:45:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'xB3gG', '', '', '', 'FALSE'),
('18110700010', 'Bayar Listrik', '2018-11-07', 550000, 550000, 0, 0, 'AC008', 'SD002', 0, '2018-11-07 02:02:36', '2018-11-07 02:02:36', '2018-11-08 06:02:34', '2018-11-07 07:30:54', 'xB3gG', '', 'xB3gG', 'xB3gG', 'TRUE'),
('18110700011', 'Kotak Infaq Oktober', '2018-10-16', 1500000, 0, 1500000, 0, 'AC007', 'SD001', 0, '2018-11-07 02:03:25', '2018-11-08 06:01:52', '2018-11-08 06:02:26', '0000-00-00 00:00:00', 'xB3gG', 'xB3gG', 'xB3gG', '', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `sof`
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
-- Dumping data for table `sof`
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
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`t_id`, `t_name`) VALUES
(1, 'DEBIT'),
(2, 'KREDIT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_pass`, `u_fpass`, `u_fname`, `u_level`, `u_created_at`, `u_updated_at`, `u_created_by`, `u_updated_by`, `u_password_updated_at`, `u_last_logged_in`, `u_ip_address`, `u_is_active`) VALUES
('dKECw', 'paijo', '$2y$05$IHleCvARdUSdl7Dwe1WccOn63irCH2NNI5eES6ZpbFeEIx26fxnjS', 'passulang', 'Paijo bin Bejo', 'Takmir', '2018-10-19 17:22:43', '2018-11-07 06:11:16', 'xB3gG', 'xB3gG', '2018-11-07 06:11:16', '2018-10-24 11:56:42', '192.168.43.1', 'Tidak Aktif'),
('Hfe93', 'bendahara', '$2y$05$ApiBTEzEgVmkXe94g4UPGe1v6tkj75fl6YEdqxn8TMZQpR..vYE1q', 'bendahara', 'Jujun', 'Bendahara', '2018-11-08 13:03:08', '2018-11-12 13:28:03', 'xB3gG', '', '0000-00-00 00:00:00', '2018-11-12 13:28:03', '192.168.1.17', 'Aktif'),
('olAir', 'sams97', '$2y$05$XGqcjumd5/g8PsQxn2t0H.2c0utd.WvaPcWJPFGRF9CZtf7SOG1dW', 'passulang', 'Samsul Arif', 'Sekretaris', '2018-10-22 12:50:09', '2018-11-07 07:33:37', 'xB3gG', 'xB3gG', '2018-11-07 06:11:12', '2018-11-07 07:33:37', '::1', 'Aktif'),
('xB3gG', 'admin', '$2y$05$mm2FEXmR3E384n9MrIVv/.JPKcl7H9M7HugrjNZNjwbJ0hML7Jily', 'admin', 'Sugeng', 'Administrator', '2018-10-18 17:31:03', '2018-11-12 13:30:14', '', '2018-', '2018-11-12 13:04:49', '2018-11-12 13:30:14', '192.168.1.5', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_session_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`j_id`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`jur_id`);

--
-- Indexes for table `sof`
--
ALTER TABLE `sof`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
