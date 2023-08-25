-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`) VALUES
(1,	'aurelie@oclock.fr',	'[ROLE_USER]',	'$2y$13$6P2MXC/9APPU/9MB7sNGXOCH36ipx2HwqdhDdCEc/1e1C0nq6FxZC',	'totoro'),
(2,	'benjamin@leaddev.fr',	'[ROLE_ADMIN]',	'$2y$13$RFWfLpcJPxgMBAYeg6iz/eOKcF83JZVm6bmf2MPvhc/j78ZJWeKBu',	'benjamin');

-- 2023-08-25 09:05:46