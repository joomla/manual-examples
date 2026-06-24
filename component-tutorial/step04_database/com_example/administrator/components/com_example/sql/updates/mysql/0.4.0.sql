DROP TABLE IF EXISTS `#__landmark`;

CREATE TABLE `#__landmark` (
    `id`        INT(11)     NOT NULL AUTO_INCREMENT,
    `title`     VARCHAR(25) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `#__landmark` (`title`) VALUES
('The Eiffel Tower'),
('The Giant\'s Causeway');