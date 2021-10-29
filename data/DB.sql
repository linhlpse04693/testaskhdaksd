SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `movie`
-- ----------------------------
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `title` varchar(150) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                         `description` varchar(300) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                         `year` varchar(4) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                         `name_of_director` varchar(100) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                         `release_date` datetime DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_nopad_ci;

-- ----------------------------
-- Records of movie
-- ----------------------------
INSERT INTO `movie` VALUES ('2', 'Movie 3', 'Test', '2020', 'Luca', '2021-09-01 00:00:00');

-- ----------------------------
-- Table structure for `song`
-- ----------------------------
DROP TABLE IF EXISTS `song`;
CREATE TABLE `song` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(150) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                        `name_of_album` varchar(150) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                        `year` varchar(4) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                        `name_of_artist` varchar(100) COLLATE utf8_general_nopad_ci DEFAULT NULL,
                        `release_date` datetime DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_nopad_ci;

-- ----------------------------
-- Records of song
-- ----------------------------
INSERT INTO `song` VALUES ('1', 'Song 2', 'Album2', '2022', 'NoNoNo', '2022-01-01 00:00:00');
