-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2024 pada 00.40
-- Versi server: 10.1.33-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_validasi_presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `index_kedisiplinan`
--

CREATE TABLE `index_kedisiplinan` (
  `username` varchar(20) NOT NULL,
  `tahun` char(4) NOT NULL,
  `bulan` char(2) NOT NULL,
  `t1` int(11) NOT NULL,
  `t2` int(11) NOT NULL,
  `t3` int(11) NOT NULL,
  `t4` int(11) NOT NULL,
  `t_menit` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `p3` int(11) NOT NULL,
  `p4` int(11) NOT NULL,
  `p_menit` int(11) NOT NULL,
  `c1` int(11) NOT NULL,
  `c2` int(11) NOT NULL,
  `c3` int(11) NOT NULL,
  `c4` int(11) NOT NULL,
  `c5` int(11) NOT NULL,
  `c6` int(11) NOT NULL,
  `tb` int(11) NOT NULL,
  `dl` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `jml_hadir` int(11) NOT NULL,
  `invalid_masuk` int(11) NOT NULL,
  `invalid_pulang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode_unit` varchar(45) NOT NULL,
  `nm_unit` varchar(45) NOT NULL,
  `nm_unit_singkat` varchar(45) NOT NULL,
  `status_peg` enum('1','2','3') NOT NULL COMMENT '1=PNS,2=NON PNS,3=PPPK',
  `status` enum('A','N','L') NOT NULL COMMENT 'A=Aktif, N=Non Aktif, L=Logout',
  `tmt_masuk_kerja` datetime DEFAULT NULL,
  `tmt_pensiun` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `index_kedisiplinan`
--
ALTER TABLE `index_kedisiplinan`
  ADD PRIMARY KEY (`username`,`tahun`,`bulan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `index_kedisiplinan`
--
ALTER TABLE `index_kedisiplinan`
  ADD CONSTRAINT `index_kedisiplinan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pegawai` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
