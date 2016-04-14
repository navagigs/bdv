-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2015 at 07:04 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bdv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_user` varchar(25) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `admin_nama` varchar(30) NOT NULL,
  `admin_alamat` varchar(250) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_telepon` varchar(15) NOT NULL,
  `admin_ip` varchar(12) NOT NULL,
  `admin_online` int(10) NOT NULL,
  `admin_level_kode` int(3) NOT NULL,
  `admin_status` char(1) NOT NULL,
  PRIMARY KEY (`admin_user`),
  KEY `admin_level_kode` (`admin_level_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_user`, `admin_pass`, `admin_nama`, `admin_alamat`, `admin_email`, `admin_telepon`, `admin_ip`, `admin_online`, `admin_level_kode`, `admin_status`) VALUES
('admin', '41bbc3b439f364520a2904cfae4d2e46', 'Nava Gia Ginasta', 'Cianjur', '', '087820033395', '', 0, 1, 'A'),
('asrul', '5111e795f8818c69fa4eb1889ecd7af7', 'asrul', 'Banjar', 'asrul@gmail.com', '91313', '', 0, 5, 'A'),
('jaka', '9d83066da00b7c7fa9de34117f488653', 'Jaka', 'bandung', 'jaka@gmail.com', '10051995', '', 0, 5, 'A'),
('member', 'aa08769cdcb26674c6706093503ff0a3', 'Nava Gia Ginasta', 'Cianjur', '', '087820033395', '', 0, 5, 'A'),
('mufqi', '687abca4409a301221b04751b34d0c63', 'Mufqi Nanda Fadilah', 'Tasikmalaya', '', '-', '', 0, 1, 'A'),
('nava', '827ccb0eea8a706c4c34a16891f84e7b', 'Nava Gia Ginasta', 'Cianjur', 'navagiaginasta@gmail.com', '087820033395', '', 0, 5, 'A'),
('op', '11d8c28a64490a987612f2332502467f', 'operator', '-', '', '-', '', 0, 2, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `admin_level`
--

CREATE TABLE IF NOT EXISTS `admin_level` (
  `admin_level_kode` int(3) NOT NULL AUTO_INCREMENT,
  `admin_level_nama` varchar(30) NOT NULL,
  `admin_level_status` char(1) NOT NULL,
  PRIMARY KEY (`admin_level_kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_level`
--

INSERT INTO `admin_level` (`admin_level_kode`, `admin_level_nama`, `admin_level_status`) VALUES
(1, 'Administrator', 'A'),
(2, 'Operator', 'A'),
(5, 'Member', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `agenda_id` int(11) NOT NULL AUTO_INCREMENT,
  `agenda_tema` varchar(100) NOT NULL,
  `agenda_deskripsi` text NOT NULL,
  `agenda_mulai` date NOT NULL,
  `agenda_selesai` date NOT NULL,
  `agenda_tempat` varchar(100) NOT NULL,
  `agenda_jam` varchar(50) NOT NULL,
  `agenda_gambar` varchar(100) DEFAULT NULL,
  `agenda_posting` datetime NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `agenda_tema`, `agenda_deskripsi`, `agenda_mulai`, `agenda_selesai`, `agenda_tempat`, `agenda_jam`, `agenda_gambar`, `agenda_posting`, `admin_nama`) VALUES
(12, 'TALENT DEVELOPMENT SATURDAY #12', 'alent Development Saturday adalah event bulanan dari Agate Studio kerjasama dengan Bandung Digital Valley untuk berbagi knowledge dari industri Game Development ke sesama pelaku industri dan potential talents. Format acara ini adalah presentasi dan tanya jawab yang dibagi ke 4 track:</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Art</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Technical</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Game Production &amp; Game Design</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Sales &amp; Marketing</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Acara Talent Development Saturday ini akan diselenggarakan pada:</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Tempat &nbsp; &nbsp;: Bandung Digital Valley,Ged. Manara RDC Lt. 4,</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Jl. Geger Kalong Hilir No. 47 Bandung</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Waktu &nbsp; &nbsp; &nbsp;: Sabtu, 31 Januari 2015</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Pukul 09.00 &ndash; 15.00</span><br style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;" />\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 27.2222px;">Sesi presentasi di setiap track akan diadakan secara paralel di 4 area yang berbeda. Satu slot presentasi adalah 1 jam, masing-masing track maksimum akan memiliki 5 slot presentasi dari jam 9 sampai 3 sore\r\n\r\n', '2015-09-30', '2015-09-30', 'Bandung Digital Valley,Ged. Manara RDC Lt. 4, Jl. Geger Kalong Hilir No. 47 Bandung', '09.00 – 15.00', '1443159487-even.png', '2015-09-25 12:38:07', 'Nava Gia Ginasta'),
(13, 'PERSUASIVE PRESENTATIONS', 'vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 1.75; font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51);">\r\n	On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>\r\n	But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\r\n', '2015-09-26', '2015-09-26', 'Bandung Digital Valley,Ged. Manara RDC Lt. 4, Jl. Geger Kalong Hilir No. 47 Bandung', '08.00 WIB', '1443160302-even.png', '2015-09-25 12:51:42', 'Nava Gia Ginasta');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(3) NOT NULL AUTO_INCREMENT,
  `album_judul` varchar(100) NOT NULL,
  `album_deskripsi` text NOT NULL,
  `album_gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_judul`, `album_deskripsi`, `album_gambar`) VALUES
(29, 'Album 1 Politeknik Pos Indonesia', '<p>\r\n	Album 1 Politeknik Pos Indonesia</p>\r\n', '1441113457-POLPOS.png'),
(30, 'Album 2 Politeknik Pos Indonesia', '<p>\r\n	Album 2 Politeknik Pos Indonesia</p>\r\n', '1441113487-slide1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `album_galeri`
--

CREATE TABLE IF NOT EXISTS `album_galeri` (
  `galeri_id` int(5) NOT NULL AUTO_INCREMENT,
  `galeri_judul` varchar(100) NOT NULL,
  `galeri_deskripsi` varchar(250) NOT NULL,
  `galeri_gambar` varchar(100) NOT NULL,
  `galeri_waktu` datetime NOT NULL,
  `album_id` int(3) NOT NULL,
  PRIMARY KEY (`galeri_id`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `album_galeri`
--

INSERT INTO `album_galeri` (`galeri_id`, `galeri_judul`, `galeri_deskripsi`, `galeri_gambar`, `galeri_waktu`, `album_id`) VALUES
(45, 'Contoh Gallery2', '<p>\r\n	Contoh Gallery2</p>\r\n', '1440333261-slide2.JPG', '2015-08-23 19:34:21', 29),
(46, 'Contoh Gallery4', '<p>\r\n	Contoh Gallery4</p>\r\n', '1440413846-logo poltekpos.png', '2015-08-24 17:56:47', 29),
(47, 'Contoh Gallery1', '<p>\r\n	Contoh Gallery1</p>\r\n', '1440413903-pol1.PNG', '2015-08-24 17:58:23', 29),
(48, 'Contoh Gallery3', '<p>\r\n	Contoh Albums</p>\r\n', '1440413943-pol2.PNG', '2015-08-24 17:59:03', 29),
(49, 'Contoh Gallery5', '<p>\r\n	Contoh Gallery5</p>\r\n', '1440413987-pol3.PNG', '2015-08-24 17:59:47', 29),
(50, 'Contoh Gallery6', '<p>\r\n	Contoh Gallery6</p>\r\n', '1440414020-DESAIN KEMEJA.png', '2015-08-24 18:00:20', 29),
(51, 'Contoh Gallery7', '<p>\r\n	Contoh Gallery7</p>\r\n', '1440414048-slide2.JPG', '2015-08-24 18:00:48', 29),
(52, 'Contoh Gallery8', '<p>\r\n	Contoh Gallery8</p>\r\n', '1440414112-SEMINAR.jpg', '2015-08-24 18:01:52', 29),
(53, 'Album 2 Politeknik Pos Indonesia', '<p>\r\n	Album 2 Politeknik Pos Indonesia</p>\r\n', '1441113588-launching.jpg', '2015-09-01 20:19:48', 30);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `berita_id` int(5) NOT NULL AUTO_INCREMENT,
  `berita_judul` varchar(100) NOT NULL,
  `headline` enum('N','Y') NOT NULL DEFAULT 'N',
  `berita_deskripsi` text NOT NULL,
  `berita_waktu` datetime NOT NULL,
  `berita_gambar` varchar(100) NOT NULL,
  `berita_hits` int(3) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `kategori_id` int(3) NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`berita_id`),
  KEY `kategori_id` (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `berita_judul`, `headline`, `berita_deskripsi`, `berita_waktu`, `berita_gambar`, `berita_hits`, `tags`, `kategori_id`, `admin_nama`) VALUES
(11, 'GAME DEVELOPER RAMAIKAN BANDUNG DIGITAL VALLEY DALAM GGJ 2015', 'Y', 'Ini adalah kali ke-2 keikutsertaan Bandung dalam Global Game Jam 2015 (GGJ). GGJ 2015 Indonesia yang merupkan event kolaborasi pengembangan game ini menantang para game developer, artist, composer, game designer di seluruh Indonesia untuk merancang dan mengembangkan game dalam kurun waktu 48 jam. Global Game Jam serentak diadakan diseluruh dunia. Meskipun terdapat perbedaan waktu. Namun tepat pada 23-25 Januari 2015 masa penyelenggaraannya. Acara hasil kerjasama antara komunitas Game Developer Bandung, Segitiga.Net, Fowab dan Tinker Games ini &nbsp;terbuka untuk semua kalangan, dan tidak dipungut biaya.</div>\r\n<div style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 13px; line-height: 28.8889px; font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); text-align: justify;">\r\n	Global Game Jam sebelumya diadakan di Agate Studio. Kali ini berhasil diselenggaraka di Bandung Digital Valley juga disponsori oleh Jalan Tikus dan Vserv. Jalan Tikus yang diwakili oleh Ratna Dewi, menjelaskan Jalan Tikus adalah sebuah situs unduh game dan aplikasi gratis dan legal. Selain itu juga menyediakan berbagai review dan tips untuk bermain game dan menjalankan aplikasi tentang kesempatan bagi para jammers untuk memasukkan hasil karya mereka ke Jalan Tikus. Jalan Tikus sangat berkomitmen untuk mendukung karya berkualitas dari para jammers untuk dikembangkan dan disebarkan lebih jauh lagi. Kemudian, Vserv yang diwakili oleh Silvia Andriana menjelaskan tentang layanan dari Vserv yang dapat membantu para game developer memasarkan game dengan data-data yang Vserv sediakan. Dengan ini, para game developer memiliki kesempatan untuk memonetisasi produk mereka lebih jauh lagi.</div>\r\n<div style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 13px; line-height: 28.8889px; font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); text-align: justify;">\r\n	Selama kurun waktu 3 hari, kurang lebih sebanyak 60 para game developer merancang, mengembangkan, dan mengupload game nya di globalgamejam.org. Bandung berhasil mengupload sebanyak 20 game dan terbanyak di seluruh Indonesia diantaranya, Do what you can do!, Black Loli in the Box- Kya What Should We Do, Blow n&rsquo; Up!, Clean Your River, Con-X, D&rsquo;Explorer, Going Home, Hell Rider, I&rsquo;m Your God, Jagakarsa : What The Fog, Kirbi Jump, Miku Pulang, Miniko, Rise From Sorrow, Save Your Virginity, Stranger : Block &amp; Beyond, The All Knowing Eye, The God Must Be Scrollolo, The Last Project, dan The Razia.</div>\r\n<div style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 13px; line-height: 28.8889px; font-family: ''Roboto Slab'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); text-align: justify;">\r\n	Terdapat perbedaan antara GGJ 2014 dengan GGJ 2015, dimana sebelumnya yang hadir para developer telah tergabung dalam sebuat tim. Sementara di GGJ 2015 semua developer game datang perseorangan, lalu saat dilokasi barulah dilakukan pembentukan tim. Dimana yang sebelumnya para game developer belum saling mengenal. Menjadi saling mengenal satu sama lainnya dan membuat tim.\r\n\r\n', '2015-09-01 13:22:52', '1443161277-game-developer-ramaikan-bandung-digital-valley-dalam-ggj-2015.jpg', 15, '', 3, 'Nava Gia Ginasta'),
(12, 'INILAH TOP 3 GRAND FINAL BESTAPPSID, CONGRATULATION!', 'Y', '<p>\r\n	16 Januari 2015. Setelah melewati masa pendampingan selama satu bulan oleh para mentor dari Bandung Digital Valley dan Jogja Digital Valley. Serta melewati masa penjurian pada 15-16 Januari 2015. Event BestApps.ID Hackathon terbesar yang berhadiah total milyaran rupiah yang terdiri atas hadiah uang tunai, program pendampingan bisnis dan kunjungan industry ke Silicon Valley Amerika Serikat. Telah dilaksanakan dengan sangat meriah. Pengumuman pemenang dan penganugrahan award diadakan di Bandung Digital Valley pada Jumat, 16 Januari 2015 pukul 18.00 s/d selesai yang dihadiri oleh Indra Utoyo selaku Director Innovation and Strategic Portfolio PT. Telkom, Hari Sungkari selaku Sekretaris Jendral MIKTI (Masyarakat Industri Kreatif TIK Indonesia), Halim Sulasmono selaku EGM ITSS, Jody Hernady selaku SGM IDec, dan Andy Zaky selaku Dewan TIK Nasional. Kelimanya sekaligus bertindak sebagai Juri Executive. Pemenang ke-3 BestApps.ID 2014 diperoleh oleh X-Igent Haji-Umrah yang berhak mendapatkan uang tunai sebesar Rp. 30 Juta. Aplikasi dari X-Igent ini akan mempermudah para Jemaah haji dan umrah. Adanya plikasi tombol darurat yang dapat mengirimkan informasi darurat kepada orang terdekat secara cepat. Selain itu, memiliki beberapa fitur, seperti pencarian lokasi penting terdekat, serta pemanggilan cepat ke call center. Selain aplikasi, kami juga berfokus untuk membuat wearable device yang nantinya dapat dihubungkan dengan aplikasi X-Igent, agar penggunaan X-Igent menjadi lebih mudah dan handal. Sementara itu, yang meraih juara ke 2 BestApps.ID 2014 adalah Perjam dengan aplikasinya Parquer. Aplikasi ini akan memudahkan anda para pengguna kendaraan dalam mencari lokasi parkir. Kesulitan dalam mendapatkan lokasi parkir ini yang menjadi landasan para tim Perjam untuk membuat aplikasi Parquer. Dengan Parquer, para pengendara akan dapat mengetahui penuh atau tidaknya suatu lahan parkir secara online sekaligus melakukan pemesanan tempat agar tidak bersusah payah dalam mencari lahan parkir yang kosong. Perjam berhak mendapatkan hadiah sebesar Rp. 45 Juta. Sebagai juara pertama adalah Bakor Team dengan aplikasinya SasBuzz. Susbuzz telah digunakan oleh lebih dari 5000 pengguna di seluruh Indonesia. Aplikasi cloud ini yang dirancang khusus untuk mendukung marketing para penggunanya di media sosial. Sasbuzz menerapkan konsep marketing di media sosial yang otomatis dan tertarget berdasarkan analisis profiling sosial media yang sistem Sasbuzz lakukan. Para pengguna Sasbuzz dapat memanfaatkan sistem ini untuk menentukan siapa customer segment potensial mereka di media sosial (berdasarkan lokasi, interest, common conversation dsb) untuk selanjutnya sistem Sasbuzz akan menganalisis profiling media sosial yang sesuai dan menjadikannya sebagai target marketing. Bakor Team berhak mengunjungi Sillicon Valley dan uang tunai sebesar Rp. 60 Juta. Selamat kepada seluruh pemenang. Maju terus Developer kreatif Indonesia.</p>\r\n', '2015-09-25 14:20:19', '1443165953-inilah-top-3-grand-final-bestappsid-congratulation.jpg', 22, '', 3, 'Nava Gia Ginasta'),
(14, 'HACKATHON INDIGO BESTAPPSID PEROLEH PLATINUM &amp; GOLD WINNER&#039;S', 'N', 'Bandung,30 November 2014, Ajang hackathon Indigo BestAppsID yang diselenggarakan oleh Bandung Digital Valley dan diikuti oleh lebih dari 800 peserta telah menghasilkan 10 Platinum Winner dan 14 Gold Winner. Seluruh Platinum Winner dan Gold Winner akan memperoleh pendampingan bisnis untuk penyempurnaan aplikasi hingga bulan Januari 2015. Tiga tim terbaik akan memperoleh hadiah utama, termasuk kesempatan industry visit ke Silicon Valley untuk tim terbaik.\r\nIndigo BestAppsID adalah event “coding 24 jam nonstop” diadakan di Sasana Budaya Ganesha (Sabuga) Bandung pada tanggal 29-30 November 2014 lalu. Secara total ajang ini diikuti oleh 800 peserta yang tergabung dalam 208 tim, dengan kebanyakan peserta berasal dari kota-kota besar di Jawa dan Bali. Total hadiah yang diperebutkan adalah senilai Rp 700 juta, kesempatan kunjungan ke Silicon Valley, dan komersialisasi dan publikasi produk di marketplace BestAppsID.\r\n“Telkom sebagai perusahaan telekomunikasi negara siap mendukung perkembangan industri ini khususnya dengan mendorong para pelaku industri kreatif lokal untuk berkreasi dan berkompetisi dalam ajang seperti Indigo BestAppsID ini,” ungkap Plt Direktur Utama Telkom Indra Utoyo.\r\nKategori aplikasi yang dilombakan adalah Social Media, Commerce, Personal Application, Business Solution dan Game & Content. Kriteria penilaian untuk penentuan pemenang adalah: (1) Penetapan Segmen Pengguna, (2) Ukuran Pasar, (3) Permasalahan yang dihadapi Pengguna, (4) Solusi yang ditawarkan, (5) Penerapan API Telkom (Application Programming Interface), (6) User Experience dan (7) Peluang Kerjasama dengan Telkom Group.\r\nSetelah melalui dua tahap seleksi, dengan juri utama yang terdiri dari Rizkan Candra (Direktur Network & IT Solution PT. Telkom), I Gusti Manik (Rockliffe System), Andi Kristianto (VP Corporate Planning Telkomsel), dan Calvin Kizana (Founder PicMix), BestAppsID menentukan 10 Platinum Winner (posisi 1-10) yang memperoleh hadiah 10 juta Rupiah dan 14 Gold Winner yang memperoleh hadiah 5 juta Rupiah.\r\nBerikut List Platinum Winner’s BestAppsID dan Gold Winner’s BestAppsID\r\n\r\nDua Tiga tim tersebut berhak maju ke tahap berikutnya di awal tahun 2015, dengan tiga aplikasi terbaik setelah pendampingan bisnis akan mendapatkan hadiah sebesar Rp. 60 Juta, 45 Juta Rupiah dan Rp. 30 Juta. Tentu saja yang paling diinginkan oleh peserta event ini adalah kesempatan untuk melakukan kunjungan ke Silicon Valley dan bertemu dengan pelaku bisnis di dunia digital.\r\nSumber: DailySocial adalah media partner Indigo BestAppsID 2014', '2015-09-25 14:26:33', '1443165993-hackathon-indigo-bestappsid-peroleh-platinum--gold-winners.jpg', 8, '', 3, 'Nava Gia Ginasta'),
(15, 'AWASI ANAK MENGAKSES KONTEN DI SMARTPHONE DENGAN KAKATU', 'Y', 'Aplikasi Saat ini anak-anak pada jaman sekarang semakin sudah mengakses konten-konten yang tidak seharusnya seperti konten dewasa dan seksual. Data riset dari Yayasan Kita dan Buah Hati menyatakan bahwa pada tahun 2013 jumlah situs pornografi yang pernah diakses mencapai 4.3 juta. Jumlah yang fantastis bukan? Ditambah lagi dengan fakta lain yang menyebutkan bahwa 95 dari 100 anak SD Indonesia pernah mengakses konten pornografi.\r\nDi Inggris, pemerintah inggris bahkan memberikan donasi sebesar 1 juta pound untuk usaha-usaha menyelidiki gambar-gambar yang terkait dengan pornografi anak di internet. Namun usaha tersebut dipercaya belum cukup untuk membatasi anak-anak mengakses konten pornografi. Kekhawatiran tetap ada bahwa anak-anak terlau mudah untuk dapat mengakses konten porno di rumah dan di daerah ber-WiFi gratis.\r\nKekhawatiran ini juga memicu Mumu, founder salah satu startup Indigo Incubator yang mendirikan Kakatu atas pengguanan smartphone anak. Kakatu sebagai parental control di android yang mencakup pembatasan dan pengawasan aplikasi yang boleh dikases anak ternyata aman, mudah dan menyenangkan bagi anak dalam mengguanakan device mereka. Pada aplikasi Kakatu terdapat konten aplikasi anak yang dapat dimoderasi orang tua terlebih dahulu dan juga dapat menyederhanakan kompleksitas android seperti kontak dan pesan yang disesuaikan dengan kebutuhan anak. Tampilannya dapat diset dengan tema-tema yang lucu sehingga anak tidak bosan ketika menggunakan device mereka.\r\nKakatu menyediakan sebuah fungsionalitas agar orang tua dapat memilih sendiri aplikasi mana saja yang boleh diakses anak. Bagi orang tua tidak perlu khawatir karena tidak mengetahui aplikasi mana saja yang boleh diakses karena dan kakatu juga memberikan rekomendasi aplikasi yang aman untuk diakses anak.\r\nRencanaya kakatu akan meluncurkan “Kakatu for Mom” yang berfungsi agar orang tua dapat melakukan kontrol terhadap aplikasi anak kapanpun dan dimanapun.\r\n Yuk batasi adik-adik kita agar tidak salah mengakses konten yang tidak perlu dengan aplikasi Kakatu. (Rissa Ang)', '2015-09-25 14:38:41', '1443166721-awasi-anak-mengakses-konten-di-smartphone-dengan-kakatu.jpg', 14, '', 3, 'Nava Gia Ginasta'),
(16, 'KARAMEL CAPTCHA AKAN TAMPIL PADA SESI KHUSUS APMF DI BALI', 'N', 'Karamel, salah satu startup jebolan program Indigo Incubator 2013 akan berlaga dalam sesi khusus di ajang Asia Pacific Media Forum yang akan diselenggarakan pada tanggal 18 hingga 21 September 2014 di Nusa Dua, Bali.\r\nAsia Pasific Media Forum atau biasa disebut APMF sendiri adalah Ajang internasional pertemuan para ahli pemasaran, pakar media, spesialis komunikasi dan agen perubahan. Forum ini diselenggarakan untuk memberikan inspirasi terhadap pengembangan inovasi komunikasi pemasaran dan menciptakan ide ide kreatif dalam rangka menjalin hubungan yang erat antara brand dan penggunanya. Pada acara ini, startup berkesempatan untuk memperkenalkan produk mereka dihadapan para pemegang kepentingan di dunia pemasaran dan komunikasi.\r\nKaramel sendiri adalah startup bidang digital yang menawarkan captcha unik dalam bentuk visual. Karamel berpotensi menjadi platform iklan yang mampu menempatkan kampanye iklan pada sebuah pilihan bergambar dan dibuat lebih interaktif kepada pengunjung website. Aditya Dwi Putra sebagai Founder dari Startup akan tampil selama 5 menit secara bergantian dengan 3 startup lainnya diantaranya yaitu PicMix, iPhonesia, dan Marbel. (RR)', '2015-09-25 14:39:50', '1443166790-karamel-captcha-akan-tampil-pada-sesi-khusus-apmf-di-bali.png', 33, '', 3, 'Nava Gia Ginasta'),
(17, 'KOMPETISI INDONESIA NEXT APP', 'N', 'Indonesia Next App merupakan acara yang diinisiasi oleh Samsung sebagai market leader smartphone di Indonesia yang bekerja sama dengan operator seluler terbesar Indonesia, Telkomsel. Kolaborasi tersebut menjadikan acara ini layak dinanti bagi Anda dan rekan-rekan developer Indonesia. Ini menjadi kesempatan bagi para developer dan para penggiat startup untuk membawa produk mereka tidak hanya bersaing di tingkat nasional, tetapi juga ke tingkat Asia bahkan dunia.\r\nRekan-rekan pengembang sering kesulitan memperkenalkan aplikasi buatannya ke masyarakat. Terlepas dari manfaat aplikasi yang bersangkutan, banyak aplikasi yang  minim diunduh karena kurangnya sosialisasi. Lantas berapa lama waktu yang dibutuhkan oleh pengembang untuk menunggu masyarakat luas menilai dan menggunakan aplikasi yang telah dirancang, jika hanya memanfaatkan berita dari mulut ke mulut saja?INA merupakan kesempatan langka untuk para developer dan penggiat startup tanah air. Pasalnya, dua perusahaan besar siap meng-endorse aplikasi lokal untuk diorbitkan, sehingga penggunaan aplikasinya akan tersedia dalam skala global. Langkah ini tentu saja memudahkan startup dan developer menjaring banyak calon pengguna baru, termasuk mempromosikan ke aset-aset yang mereka miliki. Dengan turut berpartisipasi di INA, perjuangan startup diharapkan dapat lebih lancar apabila mereka lebih terbuka untuk menerima kesempatan dari telco dan vendor yang siap membantu mereka.\r\n\r\nJadi jika Anda memiliki aplikasi yang sekarang sedang tersisihkan sementara karena kesibukan mengerjakan proyek aplikasi lain, kami undang Anda untuk menyelesaikan aplikasi tersebut dengan berpartisipasi di #INA dan rebut hadiahnya.\r\n\r\nMasih ada waktu bagi anda yang ingin mendaftarkan diri dan bergabung di kompetisi Indonesia Next App. Anda tidak perlu mengirimkan aplikasi yang sudah jadi. Cukup daftarkan detail konsep aplikasi dan SDK Samsung yang akan digunakan hingga batas waktu 23 Agustus mendatang melalui http://dailysocial.net/ina/\r\nDari keseluruhan aplikasi yang terdaftar, tim juri akan memilih tujuh besar aplikasi pada tanggal 25 Agustus. Para peserta yang terpilih dipersilakan mempersiapkan diri dalam finalisasi aplikasinya dan pitching di hadapan dewan juri pada 25 September 2014.\r\nTerkait pertanyaan umum tentang apakah ada perangkat Samsung disediakan atau dipinjamkan untuk membantu proses pembuatan aplikasi, pihak Samsung telah mengantisipasi dengan menyiapkan emulator yang dapat dimanfaatkan pengembang.\r\nUntuk pertanyaan lebih lanjut seputar INA, silakan layangkan pertanyaan Anda melalui email ke alamat rahmat[at]dailysocial.net atau arif[at]dailysocial.net dan disini Info lengkap: http://dailysocial.net/post/ina-siapkan-hadiah-usd-12000-untuk-perwakilan-indonesia', '2015-09-25 14:40:40', '1443166840-kompetisi-indonesia-next-app.jpg', 22, '', 3, 'Nava Gia Ginasta'),
(18, 'Jobs Fair', 'N', 'Indonesia Next App merupakan acara yang diinisiasi oleh Samsung sebagai market leader smartphone di Indonesia yang bekerja sama dengan operator seluler terbesar Indonesia, Telkomsel. Kolaborasi tersebut menjadikan acara ini layak dinanti bagi Anda dan rekan-rekan developer Indonesia. Ini menjadi kesempatan bagi para developer dan para penggiat startup untuk membawa produk mereka tidak hanya bersaing di tingkat nasional, tetapi juga ke tingkat Asia bahkan dunia.\r\nRekan-rekan pengembang sering kesulitan memperkenalkan aplikasi buatannya ke masyarakat. Terlepas dari manfaat aplikasi yang bersangkutan, banyak aplikasi yang  minim diunduh karena kurangnya sosialisasi. Lantas berapa lama waktu yang dibutuhkan oleh pengembang untuk menunggu masyarakat luas menilai dan menggunakan aplikasi yang telah dirancang, jika hanya memanfaatkan berita dari mulut ke mulut saja?INA merupakan kesempatan langka untuk para developer dan penggiat startup tanah air. Pasalnya, dua perusahaan besar siap meng-endorse aplikasi lokal untuk diorbitkan, sehingga penggunaan aplikasinya akan tersedia dalam skala global. Langkah ini tentu saja memudahkan startup dan developer menjaring banyak calon pengguna baru, termasuk mempromosikan ke aset-aset yang mereka miliki. Dengan turut berpartisipasi di INA, perjuangan startup diharapkan dapat lebih lancar apabila mereka lebih terbuka untuk menerima kesempatan dari telco dan vendor yang siap membantu mereka.\r\n\r\nJadi jika Anda memiliki aplikasi yang sekarang sedang tersisihkan sementara karena kesibukan mengerjakan proyek aplikasi lain, kami undang Anda untuk menyelesaikan aplikasi tersebut dengan berpartisipasi di #INA dan rebut hadiahnya.\r\n\r\nMasih ada waktu bagi anda yang ingin mendaftarkan diri dan bergabung di kompetisi Indonesia Next App. Anda tidak perlu mengirimkan aplikasi yang sudah jadi. Cukup daftarkan detail konsep aplikasi dan SDK Samsung yang akan digunakan hingga batas waktu 23 Agustus mendatang melalui http://dailysocial.net/ina/\r\nDari keseluruhan aplikasi yang terdaftar, tim juri akan memilih tujuh besar aplikasi pada tanggal 25 Agustus. Para peserta yang terpilih dipersilakan mempersiapkan diri dalam finalisasi aplikasinya dan pitching di hadapan dewan juri pada 25 September 2014.\r\nTerkait pertanyaan umum tentang apakah ada perangkat Samsung disediakan atau dipinjamkan untuk membantu proses pembuatan aplikasi, pihak Samsung telah mengantisipasi dengan menyiapkan emulator yang dapat dimanfaatkan pengembang.\r\nUntuk pertanyaan lebih lanjut seputar INA, silakan layangkan pertanyaan Anda melalui email ke alamat rahmat[at]dailysocial.net atau arif[at]dailysocial.net dan disini Info lengkap: http://dailysocial.net/post/ina-siapkan-hadiah-usd-12000-untuk-perwakilan-indonesia', '2015-09-25 23:05:18', '1443197118-jobs-fair.png', 8, '', 4, 'Nava Gia Ginasta');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1822 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(1798, 1443194104, '::1', '7195'),
(1799, 1443194806, '::1', '9412'),
(1800, 1443195025, '::1', '6431'),
(1801, 1443195382, '::1', '2135'),
(1802, 1443195384, '::1', '7801'),
(1803, 1443195403, '::1', '9385'),
(1804, 1443195408, '::1', '7691'),
(1805, 1443195441, '::1', '6572'),
(1806, 1443196337, '::1', '7653'),
(1807, 1443196369, '::1', '7930'),
(1808, 1443197065, '::1', '5867'),
(1809, 1443197076, '::1', '2765'),
(1810, 1443197253, '::1', '9178'),
(1811, 1443197404, '::1', '0873'),
(1812, 1443197549, '::1', '9437'),
(1813, 1443197572, '::1', '5372'),
(1814, 1443197901, '::1', '6413'),
(1815, 1443197950, '::1', '8275'),
(1816, 1443197978, '::1', '0976'),
(1817, 1443198491, '::1', '3789'),
(1818, 1443198581, '::1', '3587'),
(1819, 1443198593, '::1', '5079'),
(1820, 1443198716, '::1', '4832'),
(1821, 1443200314, '::1', '1530');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `download_id` int(5) NOT NULL AUTO_INCREMENT,
  `download_judul` varchar(50) NOT NULL,
  `download_deskripsi` varchar(250) NOT NULL,
  `download_file` varchar(250) NOT NULL,
  `download_hits` int(5) NOT NULL,
  `download_waktu` datetime NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`download_id`, `download_judul`, `download_deskripsi`, `download_file`, `download_hits`, `download_waktu`) VALUES
(22, 'Bandung Digital Valley Files', 'Bandung Digital Valley Files', 'fasilitas.xlsx', 0, '2015-09-25 18:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE IF NOT EXISTS `fasilitas` (
  `fasilitas_id` int(5) NOT NULL AUTO_INCREMENT,
  `fasilitas_nama` varchar(255) NOT NULL,
  `fasilitas_deskripsi` text NOT NULL,
  `fasilitas_gambar` varchar(255) NOT NULL,
  `fasilitas_waktu` datetime NOT NULL,
  PRIMARY KEY (`fasilitas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`fasilitas_id`, `fasilitas_nama`, `fasilitas_deskripsi`, `fasilitas_gambar`, `fasilitas_waktu`) VALUES
(1, 'Cafe', '<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color: rgb(119, 119, 119); font-family: ''Droid Serif'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; font-style: italic; line-height: 31.1111px; text-align: center;">Bandung Digital Valley</span></div>\r\n', '1443162368-fa-gadget room.png', '2015-09-25 13:26:08'),
(3, 'Lounge', '<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color: rgb(119, 119, 119); font-family: ''Droid Serif'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; font-style: italic; line-height: 31.1111px; text-align: center;">Bandung Digital Valley</span></div>\r\n', '1443180028-fa-lounge.png', '2015-09-25 13:27:54'),
(4, 'Meeting Room', '<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color: rgb(119, 119, 119); font-family: ''Droid Serif'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; font-style: italic; line-height: 31.1111px; text-align: center;">Bandung Digital Valley</span></div>\r\n', '1443162861-fa-meetroom.png', '2015-09-25 13:34:21'),
(5, 'Creative Desk', '<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color: rgb(119, 119, 119); font-family: ''Droid Serif'', ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 16px; font-style: italic; line-height: 31.1111px; text-align: center;">Bandung Digital Valley</span></div>\r\n', '1443162997-fa-creativedesk.png', '2015-09-25 13:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_video`
--

CREATE TABLE IF NOT EXISTS `galeri_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_judul` varchar(100) NOT NULL,
  `video_deskripsi` varchar(250) NOT NULL,
  `video_link` varchar(200) NOT NULL,
  `video_waktu` datetime NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `galeri_video`
--

INSERT INTO `galeri_video` (`video_id`, `video_judul`, `video_deskripsi`, `video_link`, `video_waktu`) VALUES
(4, 'Bandung Digital valley', 'Bandung Digital valley', 'http://www.youtube.com/embed/ub3lSlDsQM8', '2015-09-26 00:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `identitas_id` int(3) NOT NULL AUTO_INCREMENT,
  `identitas_website` varchar(250) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_alamat` varchar(250) NOT NULL,
  `identitas_notelp` char(20) NOT NULL,
  `identitas_fb` varchar(100) NOT NULL,
  `identitas_email` varchar(100) NOT NULL,
  `identitas_tw` varchar(100) NOT NULL,
  `identitas_gp` varchar(100) NOT NULL,
  `identitas_yb` varchar(100) NOT NULL,
  `identitas_favicon` varchar(250) NOT NULL,
  `identitas_author` varchar(100) NOT NULL,
  PRIMARY KEY (`identitas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_alamat`, `identitas_notelp`, `identitas_fb`, `identitas_email`, `identitas_tw`, `identitas_gp`, `identitas_yb`, `identitas_favicon`, `identitas_author`) VALUES
(1, 'Bandung Digital Valley', 'Bandung Digital valley memiliki beragam program yang akan turut mengembangkan berbagai metode pembelajaran hingga pengembangan bisnis dibidang IT dan Ide Kreatif.', 'Bandung Digital Valley mempersembahkan beragam event bermanfaat bagi setiap member khususnya dan masyarakat pada umumnya.', 'Menara R&amp;D Center 4th Floor  Jl. Gegerkalong Hilir no. 47 Bandung 40152', 'Fax : 022-457BD', 'https://www.facebook.com/bandungdigitalvalley', 'info@bandungdigitalvalley.com ', 'https://twitter.com/telkom_BDV', 'http://bandungdigitalvalley.com/', 'https://www.youtube.com/channel/UCEyaAcXChaDDN9P0bnU1xHg', '1442838626-BDV.jpeg', 'www.nava.web.id | info@nava.web.id | 087820033395');

-- --------------------------------------------------------

--
-- Table structure for table `join_event`
--

CREATE TABLE IF NOT EXISTS `join_event` (
  `join_id` int(3) NOT NULL AUTO_INCREMENT,
  `join_nama` varchar(30) NOT NULL,
  `agenda_id` int(3) NOT NULL DEFAULT '0',
  `join_waktu` datetime NOT NULL,
  PRIMARY KEY (`join_id`,`agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `join_event`
--

INSERT INTO `join_event` (`join_id`, `join_nama`, `agenda_id`, `join_waktu`) VALUES
(13, 'asrul', 12, '2015-09-25 19:33:15'),
(16, 'Jaka', 12, '2015-09-25 21:30:27'),
(17, 'Nava Gia Ginasta', 12, '2015-09-25 22:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(3) NOT NULL AUTO_INCREMENT,
  `kategori_judul` varchar(50) NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_judul`, `admin_nama`) VALUES
(3, 'Berita', 'Nava Gia Ginasta'),
(4, 'Jobs', 'Nava Gia Ginasta');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `komentar_nama` varchar(30) NOT NULL,
  `komentar_deskripsi` text NOT NULL,
  `komentar_waktu` datetime NOT NULL,
  `berita_id` int(5) NOT NULL,
  PRIMARY KEY (`komentar_id`),
  KEY `berita_id` (`berita_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `komentar_nama`, `komentar_deskripsi`, `komentar_waktu`, `berita_id`) VALUES
(27, 'Nava Gia Ginasta', 'Sangat Bagus', '2015-09-25 23:29:53', 15);

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE IF NOT EXISTS `management` (
  `management_id` int(5) NOT NULL AUTO_INCREMENT,
  `management_nama` varchar(100) NOT NULL,
  `management_jabatan` varchar(100) NOT NULL,
  `management_team` varchar(250) NOT NULL,
  `management_deskripsi` text NOT NULL,
  `management_email` varchar(100) NOT NULL,
  `management_fb` varchar(250) NOT NULL,
  `management_twitter` varchar(250) NOT NULL,
  `management_gp` varchar(250) NOT NULL,
  `management_foto` varchar(250) NOT NULL,
  `management_post` datetime NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`management_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`management_id`, `management_nama`, `management_jabatan`, `management_team`, `management_deskripsi`, `management_email`, `management_fb`, `management_twitter`, `management_gp`, `management_foto`, `management_post`, `admin_nama`) VALUES
(3, 'Indra Purnama', 'Executive Director', 'OUR MANAGAMENT TEAM', '<p>\r\n	Web Developers</p>\r\n', '#', 'https://www.facebook.com/ipurnama', 'https://twitter.com/indradotme', '#', '1443013649-Indra Purnama,.png', '2015-09-23 19:54:07', 'Nava Gia Ginasta'),
(4, 'Andriansyah', 'Community & Partnership Manager', 'OUR MANAGAMENT TEAM', '<p>\r\n	-</p>\r\n', 'Andriansyah', 'https://www.facebook.com/andriansyahariffin', '#', '#', '1443013759-Andriansyah.png', '2015-09-23 20:09:19', 'Nava Gia Ginasta'),
(5, 'M. Hanif Dinada', 'Incubation Manager', 'OUR MANAGAMENT TEAM', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'M. Hanif Dinada', 'https://www.facebook.com/mhanif.dinada?', '#', '#', '1443013802-M. Hanif Dinada.png', '2015-09-23 20:10:02', 'Nava Gia Ginasta'),
(6, 'Cynthia Dewiranti', 'Public Relation', 'OUR MANAGAMENT TEAM', '<p>\r\n	-</p>\r\n', 'Cynthia Dewiranti', 'https://www.facebook.com/sukasukaloeaja', 'https://twitter.com/cynthiade_', '#', '1443013876-Cintya Dewiranti.png', '2015-09-23 20:11:16', 'Nava Gia Ginasta'),
(7, 'Fenti Pertiwi', 'Incubation Coordinator & Finance', 'OUR MANAGAMENT TEAM', '<p>\r\n	-</p>\r\n', 'Fenti Pertiwi', 'https://www.facebook.com/fenty.pertiwi', 'https://twitter.com/fentipertiwi', '#', '1443013933-Fenty Pertiwi.png', '2015-09-23 20:12:13', 'Nava Gia Ginasta'),
(9, 'Ibnu Sina Wardy', 'CEO GITS Indonesia', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Ibnu Sina Wardy', '#', '#', '#', '1443163545-Ibnu Sina Wardi.png', '2015-09-25 13:45:45', 'Nava Gia Ginasta'),
(10, 'Arief Widhiyasa', ' CEO Agate Studio', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Arief Widhiyasa', '', '', '', '1443163590-Arief Widhiyasa.png', '2015-09-25 13:46:30', 'Nava Gia Ginasta'),
(11, 'Jimmy Kurnia ', 'CMO Skill Institute', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Jimmy Kurnia ', '', '', '', '1443163621-Jimmy Kurnia.png', '2015-09-25 13:47:01', 'Nava Gia Ginasta'),
(12, 'Juwanda', ' CEO Nuesto Technology', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Juwanda', '', '', '', '1443163650-juwanda.png', '2015-09-25 13:47:30', 'Nava Gia Ginasta'),
(13, 'Yohan Totting ', 'Google Developer Expert', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Yohan Totting ', '', '', '', '1443163671-yohan totting.png', '2015-09-25 13:47:51', 'Nava Gia Ginasta'),
(14, 'Samuel Henry', 'Game Design Lecturer', 'FIND MENTORS', '<p>\r\n	Deskripsi <span style="color:#ff0000;">*</span></p>\r\n', 'Samuel Henry', '', '', '', '1443163709-samuel Henry.png', '2015-09-25 13:48:29', 'Nava Gia Ginasta');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_kode` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(50) NOT NULL,
  `menu_deskripsi` varchar(50) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `menu_site` enum('A','H') NOT NULL DEFAULT 'A',
  `menu_level` char(1) NOT NULL,
  `menu_subkode` int(11) NOT NULL,
  `menu_urutan` int(2) NOT NULL,
  `menu_status` char(1) NOT NULL,
  PRIMARY KEY (`menu_kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=174 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_kode`, `menu_nama`, `menu_deskripsi`, `menu_url`, `menu_site`, `menu_level`, `menu_subkode`, `menu_urutan`, `menu_status`) VALUES
(1, 'Beranda', 'Beranda', 'admin', 'A', '1', 0, 1, 'A'),
(3, 'Website', 'Website', 'website', 'A', '1', 0, 2, 'A'),
(7, 'Pengaturan', 'Pengaturan', 'pengaturan', 'A', '1', 0, 7, 'A'),
(9, 'Profil', 'Informasi Profil', '#', 'A', '2', 1, 1, 'H'),
(11, 'Daftar Menu', 'Informasi Daftar Menu', 'pengaturan/menu', 'A', '3', 13, 1, 'A'),
(12, 'Pengaturan Umum', 'Informasi Pengaturan Umum', 'pengaturan/umum', 'A', '2', 7, 1, 'H'),
(13, 'Setting', 'fa fa-cog fa-fw', '#', 'A', '2', 1, 4, 'A'),
(16, 'Daftar Pengguna', 'Daftar Pengguna', 'pengaturan/pengguna/view', 'A', '3', 13, 1, 'A'),
(17, 'Tambah Pengguna', 'Tambah Pengguna', 'pengaturan/pengguna/tambah', 'A', '3', 13, 2, 'H'),
(19, 'Hak Akses Kelompok', 'Hak Akses Kelompok', 'pengaturan/hak_akses', 'A', '3', 13, 4, 'A'),
(79, 'Menu Utama', 'fa-list', '#', 'A', '2', 1, 3, 'A'),
(80, 'MODUL WEB', 'Informasi Website', '#', 'A', '2', 3, 3, 'H'),
(84, 'Agenda / Events', 'Informasi Agenda / Events', 'website/agenda', 'A', '3', 79, 5, 'A'),
(93, 'Public', 'Menu Public', '#', 'A', '1', 0, 0, 'A'),
(94, 'BERANDA', 'Beranda', 'home', 'A', '2', 93, 1, 'H'),
(97, 'Kategori Berita', 'Informasi Kategori Berita', 'website/kategori', 'A', '3', 79, 1, 'H'),
(98, 'Berita', 'Informasi Berita', 'website/berita', 'A', '3', 79, 2, 'A'),
(99, 'Tags', 'Informasi Tags', 'website/tags', 'A', '3', 79, 3, 'A'),
(100, 'Komentar', 'Informasi Komentar', 'website/komentar', 'A', '3', 79, 4, 'A'),
(101, 'Download File', 'Informasi Download File', 'website/download_file', 'A', '3', 79, 6, 'A'),
(104, 'Galeri Video', 'Informasi Galeri Video', 'website/galeri_video', 'A', '3', 79, 9, 'A'),
(105, 'Modul Website', 'fa-laptop', '#', 'A', '2', 1, 2, 'A'),
(106, 'Identitas Website', 'Informasi Identitas Website', 'website/identitas/edit/1', 'A', '3', 105, 1, 'A'),
(157, 'Partners / Mitra Kerja', 'Informasi Partner / Mitra Kerja', 'website/mitra_kerja', 'A', '3', 79, 10, 'A'),
(158, 'Kelompok Pengguna', 'Kelompok Pengguna', 'pengaturan/kelompok_pengguna', 'A', '3', 13, 3, 'A'),
(160, 'Home', ' fa-home', 'admin', 'A', '2', 1, 1, 'A'),
(161, 'Dashboard', 'Dashboard', 'admin', 'A', '3', 160, 1, 'A'),
(162, 'Management Team', 'Informasi Management Team', 'website/management', 'A', '3', 105, 2, 'A'),
(163, 'Home', '#', '#tf-home', 'A', '2', 93, 1, 'A'),
(164, 'Service', '#', '#tf-services', 'A', '2', 93, 2, 'A'),
(165, 'Companies', '#', '#tf-companies', 'A', '2', 93, 3, 'A'),
(166, 'Facilities', '#', '#tf-facilities', 'A', '2', 93, 4, 'A'),
(167, 'About Us', '#', '#tf-about', 'A', '2', 93, 5, 'A'),
(168, 'Updates', '#', '#tf-updates', 'A', '2', 93, 6, 'A'),
(169, 'Contact', '#', '#tf-contact', 'A', '2', 93, 7, 'A'),
(170, 'News', '#', 'news', 'A', '3', 168, 1, 'A'),
(171, 'Events', '#', 'events', 'A', '3', 168, 2, 'A'),
(172, 'Jobs', '#', 'jobs', 'A', '3', 168, 3, 'A'),
(173, 'Fasilitas', 'Informasi Fasilitas', 'website/fasilitas', '', '3', 105, 3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE IF NOT EXISTS `menu_admin` (
  `menu_admin_kode` int(11) NOT NULL AUTO_INCREMENT,
  `menu_kode` int(11) NOT NULL,
  `admin_level_kode` int(3) NOT NULL,
  PRIMARY KEY (`menu_admin_kode`),
  KEY `menu_kode` (`menu_kode`),
  KEY `admin_level_kode` (`admin_level_kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=269 ;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`menu_admin_kode`, `menu_kode`, `admin_level_kode`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 7, 1),
(14, 79, 1),
(16, 84, 1),
(24, 80, 1),
(30, 11, 1),
(31, 13, 1),
(32, 16, 1),
(33, 17, 1),
(34, 18, 1),
(35, 19, 1),
(36, 94, 1),
(96, 96, 1),
(102, 9, 5),
(111, 1, 2),
(112, 79, 2),
(210, 95, 1),
(211, 9, 2),
(212, 3, 2),
(213, 84, 2),
(214, 79, 3),
(215, 84, 3),
(217, 98, 1),
(218, 99, 1),
(219, 100, 1),
(220, 101, 1),
(221, 102, 1),
(222, 103, 1),
(223, 104, 1),
(224, 105, 1),
(225, 106, 1),
(226, 107, 1),
(227, 108, 1),
(228, 109, 1),
(229, 110, 1),
(230, 111, 1),
(231, 157, 1),
(232, 158, 1),
(233, 12, 1),
(234, 98, 2),
(235, 100, 2),
(236, 101, 2),
(237, 103, 2),
(249, 105, 2),
(250, 108, 2),
(251, 9, 4),
(252, 79, 4),
(254, 98, 4),
(255, 100, 4),
(256, 84, 4),
(257, 101, 4),
(258, 103, 4),
(259, 104, 4),
(260, 105, 4),
(261, 108, 4),
(262, 1, 4),
(263, 3, 4),
(264, 160, 1),
(265, 161, 1),
(266, 97, 1),
(267, 162, 1),
(268, 173, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitra_kerja`
--

CREATE TABLE IF NOT EXISTS `mitra_kerja` (
  `mitra_id` int(5) NOT NULL AUTO_INCREMENT,
  `mitra_gambar` text NOT NULL,
  `mitra_link` varchar(250) NOT NULL,
  `mitra_waktu` datetime NOT NULL,
  PRIMARY KEY (`mitra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mitra_kerja`
--

INSERT INTO `mitra_kerja` (`mitra_id`, `mitra_gambar`, `mitra_link`, `mitra_waktu`) VALUES
(6, '1443082245-jakdv.png', '#', '2015-08-25 19:43:04'),
(7, '1443082236-jdv.png', '#', '2015-08-25 19:45:48'),
(8, '1443082220-mdi.png', '#', '2015-08-25 20:02:00'),
(9, '1443082203-telkom.png', '#', '2015-08-25 20:03:04'),
(10, '1443082190-mikti-color.png', '#', '2015-08-25 20:04:26'),
(12, '1443082291-telkomsel50.png.jpg', '#', '2015-09-24 15:08:38'),
(14, '1443082271-dilo.png', '#', '2015-09-24 15:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `pesan_kode` int(11) NOT NULL AUTO_INCREMENT,
  `pesan_pengirim` varchar(50) NOT NULL,
  `pesan_subjek` varchar(255) NOT NULL,
  `pesan_email` varchar(100) NOT NULL,
  `pesan_isi` text NOT NULL,
  `pesan_datetime` datetime NOT NULL,
  `pesan_read` enum('Y','N') NOT NULL DEFAULT 'N',
  `pesan_type` enum('I','O') NOT NULL,
  `pesan_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`pesan_kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`pesan_kode`, `pesan_pengirim`, `pesan_subjek`, `pesan_email`, `pesan_isi`, `pesan_datetime`, `pesan_read`, `pesan_type`, `pesan_status`) VALUES
(3, 'nava gia ginasta', 'Kontak Kami', 'navagiaginasta@gmail.com', 'Bagus :)', '2015-09-01 13:06:32', 'N', 'I', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('045d9bf816a55be4a54197a02210fc61', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1', 1443198746, ''),
('a4ae0fbae21671b47e32578df361b22f', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.99 Safari/537.36', 1443200635, 'a:8:{s:9:"user_data";s:0:"";s:10:"admin_nama";s:16:"Nava Gia Ginasta";s:12:"admin_alamat";s:7:"Cianjur";s:11:"admin_email";s:24:"navagiaginasta@gmail.com";s:13:"admin_telepon";s:12:"087820033395";s:10:"admin_user";s:5:"admin";s:11:"admin_level";s:1:"1";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `slide_id` int(5) NOT NULL AUTO_INCREMENT,
  `slide_judul` varchar(100) NOT NULL,
  `slide_gambar` varchar(100) NOT NULL,
  `slide_deskripsi` text NOT NULL,
  `slide_waktu` datetime NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`slide_id`, `slide_judul`, `slide_gambar`, `slide_deskripsi`, `slide_waktu`) VALUES
(6, 'Slide2', '1439110065-slide2.JPG', '<p>\r\n	Slide2</p>\r\n', '2015-08-09 14:52:03'),
(7, 'Slide1', '1439109241-slide1.jpg', '<p>\r\n	Slide1</p>\r\n', '2015-08-09 15:34:01'),
(8, 'Slide3', '1441171313-slide3.JPG', '<p>\r\n	Slide3</p>\r\n', '2015-09-02 12:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `statis`
--

CREATE TABLE IF NOT EXISTS `statis` (
  `statis_id` int(5) NOT NULL AUTO_INCREMENT,
  `statis_judul` varchar(100) NOT NULL,
  `statis_deskripsi` text NOT NULL,
  `statis_gambar` varchar(100) NOT NULL,
  `statis_status` enum('N','Y') NOT NULL,
  `statis_waktu` datetime NOT NULL,
  PRIMARY KEY (`statis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(5) NOT NULL AUTO_INCREMENT,
  `tag_judul` varchar(50) NOT NULL,
  `tag_seo` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
  `testimonial_id` int(5) NOT NULL AUTO_INCREMENT,
  `testimonial_nama` varchar(100) NOT NULL,
  `testimonial_sumber` varchar(100) NOT NULL,
  `testimonial_kerja` varchar(200) NOT NULL,
  `testimonial_jabatan` varchar(200) NOT NULL,
  `testimonial_deskripsi` text NOT NULL,
  `testimonial_gambar` varchar(100) NOT NULL,
  `testimonial_waktu` datetime NOT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `testimonial_nama`, `testimonial_sumber`, `testimonial_kerja`, `testimonial_jabatan`, `testimonial_deskripsi`, `testimonial_gambar`, `testimonial_waktu`) VALUES
(3, 'Ali Abdul Wahid', 'Masih Kuliah', 'CV.Nava Teknologi', 'Programmer', 'Poltekpos Indonesia memiliki kampus nyaman untuk belajar, fasilitas lengkap dan dosen-dosen yg ahli di bidangnya. Terima kasih, selesai wisuda saya langsung mendapat pekerjaan.', '1440387703-11206097_907674959270914_6026589404761839948_n.jpg', '2015-08-24 10:41:43'),
(4, 'Mochammad Uki', 'Masih Kuliah', 'CV.Nava Teknologi', 'Web Design', 'Saya merasa senang bisa menjadi Mahasiswa Politeknik Pos Indonesia. Mendapat fasilitas pembelajaran yang baik. Tidak hanya Menerima Pengetahuan Secara Teori, bahkan menerima pengetahuan dari pengalaman-pengalaman para dosen. Sehingga kita siap menghadapi dunia kerja.\r\n', '1440388399-1001594_419773781456187_112239529_n.jpg', '2015-08-24 10:53:19'),
(5, 'Nava Gia Ginasta', 'Masih Kuliah', 'KOMINFO', 'Programmer Analyst & Project Leader', 'Politeknik Pos Indonesia memiliki kampus yang sangat memadai dibandingkan dengan politeknik yang lain. Proses belajar mengajar jadi lebih nyaman. Materi kuliahnya pun bagus khususnya untuk jurusan Teknik Informatika. Dari tahun ke tahun ada perubahan kurikulum yang mengikuti perkembangan IT. Dengan sistem seperti ini, mahasiswa tidak akan ketinggalan informasi tentang perkembangan IT, dan menyiapkan mahasiswanya untuk siap bersaing di dunia kerja.\r\n', '1440388490-NAVA_FOTO_500MB.jpg', '2015-08-24 10:54:50'),
(6, 'Septian Cahya Diningrat', 'Masih Kuliah', 'CV.Sumedang FC', 'Direktur', 'Program Studi Teknik Informatika Politeknik Pos Indonesia telah memberikan banyak pengetahuan kepada saya baik dalam teori maupun praktek. Lulusan Poltek Pos dituntut untuk mampu bersaing dalam dunia kerja sehingga tidak tetinggal dari lulusan sarjana universitas lain meskipun lulusan diploma. Dosen Poltekpos juga sangat berkualitas dan profesional baik dosen dari Poltek Pos sendiri Maupun Dosen Luar (Tamu) dari Kalangan praktisi atau Universitas lain. Selama menempuh pendidikan saya diberi kesempatan untuk langsung terjun ke dunia kerja, baik berupa proyek maupun kerja praktek. Selain itu saya juga mendapat banyak manfaat dari kerja sama pihak Poltek Pos dengan berbagai vendor ternama seperti Microsoft, Oracle, dan lain-lain, baik berupa pelatihan, seminar, kunjungan industri maupun yang lain. Suatu hal yang cukup penting dan sangat menguntungkan bagi saya yang tidak saya dapatkan dari tempat kuliah saya sebelum masuk ke Poltek Pos. [hide]', '1441027340-septian.jpg', '2015-08-31 20:22:20'),
(7, 'Anggi Sholihatus Sadiah', 'Masih Kuliah', 'Pemda Kab.Subang', 'Sekretaris Daerah', 'seneng banget dah bisa kuliah di politeknik pos indonesia jur tehnik informatika, banyak dapet ilmu2 yg bermanfaat di dunia kerja loch...\r\nTempat kuliahnya juga nyaman banget buat belajar...\r\nDosennya juga ga kalah okey ..\r\nGa lupa selalu Bikin kangen kuliah dsana lagi ney..\r\nDan tak terlupakan dah dpt banyak banget pengalaman selama kuliah di poltekpos pokoknya...\r\n', '1441027469-anggi.jpg', '2015-08-31 20:24:29'),
(8, 'Rizki Fadillah D''kenjie', 'Masih Kuliah', 'Riau Hutan, Tbk', 'Manager', 'Saya adalah salah satu alumni dari Politeknikpos Indonesia dari jurusan Teknik Informatika. Poltekpos adalah kampus yang dibangun sangat kondusif bagi mereka yang ingin pandai dan meraih sukses. Dan yang membuat saya merasa nyaman adalah fasilitas laboratorium yang sangat mendukung, tim pengajar yang professional dan berkualitas di bidangnya, lingkungan yang bersih, dan kekeluargaan yang tercipta antara dosen dan mahasiswanya. Ilmu yang saya dapatkan di Poltekpos mampu mengantar saya untuk siap bersaing serta memulai langkah sukses.', '1441027729-rizki.jpg', '2015-08-31 20:28:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_level_kode`) REFERENCES `admin_level` (`admin_level_kode`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
