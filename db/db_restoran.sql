-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 01:54 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` char(5) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `stok` int(4) NOT NULL,
  `satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `stok`, `satuan`) VALUES
('00001', 'abon sapi', 306, 'Porsi'),
('00002', 'air abu', 144, 'Botol'),
('00003', 'ajinomoto/miwon', 90, 'Kg'),
('00004', 'amoniak', 83, 'Pack'),
('00005', 'anchore elle', 114, 'Pack'),
('00006', 'angco', 80, 'Kg'),
('00007', 'arak gentong', 109, 'Botol'),
('00008', 'arak putih cap macan', 100, 'Botol'),
('00009', 'asam jawa/madura', 100, 'Botol'),
('00010', 'asparagus kaleng', 55, 'Kaleng');

-- --------------------------------------------------------

--
-- Table structure for table `detil_po_eksternal`
--

CREATE TABLE IF NOT EXISTS `detil_po_eksternal` (
  `no_po_eksternal` char(8) NOT NULL,
  `id_barang` char(5) NOT NULL,
  `qty` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_po_eksternal`
--

INSERT INTO `detil_po_eksternal` (`no_po_eksternal`, `id_barang`, `qty`) VALUES
('01021801', '00009', 10),
('01021801', '00003', 12),
('01021802', '00004', 10),
('01021802', '00005', 15),
('01021804', '00005', 12),
('01021803', '00007', 10),
('01211801', '00001', 100),
('01211801', '00002', 50),
('01211802', '00001', 22);

-- --------------------------------------------------------

--
-- Table structure for table `detil_po_internal`
--

CREATE TABLE IF NOT EXISTS `detil_po_internal` (
  `no_po_internal` char(8) NOT NULL,
  `id_barang` char(5) NOT NULL,
  `qty` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_po_internal`
--

INSERT INTO `detil_po_internal` (`no_po_internal`, `id_barang`, `qty`) VALUES
('18010201', '00001', 10),
('18010201', '00004', 10),
('18010202', '00006', 5),
('18010202', '00010', 15),
('18010202', '00002', 4),
('18010301', '00004', 12),
('18010301', '00001', 19),
('18011301', '00001', 2),
('18011302', '00001', 2),
('18012001', '00001', 2),
('18012001', '00002', 3),
('18012002', '00001', 1),
('18012003', '00001', 1),
('18012004', '00001', 1),
('18012005', '00003', 10),
('18012005', '00006', 5),
('18012101', '00001', 2),
('18012101', '00004', 4),
('18012102', '00001', 50),
('18012102', '00002', 50),
('18012103', '00006', 20);

-- --------------------------------------------------------

--
-- Table structure for table `detil_retur`
--

CREATE TABLE IF NOT EXISTS `detil_retur` (
  `no_retur` char(8) NOT NULL,
  `id_barang` char(5) NOT NULL,
  `jml_retur` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_retur`
--

INSERT INTO `detil_retur` (`no_retur`, `id_barang`, `jml_retur`) VALUES
('28180101', '00001', 12),
('28180101', '00004', 22),
('28180101', '00001', 1);

--
-- Triggers `detil_retur`
--
DELIMITER $$
CREATE TRIGGER `stok_after_dretur_in` AFTER DELETE ON `detil_retur`
 FOR EACH ROW UPDATE barang SET stok = stok + OLD.jml_retur where id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_after_retur_in` AFTER INSERT ON `detil_retur`
 FOR EACH ROW update barang set stok= stok + new.jml_retur where id_barang=new.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detil_retur_eksternal`
--

CREATE TABLE IF NOT EXISTS `detil_retur_eksternal` (
  `no_retur_eksternal` char(8) NOT NULL,
  `id_barang` char(5) NOT NULL,
  `jml_retur_eksternal` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_retur_eksternal`
--

INSERT INTO `detil_retur_eksternal` (`no_retur_eksternal`, `id_barang`, `jml_retur_eksternal`) VALUES
('21180101', '00004', 1),
('21180101', '00005', 2),
('21180101', '00007', 3),
('21180101', '00007', 3),
('21180101', '00007', 3),
('28180101', '00001', 12),
('28180101', '00001', 1),
('28180101', '00002', 2),
('28180101', '00002', 2);

--
-- Triggers `detil_retur_eksternal`
--
DELIMITER $$
CREATE TRIGGER `stok_after_dretur_ek` AFTER DELETE ON `detil_retur_eksternal`
 FOR EACH ROW UPDATE barang SET stok = stok - OLD.jml_retur_eksternal where id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_after_retur_ek` AFTER INSERT ON `detil_retur_eksternal`
 FOR EACH ROW update barang set stok= stok + new.jml_retur_eksternal where id_barang=new.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detil_ttb`
--

CREATE TABLE IF NOT EXISTS `detil_ttb` (
  `no_ttb` char(13) NOT NULL,
  `id_barang` char(5) NOT NULL,
  `jml_terima` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_ttb`
--

INSERT INTO `detil_ttb` (`no_ttb`, `id_barang`, `jml_terima`) VALUES
('0118022338544', '00007', 10),
('0118022359454', '00004', 10),
('0118022359454', '00005', 15),
('0118210901193', '00001', 100),
('0118210901193', '00002', 50);

--
-- Triggers `detil_ttb`
--
DELIMITER $$
CREATE TRIGGER `stok_after_dttb` AFTER DELETE ON `detil_ttb`
 FOR EACH ROW UPDATE barang SET stok = stok - OLD.jml_terima where id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_after_ttb` AFTER INSERT ON `detil_ttb`
 FOR EACH ROW update barang set stok= stok + new.jml_terima where id_barang=new.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` char(3) NOT NULL,
  `nm_pegawai` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `level` enum('0','1','2','3','4') NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `alamat`, `no_telp`, `bagian`, `level`, `password`) VALUES
('P00', 'Killua', 'Tangerang', '081800009999', 'Admin Gudang', '0', 'testing'),
('P01', 'Gau', 'Jakarta', '081800001111', 'Admin Stock', '1', 'testing'),
('P02', 'Bou', 'Tangerang', '081800009090', 'F&B', '2', 'testing'),
('P03', 'Near', 'jakarta', '081809090909', 'Kepala Admin', '3', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `po_eksternal`
--

CREATE TABLE IF NOT EXISTS `po_eksternal` (
  `no_po_eksternal` char(8) NOT NULL,
  `tgl_po_eksternal` date NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `id_pegawai` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_eksternal`
--

INSERT INTO `po_eksternal` (`no_po_eksternal`, `tgl_po_eksternal`, `status`, `id_pegawai`) VALUES
('01021801', '2018-01-02', '2', 'P00'),
('01021802', '2018-01-02', '3', 'p01'),
('01021803', '2018-01-02', '3', 'p01'),
('01021804', '2018-01-02', '1', 'p00'),
('01211801', '2018-01-21', '3', 'P01'),
('01211802', '2018-01-21', '0', 'p01');

-- --------------------------------------------------------

--
-- Table structure for table `po_internal`
--

CREATE TABLE IF NOT EXISTS `po_internal` (
  `no_po_internal` char(8) NOT NULL,
  `tgl_po_internal` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  `id_pegawai` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_internal`
--

INSERT INTO `po_internal` (`no_po_internal`, `tgl_po_internal`, `status`, `id_pegawai`) VALUES
('18010201', '2018-01-02', '1', 'P01'),
('18010202', '2018-01-02', '1', 'P01'),
('18010301', '2018-01-03', '1', 'p01'),
('18011301', '2018-01-13', '1', 'p01'),
('18011302', '2018-01-13', '1', 'p02'),
('18012001', '2018-01-20', '1', 'p01'),
('18012002', '2018-01-20', '1', 'p01'),
('18012003', '2018-01-20', '1', 'p01'),
('18012004', '2018-01-20', '1', 'p01'),
('18012005', '2018-01-20', '1', 'p01'),
('18012101', '2018-01-21', '1', 'P01'),
('18012102', '2018-01-21', '1', 'P01'),
('18012103', '2018-01-21', '0', 'p02');

--
-- Triggers `po_internal`
--
DELIMITER $$
CREATE TRIGGER `stok_po_in` AFTER UPDATE ON `po_internal`
 FOR EACH ROW UPDATE barang, detil_po_internal, po_internal 
SET stok = barang.stok - detil_po_internal.qty
WHERE po_internal.no_po_internal=detil_po_internal.no_po_internal and barang.id_barang=detil_po_internal.id_barang and po_internal.no_po_internal=old.no_po_internal
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `no_retur` char(8) NOT NULL,
  `tgl_retur` date NOT NULL,
  `no_po_internal` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`no_retur`, `tgl_retur`, `no_po_internal`) VALUES
('21180101', '2018-01-21', '18012102'),
('28180101', '2018-01-28', '18012101');

-- --------------------------------------------------------

--
-- Table structure for table `retur_eksternal`
--

CREATE TABLE IF NOT EXISTS `retur_eksternal` (
  `no_retur_eksternal` char(8) NOT NULL,
  `tgl_retur_eksternal` date NOT NULL,
  `no_po_eksternal` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_eksternal`
--

INSERT INTO `retur_eksternal` (`no_retur_eksternal`, `tgl_retur_eksternal`, `no_po_eksternal`) VALUES
('21180101', '2018-01-21', '01021802'),
('28180101', '2018-01-28', '01211801');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `no_sj` char(13) NOT NULL,
  `tgl_sj` date NOT NULL,
  `no_po_eksternal` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`no_sj`, `tgl_sj`, `no_po_eksternal`) VALUES
('1801021551445', '2018-01-02', '01021803'),
('1801021759383', '2018-01-02', '01021802'),
('1801050222411', '2018-01-05', '01021801'),
('1801210258107', '2018-01-21', '01211801');

-- --------------------------------------------------------

--
-- Table structure for table `ttb`
--

CREATE TABLE IF NOT EXISTS `ttb` (
  `no_ttb` char(13) NOT NULL,
  `tgl_ttb` date NOT NULL,
  `id_pegawai` char(3) NOT NULL,
  `no_po_eksternal` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttb`
--

INSERT INTO `ttb` (`no_ttb`, `tgl_ttb`, `id_pegawai`, `no_po_eksternal`) VALUES
('0118022338544', '2018-01-02', 'p01', '01021803'),
('0118022359454', '2018-01-02', 'p01', '01021802'),
('0118210901193', '2018-01-21', 'P01', '01211801');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detil_po_eksternal`
--
ALTER TABLE `detil_po_eksternal`
  ADD KEY `no_po_eksternal` (`no_po_eksternal`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detil_po_internal`
--
ALTER TABLE `detil_po_internal`
  ADD KEY `no_po_internal` (`no_po_internal`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detil_retur`
--
ALTER TABLE `detil_retur`
  ADD KEY `no_retur` (`no_retur`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detil_retur_eksternal`
--
ALTER TABLE `detil_retur_eksternal`
  ADD KEY `no_retur_eksternal` (`no_retur_eksternal`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detil_ttb`
--
ALTER TABLE `detil_ttb`
  ADD KEY `id_ttb` (`no_ttb`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `po_eksternal`
--
ALTER TABLE `po_eksternal`
  ADD PRIMARY KEY (`no_po_eksternal`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `po_internal`
--
ALTER TABLE `po_internal`
  ADD PRIMARY KEY (`no_po_internal`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`no_retur`),
  ADD KEY `no_po_internal` (`no_po_internal`);

--
-- Indexes for table `retur_eksternal`
--
ALTER TABLE `retur_eksternal`
  ADD PRIMARY KEY (`no_retur_eksternal`),
  ADD KEY `no_po_eksternal` (`no_po_eksternal`);

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`no_sj`),
  ADD KEY `no_po_eksternal` (`no_po_eksternal`);

--
-- Indexes for table `ttb`
--
ALTER TABLE `ttb`
  ADD PRIMARY KEY (`no_ttb`),
  ADD KEY `no_po_internal` (`no_po_eksternal`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detil_po_eksternal`
--
ALTER TABLE `detil_po_eksternal`
  ADD CONSTRAINT `detil_po_eksternal_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_po_eksternal_ibfk_2` FOREIGN KEY (`no_po_eksternal`) REFERENCES `po_eksternal` (`no_po_eksternal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_po_internal`
--
ALTER TABLE `detil_po_internal`
  ADD CONSTRAINT `detil_po_internal_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_po_internal_ibfk_3` FOREIGN KEY (`no_po_internal`) REFERENCES `po_internal` (`no_po_internal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_retur`
--
ALTER TABLE `detil_retur`
  ADD CONSTRAINT `detil_retur_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_retur_ibfk_2` FOREIGN KEY (`no_retur`) REFERENCES `retur` (`no_retur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_retur_eksternal`
--
ALTER TABLE `detil_retur_eksternal`
  ADD CONSTRAINT `detil_retur_eksternal_ibfk_1` FOREIGN KEY (`no_retur_eksternal`) REFERENCES `retur_eksternal` (`no_retur_eksternal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_retur_eksternal_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_ttb`
--
ALTER TABLE `detil_ttb`
  ADD CONSTRAINT `detil_ttb_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_ttb_ibfk_3` FOREIGN KEY (`no_ttb`) REFERENCES `ttb` (`no_ttb`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po_eksternal`
--
ALTER TABLE `po_eksternal`
  ADD CONSTRAINT `po_eksternal_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po_internal`
--
ALTER TABLE `po_internal`
  ADD CONSTRAINT `po_internal_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`no_po_internal`) REFERENCES `po_internal` (`no_po_internal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur_eksternal`
--
ALTER TABLE `retur_eksternal`
  ADD CONSTRAINT `retur_eksternal_ibfk_1` FOREIGN KEY (`no_po_eksternal`) REFERENCES `po_eksternal` (`no_po_eksternal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD CONSTRAINT `surat_jalan_ibfk_1` FOREIGN KEY (`no_po_eksternal`) REFERENCES `po_eksternal` (`no_po_eksternal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ttb`
--
ALTER TABLE `ttb`
  ADD CONSTRAINT `ttb_ibfk_1` FOREIGN KEY (`no_po_eksternal`) REFERENCES `po_eksternal` (`no_po_eksternal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ttb_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
