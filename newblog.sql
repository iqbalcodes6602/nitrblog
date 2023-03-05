-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 08:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fname`, `password`, `email`, `profile_pic`, `date`) VALUES
(1, 'Admin', 'first admin update', 'admin update', 'admin.updated@example.org', 'assets/profile_img/1677666904_clipart1843822.png', '2023-03-01 10:35:04'),
(2, 'Admin2', '', 'admin', 'admin2@example.org', 'assets/profile_img/default_img.png', '2023-03-01 12:46:44'),
(3, 'newadmin', 'new admin name', '123', 'admin3@example.org', 'assets/profile_img/default_img.png', '2023-03-01 12:46:38'),
(5, 'anas', 'anas iqbal', '12345', 'adnan@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 01:15:38'),
(6, 'csn', 'cdscnsdcn', 'thegamers', 'scdsd@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 07:22:55'),
(7, 'safdaraliniazi', 'Safdar Ali NIazi', 'Safdar@1234', '787alisniazi787@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 15:37:52'),
(8, 'pranjalmayank', 'Pranjal Mayank ', 'Hrithik*123', 'pranjalmayank555@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 15:46:39'),
(9, 'rkmlegacy', 'Rohan Kumar Muduli', 'dell1234', 'rohan2muduli@gmail.com', 'assets/profile_img/1677686187_pngaaa.com-168031.png', '2023-03-01 15:56:27'),
(10, 'Srisanth', 'Srisanth Seth ', 'Qwer1234', 'srisanthseth28@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 15:53:41'),
(11, 'Dipan Kumar', 'Dipan Kumar', '123456', 'dipanmallick7085@gmail.com', 'assets/profile_img/default_img.png', '2023-03-01 15:56:26'),
(12, 'Sumedh Gajghate', 'Sumedh Gajghate', 'Sumedh123', 'sumedhgajghate3@gmail.com', 'assets/profile_img/default_img.png', '2023-03-03 09:58:28'),
(13, 'Shivashis', 'Shivashis Kar', '123', 'karshivashis@gmail.com', 'assets/profile_img/default_img.png', '2023-03-03 10:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `slug`, `posted_by`, `date`) VALUES
(1, 'Cristiano Ronaldo Returns to Manchester United', '<img class=\"w3-image\" src=\"https://assets.manutd.com/AssetPicker/images/0/0/15/128/1016013/CR_Home_21630596121972_large.jpg\" alt=\"\"><p>\n\nManchester United is delighted to confirm the signing of Cristiano Ronaldo on a two-year contract with the option to extend for a further year, subject to international clearance.\n\n\nCristiano, a five-time Ballon D’or winner, has so far won over 30 major trophies during his career, including five UEFA Champions League titles, four FIFA Club World Cups, seven league titles in England, Spain and Italy, and the UEFA European Championship for his native Portugal. Cristiano is the first player to have won league titles in England, Spain and Italy. He was also the highest goalscorer in last season’s Serie A and won the golden boot at this year’s European Championship. In his first spell for Manchester United, he scored 118 goals in 292 games.</p><p>Cristiano Ronaldo said:\n\n“Manchester United is a club that has always had a special place in my heart, and I have been overwhelmed by all the messages I have received since the announcement on Friday. I cannot wait to play at Old Trafford in front of a full stadium and see all the fans again. I\'m looking forward to joining up with the team after the international games, and I hope we have a very successful season ahead.”</p><p>Ole Gunnar Solskjaer said:\n\n“You run out of words to describe Cristiano. He is not only a marvellous player, but also a great human being. To have the desire and the ability to play at the top level for such a long period requires a very special person. I have no doubt that he will continue to impress us all and his experience will be so vital for the younger players in the squad. Ronaldo’s return demonstrates the unique appeal of this club and I am absolutely delighted he is coming home to where it all started.” </p>  ', 'cristiano-ronaldo-returns-to-manchester-united', 'Admin', '2023-03-01 10:59:00'),
(2, 'Leo Messi signs for Paris Saint-Germain', '<p style=\"text-align: center; \"><img src=\"https://images.psg.media/media/209006/leo-cp.jpg?anchor=center&amp;mode=crop&amp;width=800&amp;height=500&amp;quality=80\" alt=\"\"><br></p><p><strong>Paris Saint-Germain is delighted to announce the signing of Leo Messi on a two-year contract with an option of a third year.\r\n\r\nThe six-time Ballon d’Or winner is justifiably considered a legend of the game and a true inspiration for those of all ages inside and outside football.</strong></p><p>The signing of Leo reinforces Paris Saint-Germain’s aspirations as well as providing the club’s loyal fans with not only an exceptionally talented squad, but also moments of incredible football in the coming years.</p><p>Leo Messi said: “I am excited to begin a new chapter of my career at Paris Saint-Germain. Everything about the club matches my football ambitions. I know how talented the squad and the coaching staff are here. I am determined to help build something special for the club and the fans, and I am looking forward to stepping out onto the pitch at the Parc des Princes.”</p><p>Nasser Al-Khelaifi, Chairman and CEO of Paris Saint-Germain said: “I am delighted that Lionel Messi has chosen to join Paris Saint-Germain and we are proud to welcome him and his family to Paris. He has made no secret of his desire to continue competing at the very highest level and winning trophies, and naturally our ambition as a club is to do the same. The addition of Leo to our world class squad continues a very strategic and successful transfer window for the club. Led by our outstanding coach and his staff, I look forward to the team making history together for our fans all around the world.” </p>  ', 'leo-messi-signs-for-paris-saint-germain', 'Admin', '2022-02-11 15:50:41'),
(11, 'sdfsdf', 'sdfsdf', 'sdfsdf', 'newadmin', '2023-03-01 10:22:00'),
(6, 'first post from newadmin', 'this is a new blog from new admin ie the third admin', 'first-post-from-newadmin', 'newadmin', '2023-03-01 01:03:00'),
(9, 'blog from anas iqbal', 'this is anew blog from anas iqbal fro testing', 'blog-from-anas-iqbal', 'anas', '2023-03-01 01:46:00'),
(10, 'messi nation', 'messi won world cup with argentina', 'messi-nation', 'admin', '2023-03-01 06:07:00'),
(12, 'ANAS BHAI OP', 'bhai mast hai ye', 'anas-bhai-op', 'safdaraliniazi', '2023-03-01 15:38:00'),
(13, 'Hello', 'Hasbulla', 'hello', 'pranjalmayank', '2023-03-01 15:47:00'),
(14, 'My experience', 'east or west anas bhai best', 'my-experience', 'rkmlegacy', '2023-03-01 15:54:00'),
(15, 'Hiiiii', 'Good to land up in our college blog post', 'hiiiii', 'Dipan Kumar', '2023-03-01 15:57:00'),
(16, 'jasf;lls;flkj', '<img src=\"https://images.saymedia-content.com/.image/t_share/MTc1MTEyNDg1OTM3MjI3NTg4/different-forms-of-ichigo.jpg\" alt=\"\">dfafafa', 'jasfllsflkj', 'rkmlegacy', '2023-03-01 15:59:00'),
(17, 'Today is very hot', 'I want to sleep (alone).', 'today-is-very-hot', 'Sumedh Gajghate', '2023-03-03 10:08:37'),
(18, 'Mohit lal', 'Please sir mask lagalo', 'mohit-lal', 'safdaraliniazi', '2023-03-03 10:14:00'),
(19, 'Maii nhii bataunga', 'ds xttc dc txtchtxdccriufzedhohedhdcuv', 'maii-nhii-bataunga', 'Shivashis', '2023-03-03 10:33:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
