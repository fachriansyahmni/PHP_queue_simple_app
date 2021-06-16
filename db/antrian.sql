-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2021 pada 18.29
-- Versi server: 10.5.10-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `uniqueid` varchar(200) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `loket_id` int(20) DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `call_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `uniqueid`, `nomor`, `loket_id`, `is_done`, `call_at`, `created_at`) VALUES
(217, '689880290e97', '1', 1, 1, '2021-06-16 14:26:01', '2021-06-16 14:25:51'),
(218, '928bd4274393', '2', 1, 1, '2021-06-16 14:36:48', '2021-06-16 14:36:40'),
(219, '3fa402fce94f', '3', 1, 1, '2021-06-16 14:37:00', '2021-06-16 14:36:42'),
(220, 'cc509cd0922f', '4', 1, 1, '2021-06-16 14:37:08', '2021-06-16 14:36:46'),
(221, 'bef2a9911cef', '5', 1, 1, '2021-06-16 14:40:02', '2021-06-16 14:39:59'),
(222, '289c3814dee1', '6', 1, 1, '2021-06-16 14:40:19', '2021-06-16 14:40:17'),
(223, 'b81ec8c75a46', '7', 1, 1, '2021-06-16 15:15:26', '2021-06-16 15:15:24'),
(224, '752bfd24212a', '8', 1, 1, '2021-06-16 15:16:05', '2021-06-16 15:16:04'),
(225, '63d3588aa696', '9', 1, 1, '2021-06-16 15:41:27', '2021-06-16 15:40:59'),
(226, 'afcaa90b3e20', '10', 1, 0, '2021-06-16 15:52:43', '2021-06-16 15:52:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_antrian`
--

CREATE TABLE `config_antrian` (
  `id` int(11) NOT NULL,
  `current_queue` varchar(225) DEFAULT NULL,
  `last_queue` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `config_antrian`
--

INSERT INTO `config_antrian` (`id`, `current_queue`, `last_queue`) VALUES
(1, '10', '9');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokets`
--

CREATE TABLE `lokets` (
  `id` int(15) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `aliases` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lokets`
--

INSERT INTO `lokets` (`id`, `unique_id`, `name`, `aliases`) VALUES
(1, 'loket1', 'Loket 1', '1'),
(2, 'loket2', 'Loket 2', '2'),
(3, 'loket3', 'Loket 3', '3'),
(4, 'loket4', 'Loket 4', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `panggil`
--

CREATE TABLE `panggil` (
  `id` int(11) NOT NULL,
  `urut` varchar(50) NOT NULL,
  `loket` varchar(50) NOT NULL,
  `waktu` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide_images`
--

CREATE TABLE `slide_images` (
  `id` int(11) NOT NULL,
  `position` int(10) NOT NULL,
  `src` varchar(200) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slide_images`
--

INSERT INTO `slide_images` (`id`, `position`, `src`, `visible`) VALUES
(1, 2, 'https://mmc.tirto.id/image/otf/1024x535/2020/06/25/slider-1.0a8a163d_ratio-16x9.jpg', 1),
(2, 1, 'https://1.bp.blogspot.com/-Q3-uAvEDJSc/YH4tMLNgsUI/AAAAAAAAIkM/YBdt3mm12MYo5VbTrWvQv8HWFuj6KLjUQCLcBGAsYHQ/s600/5.%2BJuknis%2BPPDB%2BJabar%2BTahun%2B2021.PNG', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(16) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) DEFAULT 'counter',
  `loket_id` int(10) DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `loket_id`, `is_blocked`) VALUES
(1, 'admin', 'admin', 'admin123', 'admin', NULL, 0),
(2, 'loket 1', 'loket1', 'loket1', 'counter', 1, 0),
(3, 'Loket 2', 'loket2', 'loket2', 'counter', 2, 0),
(4, 'Loket 4', 'loket4', 'loket123', 'counter', 4, 0),
(5, 'Loket 3', 'loket3', 'loket123', 'counter', 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_monitoring`
--

CREATE TABLE `video_monitoring` (
  `id` int(11) NOT NULL,
  `src` varchar(200) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `video_monitoring`
--

INSERT INTO `video_monitoring` (`id`, `src`, `visible`) VALUES
(1, 'assets/videos/video.mp4', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config_antrian`
--
ALTER TABLE `config_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokets`
--
ALTER TABLE `lokets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indeks untuk tabel `panggil`
--
ALTER TABLE `panggil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slide_images`
--
ALTER TABLE `slide_images`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `video_monitoring`
--
ALTER TABLE `video_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT untuk tabel `config_antrian`
--
ALTER TABLE `config_antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lokets`
--
ALTER TABLE `lokets`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `panggil`
--
ALTER TABLE `panggil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `slide_images`
--
ALTER TABLE `slide_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `video_monitoring`
--
ALTER TABLE `video_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
