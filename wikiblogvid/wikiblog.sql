-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 10:02 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wikiblog`
--
CREATE DATABASE IF NOT EXISTS `wikiblog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wikiblog`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_blog` (IN `subject_selected` INT, IN `title` VARCHAR(140), IN `blog` TEXT, IN `user_id` INT)  MODIFIES SQL DATA
INSERT INTO 
            blogs(  subjectopic, title, bbody, postdate, posttime, status, posteduser  )
            VALUES( subject_selected, title, blog, CURRENT_DATE, CURRENT_TIME,1, user_id  )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_comment` (IN `user` INT, IN `comment` TEXT, IN `blog_id` INT)  MODIFIES SQL DATA
INSERT INTO 
comments( commentuser, comment,commentdate, commenttime, status, blogid )
 VALUES( user, comment, CURRENT_DATE, CURRENT_TIME, 1, blog_id )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clear_username_email` (IN `user_id` INT)  MODIFIES SQL DATA
UPDATE users
SET users.username = "",
    users.emailaddress = ""
    WHERE users.userid = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_inserted_id` (IN `fname` VARCHAR(50), IN `lname` VARCHAR(50), IN `uname` VARCHAR(100))  READS SQL DATA
SELECT MAX(userid) as userid
FROM users
WHERE firstname = fname AND
      lastname = lname AND
      username = uname$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_blog_content` (IN `title_selected` INT)  READS SQL DATA
SELECT blogs.bbody,blogs.postdate,blogs.posteduser, users.userid, users.firstname,users.lastname,users.username
from blogs,users
WHERE blogs.blogid = title_selected AND blogs.status = 1 AND users.userid = blogs.posteduser$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_blog_content_admin` (IN `title_selected` INT)  READS SQL DATA
SELECT blogs.bbody,blogs.postdate,blogs.posteduser, users.userid, users.firstname,users.lastname,users.username
from blogs,users
WHERE blogs.blogid = title_selected  AND users.userid = blogs.posteduser$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_comments` (IN `blog_id` INT)  READS SQL DATA
SELECT comments.comment
FROM comments
WHERE comments.blogid = blog_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_content_for_comment` (IN `user` INT, IN `blog_id` INT, IN `subject_id` INT)  READS SQL DATA
SELECT users.firstname, users.lastname,blogs.title,blogs.bbody,subjects.title
FROM users, blogs,subjects
WHERE users.userid = user AND
       users.status = 1 AND
       
       blogs.blogid = blog_id AND
       blogs.status = 1 AND
       
       subjects.subjectid = subject_id AND
       subjects.status  = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_info_by_user_id` (IN `user_id` INT)  READS SQL DATA
SELECT  users.firstname,users.lastname, users.username, users.emailaddress, userquestions.questionid,userquestions.answer
FROM users, userquestions
WHERE users.userid = user_id AND 
      userquestions.userid = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_questions` ()  READS SQL DATA
SELECT questionid, question
from secretquestions
WHERE status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_status` (IN `title_selected` INT)  READS SQL DATA
SELECT blogs.status
FROM blogs
WHERE blogs.blogid = title_selected$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_subjects` ()  READS SQL DATA
SELECT title, subjectid
from subjects$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_titles_by_subject` (IN `subject_id` INT)  READS SQL DATA
SELECT title, blogid, posteduser
from blogs
where subjectopic = subject_id AND status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `load_titles_by_subject_admin` (IN `subject_id` INT)  READS SQL DATA
SELECT title, blogid, posteduser
from blogs
where subjectopic = subject_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_question_answer` (IN `user_id` INT, IN `secrect_question` INT, IN `secrect_answer` VARCHAR(50))  MODIFIES SQL DATA
UPDATE userquestions
SET userquestions.questionid = secrect_question,
    userquestions.answer  = secrect_answer
    WHERE userquestions.userid = user_id AND
    userquestions.status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_status` (IN `status_selected` INT, IN `title_selected` INT)  MODIFIES SQL DATA
UPDATE blogs
SET blogs.status = status_selected
WHERE blogs.blogid = title_selected$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `fname` VARCHAR(50), IN `lname` VARCHAR(50), IN `uname` VARCHAR(50), IN `email` VARCHAR(50), IN `user_id` INT)  MODIFIES SQL DATA
UPDATE users
SET users.firstname = fname,
    users.lastname = lname,
    users.username = uname,
    users.emailaddress = email
    WHERE users.userid = user_id AND
    users.status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users_check_username` (IN `uname` VARCHAR(45))  READS SQL DATA
SELECT userid, firstname, lastname, username, emailaddress, superuser, expert,status, creationdate, role, psww
FROM `users` 
WHERE username = uname$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users_email_check` (IN `uemail` VARCHAR(125))  READS SQL DATA
SELECT userid, firstname, lastname, username, emailaddress, superuser, expert, status, creationdate, role, psww 
FROM `users` 
WHERE email = uemail$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users_insert` (IN `fname` VARCHAR(40), IN `lname` VARCHAR(40), IN `username` VARCHAR(40), IN `email` VARCHAR(125), IN `pd` VARCHAR(56))  MODIFIES SQL DATA
INSERT INTO users(firstname, 
                  lastname, 
                  username, 
                  emailaddress,        
                  status, 
                  creationdate, 
                  role,
                  psww) 

VALUES (fname,
       lname,
       username,
       email,      
       1,
       CURRENT_DATE,
       2,
       pd)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users_verify_login` (IN `uname` VARCHAR(40), IN `pswd` VARCHAR(56))  READS SQL DATA
