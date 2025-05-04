-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 07:12 AM
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
-- Database: `e_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_Email` varchar(100) DEFAULT NULL,
  `phone_number` int(10) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `nic_passport` varchar(20) NOT NULL,
  `session_time` time NOT NULL,
  `session_date` date NOT NULL,
  `status` enum('scheduled','pending','completed') DEFAULT 'scheduled',
  `doctor_notes` text DEFAULT NULL,
  `patient_address` varchar(255) DEFAULT NULL,
  `appointment_number` int(11) NOT NULL,
  `total_fee` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` enum('pending','completed','unsuccessful','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `doctor_id`, `hospital_name`, `patient_name`, `patient_Email`, `phone_number`, `schedule_id`, `nic_passport`, `session_time`, `session_date`, `status`, `doctor_notes`, `patient_address`, `appointment_number`, `total_fee`, `created_at`, `updated_at`, `payment_status`) VALUES
(9, NULL, 3, 'UNION SURGICAL', 'indu sajeewani', 'induwe@gmail.com', 775730063, NULL, '200022500980', '10:00:00', '2024-11-17', 'scheduled', NULL, 'jayathilinagma hakmana,matara.', 3, 0, '2024-11-21 02:47:32', '2024-11-21 02:47:32', 'pending'),
(10, NULL, 3, 'UNION SURGICAL', 'indu sajeewani', 'induwe@gmail.com', 775730063, NULL, '200022500980', '10:00:00', '2024-11-17', 'scheduled', NULL, 'jayathilinagma hakmana,matara.', 3, 0, '2024-11-21 02:50:35', '2024-11-21 02:50:35', 'pending'),
(11, NULL, 3, 'UNION SURGICAL', 'John cena', 'john345@gmail.com', 123456789, NULL, '690931214v', '10:00:00', '2024-11-17', 'scheduled', NULL, 'NYC ', 3, 0, '2024-11-21 03:00:11', '2024-11-21 03:00:11', 'pending'),
(12, NULL, 3, 'UNION SURGICAL', 'manusha kawshan', 'kawshanmanusha5@gmail.com', 775730063, NULL, '200022500980', '10:00:00', '2024-11-17', 'completed', NULL, 'Pallewelwatta narawalpita west hakmana', 3, 0, '2024-11-21 04:56:29', '2024-11-21 08:31:27', 'pending'),
(13, NULL, 3, 'UNION CENTRAL', 'ema watson', 'ema12@gmail.com', 745489652, NULL, '546545464546', '09:00:00', '2024-11-15', 'scheduled', NULL, '', 1, 0, '2024-11-21 06:18:03', '2024-11-21 06:18:03', 'pending'),
(35, 0, 15, 'UNION SURGICAL', 'jaden smith', 'jayden5@gmail.com', 775730063, NULL, '204984849849', '09:00:00', '2024-11-29', 'scheduled', NULL, 'kings road matara', 6, 0, '2024-11-25 09:46:51', '2024-11-25 09:46:51', 'pending'),
(43, 0, 2, 'UNION MEDICAL', 'manusha kawshan', 'kawshanmanusha5@gmail.com', 775730063, NULL, '204984849849', '08:00:00', '2024-11-15', 'scheduled', NULL, 'Pallewelwatta narawalpita west hakmana', 2, 3535, '2024-11-27 23:34:59', '2024-11-27 23:34:59', 'pending'),
(46, 0, 2, 'UNION SURGICAL', 'asdasd', 'athharasif2002@gmail.com', 767321184, NULL, '200228100753', '08:00:00', '2024-11-15', 'scheduled', NULL, '', 2, 2085, '2024-11-28 08:22:13', '2024-11-28 08:22:13', 'pending'),
(58, 0, 2, 'UNION SURGICAL', 'Mohomad ', '', 765423155, NULL, '200228100321', '08:00:00', '2024-11-15', 'scheduled', NULL, '', 2, 2085, '2024-11-28 12:36:12', '2024-12-10 06:12:04', 'pending'),
(61, 1, 2, 'UNION MEDICAL', 'John Doe', 'john.doe@example.com', 1234567890, NULL, '', '08:00:00', '2024-12-12', 'scheduled', NULL, NULL, 0, 0, '2024-12-04 16:25:40', '2024-12-04 16:25:40', ''),
(102, 29, 11, 'Union Central Hospital', 'Tharusha ranaweera ', 'tharu5@gmail.com', 714445678, 25, '784512365412', '09:06:00', '2024-12-19', 'scheduled', NULL, '', 2, 1950, '2024-12-09 09:01:33', '2024-12-09 09:01:33', 'pending'),
(103, 29, 11, 'Union Central Hospital', 'Tharusha ranaweera ', 'tharu5@gmail.com', 714445678, 25, '784512365412', '09:12:00', '2024-12-19', 'scheduled', NULL, '', 3, 1950, '2024-12-09 09:15:33', '2024-12-09 09:15:33', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
