-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2022 at 04:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domantay_mary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `likes` text NOT NULL,
  `following` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `type`, `content_id`, `likes`, `following`) VALUES
(1, 'post', 44967, '[{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:50:16\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:08:46\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:20\"}]', NULL),
(2, 'post', 7942292301, '[{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:50:18\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:08:44\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:18\"}]', NULL),
(3, 'post', 47966, '[{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:52:52\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:08:41\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:26:10\"}]', NULL),
(4, 'post', 5642249703, '[{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:56:50\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:08:30\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:09\"}]', NULL),
(5, 'user', 14708231, '{\"0\":{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:57:32\"},\"2\":{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:07\"},\"3\":{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:52\"},\"4\":{\"user_id\":\"85143583865180\",\"date\":\"2022-01-21 09:30:57\"},\"5\":{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 11:58:22\"},\"6\":{\"user_id\":\"2271380\",\"date\":\"2022-01-21 12:12:47\"}}', '[{\"user_id\":\"14708231\",\"date\":\"2022-01-21 08:57:32\"}]'),
(6, 'post', 1491377001856415, '[{\"user_id\":\"2271380\",\"date\":\"2022-01-21 08:59:10\"}]', NULL),
(7, 'post', 9445738101, '[{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:07:11\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:57\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:45\"}]', NULL),
(9, 'user', 2271380, '{\"1\":{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:55\"},\"3\":{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 11:59:00\"},\"4\":{\"user_id\":\"2271380\",\"date\":\"2022-01-21 12:11:35\"}}', '{\"1\":{\"user_id\":\"14708231\",\"date\":\"2022-01-21 09:11:34\"},\"2\":{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 12:08:47\"},\"3\":{\"user_id\":\"2271380\",\"date\":\"2022-01-21 12:11:35\"}}'),
(8, 'post', 230360945, '[{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:12:01\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:26:07\"}]', NULL),
(10, 'post', 15277144861646365, '[{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:12:15\"}]', NULL),
(11, 'user', 5825073062, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:12:58\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:24:59\"},{\"user_id\":\"85143583865180\",\"date\":\"2022-01-21 09:30:54\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 12:08:47\"}]', '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:12:58\"},{\"user_id\":\"14708231\",\"date\":\"2022-01-21 09:16:07\"},{\"user_id\":\"2271380\",\"date\":\"2022-01-21 09:16:55\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:27:32\"}]'),
(12, 'post', 8358014744, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:44\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:02\"}]', NULL),
(13, 'post', 4758898547236, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:45\"}]', NULL),
(14, 'post', 7147735562, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:48\"}]', NULL),
(15, 'post', 499820423, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:16:59\"}]', NULL),
(16, 'post', 82342484062771141, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:17:01\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:49\"}]', NULL),
(17, 'post', 739174070582913674, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:18:17\"},{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:00\"}]', NULL),
(18, 'post', 439548, '[]', NULL),
(19, 'post', 14614, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 12:03:15\"}]', NULL),
(20, 'user', 732686103522033157, '[{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:41\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:27:32\"},{\"user_id\":\"85143583865180\",\"date\":\"2022-01-21 09:31:03\"}]', '{\"1\":{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:24:59\"},\"2\":{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:41\"},\"3\":{\"user_id\":\"14708231\",\"date\":\"2022-01-21 09:25:52\"}}'),
(21, 'post', 4541735204656, '[{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:27:36\"}]', NULL),
(22, 'post', 6415160954020353719, '[{\"user_id\":\"732686103522033157\",\"date\":\"2022-01-21 09:25:39\"},{\"user_id\":\"5825073062\",\"date\":\"2022-01-21 09:27:45\"}]', NULL),
(23, 'post', 94919756803033, '[]', NULL),
(24, 'user', 81331571077, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 10:15:41\"}]', '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 10:15:41\"},{\"user_id\":\"14708231\",\"date\":\"2022-01-21 11:58:22\"}]'),
(27, 'post', 5931147, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 15:24:13\"}]', NULL),
(25, 'post', 403517466194255, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 12:01:33\"}]', NULL),
(26, 'post', 491371074174477, '[{\"user_id\":\"2271380\",\"date\":\"2022-01-21 12:08:37\"}]', NULL),
(28, 'post', 50057457709544, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 15:23:15\"}]', NULL),
(29, 'post', 9412656, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 15:23:18\"}]', NULL),
(30, 'post', 3392824, '[{\"user_id\":\"81331571077\",\"date\":\"2022-01-21 16:19:07\"}]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(19) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(19) DEFAULT NULL,
  `user_id` bigint(19) DEFAULT NULL,
  `post` text,
  `image` varchar(500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `has_image` tinyint(1) DEFAULT NULL,
  `is_profile_image` tinyint(1) NOT NULL,
  `is_cover_image` tinyint(1) NOT NULL,
  `likes` int(20) NOT NULL DEFAULT '0',
  `parent` bigint(20) NOT NULL,
  `comments` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`),
  KEY `has_image` (`has_image`),
  KEY `is_profile_image` (`is_profile_image`),
  KEY `is_cover_image` (`is_cover_image`),
  KEY `likess` (`likes`),
  KEY `parent` (`parent`),
  KEY `comments` (`comments`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_id`, `user_id`, `post`, `image`, `date`, `has_image`, `is_profile_image`, `is_cover_image`, `likes`, `parent`, `comments`) VALUES
(1, 44967, 14708231, '', 'uploads/14708231/0.jpg', '2022-01-21 08:48:33', 1, 1, 0, 3, 0, 0),
(2, 7942292301, 14708231, '', 'uploads/14708231/T.jpg', '2022-01-21 08:48:51', 1, 0, 1, 3, 0, 0),
(4, 47966, 14708231, ' Took a nice shot with my new camera today. Model: Christine Diaz \r\n\r\n#photoshoot', 'uploads/14708231/r.jpg', '2022-01-21 08:52:47', 1, 0, 0, 3, 0, 1),
(5, 230360945, 14708231, 'I\'l be shooting with some of my friends tomorrow. If you\'d wanna come, message me!', '', '2022-01-21 08:53:27', 0, 0, 0, 2, 0, 1),
(6, 5642249703, 14708231, ' Awesome stuff currently happening in the city! Can\'t wait to see the final result @jaysmith #shootingsislife ', 'uploads/14708231/N.jpg', '2022-01-21 08:56:46', 1, 0, 0, 3, 0, 2),
(12, 491371074174477, 2271380, ' New gaming PC! This has been my week long project and was really happy about the outcome! What do you guys think? #gamer #newpc', 'uploads/2271380/I.jpg', '2022-01-21 09:02:32', 1, 0, 0, 1, 0, 0),
(13, 82342484062771141, 2271380, '', 'uploads/2271380/8.jpg', '2022-01-21 09:03:37', 1, 1, 0, 2, 0, 0),
(14, 499820423, 2271380, ' Don\'t mind me doing my own business here!! #fun', 'uploads//Z.jpg', '2022-01-21 09:04:28', 1, 0, 0, 1, 0, 1),
(17, 15277144861646365, 2271380, ' Already finished! You can see this high quality pic on my Behance account! ', 'uploads/2271380/6.jpg', '2022-01-21 09:09:50', 1, 0, 0, 1, 5642249703, 2),
(18, 6654359671406584, 2271380, 'Will be there!', '', '2022-01-21 09:12:10', 0, 0, 0, 0, 230360945, 0),
(21, 7147735562, 5825073062, '', 'uploads/5825073062/g.jpg', '2022-01-21 09:13:23', 1, 0, 1, 1, 0, 0),
(22, 4758898547236, 5825073062, '', 'uploads/5825073062/R.jpg', '2022-01-21 09:13:37', 1, 1, 0, 1, 0, 1),
(23, 8358014744, 5825073062, '3 silhouttes, guess which one\'s mine? #camping #3creepyguys', 'uploads/5825073062/x.jpg', '2022-01-21 09:14:43', 1, 0, 0, 2, 0, 1),
(24, 72349420411475705, 5825073062, ' Nicee! What are you currently playing?', '', '2022-01-21 09:17:14', 0, 0, 0, 0, 499820423, 0),
(25, 739174070582913674, 5825073062, ' Ahh, such a beauty! ', 'uploads//l.jpg', '2022-01-21 09:18:04', 1, 0, 0, 2, 0, 0),
(26, 403517466194255, 5825073062, ' Miss you guys!', '', '2022-01-21 09:18:33', 0, 0, 0, 1, 5642249703, 0),
(27, 1318616866407, 5825073062, ' This is amazing!', '', '2022-01-21 09:18:43', 0, 0, 0, 0, 15277144861646365, 1),
(28, 10663, 5825073062, ' Pretty!', '', '2022-01-21 09:18:52', 0, 0, 0, 0, 47966, 0),
(29, 14614, 732686103522033157, '', 'uploads/732686103522033157/G.jpg', '2022-01-21 09:19:29', 1, 1, 0, 1, 0, 1),
(31, 439548, 732686103522033157, '', 'uploads/732686103522033157/6.jpg', '2022-01-21 09:21:20', 1, 0, 1, 0, 0, 0),
(32, 6415160954020353719, 732686103522033157, ' Playing with my new born! It was really tiring but worth it! #lovemybabies', 'uploads/732686103522033157/b.jpg', '2022-01-21 09:22:16', 1, 0, 0, 2, 0, 0),
(33, 4541735204656, 732686103522033157, ' Anyone here needs children\'s books?  I\'ve got used ones, but still look new!', '', '2022-01-21 09:24:40', 0, 0, 0, 1, 0, 0),
(34, 19473876, 732686103522033157, ' Where could this be? Seems like a great place to hang out!', '', '2022-01-21 09:25:19', 0, 0, 0, 0, 8358014744, 0),
(35, 6206092, 85143583865180, '', 'uploads/85143583865180/u.jpg', '2022-01-21 09:30:27', 1, 1, 0, 0, 0, 0),
(36, 8913644326670, 85143583865180, '', 'uploads/85143583865180/d.jpg', '2022-01-21 09:30:42', 1, 0, 1, 0, 0, 0),
(37, 94919756803033, 9005918482693517478, '', 'uploads/9005918482693517478/s.jpg', '2022-01-21 09:59:01', 1, 1, 0, 0, 0, 1),
(38, 246941521, 9005918482693517478, ' Awesome!', '', '2022-01-21 09:59:38', 0, 0, 0, 0, 94919756803033, 0),
(39, 9072440414652550, 9005918482693517478, '', 'uploads/9005918482693517478/M.jpg', '2022-01-21 10:00:03', 1, 0, 1, 0, 0, 0),
(41, 380409, 81331571077, '', 'uploads/81331571077/r.jpg', '2022-01-21 10:09:44', 1, 1, 0, 0, 0, 0),
(42, 9412656, 81331571077, '', 'uploads/81331571077/e.jpg', '2022-01-21 10:10:27', 1, 0, 1, 1, 0, 0),
(43, 50057457709544, 81331571077, '', 'uploads/81331571077/v.jpg', '2022-01-21 10:11:49', 1, 0, 1, 1, 0, 0),
(45, 5931147, 81331571077, ' Had fun shooting with my friends this morning! #friends #love', 'uploads/81331571077/F.jpg', '2022-01-21 10:13:54', 1, 0, 0, 1, 0, 1),
(46, 7457872287525935, 81331571077, ' Let\'s try to hang out soon and do some shooting!', 'uploads/81331571077/R.jpg', '2022-01-21 12:00:04', 1, 0, 0, 0, 15277144861646365, 0),
(47, 68726945266, 81331571077, ' I know right!\r\n', '', '2022-01-21 12:00:15', 0, 0, 0, 0, 1318616866407, 0),
(49, 1260903302125560, 81331571077, ' Adorable!', '', '2022-01-21 12:03:20', 0, 0, 0, 0, 14614, 0),
(50, 75988906348325518, 14708231, 'These kids are adorable!', 'uploads/14708231/n.jpg', '2022-01-21 12:07:20', 1, 0, 0, 0, 0, 0),
(52, 5664757, 2271380, ' Nice Pic!', '', '2022-01-21 12:11:12', 0, 0, 0, 0, 4758898547236, 0),
(53, 17190704654614, 2271380, '', 'uploads/2271380/W.jpg', '2022-01-21 12:11:49', 1, 1, 0, 0, 0, 0),
(54, 3392824, 81331571077, ' Amazing1', '', '2022-01-21 15:23:29', 0, 0, 0, 1, 5931147, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(19) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `gender` text,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `url_address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(1000) DEFAULT NULL,
  `cover_image` varchar(1000) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `about` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes` (`likes`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `f_name`, `l_name`, `gender`, `email`, `password`, `url_address`, `profile_image`, `cover_image`, `likes`, `about`) VALUES
(1, 5825073062, 'Ian', 'Domantay', 'Male', 'ian@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'ian.domantay', 'uploads/5825073062/R.jpg', 'uploads/5825073062/g.jpg', 4, 'I like to camp with friends. You can find me hiking outside or walking my dog down the street!'),
(2, 14708231, 'Lyn', 'Gonzales', 'Female', 'lyn@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'lyn.gonzales', 'uploads/14708231/0.jpg', 'uploads/14708231/T.jpg', 6, NULL),
(3, 2271380, 'Jay', 'Smith', 'Male', 'jay@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'jay.smith', 'uploads/2271380/W.jpg', 'uploads/2271380/y.jpg', 3, 'Well, as you can see from my profile and cover photos, I love to play computer games. Also a fond of photography in my free hours.'),
(4, 732686103522033157, 'Christine', 'Gonzales', 'Female', 'christine@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'christine.gonzales', 'uploads/732686103522033157/G.jpg', 'uploads/732686103522033157/6.jpg', 3, NULL),
(5, 85143583865180, 'Carla', 'Evans', 'Female', 'carla@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'carla.evans', 'uploads/85143583865180/u.jpg', 'uploads/85143583865180/d.jpg', 0, NULL),
(8, 81331571077, 'Mary', 'Domantay', 'Female', 'maryangelicadomantay@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mary.domantay', 'uploads/81331571077/r.jpg', 'uploads/81331571077/v.jpg', 1, 'I\'m currently a third year CC student at Bath Spa University Ras Al Khaimah.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
