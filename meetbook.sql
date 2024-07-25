-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 06:43 AM
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
-- Database: `meetbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(255) NOT NULL,
  `stateID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityID`, `cityName`, `stateID`) VALUES
(1, 'Shah Alam', 1),
(2, 'Kuala Lumpur', 2),
(4, 'Nusajaya', 3),
(5, 'Johor Bahru', 3),
(6, 'Kulai', 3),
(7, 'Senai', 3),
(9, 'Gugusan Taib Andak', 3),
(10, 'Pekan Nenas', 3),
(11, 'Sungai Mati', 3),
(12, 'Gelang Patah', 3),
(13, 'Pengerang', 3),
(14, 'Pasir Gudang', 3),
(15, 'Masai', 3),
(16, 'Ulu Tiram', 3),
(17, 'Layang-Layang', 3),
(18, 'Kota Tinggi', 3),
(19, 'Ayer Tawar 2', 3),
(20, 'Ayer Tawar 3', 3),
(21, 'Ayer Tawar 4', 3),
(22, 'Ayer Tawar 5', 3),
(23, 'Bandar Penawar', 3),
(24, 'Pontian', 3),
(25, 'Ayer Baloi', 3),
(26, 'Benut', 3),
(27, 'Kukup', 3),
(28, 'Batu Pahat', 3),
(29, 'Rengit', 3),
(30, 'Senggarang', 3),
(31, 'Seri Gading', 3),
(32, 'Sri Gading', 3),
(33, 'Seri Medan', 3),
(34, 'Sri Medan', 3),
(35, 'Parit Sulong', 3),
(36, 'Semerah', 3),
(37, 'Yong Peng', 3),
(38, 'Muar', 3),
(39, 'Parit Jawa', 3),
(40, 'Bukit Pasir', 3),
(41, 'Panchor', 3),
(42, 'Pagoh', 3),
(43, 'Gerisek', 3),
(44, 'Bukit Gambir', 3),
(45, 'Tangkak', 3),
(46, 'Segamat', 3),
(47, 'Batu Anam', 3),
(48, 'Jementah', 3),
(49, 'Labis', 3),
(50, 'Chaah', 3),
(51, 'Kluang', 3),
(52, 'Ayer Hitam', 3),
(53, 'Simpang Rengam', 3),
(54, 'Rengam', 3),
(55, 'Parit Raja', 3),
(56, 'Bekok', 3),
(57, 'Paloh', 3),
(58, 'Kahang', 3),
(59, 'Mersing', 3),
(60, 'Endau', 3),
(62, 'Alor Setar', 6),
(63, 'Alor Star', 6),
(64, 'Jitra', 6),
(65, 'Changloon', 6),
(66, 'Universiti Utara Malaysia', 6),
(67, 'Bukit Kayu Hitam', 6),
(68, 'Kodiang', 6),
(70, 'Kepala Batas', 6),
(71, 'Kuala Nerang', 6),
(72, 'Pokok Sena', 6),
(73, 'Pendang', 6),
(74, 'Langgar', 6),
(75, 'Kuala Kedah', 6),
(76, 'Simpang Empat', 6),
(77, 'Kota Sarang Semut', 6),
(78, 'Yan', 6),
(79, 'Langkawi', 6),
(80, 'Sungai Petani', 6),
(81, 'Bedong', 6),
(82, 'Sik', 6),
(83, 'Gurun', 6),
(84, 'Jeniang', 6),
(85, 'Merbok', 6),
(86, 'Kota Kuala Muda', 6),
(87, 'Kulim', 6),
(88, 'Baling', 6),
(89, 'Kuala Pegang', 6),
(90, 'Kupang', 6),
(91, 'Kuala Ketil', 6),
(92, 'Padang Serai', 6),
(93, 'Lunas', 6),
(95, 'Karangan', 6),
(96, 'Serdang', 6),
(97, 'Kota Bharu', 7),
(98, 'Bachok', 7),
(99, 'Wakaf Bharu', 7),
(100, 'Tumpat', 7),
(101, 'Kota Bahru', 7),
(102, 'Melor', 7),
(103, 'Ketereh', 7),
(104, 'Kem Desa Pahlawan', 7),
(105, 'Pulai Chondong', 7),
(106, 'Cherang Ruku', 7),
(107, 'Pasir Puteh', 7),
(108, 'Selising', 7),
(109, 'Pasir Mas', 7),
(110, 'Rantau Panjang', 7),
(111, 'Tanah Merah', 7),
(112, 'Jeli', 7),
(113, 'Kuala Balah', 7),
(114, 'Ayer Lanas', 7),
(115, 'Kuala Krai', 7),
(116, 'Dabong', 7),
(117, 'Gua Musang', 7),
(118, 'Temangan', 7),
(119, 'Machang', 7),
(120, 'Labuan', 18),
(121, 'Melaka', 8),
(122, 'Ayer Keroh', 8),
(123, 'Air Keroh', 8),
(124, 'Durian Tunggal', 8),
(125, 'Kem Trendak', 8),
(126, 'Sungai Udang', 8),
(127, 'Tanjong Kling', 8),
(128, 'Jasin', 8),
(129, 'Asahan', 8),
(130, 'Bemban', 8),
(131, 'Merlimau', 8),
(132, 'Sungai Rambai', 8),
(134, 'Selandar', 8),
(135, 'Alor Gajah', 8),
(136, 'Lubok China', 8),
(137, 'Kuala Sungai Baru', 8),
(138, 'Masjid Tanah', 8),
(139, 'Seremban', 9),
(140, 'Port Dickson', 9),
(141, 'Rantau', 9),
(142, 'Si Rusa', 9),
(143, 'Linggi', 9),
(144, 'Rembau', 9),
(145, 'Kota', 9),
(146, 'Tanjong Ipoh', 9),
(147, 'Kuala Klawang', 9),
(148, 'Mantin', 9),
(149, 'Bandar Baru Enstek', 9),
(150, 'Nilai', 9),
(151, 'Labu', 9),
(152, 'Kuala Pilah', 9),
(153, 'Bahau', 9),
(154, 'Bandar Seri Jempol', 9),
(155, 'Batu Kikir', 9),
(156, 'Simpang Pertang', 9),
(157, 'Simpang Durian', 9),
(158, 'Tampin', 9),
(159, 'Johol', 9),
(160, 'Gemencheh', 9),
(161, 'Gemas', 9),
(162, 'Pusat Bandar Palong', 9),
(163, 'Rompin', 9),
(164, 'Kuantan', 10),
(165, 'Bukit Goh', 10),
(166, 'Balok', 10),
(167, 'Sungai Lembing', 10),
(168, 'Jaya Gading', 10),
(169, 'Gambang', 10),
(170, 'Bandar Pusat Jengka', 10),
(171, 'Maran', 10),
(172, 'Pekan', 10),
(173, 'Chini', 10),
(174, 'Muadzam Shah', 10),
(175, 'Kuala Rompin', 10),
(176, 'Bandar Tun Abdul Razak', 10),
(177, 'Jerantut', 10),
(178, 'Damak', 10),
(179, 'Padang Tengku', 10),
(180, 'Kuala Lipis', 10),
(181, 'Benta', 10),
(182, 'Dong', 10),
(183, 'Raub', 10),
(184, 'Sungai Ruan', 10),
(185, 'Sungai Koyan', 10),
(186, 'Sega', 10),
(187, 'Temerloh', 10),
(188, 'Kuala Krau', 10),
(189, 'Chenor', 10),
(190, 'Triang', 10),
(191, 'Bandar Bera', 10),
(192, 'Kemayan', 10),
(193, 'Mentakab', 10),
(194, 'Lanchang', 10),
(195, 'Karak', 10),
(196, 'Bentong', 10),
(197, 'Lurah Bilut', 10),
(198, 'Tanah Rata', 10),
(199, 'Brinchang', 10),
(200, 'Ringlet', 10),
(201, 'Bukit Fraser', 10),
(202, 'Genting Highlands', 10),
(347, 'Pulau Pinang', 11),
(348, 'Balik Pulau', 11),
(349, 'Padang Tembak', 11),
(350, 'Batu Ferringhi', 11),
(351, 'Tanjong Bungah', 11),
(352, 'Tanjung Bungah', 11),
(353, 'Penang Hill', 11),
(354, 'Ayer Itam', 11),
(355, 'Jelutong', 11),
(356, 'Gelugor', 11),
(357, 'USM Pulau Pinang', 11),
(358, 'Bayan Lepas', 11),
(359, 'Batu Maung', 11),
(360, 'Butterworth', 11),
(361, 'Penaga', 11),
(363, 'Tasek Gelugor', 11),
(364, 'Tasek Gelugur', 11),
(365, 'Permatang Pauh', 11),
(366, 'Perai', 11),
(367, 'Bukit Mertajam', 11),
(368, 'Simpang Ampat', 11),
(369, 'Sungai Jawi', 11),
(370, 'Bandar Bahru', 11),
(371, 'Nibong Tebal', 11),
(372, 'Kubang Semang', 11),
(373, 'Ipoh', 12),
(374, 'Batu Gajah', 12),
(375, 'Sungai Siput', 12),
(376, 'Ulu Kinta', 12),
(377, 'Chemor', 12),
(378, 'Tanjong Rambutan', 12),
(379, 'Kampung Kepayang', 12),
(380, 'Pusing', 12),
(381, 'Gopeng', 12),
(382, 'Malim Nawar', 12),
(383, 'Tronoh', 12),
(384, 'Tanjong Tualang', 12),
(385, 'Jeram', 12),
(386, 'Kampar', 12),
(387, 'Mambang Di Awan', 12),
(388, 'Sitiawan', 12),
(389, 'Seri Manjong', 12),
(390, 'Seri Manjung', 12),
(391, 'TLDM Lumut', 12),
(392, 'Lumut', 12),
(393, 'Pangkor', 12),
(394, 'Ayer Tawar', 12),
(395, 'Changkat Keruing', 12),
(396, 'Bota', 12),
(397, 'Bandar Seri Iskandar', 12),
(398, 'Bruas', 12),
(399, 'Parit', 12),
(400, 'Lambor Kanan', 12),
(401, 'Kuala Kangsar', 12),
(402, 'Pengkalan Hulu', 12),
(403, 'Intan', 12),
(404, 'Gerik', 12),
(405, 'Lenggong', 12),
(406, 'Sauk', 12),
(407, 'Enggor', 12),
(408, 'Padang Rengas', 12),
(409, 'Manong', 12),
(410, 'Taiping', 12),
(411, 'Selama', 12),
(413, 'Parit Buntar', 12),
(414, 'Tanjong Piandang', 12),
(415, 'Bagan Serai', 12),
(416, 'Kuala Kurau', 12),
(417, 'Simpang Ampat Semanggol', 12),
(418, 'Batu Kurau', 12),
(419, 'Kamunting', 12),
(420, 'Kuala Sepetang', 12),
(421, 'Simpang', 12),
(422, 'Matang', 12),
(423, 'Trong', 12),
(424, 'Changkat Jering', 12),
(425, 'Pantai Remis', 12),
(426, 'Bandar Baharu', 12),
(427, 'Tapah', 12),
(428, 'Chenderiang', 12),
(429, 'Temoh', 12),
(430, 'Tapah Road', 12),
(431, 'Bidor', 12),
(432, 'Sungkai', 12),
(433, 'Trolak', 12),
(434, 'Slim River', 12),
(435, 'Tanjong Malim', 12),
(436, 'Behrang Stesen', 12),
(437, 'Teluk Intan', 12),
(438, 'Bagan Datoh', 12),
(439, 'Selekoh', 12),
(440, 'Sungai Sumun', 12),
(441, 'Hutan Melintang', 12),
(442, 'Ulu Bernam', 12),
(443, 'Chenderong Balai', 12),
(444, 'Langkap', 12),
(445, 'Chikus', 12),
(446, 'Kampung Gajah', 12),
(447, 'Kangar', 13),
(448, 'Kuala Perlis', 13),
(449, 'Padang Besar', 13),
(450, 'Kaki Bukit', 13),
(451, 'Arau', 13),
(453, 'Kota Kinabalu', 14),
(454, 'Beverly', 14),
(455, 'Putatan', 14),
(456, 'Likas', 14),
(457, 'Inanam', 14),
(458, 'Tanjung Aru', 14),
(459, 'Keningau', 14),
(460, 'Kudat', 14),
(461, 'Kota Marudu', 14),
(462, 'Kota Belud', 14),
(463, 'Tuaran', 14),
(464, 'Tamparuli', 14),
(465, 'Tenghilan', 14),
(466, 'Ranau', 14),
(467, 'Penampang', 14),
(468, 'Papar', 14),
(469, 'Tambunan', 14),
(470, 'Bongawan', 14),
(471, 'Membakut', 14),
(472, 'Kuala Penyu', 14),
(473, 'Menumbok', 14),
(474, 'Beaufort', 14),
(475, 'Sipitang', 14),
(476, 'Tenom', 14),
(477, 'Nabawan', 14),
(478, 'Sandakan', 14),
(479, 'Beluran', 14),
(480, 'Kota Kinabatangan', 14),
(481, 'Pamol', 14),
(482, 'Tawau', 14),
(483, 'Lahad Datu', 14),
(484, 'Kunak', 14),
(485, 'Semporna', 14),
(486, 'Kuching', 15),
(487, 'Bau', 15),
(488, 'Siburan', 15),
(489, 'Kota Samarahan', 15),
(490, 'Lundu', 15),
(491, 'Asajaya', 15),
(492, 'Kabong', 15),
(493, 'Serian', 15),
(494, 'Simunjan', 15),
(495, 'Sebuyau', 15),
(496, 'Lingga', 15),
(497, 'Pusa', 15),
(498, 'Sri Aman', 15),
(499, 'Roban', 15),
(500, 'Saratok', 15),
(501, 'Debak', 15),
(502, 'Spaoh', 15),
(503, 'Betong', 15),
(504, 'Engkilili', 15),
(505, 'Lubok Antu', 15),
(506, 'Sibu', 15),
(507, 'Sarikei', 15),
(508, 'Belawai', 15),
(509, 'Daro', 15),
(510, 'Matu', 15),
(511, 'Dalat', 15),
(512, 'Balingian', 15),
(513, 'Mukah', 15),
(514, 'Bintangor', 15),
(515, 'Julau', 15),
(516, 'Kanowit', 15),
(517, 'Kapit', 15),
(518, 'Song', 15),
(519, 'Belaga', 15),
(520, 'Bintulu', 15),
(521, 'Sebauh', 15),
(522, 'Tatau', 15),
(523, 'Miri', 15),
(524, 'Baram', 15),
(525, 'Lutong', 15),
(526, 'Bekenu', 15),
(527, 'Niah', 15),
(528, 'Long Lama', 15),
(529, 'Limbang', 15),
(530, 'Nanga Medamit', 15),
(531, 'Sundar', 15),
(532, 'Lawas', 15),
(533, 'Ampang', 1),
(534, 'Bandar Baru Bangi', 1),
(535, 'Bandar Puncak Alam', 1),
(536, 'Bangi', 1),
(537, 'Banting', 1),
(538, 'Batang Berjuntai', 1),
(539, 'Batang Kali', 1),
(540, 'Batu Arang', 1),
(541, 'Batu Caves', 1),
(542, 'Beranang', 1),
(543, 'Bukit Rotan', 1),
(544, 'Cheras', 1),
(545, 'Cyberjaya', 1),
(546, 'Dengkil', 1),
(547, 'Hulu Langat', 1),
(548, 'Jenjarom', 1),
(550, 'Kajang', 1),
(551, 'Kapar', 1),
(552, 'Kerling', 1),
(553, 'Klang', 1),
(554, 'KLIA', 1),
(555, 'Kuala Kubu Baru', 1),
(556, 'Kuala Selangor', 1),
(557, 'Pelabuhan Klang', 1),
(558, 'Petaling Jaya', 1),
(559, 'Puchong', 1),
(560, 'Pulau Carey', 1),
(561, 'Pulau Indah', 1),
(562, 'Pulau Ketam', 1),
(563, 'Rasa', 1),
(564, 'Rawang', 1),
(565, 'Sabak Bernam', 1),
(566, 'Sekinchan', 1),
(567, 'Semenyih', 1),
(568, 'Sepang', 1),
(570, 'Serendah', 1),
(571, 'Seri Kembangan', 1),
(572, 'Subang Jaya', 1),
(573, 'Sungai Ayer Tawar', 1),
(574, 'Sungai Besar', 1),
(575, 'Sungai Buloh', 1),
(576, 'Sungai Pelek', 1),
(577, 'Tanjong Karang', 1),
(578, 'Tanjong Sepat', 1),
(579, 'Telok Panglima Garang', 1),
(580, 'Ajil', 16),
(581, 'Al Muktatfi Billah Shah', 16),
(582, 'Ayer Puteh', 16),
(583, 'Bukit Besi', 16),
(584, 'Bukit Payong', 16),
(585, 'Ceneh', 16),
(586, 'Chalok', 16),
(587, 'Cukai', 16),
(588, 'Dungun', 16),
(589, 'Jerteh', 16),
(590, 'Kampung Raja', 16),
(591, 'Kemasek', 16),
(592, 'Kerteh', 16),
(593, 'Ketengah Jaya', 16),
(594, 'Kijal', 16),
(595, 'Kuala Berang', 16),
(596, 'Kuala Besut', 16),
(597, 'Kuala Terengganu', 16),
(598, 'Marang', 16),
(599, 'Paka', 16),
(600, 'Permaisuri', 16),
(601, 'Sungai Tong', 16),
(602, 'Putrajaya', 17);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryID` int(11) NOT NULL,
  `countryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryID`, `countryName`) VALUES