SELECT userid, firstname, lastname, username, emailaddress, superuser, expert, status, creationdate, role, psww 
FROM `users` 
WHERE username = uname and psww = pswd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_question_answer_insert` (IN `use_id` INT, IN `questio_id` INT, IN `answer` VARCHAR(100))  MODIFIES SQL DATA
INSERT INTO userquestions(
                      userid,
                      questionid,
                      answer,
                      status
    
                )
                VALUES( 
                use_id,
                   questio_id,
                    answer,
                    1
                    
                
                
                )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_update_password` (IN `encryppassword` VARCHAR(60), IN `user` INT)  MODIFIES SQL DATA
UPDATE users
SET users.psww = encryppassword
WHERE users.userid = user AND
 users.status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verify_correct_answer` (IN `theuser` INT, IN `thequestion` INT, IN `theanswer` VARCHAR(100))  READS SQL DATA
SELECT userquestions.uquestionid
FROM userquestions
WHERE userquestions.userid = theuser AND
userquestions.questionid = thequestion AND
userquestions.answer = theanswer$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verify_correct_email` (IN `email` VARCHAR(256))  READS SQL DATA
SELECT users.userid
FROM users 
WHERE users.emailaddress = email$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogid` int(11) NOT NULL,
  `subjectopic` int(11) NOT NULL,
  `title` varchar(140) NOT NULL,
  `bbody` text NOT NULL,
  `postdate` date NOT NULL,
  `posttime` time NOT NULL,
  `status` int(11) NOT NULL,
  `posteduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogid`, `subjectopic`, `title`, `bbody`, `postdate`, `posttime`, `status`, `posteduser`) VALUES
(1, 1, 'php programming', 'php programming is very enjoyable.', '0000-00-00', '00:00:00', 1, 5),
(2, 2, 'aaa', 'aa', '2017-06-07', '18:54:40', 1, 14),
(3, 1, 'bb', 'bbbb', '2017-06-07', '18:55:14', 1, 14),
(4, 1, 'bb', 'bbbb', '2017-06-07', '18:55:16', 0, 14),
(5, 1, 'bb', 'bbbb', '2017-06-07', '18:56:05', 1, 14),
(6, 1, 'aa', 'aaaaa', '2017-06-07', '19:03:13', 0, 14),
(7, 1, 'aaa', 'bbb', '2017-06-07', '19:13:29', 1, 14),
(8, 1, 'aaa', 'bbb', '2017-06-07', '19:13:51', 1, 14),
(9, 1, 'aaa', 'bbb', '2017-06-07', '19:20:45', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `commentuser` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commentdate` date NOT NULL,
  `commenttime` time NOT NULL,
  `status` int(11) NOT NULL,
  `blogid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `commentuser`, `comment`, `commentdate`, `commenttime`, `status`, `blogid`) VALUES
(1, 5, 'any comment', '0000-00-00', '00:00:00', 1, 1),
(2, 5, 'second comment', '0000-00-00', '00:00:00', 1, 1),
(3, 14, 'Add Comment', '2017-06-09', '12:50:00', 1, 1),
(4, 14, 'Add Comment', '2017-06-09', '12:51:11', 1, 3),
(5, 14, 'Add Comment', '2017-06-09', '12:56:16', 1, 3),
(6, 14, 'trying to comment', '2017-06-09', '13:03:31', 1, 3),
(7, 14, 'trying comment', '2017-06-09', '13:05:42', 1, 3),
(8, 14, 'yes me too i like php', '2017-06-09', '13:06:30', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `secretquestions`
--

CREATE TABLE `secretquestions` (
  `questionid` int(11) NOT NULL,
  `question` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secretquestions`
--

INSERT INTO `secretquestions` (`questionid`, `question`, `status`) VALUES
(1, '0', 1),
(2, 'What was your first pet''s name', 1),
(3, 'What was your first job', 1),
(4, 'When did you finish high school', 1),
(5, 'what is your favorite color', 1),
(6, 'what is your favorite vacation spot', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectid` int(11) NOT NULL,
  `title` varchar(140) NOT NULL,
  `datecreated` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectid`, `title`, `datecreated`, `status`) VALUES
(1, 'Programming', '0000-00-00', 1),
(2, 'Cooking', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userquestions`
--

CREATE TABLE `userquestions` (
  `uquestionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userquestions`
--

INSERT INTO `userquestions` (`uquestionid`, `userid`, `questionid`, `answer`, `status`) VALUES
(3, 14, 4, 'aaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(15) NOT NULL,
  `emailaddress` varchar(150) NOT NULL,
  `superuser` int(11) NOT NULL,
  `expert` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `creationdate` date NOT NULL,
  `role` int(11) NOT NULL,
  `psww` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `username`, `emailaddress`, `superuser`, `expert`, `status`, `creationdate`, `role`, `psww`) VALUES
(5, 'James', 'Brouwer', 'jbrouwer', 'jbrouwer@gbc.ca', 0, 0, 1, '2016-08-23', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'linda', 'Jones', 'ljones', 'ljones@gbc.ca', 0, 0, 1, '2016-08-23', 2, 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'aaa', 'a', 'aa', 'aa@aa', 0, 0, 1, '2017-06-01', 2, 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `secretquestions`
--
ALTER TABLE `secretquestions`
  ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `userquestions`
--
ALTER TABLE `userquestions`
  ADD PRIMARY KEY (`uquestionid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `secretquestions`
--
ALTER TABLE `secretquestions`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userquestions`
--
ALTER TABLE `userquestions`
  MODIFY `uquestionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
