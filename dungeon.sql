-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2025 at 07:00 PM
-- Server version: 8.0.41
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moore`
--

-- --------------------------------------------------------

--
-- Table structure for table `encounters`
--

CREATE TABLE `encounters` (
  `id` int NOT NULL,
  `image` varchar(50) NOT NULL,
  `img_width` int NOT NULL,
  `img_top` int NOT NULL,
  `img_left` int NOT NULL,
  `dialog` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `encounters`
--

INSERT INTO `encounters` (`id`, `image`, `img_width`, `img_top`, `img_left`, `dialog`) VALUES
(0, 'tux.png', 300, 130, 90, 'Tux : Wark Wark! A dragon has stolen my herring! Can you retrieve it for me?'),
(1, 'chest.png', 200, 200, 150, 'You found Tux\'s treasure! But, being a programmer, you don\'t have the constitution to lift it back to him!'),
(2, 'windows.png', 500, -15, 50, 'A terrifying dragon blocks your path! At least, it would, but it\'s so slow you can easily just walk around it.  The dragon trys to turn to catch you, but crashes.  As you open the door to the next room, the dragon shift it\'s considerable, resource intensive bulk, farts loudly, and goes back to sleep.'),
(3, 'konqi.png', 225, 55, 250, 'Hi! I\'m Konqi! Mascot of the <a href=\"https://kde.org/\">KDE project</a>! What? Steal Tux\'s herring? Why would I do that? Tux and I are bosom chums! Plus, I survive exclusively on the hard work, love, and generous donations of the KDE community!'),
(4, 'signpost.png', 400, 180, 250, 'This sign seems somehow familiar... '),
(5, 'owl.png', 200, 140, 100, 'Oh.  Great.  An adventurer made it through my enchantment.  Did you ever consider that maybe that enchantment was there because I want to be LEFT ALONE?! BACK TO THE START WITH YOU!'),
(6, 'sd2.gif', 700, 1, -75, '<iframe width=\"300\" height=\"168\" src=\"https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1\" title=\"Rick Astley - Never Gonna Give You Up (Official Video) (4K Remaster)\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" autoplay=1 ></iframe> '),
(7, 'knitting.png', 125, 250, 200, '*busy insect noises*'),
(8, 'golem.png', 550, -60, 20, 'Hey!  I may be a rock monster, but I\'m really a gneiss guy! <br> My favourite music? Rock and Roll of course! <br> I gave away my soil collection... but it had sedimental value... <br> I know these jokes are bad but we all have our faults! <br> Which rock is the most sour? Limestone! <br> That joke made me lose my apatite... <br> Ore maybe I\'m telling these jokes in vein... <br> That joke wasn\'t even mine! <br> Some people use pumice to exfoliate, but I prefer soapstone. <br> Coprolites are not my favorite rocks but they are a solid number two. <br> That\'s it for me folks! And remember! Geology\'s just Physics slowed with trees on top! <br> Thank you and good night! ');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `level` int NOT NULL,
  `room_id` int NOT NULL,
  `north` int DEFAULT NULL,
  `east` int DEFAULT NULL,
  `south` int DEFAULT NULL,
  `west` int DEFAULT NULL,
  `encounter_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`level`, `room_id`, `north`, `east`, `south`, `west`, `encounter_id`) VALUES
(0, 0, NULL, NULL, 22, NULL, 5),
(0, 1, NULL, 2, 6, NULL, NULL),
(0, 2, NULL, NULL, 7, 1, NULL),
(0, 3, NULL, 4, 8, NULL, 2),
(0, 4, NULL, NULL, NULL, 3, 1),
(0, 5, 10, NULL, 0, NULL, 4),
(0, 6, 1, NULL, 11, NULL, NULL),
(0, 7, 2, 8, NULL, NULL, NULL),
(0, 8, 3, NULL, NULL, 7, NULL),
(0, 9, NULL, NULL, 14, NULL, 8),
(0, 10, 5, NULL, 5, NULL, NULL),
(0, 11, 6, NULL, 16, NULL, NULL),
(0, 12, NULL, NULL, 17, NULL, 3),
(0, 13, NULL, 22, NULL, NULL, 6),
(0, 14, 9, NULL, 19, 13, NULL),
(0, 15, 10, NULL, 20, NULL, NULL),
(0, 16, 11, NULL, 21, NULL, NULL),
(0, 17, 12, 18, 22, NULL, NULL),
(0, 18, NULL, NULL, NULL, 17, 7),
(0, 19, 14, NULL, 24, NULL, NULL),
(0, 20, 15, 21, NULL, NULL, NULL),
(0, 21, 16, 22, NULL, 20, NULL),
(0, 22, 17, 23, NULL, 21, 0),
(0, 23, NULL, 24, NULL, 22, NULL),
(0, 24, 19, NULL, NULL, 23, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
