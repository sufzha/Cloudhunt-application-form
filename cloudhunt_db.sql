-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 07:30 PM
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
-- Database: `cloudhunt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `challenge` varchar(100) NOT NULL,
  `member1Name` varchar(255) NOT NULL,
  `member1Email` varchar(255) NOT NULL,
  `member1Mobile` varchar(20) NOT NULL,
  `member1Status` varchar(50) NOT NULL,
  `member1FieldOfStudy` varchar(255) NOT NULL,
  `member1Institution` varchar(255) NOT NULL,
  `member2Name` varchar(255) NOT NULL,
  `member2Email` varchar(255) NOT NULL,
  `member2Mobile` varchar(20) NOT NULL,
  `member2Status` varchar(50) NOT NULL,
  `member2FieldOfStudy` varchar(255) NOT NULL,
  `member2Institution` varchar(255) NOT NULL,
  `member3Name` varchar(255) NOT NULL,
  `member3Email` varchar(255) NOT NULL,
  `member3Mobile` varchar(20) NOT NULL,
  `member3Status` varchar(50) NOT NULL,
  `member3FieldOfStudy` varchar(255) NOT NULL,
  `member3Institution` varchar(255) NOT NULL,
  `member4Name` varchar(255) NOT NULL,
  `member4Email` varchar(255) NOT NULL,
  `member4Mobile` varchar(20) NOT NULL,
  `member4Status` varchar(50) NOT NULL,
  `member4FieldOfStudy` varchar(255) NOT NULL,
  `member4Institution` varchar(255) NOT NULL,
  `member5Name` varchar(255) NOT NULL,
  `member5Email` varchar(255) NOT NULL,
  `member5Mobile` varchar(20) NOT NULL,
  `member5Status` varchar(50) NOT NULL,
  `member5FieldOfStudy` varchar(255) NOT NULL,
  `member5Institution` varchar(255) NOT NULL,
  `teamIntroduction` text NOT NULL,
  `howDidYouFindUs` varchar(255) NOT NULL,
  `submission_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `teamName`, `state`, `challenge`, `member1Name`, `member1Email`, `member1Mobile`, `member1Status`, `member1FieldOfStudy`, `member1Institution`, `member2Name`, `member2Email`, `member2Mobile`, `member2Status`, `member2FieldOfStudy`, `member2Institution`, `member3Name`, `member3Email`, `member3Mobile`, `member3Status`, `member3FieldOfStudy`, `member3Institution`, `member4Name`, `member4Email`, `member4Mobile`, `member4Status`, `member4FieldOfStudy`, `member4Institution`, `member5Name`, `member5Email`, `member5Mobile`, `member5Status`, `member5FieldOfStudy`, `member5Institution`, `teamIntroduction`, `howDidYouFindUs`, `submission_timestamp`) VALUES
(1, 'NerdBuster', 'Kelantan', 'Challenge 1', 'thariq', 'auhua@gmail.com', '01111984150', 'undergraduate', 'cloud com', 'ikm', 'faisal', 'faisal@com', '019765432182', 'undergraduate', 'cloud com', 'ikm', 'ali', 'ali@com', '017623616346', 'undergraduate', 'cloud com', 'ikm', 'abu', 'abu@com', '01862361371', 'undergraduate', 'cloud com', 'ikm', 'atan', 'atan@com', '0161623763', 'undergraduate', 'cloud com', 'ikm', 'i find it interesting', 'instagram', '2025-04-25 17:22:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
