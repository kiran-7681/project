-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2019 at 05:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `username` varchar(100) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`username`, `movie_name`, `comments`) VALUES
('', 'Batman', 'batman'),
('kiran_7681', 'Batman', 'batman'),
('kiran_7681', 'Batman', 'batman'),
('kiran_7681', 'Batman', 'zdfsd'),
('kiran_7681', 'Batman', 'zsdfxbdz'),
('kiran_7681', 'Batman', ''),
('kiran_7681', 'Batman', 'xzcvzbdfzbdfbxcn xcvbdfbcxb db'),
('kiran_7681', 'Batman', 'zdv'),
('asdfgh', 'Breaking Bad', ',nsdm ,sd');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `username` varchar(100) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `rating` int(30) NOT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(4, 'kiran_7681', 'kiranraj.krk.1729@gmail.com', '$2y$10$bc7TzzuanMZZqNqsNzK4H.8ceSLv12qlmTfRu1m1U9T0tIlqs9S26', '2019-07-18 01:00:25'),
(9, 'asdfgh', 'lkzn@gmail.com', '$2y$10$FR0r8jL/txFPiiYJj6gdmemSEUSJGW0RJ1sFNiKLpVq0tx7YuUeD6', '2019-08-02 13:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `watched`
--

CREATE TABLE `watched` (
  `username` varchar(100) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `movie_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watched`
--

INSERT INTO `watched` (`username`, `movie_name`, `movie_id`) VALUES
('kiran_7681', 'King Kong', 'tt0360717'),
('kiran_7681', 'Breaking Bad', 'tt0903747'),
('kiran_7681', 'Game of Thrones', 'tt0944947'),
('asdfgh', 'Breaking Bad', 'tt0903747'),
('kiran_7681', 'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe', 'tt0363771');

-- --------------------------------------------------------

--
-- Table structure for table `watchlater`
--

CREATE TABLE `watchlater` (
  `username` varchar(100) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `movie_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watchlater`
--

INSERT INTO `watchlater` (`username`, `movie_name`, `movie_id`) VALUES
('kiran_7681', 'Batman', 'tt0096895'),
('kiran_7681', 'The Avengers', 'tt0848228'),
('kiran_7681', 'Avatar', 'tt0499549'),
('kiran_7681', 'Jurassic World', 'tt0369610'),
('kiran_7681', 'King Kong', 'tt0360717'),
('asdfgh', 'Breaking Bad', 'tt0903747'),
('kiran_7681', 'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe', 'tt0363771');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
