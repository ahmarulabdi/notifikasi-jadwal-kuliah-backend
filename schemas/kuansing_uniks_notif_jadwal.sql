-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2018 at 12:28 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuansing_uniks_notif_jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal_kuliah`
--

CREATE TABLE `detail_jadwal_kuliah` (
  `id_detail_jadwal_kuliah` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_jadwal_kuliah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jadwal_kuliah`
--

INSERT INTO `detail_jadwal_kuliah` (`id_detail_jadwal_kuliah`, `id_users`, `id_jadwal_kuliah`) VALUES
(28, 3, 9),
(29, 3, 11),
(30, 3, 10),
(32, 7, 9),
(33, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `firebase_token`
--

CREATE TABLE `firebase_token` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `instance_id` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id_jadwal_kuliah` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tempat` varchar(250) DEFAULT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu') DEFAULT NULL,
  `urutan_hari` int(11) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `sks` int(10) NOT NULL,
  `nip` bigint(50) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwal_kuliah`, `kode`, `nama`, `tempat`, `hari`, `urutan_hari`, `jam_mulai`, `jam_selesai`, `sks`, `nip`, `semester`, `keterangan`) VALUES
(9, 'mk1234', 'RPL', 'gedung baru', 'senin', 1, '08:00:00', '09:00:00', 3, 888, 'IVA', NULL),
(10, 'mk111', 'RPLBO', 'gedung baru', 'rabu', 3, '08:00:00', '21:00:00', 3, 888, 'IVB', NULL),
(11, 'mk122', 'Jarkom', 'gedung baru 3', 'jumat', 5, '13:30:00', '15:00:00', 3, 333, 'VI', NULL),
(12, 'mk8888', 'Alpro', 'gedung baru 3', 'jumat', 5, '08:00:00', '09:00:00', 4, 999, 'II', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_halangan`
--

CREATE TABLE `notifikasi_halangan` (
  `id_notifikasi` int(11) NOT NULL,
  `id_detail_jadwal_kuliah` int(11) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi_halangan`
--

INSERT INTO `notifikasi_halangan` (`id_notifikasi`, `id_detail_jadwal_kuliah`, `pesan`, `timestamp`) VALUES
(3, 10, 'diganti dengan minggu depan', '2018-09-11 08:46:18'),
(4, 9, 'diganti dengan minggu depan', '2018-09-11 08:51:49'),
(5, 10, 'diganti dengan minggu depan', '2018-09-11 08:51:54'),
(6, 12, 'diganti dengan minggu depan', '2018-09-11 08:51:57'),
(7, 12, 'diganti dengan minggu depan', '2018-09-11 18:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `isi` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `isi`, `deskripsi`) VALUES
(1, '{"buka":"true"}', 'Pengisian KRS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nip_nim` bigint(50) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hak_akses` enum('mahasiswa','dosen','administrator') NOT NULL DEFAULT 'mahasiswa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nip_nim`, `password`, `nama`, `hak_akses`) VALUES
(1, 911, '21232f297a57a5a743894a0e4a801fc3', 'admin', 'administrator'),
(2, 888, '0a113ef6b61820daa5611c870ed8d5ee', 'budi S.Kom, M.Kom, SI', 'dosen'),
(3, 11451105873, '70daa8d4d2219f12ba7fe979184f2060', 'Rila', 'mahasiswa'),
(5, 999, '4297f44b13955235245b2497399d7a93', 'iwan suwanto', 'dosen'),
(6, 333, '310dcbbf4cce62f762a2aaa148d556bd', 'Safaat ST, MT', 'dosen'),
(7, 11451105874, '312eb26733a2420b2dd2191a49e763df', 'Rila next\n', 'mahasiswa'),
(8, 114114114, '2d1a22a9960147bff61918e9cd2c0c76', 'Adryan', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal_kuliah`
--
ALTER TABLE `detail_jadwal_kuliah`
  ADD PRIMARY KEY (`id_detail_jadwal_kuliah`),
  ADD KEY `fk_detail_jadwal_kuliah` (`id_jadwal_kuliah`);

--
-- Indexes for table `firebase_token`
--
ALTER TABLE `firebase_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id_jadwal_kuliah`);

--
-- Indexes for table `notifikasi_halangan`
--
ALTER TABLE `notifikasi_halangan`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jadwal_kuliah`
--
ALTER TABLE `detail_jadwal_kuliah`
  MODIFY `id_detail_jadwal_kuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `firebase_token`
--
ALTER TABLE `firebase_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_jadwal_kuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notifikasi_halangan`
--
ALTER TABLE `notifikasi_halangan`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_jadwal_kuliah`
--
ALTER TABLE `detail_jadwal_kuliah`
  ADD CONSTRAINT `fk_detail_jadwal_kuliah` FOREIGN KEY (`id_jadwal_kuliah`) REFERENCES `jadwal_kuliah` (`id_jadwal_kuliah`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
