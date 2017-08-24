-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 08:28 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getregistration` (IN `fname` VARCHAR(30), IN `lname` VARCHAR(30), IN `email` VARCHAR(100), IN `pwd` VARCHAR(500))  BEGIN
Insert into customer_master (First_Name,Last_Name,EmailId,Password) VALUES(fname,lname,email,pwd);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `BookId` int(11) NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `AuthorName` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Availability` int(11) NOT NULL,
  `TotalSold` int(11) NOT NULL,
  `ImageLocation` varchar(255) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_master`
--

INSERT INTO `book_master` (`BookId`, `BookName`, `AuthorName`, `Price`, `Availability`, `TotalSold`, `ImageLocation`, `CategoryName`) VALUES
(29, 'The Nest', 'Cynthia D’Aprix Sweeney', 16.41, 100, 5, '9780062414212_p0_v3_s192x300.png', 'Fiction'),
(30, 'Fool Me Once', 'Harlan Coben', 16.86, 100, 6, '9780525955092_p0_v3_s192x300.png', 'Fiction'),
(31, 'As time Goes By', 'Mary Higgins Clark', 16.25, 100, 7, '9781501130441_p0_v1_s192x300.png', 'Fiction'),
(32, 'The 14th Colony', 'Steve Barry', 17.12, 100, 8, '9781250056245_p0_v3_s192x300.png', 'Fiction'),
(33, 'The Beast', 'J. R. Ward', 18.05, 100, 9, '9780451475169_p0_v1_s192x300.png', 'Fiction'),
(34, 'Family Jewels', 'Staurt Woods', 16.86, 100, 10, '9780399174698_p0_v1_s192x300.png', 'Fiction'),
(35, 'The Girl on The Train', 'Paula Hawkins', 16.49, 100, 11, '9781594633669_p0_v4_s192x300.png', 'Fiction'),
(36, 'Private Paris', 'James Patterson', 19.39, 100, 12, '9780316407052_p0_v3_s192x300.png', 'Fiction'),
(37, 'The Nightingale', 'Kristin Hannah', 17.12, 100, 13, '9780312577223_p0_v4_s192x300.png', 'Fiction'),
(38, 'Miller’s Valley', 'Anna Quindlen', 16.86, 100, 14, '9780399588563_p0_v2_s192x300.png', 'Fiction'),
(39, 'The rainbow comes and goes: A mother and son on life, love and loss', 'Anderson Cooper', 17.49, 100, 15, '9780062454942_p0_v2_s192x300.png', 'Non-Fiction'),
(40, 'The Life-Changing Magic of Tidying Up: The Japanese Art of Decluttering and Organizing', 'Marie Kondo', 10.62, 100, 16, '9781607747307_p0_v6_s192x300.png', 'Non-Fiction'),
(41, 'The Longevity Book: The science of aging, and the privilege of time', 'Cameron Diaz', 17.06, 100, 17, '9780062464101_p0_v2_s192x300.png', 'Non-Fiction'),
(42, 'When Breath Becomes Air', 'Paul Kalanithi', 15.3, 100, 18, '9780812988406_p0_v2_s192x300.png', 'Non-Fiction'),
(43, 'Dream Home: The Property Brothers Ultimate Guide to Finding and Fixing your Perfect House', 'Jonathan Scott, Drew Scott', 19.89, 100, 19, '9780544715677_p0_v4_s192x300.png', 'Non-Fiction'),
(44, 'Cravings: Recipes for all the food you want to eat', 'Chrissy Teigen', 17.85, 100, 20, '9781101903919_p0_v3_s192x300.png', 'Non-Fiction'),
(45, 'The End of Heart Disease: The eat to live plan to prevent and reverse heart disease', 'Joel Furhuam', 17.67, 100, 21, '9780062249357_p0_v2_s192x300.png', 'Non-Fiction'),
(46, 'Becoming Granma: The joys and science of new Grandparenting', 'Lesley Stahl', 17.2, 100, 22, '9780399168154_p0_v1_s192x300.png', 'Non-Fiction'),
(47, 'Eat Fat, Get Thin: Why the fat we eat is the key to sustained weight loss and vibrant health', 'Mark Hyman', 17.07, 100, 23, '9780316338837_p0_v2_s192x300.png', 'Non-Fiction'),
(48, 'The Immortal Irishman: The Irish Revolutionary who became an American Hero', 'Timothy Egan', 17.53, 100, 24, '9780544272880_p0_v3_s192x300.png', 'Non-Fiction'),
(49, 'Alexander Hamilton', 'Ron Chernow', 24.94, 100, 25, '9780143034759_p0_v6_s192x300.png', 'History'),
(50, 'The Immortal life of Henrietta Lacks', 'Rebecca Skloot', 17.48, 100, 26, '9781400052189_p0_v3_s192x300.png', 'History'),
(51, 'Between the World and Me', 'Ta- Nehesi Coates', 15, 100, 27, '9780812993547_p0_v4_s192x300.png', 'History'),
(52, 'Walden and Other Writings', 'Henry David Thoreau', 17.5, 100, 28, '9780553212464_p0_v1_s192x300.png', 'History'),
(53, 'Harry Potter and the Cursed Child - Parts I & II', ' J.K. Rowling,', 17.99, 100, 29, 'Harry Potter and the Cursed Child - Parts I & II.png', 'Kids'),
(54, 'Fantastic Beasts and Where to Find Them: The Original Screenplay', 'J.K. Rowling', 17.49, 100, 0, 'Fantastic Beasts and Where to Find Them: The Original Screenplay.png', 'Kids'),
(55, 'The Hidden Oracle (B&N Exclusive Edition) (The Trials of Apollo Series #1)', 'Rick Riordan', 12.99, 100, 0, 'The Hidden Oracle (B&N Exclusive Edition) (The Trials of Apollo Series #1).png', 'Kids'),
(56, 'Fantastic Beasts and Where to Find Them (Harry Potter Series)', 'J.K Rowling', 9.99, 100, 0, 'Fantastic Beasts and Where to Find Them (Harry Potter Series).png', 'Kids'),
(57, 'I Wish You More', 'Amy Krouse', 9.91, 100, 0, 'I Wish You More.png', 'Kids'),
(58, 'The Day the Crayons Quit', 'Drew Daywalt', 13.22, 100, 0, 'The Day the Crayons Quit.png', 'Kids'),
(59, 'First 100 Soft to Touch Numbers, Shapes and Colors', 'Roger Priddy', 4.71, 100, 0, 'First 100 Soft to Touch Numbers, Shapes and Colors.png', 'Kids'),
(60, 'The Giving Tree', 'Shel Silverstein ', 10.62, 100, 0, 'The Giving Tree.png', 'Kids'),
(61, 'The Jungle Book', 'Rudyard Kipling', 9, 100, 0, 'The Jungle Book.png', 'Kids'),
(62, 'The Raven King (Raven Cycle Series #4)', 'Maggie Stiefvater', 19.99, 100, 0, 'The Raven King (Raven Cycle Series #4).png', 'Teens'),
(63, 'The Crown', 'Kiera Cass', 13.99, 100, 0, 'The Crown.png', 'Teens'),
(64, 'The Last Star: The Final Book of The 5th Wave', 'Rick Yansey', 11.61, 100, 0, 'The Last Star: The Final Book of The 5th Wave.png', 'Teens'),
(65, 'The Star-Touched Queen', 'Roshani Chokshi', 12.1, 100, 0, 'The Star-Touched Queen.png', 'Teens'),
(66, 'Lady Midnight (B&N Exclusive Edition) (Dark Artifices Series #1)', 'Cassandra Clare', 14.69, 100, 0, 'Lady Midnight (B&N Exclusive Edition) (Dark Artifices Series #1).png', 'Teens'),
(67, 'Library of Souls: The Third Novel of Miss Peregrines Peculiar Children', 'Ransom Riggs', 12, 100, 0, 'Library of Souls: The Third Novel of Miss Peregrines Peculiar Children.png', 'Teens'),
(68, 'Go Big or Go Home: The Journey Toward the Dream (Signed Book)', 'Scott Mccreery', 18.07, 100, 0, 'Go Big or Go Home: The Journey Toward the Dream (Signed Book).png', 'Teens'),
(69, 'Glass Sword (Red Queen Series #2)', 'Victoria Aveyard', 12.03, 100, 0, 'Glass Sword (Red Queen Series #2).png', 'Teens'),
(70, 'The Tales of Beedle the Bard (Harry Potter Series)', 'J.K. Rowling', 8.48, 100, 0, 'The Tales of Beedle the Bard (Harry Potter Series).png', 'Teens'),
(71, 'Eat Dirt: Why Leaky Gut May Be the Root Cause of Your Health Problems and 5 Surprising Steps to Cure It', 'Josh Axe', 17.29, 100, 0, 'Eat Dirt: Why Leaky Gut May Be the Root Cause of Your Health Problems and 5 Surprising Steps to Cure It.png', 'Health & Fitness'),
(72, 'Pretty Happy: Healthy Ways to Love Your Body (Signed Book)', 'Kate Hudson', 16.45, 100, 0, 'Pretty Happy: Healthy Ways to Love Your Body (Signed Book).png', 'Health & Fitness'),
(73, 'The Prime: Prepare and Repair Your Body for Spontaneous Weight Loss', 'Kulreet Chaudary', 16.06, 100, 0, 'The Prime: Prepare and Repair Your Body for Spontaneous Weight Loss.png', 'Health & Fitness');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id_user` int(30) NOT NULL,
  `quantity` int(50) NOT NULL,
  `id_product` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id_user`, `quantity`, `id_product`) VALUES
(11, 1, 25),
(11, 1, 23),
(11, 1, 14),
(11, 1, 22),
(11, 1, 17),
(11, 1, 9),
(15, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `Customer_Id` int(4) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `EmailId` varchar(100) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `IsAdmin` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`Customer_Id`, `First_Name`, `Last_Name`, `EmailId`, `Password`, `IsAdmin`) VALUES
(13, 'Shoaib', 'Khan', 's@k.com', '34e77bd26df99984e31303e1b47bebdf7fea70db62ddf0e71f44ebb8474d9b79', NULL),
(14, 'Admin', 'Account', 'seca', 'c42edefc75871e4ce2146fcda67d03dda05cc26fdf93b17b55f42c1eadfdc322', 1),
(15, 'Matt', 'Demo', 'm@d.com', '34e77bd26df99984e31303e1b47bebdf7fea70db62ddf0e71f44ebb8474d9b79', NULL),
(16, 'Sreeram', 'Red', 's@r.com', '34e77bd26df99984e31303e1b47bebdf7fea70db62ddf0e71f44ebb8474d9b79', NULL),
(17, 'Abhi', 'Ko', 'a@k.com', '34e77bd26df99984e31303e1b47bebdf7fea70db62ddf0e71f44ebb8474d9b79', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `OrderId` varchar(5) NOT NULL,
  `ItemId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OrderId`, `ItemId`) VALUES
('0', 24),
('20', 23),
('21', 16),
('22', 10),
('22', 9),
('23', 22),
('24', 16),
('25', 22),
('25', 26),
('26', 12),
('26', 20),
('27', 20);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `OrderId` int(5) NOT NULL,
  `CustomerId` int(4) NOT NULL,
  `TransactionId` varchar(255) NOT NULL,
  `PayerId` varchar(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `Amount` float NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `Zipcode` int(10) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `PaymentStatus` varchar(255) NOT NULL,
  `DispatchStatus` varchar(10) NOT NULL,
  `CancelStatus` varchar(255) NOT NULL,
  `OrderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`OrderId`, `CustomerId`, `TransactionId`, `PayerId`, `Token`, `Amount`, `FullName`, `Address`, `City`, `State`, `Zipcode`, `Contact`, `PaymentStatus`, `DispatchStatus`, `CancelStatus`, `OrderDate`) VALUES
