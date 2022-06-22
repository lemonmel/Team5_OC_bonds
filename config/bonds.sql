-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2022 at 06:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonds`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ic` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ic`, `password`, `name`, `email`) VALUES
('111', '698d51a19d8a121ce581499d7b701668', 'Mr.admin', 'maychin0205@gmail.com'),
('123', '21232f297a57a5a743894a0e4a801fc3', 'Mr.admin', 'maychin0205@gmail.com'),
('123123', '4297f44b13955235245b2497399d7a93', 'Mr.admin', 'maychin0205@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `title`, `description`, `date_time`) VALUES
(1, 'HARI GOTONG ROYONG', 'Hey there BONDS resident, you are invited to our HARI GOTONG ROYONG on 20/06/2022. Please gather at the community hall at 9AM. Food and beverages are preapred after the event. See you there!', '2022-06-15 00:00:00'),
(2, 'A-03-G1 Gymnasium Maintenance', 'Hey there BONDS resident, Please be informed the gymnasium located A-03-G1 will be closed from 21/06/2022 to 25/06/2022 as undergoes facilities maintenance and electricity maintenance. Kindly visit other block gymnasium. Thanks!', '2022-06-10 00:00:00'),
(3, 'Electricity Maintenance in Block C', 'Hey there BONDS BLOCK C resident, Please be informed that there will be electricity maintenance on 01/07/2022. Power supply will be shutted down from 2PM to 4PM. Sorry for any inconvenience caused. Thank you.', '2022-06-14 09:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `covidcases`
--

CREATE TABLE `covidcases` (
  `date` date NOT NULL,
  `new` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `recover` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `covidcases`
--

INSERT INTO `covidcases` (`date`, `new`, `active`, `recover`) VALUES
('2022-05-01', 3, 3, 0),
('2022-05-02', 7, 10, 0),
('2022-05-03', 9, 19, 0),
('2022-05-04', 3, 21, 0),
('2022-05-05', 1, 17, 5),
('2022-05-06', 0, 12, 5),
('2022-05-07', 1, 11, 0),
('2022-05-08', 2, 13, 0),
('2022-05-09', 1, 7, 7),
('2022-05-10', 3, 10, 0),
('2022-05-11', 2, 12, 0),
('2022-05-12', 5, 15, 2),
('2022-05-13', 3, 15, 3),
('2022-05-14', 1, 9, 5),
('2022-05-15', 0, 9, 0),
('2022-05-16', 0, 6, 3),
('2022-05-17', 0, 1, 5),
('2022-05-18', 2, 3, 0),
('2022-05-19', 2, 5, 0),
('2022-05-20', 3, 8, 0),
('2022-05-21', 4, 12, 0),
('2022-05-22', 1, 13, 0),
('2022-05-23', 7, 20, 0),
('2022-05-24', 0, 15, 5),
('2022-05-25', 3, 18, 0),
('2022-05-26', 2, 13, 0),
('2022-05-27', 2, 15, 0),
('2022-05-28', 0, 7, 8),
('2022-05-29', 0, 4, 3),
('2022-05-30', 3, 6, 1),
('2022-05-31', 5, 10, 1),
('2022-06-10', 7, 12, 5),
('2022-06-11', 5, 17, 0),
('2022-06-12', 0, 9, 8),
('2022-06-13', 2, 6, 5),
('2022-06-14', 8, 12, 2),
('2022-06-15', 4, 6, 10),
('2022-06-16', 10, 11, 5),
('2022-06-17', 2, 9, 4),
('2022-06-18', 1, 7, 3),
('2022-06-19', 0, 7, 0),
('2022-06-20', 2, 7, 2),
('2022-06-21', 7, 9, 5),
('2022-06-22', 8, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `reporter_unit` varchar(20) NOT NULL,
  `report_type` varchar(20) NOT NULL,
  `report_for_status` varchar(30) NOT NULL,
  `evidence` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `covidreport`
--

INSERT INTO `report` (`report_id`, `reporter_unit`, `report_type`, `report_for_status`, `evidence`, `date`) VALUES
(101, 'A-5-09', 'vaccine', '2nd Dose', 'assets/images/pcrtest.jpg', '2022-06-21'),
(102, 'B-4-14', 'vaccine', '1st Dose', 'assets/images/pcrtest.jpg', '2022-06-21'),
(103, 'D-3-33', 'covid', 'Positive', 'assets/images/pcrtest.jpg', '2022-06-21'),
(105, 'D-4-04', 'covid', 'Positive', 'assets/images/pcrtest.jpg', '2022-06-22'),
(106, 'A-5-05', 'covid', 'Negative', 'assets/images/pcrtest.jpg', '2022-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `explore`
--

CREATE TABLE `explore` (
  `facility_addr` varchar(30) NOT NULL,
  `facility_name` varchar(50) NOT NULL,
  `facility_type` varchar(30) NOT NULL,
  `operating_time` varchar(30) NOT NULL,
  `operating_day` varchar(50) NOT NULL,
  `facility_status` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `explore`
--

INSERT INTO `explore` (`facility_addr`, `facility_name`, `facility_type`, `operating_time`, `operating_day`, `facility_status`, `image`) VALUES
('A-03-D1', 'Garden', 'leisure', '10am - 11pm', 'Monday to Friday', 'Under Maintenance', 'https://media.istockphoto.com/photos/wooden-terrace-surrounded-by-greenery-picture-id957245348?k=20&m=957245348&s=612x612&w=0&h=_-NlF-OmeZPqBIolsVJMVXfZeAKZQJKoyI_wbCvpsLQ='),
('A-03-E1', 'Study Room', 'others', '10am - 11pm', 'Monday to Friday', 'Closed', 'https://media.istockphoto.com/photos/home-office-picture-id1211584942?k=20&m=1211584942&s=612x612&w=0&h=ZBqglfoRV2CdN5LRB3OPbuYi1a-fH8GVSQtr1A-Qsq0='),
('A-03-G1', 'Gymnasium', 'sports', '10am - 11pm', 'Monday to Friday', 'Under Maintenance', 'https://media.istockphoto.com/photos/modern-gym-picture-id492061477?k=20&m=492061477&s=612x612&w=0&h=b_r1Ydu6FolOFQjV7INSIM0fOqO7HCQfUJx-Zb1QXP4='),
('A-03-J1', 'Jogging Track', 'sports', '10am - 11pm', 'Monday to Friday', 'Opened', 'https://media.istockphoto.com/photos/track-and-field-training-lanes-picture-id92206727?k=20&m=92206727&s=612x612&w=0&h=I3MVf9LQyYyawdDtXnsF7jsA_P1aMiA3h9AcVw4y0B4='),
('A-03-K1', 'Basketball Court', 'sports', '10am - 11pm', 'Monday to Friday', 'Under Maintenance', 'https://media.istockphoto.com/photos/portrait-of-gym-and-parquet-basketball-court-picture-id1203692557?k=20&m=1203692557&s=612x612&w=0&h=iwwQ5myVlXd5uaXxsB0dobfAXBzZBkMw_Jc1eEOgCcc='),
('A-03-L1', 'Spa pool', 'leisure', '10am - 11pm', 'Saturday to Sunday', 'Opened', 'https://media.istockphoto.com/photos/modern-spa-interior-picture-id468392059?k=20&m=468392059&s=612x612&w=0&h=csMeRQWZlm80UToggc1asIC9ydcXo57p_GolYQ3qOo4='),
('A-03-P1', 'Park', 'leisure', '10am - 11pm', 'Monday to Friday', 'Opened', 'https://media.istockphoto.com/photos/the-parks-meadows-and-thick-woods-under-the-clear-sky-in-spring-picture-id1211975936?k=20&m=1211975936&s=612x612&w=0&h=DvSUQJ_ZI9yw8c0VN9FxRv73RIZ6v1RBqrlM6Uctf2c='),
('A-03-Q1', 'BBQ Area', 'leisure', '10am - 11pm', 'Saturday to Sunday', 'Closed', 'https://media.istockphoto.com/photos/backyard-hardscape-patio-with-outdoor-barbecue-and-kitchen-picture-id1211179492?k=20&m=1211179492&s=612x612&w=0&h=iB47qirdN4imGek4cb7btNl8eG58yxoiGGdTa8JkWn8='),
('A-03-R1', 'Party Room', 'others', '10am - 11pm', 'Saturday to Sunday', 'Closed', 'https://media.istockphoto.com/photos/halloween-food-table-picture-id1183577476?k=20&m=1183577476&s=612x612&w=0&h=30lji704Yivz_72Uq0syZ7MNP8UQBVN53SJt1ageaUg='),
('A-03-S1', 'Swimming Pool', 'sports', '10am - 11pm', 'Saturday to Sunday', 'Opened', 'https://media.istockphoto.com/photos/swimming-pool-accented-with-a-waterfall-picture-id134108091?k=20&m=134108091&s=612x612&w=0&h=It4OD29epLpx3glQlVAckdezTu7dmdt-Ei3XoHfeFVw='),
('A-03-U1', 'Sauna Room', 'leisure', '10am - 11pm', 'Saturday to Sunday', 'Closed', 'https://media.istockphoto.com/photos/interior-of-finnish-sauna-classic-wooden-sauna-picture-id827324092?k=20&m=827324092&s=612x612&w=0&h=XZPjWGaqnoVGkVc5K5Jf_4V-gLeqeM_uPwwASi_4Zvs='),
('A-03-Y1', 'Yoga Studio', 'others', '10am - 11pm', 'Saturday to Sunday', 'Opened', 'https://media.istockphoto.com/photos/limited-people-yoga-class-in-studio-during-covid19-pandemic-picture-id1249327712?k=20&m=1249327712&s=612x612&w=0&h=fuOaQbsrAdLQXWxbJh1nCYmNw65buYzieDBkCDpAWtE='),
('A-03-Z1', 'Jacuzzi', 'leisure', '10am - 11pm', 'Monday to Friday', 'Closed', 'https://media.istockphoto.com/photos/outdoor-living-picture-id181087270?k=20&m=181087270&s=612x612&w=0&h=pMCOnJ1nPmvvHmRVLGsghQcquTU_N8U4Jl9FgSoFbPA='),
('B-03-C1', 'Community Hall', 'others', '10am - 11pm', 'Saturday to Sunday', 'Under Maintenance', 'https://media.istockphoto.com/photos/committee-chairperson-presents-plan-for-beautification-at-homeowners-picture-id1158889642?k=20&m=1158889642&s=612x612&w=0&h=W62gu5jCoJuF_sH8agmN9o-6xQS273MtDmG0MKZCiWw='),
('B-03-M1', 'Movie Theater', 'leisure', '10am - 11pm', 'Saturday to Sunday', 'Opened', 'https://media.istockphoto.com/photos/empty-cinema-screen-with-audience-picture-id453554783?k=20&m=453554783&s=612x612&w=0&h=SWzx0yaI4h_QFnOF-GI5yDHyZyQdjPzen3mXyx7ddbY='),
('B-03-M2', 'Music Studio', 'others', '10am - 11pm', 'Monday to Friday', 'Closed', 'https://media.istockphoto.com/photos/electrical-equipment-for-recording-and-computer-monitor-on-workplace-picture-id1176082550?k=20&m=1176082550&s=612x612&w=0&h=IiXsDvOcfSBOL_2RZTNnJRPQoairUm3sk9xyOwNAz1w='),
('B-03-N1', 'Billiards Room', 'others', '10am - 11pm', 'Monday to Friday', 'Opened', 'https://media.istockphoto.com/photos/coworkers-hanging-out-in-a-bar-picture-id913805620?k=20&m=913805620&s=612x612&w=0&h=LOZynCwMca7l9pZjBUndY2Xb6c1Z7HhDKHSrGLfweHE='),
('B-03-O1', 'Golf Course', 'sports', '10am - 11pm', 'Saturday to Sunday', 'Closed', 'https://media.istockphoto.com/photos/golf-course-in-autumn-at-sunset-picture-id118442928?k=20&m=118442928&s=612x612&w=0&h=jmz9s_qelnfUU57jnSMqgkHi53HbZOLC3mo2LaQyBMw='),
('B-03-T1', 'Tennis Court', 'sports', '10am - 11pm', 'Monday to Friday', 'Opened', 'https://media.istockphoto.com/photos/small-blue-asphalt-neighborhood-tennis-court-surrounded-by-green-picture-id1015585614?k=20&m=1015585614&s=612x612&w=0&h=S0cueZZuaGYeN3Ceo0g1Wt2VALxkH-xb1uITd69S4_w='),
('C-03-A1', 'Playground', 'leisure', '10am - 11pm', 'Saturday to Sunday', 'Under Maintenance', 'https://media.istockphoto.com/photos/colorful-playground-equipment-picture-id898182848?k=20&m=898182848&s=612x612&w=0&h=LR0SnWTuQrEJGMaipiC8MP6dhF6GHpO3vOrQlquZnQE='),
('C-03-B1', 'Badminton Court', 'sports', '10am - 11pm', 'Monday to Friday', 'Opened', 'https://media.istockphoto.com/photos/aerial-view-of-badminton-court-inside-condominium-picture-id827338538?k=20&m=827338538&s=612x612&w=0&h=YiPWcdlZF4nw-5Kr_xhQs7IHLGxFLSLi0GOZ0Ky2hxM='),
('C-03-F1', 'Football Pitch', 'sports', '10am - 11pm', 'Saturday to Sunday', 'Closed', 'https://media.istockphoto.com/photos/fiftyyard-line-of-football-field-at-night-picture-id160197981?k=20&m=160197981&s=612x612&w=0&h=uJ_PF8K5QdB9DphNKlpEj6GifVg_osn64mimZyIXwkI='),
('C-03-H1', 'Hobby Room', 'others', '10am - 11pm', 'Saturday to Sunday', 'Under Maintenance', 'https://media.istockphoto.com/photos/waiting-to-be-played-picture-id1168477313?k=20&m=1168477313&s=612x612&w=0&h=aqNukICHNOqXFEaMcXxxEQ1D9eiMdFk7-n36wWEr1UQ='),
('C-03-X1', 'Library', 'others', '10am - 11pm', 'Saturday to Sunday', 'Opened', 'https://media.istockphoto.com/photos/books-on-display-in-the-corner-of-a-second-hand-bookstore-picture-id1129874863?k=20&m=1129874863&s=612x612&w=0&h=FIL5hSudy89ghOg-LUz0neEokerGQreoRfe3DYFq6E0=');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `ic` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `race` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `check_in_date` datetime NOT NULL,
  `profile_pic` varchar(500) NOT NULL,
  `covid_status` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vaccine_status` varchar(30) NOT NULL,
  `rental_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`ic`, `name`, `dob`, `gender`, `race`, `contact`, `emergency_contact`, `email`, `check_in_date`, `profile_pic`, `covid_status`, `password`, `vaccine_status`, `rental_status`) VALUES
('010101-01-0111', 'Mikasa ', '2001-01-01', 'Other', 'Other', '011-1100110', '011-0011001', 'mikasa@aot.com', '2022-06-15 17:43:28', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', 'Not Vaccinated At All', 'renting'),
('010201-04-0201', 'Yan Tze ', '2001-02-01', 'Female', 'Chinese', '014-9846555', '014-9846555', 'yantze@aot.com', '2022-06-15 19:43:28', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', 'Not Vaccinated At All', 'renting'),
('010305-07-0305', 'Siti Hatizah', '2001-03-05', 'Female', 'Malay', '017-5435454', '017-5435454', 'sthatizah@hotmail.com', '2022-06-15 17:35:29', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('010307-07-0307', 'Kanegeswaran Sivam', '2001-03-07', 'Male', 'Indian', '014-9885454', '014-9885454', 'geswaran@gmail.com', '2022-05-09 06:45:14', 'assets/images/profile-image.png', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '1st Dose', 'renting'),
('010606-06-0899', 'Fatimah Moo', '2001-06-06', 'Female', 'Malay', '011-6600889', '011-9988006', 'fatimah@hotmail.com', '2022-06-15 17:44:29', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('010616-14-1303', 'Lei Zhi Guang', '2001-06-16', 'Male', 'Chinese', '013-6247251', '016-6030616', 'leizhiguang1@gmail.com', '2022-05-09 04:45:14', 'assets/images/profile-image.png', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '1st Dose', 'request to stop'),
('1', 'Kudou Shinyii', '2012-05-01', 'Male', 'Malay', '012-0501001', '012-0501002', 'shinyi@conan.com', '2022-05-28 08:48:04', 'assets/images/conan.jpg', 'Positive', 'c4ca4238a0b923820dcc509a6f75849b', 'Not Vaccinated At All', 'renting'),
('11', 'Ms Water', '2022-06-29', 'Female', 'Chinese', '01256789', '1241241524', 'water@earth.com', '2022-06-18 00:37:59', 'assets/images/cb08f82a6b15af05987d3452020e8ab4.jpg', 'Positive', '9460370bb0ca1c98a779b1bcc6861c2c', '2nd Dose', 'renting'),
('2', 'Kobe Bryant', '2022-05-28', 'Male', 'Malay', '011-1111111', '012-2222222', 'kobe@lakers.com', '2022-05-28 08:48:04', 'assets/images/kobe.jpg', 'Negative', 'c81e728d9d4c2f636f067f89cc14862c', '1st Dose', 'renting'),
('4', 'Zhang Ji Ke', '2022-05-28', 'Male', 'Chinese', '880-3219019', '880-9273012', 'zhangjike@butterfly.com', '2022-05-28 08:48:04', 'assets/images/zhangjike.png', 'Negative', 'a87ff679a2f3e71d9181a67b7542122c', '3rd Dose (Booster)', 'request to stop'),
('681225-09-8263', 'Ms Five', '1968-12-25', 'Female', 'Indian', '012-2502111', '012-1125021', 'samantha@outlook.com', '2022-06-16 22:39:03', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('710701-09-0911', 'Mei Thong Thong', '1971-07-01', 'Female', 'Chinese', '017-7911001', '017-0017799', 'meithong99@outlook.com', '2022-06-15 18:08:32', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('780912-02-1923', 'Levis Garingee', '1978-09-12', 'Male', 'Malay', '017-8091212', '017-0892121', 'levis@yahoo.com', '2022-06-15 17:51:33', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '2nd Dose', 'request to stop'),
('790204-04-0044', 'Clark Kent', '1979-02-04', 'Male', 'Indian', '019-5653333', '019-5653333', 'super@justice.com', '2022-06-15 11:09:32', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '1st Dose', 'renting'),
('840702-07-4555', 'John Rambo', '1984-07-02', 'Male', 'Indian', '013-9939993', '013-9939993', 'shoot@guns.com', '2022-06-16 21:39:03', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('880904-01-0433', 'Barry Allen', '1988-09-04', 'Male', 'Malay', '012-3434333', '012-3434333', 'flash@justice.com', '2022-06-15 13:51:33', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', '2nd Dose', 'renting'),
('910405-07-0405', 'Uzumaki Naruto', '1991-04-05', 'Male', 'Chinese', '017-7756666', '017-7756666', 'fourth@hokage.com', '2022-05-28 09:58:04', 'assets/images/conan.jpg', 'Positive', 'c4ca4238a0b923820dcc509a6f75849b', 'Not Vaccinated At All', 'renting'),
('910408-07-0405', 'Steve Apple', '1991-04-08', 'Male', 'Other', '011-1231231', '011-123123', 'maker@apple.com', '2022-06-18 02:37:59', 'assets/images/cb08f82a6b15af05987d3452020e8ab4.jpg', 'Positive', '9460370bb0ca1c98a779b1bcc6861c2c', '2nd Dose', 'renting'),
('920501-02-0521', 'Zhing Yi ', '1992-05-01', 'Female', 'Chinese', '012-1133311', '012-1133311', 'zhingyi@aot.com', '2022-06-15 18:43:28', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', 'Not Vaccinated At All', 'renting'),
('920621-01-3427', 'Chewbacca Wookie', '1992-06-21', 'Male', 'Other', '011-2342333', '011-2342333', 'rawr@starwars.com', '2022-06-15 21:08:32', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '3rd Dose (Booster)', 'renting'),
('930405-03-0955', 'Ryan Renolds', '1993-04-05', 'Male', 'Malay', '019-9898877', '019-9898877', 'deadpool@marvel.com', '2022-05-28 12:48:04', 'assets/images/kobe.jpg', 'Negative', 'c81e728d9d4c2f636f067f89cc14862c', '1st Dose', 'renting'),
('951203-08-1234', 'Donki Don', '1995-12-03', 'Female', 'Indian', '019-1203551', '019-3021115', 'donki@dondon.com', '2022-06-15 17:52:51', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', '2nd Dose', 'renting'),
('980705-07-0511', 'Jackie Chan', '1998-07-05', 'Male', 'Chinese', '012-2323233', '012-2323233', 'master@kungfu.com', '2022-05-28 22:48:04', 'assets/images/zhangjike.png', 'Positive', 'a87ff679a2f3e71d9181a67b7542122c', '3rd Dose (Booster)', 'renting'),
('990403-06-4455', 'Bruce Wayne', '1999-04-03', 'Male', 'Chinese', '014-1544455', '014-1544455', 'bat@justice.com', '2022-06-15 12:52:51', 'assets/images/defaultProPic.jpg', 'Negative', 'ee63700a92c5b6a61802e226ed995c05', '2nd Dose', 'renting'),
('991212-12-1222', 'Chris Muulai', '1999-12-12', 'Female', 'Chinese', '012-9912211', '019-2219112', 'chris@gmail.com', '2022-06-15 18:09:32', 'assets/images/defaultProPic.jpg', 'Positive', 'ee63700a92c5b6a61802e226ed995c05', '1st Dose', 'renting');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `rating` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(30) NOT NULL,
  `service` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `hours` varchar(30) NOT NULL,
  `reviews` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`name`, `type`, `location`, `rating`, `image`, `category`, `service`, `address`, `hours`, `reviews`, `phone`) VALUES
('A&W', 'foods', 'Petaling Jaya', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/3670c01d812f9e0dc3efc04f0b5b1cfb/w380-crop.png', 'FAST FOOD RESTAURANT', 'Dine-in · Drive-through · No-contact delivery', 'No 9, Lorong Sultan, Pjs 52, 46000 PJ, Selangor', '8am - 12am (Mon - Fri)', '4.1 ⭐⭐⭐⭐(3,417 Reviews)', '03-7932 4533'),
('ABU ICE', 'beverages', '1 Utama Shopping Centre', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/26e7a146ed00cbd46b793630214e2dc0/w512.png', 'CAFE', 'Takeaway · No-contact delivery', '1 Utama Shopping Centre, PJ', '7.45am - 9pm (Mon - Fri)', '3.8 ⭐⭐⭐(115 Reviews)', '03-8864 4733'),
('AEON (Homes, Sports & Outdoor)', 'shop', 'Amcorp Mall', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/aeon-md.jpg', 'SHOPPING MALL', 'Purchasing Homes & Outdoor equipment', 'G-01, Ground Floor, Amcorp Tower', '8am - 8pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(193 Reviews)', '03-7931 4019'),
('Ah Cheng Laksa', 'foods', 'NU Sentral', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/2cd3cf71024b9f8c4b5daeb25f8f434a/w380-crop.png', 'RESTAURANT', 'Dine-in · Takeaway', 'LG-16, NU SENTRAL, KL Sentral', '10am - 8pm (Mon - Fri)', '3.7 ⭐⭐⭐(76 Reviews)', '013-957 2576'),
('Ai Home', 'facility', '1 Utama Shopping Centre', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/LOGO22May2020145723.jpg', 'SMART HOME', 'Ai Home Equipment Shopping', '1 Utama Shopping Centre, PJ', '7.45am - 9pm (Mon - Fri)', '3.8 ⭐⭐⭐(115 Reviews)', '03-8864 4733'),
('Alphamax', 'facility', 'KL Sentral', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Alphamaxlogo_Desk25May2016170354.jpg', 'SAFE & VAULT SHOP', 'Safe & Vault', 'Jalan Stesen Sentral 3, KL Sentral', '7am - 10pm (Mon - Fri)', '3.4 ⭐⭐⭐(36 Reviews)', '03-7622 8542'),
('Asics', 'shop', 'Kompleks Sogo', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/asics_logo_desktop29Mar2017170154.jpg', 'SHOE STORE', 'Purchasing Shoe', 'Kompleks Sogo, 50100 Kuala Lumpur', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(42 Reviews)', '013-957 2576'),
('Bookstore Popular', 'shop', '1 Utama Shopping Centre', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Logo08Oct2018114210.jpg', 'BOOKSTORE', 'Purchasing Books', '1 Utama Shopping Centre, PJ', '7.45am - 9pm (Mon - Fri)', '3.8 ⭐⭐⭐(115 Reviews)', '03-8864 4733'),
('BOOST JUICE', 'beverages', 'Kompleks Sogo', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/57b84a41a4047b6a3357ad9632b07c6e/w512.png', 'JUICE SHOP', 'Dine-in · Takeaway · Delivery', 'Kompleks Sogo, 50100 Kuala Lumpur', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(42 Reviews)', '013-957 2576'),
('Burger King', 'foods', 'Kuala Lumpur Sentral', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/50d27a0c78a15a18e3ae7eb6315066a8/w380-crop.png', 'FAST FOOD RESTAURANT', 'Dine-in · Takeaway · No-contact delivery', 'Kl City Air Teminal, DH 3A, KL Sentral', '7am - 10pm (Mon - Fri)', '3.3 ⭐⭐⭐(380 Reviews)', '03-3362 6526'),
('Caring Pharmacy', 'facility', 'Amcorp Mall', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/caring-md.jpg', 'PHARMACY', 'Purchasing Medicines', 'G-01, Ground Floor, Amcorp Tower', '8am - 8pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(193 Reviews)', '03-7931 4019'),
('CHATIME', 'beverages', 'KL Sentral', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/43a5bfd60fbc465a758fe086c92af95d/w512.png', 'CAFE', 'Dine-in · Takeaway · Delivery', 'Jalan Stesen Sentral 3, KL Sentral', '7am - 10pm (Mon - Fri)', '3.4 ⭐⭐⭐(36 Reviews)', '03-7622 8542'),
('Dubuyo', 'foods', 'Nu Sentral', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/e9883263d6f52a06139b661bcb763645/w380-crop.png', 'KOREAN RESTAURANT', 'Dine-in · Takeaway · Delivery', 'L4, 04, Level 04, Nu Sentral Shopping center', '10am - 8am (Mon - Fri)', '3.5 ⭐⭐⭐(352 Reviews)', '03-2276 1254'),
('Easy Heng', 'foods', 'Taman Ibu Kota', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/e6e07e83d310ea16f0a93d6b430f74b5/w380-crop.png', 'RESTAURANT', 'Dine-in · Drive-through · No-contact delivery', 'G-36, 67, Jln Taman Ibu Kota, KL', '8am - 12am (Mon - Fri)', '3.0 ⭐⭐⭐(8 Reviews)', '03-6731 1452'),
('Empire Sushi', 'foods', '1 Utama Shopping Centre', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/de02a336b2d2983caf1a45e6ccd62937/w380-crop.png', 'SUSHI', 'Sushi Takeaway', '1 Utama Shopping Centre, 1, Lebuh Bandar Utama PJ', '11am - 8pm (Mon - Fri)', '4.0 ⭐⭐⭐⭐(7 Reviews)', '03-8864 4733'),
('ExcelView Eye Specialist Centre', 'facility', 'Kepong Menjalara', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/logo16Nov2021085435.jpg', 'LASIK SURGEON', 'Eye Lasik', 'No 9, Lorong Sultan, Pjs 52, 46000 PJ, Selangor', '10am - 11pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(229 Reviews)', '03-7932 4533'),
('Faber-Castell', 'shop', 'KL Sentral', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/faber-md.jpg', 'PEN STORE', 'Purchasing Stationery', 'Jalan Stesen Sentral 3, KL Sentral', '7am - 10pm (Mon - Fri)', '3.4 ⭐⭐⭐(36 Reviews)', '03-7622 8542'),
('Fitness Concept', 'entertainment', 'Amcorp Mall', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/fitnessconcept-md.jpg', 'FITNESS', 'Purchasing Fitness Equipment', 'G-01, Ground Floor, Amcorp Tower', '8am - 8pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(193 Reviews)', '03-7931 4019'),
('Focus Point Signature', 'facility', 'Mid Valley City', '⭐⭐', 'https://www.midvalley.com.my/img/tenant/focuspointsignature_logo_desktop26May2014155415.jpg', 'OPTICIAN', 'Purchasing Spectacles', 'LG-K08B, The Gardens Mall, Mid Valley City', '10am - 10pm (Mon - Fri)', '2.4 ⭐⭐(27 Reviews)', '03-6731 1452'),
('Gamer\'s Hideout', 'entertainment', 'Nu Sentral', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Gamer\'sHideout_LogoDesktop08Dec2015192343.jpg', 'GAMING AND CONSOLE', 'Purchasing Gaming Console', 'Kuala Lumpur Sentral, 50470 KL', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(53 Reviews)', '03-6151 8581'),
('Gintell', 'facility', 'Kompleks Sogo', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/gintell_logo_desktop25Aug2017110901.jpg', 'MASSAGE SUPPLY STORE', 'Body Massage', 'Kompleks Sogo, 50100 Kuala Lumpur', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(42 Reviews)', '013-957 2576'),
('Golden Screen Cinemas', 'entertainment', 'Kepong Menjalara', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/LOGO02Nov2020132332.jpg', 'MOVIES', 'Watching Movies', 'No 9, Lorong Sultan, Pjs 52, 46000 PJ, Selangor', '10am - 11pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(229 Reviews)', '03-7932 4533'),
('LEGO', 'shop', 'Nu Sentral', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Logo18Oct2018180805.jpg', 'TOY STORE', 'Purchasing Lego', 'Kuala Lumpur Sentral, 50470 KL', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(53 Reviews)', '03-6151 8581'),
('LEGO®️ Certified Store', 'entertainment', 'Mid Valley City', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Logo18Oct2018180805.jpg', 'LEGO', 'Purchasing Lego', 'The Gardens Mall, Mid Valley City, 58000 KL', '10am - 8am (Mon - Fri)', '3.6 ⭐⭐⭐(80 Reviews)', '03-2284 9328'),
('Llao Llao', 'beverages', 'Nu Sentral', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/2b6d61d97593eed9859208ef36e98bde/w512.png', 'FROZEN YOGURT SHOP', 'Dine-in · Takeaway', 'Kuala Lumpur Sentral, 50470 KL', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(53 Reviews)', '03-6151 8581'),
('MPH Bookstores', 'entertainment', 'Kompleks Sogo', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/mph-md.jpg', 'BOOKSTORE', 'Purchasing Books', 'Kompleks Sogo, 50100 Kuala Lumpur', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(42 Reviews)', '013-957 2576'),
('Mr D.I.Y.', 'shop', 'Mid Valley City', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/MrDIY_Logo_Desktop23Jan2018162407.jpg', 'HOME IMPROVEMENT STORE', 'Purchasing DIY Materials', 'The Gardens Mall, Mid Valley City, 58000 KL', '10am - 8am (Mon - Fri)', '3.6 ⭐⭐⭐(80 Reviews)', '03-2284 9328'),
('OPTICAL 88', 'facility', 'Mid Valley City', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/optical88_logo_desktop03May2016095323.jpg', 'OPTICIAN', 'Purchasing Spectacles', 'The Gardens Mall, Mid Valley City, 58000 KL', '10am - 8am (Mon - Fri)', '3.6 ⭐⭐⭐(80 Reviews)', '03-2284 9328'),
('Popular Bookstore', 'entertainment', 'KL Sentral', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/Logo08Oct2018114210.jpg', 'BOOKSTORE', 'Purchasing Books', 'Jalan Stesen Sentral 3, KL Sentral', '7am - 10pm (Mon - Fri)', '3.4 ⭐⭐⭐(36 Reviews)', '03-7622 8542'),
('STARBUCKS COFFEE', 'beverages', 'Amcorp Mall', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/ffc64dcf6a96268c4a1e4ab380af93ba/w512.png', 'CAFE', 'Dine-in · Takeaway', 'G-01, Ground Floor, Amcorp Tower', '8am - 8pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(193 Reviews)', '03-7931 4019'),
('The Home+Care Shop', 'facility', 'Nu Sentral', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/the-home-care-shop_logo_desktop15Sep2015151632.jpg', 'MEDICAL SUPPLY STORE', 'Purchasing Home Care Equipment', 'Kuala Lumpur Sentral, 50470 KL', '10am - 10pm (Mon - Fri)', '4.1 ⭐⭐⭐⭐(53 Reviews)', '03-6151 8581'),
('The Roof', 'entertainment', 'Mid Valley City', '⭐⭐', 'https://www.1utama.com.my/images/tenant/theRoof.jpg', 'ENTERTAINMENT', 'Entertainment', 'LG-K08B, The Gardens Mall, Mid Valley City', '10am - 10pm (Mon - Fri)', '2.4 ⭐⭐(27 Reviews)', '03-6731 1452'),
('Toys\'R\'Us', 'entertainment', '1 Utama Shopping Centre', '⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/toysrus_logo_desktop23May2014104546.jpg', 'TOYS', 'Purchasing Toys', '1 Utama Shopping Centre, PJ', '7.45am - 9pm (Mon - Fri)', '3.8 ⭐⭐⭐(115 Reviews)', '03-8864 4733'),
('Watsons', 'shop', 'Mid Valley City', '⭐⭐', 'https://www.midvalley.com.my/img/tenant/watson_logo_desktop28Sep2017121638.jpg', 'PHARMACY', 'Purchasing Medicine', 'LG-K08B, The Gardens Mall, Mid Valley City', '10am - 10pm (Mon - Fri)', '2.4 ⭐⭐(27 Reviews)', '03-6731 1452'),
('Yamaha', 'shop', 'Kepong Menjalara', '⭐⭐⭐⭐', 'https://www.midvalley.com.my/img/tenant/yamaha-md.jpg', 'MOTORCYCLE DEALER', 'Vehicle Purchasing & Repairing', 'No 9, Lorong Sultan, Pjs 52, 46000 PJ, Selangor', '10am - 11pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(229 Reviews)', '03-7932 4533'),
('YOMIE\'S RICE X YOGURT', 'beverages', 'Mid Valley City', '⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/79ef9037998a6295972d666b77302737/w512.png', 'FROZEN YOGURT SHOP', 'Dine-in · Takeaway', 'LG-K08B, The Gardens Mall, Mid Valley City', '10am - 10pm (Mon - Fri)', '2.4 ⭐⭐(27 Reviews)', '03-6731 1452'),
('有間麵館', 'foods', 'Mid Valley City', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/81b684ef07e662581187fbc2e17fd3b6/w512.png', 'RESTAURANT', 'Dine-in · Takeaway · Delivery', 'LG0-59, Mid Valley City, 58000 KL', '8am - 12am (Mon - Fri)', '4.0 ⭐⭐⭐⭐(404 Reviews)', '03-7932 4533'),
('老招牌', 'foods', 'Sunway Velocity Mall', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/7438dc8c19c53c92bb284c46053c69f2/w380-crop.png', 'CANTONESE RESTAURANT', 'Dine-in · Takeaway · Delivery', 'Sunway Velocity Mall, 2-04, Jln Cheras, 55100 KL', '10am - 10pm (Mon - Fri)', '3.7 ⭐⭐⭐(155 Reviews)', '03-2712 3066'),
('貢茶 GONG CHA', 'beverages', 'Mid Valley City', '⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/b78de85843aa9341b5c0083ab04959b9/w512.png', 'BUBBLE TEA STORE', 'Dine-in · Takeaway', 'The Gardens Mall, Mid Valley City, 58000 KL', '10am - 8am (Mon - Fri)', '3.6 ⭐⭐⭐(80 Reviews)', '03-2284 9328'),
('霸王茶姬', 'beverages', 'Kepong Menjalara', '⭐⭐⭐⭐', 'https://assets.sunwayvelocitymall.com/shops/f1a23716911382e33794c67eaad0a2da/w512.png', 'CAFE', 'Dine-in · Takeaway', '29, Jalan 11/62a, Bandar Menjalara, 52200 KL', '10am - 11pm (Mon - Fri)', '4.2 ⭐⭐⭐⭐(229 Reviews)', '03-7932 4533');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_no` varchar(10) NOT NULL,
  `owner_ic` varchar(20) NOT NULL,
  `car_park_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_no`, `owner_ic`, `car_park_id`) VALUES
