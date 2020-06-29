-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12 юни 2020 в 14:33
-- Версия на сървъра: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skateshop`
--

-- --------------------------------------------------------

--
-- Структура на таблица `cartitems`
--

DROP TABLE IF EXISTS `cartitems`;
CREATE TABLE IF NOT EXISTS `cartitems` (
  `cartItem_id` int(10) NOT NULL AUTO_INCREMENT,
  `cart_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`cartItem_id`),
  KEY `CartItems_CartId_ForeignKey` (`cart_id`),
  KEY `CartItems_ProductId_ForeignKey` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `Carts_UserId_ForeignKey` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `cart_id` int(10) NOT NULL,
  `finalPrice` int(15) NOT NULL,
  `shipping` varchar(15) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `Orders_CartId_ForeignKey` (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `description` varchar(250) NOT NULL,
  `imageUrl` varchar(150) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `active`, `description`, `imageUrl`, `price`) VALUES
(1, 'Santa Cruz Board E45', 1, 'Това е семпла дъска подходяща за начинаещи. 7 слоя канадски клен.', 'board5ee2b427a5758', 62),
(2, 'Santa Cruz Board G9', 1, 'Това е сложна дъска подходяща за каране в рампа и за трикове. 9 слоя - бамбук + кандаски клен.', 'board5ee2ba8c946b6', 75),
(4, 'Elementz Deck R4', 1, 'Това е доста изискан и лимитиран продукт, прословут е със своята здравина и гъвкавост в екстремни ситуации.\r\n8 слоя - бреза + канадски клен', 'board5ee2b9d981486', 87);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password_users` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address_users` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `role_users` varchar(10) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_users`, `email`, `phone`, `address_users`, `active`, `role_users`, `firstName`, `lastName`) VALUES
(1, 'root', 'admin', 'admin@abv.bg', '0888227826', 'бул. „Цар Борис III-ти Обединител“ 128, 4000 Център, Пловдив', 1, 'admin', 'root', 'admin'),
(24, 'client', 'client', 'client@abv.bg', '0885654859', 'бул. „Цар Борис III-ти Обединител“ 128, 4000 Център, Пловдив', 1, 'client', 'John', 'Smith');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `CartItems_CartId_ForeignKey` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CartItems_ProductId_ForeignKey` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `Carts_UserId_ForeignKey` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_CartId_ForeignKey` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
