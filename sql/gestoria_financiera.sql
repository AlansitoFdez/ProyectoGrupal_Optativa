-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 03, 2025 at 08:31 AM
-- Server version: 8.0.43
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestoria_financiera`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int NOT NULL,
  `currency_name` varchar(69) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_name`) VALUES
(1, 'USD'),
(2, 'EUR'),
(3, 'CHF');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_customers` int NOT NULL,
  `phone` int NOT NULL,
  `customer_name` varchar(69) NOT NULL,
  `customer_active` tinyint(1) NOT NULL,
  `birthdate` date NOT NULL,
  `currency_id_FK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customers`, `phone`, `customer_name`, `customer_active`, `birthdate`, `currency_id_FK`) VALUES
(1, 600101002, 'Carlos García', 1, '1995-02-02', 2),
(2, 600101003, 'María López', 1, '1988-05-14', 2),
(3, 600101004, 'Pedro Martín', 1, '1990-08-22', 1),
(4, 600101005, 'Ana Ruiz', 1, '1997-12-10', 3),
(5, 600101006, 'Lucía Torres', 1, '1998-07-03', 2),
(6, 600101007, 'Javier Ramos', 1, '1985-09-29', 2),
(7, 600101008, 'Paula Soto', 1, '1993-03-21', 1),
(8, 600101009, 'Miguel Vela', 1, '1992-11-01', 3),
(9, 600101010, 'Cristina Peña', 1, '1991-04-05', 2),
(10, 600101011, 'David Navarro', 1, '1986-06-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id_stocks` int NOT NULL,
  `quantity` int NOT NULL,
  `stock_name` varchar(69) NOT NULL,
  `in_use` tinyint(1) NOT NULL,
  `added_date` date NOT NULL,
  `id_wallet_FK` int DEFAULT NULL,
  `stock_type_id_FK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id_stocks`, `quantity`, `stock_name`, `in_use`, `added_date`, `id_wallet_FK`, `stock_type_id_FK`) VALUES
(1, 10, 'Apple Inc.', 1, '2025-01-10', 1, 1),
(2, 12, 'Microsoft Corp.', 1, '2025-01-15', 2, 2),
(3, 8, 'Amazon.com Inc.', 1, '2025-01-20', 3, 3),
(4, 9, 'Alphabet Inc.', 1, '2025-02-01', 4, 4),
(5, 6, 'Johnson & Johnson', 1, '2025-02-12', 5, 5),
(6, 5, 'Nestlé', 1, '2025-03-01', 6, 6),
(7, 13, 'Banco Santander', 1, '2025-03-10', 7, 7),
(8, 4, 'Siemens AG', 1, '2025-03-18', 8, 8),
(9, 11, 'Tesla Inc.', 1, '2025-04-01', 9, 9),
(10, 7, 'Novartis', 1, '2025-04-12', 10, 10),
(11, 5, 'Apple Inc.', 1, '2025-04-20', 11, 1),
(12, 4, 'Microsoft Corp.', 1, '2025-05-01', 12, 2),
(13, 3, 'Amazon.com Inc.', 1, '2025-05-09', 13, 3),
(14, 2, 'Alphabet Inc.', 1, '2025-05-15', 14, 4),
(15, 8, 'Nestlé', 1, '2025-06-01', 15, 6),
(16, 6, 'Tesla Inc.', 1, '2025-06-10', 16, 9),
(17, 5, 'Banco Santander', 1, '2025-07-01', 17, 7),
(18, 13, 'Johnson & Johnson', 1, '2025-07-15', 18, 5),
(19, 9, 'Novartis', 1, '2025-08-01', 19, 10),
(20, 6, 'Siemens AG', 1, '2025-08-20', 20, 8),
(21, 10, 'Nestlé', 1, '2025-09-01', 21, 6),
(22, 5, 'Tesla Inc.', 1, '2025-09-10', 22, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stock_type`
--

CREATE TABLE `stock_type` (
  `stock_type_id` int NOT NULL,
  `stock_type_name` varchar(69) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_type`
--

INSERT INTO `stock_type` (`stock_type_id`, `stock_type_name`) VALUES
(1, 'Apple Inc.'),
(2, 'Microsoft Corp.'),
(3, 'Amazon.com Inc.'),
(4, 'Alphabet Inc.'),
(5, 'Johnson & Johnson'),
(6, 'Nestlé'),
(7, 'Banco Santander'),
(8, 'Siemens AG'),
(9, 'Tesla Inc.'),
(10, 'Novartis');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id_wallet` int NOT NULL,
  `money_amount` float NOT NULL,
  `wallet_name` varchar(69) NOT NULL,
  `wallet_active` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `wallet_type_id_FK` int DEFAULT NULL,
  `id_customers_FK` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id_wallet`, `money_amount`, `wallet_name`, `wallet_active`, `creation_date`, `wallet_type_id_FK`, `id_customers_FK`) VALUES
