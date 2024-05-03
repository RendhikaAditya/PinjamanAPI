-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2024 pada 12.54
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
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `kode_pp`, `bulan_pembayaran`, `nominal_bayaran`, `status`) VALUES
(1, 11, 1, 'Rp 283.333,00', 'Diterima'),
(2, 11, 2, 'Rp 283.333,00', 'Diterima'),
(3, 11, 3, 'Rp 283.333,00', 'Bayar'),
(4, 11, 4, 'Rp 283.333,00', 'Belum'),
(5, 11, 5, 'Rp 283.333,00', 'Belum'),
(6, 11, 6, 'Rp 283.333,00', 'Belum'),
(7, 11, 7, 'Rp 283.333,00', 'Belum'),
(8, 11, 8, 'Rp 283.333,00', 'Belum'),
(9, 11, 9, 'Rp 283.333,00', 'Belum'),
(10, 11, 10, 'Rp 283.333,00', 'Belum'),
(11, 11, 11, 'Rp 283.333,00', 'Belum'),
(12, 11, 12, 'Rp 283.333,00', 'Belum'),
(13, 11, 13, 'Rp 283.333,00', 'Belum'),
(14, 11, 14, 'Rp 283.333,00', 'Belum'),
(15, 11, 15, 'Rp 283.333,00', 'Belum'),
(16, 11, 16, 'Rp 283.333,00', 'Belum'),
(17, 11, 17, 'Rp 283.333,00', 'Belum'),
(18, 11, 18, 'Rp 283.333,00', 'Belum'),
(19, 11, 19, 'Rp 283.333,00', 'Belum'),
(20, 11, 20, 'Rp 283.333,00', 'Belum'),
(21, 11, 21, 'Rp 283.333,00', 'Belum'),
(22, 11, 22, 'Rp 283.333,00', 'Belum'),
(23, 11, 23, 'Rp 283.333,00', 'Belum'),
(24, 11, 24, 'Rp 283.333,00', 'Belum'),
(25, 11, 25, 'Rp 283.333,00', 'Belum'),
(26, 11, 26, 'Rp 283.333,00', 'Belum'),
(27, 11, 27, 'Rp 283.333,00', 'Belum'),
(28, 11, 28, 'Rp 283.333,00', 'Belum'),
(29, 11, 29, 'Rp 283.333,00', 'Belum'),
(30, 11, 30, 'Rp 283.333,00', 'Belum');

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

INSERT INTO `tb_pengajuan_peminjaman` (`kode_pp`, `kode_nasabah`, `tgl_pengajuan`, `foto_ktp`, `foto_kk`, `foto_unit`, `berkas_pinjaman`, `dana_pinjaman_diajukan`, `dana_pinjaman_diterima`, `lama_ansuran`, `status_pengajuan`, `keterangan`) VALUES
(1, 1, '2024-02-26', 'foto_ktp_budi.jpg', 'foto_kk_budi.jpg', 'foto_unit_budi.jpg', '', 10000000, 8000000, '12 bulan', 'Di terima', 'Pinjaman Di setujui'),
(2, 6, '2024-02-26', 'foto_ktp_ani.jpg', 'foto_kk_ani.jpg', 'foto_unit_ani.jpg', '', 15000000, 12000000, '24 bulan', 'Di terima', 'Dana sudah disetujui'),
(3, 1, '2024-03-08', '1709869408_ktp.jpg', '1709869408_kk.jpg', '1709869408_unit.jpg', '', 100000, 0, '24 Bulan', 'Di tolak', 'Pijaman Ditolak'),
(4, 6, '2024-03-08', '1709869411_ktp.jpg', '1709869411_kk.jpg', '1709869411_unit.jpg', '', 1800000, 1000000, '48 Bulan', 'Di terima', 'Pinjaman di terima'),
(5, 6, '2024-03-17', '1710655792_ktp.jpg', '1710655792_kk.jpg', '1710655792_unit.jpg', '', 5460000, 5100000, '24 Bulan', 'Di terima', 'Pinjaman Di setujui'),
(6, 6, '2024-04-01', '1711939054_ktp.jpg', '1711939054_kk.jpg', '1711939054_unit.jpg', '', 1200000, 0, '6 Bulan', 'konfirmasi', 'Sedang Diproses'),
(7, 6, '2024-04-01', '1711939497_ktp.jpg', '1711939497_kk.jpg', '1711939497_unit.jpg', '', 1000000, 0, '6 Bulan', 'konfirmasi', 'Sedang Diproses'),
(8, 6, '2024-04-01', '1711939650_ktp.jpg', '1711939650_kk.jpg', '1711939650_unit.jpg', '', 1000000, 0, '6 Bulan', 'konfirmasi', 'Sedang Diproses'),
(9, 6, '2024-04-01', '1711940191_ktp.jpg', '1711940191_kk.jpg', '1711940191_unit.jpg', '', 5000000, 0, '6 Bulan', 'konfirmasi', 'Sedang Diproses'),
(10, 6, '2024-04-01', '1711952693_ktp.jpg', '1711952693_kk.jpg', '1711952693_unit.jpg', '', 500000, 0, '6 Bulan', 'konfirmasi', 'Sedang Diproses'),
(11, 6, '2024-04-02', '1712031185_ktp.jpg', '1712031185_kk.jpg', '1712031185_unit.jpg', '1712031185_file.pdf', 5000000, 1000000, '30 Bulan', 'Di terima', 'Pinjaman Di setujui'),
(12, 6, '2024-04-21', '1713666763_ktp.jpg', '1713666763_kk.jpg', '1713666763_unit.jpg', '1713666763_file.pdf', 5000000, 0, '12 Bulan', 'konfirmasi', 'Sedang Diproses'),
(13, 6, '2024-04-21', '1713666973_ktp.jpg', '1713666973_kk.jpg', '1713666973_unit.jpg', '1713666973_file.pdf', 5000000, 5000000, '12 Bulan', 'Di terima', 'Pinjaman Di setujui');

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
-- Dumping data untuk tabel `tb_pinjaman`
--

INSERT INTO `tb_pinjaman` (`kode_pinjaman`, `kode_pp`, `kode_nasabah`, `dana_pinjaman`, `lama_ansuran`) VALUES
(1, 1, 1, 9000000, 12),
(2, 2, 2, 12000000, 24);

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
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_nasabah`
--
ALTER TABLE `tb_nasabah`
  MODIFY `kode_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan_peminjaman`
--
ALTER TABLE `tb_pengajuan_peminjaman`
  MODIFY `kode_pp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `kode_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  MODIFY `kode_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
