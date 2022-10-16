CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(128) NOT NULL UNIQUE,
    `password` text NOT NULL,
    PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `formats` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(64) NOT NULL,
    PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `films` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `year` int(4) NOT NULL,
    `format_id` int NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (format_id) REFERENCES formats(id)
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `actors` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(128) NOT NULL,
    PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `film_actor` (
    film_id int NOT NULL,
    actor_id int NOT NULL,
    CONSTRAINT FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (actor_id) REFERENCES actors(id) ON DELETE CASCADE,
    PRIMARY KEY (film_id, actor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `formats` (`title`) VALUES ('VHS');
INSERT INTO `formats` (`title`) VALUES ('DVD');
INSERT INTO `formats` (`title`) VALUES ('Blu-ray');
