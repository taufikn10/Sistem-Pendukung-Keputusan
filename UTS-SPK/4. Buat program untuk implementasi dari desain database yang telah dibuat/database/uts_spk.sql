-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2021 pada 10.28
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `definisi` varchar(100) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode`, `nama_kriteria`, `definisi`, `jenis`, `bobot`) VALUES
(1, 'C1', 'Learnability', 'Seberapa mudah pengguna mempelajari', 'benefit', 100),
(2, 'C2', 'Eficiency', 'Seberapa cepat pengguna dalam mengerjakan', 'benefit', 80),
(3, 'C3', 'Memorability', 'Seberapa ingat pengguna ketika mengulang kembali', 'benefit', 70),
(4, 'C4', 'Error', 'Seberapa banyak eror', 'benefit', 90),
(5, 'C5', 'Satisfaction', 'Seberapa nyaman desain tersebut digunakan', 'benefit', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matrik`
--

CREATE TABLE `tb_matrik` (
  `id_matrik` int(50) NOT NULL,
  `id_users` int(50) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matrik`
--

INSERT INTO `tb_matrik` (`id_matrik`, `id_users`, `c1`, `c2`, `c3`, `c4`, `c5`) VALUES
(1, 3, 0.5, 0.25, 0.5, 0.75, 0.5),
(2, 5, 0.75, 0.5, 0.75, 1, 0.75),
(3, 6, 0.25, 1, 0.5, 0.75, 0.75),
(4, 7, 0.75, 0.5, 0.25, 0.75, 0.75),
(5, 8, 0.5, 0.25, 0.5, 0.5, 0.25),
(6, 9, 0.25, 0, 0.75, 0.5, 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rentang`
--

CREATE TABLE `tb_rentang` (
  `id_rentang` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rentang`
--

INSERT INTO `tb_rentang` (`id_rentang`, `sub_kriteria`, `nilai`) VALUES
(2, 'Sangat Rendah', 0),
(3, 'Rendah', 0.25),
(4, 'Sedang', 0.5),
(5, 'Tinggi', 0.75),
(6, 'Sangat Tinggi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_resetpass`
--

CREATE TABLE `tb_resetpass` (
  `id` int(50) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `id_users` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `alamat` text NOT NULL,
  `verifikasi` tinyint(1) NOT NULL,
  `level` enum('None','Developer','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `kode`, `username`, `nama`, `email`, `password`, `alamat`, `verifikasi`, `level`) VALUES
(3, 'A1', 'taunur', 'Donal Trump', 'taufik.nurrahmanmaster980@gmail.com', '$2y$10$9q0IJgBp1c5DA1c1NJWgp.AGMAwvWt9SrVMOZulPfeqjitWSySvNO', 'Amerika', 1, 'Developer'),
(4, '', 'admin', 'Taufik Nurrahman', 'official.taufik980@gmail.com', '$2y$10$MqoTHsGS8ilKkNoDwSf9SOaD7XTv7rZ1W9Jlv1x7QIYnd8JtA0K6C', 'Nganjuk', 1, 'Admin'),
(5, 'A2', 'elanoholama', 'Elano Holama', 'elano.holamamaster@gmail.com', '$2y$10$pcdOhj4Ri6tZ2ggIhZ7dm.PcSSUcYeqKOZnKquRbyYe4/bMUEXQ6u', 'Hungarian', 1, 'Developer'),
(6, 'A3', 'anambon', 'Anam Bonjol', 'keamanan.perangakat@gmail.com', '$2y$10$X.fhKDQsLuTlpmAMTIbCJ.VLlynGuR/ZL5Zfu9..UNsNnLqejM/0K', 'Ambon', 1, 'Developer'),
(7, 'A4', 'devinka', 'Devina Karunia', 'devina.karunia21@gmail.com', '$2y$10$tjnDHwpR4rGHzXnzoKXVvu89iBrurmPP8eOCsm7jTQvWAS0nXwwfK', 'Manalagi', 1, 'Developer'),
(8, 'A5', 'imelda1', 'Imelda Sunita Ababil', 'imelda.123sunita@gmail.com', '$2y$10$f1kkatjMwlifGesmos9xx.WXo6Wi7X0ZPKdnZHEcij9xAZS7YJnqm', 'Yoru', 1, 'Developer'),
(9, 'A6', 'rok123', 'Rise Of Kingdom', 'rkingdom470@gmail.com', '$2y$10$0.BDwW5Bk/PJ31p9.UA3UeIKRUtw4oZzfczx1RmhljQjy2AZt4Vzm', 'Kongku', 1, 'Developer'),
(10, '', 'whoami', 'Anymous', 'anymous.mm@gmail.com', '$2y$10$Jl90QzkzyEpGwH2Co6ylkuROYC05CH5EwWu4GMSN7ldi9DKj3o7m6', '', 1, 'None');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_matrik`
--
ALTER TABLE `tb_matrik`
  ADD PRIMARY KEY (`id_matrik`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `c1` (`c1`),
  ADD KEY `c2` (`c2`),
  ADD KEY `c3` (`c3`),
  ADD KEY `c4` (`c4`),
  ADD KEY `c5` (`c5`);

--
-- Indeks untuk tabel `tb_rentang`
--
ALTER TABLE `tb_rentang`
  ADD PRIMARY KEY (`id_rentang`),
  ADD KEY `nilai` (`nilai`);

--
-- Indeks untuk tabel `tb_resetpass`
--
ALTER TABLE `tb_resetpass`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `nama` (`nama`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_matrik`
--
ALTER TABLE `tb_matrik`
  MODIFY `id_matrik` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_rentang`
--
ALTER TABLE `tb_rentang`
  MODIFY `id_rentang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_resetpass`
--
ALTER TABLE `tb_resetpass`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_matrik`
--
ALTER TABLE `tb_matrik`
  ADD CONSTRAINT `tb_matrik_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`),
  ADD CONSTRAINT `tb_matrik_ibfk_2` FOREIGN KEY (`c1`) REFERENCES `tb_rentang` (`nilai`),
  ADD CONSTRAINT `tb_matrik_ibfk_3` FOREIGN KEY (`c2`) REFERENCES `tb_rentang` (`nilai`),
  ADD CONSTRAINT `tb_matrik_ibfk_4` FOREIGN KEY (`c3`) REFERENCES `tb_rentang` (`nilai`),
  ADD CONSTRAINT `tb_matrik_ibfk_5` FOREIGN KEY (`c4`) REFERENCES `tb_rentang` (`nilai`),
  ADD CONSTRAINT `tb_matrik_ibfk_6` FOREIGN KEY (`c5`) REFERENCES `tb_rentang` (`nilai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
