-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 06:42 AM
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
(58, 0, 2, 'UNION SURGICAL', 'Mohomad Nuran', '', 765423155, NULL, '200228100321', '08:00:00', '2024-11-15', 'scheduled', NULL, '', 2, 2085, '2024-11-28 12:36:12', '2024-11-28 12:36:12', 'pending'),
(60, 28, 2, 'UNION MEDICAL', 'ashan kawinda', 'ashan3@gmail.com', 418965214, NULL, '200345698542', '09:00:00', '2024-11-16', 'scheduled', NULL, 'kirula ,road matara', 4, 2085, '2024-11-28 12:55:26', '2024-11-28 12:55:26', 'pending'),
(61, 1, 2, 'UNION MEDICAL', 'John Doe', 'john.doe@example.com', 1234567890, NULL, '', '08:00:00', '2024-12-12', 'scheduled', NULL, NULL, 0, 0, '2024-12-04 16:25:40', '2024-12-04 16:25:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `publish_date` date NOT NULL,
  `views` int(11) DEFAULT 0,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `image_url`, `title`, `category`, `description`, `content`, `publish_date`, `views`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 'https://www.uoc.edu/content/dam/news/images/noticies/2024/IA_Salut.jpeg/_jcr_content/renditions/cq5dam.web.1280.1280.jpeg', 'The Future of AI in Healthcare', 'Healthcare', 'How AI is transforming the healthcare industry and what to expect in the future.', 'Artificial Intelligence is revolutionizing healthcare in ways we never imagined...', '2024-11-04', 0, 4, '2024-11-11 08:48:58', '2024-11-12 16:17:07'),
