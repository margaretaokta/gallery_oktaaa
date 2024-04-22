-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 01:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_okta`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `nama_album`, `deskripsi`, `tanggal_dibuat`, `user_id`) VALUES
(201, 'nn', 'nn', '2024-04-09', 2),
(202, '', '', '2024-04-09', 2),
(203, '', '', '2024-04-09', 2),
(204, '', '', '2024-04-09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `album_id`, `user_id`) VALUES
(36, 'ddd', 'dd', '2024-04-09', 'gambar/66148051a6836.jpg', 201, 2);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(11, 36, 2, 'eeee', '2024-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(11, 36, 2, '2024-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(2, 'username', 'username', 'mj@eee.vgg', 'username', 'username');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `foto_id` (`foto_id`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE;

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`),
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
