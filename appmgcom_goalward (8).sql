-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 07:00 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appmgcom_goalward`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `cam_id` varchar(36) NOT NULL,
  `cam_name` varchar(255) NOT NULL,
  `cam_descriptions` text NOT NULL,
  `cam_budget` int(10) DEFAULT 0,
  `cam_start` datetime NOT NULL DEFAULT current_timestamp(),
  `cam_end` datetime NOT NULL,
  `cam_status` varchar(1) NOT NULL DEFAULT '0',
  `cam_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `cam_delete` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`cam_id`, `cam_name`, `cam_descriptions`, `cam_budget`, `cam_start`, `cam_end`, `cam_status`, `cam_datetime`, `cam_delete`) VALUES
('170a04c7-77d7-47c7-a327-c200a13f651a', '[API 1] New Member', '<p>[API 1] New Member</p>', 0, '2020-08-01 11:07:00', '2020-10-31 11:07:00', '1', '2020-09-01 11:08:00', '0'),
('67d9e8ca-81ab-4c52-acc0-419636ed7c7e', '[API 2] AFF', '<p>[API 2] AFF</p>', 0, '2020-08-01 11:08:00', '2020-10-31 11:08:00', '1', '2020-09-01 11:08:00', '0'),
('a0214994-c00c-4d09-8d6e-0ada8dc3aa44', 'สุ่มกล่อง สมาชิกใหม่', '<p>กรุณาแคปหลักฐานการรับรางวัลแล้วส่งหลักฐาน <a href=\"https://lin.ee/2MQQ6gJwf\"><strong>ที่นี่</strong></a>&nbsp;</p>', 50000, '2020-08-10 12:00:00', '2020-10-30 12:00:00', '1', '2020-07-29 13:05:00', '1'),
('b1921753-cb8f-4878-a3cf-25d15be3274f', '[API 3] Topup', '<p>[API 3] Topup</p>', 0, '2020-08-01 11:08:00', '2020-10-31 11:08:00', '1', '2020-09-01 11:09:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `de_campaigns`
--

CREATE TABLE `de_campaigns` (
  `cam_id` varchar(36) NOT NULL,
  `dec_id` int(10) NOT NULL,
  `dec_name` text NOT NULL,
  `dec_values` text NOT NULL,
  `dec_percent` float NOT NULL,
  `dec_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `de_campaigns`
--

INSERT INTO `de_campaigns` (`cam_id`, `dec_id`, `dec_name`, `dec_values`, `dec_percent`, `dec_datetime`) VALUES
('a0214994-c00c-4d09-8d6e-0ada8dc3aa44', 14, 'ของรางวัลที่ 1', '100', 0.000001, '2020-08-13 11:28:00'),
('b1921753-cb8f-4878-a3cf-25d15be3274f', 15, 'Topup 1', '100', 10, '2020-09-01 11:13:00'),
('67d9e8ca-81ab-4c52-acc0-419636ed7c7e', 16, 'AFF 1', '200', 30, '2020-09-01 11:15:00'),
('170a04c7-77d7-47c7-a327-c200a13f651a', 17, 'New Member 1', '80', 50, '2020-09-01 11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` varchar(36) NOT NULL,
  `log_tb` text NOT NULL,
  `log_where` text NOT NULL,
  `log_value` text NOT NULL,
  `log_who` varchar(36) NOT NULL,
  `log_descriptions` text DEFAULT NULL,
  `log_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` bigint(20) NOT NULL,
  `login_code` varchar(1) NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `staff_id` varchar(36) NOT NULL,
  `login_server_addr` varchar(255) DEFAULT NULL,
  `login_remote_addr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_plays`
--

CREATE TABLE `log_plays` (
  `log_id` varchar(36) NOT NULL,
  `staff_id` varchar(36) NOT NULL,
  `play_id` varchar(36) NOT NULL,
  `log_where` text DEFAULT NULL,
  `log_value` text DEFAULT NULL,
  `log_descriptions` text DEFAULT NULL,
  `log_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plays`
--

CREATE TABLE `plays` (
  `play_id` varchar(36) NOT NULL,
  `cam_id` varchar(36) NOT NULL,
  `play_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `player` varchar(36) NOT NULL,
  `box_choose` varchar(1) NOT NULL DEFAULT '0',
  `dec_id` int(10) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `descriptions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `recent_play`
-- (See below for the actual view)
--
CREATE TABLE `recent_play` (
`play_id` varchar(36)
,`cam_id` varchar(36)
,`player` varchar(36)
,`dec_id` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `recent_play_reward`
-- (See below for the actual view)
--
CREATE TABLE `recent_play_reward` (
`dec_values` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `recent_play_tel`
-- (See below for the actual view)
--
CREATE TABLE `recent_play_tel` (
`user_tel` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `min_percent` int(11) NOT NULL DEFAULT 0,
  `max_percent` int(11) NOT NULL DEFAULT 100,
  `decimals_percent` int(11) NOT NULL DEFAULT 5,
  `allow_event` varchar(1) NOT NULL DEFAULT '1',
  `game_status` varchar(1) NOT NULL DEFAULT '1',
  `event_aff` int(11) NOT NULL DEFAULT 5,
  `event_topup` int(11) NOT NULL DEFAULT 300,
  `event_key` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`datetime`, `min_percent`, `max_percent`, `decimals_percent`, `allow_event`, `game_status`, `event_aff`, `event_topup`, `event_key`) VALUES
('2020-08-08 13:46:11', 0, 100, 10, '1', '1', 5, 100, 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(36) NOT NULL,
  `staff_name` tinytext NOT NULL,
  `staff_username` text NOT NULL,
  `staff_password` varchar(60) NOT NULL,
  `staff_permission` varchar(1) NOT NULL DEFAULT '1',
  `staff_status` varchar(1) NOT NULL DEFAULT '1',
  `staff_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_username`, `staff_password`, `staff_permission`, `staff_status`, `staff_datetime`) VALUES
('521de147-d2c8-47a7-ad8c-af0a3aefa089', 'admin', 'admin', '$2y$10$VW6OAw87MLtlln/xBzHjtOxht/LlVjWysaZfeVRqN0A3zKZ4dMBMS', '0', '1', '2020-07-31 13:26:00'),
('597093f3-8f78-4f34-bee0-4a77de7ec3ec', 'head1', 'head1', '$2y$10$0FO88TRKfShGGyhntPa7XelbVB5qrGG3fVlhOipb9vGsIZhbKpJXq', '1', '1', '2020-08-09 17:29:00'),
('70746889-b3c0-486e-b66c-5e214b4a5400', 'head2', 'head2', '$2y$10$lhVx4UgN1lJBDcaOjZS6.uO/SL5OlMzOZj2v2Ef29NLTMrWRw8HJm', '1', '1', '2020-08-09 17:29:48'),
('ce67d1f4-7608-440a-9af4-39a877657089', 'staff', 'staff', '$2y$10$pzNqp5U7CLWow3sMd4/ZCe0K88.xOdh4mUNNriawVo.dmS2fuV4sC', '1', '1', '2020-08-09 17:26:11'),
('e7cfeb69-062c-4a14-862a-4cfb634a1ae2', 'head3', 'head3', '$2y$10$6c3CYRxpdA3mDMuNqo78/OhfeGuaZm9997MLaqH7F2NnMFL8xVSCS', '1', '1', '2020-08-09 17:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(36) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_member` text NOT NULL,
  `user_status` varchar(1) NOT NULL DEFAULT '1',
  `user_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_tel`, `user_member`, `user_status`, `user_datetime`) VALUES
('0cc3c2fe-3dd4-4eaf-90b7-62d09b3356dd', '0830246477', 'GOAL159569', '1', '2020-09-05 15:41:21'),
('6c246399-80dd-4633-9511-ecb5971fa574', '0868196207', 'GOAL168172', '1', '2020-09-03 13:27:21');

-- --------------------------------------------------------

--
-- Structure for view `recent_play`
--
DROP TABLE IF EXISTS `recent_play`;

CREATE ALGORITHM=UNDEFINED DEFINER=`appmgcom_goalward`@`localhost` SQL SECURITY DEFINER VIEW `recent_play`  AS  select `plays`.`play_id` AS `play_id`,`plays`.`cam_id` AS `cam_id`,`plays`.`player` AS `player`,`plays`.`dec_id` AS `dec_id` from `plays` order by `plays`.`play_datetime` desc limit 0,1 ;

-- --------------------------------------------------------

--
-- Structure for view `recent_play_reward`
--
DROP TABLE IF EXISTS `recent_play_reward`;

CREATE ALGORITHM=UNDEFINED DEFINER=`appmgcom_goalward`@`localhost` SQL SECURITY DEFINER VIEW `recent_play_reward`  AS  select `de_campaigns`.`dec_values` AS `dec_values` from `de_campaigns` where `de_campaigns`.`cam_id` = (select `recent_play`.`cam_id` from `recent_play`) and `de_campaigns`.`dec_id` = (select `recent_play`.`dec_id` from `recent_play`) ;

-- --------------------------------------------------------

--
-- Structure for view `recent_play_tel`
--
DROP TABLE IF EXISTS `recent_play_tel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`appmgcom_goalward`@`localhost` SQL SECURITY DEFINER VIEW `recent_play_tel`  AS  select `users`.`user_tel` AS `user_tel` from `users` where `users`.`user_id` = (select `recent_play`.`player` from `recent_play`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`cam_id`),
  ADD KEY `getAll` (`cam_id`,`cam_name`,`cam_descriptions`(200),`cam_budget`,`cam_start`,`cam_end`,`cam_status`,`cam_datetime`) USING BTREE,
  ADD KEY `getDashboard` (`cam_id`,`cam_name`,`cam_descriptions`(200),`cam_budget`,`cam_start`,`cam_end`,`cam_status`) USING BTREE;

--
-- Indexes for table `de_campaigns`
--
ALTER TABLE `de_campaigns`
  ADD PRIMARY KEY (`dec_id`,`cam_id`),
  ADD KEY `cam_id` (`cam_id`),
  ADD KEY `dec_id` (`dec_id`),
  ADD KEY `getDashboard` (`cam_id`,`dec_id`,`dec_name`(200),`dec_values`(200),`dec_percent`) USING BTREE;

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `login_ibfk_1` (`staff_id`);

--
-- Indexes for table `log_plays`
--
ALTER TABLE `log_plays`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `plays`
--
ALTER TABLE `plays`
  ADD PRIMARY KEY (`play_id`,`cam_id`),
  ADD KEY `play_id` (`play_id`,`cam_id`,`play_datetime`,`player`,`box_choose`,`dec_id`,`status`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`datetime`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `staff_id` (`staff_id`,`staff_name`(255),`staff_username`(200),`staff_password`,`staff_permission`,`staff_status`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`,`user_tel`,`user_member`(50)) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `de_campaigns`
--
ALTER TABLE `de_campaigns`
  MODIFY `dec_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `de_campaigns`
--
ALTER TABLE `de_campaigns`
  ADD CONSTRAINT `de_campaigns_ibfk_1` FOREIGN KEY (`cam_id`) REFERENCES `campaign` (`cam_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