(1, 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `poscode` varchar(5) NOT NULL,
  `minCapacity` int(11) DEFAULT 1,
  `maxCapacity` int(11) DEFAULT 10,
  `roomAvailability` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1:available, 2:nonavailable',
  `cityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `address1`, `address2`, `poscode`, `minCapacity`, `maxCapacity`, `roomAvailability`, `cityID`) VALUES
(1, 'Bilik Chempaka', 'Unit 2-2-2, Level 2', 'Amcorp Tower', '16800', 10, 40, '1', 1),
(2, 'Bilik Anggerik', 'Unit 2-2-3, Level 2', 'Amcorp Tower', '16800', 0, 100, '1', 1),
(3, 'Bilik Dahlia', 'Unit 1-1-4, Level 1', 'Amcorp Mall', '16800', 1, 20, '1', 1),
(4, 'Bilik Bayu Murni', 'Unit 9-7, Level 9', 'Nexus Mall', '54000', 10, 40, '1', 2),
(5, 'Mutiara Meeting Hall', 'Unit 5-2-2, Level 2', 'Nexus City Mall', '54000', 10, 150, '1', 2),
(7, 'Grand Meeting Hall TM', 'Unit 1-1-4 , Level 1', 'KLCC', '15600', 1, 10, '1', 111);

-- --------------------------------------------------------

--
-- Table structure for table `roombooking`
--

CREATE TABLE `roombooking` (
  `bookingID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookingDate` date NOT NULL,
  `priority` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1: normal, 2:important, 3:urgent',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roombooking`
--

INSERT INTO `roombooking` (`bookingID`, `userID`, `roomID`, `startTime`, `endTime`, `bookingDate`, `priority`, `remark`) VALUES
(16, 41, 2, '08:00:00', '10:00:00', '2023-12-25', '1', ''),
(18, 41, 2, '08:00:00', '10:00:00', '2023-12-26', '1', ''),
(19, 41, 2, '08:00:00', '12:00:00', '2023-12-28', '1', ''),
(20, 41, 5, '11:00:00', '13:00:00', '2023-12-25', '1', 'Please include refreshements'),
(24, 41, 4, '08:00:00', '10:00:00', '2023-12-27', '1', ''),
(25, 41, 4, '13:00:00', '14:00:00', '2023-12-27', '1', ''),
(26, 41, 4, '14:00:00', '16:00:00', '2023-12-27', '1', ''),
(27, 41, 2, '08:00:00', '11:00:00', '2023-12-27', '1', ''),
(28, 32, 4, '19:00:00', '20:00:00', '2023-12-27', '1', NULL),
(33, 25, 5, '14:00:00', '16:00:00', '2023-12-27', '1', NULL),
(34, 25, 7, '16:00:00', '19:00:00', '2023-12-27', '1', NULL),
(35, 46, 3, '19:00:00', '20:00:00', '2023-12-27', '1', NULL),
(36, 34, 1, '16:00:00', '18:00:00', '2023-12-27', '1', NULL),
(41, 41, 1, '10:00:00', '13:00:00', '2024-01-05', '1', ''),
(42, 41, 1, '11:00:00', '15:00:00', '2024-01-19', '1', ''),
(44, 41, 1, '08:00:00', '09:00:00', '2024-01-13', '1', ''),
(45, 41, 5, '18:00:00', '19:00:00', '2024-01-19', '2', 'muH NUg'),
(46, 50, 1, '12:00:00', '16:00:00', '2024-01-02', '1', 'add speaker'),
(52, 58, 1, '08:00:00', '09:00:00', '2024-01-11', '1', ''),
(53, 41, 5, '12:00:00', '19:00:00', '2024-04-18', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `sitesetting`
--

CREATE TABLE `sitesetting` (
  `id` int(11) NOT NULL,
  `signupStatus` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1:enable 2:disable',
  `bookingStatus` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1:enable 2:disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitesetting`
--

INSERT INTO `sitesetting` (`id`, `signupStatus`, `bookingStatus`) VALUES
(1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateID` int(11) NOT NULL,
  `stateName` varchar(255) NOT NULL,
  `countryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateID`, `stateName`, `countryID`) VALUES
(1, 'Selangor', 1),
(2, 'WP Kuala Lumpur', 1),
(3, 'Johor', 1),
(6, 'Kedah', 1),
(7, 'Kelantan', 1),
(8, 'Malacca', 1),
(9, 'Negeri Sembilan', 1),
(10, 'Pahang', 1),
(11, 'Penang', 1),
(12, 'Perak', 1),
(13, 'Perlis', 1),
(14, 'Sabah', 1),
(15, 'Sarawak', 1),
(16, 'Terengganu', 1),
(17, 'WP Putrajaya', 1),
(18, 'WP Labuan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userStatus` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1:active 2: deactive 3:suspend',
  `registrationDate` date NOT NULL DEFAULT current_timestamp(),
  `role` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1: normal 2:superadmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `email`, `password`, `userStatus`, `registrationDate`, `role`) VALUES
(25, 'winwin', 'ww@gmail.com', '$2y$10$ev6aAnZjuovlf7A/C58y3ub1R6X9LwkleKEAbMrBlvroAij0ijKuG', '1', '2023-12-20', '1'),
(30, 'Kim Asa', 'asa@gmail.com', '$2y$10$1oCm.bJK4K3cnbbaHVMeX.K.ehbXcgYjkWM1jekyup.G0soSxRRiG', '1', '2023-12-20', '2'),
(31, 'tuti', 'tuti@gmail.com', '$2y$10$6S5wYrL77oloUD//8LjwXeih9oORd.vguKEbJrds1UGDcca7BJCM.', '1', '2023-12-20', '1'),
(32, 'Aden ', 'aden@gmail.com', '$2y$10$3SrtKir2T8BBptY0Hx/Mge30PMTx3eVj/rkMbXCKiZTd0SSUhmZb.', '3', '2023-12-20', '1'),
(33, 'Kang Tae Min', 'taemin@gmail.com', '$2y$10$jiAPA1/ffnpOVDbmvVaUleteuc2asNJGMDqf97ajOoulnjTKa6F0O', '1', '2023-12-20', '1'),
(34, 'Hanni Phamm', 'honey@gmail.com', '$2y$10$nxEIsgsAgxz9e3yW3oNfoO8Oo8Nen4rsT7FyRbgKv214UYQ4i8pty', '3', '2023-12-20', '1'),
(41, 'Siti Nur ', 'admin@meetbook.com', '$2y$10$xLtlnrnN3EbQJ1DurAgZ8.z2I/zwScc5ZVjjbSFTtasCAvDsxxRE6', '1', '2023-12-22', '2'),
(42, 'Nurul Adni ', 'mahai@mara.gov.my', '$2y$10$Wob4rHXDuKUl5DEMWhUaLOZper8YrE9E10AT17gLN41ntwE1T1fDO', '1', '2023-12-22', '1'),
(46, 'Lucas Wong YuKhei', 'lucas@gmail.com', '$2y$10$u3ipiFLmApv/hWkoOB2IAO8rCwqNrDjDNb4lVDaeMb8dLXv58nnH2', '1', '2023-12-28', '1'),
(50, 'Jaehyun', 'jay@gmail.com', '$2y$10$M9uTDoE1J.X4qlige4TsCOpIxyySKDu24zr77enoUaGjhSmFqanvG', '1', '2023-12-31', '1'),
(51, 'HAECHAN CHEAH', 'haechan@gmail.com', '$2y$10$IwaazG48tDG73s.lzNFaDeTnk1GTBf6gMu1kNYC1iKWGQlor1A8FC', '1', '2024-01-02', '1'),
(55, 'Batrisya ', 'rom@gmail.com', '$2y$10$csO7CpCYCYvTa8k3hBy.leHSwU7PYRcSbsWRz7bCNj4N0XyGC6D/O', '1', '2024-01-04', '1'),
(56, 'AHMAD ', 'aslhdn@gmail.com', '$2y$10$VhpiREnVFxSE6ciLpmQZue5bLqdhmrrMCTXLiVXgP2CMWK3/XwOrG', '1', '2024-01-04', '1'),
(57, 'FARIS KAMARDDIN', 'work@gmail.com', '$2y$10$bZ3ONIz0KG9W1TPXE0bADeWi3eAj7vlgTpM/t3HxYVN9d616vobo.', '1', '2024-01-04', '1'),
(58, 'Nurul ', '703@gmail.com', '$2y$10$mbD3adezi9a5hMmBBQAV9eDXwqKlg0wpnqlHjrlZ78No.8N7pEn0K', '1', '2024-01-10', '1'),
(59, 'mvctest', 'mvc@mail.com', '123', '1', '2024-07-02', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityID`),
  ADD UNIQUE KEY `cityName` (`cityName`),
  ADD KEY `stateID` (`stateID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryID`),
  ADD UNIQUE KEY `countryName` (`countryName`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`),
  ADD UNIQUE KEY `roomName` (`roomName`),
  ADD KEY `cityID` (`cityID`);

--
-- Indexes for table `roombooking`
--
ALTER TABLE `roombooking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `sitesetting`
--
ALTER TABLE `sitesetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateID`),
  ADD UNIQUE KEY `stateName` (`stateName`),
  ADD KEY `countryID` (`countryID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=603;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roombooking`
--
ALTER TABLE `roombooking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sitesetting`
--
ALTER TABLE `sitesetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`stateID`) REFERENCES `state` (`stateID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roombooking`
--
ALTER TABLE `roombooking`
  ADD CONSTRAINT `roombooking_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roombooking_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `country` (`countryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