(5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRx39fg0Rj1s6ZJZnFnOnSP2IsvWqDfiHBOIQ&s', 'How Data Analytics is Improving Hospital Management', 'Health System', 'Exploring how data-driven insights help hospitals optimize their operations and improve patient outcomes.', 'Data analytics enables hospitals to make informed decisions based on patient demographics, treatment effectiveness, and operational performance. With the implementation of data analytics tools, health systems can enhance resource allocation, predict patient needs, and improve overall efficiency...', '2024-11-02', 0, 4, '2024-11-11 08:52:22', '2024-11-12 16:57:03'),
(6, 'https://ezovion.com/wp-content/uploads/2023/06/1000-x-600px_Impact-of-AI-in-Healthcare-01.jpg', 'The Impact of AI on Health Systems Management', 'Health System', 'Examining the benefits of artificial intelligence in hospital management and patient care.', 'AI technologies, from machine learning algorithms to predictive analytics, are transforming health systems by assisting in diagnosis, optimizing workflows, and enhancing patient experiences. This article explores various AI applications within hospitals and the broader healthcare sector...', '2024-11-01', 0, 4, '2024-11-11 08:52:22', '2024-11-12 16:33:55'),
(46, 'http://localhost/E-care/public/assets/img/articles/retro-wallpaper.jpg', 'car', 'asd', 'asasd', 'asdasd', '2024-11-28', 0, 4, '2024-11-28 05:19:22', '2024-11-28 06:02:58'),
(49, 'http://localhost/E-care/public/assets/img/articles/617759-Muhammad-Ali-quote.jpg', 'askdjhakjsdh', 'jhgajsd', 'asdhjad', 'jbjahsd', '2024-11-28', 0, 4, '2024-11-28 05:57:46', '2024-11-28 14:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `availabletimes`
--

CREATE TABLE `availabletimes` (
  `id` int(10) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `total_slots` int(11) NOT NULL,
  `filled_slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availabletimes`
--

INSERT INTO `availabletimes` (`id`, `doctor_id`, `date`, `hospital_id`, `start_time`, `duration`, `total_slots`, `filled_slots`) VALUES
(1, 2, '2024-11-15', 2, '08:00:00', 2, 10, 9),
(2, 2, '2024-11-15', 1, '12:00:00', 1, 10, 2),
(3, 3, '2024-11-15', 3, '21:00:00', 2, 10, 10),
(4, 2, '2024-11-14', 3, '21:00:00', 2, 5, 3),
(5, 1, '2024-11-14', 3, '21:00:00', 2, 5, 3),
(6, 7, '2024-11-19', 3, '19:00:00', 2, 20, 15),
(7, 1, '2024-11-15', 2, '08:00:00', 2, 10, 9),
(8, 2, '2024-11-16', 1, '09:00:00', 2, 10, 7),
(9, 3, '2024-11-17', 2, '10:00:00', 2, 10, 8),
(10, 4, '2024-11-18', 2, '11:00:00', 2, 10, 5),
(11, 5, '2024-11-19', 2, '08:30:00', 2, 10, 6),
(12, 6, '2024-11-20', 2, '09:30:00', 2, 10, 4),
(13, 7, '2024-11-21', 2, '10:30:00', 2, 10, 2),
(14, 8, '2024-11-22', 2, '08:00:00', 2, 10, 3),
(15, 9, '2024-11-23', 2, '09:00:00', 2, 10, 5),
(16, 10, '2024-11-24', 2, '10:00:00', 2, 10, 6),
(17, 11, '2024-11-25', 2, '08:30:00', 2, 10, 7),
(18, 12, '2024-11-26', 2, '09:30:00', 2, 10, 8),
(19, 13, '2024-11-27', 2, '10:30:00', 2, 10, 9),
(20, 14, '2024-11-28', 2, '08:00:00', 2, 10, 4),
(21, 15, '2024-11-29', 2, '09:00:00', 2, 10, 5),
(22, 16, '2024-11-30', 2, '10:00:00', 2, 10, 6),
(24, 11, '2024-12-29', 1, '18:00:00', 1, 5, 0),
(25, 11, '2024-12-03', 3, '21:00:00', 2, 20, 0),
(26, 11, '2024-12-10', 1, '23:56:00', 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clerks`
--

CREATE TABLE `clerks` (
  `emp_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital` int(10) NOT NULL,
  `lab` int(10) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `hospital` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `other_qualifications` text DEFAULT NULL,
  `special_note` text NOT NULL,
  `practicing_government_hospitals` tinyint(1) NOT NULL,
  `Doctor_fee` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `user_id`, `registration_number`, `specialization`, `hospital`, `gender`, `other_qualifications`, `special_note`, `practicing_government_hospitals`, `Doctor_fee`, `created_at`, `updated_at`) VALUES
(1, 'Dr. John Doe', 10, 'REG001', 'Cardiology', 1, 'Male', 'MD, FACC', 'Specialist in heart diseases', 1, 500, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(2, 'Dr. Sarah Ahmed', 11, 'REG002', 'Neurology', 2, 'Female', 'MBBS, MD', 'Expert in neurological disorders', 0, 600, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(3, 'Dr. Emily Taylor', 12, 'REG003', 'Pediatrics', 3, 'Female', 'MD Pediatrics', 'Child specialist', 1, 400, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(4, 'Dr. Michael Smith', 13, 'REG004', 'General Surgery', 1, 'Male', 'MS Surgery', 'Laparoscopic surgeon', 1, 700, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(5, 'Dr. Arjun Kapoor', 14, 'REG005', 'Orthopedics', 2, 'Male', 'MBBS, MS Ortho', 'Joint replacement specialist', 0, 550, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(6, 'Dr. Aisha Khan', 15, 'REG006', 'Dermatology', 3, 'Female', 'MD Dermatology', 'Skin and hair specialist', 1, 450, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(7, 'Dr. Benjamin Lee', 16, 'REG007', 'Psychiatry', 1, 'Male', 'MD Psychiatry', 'Mental health specialist', 0, 600, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(8, 'Dr. Olivia Brown', 17, 'REG008', 'Ophthalmology', 2, 'Female', 'MS Ophthalmology', 'Cataract and glaucoma specialist', 1, 500, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(9, 'Dr. Sophia Green', 18, 'REG009', 'Gynecology', 3, 'Female', 'MD Gynecology', 'Expert in women\'s health', 1, 650, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(10, 'Dr. Liam White', 19, 'REG010', 'Endocrinology', 1, 'Male', 'MBBS, MD Endo', 'Diabetes and hormone specialist', 0, 700, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(11, 'Dr. Noor Hassan', 20, 'REG011', 'Cardiology', 2, 'Female', 'MBBS, FACC', 'Heart specialist', 1, 750, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(12, 'Dr. David Johnson', 21, 'REG012', 'Neurology', 3, 'Male', 'MBBS, MD Neurology', 'Epilepsy expert', 0, 550, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(13, 'Dr. Zara Malik', 22, 'REG013', 'Pediatrics', 1, 'Female', 'MD Pediatrics', 'Vaccination and child care', 1, 400, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(14, 'Dr. Ethan Brown', 23, 'REG014', 'General Surgery', 2, 'Male', 'MS Surgery', 'Hernia and appendicitis specialist', 0, 800, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(15, 'Dr. Amelia Carter', 24, 'REG015', 'Orthopedics', 3, 'Female', 'MBBS, MS Ortho', 'Spinal cord treatment', 1, 650, '2024-11-28 07:55:15', '2024-11-28 07:55:15'),
(17, 'Dr. Alice Smith', 2, 'REG016', 'Neurology', 0, '', 'Boss Baby', '', 0, 0, '2024-11-28 13:18:10', '2024-11-28 13:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `user_id`, `uploaded_by`, `document_type`, `document_name`, `ref_no`, `uploaded_at`) VALUES
(1, 1, 3, 'medical_record', 'Diagnosis_Card_2024-11-27', 'DC000001', '2024-11-28 08:18:31'),
(2, 1, 3, 'lab_report', 'Blood report_2024-11-28', 'LT000001', '2024-11-28 08:18:31'),
(5, 1, 1, 'private', 'DSA III - TUTE 03 - Hashing.pdf', NULL, '2024-11-28 14:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hospital_fee` float NOT NULL,
  `description` varchar(300) NOT NULL,
  `services` varchar(300) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `location` varchar(100) NOT NULL,
  `working_hours` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `hospital_fee`, `description`, `services`, `address`, `contact`, `location`, `working_hours`) VALUES
(1, 'Union Medical Hospital', 1200, 'We are a Paediatrics centered hospital, complete with <br>Operating Theaters and \n                                Intensive & Critical Care Wards. <br>Reputed for dengue and medical patient management.', '<li>Family Physician</li>                                 <li>Diabetes Centre</li>                                 <li>Psychiactric Care</li>                                 <li>Radiology</li>', '181 Bernard Soysa Mawatha, Colombo 5', 112972343, '', '24h'),
(2, 'Union Surgical Hospital', 1200, 'We deliver a comprehensive menu of world-class surgical care, <br>                                 in a high-end facility with support from diagnosis through to<br>                                 intensive care and rehabilitation services.', '<li>Heart Centre</li>                                 <li>Gneral Surgery</li>                                 <li>Orthapedics</li>                                 <li>Cancer Care</li>', 'Address: 21 Kirimandala Mawatha, Colombo 5', 112972345, '', '24h'),
(3, 'Union Central Hospital', 1200, 'We deliver international standard healthcare, in multi-specialty <br>                             general hospital,which is a one-stop facility for high end <br>                             diagnostic, therapeutic and intensive care services.', '<li>Neonatal Care</li>                                 <li>Intensive Care</li>                                 <li>Cosmetic Centre</li>                                 <li>Urology</li>', '114 Norris Canal Rd, Colombo 10', 112972344, '', '24h');

-- --------------------------------------------------------

--
-- Table structure for table `insuranceclaims`
--

CREATE TABLE `insuranceclaims` (
  `claim_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `insurance_company_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `hospital` varchar(255) NOT NULL,
  `name_of_policy_holder` varchar(255) NOT NULL,
  `relationship_to_policy_holder` varchar(255) DEFAULT NULL,
  `claim_type` enum('medical','dental','vision','other') NOT NULL,
  `policy_number` varchar(50) NOT NULL,
  `NIC_of_policy_holder` varchar(50) NOT NULL,
  `member_number` varchar(50) DEFAULT NULL,
  `policy_holder_contact_number` varchar(50) DEFAULT NULL,
  `bank_details` text DEFAULT NULL,
  `patient_full_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `relevant_documents` text DEFAULT NULL,
  `claim_status` enum('submitted','in_review','approved','rejected') DEFAULT 'submitted',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insuranceclaims`
--

INSERT INTO `insuranceclaims` (`claim_id`, `user_id`, `insurance_company_id`, `document_id`, `hospital`, `name_of_policy_holder`, `relationship_to_policy_holder`, `claim_type`, `policy_number`, `NIC_of_policy_holder`, `member_number`, `policy_holder_contact_number`, `bank_details`, `patient_full_name`, `email`, `relevant_documents`, `claim_status`, `submitted_at`) VALUES
(1, 1, 1, 1, 'City Hospital', 'John Doe', 'self', 'medical', 'POL123456', '123456789V', 'MEM987654', '123-456-7890', 'Bank Account XYZ, 00112233', 'John Doe', 'john.doe@example.com', 'Lab report, Medical report', 'submitted', '2024-09-19 12:10:44'),
(2, 1, 2, 2, 'County Medical Center', 'John Doe', 'self', 'dental', 'POL987654', '123456789V', 'MEM123456', '123-456-7890', 'Bank Account ABC, 44556677', 'John Doe', 'john.doe@example.com', 'Dental report', 'in_review', '2024-09-19 12:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `insurancecompanies`
--

CREATE TABLE `insurancecompanies` (
  `insurance_company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `website_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) NOT NULL,
  `number` varchar(12) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurancecompanies`
--

INSERT INTO `insurancecompanies` (`insurance_company_id`, `company_name`, `website_link`, `created_at`, `updated_at`, `email`, `number`, `logo`) VALUES
(1, 'Allianz Lanka', 'https://www.allianz.lk', '2024-09-19 12:10:44', '2024-11-11 08:31:10', 'info@allianz.com', '123-456-7890', 'http://localhost/E-care/public/assets/img/home-img/insurance/allianz.svg'),
(2, 'Softlogic Life', 'https://www.softlogic.com', '2024-09-19 12:10:44', '2024-11-11 08:31:43', 'support@softlogic.com', '987-654-3210', 'http://localhost/E-care/public/assets/img/home-img/insurance/softlogic.svg'),
(3, 'Ceylinco Life', 'https://ceylincolife.lk', '2024-11-10 10:47:28', '2024-11-11 08:32:14', 'health@ceylinco.com', '123-456-7898', 'http://localhost/E-care/public/assets/img/home-img/insurance/ceylinco.svg'),
(4, 'AIA Sri Lanka', 'https://aia.lk', '2024-11-10 10:48:56', '2024-11-11 08:33:08', 'health@aialk.com', '987-654-3218', 'http://localhost/E-care/public/assets/img/home-img/insurance/aia.svg');

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

CREATE TABLE `laboratories` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lab_fee` int(10) NOT NULL,
  `description` varchar(300) NOT NULL,
  `services` varchar(300) NOT NULL,
  `address` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `working_hours` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`id`, `name`, `lab_fee`, `description`, `services`, `address`, `location`, `contact`, `working_hours`) VALUES
(1, 'Union Laboratories - Rajagiriya', 250, 'We are a Paediatrics centered laboratory, complete with <br>Operating Theaters and \r\n                                Intensive & Critical Care Wards. <br>Reputed for dengue and medical patient management.', '<li>Blood Tests</li>\r\n                                <li>Urine Tests</li>\r\n                                <li>Genetic Tests</li>\r\n                                <li>Pathology / Immunology</li>\r\n                                <li>STD Tests</li>', '181 Bernard Soysa Mawatha, Colombo 5', '', 112972343, 24),
(2, 'Union Laboratories - Bambalapitiya', 250, 'We deliver international standard healthcare, in multi-specialty <br>\r\n                            general laboratory,which is a one-stop facility for high end <br>\r\n                            diagnostic, therapeutic and intensive care services.', '<li>Blood Tests</li>\r\n                                <li>Urine Tests</li>\r\n                                <li>Genetic Tests</li>\r\n                                <li>Pathology / Immunology</li>\r\n                                <li>STD Tests</li>', '114 Norris Canal Rd, Colombo 10', '', 112972344, 24),
(3, 'Union Laboratories - Dehiwala', 250, 'We deliver a comprehensive menu of world-class surgical care, <br>\r\n                                in a high-end facility with support from diagnosis through to<br>\r\n                                intensive care and rehabilitation services.', '<li>Blood Tests</li>\r\n                                <li>Urine Tests</li>\r\n                                <li>Genetic Tests</li>\r\n                                <li>Pathology / Immunology</li>\r\n                                <li>STD Tests</li>', '21 Kirimandala Mawatha, Colombo 5', '', 112972345, 24);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` enum('credit_card','debit_card','bank_transfer','paypal','insurance') NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `appointment_id`, `user_id`, `payment_method`, `payment_status`, `payment_amount`, `payment_date`) VALUES
(1, 1, 1, 'credit_card', 'completed', 50.00, '2024-09-18 08:30:00'),
(2, 2, 1, 'insurance', 'completed', 100.00, '2024-09-19 09:30:00'),
(3, 3, 1, 'paypal', 'pending', 75.00, '2024-09-20 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` enum('Mr.','Ms.','Mrs.') DEFAULT 'Mr.',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `NIC` varchar(50) DEFAULT NULL,
  `role` enum('patient','doctor','lab_clerk','record_clerk','reception_clerk','admin') NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `title`, `email`, `password`, `phone_number`, `NIC`, `role`, `is_active`, `created_at`, `updated_at`, `profile_pic`) VALUES
(1, 'John Doe', 'Mr.', 'john.doe@example.com', 'hashedpassword1', '123-456-7890', '123456789V', 'patient', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43', ''),
(2, 'Dr. Alice Smith', 'Mr.', 'alice.smith@example.com', 'hashedpassword2', '098-765-4321', '987654321V', 'doctor', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43', ''),
(3, 'Clerk Bob', 'Mr.', 'bob.clerk@example.com', '1234', '321-654-0987', '654987321V', 'lab_clerk', 1, '2024-09-19 12:10:43', '2024-12-04 17:58:06', ''),
(4, 'Admin Jane', 'Mr.', 'jane.admin@gmail.com', 'admin123', '555-123-4567', '112233445V', 'admin', 1, '2024-09-19 12:10:43', '2024-11-19 08:09:14', ''),
(7, 'Michael John', 'Mr.', 'michael.johnson@example.com', 'hashpass7', '321-654-0987', '556677889V', 'reception_clerk', 1, '2024-11-04 09:08:48', '2024-11-04 09:12:38', ''),
(8, 'Mohamed User1', '', 'user1@gmail.com', '1234', '0123456789', '200228100753', 'patient', 1, '2024-11-16 10:16:52', '2024-11-17 08:08:24', ''),
(9, 'Test Doctor', '', 'doctor1@gmail.com', '1234', '1234567894', '200222222222', 'doctor', 1, '2024-11-20 05:54:46', '2024-11-20 05:56:10', ''),
(10, 'Dr. John Doe', 'Mr.', 'john.doe@hospital1.com', 'hashedpassword10', '123-111-7890', 'NIC001', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(11, 'Dr. Sarah Ahmed', 'Ms.', 'sarah@doctor.com', '1234', '123-222-7890', 'NIC002', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 13:24:15', ''),
(12, 'Dr. Emily Taylor', 'Ms.', 'emily.taylor@hospital3.com', 'hashedpassword12', '123-333-7890', 'NIC003', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(13, 'Dr. Michael Smith', 'Mr.', 'michael.smith@hospital1.com', 'hashedpassword13', '123-444-7890', 'NIC004', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(14, 'Dr. Arjun Kapoor', 'Mr.', 'arjun.kapoor@hospital2.com', 'hashedpassword14', '123-555-7890', 'NIC005', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(15, 'Dr. Aisha Khan', 'Ms.', 'aisha.khan@hospital3.com', 'hashedpassword15', '123-666-7890', 'NIC006', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(16, 'Dr. Benjamin Lee', 'Mr.', 'benjamin.lee@hospital1.com', 'hashedpassword16', '123-777-7890', 'NIC007', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(17, 'Dr. Olivia Brown', 'Ms.', 'olivia.brown@hospital2.com', 'hashedpassword17', '123-888-7890', 'NIC008', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(18, 'Dr. Sophia Green', 'Ms.', 'sophia.green@hospital3.com', 'hashedpassword18', '123-999-7890', 'NIC009', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(19, 'Dr. Liam White', 'Mr.', 'liam.white@hospital1.com', 'hashedpassword19', '123-000-7890', 'NIC010', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(20, 'Dr. Noor Hassan', 'Ms.', 'noor.hassan@hospital2.com', 'hashedpassword20', '123-123-1234', 'NIC011', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(21, 'Dr. David Johnson', 'Mr.', 'david.johnson@hospital3.com', 'hashedpassword21', '321-123-4567', 'NIC012', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(22, 'Dr. Zara Malik', 'Ms.', 'zara.malik@hospital1.com', 'hashedpassword22', '555-555-1234', 'NIC013', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(23, 'Dr. Ethan Brown', 'Mr.', 'ethan.brown@hospital2.com', 'hashedpassword23', '222-222-2222', 'NIC014', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(24, 'Dr. Amelia Carter', 'Ms.', 'amelia.carter@hospital3.com', 'hashedpassword24', '333-333-3333', 'NIC015', 'doctor', 1, '2024-11-28 07:54:51', '2024-11-28 07:54:51', ''),
(26, 'Mohamed Athhar', '', 'athharasif2002@gmail.com', '123456', '0767321184', '200235401128', 'patient', 1, '2024-11-28 09:25:57', '2024-11-28 09:25:57', ''),
(27, 'test patient', '', 'patient1@gamil.com', '1234', '0767321184', '200256412358', 'patient', 1, '2024-11-28 10:32:31', '2024-11-28 10:32:31', ''),
(28, 'manu', '', 'manu@gmail.com', 'manusha', '1245789632', '124578963254', 'patient', 1, '2024-11-28 12:47:33', '2024-11-28 12:49:35', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `availabletimes`
--
ALTER TABLE `availabletimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clerks`
--
ALTER TABLE `clerks`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`registration_number`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insuranceclaims`
--
ALTER TABLE `insuranceclaims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `insurance_company_id` (`insurance_company_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `insurancecompanies`
--
ALTER TABLE `insurancecompanies`
  ADD PRIMARY KEY (`insurance_company_id`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `NIC` (`NIC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `availabletimes`
--
ALTER TABLE `availabletimes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `insuranceclaims`
--
ALTER TABLE `insuranceclaims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insurancecompanies`
--
ALTER TABLE `insurancecompanies`
  MODIFY `insurance_company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `insuranceclaims`
--
ALTER TABLE `insuranceclaims`
  ADD CONSTRAINT `insuranceclaims_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `insuranceclaims_ibfk_2` FOREIGN KEY (`insurance_company_id`) REFERENCES `insurancecompanies` (`insurance_company_id`),
  ADD CONSTRAINT `insuranceclaims_ibfk_3` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
