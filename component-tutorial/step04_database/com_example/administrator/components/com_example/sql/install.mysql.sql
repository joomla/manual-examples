DROP TABLE IF EXISTS `#__landmarks`;

CREATE TABLE `#__landmarks` (
	`id`        INT(11)     NOT NULL AUTO_INCREMENT,
	`title`     VARCHAR(25) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `#__landmarks` (`title`) VALUES
('The Eiffel Tower'),
('The Giant\'s Causeway');