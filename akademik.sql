-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2018 at 11:20 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_menu`
--

CREATE TABLE `tabel_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_menu`
--

INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `is_main_menu`) VALUES
(1, 'Database Siswa', 'siswa', 'fa fa-users', 0),
(2, 'Database Guru', 'guru', 'fa fa-graduation-cap', 0),
(8, 'data sekolah', 'sekolah', 'fa fa-building', 0),
(9, 'Data master', '#', 'fa fa-bars', 0),
(10, 'Mata Pelajaran', 'mapel', 'fa fa-book', 9),
(11, 'Ruangan Kelas', 'ruangan', 'fa fa-building', 9),
(12, 'Jurusan', 'jurusan', 'fa fa-th-large', 9),
(13, 'Tahun Akademik', 'tahun_akademik', 'fa fa-calendar-o', 9),
(14, 'Jadwal Pelajaran', 'jadwal', 'fa fa-calendar', 0),
(15, 'Rombongan Belajar', 'rombel', 'fa fa-users', 9),
(16, 'Laporan Nilai', 'nilai', 'fa fa-file-excel-o', 0),
(17, 'Pengguna Sistem', 'users', 'fa fa-cubes', 0),
(19, 'Kurikulum', 'kurikulum', 'fa fa-newspaper-o', 9),
(20, 'Wali Kelas', 'walikelas', 'fa fa-users', 0),
(21, 'Form Pembayaran', 'keuangan/form', 'fa fa-shopping-cart', 0),
(22, 'Peserta Didik', 'siswa/siswa_aktif', 'fa fa-graduation-cap', 0),
(23, 'Jenis Pembayaran', 'jenis_pembayaran', 'fa fa-credit-card', 0),
(24, 'Setup Biaya', 'keuangan/setup', 'fa fa-graduation-cap', 0),
(25, 'Raport Online', 'raport', 'fa fa-graduation-cap', 0),
(26, 'Sms Gateway', 'sms', 'fa fa-envelope-o', 0),
(27, 'Phonebook', 'sms_group', 'fa fa-book', 26),
(28, 'Form Sms', 'sms', 'fa fa-keyboard-o', 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `kd_agama` varchar(2) NOT NULL,
  `nama_agama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agama`
--

INSERT INTO `tbl_agama` (`kd_agama`, `nama_agama`) VALUES
('01', 'ISLAM'),
('02', 'KRISTEN/ PROTESTAN'),
('03', 'KATHOLIK'),
('04', 'HINDU'),
('05', 'BUDHA'),
('06', 'KHONG HU CHU'),
('99', 'LAIN LAIN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_sekolah`
--

