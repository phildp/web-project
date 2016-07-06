-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2014 at 02:55 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `it2014_5022_5055`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`name`) VALUES
('Εξυπηρέτηση'),
('Εργασιακά δικαιώματα'),
('Ποιότητα'),
('Τιμές'),
('Υγιεινή');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('Ανοικτό','Κλειστό') NOT NULL DEFAULT 'Ανοικτό',
  `author` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `response` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `solvedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `solvedby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `category` (`category`),
  KEY `solvedby` (`solvedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `category`, `description`, `status`, `author`, `image`, `response`, `created`, `lat`, `lng`, `solvedat`, `solvedby`) VALUES
(1, 'Βρώμικη τουαλέτα', 'Υγιεινή', 'Στο εστιατόριο "Το καθαρό"...', 'Κλειστό', 'user1', 'wc.JPG', 'Katharise', '2014-06-14 18:50:49', 38.260597, 21.750216, '2014-06-16 21:10:31', 'phildp'),
(2, 'Πολύ ακριβές τιμές στο "Σουβλάκια ο Γιάννης"', 'Τιμές', 'Στα ορεκτικά οι τιμές ήταν απαράδεκτα υψηλές....', 'Κλειστό', 'blackeye', 'no-photo.png', 'ok', '2014-06-14 18:52:29', 38.266258, 21.749872, '2014-06-28 19:59:02', 'phildp'),
(3, 'Αγενέστατο προσωπικό', 'Εξυπηρέτηση', 'Αναφέρομαι για το μπαρ "The sun"', 'Κλειστό', 'blackeye', 'no-photo.png', 'Τους απολύσαμε όλους', '2014-06-14 18:53:33', 38.270573, 21.740602, '2014-06-14 19:37:53', 'blackeye'),
(4, 'Χαλασμένο φαγητό στο εστιατόριο "Ο Νίκος"', 'Ποιότητα', 'Η φωτογραφία τα λέει όλα', 'Κλειστό', 'blackeye', 'dirty_food_scraps.jpg', 'Ok', '2014-06-14 18:54:48', 38.260868, 21.743692, '2014-06-16 21:09:34', 'phildp'),
(5, 'Μαζικές απολύσεις', 'Εργασιακά δικαιώματα', 'Χωρίς λόγο και αιτία απολύθηκαν 8 άτομα σε μια μέρα(εστιατόριο "Τα γουρούνια")', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-14 18:57:38', 38.242535, 21.728930, '2014-06-14 19:03:44', ''),
(7, 'Μουχλιασμένο burger', 'Ποιότητα', 'Στο "mr.burger"', 'Ανοικτό', 'blackeye', 'BadFood.jpg', '', '2014-06-14 19:02:15', 38.249344, 21.736313, '2014-06-14 19:03:58', ''),
(9, 'Πολύ παλιά τουαλέτα', 'Υγιεινή', 'Δεν γινόταν να την χρησιμοποιήσω γιατί σιχαινόμουνα', 'Ανοικτό', 'blackeye', 'WC-train-Ukraine.jpg', '', '2014-06-14 19:04:31', 38.241459, 21.745411, '2014-06-14 19:05:45', ''),
(10, 'Βρώμικη κουζίνα', 'Υγιεινή', 'Το εστιατόριο "Ο Καθαρούλης" δεν τιμάει και τόσο πολύ το όνομά του', 'Κλειστό', 'blackeye', '296911-dirty-restaurants-in-nsw.jpg', '', '2014-06-14 19:05:53', 38.295635, 21.794847, '2014-06-28 19:50:55', 'phildp'),
(11, 'Κακό προσωπικό', 'Εξυπηρέτηση', 'Δεν κατάλαβαν τί ζήτησα και τελικά δεν έφαγα', 'Ανοικτό', 'blackeye', 'bad-service-2.jpg', '', '2014-06-14 19:08:38', 38.236065, 21.731676, '2014-06-14 19:08:38', ''),
(12, 'Χαμηλοί μισθοί', 'Εργασιακά δικαιώματα', '300 ευρώ τον μήνα δεν είναι και πολλά', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-14 19:11:39', 38.225815, 21.771502, '2014-06-14 19:11:39', ''),
(13, 'Βρώμικος φούρνος', 'Υγιεινή', 'Στο εστιατόριο "Ο Καθαρός φούρνος"', 'Ανοικτό', 'blackeye', 'PD-food_20130406184234630238-620x414.jpg', '', '2014-06-14 19:12:31', 38.236603, 21.727556, '2014-06-14 19:12:31', ''),
(14, 'Ψηλές τιμές για την ποιότητα των κρεάτων', 'Τιμές', 'Κρεοπωλείο "Ο Αλέκος"', 'Κλειστό', 'blackeye', 'poor-quality-high-prices.jpg', 'Χαμηλώσαμε τις τιμές και αφήσαμε την ποιότητα ίδια', '2014-06-14 19:16:05', 38.198841, 21.714853, '2014-06-14 19:41:54', 'blackeye'),
(15, 'Αργή εξυπηρέτηση', 'Εξυπηρέτηση', 'Πολύ λίγο προσωπικό στα GOODY''s', 'Ανοικτό', 'blackeye', 'Goodys (1).jpg,Goodys.jpg,goodys1.jpg', '', '2014-06-14 19:20:01', 38.249428, 21.738083, '2014-06-14 19:20:01', ''),
(16, 'Βρώμικη σαλάτα', 'Ποιότητα', 'Το μαρούλι δεν ήταν καλά πλυμένο κι έκανα εμετό', 'Κλειστό', 'blackeye', 'no-photo.png', '', '2014-06-14 19:21:56', 38.251163, 21.787983, '2014-06-29 23:32:13', 'phildp'),
(17, 'Κατσαρίδα στο ταβάνι', 'Υγιεινή', 'Η ύπαρξη κατσαρίδας στο ταβάνι δηλώνει σίγουρα παραμέληση της υγιεινής του καταστήματος', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-14 19:23:13', 38.313957, 21.818880, '2014-06-14 19:23:13', ''),
(18, 'Ακριβό σουβλάκι', 'Τιμές', '2,5 ευρώ για ένα τόσο μικρό σουβλάκι?πάμε καλά?', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-14 19:24:25', 38.230400, 21.755365, '2014-06-14 19:24:25', ''),
(19, 'Τρίχες στο φαγητό', 'Ποιότητα', 'Ο μάγειρας θα έπρεπε να φοράει σκουφάκι', 'Ανοικτό', 'blackeye', 'l.jpg', '', '2014-06-14 19:26:24', 38.249008, 21.737858, '2014-06-14 19:26:24', ''),
(20, 'Συνεχόμενες ώρες δουλειάς', 'Εργασιακά δικαιώματα', 'Κανένα διάλειμμα το προσωπικό......Λογικό να κουράζεται και να κάνει λάθη', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-14 19:27:36', 38.241726, 21.728586, '2014-06-14 19:27:36', ''),
(21, 'Χαλασμένες ντομάτες', 'Ποιότητα', 'Χαλάγαν τη γεύση στην πίτα που πήρα', 'Ανοικτό', 'Harrycane', 'no-photo.png', '', '2014-06-14 19:29:16', 38.235256, 21.757425, '2014-06-15 14:53:50', ''),
(22, 'Λάθος προσωπικό', 'Εξυπηρέτηση', 'Σέ ένα τέτοιο νεανικό μαγαζί δεν θα έπρεπε να δουλεύουν γέροι αλλά φοιτητές...Για το μπαρ "Ο αιώνιος" αναφέρομαι...', 'Ανοικτό', 'newuser', 'no-photo.png', '', '2014-06-14 19:31:07', 38.222038, 21.725496, '2014-06-15 14:54:01', ''),
(23, 'Πανάκριβο εστιατόριο', 'Τιμές', 'Μέτριο φαγητό σε πολύ υψηλές τιμές.....Δεν πρόκειται να ξαναπατήσω το πόδι μου υπό αυτές τις συνθήκες', 'Ανοικτό', 'Harrycane', 'no-photo.png', '', '2014-06-14 19:32:28', 38.330116, 21.854931, '2014-06-15 14:54:08', ''),
(24, 'Κακό burger', 'Ποιότητα', 'Ήταν πολύ μεγάλο με πάρα πολύ μουστάρδα και δεν γινόταν να το φάω χωρίς να λερωθώ.....', 'Ανοικτό', 'kostaspapa13', 'Baddaddy21.jpg', '', '2014-06-14 19:35:39', 38.251701, 21.753651, '2014-06-15 14:54:17', ''),
(25, 'Απαράδεκτα προκλητικό ντύσιμο προσωπικού', 'Εξυπηρέτηση', 'Είμαστε και παντρεμένοι άνθρωποι....', 'Ανοικτό', 'blackeye', 'hot_bartender.jpg', '', '2014-06-14 19:39:49', 38.265720, 21.747128, '2014-06-14 19:39:49', ''),
(26, 'Τουαλέτα χωρίς χαρτί υγείας', 'Υγιεινή', 'Πως θα σκουπιστώ χωρίς χαρτί?', 'Ανοικτό', 'blackeye', 'toilet_square.jpg', '', '2014-06-14 19:40:52', 38.296173, 21.772877, '2014-06-14 19:40:52', ''),
(27, 'τραγικες τιμες!', 'Τιμές', 'οι τιμες σε πολλα μαγαζια στην πατρα ειναι τραγικες ελεος', 'Κλειστό', 'kostaspapa13', 'no-photo.png', 'Oute kan', '2014-06-15 11:42:17', 38.247929, 21.737514, '2014-06-16 21:11:05', 'phildp'),
(29, 'Πολυλογάς σερβιτόρος', 'Εξυπηρέτηση', 'Δεν μας άφηνε να μιλάμε', 'Ανοικτό', 'blackeye', 'no-photo.png', '', '2014-06-15 12:18:18', 38.297791, 21.778027, '2014-06-15 12:18:18', ''),
(31, 'Τιμές στα ύψη', 'Τιμές', 'Στο μπαρ "Ο Φτηνός"', 'Κλειστό', 'user2', 'no-photo.png', '', '2014-06-15 12:23:07', 38.272190, 21.740602, '2014-06-28 19:54:21', 'phildp'),
(33, 'Δεν επιτρέπεται να τρώει το προσωπικό στα διαλείμματα', 'Εργασιακά δικαιώματα', 'Πεθαίνουμε της πείνας', 'Ανοικτό', 'user2', 'no-photo.png', '', '2014-06-15 12:25:06', 38.306953, 21.791414, '2014-06-16 00:12:41', ''),
(34, 'Καλές τιμές αλλά απαράδεκτη ποιότητα', 'Ποιότητα', 'Στο σουβλατζίδικο "Τα 3 σκυλία"', 'Ανοικτό', 'user3', 'no-photo.png', '', '2014-06-15 12:26:13', 38.224735, 21.725496, '2014-06-15 14:52:44', ''),
(36, 'Εστιατόριο "Ο Λεφτάς"', 'Τιμές', 'Πολύ ακριβές μερίδες για το μέγεθός τους', 'Ανοικτό', 'user1', 'estiatorio_08.jpg,l_Roof-Garden-16.jpg,lumiere17.jpg,Smaller_Plate_Wont_Help_Your_Diet_Research_Shows.jpg', '', '2014-06-23 20:09:32', 38.260868, 21.744722, '2014-06-23 20:09:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `phone` varchar(10) NOT NULL DEFAULT '-',
  `salt` char(128) NOT NULL,
  `type` set('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`uname`),
  UNIQUE KEY `email` (`email`,`phone`),
  KEY `email_2` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `surname`, `email`, `uname`, `pass`, `phone`, `salt`, `type`) VALUES
('Admin', 'Test', 'admin@test.com', 'admin', '2b969b6997d9b04a542906ac6ff24479de98522232a9b9dab4d909f512f0b2ee', '', '264', 'admin'),
('Alex', 'Mavromatos', 'alex@blackeye.com', 'blackeye', '79092b5f77c839326e12c6fd27f909afc58779959e6d626f2fdf7be03e5148ab', '', '3ba', 'admin'),
('Harry', 'Nikitopoulos', 'harry@cane.com', 'Harrycane', 'c873e06a484b1b4921157b97b860a4f7c0a8fc33538364216fef9c9f1e5d7205', '', '1ac', 'user'),
('kostas', 'papadomanolakis', 'kostas_chania13@hotmail.com', 'kostaspapa13', '4f9b26ea65a8df6d2c5035961f4589f08004ad12ed788ca02e2af139eb00874e', '', 'b21', 'user'),
('New', 'Newrson', 'new@user.com', 'newuser', 'f3728f8e268eabcf809afa515da3641cbba49489a3539fbf913f8dd01e8dcaf5', '', 'a03', 'user'),
('Phil', 'Pavlopoulos', 'phil@pavlop.com', 'phildp', '122d91877e9841c4d10ced04c8a11c4f2afc22fa7e809147678ca8533bbeb05f', '', '2e0', 'admin'),
('User', '1', 'user1@email.com', 'user1', '9812c25f62ff4df177ad40efb1e5bf7514e0705c946a7f773fb4928173e06237', '', 'e96', 'user'),
('User', '2', 'user2@email.com', 'user2', '267186c4e9c7aee0c052eaf1b3572da5b8cf0ce9a17ff31da4535bcd5944050f', '', '17d', 'user'),
('User', '3', 'user3@email.com', 'user3', 'e02cbaf90d821114b5e4fce9509376c4842ea6b5673c3ea59714616906186f68', '', '62a', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