(1, 1500.75, 'WalletCG_Ahorro', 1, '2025-01-01', 1, 1),
(2, 3200.5, 'WalletCG_Inv', 1, '2025-01-02', 2, 1),
(3, 2100, 'WalletCG_Mixta', 1, '2025-01-03', 3, 1),
(4, 1800, 'WalletML_Ahorro', 1, '2025-02-01', 1, 2),
(5, 4000, 'WalletML_Inv', 1, '2025-02-02', 2, 2),
(6, 1200.5, 'WalletPM_Mixta', 1, '2025-03-01', 3, 3),
(7, 950.25, 'WalletPM_Ahorro', 1, '2025-03-02', 1, 3),
(8, 2300, 'WalletPM_Inv', 1, '2025-03-03', 2, 3),
(9, 1200, 'WalletAR_Ahorro', 1, '2025-04-01', 1, 4),
(10, 1100, 'WalletAR_Mixta', 1, '2025-04-02', 3, 4),
(11, 975, 'WalletLT_Inv', 1, '2025-05-01', 2, 5),
(12, 2000, 'WalletLT_Mixta', 1, '2025-05-02', 3, 5),
(13, 1630, 'WalletJR_Ahorro', 1, '2025-06-01', 1, 6),
(14, 1340, 'WalletJR_Inv', 1, '2025-06-02', 2, 6),
(15, 2500, 'WalletJR_Mixta', 1, '2025-06-03', 3, 6),
(16, 1200, 'WalletPS_Ahorro', 1, '2025-07-01', 1, 7),
(17, 1300, 'WalletPS_Mixta', 1, '2025-07-02', 3, 7),
(18, 2200, 'WalletMV_Ahorro', 1, '2025-08-01', 1, 8),
(19, 2100, 'WalletMV_Mixta', 1, '2025-08-02', 3, 8),
(20, 2800, 'WalletCP_Ahorro', 1, '2025-09-01', 1, 9),
(21, 3000, 'WalletCP_Inv', 1, '2025-09-02', 2, 9),
(22, 1700, 'WalletDN_Mixta', 1, '2025-10-01', 3, 10),
(23, 1550, 'WalletDN_Inv', 1, '2025-10-02', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_type`
--

CREATE TABLE `wallet_type` (
  `wallet_type_id` int NOT NULL,
  `wallet_type_name` varchar(69) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wallet_type`
--

INSERT INTO `wallet_type` (`wallet_type_id`, `wallet_type_name`) VALUES
(1, 'Ahorro'),
(2, 'Inversión'),
(3, 'Mixta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customers`),
  ADD KEY `fk_customer_currency` (`currency_id_FK`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_stocks`),
  ADD KEY `fk_stocks_wallet` (`id_wallet_FK`),
  ADD KEY `fk_stocks_stock_type` (`stock_type_id_FK`);

--
-- Indexes for table `stock_type`
--
ALTER TABLE `stock_type`
  ADD PRIMARY KEY (`stock_type_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id_wallet`),
  ADD KEY `fk_wallet_type` (`wallet_type_id_FK`),
  ADD KEY `fk_wallet_customers` (`id_customers_FK`);

--
-- Indexes for table `wallet_type`
--
ALTER TABLE `wallet_type`
  ADD PRIMARY KEY (`wallet_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customers` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_stocks` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stock_type`
--
ALTER TABLE `stock_type`
  MODIFY `stock_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id_wallet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wallet_type`
--
ALTER TABLE `wallet_type`
  MODIFY `wallet_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`currency_id_FK`) REFERENCES `currency` (`currency_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `fk_stocks_wallet` FOREIGN KEY (`id_wallet_FK`) REFERENCES `wallet` (`id_wallet`),
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`stock_type_id_FK`) REFERENCES `stock_type` (`stock_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `fk_wallet_customers` FOREIGN KEY (`id_customers_FK`) REFERENCES `customers` (`id_customers`),
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`wallet_type_id_FK`) REFERENCES `wallet_type` (`wallet_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
