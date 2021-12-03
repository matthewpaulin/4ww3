CREATE TABLE `users` (
 `uid` int NOT NULL AUTO_INCREMENT,
 `fname` varchar(128) NOT NULL,
 `lname` varchar(128) NOT NULL,
 `email` varchar(128) NOT NULL,
 `pword` varchar(128) NOT NULL,
 `bday` date DEFAULT NULL,
 `gender` enum('male','female','other') DEFAULT NULL,
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci