CREATE TABLE `users` (
 `uid` int NOT NULL AUTO_INCREMENT,
 `fname` varchar(128) NOT NULL,
 `lname` varchar(128) NOT NULL,
 `email` varchar(128) NOT NULL,
 `pword` varchar(128) NOT NULL,
 `bday` date DEFAULT NULL,
 `gender` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
 PRIMARY KEY (`uid`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
	
CREATE TABLE `gyms` (
 `title` varchar(256) NOT NULL,
 `details` varchar(2048) NOT NULL,
 `lat` decimal(18,12) NOT NULL,
 `lng` decimal(18,12) NOT NULL,
 `image_url` varchar(2048) NOT NULL,
 `gym_id` int NOT NULL AUTO_INCREMENT,
 `website` varchar(2048) DEFAULT NULL,
 `uid` int NOT NULL,
 PRIMARY KEY (`gym_id`),
 KEY `uid` (`uid`),
 CONSTRAINT `gyms_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `reviews` (
 `details` varchar(2048) DEFAULT NULL,
 `review` decimal(2,1) NOT NULL,
 `uid` int NOT NULL,
 `gym_id` int NOT NULL,
 PRIMARY KEY (`uid`,`gym_id`),
 KEY `gym_id` (`gym_id`),
 CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`gym_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci