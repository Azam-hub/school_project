-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 10:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shaheen_children_academy`
--

CREATE DATABASE IF NOT EXISTS shaheen_children_academy;
USE shaheen_children_academy;

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` int(11) NOT NULL,
  `password` varchar(500) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `password`, `code`) VALUES
(1, '$2y$10$pjowqCmx2WgvhHvOxhaAeOtgAv12R4LyzDSPIa6wSGpigXW.PHJ5O', 'fpJMQvutP03YUIgBGCqZkRNzPntn33a3bdMkz49GJrr2E4bZMg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` text NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `phone`, `email`, `subject`, `message`, `datetime`) VALUES
(4, 'hassan', '22222222', 'hass@dd.ss', 'appreciate', 'i cant fin location', '04:36 - 25 Dec 22'),
(5, 'Muhammad Azam', '03333333333', 'azam78454@gmail.com', 'appreciate', 'problem is that i cant find location', '04:38 - 25 Dec 22'),
(7, 'nnn', '', 'ss@ff.vv', 'a', 'nn', '15:01 - 25 Dec 22'),
(8, 'Muhambbbbbbmad Azam', '03333333333', 'azamnnnn4@gmail.com', 'bb', 'cc', '19:40 - 25 Dec 22'),
(9, 'Muhambbbbbbmad Azam', '03333333333', 'azamnnnn4@gmail.com', 'bb', 'cc', '19:42 - 25 Dec 22'),
(10, 'Legend ccccccccccAzam', '03333333333', 'azam484848@gmail.com', 'xxww', 'ww', '19:49 - 25 Dec 22'),
(11, 'Muhammad Azam', '03333333333', 'azam78454@gmail.com', 'check mails', 'hello hi', '17:49 - 08 Jan 23'),
(12, 'Muhammad Azam', '03333333333', 'azam78454@gmail.com', 's', 'qqq', '01:52 - 11 Jan 23'),
(13, 'Muhammad Azam', '03333333333', 'azam78454@gmail.com', 'x', 'q', '01:47 - 13 Jan 23');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `email`, `code`, `status`) VALUES
(17, 'azam78454@gmail.com', '', 'active'),
(22, 'azam484848@gmail.com', '', 'active'),
(23, 'owais78454@gmail.com', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `first_para` text NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `gmail_id` varchar(100) NOT NULL,
  `facebook_url` varchar(2000) NOT NULL,
  `insta_url` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `first_para`, `phone_number`, `gmail_id`, `facebook_url`, `insta_url`) VALUES
(1, 'Lorem cdolor sit amet consectetur adipisicing elit. Qui quas soluta autem quidem mollitia quos vel minima ducimus? Perferendis veritatis esse ut hic consequatur sed omnis saepe, enim dignissimos aut beatae non facere voluptatum eligendi voluptas eos ea sint tempora tempore ad eius mollitia maiores aspernatur laboriosam. Illum nisi maxime sed magni non, recusandae, dolore, corporis nostrum quod sunt explicabo!', '0333-2332222', 'sample@gmail.com', 'https://www.facebook.com/', 'https://www.instagram.com/');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `primary_number` varchar(80) NOT NULL,
  `other_number` varchar(80) NOT NULL,
  `whatsapp_number` varchar(80) NOT NULL,
  `email_address` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `prev_school` text NOT NULL,
  `matric` varchar(1000) NOT NULL,
  `inter` varchar(1000) NOT NULL,
  `graduation` varchar(1000) NOT NULL,
  `masters` varchar(1000) NOT NULL,
  `professional_training` varchar(1000) NOT NULL,
  `qualifications` varchar(1000) NOT NULL,
  `subjects_of_interest` varchar(1000) NOT NULL,
  `section_of_interest` varchar(1000) NOT NULL,
  `timings` varchar(500) NOT NULL,
  `experience` varchar(500) NOT NULL,
  `other_detail` text NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `candidate_name`, `father_name`, `primary_number`, `other_number`, `whatsapp_number`, `email_address`, `address`, `prev_school`, `matric`, `inter`, `graduation`, `masters`, `professional_training`, `qualifications`, `subjects_of_interest`, `section_of_interest`, `timings`, `experience`, `other_detail`, `datetime`) VALUES
