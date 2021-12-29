-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 03:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skm3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `display`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'PELAKSANA SURVEY');

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(2) NOT NULL,
  `bulan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `bulan`) VALUES
('01', 'Januari'),
('02', 'Februari'),
('03', 'Maret'),
('04', 'April'),
('05', 'Mei'),
('06', 'Juni'),
('07', 'Juli'),
('08', 'Agustus'),
('09', 'September'),
('10', 'Oktober'),
('11', 'November'),
('12', 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`, `created_date`) VALUES
(1, 'pukul Berapa pelayanan di MPP dibuka?', 'Pelayanan Buka mulai jam : 08.00 - 13.00 WIB', '2020-11-06 20:29:26'),
(6, 'Ada Berapakah Counter Pelayanan Di MPP Jepara', 'Ada 18 Counter Yang Siap Melayani Anda', '2020-11-06 22:32:08'),
(7, 'Bagaimana Dengan Protokol kesehatan di MPP Selama Pandemi?', 'Kami Menerapkan Protokol Kesehatan dengan Baik, Setiap Pengunjung Wajib Memakai Masker Dan Cek Suhu Badan Sebelum Memasuki MPP,.', '2020-11-06 22:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_sementara`
--

CREATE TABLE `jawaban_sementara` (
  `id_kuis` varchar(11) NOT NULL,
  `id_soal` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `judul`, `konten`, `img`, `created_date`) VALUES
(1, 'Mal Pelayanan Publik Kabupaten Jepara', 'Mal Pelayanan Publik (MPP) Kabupaten Jepara yang berada di Lantai I Kantor Organisasi Perangkat Daerah (OPD) bersama resmi dibuka, Kamis (1/10/2020). Sekretaris Daerah Kabupaten Jepara Edy Sujatmiko berharap, dengan dibukanya MPP ini, dapat meningkatkan daya saing global dalam memberikan kemudahan berusaha di daerah. Iklim berusaha akan lebih mudah terutama terkait perizinan yang lebih cepat, terpadu, efektif, dan efisien. Disampaikan, sebanyak 222 pelayanan, baik perizinan atau nonperizinan tersedia di MPP Jepara. Sehingga, semakin memudahkan masyarakat dalam mengakses berbagai jenis layanan yang ada di instansi pemerintah di satu tempat, baik mulai perizinan, administrasi kependudukan, pajak, retribusi, hingga aduan, dan konsultasi. “Semua itu, dilakukan untuk memberikan pelayanan cepat, dan terbaik untuk masyarakat,” kata Edy saat membuka MPP secara resmi. Sebenarnya, lanjutnya, MPP sudah mulai dibuka sejak 1 Juli 2020, namun baru sebatas uji coba. Pembukaan uji coba secara bertahap telah ditinjau dan mendapat apresiasi postif dari Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (PAN RB) RI yang diwakili Deputi Bidang Pelayanan Publik. “MPP ini dinilai telah mampu memudahkan publik dalam mengakses pelayanan yang terintegrasi dalam satu tempat. Namun, ada pula saran dan masukan yang sudah kami laksanakan,” kata dia. Ditambahkan, saat ini, MPP sudah dilengkapi berbagai fasilitas penunjang mulai dari pusat informasi, ruang laktasi, musala, ruang rapat, kursi roda, pojok baca, dan ruang bermain anak. “Kebaradaannya sangat strategis, karena memiliiki area parkir yang luas dan berada di jantung kota,” imbuhnya.', '1.jpeg', '2020-11-07 10:18:52'),
(2, 'Mal Pelayanan Publik Dibuka dengan Pembatasan Kunjungan', ' Untuk memberikan pelayanan kepada masyarakat, Pemerintah Kabupaten (Pemkab) Jepara mulai membuka Mal Pelayanan Publik yang berada di Lantai I Gedung Organisasi Perangkat Daerah (OPD) bersama, Jalan Kartini Nomor 1 Jepara.\r\n\r\n              Sekretaris Daerah (Sekda) Jepara Edy Sujatmiko, didampingi Asisten Administrasi Umum Sekda Jepara Sujarot, dan Kepala Dinas Penanaman Modal, Perijinan Terpadu Satu Pintu (DPMPTSP) Kabupaten Jepara Hery Yulianto, Kamis (2/7/2020) pagi melihat secara langsung kesiapan layanan yang sudah berjalan.\r\n\r\n              “Mal Pelayanan Publik sebenarnya dibuka kemarin pada bulan April bertepatan dengan hari jadi kota Jepara. Namun karena pandemi Covid-19 akhirnya ditunda,” kata dia.\r\n\r\n              Disampaikan Edy, kondisi Jepara saat ini masih tinggi kasus positif Covid-19. Namun di sisi lain masyarakat butuh pelayanan yang cepat dan maksimal. Sehingga Mal Pelayanan Publik ini dibuka secara bertahap. “Sudah kita buka sejak 1 Juli 2020, Namun dengan pembatasan kunjungan,” kata dia.\r\n\r\n              Beberapa layanan yang sudah difungsikan yaitu gerai Kantor Samsat, Bank Jateng, dan PDAM Jepara. Sedangkan untuk gerai instansi yaitu Dinas Lingkungan Hidup (DLH), Dinas Pekerjaan Umum dan Perumahan Rakyat (DPUPR), Dinas Kesehatan Kabupaten (Dinkes), Dinas Kependudukan dan Catatan Sipil (Disdukcapil), DPMPTSP, Diskominfo, dan Diskop UKM Nakertrans Jepara. Sedangkan sejumlah gerai belum ada layanan.\r\n\r\n              Edy mencontohkan untuk pelayanan Disdukcapil sudah bisa dilaksanakan. Meskipun ke depan, pelayanan ini akan dilakukan di semua kecamatan. “Kami ingin memberikan pelayanan terbaik di tengah pandemi Covid-19,” katanya.\r\n\r\n              Kepala DPMPTSP Jepara Hery Yulianto mengatakan, Untuk memberikan kenyamanan dan keamanan bagi setiap pengunjung yang mengurus ijin, sudah disiapkan berbagai fasilitas sesuai dengan protokol kesehatan. Seperti tempat cuci tangan, dan pendeteksi suhu tubuh. Selain itu jarak antrean dan pelayanan juga diatur.\r\n\r\n              “Tentunya ini berbeda dengan kondisi sebelumnya. Ada penyesuaian-penyesuaian dari pelayanan yang kita lakukan,” kata dia.\r\n\r\n              Teller di Bank Jateng Cabang Jepara Henny mengatakan, sebelumnya sudah diinformasikan kepada para nasabah, sehingga mereka tidak merasa bingung. ', '2.jpeg', '2020-11-06 20:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`tahun`) VALUES
(2020);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detil_responden`
--

CREATE TABLE `tb_detil_responden` (
  `id` varchar(12) NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `umur` int(255) DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT 'Laki-laki',
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `status` enum('1','2') DEFAULT '1',
  `loket` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_detil_responden`
--

INSERT INTO `tb_detil_responden` (`id`, `id_responden`, `nama`, `umur`, `jk`, `pendidikan`, `pekerjaan`, `created_date`, `status`, `loket`) VALUES
('125d0c5f9f20', '99009988', 'sdsad', 33, 'Perempuan', 'SMA', 'PNS/TNI/POLRI', '2019-06-21 11:39:59', '1', '5fb3c5838289c'),
('125fb3d190da', '123', 'Agus Setiawan', 29, 'Laki-laki', 'S1', 'Wiraswasta', '2020-11-17 20:35:12', '1', '5fb3c4f1b8e52'),
('125fc0f81722', 'tea', 'Agus Setiawan', 45, 'Laki-laki', 'S1', 'Pelajar/Mahasiswa', '2020-10-27 19:59:03', '1', '5fb3c5838289c'),
('125fc1543f09', 'adasdasdasd', 'LINDA', 23, 'Perempuan', 'SMA', 'Lainnya', '2020-11-28 02:32:15', '1', '5fb3d1e86704a'),
('125fc3402100', 'tes_pengunjung_id', 'Tes Pengunjung', 56, 'Perempuan', 'S1', 'Wiraswasta', '2020-11-29 13:30:57', '1', '5fb3d2264ba97'),
('125fc3419257', '132345dsds', 'Agus Setiawan', 45, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2020-11-29 13:37:06', '1', '5fb3c5838289c'),
('125fc3459f8f', 'tes_lagi', 'dada', 34, 'Perempuan', 'S1', 'PNS/TNI/POLRI', '2020-11-29 13:54:23', '1', '5fb3d1dc2763b'),
('1260cf37ddcc', '1', 'Alex', 40, 'Laki-laki', 'S1', 'Wiraswasta', '2021-06-20 19:43:09', '1', 'jsfsdk'),
('1260d2292f27', '0987654321', 'Alex', 25, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-06-23 01:17:19', '1', '5fb3c5838289c');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_kuis` varchar(255) NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `id_soal` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `published` enum('1','2','') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_kuis`, `id_responden`, `id_soal`, `jawaban`, `created_date`, `published`) VALUES
('125fb3d1942', '123', 'U1', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d195e', '123', 'U2', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d197a', '123', 'U3', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d199d', '123', 'U4', 'c', '2020-11-17 20:35:50', '2'),
('125fb3d19cb', '123', 'U5', 'a', '2020-11-29 10:29:25', '2'),
('125fb3d19ea', '123', 'U6', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d1a10', '123', 'U7', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d1a34', '123', 'U8', 'd', '2020-11-17 20:35:50', '2'),
('125fb3d1a56', '123', 'U9', 'd', '2020-11-17 20:35:50', '2'),
('125fc0f819d', 'tea', 'U1', 'c', '2020-10-27 20:00:20', '2'),
('125fc0f81b1', 'tea', 'U2', 'd', '2020-10-27 20:00:20', '2'),
('125fc0f81c8', 'tea', 'U3', 'b', '2020-10-27 20:00:20', '2'),
('125fc0f81f2', 'tea', 'U4', 'c', '2020-10-27 20:00:20', '2'),
('125fc0f8206', 'tea', 'U5', 'b', '2020-10-27 20:00:20', '2'),
('125fc0f821c', 'tea', 'U6', 'c', '2020-10-27 20:00:20', '2'),
('125fc0f8239', 'tea', 'U7', 'b', '2020-10-27 20:00:20', '2'),
('125fc0f8257', 'tea', 'U8', 'c', '2020-10-27 20:00:20', '2'),
('125fc0f8273', 'tea', 'U9', 'd', '2020-10-27 20:00:20', '2'),
('125fc154422', 'adasdasdasd', 'U1', 'c', '2020-11-28 02:33:54', '2'),
('125fc154444', 'adasdasdasd', 'U2', 'd', '2020-11-28 02:33:54', '2'),
('125fc15445a', 'adasdasdasd', 'U3', 'b', '2020-11-28 02:33:54', '2'),
('125fc154471', 'adasdasdasd', 'U4', 'a', '2020-11-29 12:08:31', '2'),
('125fc154489', 'adasdasdasd', 'U5', 'a', '2020-11-29 12:08:46', '2'),
('125fc1544a5', 'adasdasdasd', 'U6', 'd', '2020-11-28 02:33:54', '2'),
('125fc1544b8', 'adasdasdasd', 'U7', 'd', '2020-11-28 02:33:54', '2'),
('125fc1544d4', 'adasdasdasd', 'U8', 'c', '2020-11-28 02:33:54', '2'),
('125fc1544ea', 'adasdasdasd', 'U9', 'd', '2020-11-28 02:33:54', '2'),
('125fc340266', 'tes_pengunjung_id', 'U1', 'a', '2020-11-29 13:53:34', '2'),
('125fc340281', 'tes_pengunjung_id', 'U2', 'a', '2020-11-29 13:53:34', '2'),
('125fc340295', 'tes_pengunjung_id', 'U3', 'a', '2020-11-29 13:53:34', '2'),
('125fc3402a9', 'tes_pengunjung_id', 'U4', 'a', '2020-11-29 13:53:34', '2'),
('125fc3402bb', 'tes_pengunjung_id', 'U5', 'a', '2020-11-29 13:53:34', '2'),
('125fc3402d2', 'tes_pengunjung_id', 'U6', 'a', '2020-11-29 13:53:34', '2'),
('125fc3402ec', 'tes_pengunjung_id', 'U7', 'a', '2020-11-29 13:53:34', '2'),
('125fc34030e', 'tes_pengunjung_id', 'U8', 'a', '2020-11-29 13:53:34', '2'),
('125fc340323', 'tes_pengunjung_id', 'U9', 'a', '2020-11-29 13:53:34', '2'),
('125fc341947', '132345dsds', 'U1', 'd', '2021-06-20 19:47:33', '2'),
('125fc341957', '132345dsds', 'U2', 'd', '2021-06-20 19:47:33', '2'),
('125fc34196a', '132345dsds', 'U3', 'b', '2021-06-20 19:47:33', '2'),
('125fc34197e', '132345dsds', 'U4', 'c', '2021-06-20 19:47:33', '2'),
('125fc341990', '132345dsds', 'U5', 'b', '2021-06-20 19:47:33', '2'),
('125fc3419a5', '132345dsds', 'U6', 'd', '2021-06-20 19:47:33', '2'),
('125fc3419bc', '132345dsds', 'U7', 'b', '2021-06-20 19:47:33', '2'),
('125fc3419d2', '132345dsds', 'U8', 'a', '2021-06-20 19:47:33', '2'),
('125fc3419e4', '132345dsds', 'U9', 'd', '2021-06-20 19:47:33', '2'),
('125fc345a33', 'tes_lagi', 'U1', 'd', '2020-11-29 13:55:03', '2'),
('125fc345a45', 'tes_lagi', 'U2', 'd', '2020-11-29 13:55:03', '2'),
('125fc345a54', 'tes_lagi', 'U3', 'd', '2020-11-29 13:55:03', '2'),
('125fc345a66', 'tes_lagi', 'U4', 'd', '2020-11-29 13:55:03', '2'),
('125fc345a74', 'tes_lagi', 'U5', 'd', '2020-11-29 13:55:03', '2'),
('125fc345a87', 'tes_lagi', 'U6', 'd', '2020-11-29 13:55:03', '2'),
('125fc345aa0', 'tes_lagi', 'U7', 'd', '2020-11-29 13:55:03', '2'),
('125fc345ab6', 'tes_lagi', 'U8', 'd', '2020-11-29 13:55:03', '2'),
('125fc345acc', 'tes_lagi', 'U9', 'd', '2020-11-29 13:55:03', '2'),
('1260cf37eb8', '1', 'U1', 'b', '2021-06-20 19:46:15', '2'),
('1260cf37ef1', '1', 'U2', 'b', '2021-06-20 19:46:15', '2'),
('1260cf37f65', '1', 'U3', 'd', '2021-06-20 19:46:15', '2'),
('1260cf37feb', '1', 'U4', 'd', '2021-06-20 19:46:15', '2'),
('1260cf3805a', '1', 'U5', 'c', '2021-06-20 19:46:15', '2'),
('1260cf38098', '1', 'U6', 'c', '2021-06-20 19:46:15', '2'),
('1260cf380e5', '1', 'U7', 'd', '2021-06-20 19:46:15', '2'),
('1260cf3812a', '1', 'U8', 'd', '2021-06-20 19:46:15', '2'),
('1260cf38180', '1', 'U9', 'c', '2021-06-20 19:46:15', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_loket`
--

CREATE TABLE `tb_loket` (
  `id_loket` varchar(15) NOT NULL,
  `nama_loket` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_loket`
--

INSERT INTO `tb_loket` (`id_loket`, `nama_loket`, `created_date`) VALUES
('5fb3c4f1b8e52', 'SAMSAT JEPARA', '2020-11-17 19:41:21'),
('5fb3c5838289c', 'BPJS KETENAGAKERJAAN', '2020-11-17 19:43:47'),
('5fb3d1dc2763b', 'BPKAD Jepara', '2020-11-17 20:36:28'),
('5fb3d1e86704a', 'DPUPR Jepara', '2020-11-17 20:36:40'),
('5fb3d1fb5325a', 'Dinas Lingkungan Hidup (DLH)', '2020-11-17 20:36:59'),
('5fb3d2264ba97', 'Diskominfo Jepara', '2020-11-17 20:37:42'),
('asdascas', 'DPMPTSP', '2020-11-17 10:25:11'),
('jsfsdk', 'BPJS KESEHATAN', '2020-11-17 11:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan`
--

CREATE TABLE `tb_pekerjaan` (
  `id` int(11) NOT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pekerjaan`
--

INSERT INTO `tb_pekerjaan` (`id`, `pekerjaan`) VALUES
(1, 'PNS/TNI/POLRI'),
(2, 'Pegawai Swasta'),
(3, 'Wiraswasta'),
(4, 'Pelajar/Mahasiswa'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelayanan`
--

CREATE TABLE `tb_pelayanan` (
  `id` int(10) NOT NULL,
  `id_loket` varchar(255) DEFAULT NULL,
  `nama_pelayanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pelayanan`
--

INSERT INTO `tb_pelayanan` (`id`, `id_loket`, `nama_pelayanan`) VALUES
(1, '5fb3d1dc2763b', 'PBB'),
(2, '5fb3d1dc2763b', 'PAJAK BANGUNAN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendidikan`
--

CREATE TABLE `tb_pendidikan` (
  `id` varchar(255) NOT NULL,
  `pendidikan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pendidikan`
--

INSERT INTO `tb_pendidikan` (`id`, `pendidikan`) VALUES
('1', 'SD Kebawah'),
('2', 'SMP'),
('3', 'SMA'),
('4', 'S1'),
('5', 'S2 Keatas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_soal` varchar(12) NOT NULL,
  `soal` text DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id_soal`, `soal`, `a`, `b`, `c`, `d`, `kategori`) VALUES
('U1', 'Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai', 'Persyaratan Pelayanan'),
('U2', 'Bagaimana pemahaman saudara tentang kemudahan prosedur pelayanan di unit ini', 'Tidak Mudah ', 'Kurang Mudah ', 'Mudah', 'Sangat Mudah', 'Prosedur Pelayanan'),
('U3', 'Bagaimana pendapat saudara tentang kecepatan pelayanan di unit ini', 'tidak tepat waktu', 'kadang tepat waktu', 'Banyak Tepat Waktu', 'Selalu Tepat Waktu', 'Waktu Pelayanan'),
('U4', 'Bagaimana pendapat saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan', 'Selalu Tidak Sesuai', 'Kadang Sesuai', 'Banyak Sesuainya', 'Selalu Sesuai', 'Biaya/tarif pelayanan'),
('U5', 'Bagaimana pendapat saudara tentang kesesuaian hasil pelayanan yang diberikan dan diterima dengan waktu yang ditetapkan', 'Tidak Sesuai', 'Kadang Sesuai', 'Sesuai', 'Sangat Sesuai', 'Produk Spesifikasi Jenis Pelayanan '),
('U6', 'Bagaimana pendapat saudara tentang kemampuan petugas dalam memberi pelayanan', 'Tidak Mampu', 'Kurang Mampu', 'Mampu', 'Sangat Mampu', 'Kompetensi Pelaksana Pelayanan'),
('U7', 'Bagaimana pendapat saudara tentang penanganan pengaduan,saran dan masukan pelayanan yang diberikan ', 'Tidak Baik', 'Kurang Baik', 'Baik', 'Sangat Baik', 'Perilaku Pelaksana Pelayanan'),
('U8', 'Bagaiman pendapat saudara tentang sarana dan prasarana yang digunakan dalam pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai ', 'Sangat Sesuai', 'Maklumat Pelayanan'),
('U9', 'Belum ada Soal', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai', 'Penanganan, Pengaduan , Saran dan Masukan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_saran`
--

CREATE TABLE `tb_saran` (
  `id_saran` int(255) NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `saran` longtext DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `status` enum('1','2') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_saran`
--

INSERT INTO `tb_saran` (`id_saran`, `id_responden`, `saran`, `created_date`, `status`) VALUES
(23, '123', 'oke \n', '2020-11-17 20:35:39', '2'),
(24, 'tea', 'oke', '2020-11-27 19:59:24', '1'),
(25, 'adasdasdasd', 'tes ok', '2020-11-28 02:32:37', '1'),
(26, 'tes_pengunjung_id', 'tes saran', '2020-11-29 13:31:25', '1'),
(27, '132345dsds', 'asadadasd', '2020-11-29 13:37:23', '1'),
(28, 'tes_lagi', 'tes dadad', '2020-11-29 13:54:42', '1'),
(29, '1', 'pertahankan', '2021-06-20 19:44:24', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE;

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`) USING BTREE;

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jawaban_sementara`
--
ALTER TABLE `jawaban_sementara`
  ADD PRIMARY KEY (`id_kuis`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`tahun`) USING BTREE;

--
-- Indexes for table `tb_detil_responden`
--
ALTER TABLE `tb_detil_responden`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_kuis`) USING BTREE;

--
-- Indexes for table `tb_loket`
--
ALTER TABLE `tb_loket`
  ADD PRIMARY KEY (`id_loket`) USING BTREE;

--
-- Indexes for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_pelayanan`
--
ALTER TABLE `tb_pelayanan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_soal`) USING BTREE;

--
-- Indexes for table `tb_saran`
--
ALTER TABLE `tb_saran`
  ADD PRIMARY KEY (`id_saran`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pelayanan`
--
ALTER TABLE `tb_pelayanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_saran`
--
ALTER TABLE `tb_saran`
  MODIFY `id_saran` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
