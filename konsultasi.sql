-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 03:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konsultasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `psikolog_id` varchar(255) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `waktu_konsultasi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nik` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `ttl` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `appointment_id` int(11) NOT NULL,
  `tagihan` varchar(255) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `psikolog`
--

CREATE TABLE `psikolog` (
  `psikolog_id` varchar(255) NOT NULL,
  `nama_psikolog` varchar(255) NOT NULL,
  `ttl` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psikolog`
--

INSERT INTO `psikolog` (`psikolog_id`, `nama_psikolog`, `ttl`, `jenis_kelamin`) VALUES
('DJ6Z1', 'Dra. Soerjantini Rahayu, M.A.', '1961-01-02', 'P'),
('JBTH2', 'Drs. Budi Santoso, M.Si.', '1973-05-16', 'L'),
('M8WC3', 'Sri Rahmani, S.Psi., M.Psi., Psikolog', '1987-07-26', 'P'),
('UQ4W5', 'Dr. Slamet Hassan, S.Psi., M.Si.', '1967-11-30', 'L'),
('VNJ24', 'Bianca Siregar, S.Psi, Ph.D', '1990-11-21', 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_nik_fkey` (`nik`),
  ADD KEY `appointment_psikolog_id_fkey` (`psikolog_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `psikolog`
--
ALTER TABLE `psikolog`
  ADD PRIMARY KEY (`psikolog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_nik_fkey` FOREIGN KEY (`nik`) REFERENCES `pasien` (`nik`),
  ADD CONSTRAINT `appointment_psikolog_id_fkey` FOREIGN KEY (`psikolog_id`) REFERENCES `psikolog` (`psikolog_id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_appointment_id_fkey` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