('A-1-01', '11', 'A101'),
('A-1-02', '', 'A102'),
('A-2-01', '010201-04-0201', 'A201'),
('A-2-02', '010616-14-1303', 'A202'),
('A-3-03', '010101-01-0111', 'A303'),
('A-3-05', '010305-07-0305', 'A305'),
('A-3-07', '010307-07-0307', 'A307'),
('A-4-04', '681225-09-8263', 'A404'),
('A-4-05', '910405-07-0405', 'A405'),
('A-4-08', '910408-07-0405', 'A408'),
('A-5-05', '710701-09-0911', 'A505'),
('A-5-09', '930405-03-0955', 'A509'),
('A-5-11', '980705-07-0511', 'A511'),
('B-1-02', '', 'B111'),
('B-2-02', '2', 'B212'),
('B-3-13', '', 'B313'),
('B-4-14', '920501-02-0521', 'B414'),
('B-5-15', '', 'B515'),
('C-1-05', '840702-07-4555', 'C105'),
('C-1-21', '', 'C121'),
('C-2-14', '920621-01-3427', 'C214'),
('C-2-22', '780912-02-1923', 'C222'),
('C-3-03', '1', '323'),
('C-3-13', '880904-01-0433', 'C313'),
('C-4-06', '990403-06-4455', 'C406'),
('C-4-24', '010606-06-0899', 'C424'),
('C-5-17', '790204-04-0044', 'C517'),
('C-5-25', '', 'C525'),
('D-1-31', '', 'D131'),
('D-2-32', '991212-12-1222', 'D436'),
('D-3-33', '951203-08-1234', 'D333'),
('D-4-04', '4', 'D434'),
('D-5-35', '', 'D535');

