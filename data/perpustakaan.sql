-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2017 at 09:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text,
  `telepon` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `id_jenis_kelamin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `email`, `alamat`, `telepon`, `tanggal_lahir`, `id_jenis_kelamin`) VALUES
(18, 'fauzan98', 'fauzannoor98@gmail.com', 'asdda', '123', '2017-08-16', 1),
(19, 'asddas', 'wlnoor98@gmail.com', 'dsads', 'asdasd', '2017-08-31', 1),
(20, 'asdaas', 'wlnoor98@gmail.com', 'asdas', 'dasdas', '2017-08-18', 1),
(21, 'asdaas', 'wlnoor98@gmail.com', 'asdas', 'dasdas', '2017-08-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_pengarang` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `gambar`, `id_pengarang`, `nama`, `tanggal_terbit`, `id_kategori`, `id_penerbit`) VALUES
(6, 'avatar1551939048.png', 1, 'Pandai Berbahasa Jepang', '2017-05-16', 4, 0),
(9, 'bulletin_stat_2015-03-20_14-21-20_coverstat_twall_2013_f1517894285.jpg', 1, 'Belajar PHP', '2017-05-08', 2, 0),
(12, 'desain21517894298.png', 9, 'Islam Dimata Dunia', '2017-05-16', 5, 0),
(14, 'LOGO KABUPATEN PUNCAK1515215837.png', 6, 'Langkah Menuju Kesuksean', '2017-05-30', 4, 0),
(16, 'layout awal1496731888.png', 10, 'Buku Yii2', '2017-06-14', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `nama`) VALUES
(1, 'Laki - Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(2, 'Informatika'),
(4, 'Pendidikan'),
(5, 'Agama'),
(6, 'Hukum');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama`, `gambar`) VALUES
(1, 'CV. Grammedia Tbk.', ''),
(2, 'CV. Indonesia Jaya Abadi', ''),
(3, 'Pt. Cahaya Badai Sentosa', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_jenis_kelamin` int(1) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id`, `nama`, `id_jenis_kelamin`, `tanggal_lahir`, `gambar`) VALUES
(1, 'Stephenie Meyer', 2, '1998-01-01', '10-penulis-novel-terkenal-paling-kaya-di-dunia-300x2261517889170.jpg'),
(6, 'Dean Koontz', 1, '2017-05-09', '9-penulis-terkenal1517889183.jpg'),
(9, 'Nora Roberts', 2, '2017-06-06', '8-penulis-terkenal-luar-negeri1517889198.jpg'),
(10, 'Jackie Collins', 2, '2017-06-15', '7-penulis-novel-terkenal-dunia1517889209.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text,
  `telepon` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `id_jenis_kelamin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `alamat`, `telepon`, `tanggal_lahir`, `id_jenis_kelamin`) VALUES
(1, 'Fauzan Noor', 'Alamat', '08812121', '1999-06-09', 1),
(6, 'Muhammad', 'Alamat', '08976588', '2017-06-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_anggota`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(8, 7, 12, '2017-06-10', '2017-06-12', 10),
(9, 1, 6, '2017-06-01', '2017-06-12', 10),
(13, 7, 6, '2017-06-27', '2017-06-12', 10),
(14, 1, 9, '2017-06-01', '2017-06-21', 10),
(15, 8, 9, '2017-07-01', '2017-07-03', 10);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Petugas'),
(2, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `model` varchar(11) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `model`, `id_model`, `id_role`, `id_status`, `token`) VALUES
(16, 'fauzan', '$2y$13$ux9y/CaDNm55QoqhIFHzn.Wx9i4v3Epm2vBuZmWfB3unMK0803xn.', 'Petugas', 18, 1, 2, 'T6q_cjAGH4'),
(17, 'ads', '$2y$13$35bwEPWUKG9.KpR7Bh4NMuyu/x2OW51odwfqeW9wEhTK9mq4xz0ty', 'anggota', 19, 2, 2, 'uT0VZDefRe'),
(18, 'adsdas', '$2y$13$jyb3c4PsSkIVGtHuRCAfsex17nGd8xlmpCWidXhtYxB9yiQJZNtoe', 'anggota', 20, 2, 2, 'KpZk6TDOXo'),
(19, 'adsdas', '$2y$13$b8QoXvgaN7mvXTzNMfeuq.XKC6HkeWkhFhrDdlZSIUpAjP/kbl0uS', 'anggota', 21, 2, 2, 'Tjfu22W9z2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
