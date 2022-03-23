-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2022 at 11:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `errand_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_bids`
--

CREATE TABLE `accepted_bids` (
  `accepted_bid_id` varchar(200) NOT NULL,
  `accepted_bid_bidding_id` varchar(200) NOT NULL,
  `accepted_bid_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `biddings`
--

CREATE TABLE `biddings` (
  `bidding_id` varchar(200) NOT NULL,
  `bidding_description` longtext DEFAULT NULL,
  `bidding_amount` varchar(200) DEFAULT NULL,
  `bidding_errand_id` varchar(200) NOT NULL,
  `bidding_user_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `errands`
--

CREATE TABLE `errands` (
  `errand_id` varchar(200) NOT NULL,
  `errand_name` longtext DEFAULT NULL,
  `errand_description` longtext DEFAULT NULL,
  `errand_amount` varchar(200) DEFAULT NULL,
  `errand_due_date` varchar(200) DEFAULT NULL,
  `errand_user_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `errands`
--

INSERT INTO `errands` (`errand_id`, `errand_name`, `errand_description`, `errand_amount`, `errand_due_date`, `errand_user_id`) VALUES
('2628bdc42a43fb763f1489265a9f92fccac84011d633', 'Electrical Supplies', 'I need a trustworthy and experienced freelancer to run an electrical errand for me. Kindly note that the products are very fragile, handle them with great care.', '900000', '2022-04-09', 'a2cd5e242475b057bcedc08cf195a83c6b30a04a4ed1'),
('2916d2cf64f42525c8ed28c0bca641f7fe2ddda610e7', 'Farm Supplies', 'i need a freelancer to deliver hay to my ranch in 89012-Drive Localhost as soon as possible', '15000', '2022-03-30', 'a2cd5e242475b057bcedc08cf195a83c6b30a04a4ed1'),
('36a73587ad58c6bf88d63907d52781fe8fcc2c696b6f', 'Appliance Delivery', 'I need a freelancer to run  Konical Minolta printer delivery errand to my office , address is 90126 Localhost.', '9000', '2022-04-07', 'bd11af26ac31f64ad60e142e59d670c4c82a84b57c2e'),
('3a6aebe15eac46781ee5040ce31377a8f36944292b93', 'Dairy Products Supply', 'I need a freelancer to ship dairy products from my ranch in 90127 Drive Localhost to the remote market at 9008 Localhost.', '9000', '2022-03-31', 'a2cd5e242475b057bcedc08cf195a83c6b30a04a4ed1'),
('5af34f419818510d5e942f9b4605b0ec069412694f79', 'Groceries Shopping and supplies', 'I need a freelancer to run groceries and house supplies for me and deliver them at my appartment, address is 90126 Localhost.', '1000', '2022-03-30', 'bd11af26ac31f64ad60e142e59d670c4c82a84b57c2e'),
('9c940ea13716a615710a56596c7d65186918f611a66b', 'Pizza Delivery', 'Deliver pizzas from Pizza Inn to my appartment, details  and addreess will be given later after bidding', '1500', '2022-03-30', 'bd11af26ac31f64ad60e142e59d670c4c82a84b57c2e');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_email` varchar(200) DEFAULT NULL,
  `login_password` varchar(200) DEFAULT NULL,
  `login_rank` varchar(200) DEFAULT NULL,
  `login_question` longtext DEFAULT NULL,
  `login_answer` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_email`, `login_password`, `login_rank`, `login_question`, `login_answer`) VALUES
('00468bfab2ad8d9f40b4de959639d3e1c94f5bebb94a', 'james@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Freelancer', NULL, NULL),
('26e058c6da0fa822df392f9620c05e679c79f59337e5', 'janedoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Client', NULL, NULL),
('297c136585fa0dafd2099a55b46e492af3d87e11f2e2', 'dojacat@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Client', NULL, NULL),
('2addef8df354f5c5d323e8d5c233c9826c1b8f8958e4', 'loremipsum@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Client', NULL, NULL),
('3ddc342dbb2b412613523ff7cbaad607cc61195b6a67', 'jb@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator', NULL, NULL),
('96832a50e0341bd238e6b2670fd796cf882bc981d693', 'sysadmin@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator', 'What is my pets name?', 'Rocinante');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` varchar(200) NOT NULL,
  `payment_amount` varchar(200) DEFAULT NULL,
  `payment_date` varchar(200) DEFAULT NULL,
  `payment_ref` varchar(200) DEFAULT NULL,
  `payment_mode` varchar(200) DEFAULT NULL,
  `payment_accepted_bid_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(200) NOT NULL,
  `user_fname` varchar(200) DEFAULT NULL,
  `user_lname` varchar(200) DEFAULT NULL,
  `user_contact` varchar(200) DEFAULT NULL,
  `user_location` longtext DEFAULT NULL,
  `user_gender` varchar(200) DEFAULT NULL,
  `user_age` varchar(200) DEFAULT NULL,
  `user_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_contact`, `user_location`, `user_gender`, `user_age`, `user_login_id`) VALUES
('5212f2747b2d653e5be981a9c1fbbc47feb89fd35ef4', 'System', 'Admin', '0712456790', '90126 Localhost', 'Male', '56', '96832a50e0341bd238e6b2670fd796cf882bc981d693'),
('a2cd5e242475b057bcedc08cf195a83c6b30a04a4ed1', 'Lorem I', 'Ipsum', '12567904', '127 Milwaukee', 'Male', '39', '2addef8df354f5c5d323e8d5c233c9826c1b8f8958e4'),
('bd11af26ac31f64ad60e142e59d670c4c82a84b57c2e', 'Jane', 'Doe', '9001267874', '1234 Localhost', 'Female', '30', '26e058c6da0fa822df392f9620c05e679c79f59337e5'),
('c842ac1e63ec0745c48a434ee2d978f8dfc9a876c360', 'Bond', 'James', '90023677853', '127 London', 'Male', '49', '3ddc342dbb2b412613523ff7cbaad607cc61195b6a67'),
('cba40f2dee3334cc90b3024280457cfd81eee64ee4be', 'Doe J', 'Cat', '900346678', '1270 Localhost', 'Female', '27', '297c136585fa0dafd2099a55b46e492af3d87e11f2e2'),
('f2f04d5c93d0eda90d34128bcb48d563d796281e6ef1', ' Doe', 'James', '+254789875423', '1290 Boston', 'Male', '57', '00468bfab2ad8d9f40b4de959639d3e1c94f5bebb94a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_bids`
--
ALTER TABLE `accepted_bids`
  ADD PRIMARY KEY (`accepted_bid_id`),
  ADD KEY `AcceptedBiddingID` (`accepted_bid_bidding_id`);

--
-- Indexes for table `biddings`
--
ALTER TABLE `biddings`
  ADD PRIMARY KEY (`bidding_id`),
  ADD KEY `BiddingUserID` (`bidding_user_id`),
  ADD KEY `BiddingErrandID` (`bidding_errand_id`);

--
-- Indexes for table `errands`
--
ALTER TABLE `errands`
  ADD PRIMARY KEY (`errand_id`),
  ADD KEY `ErrandUserID` (`errand_user_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `PaymentAcceptedBid` (`payment_accepted_bid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `UserLogin` (`user_login_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_bids`
--
ALTER TABLE `accepted_bids`
  ADD CONSTRAINT `AcceptedBiddingID` FOREIGN KEY (`accepted_bid_bidding_id`) REFERENCES `biddings` (`bidding_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `biddings`
--
ALTER TABLE `biddings`
  ADD CONSTRAINT `BiddingErrandID` FOREIGN KEY (`bidding_errand_id`) REFERENCES `errands` (`errand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BiddingUserID` FOREIGN KEY (`bidding_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `errands`
--
ALTER TABLE `errands`
  ADD CONSTRAINT `ErrandUserID` FOREIGN KEY (`errand_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `PaymentAcceptedBid` FOREIGN KEY (`payment_accepted_bid_id`) REFERENCES `accepted_bids` (`accepted_bid_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `UserLogin` FOREIGN KEY (`user_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
