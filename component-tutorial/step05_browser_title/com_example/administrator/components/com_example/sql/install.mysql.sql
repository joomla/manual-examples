CREATE TABLE IF NOT EXISTS `#__example_landmarks` (
	`id`        INT(11)     NOT NULL AUTO_INCREMENT,
	`title`     VARCHAR(25) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `#__example_landmarks` (`title`) VALUES
('The Eiffel Tower'),
('The Giant\'s Causeway');