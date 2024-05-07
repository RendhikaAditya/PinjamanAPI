-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2024 pada 10.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `kode_pp` int(11) NOT NULL,
  `bulan_pembayaran` int(11) NOT NULL,
  `nominal_bayaran` varchar(255) NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `kode_pp`, `bulan_pembayaran`, `nominal_bayaran`, `jatuh_tempo`, `status`) VALUES
(73, 14, 1, 'Rp 453.333,00', NULL, 'Bayar'),
(74, 14, 2, 'Rp 453.333,00', NULL, 'Belum'),
(75, 14, 3, 'Rp 453.333,00', NULL, 'Belum'),
(76, 14, 4, 'Rp 453.333,00', NULL, 'Belum'),
(77, 14, 5, 'Rp 453.333,00', NULL, 'Belum'),
(78, 14, 6, 'Rp 453.333,00', NULL, 'Belum'),
(79, 14, 7, 'Rp 453.333,00', NULL, 'Belum'),
(80, 14, 8, 'Rp 453.333,00', NULL, 'Belum'),
(81, 14, 9, 'Rp 453.333,00', NULL, 'Belum'),
(82, 14, 10, 'Rp 453.333,00', NULL, 'Belum'),
(83, 14, 11, 'Rp 453.333,00', NULL, 'Belum'),
(84, 14, 12, 'Rp 453.333,00', NULL, 'Belum'),
(85, 14, 13, 'Rp 453.333,00', NULL, 'Belum'),
(86, 14, 14, 'Rp 453.333,00', NULL, 'Belum'),
(87, 14, 15, 'Rp 453.333,00', NULL, 'Belum'),
(88, 14, 16, 'Rp 453.333,00', NULL, 'Belum'),
(89, 14, 17, 'Rp 453.333,00', NULL, 'Belum'),
(90, 14, 18, 'Rp 453.333,00', NULL, 'Belum'),
(91, 14, 19, 'Rp 453.333,00', NULL, 'Belum'),
(92, 14, 20, 'Rp 453.333,00', NULL, 'Belum'),
(93, 14, 21, 'Rp 453.333,00', NULL, 'Belum'),
(94, 14, 22, 'Rp 453.333,00', NULL, 'Belum'),
(95, 14, 23, 'Rp 453.333,00', NULL, 'Belum'),
(96, 14, 24, 'Rp 453.333,00', NULL, 'Belum'),
(97, 14, 25, 'Rp 453.333,00', NULL, 'Belum'),
(98, 14, 26, 'Rp 453.333,00', NULL, 'Belum'),
(99, 14, 27, 'Rp 453.333,00', NULL, 'Belum'),
(100, 14, 28, 'Rp 453.333,00', NULL, 'Belum'),
(101, 14, 29, 'Rp 453.333,00', NULL, 'Belum'),
(102, 14, 30, 'Rp 453.333,00', '2024-05-01', 'Belum'),
(103, 15, 1, 'Rp 396.667,00', '2024-06-07', 'Belum'),
(104, 15, 2, 'Rp 396.667,00', '2024-07-07', 'Belum'),
(105, 15, 3, 'Rp 396.667,00', '2024-08-07', 'Belum'),
(106, 15, 4, 'Rp 396.667,00', '2024-09-07', 'Belum'),
(107, 15, 5, 'Rp 396.667,00', '2024-10-07', 'Belum'),
(108, 15, 6, 'Rp 396.667,00', '2024-11-07', 'Belum'),
(109, 15, 7, 'Rp 396.667,00', '2024-12-07', 'Belum'),
(110, 15, 8, 'Rp 396.667,00', '2025-01-07', 'Belum'),
(111, 15, 9, 'Rp 396.667,00', '2025-02-07', 'Belum'),
(112, 15, 10, 'Rp 396.667,00', '2025-03-07', 'Belum'),
(113, 15, 11, 'Rp 396.667,00', '2025-04-07', 'Belum'),
(114, 15, 12, 'Rp 396.667,00', '2025-05-07', 'Belum'),
(115, 15, 13, 'Rp 396.667,00', '2025-06-07', 'Belum'),
(116, 15, 14, 'Rp 396.667,00', '2025-07-07', 'Belum'),
(117, 15, 15, 'Rp 396.667,00', '2025-08-07', 'Belum'),
(118, 15, 16, 'Rp 396.667,00', '2025-09-07', 'Belum'),
(119, 15, 17, 'Rp 396.667,00', '2025-10-07', 'Belum'),
(120, 15, 18, 'Rp 396.667,00', '2025-11-07', 'Belum'),
(121, 15, 19, 'Rp 396.667,00', '2025-12-07', 'Belum'),
(122, 15, 20, 'Rp 396.667,00', '2026-01-07', 'Belum'),
(123, 15, 21, 'Rp 396.667,00', '2026-02-07', 'Belum'),
(124, 15, 22, 'Rp 396.667,00', '2026-03-07', 'Belum'),
(125, 15, 23, 'Rp 396.667,00', '2026-04-07', 'Belum'),
(126, 15, 24, 'Rp 396.667,00', '2026-05-07', 'Belum'),
(127, 15, 25, 'Rp 396.667,00', '2026-06-07', 'Belum'),
(128, 15, 26, 'Rp 396.667,00', '2026-07-07', 'Belum'),
(129, 15, 27, 'Rp 396.667,00', '2026-08-07', 'Belum'),
(130, 15, 28, 'Rp 396.667,00', '2026-09-07', 'Belum'),
(131, 15, 29, 'Rp 396.667,00', '2026-10-07', 'Belum'),
(132, 15, 30, 'Rp 396.667,00', '2026-11-07', 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nasabah`
--

CREATE TABLE `tb_nasabah` (
  `kode_nasabah` int(11) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `nama_nasabah` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `pekerjaan` enum('PNS','Swasta','Wirausaha','Buruh','DLL') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_nasabah`
--

INSERT INTO `tb_nasabah` (`kode_nasabah`, `no_ktp`, `nama_nasabah`, `tgl_lahir`, `jenis_kelamin`, `pekerjaan`, `alamat`, `telpon`, `email`, `password`, `status`) VALUES
(1, '2342', 'Budi Santosas', '0000-00-00', '', 'PNS', 'Jl. Raya No. 123', '081234567890', 'budi@mail.com', '', 'tidak aktif'),
(2, '2342342', 'Ani Wijaya', '1985-10-20', 'Perempuan', 'PNS', 'Jl. Mawar No. 456', '081234567891', 'adni@mail.com', 'ani_password', 'aktif'),
(6, '2342', 'nasabah ', '2024-03-20', '', 'PNS', 'padang\n', '0511', 'nasabah@mail.com', '$2y$10$ExXaY9/QTt4TTk3u4rowE.JQdAiVEB2n2Q0AF7nDg5/vJHrSKu6L.', 'tidak aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan_peminjaman`
--

CREATE TABLE `tb_pengajuan_peminjaman` (
  `kode_pp` int(11) NOT NULL,
  `kode_nasabah` int(11) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT current_timestamp(),
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `foto_unit` varchar(255) DEFAULT NULL,
  `foto_stnk` varchar(255) NOT NULL,
  `foto_bpkp` varchar(255) NOT NULL,
  `berkas_pinjaman` varchar(255) NOT NULL,
  `dana_pinjaman_diajukan` int(11) DEFAULT NULL,
  `dana_pinjaman_diterima` int(11) DEFAULT NULL,
  `lama_ansuran` varchar(50) DEFAULT NULL,
  `status_pengajuan` enum('konfirmasi','Di terima','Di tolak') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengajuan_peminjaman`
--

INSERT INTO `tb_pengajuan_peminjaman` (`kode_pp`, `kode_nasabah`, `tgl_pengajuan`, `foto_ktp`, `foto_kk`, `foto_unit`, `foto_stnk`, `foto_bpkp`, `berkas_pinjaman`, `dana_pinjaman_diajukan`, `dana_pinjaman_diterima`, `lama_ansuran`, `status_pengajuan`, `keterangan`) VALUES
(14, 6, '2024-05-03', '1714736369_ktp.jpg', '1714736369_kk.jpg', '1714736369_unit.jpg', '', '', '1714736369_file.pdf', 10000000, 8000000, '30 Bulan', 'Di terima', 'Pinjaman Di setujui'),
(15, 6, '2024-05-07', '1715046280_ktp.jpg', '1715046280_kk.jpg', '1715046280_unit.jpg', '1715046280_stnk.jpg', '1715046280_unit.jpg', '1715046280_file.pdf', 7000000, 7000000, '30 Bulan', 'Di terima', 'Pinjaman Di setujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `kode_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`kode_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(2, 'Jane Doer', 'jane_doe', '', 'Unit Head'),
(5, 'pulaniarmi', 'pulan', '$2y$10$2HCQxT5e.jRjZLOR7bp92eNbV2zVC8PT5hj5GPZX1Fh1Z9B7OLdNW', 'Unit Head'),
(6, 'admin', 'admin', '$2y$10$okETwa.6M2zm7vy9IVQeKehcMqaE6kTQFZLvgopO1iZBWudzLIdD2', 'Admin'),
(7, 'ead', 'head', '$2y$10$GJlnipDY/JshrCMRmp7fZeKwJQ35TbCpESqsyLKo1r..HvxF5VEie', 'Unit Head');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjaman`
--

CREATE TABLE `tb_pinjaman` (
  `kode_pinjaman` int(11) NOT NULL,
  `kode_pp` int(11) DEFAULT NULL,
  `kode_nasabah` int(11) DEFAULT NULL,
  `dana_pinjaman` int(11) DEFAULT NULL,
  `lama_ansuran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `tb_nasabah`
--
ALTER TABLE `tb_nasabah`
  ADD PRIMARY KEY (`kode_nasabah`);

--
-- Indeks untuk tabel `tb_pengajuan_peminjaman`
--
ALTER TABLE `tb_pengajuan_peminjaman`
  ADD PRIMARY KEY (`kode_pp`),
  ADD KEY `kode_nasabah` (`kode_nasabah`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`kode_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD PRIMARY KEY (`kode_pinjaman`),
  ADD KEY `kode_pp` (`kode_pp`),
  ADD KEY `kode_nasabah` (`kode_nasabah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `tb_nasabah`
--
ALTER TABLE `tb_nasabah`
  MODIFY `kode_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan_peminjaman`
--
ALTER TABLE `tb_pengajuan_peminjaman`
  MODIFY `kode_pp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `kode_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  MODIFY `kode_pinjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pengajuan_peminjaman`
--
ALTER TABLE `tb_pengajuan_peminjaman`
  ADD CONSTRAINT `tb_pengajuan_peminjaman_ibfk_1` FOREIGN KEY (`kode_nasabah`) REFERENCES `tb_nasabah` (`kode_nasabah`);

--
-- Ketidakleluasaan untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD CONSTRAINT `tb_pinjaman_ibfk_1` FOREIGN KEY (`kode_pp`) REFERENCES `tb_pengajuan_peminjaman` (`kode_pp`),
  ADD CONSTRAINT `tb_pinjaman_ibfk_2` FOREIGN KEY (`kode_nasabah`) REFERENCES `tb_nasabah` (`kode_nasabah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
