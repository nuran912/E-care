-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 09:55 AM
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
  `schedule_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('scheduled','canceled','completed') DEFAULT 'scheduled',
  `doctor_notes` text DEFAULT NULL,
  `appointment_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `doctor_id`, `schedule_id`, `appointment_date`, `start_time`, `end_time`, `status`, `doctor_notes`, `appointment_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-09-20', '09:30:00', '10:00:00', 'scheduled', 'Patient has mild chest pain.', 101, '2024-09-19 12:10:44', '2024-09-19 12:10:44'),
(2, 1, 1, 2, '2024-09-21', '14:30:00', '15:00:00', 'completed', 'Patient diagnosed with migraine.', 102, '2024-09-19 12:10:44', '2024-09-19 12:10:44'),
(3, 1, 2, 3, '2024-09-22', '10:45:00', '11:15:00', 'scheduled', '', 103, '2024-09-19 12:10:44', '2024-09-19 12:10:44');

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
(2, 'https://example.com/images/article2.jpg', 'The Future of AI in Healthcare', 'Healthcare', 'How AI is transforming the healthcare industry and what to expect in the future.', 'Artificial Intelligence is revolutionizing healthcare in ways we never imagined...', '2024-11-04', 0, 4, '2024-11-11 08:48:58', '2024-11-11 08:53:00'),
(4, 'https://example.com/images/article1.jpg', 'The Role of Digital Health in Modern Healthcare Systems', 'Health System', 'An overview of how digital health solutions are reshaping healthcare delivery.', 'Digital health encompasses a wide range of technologies, from telemedicine to electronic health records, enabling more efficient, accessible healthcare. This article discusses how these systems improve patient care, streamline hospital operations, and reduce healthcare costs...', '2024-11-04', 0, 4, '2024-11-11 08:52:22', '2024-11-11 08:53:12'),
(5, 'https://example.com/images/article2.jpg', 'How Data Analytics is Improving Hospital Management', 'Health System', 'Exploring how data-driven insights help hospitals optimize their operations and improve patient outcomes.', 'Data analytics enables hospitals to make informed decisions based on patient demographics, treatment effectiveness, and operational performance. With the implementation of data analytics tools, health systems can enhance resource allocation, predict patient needs, and improve overall efficiency...', '2024-11-04', 0, 4, '2024-11-11 08:52:22', '2024-11-11 08:53:22'),
(6, 'https://example.com/images/article3.jpg', 'The Impact of AI on Health Systems Management', 'Health System', 'Examining the benefits of artificial intelligence in hospital management and patient care.', 'AI technologies, from machine learning algorithms to predictive analytics, are transforming health systems by assisting in diagnosis, optimizing workflows, and enhancing patient experiences. This article explores various AI applications within hospitals and the broader healthcare sector...', '2024-11-04', 0, 4, '2024-11-11 08:52:22', '2024-11-11 08:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `specialization`, `qualifications`, `created_at`, `updated_at`) VALUES
(1, 2, 'Cardiologist', 'MBBS, MD (Cardiology), FACC', '2024-09-19 12:10:44', '2024-09-19 12:10:44'),
(2, 2, 'Neurologist', 'MBBS, MD (Neurology), Fellow AAN', '2024-09-19 12:10:44', '2024-09-19 12:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `document_type` enum('private','lab_report','medical_report') NOT NULL,
  `document_path` text NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `user_id`, `uploaded_by`, `document_type`, `document_path`, `uploaded_at`) VALUES
(1, 1, 3, 'lab_report', '/documents/lab_report_001.pdf', '2024-09-19 12:10:44'),
(2, 1, 3, 'medical_report', '/documents/medical_report_001.pdf', '2024-09-19 12:10:44'),
(3, 1, 2, 'private', '/documents/personal_document_001.pdf', '2024-09-19 12:10:44');

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
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `available_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` enum('available','blocked') DEFAULT 'available',
  `max_patients` int(11) NOT NULL,
  `assigned_patients` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `doctor_id`, `available_date`, `start_time`, `end_time`, `status`, `max_patients`, `assigned_patients`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-09-20', '09:00:00', '13:00:00', 'available', 10, 5, '2024-09-19 12:10:44', '2024-09-19 12:10:44'),
(2, 1, '2024-09-21', '14:00:00', '17:00:00', 'available', 8, 3, '2024-09-19 12:10:44', '2024-09-19 12:10:44'),
(3, 2, '2024-09-22', '10:00:00', '15:00:00', 'available', 12, 4, '2024-09-19 12:10:44', '2024-09-19 12:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `NIC` varchar(50) DEFAULT NULL,
  `role` enum('patient','doctor','lab_clerk','record_clerk','reception_clerk','admin') NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone_number`, `NIC`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'hashedpassword1', '123-456-7890', '123456789V', 'patient', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43'),
(2, 'Dr. Alice Smith', 'alice.smith@example.com', 'hashedpassword2', '098-765-4321', '987654321V', 'doctor', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43'),
(3, 'Lab Clerk Bob', 'bob.clerk@example.com', 'hashedpassword3', '321-654-0987', '654987321V', 'lab_clerk', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43'),
(4, 'Admin Jane', 'jane.admin@example.com', 'hashedpassword4', '555-123-4567', '112233445V', 'admin', 1, '2024-09-19 12:10:43', '2024-09-19 12:10:43'),
(7, 'Michael John', 'michael.johnson@example.com', 'hashpass7', '321-654-0987', '556677889V', 'reception_clerk', 1, '2024-11-04 09:08:48', '2024-11-04 09:12:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`);

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
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `insuranceclaims`
--
ALTER TABLE `insuranceclaims`
  ADD CONSTRAINT `insuranceclaims_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `insuranceclaims_ibfk_2` FOREIGN KEY (`insurance_company_id`) REFERENCES `insurancecompanies` (`insurance_company_id`),
  ADD CONSTRAINT `insuranceclaims_ibfk_3` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