-- --------------------------------------------------------

--
-- Table structure for table `visitorpass`
--

CREATE TABLE `visitorpass` (
  `pass_id` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `visitor_name` varchar(50) NOT NULL,
  `visitor_ic` varchar(20) NOT NULL,
  `visitor_contact` varchar(20) NOT NULL,
  `car_details` varchar(50) NOT NULL,
  `car_plate` varchar(15) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `visitor_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitorpass`
--

INSERT INTO `visitorpass` (`pass_id`, `unit`, `visitor_name`, `visitor_ic`, `visitor_contact`, `car_details`, `car_plate`, `start_time`, `end_time`, `visitor_num`) VALUES
(1, 'A-1-01', 'Elon Musk', '111111-22-3333', '013-1231333', 'Perodua Axia Red', 'MUSK1234', '2022-06-04 09:00:00', '2022-06-04 13:00:00', 1),
(2, 'B-1-02', 'Bill Gate', '801212-12-0111', '999', 'Mercedes', 'RICH888', '2022-06-23 11:27:34', '2022-06-24 11:27:34', 1),
(3, 'A-1-01', 'Steve Job', '601201-01-0111', '019-9289302', 'Honda Jazz', '123abc', '2022-06-01 11:27:34', '2022-06-01 13:27:34', 5),
(4, 'A-2-02', 'James Bond', '970107-07-0007', '017-1007007', 'BMW', 'JAMES007', '2022-06-30 18:15:44', '2022-06-30 20:15:44', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `covidcases`
--
ALTER TABLE `covidcases`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `explore`
--
ALTER TABLE `explore`
  ADD PRIMARY KEY (`facility_addr`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_no`);

--
-- Indexes for table `visitorpass`
--
ALTER TABLE `visitorpass`
  ADD PRIMARY KEY (`pass_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `visitorpass`
--
ALTER TABLE `visitorpass`
  MODIFY `pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
