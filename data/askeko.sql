-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2013 at 05:58 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `askeko`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `Answerid` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `Text` text COLLATE utf8_bin,
  `Date` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `approved` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Answerid`),
  KEY `answer_student_idx` (`userId`),
  KEY `answer_Question` (`QuestionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`Answerid`, `QuestionId`, `userId`, `Text`, `Date`, `approved`) VALUES
(1, 4, 1, 0x313131313131313131313131, '1386295501', '0'),
(2, 4, 3, 0x3737373737373737373737373737373737373737373737373737373737373737373737373737, '1386310353', '3'),
(3, 4, 1, 0x7979797979797979797979797979797979797979797979, '1386927570', '0'),
(4, 4, 1, 0x3838383838383838383838383838383838383838383838, '1386927686', '0'),
(5, 4, 1, 0x303030303030303030303030303030303030303030, '1386927876', '0'),
(6, 4, 1, 0x74657373737373737373737373737373737373737373737374203a44, '1386928117', '0'),
(7, 4, 1, 0x3737373737373737373737373737373737373737373737373737373737373737, '1386928303', '0'),
(8, 4, 1, 0x747272727272727272727272727272727272727279203a44, '1386928450', '0'),
(9, 4, 1, 0x6c6161616161616161616161616161617374, '1386928543', '0'),
(10, 2, 1, 0x6868686868686868686868686868686868686868, '1386994870', '0'),
(11, 2, 1, 0x34343434343434343434343434343434343434343434, '1387053274', '0'),
(12, 4, 1, 0x7070707070707070707070707070, '1387073191', '0'),
(13, 4, 1, 0x30303030303030303030303030303030303030, '1387073436', '0'),
(14, 4, 1, 0x303030303030303030303030303030303030303939393939393939393939393939393939, '1387073489', '0'),
(15, 4, 1, 0x7070707070707070707070707070707070707070707070707070707070703939393939393939393939, '1387074122', '0'),
(16, 2, 1, 0x617364617364617364713132313332313233, '1387077642', '0'),
(17, 2, 1, 0x616e737765722074657374, '1387094449', '0'),
(18, 2, 3, 0x6d6f68616d6564206164656c206f7065206d2c6d736164206c6b717765206d612e2c73646c6b6c20617364, '1387102030', '0'),
(19, 2, 3, 0x6d6f68616d6564206164656c206f7065206d2c6d736164206c6b717765206d612e2c73646c6b6c206173640d0a20616c3b6b7364207177656f6970206c616b7364202c2e6d617364, '1387102036', '3'),
(20, 2, 3, 0x6d6f68616d6564206164656c2068656c6c6f203a4420, '1387175266', '3');

-- --------------------------------------------------------

--
-- Table structure for table `answer_like`
--

CREATE TABLE IF NOT EXISTS `answer_like` (
  `answerId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `Rate` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`answerId`,`userId`),
  KEY `answer_student_idx` (`userId`),
  KEY `answer_like_answer_idx` (`answerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `answer_like`
--

INSERT INTO `answer_like` (`answerId`, `userId`, `Rate`) VALUES
(1, 1, '1'),
(2, 1, '0'),
(10, 1, '0'),
(10, 3, '1'),
(16, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `DepartmentId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`DepartmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentId`, `Name`) VALUES
(1, 'computer');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `SubId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`SubId`),
  KEY `doctor_sub_idx` (`SubId`),
  KEY `doctor_user_idx` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`userId`, `SubId`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE IF NOT EXISTS `favorite` (
  `userid` int(11) NOT NULL,
  `QuestionId` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`QuestionId`),
  KEY `Favorite_student_idx` (`userid`),
  KEY `favourite_subject_idx` (`QuestionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`userid`, `QuestionId`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE IF NOT EXISTS `follower` (
  `userid` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`questionId`),
  KEY `Follower_student_idx` (`userid`),
  KEY `follower_Subject_idx` (`questionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`userid`, `questionId`) VALUES
(1, 2),
(1, 4),
(1, 5),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `user_NotificationId` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `text` text COLLATE utf8_bin,
  `seen` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `questionId` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_NotificationId`),
  KEY `noti_student_idx` (`userid`),
  KEY `noti_question_idx` (`questionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`user_NotificationId`, `userid`, `text`, `seen`, `questionId`, `type`) VALUES
