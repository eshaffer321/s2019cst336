CREATE DATABASE IF NOT EXISTS `crime_tips` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crime_tips`;

DROP TABLE IF EXISTS `accused`;
CREATE TABLE IF NOT EXISTS `accused` (
  `accused_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`accused_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

DROP TABLE IF EXISTS `case`;
CREATE TABLE IF NOT EXISTS `case` (
  `name` varchar(60) NOT NULL DEFAULT '',
  `case_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

DROP TABLE IF EXISTS `charge`;
CREATE TABLE IF NOT EXISTS `charge` (
  `charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `charge_type_id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `victim_id` int(11) DEFAULT NULL,
  `accused_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`charge_id`),
  KEY `case_id` (`case_id`),
  KEY `victim_id` (`victim_id`),
  KEY `accused_id` (`accused_id`),
  KEY `charge_type_id` (`charge_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

DROP TABLE IF EXISTS `charge_severity`;
CREATE TABLE IF NOT EXISTS `charge_severity` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `charge_type`;
CREATE TABLE IF NOT EXISTS `charge_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `charge_severity_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charge_severity_id` (`charge_severity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `victim`;
CREATE TABLE IF NOT EXISTS `victim` (
  `victim_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`victim_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


ALTER TABLE `charge`
  ADD CONSTRAINT `charge_ibfk_4` FOREIGN KEY (`charge_type_id`) REFERENCES `charge_type` (`id`),
  ADD CONSTRAINT `charge_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `case` (`case_id`),
  ADD CONSTRAINT `charge_ibfk_2` FOREIGN KEY (`victim_id`) REFERENCES `victim` (`victim_id`),
  ADD CONSTRAINT `charge_ibfk_3` FOREIGN KEY (`accused_id`) REFERENCES `accused` (`accused_id`);

ALTER TABLE `charge_type`
  ADD CONSTRAINT `charge_type_ibfk_1` FOREIGN KEY (`charge_severity_id`) REFERENCES `charge_severity` (`id`);

INSERT INTO `accused` (`accused_id`, `name`) VALUES
(1, 'Maria'),
(2, 'Mary'),
(3, 'Teddy'),
(4, 'Sara'),
(5, 'Edward'),
(6, 'Carlos');

INSERT INTO `case` (`name`, `case_id`, `log_timestamp`) VALUES
('Hamburglar', 1, '0000-00-00 00:00:00'),
('Neighborhood', 2, '0000-00-00 00:00:00');

INSERT INTO `charge_severity` (`id`, `name`) VALUES
(1, 'Minor'),
(2, 'Major');

INSERT INTO `charge_type` (`id`, `name`, `charge_severity_id`) VALUES
(1, 'Breaking and Entering', NULL),
(2, 'Trespassing', 2),
(3, 'Destruction of Property', NULL),
(4, 'Assault', NULL),
(5, 'Theft', NULL),
(6, 'Gluttony', NULL);

INSERT INTO `victim` (`victim_id`, `name`) VALUES
(1, 'Juan'),
(2, 'John'),
(3, 'Rose'),
(4, 'Philip'),
(5, 'Keisha'),
(6, 'Diana');

INSERT INTO `charge` (`charge_id`, `case_id`, `charge_type_id`, `name`, `victim_id`, `accused_id`) VALUES
(1, 1, 1, 'Break In', 1, 1),
(2, 2, 3, 'Egging of Premises', 1, 2),
(3, 1, 5, 'Eating of Unpurchased Beef', 1, 2),
(4, 1, 6, 'Excessive Ketchup Use', 2, 2);