(19, 11, 'PAY-00W99260WK1829903K4O2CJA', 'JA4KNAXN6WZKC', 'EC-04605846AJ329314S', 0, 'SH KH', '123 Shk ', 'Denton', 'TX', 76201, '9409409400', 'Paid', 'In Progres', 'N/A', '2016-04-25 11:03:00'),
(20, 11, 'PAY-4M6384045E2176020K4PEQQI', 'UN6TM28Y2GY62', 'EC-4GC64363E18555949', 0, 'shkh', '123 Shk ', 'Denton', 'tx', 76201, '1902120', 'Paid', 'In Progres', 'N/A', '2016-04-25 11:45:19'),
(21, 11, 'PAY-44K43652R15942722K4PEZBQ', 'S2RQW3PGC4WK8', 'EC-7JX81912VF103251P', 0, 'SH K', '123 Shk ', 'Denton', 'tx', 76201, '12345678', 'Paid', 'In Progres', 'N/A', '2016-04-25 11:58:38'),
(22, 11, 'PAY-8VM47691N6955372JK4PE34Y', 'BVY3NG533U9VQ', 'EC-72N90439S6836892R', 0, 'shk', '123 Shk ', 'Denton', 'tx', 76201, '3232423432', 'Paid', 'In Progres', 'N/A', '2016-04-25 12:05:13'),
(23, 11, 'PAY-6NT321880E4059353K4PE6HA', '5FWBEMRFCJGM6', 'EC-98H380186G612213V', 0, '12', '123 Shk ', 'Denton', 'tx', 76, '12', 'Paid', 'In Progres', 'N/A', '2016-04-25 12:09:49'),
(24, 11, 'PAY-44N56890GM1208302K4PFECQ', 'YKQXZRRH5MF42', 'EC-69J460266H2569628', 0, '12', '123 Shk ', 'Denton', 'tx', 12, '12', 'Paid', 'In Progres', 'N/A', '2016-04-25 12:22:17'),
(25, 13, 'PAY-9FN255649Y723081GK4PLBLQ', 'BZMR8GXX9LBSE', 'EC-8VE918562Y429924T', 0, 'Shk', '123 Shk ', 'Denton', 'TX', 76201, '1231231233', 'Paid', 'In Progres', 'N/A', '2016-04-25 19:06:33'),
(26, 16, 'PAY-96292371PP485042YK4PL4KQ', 'SJG67AEJGPFCS', 'EC-0LM49838PK296035F', 0, 'Sreeram Red', '123 Shk ', 'Denton', 'Texas', 76201, '12345678', 'Paid', 'In Progres', 'N/A', '2016-04-25 20:03:52'),
(27, 17, 'PAY-5FE44940JD561705BK4PMEHA', 'WH98N68UF9FAS', 'EC-9HJ90145RM052580Y', 0, 'Abhi', '123 Shk ', 'Denton', 'tx', 76201, '12345678', 'Paid', 'In Progres', 'N/A', '2016-04-25 20:20:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_master`
--
ALTER TABLE `book_master`
  ADD PRIMARY KEY (`BookId`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`OrderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_master`
--
ALTER TABLE `book_master`
  MODIFY `BookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `Customer_Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `OrderId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
