CREATE TABLE IF NOT EXISTS `#__example_landmarks` (
    `id`        INT(11)     NOT NULL AUTO_INCREMENT,
    `title`     VARCHAR(40) NOT NULL,
    `description` TEXT      NOT NULL,
    `published` TINYINT(4) NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
);

INSERT INTO `#__example_landmarks` (`title`, `description`, `published`) VALUES
('The Eiffel Tower', '', 1),
('The Giant\'s Causeway', '', 1);