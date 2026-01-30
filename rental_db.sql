-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 12:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_asuransi`
--

CREATE TABLE `master_asuransi` (
  `id_asuransi` varchar(6) NOT NULL,
  `nama_asuransi` varchar(100) DEFAULT NULL,
  `biaya_harian` decimal(10,2) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_asuransi`
--

INSERT INTO `master_asuransi` (`id_asuransi`, `nama_asuransi`, `biaya_harian`, `deskripsi`) VALUES
('A001', 'Asuransi ABC', 50000.00, 'Perlindungan dasar'),
('A002', 'Asuransi XYZ', 75000.00, 'Perlindungan all-risk'),
('A003', 'Asuransi Nasional', 60000.00, 'Perlindungan kendaraan'),
('A004', 'Asuransi Global', 85000.00, 'Perlindungan penuh'),
('A005', 'Asuransi Motor', 30000.00, 'Perlindungan terbatas'),
('A006', 'Asuransi Plus', 90000.00, 'Perlindungan premium'),
('A007', 'Asuransi Hemat', 40000.00, 'Perlindungan ekonomis'),
('A008', 'Asuransi Keluarga', 65000.00, 'Perlindungan keluarga'),
('A009', 'Asuransi Travel', 55000.00, 'Perlindungan perjalanan'),
('A010', 'Asuransi Protek', 70000.00, 'Perlindungan lengkap'),
('A011', 'Asuransi Prima', 72000.00, 'Perlindungan prima'),
('A012', 'Asuransi Aman', 48000.00, 'Perlindungan aman'),
('A013', 'Asuransi Solusi', 53000.00, 'Perlindungan solusi'),
('A014', 'Asuransi Sejahtera', 68000.00, 'Perlindungan sejahtera'),
('A015', 'Asuransi Mandiri', 62000.00, 'Perlindungan mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_mobil`
--

CREATE TABLE `master_jenis_mobil` (
  `id_jenis` varchar(5) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_jenis_mobil`
--

INSERT INTO `master_jenis_mobil` (`id_jenis`, `nama_jenis`, `deskripsi`) VALUES
('J01', 'MPV', 'Multi Purpose Vehicle - cocok keluarga'),
('J02', 'Hatchback', 'Mobil kecil hemat bahan bakar'),
('J03', 'SUV', 'Sport Utility Vehicle - kuat dan luas'),
('J04', 'Sedan', 'Mobil nyaman untuk jalan raya'),
('J05', 'LUX', 'Luxury - nyaman dan mewah'),
('J06', 'Pickup', 'Truk kecil untuk angkut barang'),
('J07', 'Minibus', 'Kapasitas besar untuk rombongan'),
('J08', 'Compact', 'Kecil dan lincah di kota'),
('J09', 'Electric', 'Mobil listrik'),
('J10', 'Crossover', 'Gabungan SUV dan hatchback'),
('J11', 'Convertible', 'Buka atap'),
('J12', 'Van', 'Mobil angkut banyak penumpang'),
('J13', 'Coupe', 'Sport dua pintu'),
('J14', 'Offroad', 'Tangguh medan berat'),
('J15', 'Micro', 'Sangat kecil dan efisien');

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi_pengambilan`
--

CREATE TABLE `master_lokasi_pengambilan` (
  `id_lokasi` varchar(6) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_lokasi_pengambilan`
--

INSERT INTO `master_lokasi_pengambilan` (`id_lokasi`, `nama_lokasi`, `alamat`, `kota`) VALUES
('L001', 'Bandung - Stasiun', 'Jl. Stasiun No.1', 'Bandung'),
('L002', 'Jakarta - Soekarno Hatta', 'Jl. Airport No.2', 'Jakarta'),
('L003', 'Surabaya - CBD', 'Jl. Raya No.3', 'Surabaya'),
('L004', 'Yogyakarta - Malioboro', 'Jl. Malioboro No.4', 'Yogyakarta'),
('L005', 'Semarang - Simpang Lima', 'Jl. Pahlawan No.5', 'Semarang'),
('L006', 'Malang - Stasiun', 'Jl. Merdeka No.6', 'Malang'),
('L007', 'Denpasar - Kuta', 'Jl. Pantai Kuta No.7', 'Denpasar'),
('L008', 'Medan - Polonia', 'Jl. Polonia No.8', 'Medan'),
('L009', 'Makassar - Losari', 'Jl. Losari No.9', 'Makassar'),
('L010', 'Solo - Balapan', 'Jl. Balapan No.10', 'Solo'),
('L011', 'Pontianak - Kota', 'Jl. Sultan No.11', 'Pontianak'),
('L012', 'Palembang - Pleburan', 'Jl. Diponegoro No.12', 'Palembang'),
('L013', 'Cirebon - Kejaksan', 'Jl. Siliwangi No.13', 'Cirebon'),
('L014', 'Bekasi - Barat', 'Jl. Ahmad Yani No.14', 'Bekasi'),
('L015', 'Tangerang - BSD', 'Jl. BSD No.15', 'Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `master_metode_pembayaran`
--

CREATE TABLE `master_metode_pembayaran` (
  `id_metode` varchar(6) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_metode_pembayaran`
--

INSERT INTO `master_metode_pembayaran` (`id_metode`, `nama_metode`, `keterangan`) VALUES
('MP001', 'Tunai', 'Pembayaran tunai di lokasi'),
('MP002', 'Transfer Bank', 'Transfer antar bank'),
('MP003', 'Kartu Kredit', 'Kartu kredit Visa/Master'),
('MP004', 'E-Wallet', 'OVO/GoPay/Dana'),
('MP005', 'Cicilan', 'Bayar dengan cicilan'),
('MP006', 'Debit', 'Debit online'),
('MP007', 'Virtual Account', 'VA bank'),
('MP008', 'COD', 'Bayar di tempat'),
('MP009', 'QRIS', 'Bayar via QR'),
('MP010', 'ShopPay', 'Marketplace pay'),
('MP011', 'PayLater', 'Bayar nanti'),
('MP012', 'Kartu Debit Internasional', 'Debit internasional'),
('MP013', 'Direct Debit', 'Direct debit'),
('MP014', 'Gift Card', 'Voucher/kupon'),
('MP015', 'Payroll', 'Potong gaji');

-- --------------------------------------------------------

--
-- Table structure for table `master_mobil`
--

CREATE TABLE `master_mobil` (
  `id_mobil` varchar(6) NOT NULL,
  `id_jenis` varchar(5) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `harga_sewa_per_hari` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_mobil`
--

INSERT INTO `master_mobil` (`id_mobil`, `id_jenis`, `merk`, `model`, `tahun`, `harga_sewa_per_hari`, `status`) VALUES
('M001', 'J01', 'Toyota', 'Avanza', '2020', 350000.00, 'tersedia'),
('M002', 'J02', 'Honda', 'Brio', '2021', 300000.00, 'tersedia'),
('M003', 'J01', 'Mitsubishi', 'Xpander', '2022', 450000.00, 'disewa'),
('M004', 'J03', 'Toyota', 'Fortuner', '2019', 800000.00, 'tersedia'),
('M005', 'J04', 'Honda', 'Civic', '2018', 500000.00, 'tersedia'),
('M006', 'J08', 'Suzuki', 'Ignis', '2020', 280000.00, 'tersedia'),
('M007', 'J09', 'Tesla', 'Model 3', '2023', 1200000.00, 'tersedia'),
('M008', 'J05', 'Mercedes', 'C200', '2017', 1100000.00, 'tersedia'),
('M009', 'J06', 'Isuzu', 'D-Max', '2019', 400000.00, 'tersedia'),
('M010', 'J07', 'Toyota', 'Hiace', '2016', 700000.00, 'tersedia'),
('M011', 'J11', 'Mazda', 'MX-5', '2020', 950000.00, 'tersedia'),
('M012', 'J12', 'Nissan', 'Urvan', '2015', 600000.00, 'tersedia'),
('M013', 'J13', 'BMW', 'M4', '2021', 1500000.00, 'tersedia'),
('M014', 'J14', 'Jeep', 'Wrangler', '2018', 900000.00, 'tersedia'),
('M015', 'J15', 'Smart', 'ForTwo', '2019', 200000.00, 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `master_pelanggan`
--

CREATE TABLE `master_pelanggan` (
  `id_pelanggan` varchar(6) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_pelanggan`
--

INSERT INTO `master_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `alamat`, `email`) VALUES
('P001', 'Andi Saputra', '081234567001', 'Bandung', 'andi.saputra@example.com'),
('P002', 'Budi Santoso', '081234567002', 'Jakarta', 'budi.santoso@example.com'),
('P003', 'Citra Dewi', '081234567003', 'Surabaya', 'citra.dewi@example.com'),
('P004', 'Dewi Lestari', '081234567004', 'Yogyakarta', 'dewi.lestari@example.com'),
('P005', 'Eko Prasetyo', '081234567005', 'Semarang', 'eko.prasetyo@example.com'),
('P006', 'Fajar Hidayat', '081234567006', 'Malang', 'fajar.hidayat@example.com'),
('P007', 'Gita Ramadhani', '081234567007', 'Denpasar', 'gita.ramadhani@example.com'),
('P008', 'Hendra Gunawan', '081234567008', 'Medan', 'hendra.gunawan@example.com'),
('P009', 'Intan Permata', '081234567009', 'Makassar', 'intan.permata@example.com'),
('P010', 'Joko Widodo', '081234567010', 'Solo', 'joko.w@example.com'),
('P011', 'Kiki Amalia', '081234567011', 'Pontianak', 'kiki.amalia@example.com'),
('P012', 'Lina Marlina', '081234567012', 'Palembang', 'lina.marlina@example.com'),
('P013', 'Maman Suherman', '081234567013', 'Cirebon', 'maman.s@example.com'),
('P014', 'Nina Andriana', '081234567014', 'Bekasi', 'nina.andriana@example.com'),
('P015', 'Oki Setiawan', '081234567015', 'Tangerang', 'oki.setiawan@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `master_promo`
--

CREATE TABLE `master_promo` (
  `id_promo` varchar(6) NOT NULL,
  `nama_promo` varchar(100) DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `syarat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_promo`
--

INSERT INTO `master_promo` (`id_promo`, `nama_promo`, `diskon_persen`, `syarat`) VALUES
('PR01', 'Promo Tahun Baru', 10, 'Minimal 2 hari sewa'),
('PR02', 'Promo Long Weekend', 15, 'Periode liburan tertentu'),
('PR03', 'Promo Pelajar', 20, 'Tunjukkan kartu pelajar'),
('PR04', 'Promo Bulanan', 25, 'Sewa 30 hari'),
('PR05', 'Promo Weekend', 5, 'Sewa Sabtu-Minggu'),
('PR06', 'Promo EarlyBird', 8, 'Pesan 7 hari sebelumnya'),
('PR07', 'Promo Ramadhan', 12, 'Periode Ramadhan'),
('PR08', 'Promo Loyalty', 10, 'Untuk pelanggan tetap'),
('PR09', 'Promo Student', 18, 'Mahasiswa aktif'),
('PR10', 'Promo Couple', 7, 'Pemesanan ganda'),
('PR11', 'Promo Corporate', 15, 'Perusahaan terdaftar'),
('PR12', 'Promo Partner', 10, 'Mitra spesial'),
('PR13', 'Promo NewUser', 20, 'Pengguna baru'),
('PR14', 'Promo Cashback', 5, 'Minimal transaksi Rp500.000'),
('PR15', 'Promo FlashSale', 30, 'Kuota terbatas');

-- --------------------------------------------------------

--
-- Table structure for table `master_sopir`
--

CREATE TABLE `master_sopir` (
  `id_sopir` varchar(6) NOT NULL,
  `nama_sopir` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `sim` varchar(20) DEFAULT NULL,
  `tarif_harian` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_sopir`
--

INSERT INTO `master_sopir` (`id_sopir`, `nama_sopir`, `no_hp`, `sim`, `tarif_harian`) VALUES
('S001', 'Rizky Kurniawan', '08134567001', 'SIM A', 150000.00),
('S002', 'Hadi Pranoto', '08134567002', 'SIM A', 150000.00),
('S003', 'Siti Nurhaliza', '08134567003', 'SIM A', 175000.00),
('S004', 'Anton Wijaya', '08134567004', 'SIM A', 160000.00),
('S005', 'Wulan Sari', '08134567005', 'SIM A', 140000.00),
('S006', 'Dedi Prasetyo', '08134567006', 'SIM A', 155000.00),
('S007', 'Maya Farida', '08134567007', 'SIM A', 145000.00),
('S008', 'Rudy Santoso', '08134567008', 'SIM A', 150000.00),
('S009', 'Tika Lestari', '08134567009', 'SIM A', 148000.00),
('S010', 'Bambang Irawan', '08134567010', 'SIM A', 160000.00),
('S011', 'Lulu Kurniati', '08134567011', 'SIM A', 152000.00),
('S012', 'Yusuf Hidayat', '08134567012', 'SIM A', 149000.00),
('S013', 'Rina Marlina', '08134567013', 'SIM A', 147000.00),
('S014', 'Edi Susanto', '08134567014', 'SIM A', 151000.00),
('S015', 'Vina Putri', '08134567015', 'SIM A', 146000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_asuransi`
--

CREATE TABLE `transaksi_asuransi` (
  `id_trans_asuransi` varchar(8) NOT NULL,
  `id_transaksi` varchar(6) DEFAULT NULL,
  `id_asuransi` varchar(6) DEFAULT NULL,
  `total_biaya_asuransi` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_asuransi`
--

INSERT INTO `transaksi_asuransi` (`id_trans_asuransi`, `id_transaksi`, `id_asuransi`, `total_biaya_asuransi`) VALUES
('TA0001', 'T001', 'A001', 100000.00),
('TA0002', 'T002', 'A002', 375000.00),
('TA0003', 'T003', 'A001', 50000.00),
('TA0004', 'T004', 'A004', 680000.00),
('TA0005', 'T005', 'A001', 100000.00),
('TA0006', 'T006', 'A007', 80000.00),
('TA0007', 'T007', 'A006', 180000.00),
('TA0008', 'T008', 'A008', 195000.00),
('TA0009', 'T009', 'A003', 120000.00),
('TA0010', 'T010', 'A010', 350000.00),
('TA0011', 'T011', 'A011', 68400.00),
('TA0012', 'T012', 'A012', 240000.00),
('TA0013', 'T013', 'A014', 204000.00),
('TA0014', 'T014', 'A015', 68000.00),
('TA0015', 'T015', 'A009', 80000.00),
('TA0016', 'T016', 'A001', 100000.00),
('TA0017', 'T017', 'A002', 150000.00),
('TA0018', 'T018', 'A003', 240000.00),
('TA0019', 'T019', 'A004', 200000.00),
('TA0020', 'T020', 'A005', 22500.00),
('TA0021', 'T021', 'A006', 360000.00),
('TA0022', 'T022', 'A006', 450000.00),
('TA0023', 'T023', 'A007', 65000.00),
('TA0024', 'T024', 'A008', 220000.00),
('TA0025', 'T025', 'A009', 140000.00),
('TA0026', 'T026', 'A010', 66500.00),
('TA0027', 'T027', 'A011', 360000.00),
('TA0028', 'T028', 'A012', 300000.00),
('TA0029', 'T029', 'A013', 95000.00),
('TA0030', 'T030', 'A014', 81600.00),
('TA0031', 'T031', 'A015', 70000.00),
('TA0032', 'T032', 'A001', 120000.00),
('TA0033', 'T033', 'A002', 180000.00),
('TA0034', 'T034', 'A003', 320000.00),
('TA0035', 'T035', 'A004', 200000.00),
('TA0036', 'T036', 'A005', 28000.00),
('TA0037', 'T037', 'A006', 360000.00),
('TA0038', 'T038', 'A007', 55000.00),
('TA0039', 'T039', 'A008', 220000.00),
('TA0040', 'T040', 'A009', 350000.00),
('TA0041', 'T041', 'A010', 68400.00),
('TA0042', 'T042', 'A011', 288000.00),
('TA0043', 'T043', 'A012', 315000.00),
('TA0044', 'T044', 'A013', 61200.00),
('TA0045', 'T045', 'A014', 136000.00),
('TA0046', 'T046', 'A015', 272000.00),
('TA0047', 'T047', 'A001', 200000.00),
('TA0048', 'T048', 'A002', 28000.00),
('TA0049', 'T049', 'A003', 240000.00),
('TA0050', 'T050', 'A004', 352000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id_bayar` varchar(6) NOT NULL,
  `id_transaksi` varchar(6) DEFAULT NULL,
  `id_metode` varchar(6) DEFAULT NULL,
  `jumlah` decimal(12,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_pembayaran` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`id_bayar`, `id_transaksi`, `id_metode`, `jumlah`, `tanggal`, `status_pembayaran`) VALUES
('B001', 'T001', 'MP001', 700000.00, '2025-01-05', 'lunas'),
('B002', 'T002', 'MP002', 2250000.00, '2025-01-10', 'lunas'),
('B003', 'T003', 'MP004', 300000.00, '2025-01-08', 'lunas'),
('B004', 'T004', 'MP003', 6400000.00, '2025-01-12', 'lunas'),
('B005', 'T005', 'MP001', 1000000.00, '2025-02-01', 'lunas'),
('B006', 'T006', 'MP004', 560000.00, '2025-02-05', 'lunas'),
('B007', 'T007', 'MP003', 2400000.00, '2025-02-10', 'lunas'),
('B008', 'T008', 'MP002', 3300000.00, '2025-02-15', 'lunas'),
('B009', 'T009', 'MP001', 1200000.00, '2025-03-01', 'lunas'),
('B010', 'T010', 'MP005', 4900000.00, '2025-03-05', 'lunas'),
('B011', 'T011', 'MP004', 950000.00, '2025-03-10', 'lunas'),
('B012', 'T012', 'MP002', 3000000.00, '2025-03-15', 'lunas'),
('B013', 'T013', 'MP006', 4500000.00, '2025-04-01', 'lunas'),
('B014', 'T014', 'MP004', 900000.00, '2025-04-05', 'lunas'),
('B015', 'T015', 'MP001', 400000.00, '2025-04-10', 'lunas'),
('B016', 'T016', 'MP002', 600000.00, '2025-04-15', 'lunas'),
('B017', 'T017', 'MP001', 1600000.00, '2025-04-20', 'lunas'),
('B018', 'T018', 'MP003', 2000000.00, '2025-04-25', 'lunas'),
('B019', 'T019', 'MP004', 1400000.00, '2025-05-01', 'lunas'),
('B020', 'T020', 'MP001', 450000.00, '2025-05-06', 'lunas'),
('B021', 'T021', 'MP004', 1120000.00, '2025-05-10', 'lunas'),
('B022', 'T022', 'MP002', 6000000.00, '2025-05-15', 'lunas'),
('B023', 'T023', 'MP001', 1100000.00, '2025-05-21', 'lunas'),
('B024', 'T024', 'MP003', 1600000.00, '2025-06-01', 'lunas'),
('B025', 'T025', 'MP005', 2800000.00, '2025-06-06', 'lunas'),
('B026', 'T026', 'MP004', 950000.00, '2025-06-11', 'lunas'),
('B027', 'T027', 'MP002', 3000000.00, '2025-06-13', 'lunas'),
('B028', 'T028', 'MP003', 7500000.00, '2025-06-20', 'lunas'),
('B029', 'T029', 'MP001', 1800000.00, '2025-07-01', 'lunas'),
('B030', 'T030', 'MP002', 600000.00, '2025-07-05', 'lunas'),
('B031', 'T031', 'MP004', 350000.00, '2025-07-10', 'lunas'),
('B032', 'T032', 'MP001', 900000.00, '2025-07-12', 'lunas'),
('B033', 'T033', 'MP002', 1800000.00, '2025-07-16', 'lunas'),
('B034', 'T034', 'MP003', 3200000.00, '2025-07-21', 'lunas'),
('B035', 'T035', 'MP004', 2000000.00, '2025-08-01', 'lunas'),
('B036', 'T036', 'MP001', 280000.00, '2025-08-06', 'lunas'),
('B037', 'T037', 'MP002', 4800000.00, '2025-08-08', 'lunas'),
('B038', 'T038', 'MP004', 1100000.00, '2025-08-15', 'lunas'),
('B039', 'T039', 'MP001', 1600000.00, '2025-08-18', 'lunas'),
('B040', 'T040', 'MP006', 4900000.00, '2025-08-24', 'lunas'),
('B041', 'T041', 'MP002', 950000.00, '2025-09-01', 'lunas'),
('B042', 'T042', 'MP003', 2400000.00, '2025-09-03', 'lunas'),
('B043', 'T043', 'MP001', 4500000.00, '2025-09-08', 'lunas'),
('B044', 'T044', 'MP004', 900000.00, '2025-09-12', 'lunas'),
('B045', 'T045', 'MP001', 400000.00, '2025-09-14', 'lunas'),
('B046', 'T046', 'MP002', 3200000.00, '2025-09-18', 'lunas'),
('B047', 'T047', 'MP004', 1000000.00, '2025-09-25', 'lunas'),
('B048', 'T048', 'MP001', 280000.00, '2025-09-28', 'lunas'),
('B049', 'T049', 'MP003', 2400000.00, '2025-10-01', 'lunas'),
('B050', 'T050', 'MP002', 4400000.00, '2025-10-05', 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pengembalian`
--

CREATE TABLE `transaksi_pengembalian` (
  `id_kembali` varchar(6) NOT NULL,
  `id_transaksi` varchar(6) DEFAULT NULL,
  `kondisi_mobil` varchar(200) DEFAULT NULL,
  `biaya_denda` decimal(12,2) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_pengembalian`
--

INSERT INTO `transaksi_pengembalian` (`id_kembali`, `id_transaksi`, `kondisi_mobil`, `biaya_denda`, `tanggal_kembali`, `catatan`) VALUES
('R001', 'T001', 'Baik', 0.00, '2025-01-07', ''),
('R002', 'T002', 'Baik', 0.00, '2025-01-15', ''),
('R003', 'T003', 'Baik', 0.00, '2025-01-09', ''),
('R004', 'T004', 'Baik', 0.00, '2025-01-20', ''),
('R005', 'T005', 'Baik', 0.00, '2025-02-03', ''),
('R006', 'T006', 'Baik', 0.00, '2025-02-07', ''),
('R007', 'T007', 'Gores kecil', 100000.00, '2025-02-12', 'Gores di pintu'),
('R008', 'T008', 'Baik', 0.00, '2025-02-18', ''),
('R009', 'T009', 'Baik', 0.00, '2025-03-04', ''),
('R010', 'T010', 'Baik', 0.00, '2025-03-12', ''),
('R011', 'T011', 'Baik', 0.00, '2025-03-11', ''),
('R012', 'T012', 'Baik', 0.00, '2025-03-20', ''),
('R013', 'T013', 'Baik', 0.00, '2025-04-04', ''),
('R014', 'T014', 'Baik', 0.00, '2025-04-06', ''),
('R015', 'T015', 'Baik', 0.00, '2025-04-12', ''),
('R016', 'T016', 'Baik', 0.00, '2025-04-17', ''),
('R017', 'T017', 'Baik', 0.00, '2025-04-22', ''),
('R018', 'T018', 'Baik', 0.00, '2025-04-29', ''),
('R019', 'T019', 'Baik', 0.00, '2025-05-05', ''),
('R020', 'T020', 'Baik', 0.00, '2025-05-07', ''),
('R021', 'T021', 'Baik', 0.00, '2025-05-14', ''),
('R022', 'T022', 'Baik', 0.00, '2025-05-20', ''),
('R023', 'T023', 'Baik', 0.00, '2025-05-22', ''),
('R024', 'T024', 'Baik', 0.00, '2025-06-05', ''),
('R025', 'T025', 'Baik', 0.00, '2025-06-10', ''),
('R026', 'T026', 'Baik', 0.00, '2025-06-12', ''),
('R027', 'T027', 'Baik', 0.00, '2025-06-18', ''),
('R028', 'T028', 'Baik', 0.00, '2025-06-25', ''),
('R029', 'T029', 'Baik', 0.00, '2025-07-03', ''),
('R030', 'T030', 'Baik', 0.00, '2025-07-08', ''),
('R031', 'T031', 'Baik', 0.00, '2025-07-11', ''),
('R032', 'T032', 'Baik', 0.00, '2025-07-15', ''),
('R033', 'T033', 'Baik', 0.00, '2025-07-20', ''),
('R034', 'T034', 'Baik', 0.00, '2025-07-25', ''),
('R035', 'T035', 'Baik', 0.00, '2025-08-05', ''),
('R036', 'T036', 'Baik', 0.00, '2025-08-07', ''),
('R037', 'T037', 'Baik', 0.00, '2025-08-12', ''),
('R038', 'T038', 'Baik', 0.00, '2025-08-16', ''),
('R039', 'T039', 'Baik', 0.00, '2025-08-22', ''),
('R040', 'T040', 'Baik', 0.00, '2025-08-31', ''),
('R041', 'T041', 'Baik', 0.00, '2025-09-02', ''),
('R042', 'T042', 'Baik', 0.00, '2025-09-07', ''),
('R043', 'T043', 'Baik', 0.00, '2025-09-11', ''),
('R044', 'T044', 'Baik', 0.00, '2025-09-13', ''),
('R045', 'T045', 'Baik', 0.00, '2025-09-16', ''),
('R046', 'T046', 'Baik', 0.00, '2025-09-22', ''),
('R047', 'T047', 'Baik', 0.00, '2025-09-27', ''),
('R048', 'T048', 'Baik', 0.00, '2025-09-29', ''),
('R049', 'T049', 'Baik', 0.00, '2025-10-03', ''),
('R050', 'T050', 'Baik', 0.00, '2025-10-09', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sewa_mobil`
--

CREATE TABLE `transaksi_sewa_mobil` (
  `id_transaksi` varchar(6) NOT NULL,
  `id_pelanggan` varchar(6) DEFAULT NULL,
  `id_mobil` varchar(6) DEFAULT NULL,
  `id_lokasi_pengambilan` varchar(6) DEFAULT NULL,
  `id_promo` varchar(6) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `total_biaya` decimal(12,2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_sewa_mobil`
--

INSERT INTO `transaksi_sewa_mobil` (`id_transaksi`, `id_pelanggan`, `id_mobil`, `id_lokasi_pengambilan`, `id_promo`, `tgl_mulai`, `tgl_selesai`, `jumlah_hari`, `total_biaya`, `status`) VALUES
('T001', 'P001', 'M001', 'L001', 'PR01', '2025-01-05', '2025-01-07', 2, 700000.00, 'selesai'),
('T002', 'P002', 'M003', 'L002', 'PR02', '2025-01-10', '2025-01-15', 5, 2250000.00, 'selesai'),
('T003', 'P003', 'M002', 'L003', 'PR03', '2025-01-08', '2025-01-09', 1, 300000.00, 'selesai'),
('T004', 'P004', 'M004', 'L004', 'PR04', '2025-01-12', '2025-01-20', 8, 6400000.00, 'selesai'),
('T005', 'P005', 'M005', 'L005', 'PR05', '2025-02-01', '2025-02-03', 2, 1000000.00, 'selesai'),
('T006', 'P006', 'M006', 'L006', 'PR06', '2025-02-05', '2025-02-07', 2, 560000.00, 'selesai'),
('T007', 'P007', 'M007', 'L007', 'PR07', '2025-02-10', '2025-02-12', 2, 2400000.00, 'selesai'),
('T008', 'P008', 'M008', 'L008', 'PR08', '2025-02-15', '2025-02-18', 3, 3300000.00, 'selesai'),
('T009', 'P009', 'M009', 'L009', 'PR09', '2025-03-01', '2025-03-04', 3, 1200000.00, 'selesai'),
('T010', 'P010', 'M010', 'L010', 'PR10', '2025-03-05', '2025-03-12', 7, 4900000.00, 'selesai'),
('T011', 'P011', 'M011', 'L011', 'PR11', '2025-03-10', '2025-03-11', 1, 950000.00, 'selesai'),
('T012', 'P012', 'M012', 'L012', 'PR12', '2025-03-15', '2025-03-20', 5, 3000000.00, 'selesai'),
('T013', 'P013', 'M013', 'L013', 'PR13', '2025-04-01', '2025-04-04', 3, 4500000.00, 'selesai'),
('T014', 'P014', 'M014', 'L014', 'PR14', '2025-04-05', '2025-04-06', 1, 900000.00, 'selesai'),
('T015', 'P015', 'M015', 'L015', 'PR15', '2025-04-10', '2025-04-12', 2, 400000.00, 'selesai'),
('T016', 'P001', 'M002', 'L001', NULL, '2025-04-15', '2025-04-17', 2, 600000.00, 'selesai'),
('T017', 'P002', 'M004', 'L002', 'PR01', '2025-04-20', '2025-04-22', 2, 1600000.00, 'selesai'),
('T018', 'P003', 'M005', 'L003', 'PR02', '2025-04-25', '2025-04-29', 4, 2000000.00, 'selesai'),
('T019', 'P004', 'M001', 'L004', 'PR03', '2025-05-01', '2025-05-05', 4, 1400000.00, 'selesai'),
('T020', 'P005', 'M003', 'L005', 'PR04', '2025-05-06', '2025-05-07', 1, 450000.00, 'selesai'),
('T021', 'P006', 'M006', 'L006', 'PR05', '2025-05-10', '2025-05-14', 4, 1120000.00, 'selesai'),
('T022', 'P007', 'M007', 'L007', 'PR06', '2025-05-15', '2025-05-20', 5, 6000000.00, 'selesai'),
('T023', 'P008', 'M008', 'L008', 'PR07', '2025-05-21', '2025-05-22', 1, 1100000.00, 'selesai'),
('T024', 'P009', 'M009', 'L009', 'PR08', '2025-06-01', '2025-06-05', 4, 1600000.00, 'selesai'),
('T025', 'P010', 'M010', 'L010', 'PR09', '2025-06-06', '2025-06-10', 4, 2800000.00, 'selesai'),
('T026', 'P011', 'M011', 'L011', 'PR10', '2025-06-11', '2025-06-12', 1, 950000.00, 'selesai'),
('T027', 'P012', 'M012', 'L012', 'PR11', '2025-06-13', '2025-06-18', 5, 3000000.00, 'selesai'),
('T028', 'P013', 'M013', 'L013', 'PR12', '2025-06-20', '2025-06-25', 5, 7500000.00, 'selesai'),
('T029', 'P014', 'M014', 'L014', 'PR13', '2025-07-01', '2025-07-03', 2, 1800000.00, 'selesai'),
('T030', 'P015', 'M015', 'L015', 'PR14', '2025-07-05', '2025-07-08', 3, 600000.00, 'selesai'),
('T031', 'P001', 'M001', 'L001', 'PR15', '2025-07-10', '2025-07-11', 1, 350000.00, 'selesai'),
('T032', 'P002', 'M002', 'L002', NULL, '2025-07-12', '2025-07-15', 3, 900000.00, 'selesai'),
('T033', 'P003', 'M003', 'L003', 'PR01', '2025-07-16', '2025-07-20', 4, 1800000.00, 'selesai'),
('T034', 'P004', 'M004', 'L004', 'PR02', '2025-07-21', '2025-07-25', 4, 3200000.00, 'selesai'),
('T035', 'P005', 'M005', 'L005', 'PR03', '2025-08-01', '2025-08-05', 4, 2000000.00, 'selesai'),
('T036', 'P006', 'M006', 'L006', 'PR04', '2025-08-06', '2025-08-07', 1, 280000.00, 'selesai'),
('T037', 'P007', 'M007', 'L007', 'PR05', '2025-08-08', '2025-08-12', 4, 4800000.00, 'selesai'),
('T038', 'P008', 'M008', 'L008', 'PR06', '2025-08-15', '2025-08-16', 1, 1100000.00, 'selesai'),
('T039', 'P009', 'M009', 'L009', 'PR07', '2025-08-18', '2025-08-22', 4, 1600000.00, 'selesai'),
('T040', 'P010', 'M010', 'L010', 'PR08', '2025-08-24', '2025-08-31', 7, 4900000.00, 'selesai'),
('T041', 'P011', 'M011', 'L011', 'PR09', '2025-09-01', '2025-09-02', 1, 950000.00, 'selesai'),
('T042', 'P012', 'M012', 'L012', 'PR10', '2025-09-03', '2025-09-07', 4, 2400000.00, 'selesai'),
('T043', 'P013', 'M013', 'L013', 'PR11', '2025-09-08', '2025-09-11', 3, 4500000.00, 'selesai'),
('T044', 'P014', 'M014', 'L014', 'PR12', '2025-09-12', '2025-09-13', 1, 900000.00, 'selesai'),
('T045', 'P015', 'M015', 'L015', 'PR13', '2025-09-14', '2025-09-16', 2, 400000.00, 'selesai'),
('T046', 'P001', 'M004', 'L001', NULL, '2025-09-18', '2025-09-22', 4, 3200000.00, 'selesai'),
('T047', 'P002', 'M005', 'L002', 'PR14', '2025-09-25', '2025-09-27', 2, 1000000.00, 'selesai'),
('T048', 'P003', 'M006', 'L003', 'PR15', '2025-09-28', '2025-09-29', 1, 280000.00, 'selesai'),
('T049', 'P004', 'M007', 'L004', NULL, '2025-10-01', '2025-10-03', 2, 2400000.00, 'selesai'),
('T050', 'P005', 'M008', 'L005', 'PR01', '2025-10-05', '2025-10-09', 4, 4400000.00, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sewa_sopir`
--

CREATE TABLE `transaksi_sewa_sopir` (
  `id_sewa_sopir` varchar(6) NOT NULL,
  `id_sopir` varchar(6) DEFAULT NULL,
  `id_transaksi` varchar(6) DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `total_tarif` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_sewa_sopir`
--

INSERT INTO `transaksi_sewa_sopir` (`id_sewa_sopir`, `id_sopir`, `id_transaksi`, `jumlah_hari`, `total_tarif`) VALUES
('SS001', 'S001', 'T001', 2, 300000.00),
('SS002', 'S002', 'T002', 5, 750000.00),
('SS003', 'S003', 'T003', 1, 175000.00),
('SS004', 'S004', 'T004', 8, 1280000.00),
('SS005', 'S005', 'T005', 2, 280000.00),
('SS006', 'S006', 'T006', 2, 310000.00),
('SS007', 'S007', 'T007', 2, 290000.00),
('SS008', 'S008', 'T008', 3, 450000.00),
('SS009', 'S009', 'T009', 3, 444000.00),
('SS010', 'S010', 'T010', 7, 1120000.00),
('SS011', 'S011', 'T011', 1, 152000.00),
('SS012', 'S012', 'T012', 5, 745000.00),
('SS013', 'S013', 'T013', 3, 441000.00),
('SS014', 'S014', 'T014', 1, 151000.00),
('SS015', 'S015', 'T015', 2, 292000.00),
('SS016', 'S001', 'T016', 2, 300000.00),
('SS017', 'S002', 'T017', 2, 320000.00),
('SS018', 'S003', 'T018', 4, 700000.00),
('SS019', 'S004', 'T019', 4, 640000.00),
('SS020', 'S005', 'T020', 1, 140000.00),
('SS021', 'S006', 'T021', 4, 620000.00),
('SS022', 'S007', 'T022', 5, 725000.00),
('SS023', 'S008', 'T023', 1, 150000.00),
('SS024', 'S009', 'T024', 4, 592000.00),
('SS025', 'S010', 'T025', 4, 640000.00),
('SS026', 'S011', 'T026', 1, 152000.00),
('SS027', 'S012', 'T027', 5, 745000.00),
('SS028', 'S013', 'T028', 5, 735000.00),
('SS029', 'S014', 'T029', 2, 302000.00),
('SS030', 'S015', 'T030', 3, 438000.00),
('SS031', 'S001', 'T031', 1, 150000.00),
('SS032', 'S002', 'T032', 3, 450000.00),
('SS033', 'S003', 'T033', 4, 700000.00),
('SS034', 'S004', 'T034', 4, 640000.00),
('SS035', 'S005', 'T035', 4, 560000.00),
('SS036', 'S006', 'T036', 1, 155000.00),
('SS037', 'S007', 'T037', 4, 580000.00),
('SS038', 'S008', 'T038', 1, 150000.00),
('SS039', 'S009', 'T039', 4, 592000.00),
('SS040', 'S010', 'T040', 7, 1120000.00),
('SS041', 'S011', 'T041', 1, 152000.00),
('SS042', 'S012', 'T042', 4, 596000.00),
('SS043', 'S013', 'T043', 3, 441000.00),
('SS044', 'S014', 'T044', 1, 151000.00),
('SS045', 'S015', 'T045', 2, 292000.00),
('SS046', 'S001', 'T046', 4, 600000.00),
('SS047', 'S002', 'T047', 2, 320000.00),
('SS048', 'S003', 'T048', 1, 175000.00),
('SS049', 'S004', 'T049', 2, 320000.00),
('SS050', 'S005', 'T050', 4, 560000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_asuransi`
--
ALTER TABLE `master_asuransi`
  ADD PRIMARY KEY (`id_asuransi`);

--
-- Indexes for table `master_jenis_mobil`
--
ALTER TABLE `master_jenis_mobil`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `master_lokasi_pengambilan`
--
ALTER TABLE `master_lokasi_pengambilan`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `master_metode_pembayaran`
--
ALTER TABLE `master_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `master_mobil`
--
ALTER TABLE `master_mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `master_promo`
--
ALTER TABLE `master_promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `master_sopir`
--
ALTER TABLE `master_sopir`
  ADD PRIMARY KEY (`id_sopir`);

--
-- Indexes for table `transaksi_asuransi`
--
ALTER TABLE `transaksi_asuransi`
  ADD PRIMARY KEY (`id_trans_asuransi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_asuransi` (`id_asuransi`);

--
-- Indexes for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_metode` (`id_metode`);

--
-- Indexes for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `transaksi_sewa_mobil`
--
ALTER TABLE `transaksi_sewa_mobil`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_lokasi_pengambilan` (`id_lokasi_pengambilan`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Indexes for table `transaksi_sewa_sopir`
--
ALTER TABLE `transaksi_sewa_sopir`
  ADD PRIMARY KEY (`id_sewa_sopir`),
  ADD KEY `id_sopir` (`id_sopir`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_mobil`
--
ALTER TABLE `master_mobil`
  ADD CONSTRAINT `master_mobil_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `master_jenis_mobil` (`id_jenis`);

--
-- Constraints for table `transaksi_asuransi`
--
ALTER TABLE `transaksi_asuransi`
  ADD CONSTRAINT `transaksi_asuransi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_sewa_mobil` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_asuransi_ibfk_2` FOREIGN KEY (`id_asuransi`) REFERENCES `master_asuransi` (`id_asuransi`);

--
-- Constraints for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD CONSTRAINT `transaksi_pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_sewa_mobil` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_pembayaran_ibfk_2` FOREIGN KEY (`id_metode`) REFERENCES `master_metode_pembayaran` (`id_metode`);

--
-- Constraints for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD CONSTRAINT `transaksi_pengembalian_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_sewa_mobil` (`id_transaksi`);

--
-- Constraints for table `transaksi_sewa_mobil`
--
ALTER TABLE `transaksi_sewa_mobil`
  ADD CONSTRAINT `transaksi_sewa_mobil_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `master_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_sewa_mobil_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `master_mobil` (`id_mobil`),
  ADD CONSTRAINT `transaksi_sewa_mobil_ibfk_3` FOREIGN KEY (`id_lokasi_pengambilan`) REFERENCES `master_lokasi_pengambilan` (`id_lokasi`),
  ADD CONSTRAINT `transaksi_sewa_mobil_ibfk_4` FOREIGN KEY (`id_promo`) REFERENCES `master_promo` (`id_promo`);

--
-- Constraints for table `transaksi_sewa_sopir`
--
ALTER TABLE `transaksi_sewa_sopir`
  ADD CONSTRAINT `transaksi_sewa_sopir_ibfk_1` FOREIGN KEY (`id_sopir`) REFERENCES `master_sopir` (`id_sopir`),
  ADD CONSTRAINT `transaksi_sewa_sopir_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_sewa_mobil` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
