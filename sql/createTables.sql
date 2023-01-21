-- table for users
CREATE TABLE IF NOT EXISTS `Users` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`uname` varchar(50) NOT NULL,
	`password` varchar(50) NOT NULL
);


-- table for all movies
CREATE TABLE IF NOT EXISTS `Movies` (
	`id` int NOT NULL PRIMARY KEY,
	`poster` varchar(100) NOT NULL,
	`header` varchar(55) NOT NULL,
	`watchlist` varchar(100) NOT NULL,
	`title` varchar(50) NOT NULL,
	`genre` varchar(50) NOT NULL,
	`year` int(5) UNSIGNED NOT NULL,
	`hours` varchar(10) NOT NULL,
	`rate` varchar(50) NOT NULL,
	`mtrcb` varchar(6) NOT NULL,
	`director` varchar(100) NOT NULL,
	`stars` varchar(150) NOT NULL,
	`summary` varchar(1650) NOT NULL,
	`price` int(5) UNSIGNED NOT NULL
);

-- table for watchlist
CREATE TABLE IF NOT EXISTS `Watchlist` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user` varchar(50) NOT NULL,
	`title` varchar(100) NOT NULL
);

-- table for rents
CREATE TABLE IF NOT EXISTS `Rent` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user` varchar(50) NOT NULL,
	`title` varchar(50) NOT NULL,
	`poster` varchar(100) NOT NULL,
	`name` varchar(100) NOT NULL,
	`contact` varchar(14) NOT NULL,
	`address` varchar(150) NOT NULL,
	`rentStart` date,
	`rentEnd` date,
	`rDays` int,
	`price` int,
	`total` int,

	`status` varchar(8) NOT NULL,
	`code` varchar(6) NOT NULL
);

-- table for top 5 movies
CREATE TABLE IF NOT EXISTS `Top5` (
	`imgTop` varchar(50) NOT NULL,
	`title` varchar(50) NOT NULL,
	`genre` varchar(50) NOT NULL,
	`year` int(5) UNSIGNED,
	`hrs` varchar(10) NOT NULL,
	`rate` varchar(50) NOT NULL,
	`mtrcb` varchar(50) NOT NULL
);