CREATE TABLE `tbl_biaya_sekolah` (
  `id_biaya` int(11) NOT NULL,
  `id_jenis_pembayaran` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_biaya_sekolah`
--

INSERT INTO `tbl_biaya_sekolah` (`id_biaya`, `id_jenis_pembayaran`, `id_tahun_akademik`, `jumlah_biaya`) VALUES
(3, 1, 1, 600000),
(4, 2, 1, 900000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `nuptk` varchar(16) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `kd_agama` varchar(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `nomor` varchar(18) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`nuptk`, `nama_guru`, `gender`, `kd_agama`, `username`, `password`, `tempat_lahir`, `tanggal_lahir`, `nomor`, `email`, `alamat`, `foto`, `pendidikan_terakhir`) VALUES
('151080200220', 'M.Aunur Rosidin S.Kom', 'L', '01', '', '', 'Sidoarjo', '08/10/1996', '0895804266260', 'aunur.rosidin@gmail.com', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate\r\njl. HM.Ridwan Gelam No.250,', 'avatarL.png', '02'),
('151080200221', 'Hidayatun Nisa S.Kom', 'P', '01', '', '', 'magelang', '01/10/1997', '0895869488576', 'hidayatun.nisa@gmail.com', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate', 'avatarP.png', '02'),
('151080200222', 'M.Lukmanul Hakim S.Kom, M.Kom', 'L', '01', '', '', 'pasuruan', '10/10/1998', '0898477483774', 'lukman.hakim@gmail.com', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate\r\njl. HM.Ridwan Gelam No.250,', 'avatarL.png', '03'),
('151080200224', 'Amri Yahya S.Kom', 'L', '06', '', '', 'Sidoarjo', '10/10/1997', '895804266259', 'aunur.rosidin@gmail.com', 'ds.rejeni rt.03. rw.04 kec.krembung kab.sidoarjo', 'avatarL.png', '02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_kelas`
--

CREATE TABLE `tbl_history_kelas` (
  `id_history` int(11) NOT NULL,
  `id_rombel` int(11) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_history_kelas`
--

INSERT INTO `tbl_history_kelas` (`id_history`, `id_rombel`, `nim`, `id_tahun_akademik`) VALUES
(1, 1, 'TI3003239', 1),
(2, 1, 'RM00502', 1),
(3, 1, 'TI102132', 1),
(4, 1, 'TI102133', 1),
(5, 1, 'TIM102134', 1),
(6, 1, 'TIM102135', 1),
(7, 1, 'TI1021395', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `kd_jurusan` varchar(6) NOT NULL,
  `kelas` int(11) NOT NULL,
  `kd_mapel` varchar(4) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jam` varchar(14) NOT NULL,
  `kd_ruangan` varchar(4) NOT NULL,
  `semester` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `id_rombel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_tahun_akademik`, `kd_jurusan`, `kelas`, `kd_mapel`, `id_guru`, `jam`, `kd_ruangan`, `semester`, `hari`, `id_rombel`) VALUES
(13, 1, 'RPL', 1, 'MTK', 4, '08.00 - 08.45', '01A', 1, 'SELASA', 1),
(14, 1, 'RPL', 1, 'MTK', 2, '', '01B', 1, '', 2),
(15, 1, 'RPL', 1, 'BID', 2, '09.30 - 10.00', '01A', 1, 'RABU', 1),
(16, 1, 'RPL', 1, 'BID', 2, '', '011', 1, '', 2),
(17, 1, 'RPL', 1, 'IPA', 4, '10.00 - 10.45', '01B', 1, 'JUMAT', 1),
(18, 1, 'RPL', 1, 'IPA', 2, '', '011', 1, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_pembayaran`
--

CREATE TABLE `tbl_jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `nama_jenis_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_pembayaran`
--

INSERT INTO `tbl_jenis_pembayaran` (`id_jenis_pembayaran`, `nama_jenis_pembayaran`) VALUES
(1, 'spp'),
(2, 'dsp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenjang_sekolah`
--

CREATE TABLE `tbl_jenjang_sekolah` (
  `kd_jenjang` int(11) NOT NULL,
  `nama_jenjang` varchar(10) NOT NULL,
  `jumlah_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenjang_sekolah`
--

INSERT INTO `tbl_jenjang_sekolah` (`kd_jenjang`, `nama_jenjang`, `jumlah_kelas`) VALUES
(1, 'SD/ MI', 6),
(2, 'SMP/ MTS', 3),
(3, 'SMA/ SMK', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kd_jurusan` varchar(4) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kd_jurusan`, `nama_jurusan`) VALUES
('APK', 'ADMINISTRASI PERKANTORAN'),
('RPL', 'REKAYASA PERANGKAT LUNAK'),
('TKJ', 'TEKNIK KOMPUTER JARINGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kurikulum`
--

CREATE TABLE `tbl_kurikulum` (
  `id_kurikulum` int(11) NOT NULL,
  `nama_kurikulum` varchar(30) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kurikulum`
--

INSERT INTO `tbl_kurikulum` (`id_kurikulum`, `nama_kurikulum`, `is_aktif`) VALUES
(1, 'KURIKULUM 2016', 'n'),
(2, 'KURIKULUM 2013', 'y'),
(3, 'KURIKULUM 2015', 'n'),
(4, 'KURIKULUM 2012', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kurikulum_detail`
--

CREATE TABLE `tbl_kurikulum_detail` (
  `kd_kurikulum_detail` int(11) NOT NULL,
  `kd_kurikulum` int(11) NOT NULL,
  `kd_mapel` varchar(11) NOT NULL,
  `kd_jurusan` varchar(4) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kurikulum_detail`
--

INSERT INTO `tbl_kurikulum_detail` (`kd_kurikulum_detail`, `kd_kurikulum`, `kd_mapel`, `kd_jurusan`, `kelas`) VALUES
(12, 1, 'IPA', 'RPL', 1),
(13, 2, 'MTK', 'RPL', 2),
(16, 2, 'BID', 'APK', 1),
(17, 2, 'BID', 'APK', 1),
(18, 2, 'BIJ', 'APK', 1),
(19, 2, 'BING', 'APK', 1),
(20, 2, 'BID', 'APK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level_user`
--

CREATE TABLE `tbl_level_user` (
  `id_level_user` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level_user`
--

INSERT INTO `tbl_level_user` (`id_level_user`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Walikelas'),
(3, 'Guru'),
(5, 'Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `kd_mapel` varchar(4) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`kd_mapel`, `nama_mapel`) VALUES
('BID', 'BAHASA INDONESIA'),
('BIJ', 'BAHASA JEPANG'),
('BING', 'BAHASA INGGRIS'),
('IPA', 'ILMU PENGETAHUAN ALAM'),
('IPS', 'ILMU PENGETAHUAN SOSIAL'),
('MTK', 'MATEMATIKA'),
('TIK', 'TEKNOLOGI INFORMASI KOMPUTER');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_jadwal`, `nim`, `nilai`) VALUES
(1, 13, 'TI3003239', 100),
(2, 13, 'RM00502', 89),
(3, 13, 'TI102132', 89),
(4, 13, 'TI102133', 78),
(5, 13, 'TIM102134', 67),
(6, 13, 'TIM102135', 98),
(7, 13, 'TI1021395', 60),
(8, 17, 'TI3003239', 90),
(9, 17, 'RM00502', 87),
(10, 17, 'TI102132', 89),
(11, 17, 'TI102133', 99),
(12, 17, 'TIM102134', 90),
(13, 17, 'TIM102135', 86),
(14, 17, 'TI1021395', 89);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phonebook`
--

CREATE TABLE `tbl_phonebook` (
  `id_phonebook` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_phonebook`
--

INSERT INTO `tbl_phonebook` (`id_phonebook`, `id_group`, `no_hp`) VALUES
(1, 7, '089699935552'),
(2, 7, '085310204081');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rombel`
--

CREATE TABLE `tbl_rombel` (
  `kd_rombel` int(11) NOT NULL,
  `nama_rombel` varchar(30) NOT NULL,
  `kelas` int(11) NOT NULL,
  `kd_jurusan` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rombel`
--

INSERT INTO `tbl_rombel` (`kd_rombel`, `nama_rombel`, `kelas`, `kd_jurusan`) VALUES
(1, 'RPL1A', 1, 'RPL'),
(2, 'RPL1B', 2, 'RPL'),
(3, 'RPL2A', 1, 'TKJ'),
(5, 'xEINSTEIN', 1, 'RPL'),
(6, 'xDONALD_TRUMPFFT', 1, 'RPL'),
(7, 'xGOOGLE', 1, 'TKJ'),
(8, 'RPL1B', 1, 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kd_ruangan` varchar(4) NOT NULL,
  `nama_ruangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`kd_ruangan`, `nama_ruangan`) VALUES
('01A', 'RUANGAN KELAS 1 A'),
('01B', 'RUANGAN KELAS 1B'),
('01C', 'RUANGAN KELAS 1 D'),
('01D', 'RUANG KELAS 1D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah_info`
--

CREATE TABLE `tbl_sekolah_info` (
  `kd_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(30) NOT NULL,
  `kd_jenjang_sekolah` int(11) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `telpon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sekolah_info`
--

INSERT INTO `tbl_sekolah_info` (`kd_sekolah`, `nama_sekolah`, `kd_jenjang_sekolah`, `alamat_sekolah`, `email`, `telpon`) VALUES
(1, 'Madrasah Tsanawiyah Nurus Sa\'a', 3, 'wonomlati RT.16 RW.08 Krembung Sidoarjo(61275)', 'nurus_saadah@yahoo.com', '(031)8858013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nisn` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `kd_agama` varchar(2) NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `hp_wali` varchar(20) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `id_rombel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nisn`, `nis`, `nama`, `alamat`, `gender`, `tanggal_lahir`, `tempat_lahir`, `kd_agama`, `nama_wali`, `hp_wali`, `password`, `foto`, `id_rombel`) VALUES
('151080200221', '151080200222', 'FATMALA SARI', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate\r\njl. HM.Ridwan Gelam No.250,', 'P', '08/10/2001', 'SIDOARJO', '03', 'SUHERMAN', '080909833939', 'anonymouse135', 'avatarP.png', 0),
('151080200222', '151080200222', 'INDRA RANDI', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate', 'L', '08/10/1996', 'SIDOARJO', '01', 'SUPALI', '0895804266260', 'anonymouse135', 'avatarL.png', 0),
('151080200223', '151080200223', 'AGUNG HERIYANTO', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate\r\njl. HM.Ridwan Gelam No.250,', 'L', '09/11/2001', 'SIDOARJO', '01', 'HENDRO', '0895804266260', 'anonymouse135', 'avatarL.png', 0),
('151080200224', '151080200221', 'LIST INFORMATIKA', '', 'L', '12/08/2014', 'SIDOARJO', '01', 'LIST', '0895804266260', 'anonymouse135', 'avatarL.png', 0),
('151080200272', '151080200272', 'NELLA KHARISMA HOA HOE', 'Jl. HM.Ridwan Gelam No.250, Gelam, Candi, Kabupate', 'P', '08/10/1996', 'SIDOARJO', '04', 'SUPARMAN', '0895804266260', 'anonymouse135', '151080200272.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_group`
--

CREATE TABLE `tbl_sms_group` (
  `id` int(11) NOT NULL,
  `nama_group` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_group`
--

INSERT INTO `tbl_sms_group` (`id`, `nama_group`) VALUES
(1, 'group 1'),
(2, 'group 2'),
(4, 'asasas'),
(5, 'testing'),
(7, 'walimurid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_akademik`
--

CREATE TABLE `tbl_tahun_akademik` (
  `kd_tahun_akademik` int(4) NOT NULL,
  `tahun_akademik` varchar(10) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL,
  `semester_aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tahun_akademik`
--

INSERT INTO `tbl_tahun_akademik` (`kd_tahun_akademik`, `tahun_akademik`, `is_aktif`, `semester_aktif`) VALUES
(1, '2016/ 2017', 'n', 1),
(2, '2015/2016', 'n', 0),
(6, '2017/2018', 'n', 0),
(2023, '2018/2019', 'n', 0),
(2027, '2020/2021', 'y', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_level_user` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_level_user`, `foto`) VALUES
(1, 'nuris akbar', 'nuris123', '85a3281bee28b39d2c0cb14ff86a55cd', 1, 'dsdsdsds'),
(2, 'HAFIDZ MUZAKI', 'zaki', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'Angin.jpeg'),
(5, 'fang sui', 'fang', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'Gopal_Render.png'),
(7, 'desi handayani', 'desi123', '14ddc434109d6e8df730d4ea4eefc06c', 5, 'Yaya_yah1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_rule`
--

CREATE TABLE `tbl_user_rule` (
  `id_rule` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_level_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_rule`
--

INSERT INTO `tbl_user_rule` (`id_rule`, `id_menu`, `id_level_user`) VALUES
(3, 1, 1),
(4, 2, 1),
(5, 8, 1),
(6, 14, 2),
(7, 1, 2),
(8, 16, 3),
(10, 21, 5),
(11, 9, 1),
(12, 10, 1),
(13, 11, 1),
(14, 12, 1),
(15, 13, 1),
(16, 14, 1),
(17, 17, 1),
(18, 19, 1),
(19, 20, 1),
(20, 14, 3),
(25, 22, 1),
(26, 23, 5),
(27, 24, 5),
(28, 25, 3),
(29, 26, 1),
(30, 26, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_walikelas`
--

CREATE TABLE `tbl_walikelas` (
  `id_walikelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `id_rombel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_walikelas`
--

INSERT INTO `tbl_walikelas` (`id_walikelas`, `id_guru`, `id_tahun_akademik`, `id_rombel`) VALUES
(7, 4, 1, 1),
(8, 3, 1, 2),
(9, 1, 1, 3),
(10, 2, 1, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_master_rombel`
-- (See below for the actual view)
--
CREATE TABLE `v_master_rombel` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tbl_user`
-- (See below for the actual view)
--
CREATE TABLE `v_tbl_user` (
`id_user` int(11)
,`nama_lengkap` varchar(50)
,`username` varchar(40)
,`password` varchar(32)
,`id_level_user` int(11)
,`foto` text
,`nama_level` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_walikelas`
-- (See below for the actual view)
--
CREATE TABLE `v_walikelas` (
);

-- --------------------------------------------------------

--
-- Structure for view `v_master_rombel`
--
DROP TABLE IF EXISTS `v_master_rombel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_master_rombel`  AS  select `tr`.`id_rombel` AS `id_rombel`,`tr`.`nama_rombel` AS `nama_rombel`,`tr`.`kelas` AS `kelas`,`tr`.`kd_jurusan` AS `kd_jurusan`,`tj`.`nama_jurusan` AS `nama_jurusan` from (`tbl_rombel` `tr` join `tbl_jurusan` `tj`) where (`tj`.`kd_jurusan` = `tr`.`kd_jurusan`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tbl_user`
--
DROP TABLE IF EXISTS `v_tbl_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tbl_user`  AS  select `tu`.`id_user` AS `id_user`,`tu`.`nama_lengkap` AS `nama_lengkap`,`tu`.`username` AS `username`,`tu`.`password` AS `password`,`tu`.`id_level_user` AS `id_level_user`,`tu`.`foto` AS `foto`,`tlu`.`nama_level` AS `nama_level` from (`tbl_user` `tu` join `tbl_level_user` `tlu`) where (`tu`.`id_level_user` = `tlu`.`id_level_user`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_walikelas`
--
DROP TABLE IF EXISTS `v_walikelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_walikelas`  AS  select `g`.`nama_guru` AS `nama_guru`,`r`.`nama_rombel` AS `nama_rombel`,`w`.`id_walikelas` AS `id_walikelas`,`w`.`id_tahun_akademik` AS `id_tahun_akademik`,`j`.`nama_jurusan` AS `nama_jurusan`,`r`.`kelas` AS `kelas`,`ta`.`tahun_akademik` AS `tahun_akademik` from ((((`tbl_walikelas` `w` join `tbl_rombel` `r`) join `tbl_guru` `g`) join `tbl_jurusan` `j`) join `tbl_tahun_akademik` `ta`) where ((`w`.`id_guru` = `g`.`id_guru`) and (`w`.`id_rombel` = `r`.`id_rombel`) and (`j`.`kd_jurusan` = `r`.`kd_jurusan`) and (`ta`.`id_tahun_akademik` = `w`.`id_tahun_akademik`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`kd_agama`);

--
-- Indexes for table `tbl_biaya_sekolah`
--
ALTER TABLE `tbl_biaya_sekolah`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nuptk`);

--
-- Indexes for table `tbl_history_kelas`
--
ALTER TABLE `tbl_history_kelas`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`);

--
-- Indexes for table `tbl_jenjang_sekolah`
--
ALTER TABLE `tbl_jenjang_sekolah`
  ADD PRIMARY KEY (`kd_jenjang`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `tbl_kurikulum`
--
ALTER TABLE `tbl_kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `tbl_kurikulum_detail`
--
ALTER TABLE `tbl_kurikulum_detail`
  ADD PRIMARY KEY (`kd_kurikulum_detail`);

--
-- Indexes for table `tbl_level_user`
--
ALTER TABLE `tbl_level_user`
  ADD PRIMARY KEY (`id_level_user`);

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_phonebook`
--
ALTER TABLE `tbl_phonebook`
  ADD PRIMARY KEY (`id_phonebook`);

--
-- Indexes for table `tbl_rombel`
--
ALTER TABLE `tbl_rombel`
  ADD PRIMARY KEY (`kd_rombel`);

--
-- Indexes for table `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`kd_ruangan`);

--
-- Indexes for table `tbl_sekolah_info`
--
ALTER TABLE `tbl_sekolah_info`
  ADD PRIMARY KEY (`kd_sekolah`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tbl_sms_group`
--
ALTER TABLE `tbl_sms_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tahun_akademik`
--
ALTER TABLE `tbl_tahun_akademik`
  ADD PRIMARY KEY (`kd_tahun_akademik`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_user_rule`
--
ALTER TABLE `tbl_user_rule`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indexes for table `tbl_walikelas`
--
ALTER TABLE `tbl_walikelas`
  ADD PRIMARY KEY (`id_walikelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_biaya_sekolah`
--
ALTER TABLE `tbl_biaya_sekolah`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_history_kelas`
--
ALTER TABLE `tbl_history_kelas`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_jenjang_sekolah`
--
ALTER TABLE `tbl_jenjang_sekolah`
  MODIFY `kd_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kurikulum`
--
ALTER TABLE `tbl_kurikulum`
  MODIFY `id_kurikulum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_kurikulum_detail`
--
ALTER TABLE `tbl_kurikulum_detail`
  MODIFY `kd_kurikulum_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_level_user`
--
ALTER TABLE `tbl_level_user`
  MODIFY `id_level_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_phonebook`
--
ALTER TABLE `tbl_phonebook`
  MODIFY `id_phonebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rombel`
--
ALTER TABLE `tbl_rombel`
  MODIFY `kd_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_sms_group`
--
ALTER TABLE `tbl_sms_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_tahun_akademik`
--
ALTER TABLE `tbl_tahun_akademik`
  MODIFY `kd_tahun_akademik` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2028;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_rule`
--
ALTER TABLE `tbl_user_rule`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_walikelas`
--
ALTER TABLE `tbl_walikelas`
  MODIFY `id_walikelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
