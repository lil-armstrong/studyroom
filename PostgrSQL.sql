-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2017 at 06:32 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SQL_MODE := "NO_AUTO_VALUE_ON_ZERO";
AUTOCOMMIT := 0;
START TRANSACTION;
time_zone := "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studyroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  did int CHECK (did > 0) NOT NULL,
  name varchar(50) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000' (6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (did, name, create_date) VALUES
(1, 'computer', '0000-00-00 00:00:00.000000'),
(2, 'mathematics', '0000-00-00 00:00:00.000000'),
(3, 'physics', '0000-00-00 00:00:00.000000'),
(4, 'medicine', '2017-11-21 10:53:11.000000');

-- --------------------------------------------------------

--
-- Table structure for table `edulevel`
--

CREATE TABLE `edulevel` (
  id int CHECK (id > 0) NOT NULL,
  education varchar(20) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000' (6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edulevel`
--

INSERT INTO `edulevel` (id, education, create_date) VALUES
(1, 'high school', '0000-00-00 00:00:00.000000'),
(2, 'bachelors', '0000-00-00 00:00:00.000000'),
(3, 'masters', '0000-00-00 00:00:00.000000'),
(4, 'phd', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  fid int CHECK (fid > 0) NOT NULL,
  name varchar(50) NOT NULL,
  did int NOT NULL ,
  create_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  lid int CHECK (lid > 0) NOT NULL,
  name varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'untitled',
  type int NOT NULL ,
  uid int DEFAULT NULL,
  location varchar(100) NOT NULL,
  upload_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  uid int CHECK (uid > 0) ZEROFILL NOT NULL ,
  username varchar(20) CHARACTER SET latin1 NOT NULL,
  firstname varchar(20) CHARACTER SET latin1 NOT NULL,
  middlename varchar(20) CHARACTER SET latin1 NOT NULL,
  lastname varchar(20) CHARACTER SET latin1 NOT NULL,
  sex enum('male','female') NOT NULL,
  dob timestamp(0) DEFAULT NULL,
  marital_status enum('single','married') NOT NULL,
  edulevel varchar(30) NOT NULL,
  school varchar(40) NOT NULL,
  field varchar(40) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(20) NOT NULL ,
  nationality varchar(20) NOT NULL,
  zipcode char(6) DEFAULT NULL,
  pass varchar(32) NOT NULL,
  email varchar(60) NOT NULL,
  phone char(20) DEFAULT NULL,
  type enum('student','tutor') NOT NULL DEFAULT 'student',
  create_dt timestamp(6) NOT NULL ,
  last_login timestamp(6) DEFAULT NULL (6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (uid, username, firstname, middlename, lastname, sex, dob, marital_status, edulevel, school, field, city, state, nationality, zipcode, pass, email, phone, type, create_dt, last_login) VALUES
(000000000001, 'oebong', 'Okposong', 'Daniel', 'Ebong', 'male', '1995-05-18', 'single', 'College', 'Uiversity of Port Harcourt', 'computer', 'Uyo', '', 'Nigeria', '502104', 'Littleguy', 'oebong1@gmail.com', NULL, 'student', '0000-00-00 00:00:00.000000', '2017-11-21 10:54:03.223613'),
(000000000003, 'armstrong', 'Armstrong', 'Daniel', 'Ebong', 'male', '1995-05-18', 'single', 'College', 'UNIPORT', 'mathematics', 'Uyo', '', 'Nigeria', '520104', 'Littleguy007', 'armstrongebong@gmail.com', NULL, 'tutor', '0000-00-00 00:00:00.000000', '2017-11-21 10:54:13.192771'),
(000000000005, 'victor', 'victor', 'mike', 'lawson', 'male', '0000-00-00', 'single', '2', 'uniport', 'computer', 'uyo', 'akwa ibom', 'nigeria', '', 'VictorMike123', 'victormike@gmail.com', NULL, 'student', '2017-11-09 11:06:47.000000', '2017-11-16 23:45:04.000000'),
(000000000006, 'gab123', 'gabriel', 'jackson', 'lawson', 'male', '0000-00-00', 'single', '2', 'uniport', 'computer', 'uyo', 'akwa ibom', 'nigeria', '', 'GabrielJackson123', 'gabjack@gmail.com', NULL, 'tutor', '2017-11-14 20:42:19.000000', '2017-11-16 23:45:04.000000');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  qid int CHECK (qid > 0) NOT NULL ,
  topic varchar(100) NOT NULL,
  message longtext NOT NULL,
  projtname varchar(100) DEFAULT NULL ,
  urgent enum('no','yes') NOT NULL,
  by_who int NOT NULL ,
  type enum('assignment','project') NOT NULL DEFAULT 'assignment',
  status enum('started','pending','completed','expired') NOT NULL DEFAULT 'pending',
  starts timestamp(6) DEFAULT NULL,
  expires timestamp(6) DEFAULT NULL ,
  match_tutor int DEFAULT NULL ,
  ask_date timestamp(6) NOT NULL ,
  answer_date timestamp(6) DEFAULT NULL (6) COMMENT 'answer date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (qid, topic, message, projtname, urgent, by_who, type, status, starts, expires, match_tutor, ask_date, answer_date) VALUES
(1, 'fdsg', 'asfd', '11_17-u1-sfsfd', 'yes', 1, 'assignment', 'pending', NULL, '2017-12-28 00:00:00.000000', NULL, '2017-11-28 18:09:46.000000', NULL),
(2, 'sfds', 'adfsghjkl;bvdvfhgbvdbgnbf', '11_17-u1-checkingact2', 'no', 1, 'project', 'pending', NULL, '2018-11-28 00:00:00.000000', NULL, '2017-11-28 18:28:55.000000', NULL),
(3, 'adding pictures', 'oh yeah!', '11_17-u1-addingpix', 'yes', 1, 'assignment', 'pending', NULL, '2017-12-28 00:00:00.000000', NULL, '2017-11-28 18:52:10.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_cat`
--

CREATE TABLE `question_cat` (
  cid int CHECK (cid > 0) NOT NULL,
  name varchar(50) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  uid int CHECK (uid > 0) ZEROFILL NOT NULL ,
  username varchar(20) CHARACTER SET latin1 NOT NULL,
  firstname varchar(20) CHARACTER SET latin1 NOT NULL,
  middlename varchar(20) CHARACTER SET latin1 NOT NULL,
  lastname varchar(20) CHARACTER SET latin1 NOT NULL,
  sex enum('male','female') NOT NULL,
  dob timestamp(0) DEFAULT NULL,
  marital_status enum('single','married') NOT NULL,
  edulevel varchar(30) NOT NULL,
  school varchar(40) NOT NULL,
  field varchar(40) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(20) NOT NULL ,
  nationality varchar(20) NOT NULL,
  zipcode char(6) DEFAULT NULL,
  pass varchar(32) NOT NULL,
  email varchar(60) NOT NULL,
  phone char(20) DEFAULT NULL,
  type varchar(10) DEFAULT 'student',
  create_dt timestamp(6) NOT NULL ,
  last_login timestamp(6) DEFAULT NULL (6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all informations about students';

--
-- Dumping data for table `student`
--

INSERT INTO `student` (uid, username, firstname, middlename, lastname, sex, dob, marital_status, edulevel, school, field, city, state, nationality, zipcode, pass, email, phone, type, create_dt, last_login) VALUES
(000000000001, 'oebong', 'Okposong', 'Daniel', 'Ebong', 'male', '1995-05-18', 'single', 'College', 'Uiversity of Port Harcourt', 'computer', 'Uyo', '', 'Nigeria', '502104', 'Littleguy', 'oebong1@gmail.com', NULL, 'student', '0000-00-00 00:00:00.000000', '2017-12-02 13:11:53.000000'),
(000000000005, 'victor', 'victor', 'mike', 'lawson', 'male', '0000-00-00', 'single', '2', 'uniport', 'computer', 'uyo', 'akwa ibom', 'nigeria', '', 'VictorMike123', 'victormike@gmail.com', NULL, 'student', '2017-11-09 11:06:47.000000', '2017-11-21 16:13:40.000000'),
(000000000006, 'gab123', 'gabriel', 'jackson', 'lawson', 'male', '0000-00-00', 'single', '2', 'uniport', 'computer', 'uyo', 'akwa ibom', 'nigeria', '', 'GabrielJackson123', 'gabjack@gmail.com', NULL, 'student', '2017-11-14 20:42:19.000000', '2017-11-20 13:30:16.157929'),
(000000000007, 'kenneth', 'kennedy', 'marvelous', 'sanity', 'male', '0000-00-00', 'single', '1', 'uniport', 'computer', 'uyo', '', 'nigeria', '', 'KennethMarvel123', 'kennethmarvel@gmail.com', '', 'student', '2017-11-20 16:10:24.000000', NULL),
(000000000014, 'raymond', 'jackson', 'jason', 'raymond', 'male', '1995-05-18', 'married', '1', 'uniport', 'computer', 'uyo', '', 'nigeria', '', 'Littleguy007', 'raymond@gmail.com', '', 'student', '2017-11-20 16:46:55.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_dept_msg`
--

CREATE TABLE `student_dept_msg` (
  mid int NOT NULL,
  qid int NOT NULL,
  notice varchar(100) DEFAULT 'Re:',
  dept varchar(20) NOT NULL,
  duration timestamp(6) NOT NULL,
  level enum('notify','alert','confirm','affirm') NOT NULL DEFAULT 'notify' ,
  msg_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all student messages';

-- --------------------------------------------------------

--
-- Table structure for table `student_dept_msg_seen`
--

CREATE TABLE `student_dept_msg_seen` (
  id int CHECK (id > 0) NOT NULL,
  mid int CHECK (mid > 0) NOT NULL,
  uid int CHECK (uid > 0) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_dept_msg_seen`
--

INSERT INTO `student_dept_msg_seen` (id, mid, uid, create_date) VALUES
(1, 0, 1, '2017-11-28 12:29:51.000000');

-- --------------------------------------------------------

--
-- Table structure for table `student_help`
--

CREATE TABLE `student_help` (
  uid int NOT NULL,
  total int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Track each student help record';

-- --------------------------------------------------------

--
-- Table structure for table `student_msg`
--

CREATE TABLE `student_msg` (
  mid int NOT NULL,
  qid int DEFAULT NULL,
  notice varchar(100) NOT NULL DEFAULT 'Re:',
  student_id int NOT NULL,
  duration timestamp(6) NOT NULL,
  level enum('notify','alert','confirm','affirm') NOT NULL DEFAULT 'notify' ,
  msg_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all student messages';

--
-- Dumping data for table `student_msg`
--

INSERT INTO `student_msg` (mid, qid, notice, student_id, duration, level, msg_date) VALUES
(1, 1, 'Re:', 1, '0000-00-00 00:00:00.000000', 'affirm', '2017-11-28 18:34:47.000000');

-- --------------------------------------------------------

--
-- Table structure for table `student_msg_seen`
--

CREATE TABLE `student_msg_seen` (
  id int CHECK (id > 0) NOT NULL,
  mid int CHECK (mid > 0) NOT NULL,
  uid int CHECK (uid > 0) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_msg_seen`
--

INSERT INTO `student_msg_seen` (id, mid, uid, create_date) VALUES
(1, 1, 1, '2017-11-28 18:35:01.000000');

-- --------------------------------------------------------

--
-- Table structure for table `superusers`
--

CREATE TABLE `superusers` (
  uid int CHECK (uid > 0) NOT NULL,
  username varchar(20) NOT NULL,
  firstname varchar(30) NOT NULL,
  lastname varchar(30) NOT NULL,
  pass varchar(35) NOT NULL,
  email varchar(60) NOT NULL,
  nationality varchar(30) NOT NULL,
  city varchar(20) NOT NULL,
  power enum('0','1') NOT NULL DEFAULT '0',
  last_login timestamp(6) DEFAULT NULL (6),
  create_dt datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  tid int NOT NULL,
  qid int NOT NULL,
  start_date timestamp(6) DEFAULT NULL,
  accept_date timestamp(6) DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (tid, qid, start_date, accept_date) VALUES
(1, 1, NULL, '2017-11-28 18:34:47.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  uid int CHECK (uid > 0) ZEROFILL NOT NULL ,
  username varchar(20) CHARACTER SET latin1 NOT NULL,
  firstname varchar(20) CHARACTER SET latin1 NOT NULL,
  middlename varchar(20) CHARACTER SET latin1 NOT NULL,
  lastname varchar(20) CHARACTER SET latin1 NOT NULL,
  sex enum('male','female') NOT NULL,
  dob timestamp(0) DEFAULT NULL,
  marital_status enum('single','married') NOT NULL,
  edulevel varchar(30) NOT NULL,
  school varchar(40) NOT NULL,
  field varchar(40) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(20) NOT NULL ,
  nationality varchar(20) NOT NULL,
  zipcode char(6) DEFAULT NULL,
  pass varchar(32) NOT NULL,
  email varchar(60) NOT NULL,
  phone char(20) DEFAULT NULL,
  type varchar(10) DEFAULT 'tutor',
  create_dt timestamp(6) NOT NULL ,
  last_login timestamp(6) DEFAULT NULL (6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all informations about tutoras';

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (uid, username, firstname, middlename, lastname, sex, dob, marital_status, edulevel, school, field, city, state, nationality, zipcode, pass, email, phone, type, create_dt, last_login) VALUES
(000000000003, 'armstrong', 'Armstrong', 'Daniel', 'Ebong', 'male', '1995-05-18', 'single', 'College', 'UNIPORT', 'computer', 'Uyo', '', 'Nigeria', '520104', 'Littleguy007', 'armstrongebong@gmail.com', NULL, 'tutor', '0000-00-00 00:00:00.000000', '2017-12-02 13:14:35.000000'),
(000000000004, 'tutor1', 'michael', 'once', 'stranger', 'male', '1995-05-18', 'single', '1', 'uniport', 'computer', 'uyo', 'akwa ibom', 'nigeria', '520104', 'Littleguy007', 'making@gmail.com', '', 'tutor', '2017-11-20 17:17:42.000000', '2017-11-28 14:01:07.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_dept_msg`
--

CREATE TABLE `tutor_dept_msg` (
  mid int NOT NULL,
  qid int CHECK (qid > 0) NOT NULL,
  notice varchar(100) NOT NULL DEFAULT 'Re:',
  dept varchar(20) NOT NULL,
  duration timestamp(6) NOT NULL,
  level enum('notify','alert','confirm','affirm') NOT NULL DEFAULT 'notify' ,
  msg_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all student messages';

--
-- Dumping data for table `tutor_dept_msg`
--

INSERT INTO `tutor_dept_msg` (mid, qid, notice, dept, duration, level, msg_date) VALUES
(2, 2, 'Re:', 'computer', '2018-11-28 00:00:00.000000', 'affirm', '2017-11-28 18:28:55.000000'),
(3, 3, 'Re:', 'computer', '2017-12-28 00:00:00.000000', 'affirm', '2017-11-28 18:52:10.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_dept_msg_seen`
--

CREATE TABLE `tutor_dept_msg_seen` (
  id int CHECK (id > 0) NOT NULL,
  mid int CHECK (mid > 0) NOT NULL,
  uid int CHECK (uid > 0) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor_dept_msg_seen`
--

INSERT INTO `tutor_dept_msg_seen` (id, mid, uid, create_date) VALUES
(1, 1, 3, '2017-11-28 18:09:49.000000'),
(2, 2, 3, '2017-11-28 18:28:59.000000'),
(3, 3, 3, '2017-11-28 18:52:28.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_help`
--

CREATE TABLE `tutor_help` (
  uid int NOT NULL,
  total int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tracks all tutor help offered';

-- --------------------------------------------------------

--
-- Table structure for table `tutor_msg`
--

CREATE TABLE `tutor_msg` (
  mid int NOT NULL,
  qid int NOT NULL,
  notice varchar(100) NOT NULL DEFAULT 'Re:',
  tutor_id int NOT NULL,
  duration timestamp(6) NOT NULL,
  level enum('notify','alert','confirm','affirm') NOT NULL DEFAULT 'notify' ,
  msg_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds all student messages';

--
-- Dumping data for table `tutor_msg`
--

INSERT INTO `tutor_msg` (mid, qid, notice, tutor_id, duration, level, msg_date) VALUES
(1, 1, 'Re:', 3, '0000-00-00 00:00:00.000000', 'affirm', '2017-11-28 18:34:47.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_msg_seen`
--

CREATE TABLE `tutor_msg_seen` (
  id int CHECK (id > 0) NOT NULL,
  mid int CHECK (mid > 0) NOT NULL,
  uid int CHECK (uid > 0) NOT NULL,
  create_date timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor_msg_seen`
--

INSERT INTO `tutor_msg_seen` (id, mid, uid, create_date) VALUES
(1, 1, 3, '2017-11-28 18:41:06.000000');

-- --------------------------------------------------------

--
-- Table structure for table `upload_type`
--

CREATE TABLE `upload_type` (
  id int CHECK (id > 0) NOT NULL,
  name varchar(50) NOT NULL,
  create_date timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE `user_uploads` (
  fid int NOT NULL,
  filename varchar(60) DEFAULT 'Untitled',
  dir varchar(100) DEFAULT 'Unknown ',
  uploader int DEFAULT NULL ,
  upload_type enum('assignment','note','pqa','project') DEFAULT 'assignment' ,
  projtname varchar(100) NOT NULL,
  filetype varchar(50) DEFAULT NULL ,
  upload_date timestamp DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_uploads`
--

INSERT INTO `user_uploads` (fid, filename, dir, uploader, upload_type, projtname, filetype, upload_date) VALUES
(1, 'university-of-delaware-application', 'assets/uploads/assignment/11_17-u1-sfsfd/pdf/university-of-delaware-application.pdf', 1, 'assignment', '11_17-u1-sfsfd', 'application/pdf', '2017-11-28 18:09:46'),
(6, 'screenshot-from-2017-10-07-15-55-55', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-10-07-15-55-55.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:51:06'),
(7, 'screenshot-from-2017-10-07-15-55-55', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-10-07-15-55-55.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:51:24'),
(8, 'screenshot-from-2017-10-07-15-55-55', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-10-07-15-55-55.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:51:43'),
(9, 'screenshot-from-2017-11-07-02-46-39', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-11-07-02-46-39.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:52:10'),
(10, 'screenshot-from-2017-11-07-02-46-51', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-11-07-02-46-51.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:52:10'),
(11, 'screenshot-from-2017-11-07-02-47-09', 'assets/uploads/assignment/img/11_17-u1-addingpix/screenshot-from-2017-11-07-02-47-09.png', 1, 'assignment', '11_17-u1-addingpix', 'image/png', '2017-11-28 18:52:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE departments
  ADD PRIMARY KEY (did),
  ADD KEY `dept` (name);

--
-- Indexes for table `edulevel`
--
ALTER TABLE edulevel
  ADD PRIMARY KEY (id);

--
-- Indexes for table `fields`
--
ALTER TABLE fields
  ADD PRIMARY KEY (fid),
  ADD KEY `name` (name);

--
-- Indexes for table `libraries`
--
ALTER TABLE libraries
  ADD PRIMARY KEY (lid);

--
-- Indexes for table `members`
--
ALTER TABLE members
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `user` (username,email),
  ADD KEY `course` (firstname,lastname,field),
  ADD KEY `middlename` (middlename),
  ADD KEY `dob` (dob),
  ADD KEY `marital_status` (marital_status),
  ADD KEY `education` (edulevel),
  ADD KEY `school` (school),
  ADD KEY `zipcode` (zipcode),
  ADD KEY `state` (state),
  ADD KEY `phone` (phone);

--
-- Indexes for table `questions`
--
ALTER TABLE questions
  ADD PRIMARY KEY (qid),
  ADD KEY `topic` (topic);
ALTER TABLE questions ADD FULLTEXT KEY `message` (message);

--
-- Indexes for table `question_cat`
--
ALTER TABLE question_cat
  ADD PRIMARY KEY (cid);

--
-- Indexes for table `student`
--
ALTER TABLE student
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `user` (username,email),
  ADD KEY `course` (firstname,lastname,field),
  ADD KEY `middlename` (middlename),
  ADD KEY `dob` (dob),
  ADD KEY `marital_status` (marital_status),
  ADD KEY `education` (edulevel),
  ADD KEY `school` (school),
  ADD KEY `zipcode` (zipcode),
  ADD KEY `state` (state),
  ADD KEY `phone` (phone);

--
-- Indexes for table `student_dept_msg`
--
ALTER TABLE student_dept_msg
  ADD PRIMARY KEY (mid);

--
-- Indexes for table `student_dept_msg_seen`
--
ALTER TABLE student_dept_msg_seen
  ADD PRIMARY KEY (id);

--
-- Indexes for table `student_help`
--
ALTER TABLE student_help
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `student_help_uid_uindex` (uid);

--
-- Indexes for table `student_msg`
--
ALTER TABLE student_msg
  ADD PRIMARY KEY (mid);

--
-- Indexes for table `student_msg_seen`
--
ALTER TABLE student_msg_seen
  ADD PRIMARY KEY (id);

--
-- Indexes for table `superusers`
--
ALTER TABLE superusers
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `username` (username),
  ADD UNIQUE KEY `email` (email),
  ADD KEY `names` (firstname,lastname);

--
-- Indexes for table `task`
--
ALTER TABLE task
  ADD PRIMARY KEY (tid);

--
-- Indexes for table `tutor`
--
ALTER TABLE tutor
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `user` (username,email),
  ADD KEY `course` (firstname,lastname,field),
  ADD KEY `middlename` (middlename),
  ADD KEY `dob` (dob),
  ADD KEY `marital_status` (marital_status),
  ADD KEY `education` (edulevel),
  ADD KEY `school` (school),
  ADD KEY `zipcode` (zipcode),
  ADD KEY `state` (state),
  ADD KEY `phone` (phone);

--
-- Indexes for table `tutor_dept_msg`
--
ALTER TABLE tutor_dept_msg
  ADD PRIMARY KEY (mid);

--
-- Indexes for table `tutor_dept_msg_seen`
--
ALTER TABLE tutor_dept_msg_seen
  ADD PRIMARY KEY (id);

--
-- Indexes for table `tutor_help`
--
ALTER TABLE tutor_help
  ADD PRIMARY KEY (uid),
  ADD UNIQUE KEY `tutor_help_uid_uindex` (uid);

--
-- Indexes for table `tutor_msg`
--
ALTER TABLE tutor_msg
  ADD PRIMARY KEY (mid);

--
-- Indexes for table `tutor_msg_seen`
--
ALTER TABLE tutor_msg_seen
  ADD PRIMARY KEY (id);

--
-- Indexes for table `upload_type`
--
ALTER TABLE upload_type
  ADD PRIMARY KEY (id);

--
-- Indexes for table `user_uploads`
--
ALTER TABLE user_uploads
  ADD PRIMARY KEY (fid);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE departments
  MODIFY did cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `edulevel`
--
ALTER TABLE edulevel
  MODIFY id cast(6 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE fields
  MODIFY fid cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE libraries
  MODIFY lid cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE members
  MODIFY uid cast(12 as int) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'user ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE questions
  MODIFY qid cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Question ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question_cat`
--
ALTER TABLE question_cat
  MODIFY cid cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE student
  MODIFY uid cast(12 as int) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'user ID', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_dept_msg`
--
ALTER TABLE student_dept_msg
  MODIFY mid cast(12 as int) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_dept_msg_seen`
--
ALTER TABLE student_dept_msg_seen
  MODIFY id cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_msg`
--
ALTER TABLE student_msg
  MODIFY mid cast(12 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_msg_seen`
--
ALTER TABLE student_msg_seen
  MODIFY id cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `superusers`
--
ALTER TABLE superusers
  MODIFY uid cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE task
  MODIFY tid cast(11 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE tutor
  MODIFY uid cast(12 as int) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'user ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tutor_dept_msg`
--
ALTER TABLE tutor_dept_msg
  MODIFY mid cast(12 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tutor_dept_msg_seen`
--
ALTER TABLE tutor_dept_msg_seen
  MODIFY id cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tutor_msg`
--
ALTER TABLE tutor_msg
  MODIFY mid cast(12 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutor_msg_seen`
--
ALTER TABLE tutor_msg_seen
  MODIFY id cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_type`
--
ALTER TABLE upload_type
  MODIFY id cast(12 as int) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE user_uploads
  MODIFY fid cast(11 as int) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