(14, 'Legend Azam', 'Ashraf', '03333333333', '03333333333', '11111111111111', 'azam484848@gmail.com', 'Lal qila', 'prev', 'Science Group', 'Arts Group', 'Commerce Group', 'Home Economics', 'English Language Courses', 'qual', 'Mathematics,Science,Computer,Sindhi', 'Primary (Grade 1 to 5),Administration/Management', 'Part Time', 'Less than 1 year', 'otheer', '02:59 - 13 Nov 22'),
(19, 'Muhammad Azam', 'dd', '03333333333', '22', '22', 'azam78454@gmail.com', 'Lal qila', 'a', 'Science Group', 'User did not fill this field.', 'User did not fill this field.', 'User did not fill this field.', 'User did not fill this field.', '', 'User did not fill this field.', 'User did not fill this field.', 'User did not fill this field.', 'User did not fill this field.', '', '01:44 - 11 Jan 23');

-- --------------------------------------------------------

--
-- Table structure for table `news_events_head`
--

CREATE TABLE `news_events_head` (
  `id` int(11) NOT NULL,
  `event_head` varchar(5000) NOT NULL,
  `file_name` varchar(1000) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_events_head`
--

INSERT INTO `news_events_head` (`id`, `event_head`, `file_name`, `datetime`) VALUES
(6, '23 march', '23 march@00_23_30-01_Nov_22.png', '00:23 - 01 Nov 22'),
(7, '23 march', '23 march@00_25_41-01_Nov_22.png', '00:43 - 01 Nov 22'),
(8, '14 August', '0_14 August@04_32_48-29_Dec_22.jpg#|#1_14 August@04_32_48-29_Dec_22.jpg#|#2_14 August@04_32_48-29_Dec_22.jpg', '04:32 - 29 Dec 22'),
(9, '14 August Celeberation', '14 August@00_27_23-01_Nov_22.png', '23:05 - 01 Nov 22'),
(10, 'Check', 'Check@00_36_03-02_Nov_22.png', '00:36 - 02 Nov 22'),
(11, 'Check', 'Check@00_36_09-02_Nov_22.png', '00:36 - 02 Nov 22'),
(12, 'Check', 'Check@00_36_12-02_Nov_22.png', '00:36 - 02 Nov 22'),
(13, 'Check', 'Check@00_36_15-02_Nov_22.png', '00:36 - 02 Nov 22'),
(14, 'Check', 'Check@00_36_19-02_Nov_22.png', '00:36 - 02 Nov 22'),
(15, 'Check', 'Check@00_36_23-02_Nov_22.png', '00:36 - 02 Nov 22'),
(16, 'Check', 'Check@00_36_26-02_Nov_22.png', '00:36 - 02 Nov 22'),
(17, 'Check', 'Check@00_36_31-02_Nov_22.png', '00:36 - 02 Nov 22'),
(18, 'Check', 'Check@00_36_34-02_Nov_22.png', '00:36 - 02 Nov 22'),
(19, 'Check', 'Check@00_36_38-02_Nov_22.png', '00:36 - 02 Nov 22'),
(20, 'Mid', '0_Mid@16_25_21-30_Dec_22.jpg#|#1_Mid@16_25_21-30_Dec_22.jpg#|#2_Mid@16_25_21-30_Dec_22.jpg', '16:25 - 30 Dec 22'),
(21, 'Check', 'Check@00_37_56-02_Nov_22.png', '00:37 - 02 Nov 22'),
(22, 'Check', 'Check@00_37_58-02_Nov_22.png', '00:37 - 02 Nov 22'),
(23, 'Check', 'Check@00_38_00-02_Nov_22.png', '00:38 - 02 Nov 22'),
(24, 'Check', 'Check@00_38_02-02_Nov_22.png', '00:38 - 02 Nov 22'),
(25, 'Check', 'Check@00_38_04-02_Nov_22.png', '00:38 - 02 Nov 22'),
(26, 'Check', 'Check@00_38_07-02_Nov_22.png', '00:38 - 02 Nov 22'),
(27, 'Check', 'Check@01_36_07-02_Nov_22.png', '01:36 - 02 Nov 22'),
(28, 'Check', 'Check@01_59_25-02_Nov_22.png', '01:59 - 02 Nov 22'),
(29, 'Check', 'Check@02_18_49-02_Nov_22.png', '02:18 - 02 Nov 22'),
(30, 'hi', 'hi@00_42_47-03_Nov_22.png', '00:42 - 03 Nov 22'),
(31, '6', '6@01_12_51-03_Nov_22.jpg', '01:12 - 03 Nov 22'),
(32, '5', '5@01_13_04-03_Nov_22.jpg', '01:13 - 03 Nov 22'),
(33, '4', '4@01_13_13-03_Nov_22.jpg', '01:13 - 03 Nov 22'),
(34, '3', '3@01_13_24-03_Nov_22.jpg', '01:13 - 03 Nov 22'),
(35, '2', '2@01_13_35-03_Nov_22.jpg', '01:13 - 03 Nov 22'),
(36, '1', '1@01_13_46-03_Nov_22.jpg', '01:13 - 03 Nov 22'),
(41, 'cc\'c', '@01_47_45-04_Nov_22.png', '01:47 - 04 Nov 22'),
(42, 'Azam\'s', '@01_46_30-04_Nov_22.png', '01:46 - 04 Nov 22'),
(43, '%dd\"$b1.d\'w', '0_@03_57_50-29_Dec_22.jpg#|#1_@03_57_50-29_Dec_22.jpg', '16:18 - 30 Dec 22'),
(61, '1new vacation', '0_new vacation@02_38_21-26_Dec_22.jpg#|#1_new vacation@02_38_21-26_Dec_22.jpg#|#2_new vacation@02_38_21-26_Dec_22.jpg', '04:43 - 29 Dec 22'),
(62, 'New', '0_New@18_47_59-07_Jan_23.jpg#|#1_New@18_47_59-07_Jan_23.jpg#|#2_New@18_47_59-07_Jan_23.jpg#|#3_New@18_47_59-07_Jan_23.jpg', '18:47 - 07 Jan 23'),
(63, 'New', '0_New@18_50_10-07_Jan_23.jpg#|#1_New@18_50_10-07_Jan_23.jpg#|#2_New@18_50_10-07_Jan_23.jpg#|#3_New@18_50_10-07_Jan_23.jpg', '18:50 - 07 Jan 23'),
(64, 'New', '0_New@18_51_00-07_Jan_23.jpg#|#1_New@18_51_00-07_Jan_23.jpg#|#2_New@18_51_00-07_Jan_23.jpg#|#3_New@18_51_00-07_Jan_23.jpg', '18:51 - 07 Jan 23'),
(65, 'New', '0_New@18_51_02-07_Jan_23.jpg#|#1_New@18_51_02-07_Jan_23.jpg#|#2_New@18_51_02-07_Jan_23.jpg#|#3_New@18_51_02-07_Jan_23.jpg', '18:51 - 07 Jan 23'),
(66, 'New', '0_New@18_51_04-07_Jan_23.jpg#|#1_New@18_51_04-07_Jan_23.jpg#|#2_New@18_51_04-07_Jan_23.jpg#|#3_New@18_51_04-07_Jan_23.jpg', '18:51 - 07 Jan 23'),
(67, 'After', '0_After@18_53_39-07_Jan_23.png#|#1_After@18_53_39-07_Jan_23.png', '18:53 - 07 Jan 23'),
(68, 'After', '0_After@18_52_55-07_Jan_23.jpg#|#1_After@18_52_55-07_Jan_23.jpg#|#2_After@18_52_55-07_Jan_23.jpg#|#3_After@18_52_55-07_Jan_23.jpg#|#4_After@18_52_55-07_Jan_23.jpg#|#5_After@18_52_55-07_Jan_23.jpg#|#6_After@18_52_55-07_Jan_23.jpg#|#7_After@18_52_55-07_Jan_23.jpg', '18:52 - 07 Jan 23');

-- --------------------------------------------------------

--
-- Table structure for table `new_events_description`
--

CREATE TABLE `new_events_description` (
  `id` int(11) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `head` varchar(5000) NOT NULL,
  `description` text NOT NULL,
  `event_head_id` varchar(80) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_events_description`
--

INSERT INTO `new_events_description` (`id`, `path`, `head`, `description`, `event_head_id`, `datetime`) VALUES
(29, 'At Beginning@22_57_06-01_Nov_22.png', 'At Beginningg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt aut nobis provident dolorum, cumque praesentium nesciunt, itaque, ipsa quibusdam debitis in vero nemo eum eius. Recusandae molestias blanditiis vero adipisci, necessitatibus quia eveniet. Fugiat, exercitationem ea dolor saepe odio doloribus, vel aperiam omnis veritatis, nam magni quia? Earum nesciunt laudantium, pariatur eius possimus placeat porro reprehenderit optio, et repellendus nulla voluptate natus minus, inventore rerum est voluptatem? Dolores quae voluptatum quod iure. Deserunt velit qui ullam repellendus voluptates impedit ipsum deleniti optio sunt odit fugit, officiis eius, fugiat commodi! Eligendi, quae. Nemo est dignissimos, a rem ea praesentium vel enim temporibus maxime repellat eligendi accusamus facere id fuga, aut aliquam quas ipsa consectetur molestiae consequuntur necessitatibus, tempore officia eum veritatis. Inventore earum magni dolore assumenda asperiores tenetur, temporibus odit, reprehenderit accusantium doloremque eligendi atque fuga iste perferendis modi optio quis.', '9', '23:04 - 01 Nov 22'),
(30, 'At End@23_00_58-01_Nov_22.mp4', 'At End', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt aut nobis provident dolorum, cumque praesentium nesciunt, itaque, ipsa quibusdam debitis in vero nemo eum eius. Recusandae molestias blanditiis vero adipisci, necessitatibus quia eveniet. Fugiat, exercitationem ea dolor saepe odio doloribus, vel aperiam omnis veritatis, nam magni quia? Earum nesciunt laudantium, pariatur eius possimus placeat porro reprehenderit optio, et repellendus nulla voluptate natus minus, inventore rerum est voluptatem? Dolores quae voluptatum quod iure. Deserunt velit qui ullam repellendus voluptates impedit ipsum deleniti optio sunt odit fugit, officiis eius, fugiat commodi! Eligendi, quae. Nemo est dignissimos, a rem ea praesentium vel enim temporibus maxime repellat eligendi accusamus facere id fuga, aut aliquam quas ipsa consectetur molestiae consequuntur necessitatibus, tempore officia eum veritatis. Inventore earum magni dolore assumenda asperiores tenetur, temporibus odit, reprehenderit accusantium doloremque eligendi atque fuga iste perferendis modi optio quis.', '9', '23:00 - 01 Nov 22'),
(31, '23 begin@01_37_21-01_Nov_22.png', '23 begin', 'dd first second third fourth fifth sixth seventh eightht ninth tenth', '6', '01:37 - 01 Nov 22'),
(33, 'Intro@01_30_12-03_Nov_22.png', 'Intro', 'Azam name si', '35', '01:30 - 03 Nov 22'),
(34, 'centr@01_30_55-03_Nov_22.png', 'centr', 'bright career school studying', '35', '01:30 - 03 Nov 22'),
(35, 'end@01_31_46-03_Nov_22.mp4', 'end', 'leave earth', '35', '01:31 - 03 Nov 22'),
(36, 'd@02_24_06-04_Nov_22.png', 'd\'g', 'ss', '41', '02:24 - 04 Nov 22'),
(40, 'beginning@04_28_13-13_Nov_22.mp4', 'beginning', 'dddddddddddddddddd', '41', '04:28 - 13 Nov 22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_events_head`
--
ALTER TABLE `news_events_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_events_description`
--
ALTER TABLE `new_events_description`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news_events_head`
--
ALTER TABLE `news_events_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `new_events_description`
--
ALTER TABLE `new_events_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
