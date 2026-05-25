-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 07:09 PM
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
-- Database: `lv4_filmovi`
--

-- --------------------------------------------------------

--
-- Table structure for table `desired_movies`
--

CREATE TABLE `desired_movies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desired_movies`
--

INSERT INTO `desired_movies` (`id`, `user_id`, `movie_id`, `created_at`) VALUES
(1, 1, 1, '2026-05-25 14:31:02'),
(2, 1, 3, '2026-05-25 14:31:09'),
(4, 1, 31, '2026-05-25 15:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(80) NOT NULL,
  `year` int(11) NOT NULL,
  `country` varchar(80) NOT NULL,
  `duration` int(11) NOT NULL,
  `rating` decimal(3,1) DEFAULT 0.0,
  `director` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `year`, `country`, `duration`, `rating`, `director`, `created_at`) VALUES
(1, 'The Shawshank Redemption', 'Drama', 1994, 'USA', 142, 9.3, 'Frank Darabont', '2026-05-25 13:19:09'),
(2, 'The Godfather', 'Crime, Drama', 1972, 'USA', 175, 9.2, 'Francis Ford Coppola', '2026-05-25 13:19:09'),
(3, 'The Dark Knight', 'Action, Crime', 2008, 'UK/USA', 152, 9.0, 'Christopher Nolan', '2026-05-25 13:19:09'),
(4, 'Schindler\'s List', 'Biography, Drama', 1993, 'USA', 195, 9.0, 'Steven Spielberg', '2026-05-25 13:19:09'),
(5, '12 Angry Men', 'Crime, Drama', 1957, 'USA', 96, 9.0, 'Sidney Lumet', '2026-05-25 13:19:09'),
(6, 'Pulp Fiction', 'Crime, Drama', 1994, 'USA', 154, 8.9, 'Quentin Tarantino', '2026-05-25 13:19:09'),
(8, 'Il Buono, il Brutto, il Cattivo', 'Western', 1966, 'Italy', 161, 8.8, 'Sergio Leone', '2026-05-25 13:19:09'),
(9, 'Fight Club', 'Drama', 1999, 'USA', 139, 8.8, 'David Fincher', '2026-05-25 13:19:09'),
(10, 'Inception', 'Action, Adventure', 2010, 'USA/UK', 148, 8.8, 'Christopher Nolan', '2026-05-25 13:19:09'),
(11, 'The Matrix', 'Action, Sci-Fi', 1999, 'USA', 136, 8.7, 'Lana Wachowski', '2026-05-25 13:19:09'),
(12, 'Goodfellas', 'Biography, Crime', 1990, 'USA', 145, 8.7, 'Martin Scorsese', '2026-05-25 13:19:09'),
(13, 'One Flew Over the Cuckoo\'s Nest', 'Drama', 1975, 'USA', 133, 8.7, 'Milos Forman', '2026-05-25 13:19:09'),
(14, 'Seven Samurai', 'Action, Drama', 1954, 'Japan', 207, 8.6, 'Akira Kurosawa', '2026-05-25 13:19:09'),
(15, 'Se7en', 'Crime, Drama', 1995, 'USA', 127, 8.6, 'David Fincher', '2026-05-25 13:19:09'),
(16, 'The Silence of the Lambs', 'Crime, Drama', 1991, 'USA', 118, 8.6, 'Jonathan Demme', '2026-05-25 13:19:09'),
(17, 'City of God', 'Crime, Drama', 2002, 'Brazil', 130, 8.6, 'Fernando Meirelles', '2026-05-25 13:19:09'),
(18, 'Life Is Beautiful', 'Comedy, Drama', 1997, 'Italy', 116, 8.6, 'Roberto Benigni', '2026-05-25 13:19:09'),
(19, 'Interstellar', 'Adventure, Drama', 2014, 'USA/UK', 169, 8.7, 'Christopher Nolan', '2026-05-25 13:19:09'),
(20, 'Saving Private Ryan', 'Drama, War', 1998, 'USA', 169, 8.6, 'Steven Spielberg', '2026-05-25 13:19:09'),
(21, 'Parasite', 'Drama, Thriller', 2019, 'South Korea', 132, 8.5, 'Bong Joon Ho', '2026-05-25 13:19:09'),
(22, 'The Green Mile', 'Crime, Drama', 1999, 'USA', 189, 8.6, 'Frank Darabont', '2026-05-25 13:19:09'),
(23, 'Star Wars: Episode IV - A New Hope', 'Action, Adventure', 1977, 'USA', 121, 8.6, 'George Lucas', '2026-05-25 13:19:09'),
(24, 'Terminator 2: Judgment Day', 'Action, Sci-Fi', 1991, 'USA', 137, 8.6, 'James Cameron', '2026-05-25 13:19:09'),
(25, 'Back to the Future', 'Adventure, Comedy', 1985, 'USA', 116, 8.5, 'Robert Zemeckis', '2026-05-25 13:19:09'),
(26, 'The Pianist', 'Biography, Drama', 2002, 'France/Poland', 150, 8.5, 'Roman Polanski', '2026-05-25 13:19:09'),
(27, 'Psycho', 'Horror, Mystery', 1960, 'USA', 109, 8.5, 'Alfred Hitchcock', '2026-05-25 13:19:09'),
(28, 'Gladiator', 'Action, Adventure', 2000, 'USA/UK', 155, 8.5, 'Ridley Scott', '2026-05-25 13:19:09'),
(29, 'The Lion King', 'Animation, Adventure', 1994, 'USA', 88, 8.5, 'Roger Allers', '2026-05-25 13:19:09'),
(30, 'The Departed', 'Crime, Drama', 2006, 'USA', 151, 8.5, 'Martin Scorsese', '2026-05-25 13:19:09'),
(31, 'Kako je počeo rat na mom otoku', 'Komedija', 1996, 'Hrvatska', 97, 7.8, 'Vino Brešan', '2026-05-25 15:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `filename`, `description`, `uploaded_by`, `created_at`) VALUES
(1, '1779726868_traktor.jpg', NULL, 1, '2026-05-25 16:34:28'),
(2, '1779727088_slika1.jpg', NULL, 1, '2026-05-25 16:38:08'),
(3, '1779727102_slika2.jpg', NULL, 1, '2026-05-25 16:38:22'),
(4, '1779727109_slika3.jpg', NULL, 1, '2026-05-25 16:38:29'),
(5, '1779727122_slika4.jpg', NULL, 1, '2026-05-25 16:38:42'),
(6, '1779727129_slika5.jpg', NULL, 1, '2026-05-25 16:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `photo_ratings`
--

CREATE TABLE `photo_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_ratings`
--

INSERT INTO `photo_ratings` (`id`, `user_id`, `photo_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 1, NULL, '2026-05-25 16:34:37'),
(2, 1, 5, 4, NULL, '2026-05-25 16:38:59'),
(3, 1, 6, 5, NULL, '2026-05-25 16:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'luka2402', 'luka2402@gmail.com', '$2y$10$ilxKAjYkxHbBAFLMQAoViuDyUlnyfk7GiDf1pDsE6OAz7BSiRK9g6', 'user', '2026-05-25 14:28:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desired_movies`
--
ALTER TABLE `desired_movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_movie` (`user_id`,`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_ratings`
--
ALTER TABLE `photo_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_photo` (`user_id`,`photo_id`);

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
-- AUTO_INCREMENT for table `desired_movies`
--
ALTER TABLE `desired_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photo_ratings`
--
ALTER TABLE `photo_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