(1, 3, 0x6d6f68616d6564206164656c2061736b6564207175657374696f6e206174206c696e65617220616c6765627261, '1', 3, NULL),
(2, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 2, NULL),
(3, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 2, NULL),
(4, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 4, NULL),
(5, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 4, NULL),
(6, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 4, NULL),
(7, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 4, NULL),
(8, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 2, NULL),
(9, 3, 0x6d6f68616d6564206164656c20616e737765726564207175657374696f6e20796f752061726520666f6c6c6f77696e67, '1', 2, NULL),
(10, 3, 0x4e6577207175657374696f6e206174206c696e65617220616c67656272612061736b6564206279206d6f68616d6564206164656c, '1', 5, 'ask'),
(11, 1, 0x312070656f706c65206c696b6520796f7572207175657374696f6e, '0', 3, '3 asklike'),
(12, 1, 0x4e657720616e7377657220616464656420666f722061207175657374696f6e20796f752061726520666f6c6c6f77696e67, '0', 2, NULL),
(13, 1, 0x4e657720616e7377657220616464656420666f722061207175657374696f6e20796f752061726520666f6c6c6f77696e67, '0', 2, NULL),
(14, 1, 0x3220706572736f6e206c696b6520796f757220616e73776572, '0', 2, '10 like'),
(15, 1, 0x4e657720617070726f76656420616e7377657220666f722061207175657374696f6e20796f752061726520666f6c6c6f77696e67, '0', 2, NULL),
(16, 1, 0x596f757220616e737765722077617320617070726f766564, '0', 2, '10 app'),
(17, 1, 0x4e657720616e7377657220616464656420666f722061207175657374696f6e20796f752061726520666f6c6c6f77696e67, '0', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QuestionsId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `Text` text COLLATE utf8_bin,
  `date` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Description` text COLLATE utf8_bin,
  PRIMARY KEY (`QuestionsId`),
  KEY `question_student_idx` (`userId`),
  KEY `question_sub_idx` (`subId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionsId`, `userId`, `subId`, `Text`, `date`, `Description`) VALUES
(2, 1, 1, 0x6669727374207175657374696f6e73203f, '', 0x616161206173646173642061616120617364),
(3, 1, 1, 0x7175657374696f6e2032, '1385885635', 0x313131313220343533343520313233313233),
(4, 1, 1, 0x6f6f6f6f6f7070707070313233313233, '1386294879', 0x313131313131313131313131),
(5, 1, 1, 0x3232323232323232323232323232, '1387100582', 0x313131313131313131313131313131313131);

-- --------------------------------------------------------

--
-- Table structure for table `question_like`
--

CREATE TABLE IF NOT EXISTS `question_like` (
  `questionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `rate` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`questionId`,`userId`),
  KEY `question_like_student_idx` (`userId`),
  KEY `question_like_question_idx` (`questionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `question_like`
--

INSERT INTO `question_like` (`questionId`, `userId`, `rate`) VALUES
(0, 1, '0'),
(2, 1, '1'),
(2, 3, '0'),
(3, 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `studs`
--

CREATE TABLE IF NOT EXISTS `studs` (
  `userId` int(11) NOT NULL,
  `Score` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `year` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Studentscol` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `studentsUser_idx` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `SubjectId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `DepId` int(11) NOT NULL,
  `Term` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `year` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`SubjectId`),
  KEY `sub_Dep_idx` (`DepId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectId`, `Name`, `DepId`, `Term`, `year`) VALUES
(1, 'linear algebra', 1, '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Fname` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `Lname` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `DepId` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `activated` varchar(45) COLLATE utf8_bin DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `student_Department_idx` (`DepId`),
  KEY `userId` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `Email`, `Password`, `Fname`, `Lname`, `DepId`, `type`, `activated`) VALUES
(1, 'm.adel0093@gmail.com', '123456', 'mohamed', 'adel', 1, 'student', '1'),
(2, 'yiier', '123456', NULL, NULL, 1, 'student', '0'),
(3, 'doctor1@doctor.com', '123456', 'lossy', '', 1, 'doctor', '1'),
(6, 'abdallah@gmail.com', '123456', 'abdallah', 'adel', 1, 'student', '0'),
(7, 'user1@gmail.com', '123456', 'user1', 'asdas', 1, 'student', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answerStudent2` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `answer_Question` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`QuestionsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answer_like`
--
ALTER TABLE `answer_like`
  ADD CONSTRAINT `answerlike_student` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctor_sub` FOREIGN KEY (`SubId`) REFERENCES `subject` (`SubjectId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doctor_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `Favorite_student` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `favourite_question` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`QuestionsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_question` FOREIGN KEY (`questionId`) REFERENCES `questions` (`QuestionsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Follower_student` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `noti_question` FOREIGN KEY (`questionId`) REFERENCES `questions` (`QuestionsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `noti_student` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_student` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `question_sub` FOREIGN KEY (`subId`) REFERENCES `subject` (`SubjectId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question_like`
--
ALTER TABLE `question_like`
  ADD CONSTRAINT `question_like_question2` FOREIGN KEY (`questionId`) REFERENCES `questions` (`QuestionsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `question_like_student2` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `studs`
--
ALTER TABLE `studs`
  ADD CONSTRAINT `studentsUser` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `sub_Dep` FOREIGN KEY (`DepId`) REFERENCES `departments` (`DepartmentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_Department` FOREIGN KEY (`DepId`) REFERENCES `departments` (`DepartmentId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
