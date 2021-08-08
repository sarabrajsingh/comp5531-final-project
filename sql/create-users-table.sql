CREATE TABLE IF NOT EXISTS `users` (
	`userId` int(1) NOT NULL AUTO_INCREMENT,
  	`firstName` varchar(100) NOT NULL,
	`lastName` varchar(100) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(255) NOT NULL,
	`role` varchar(50) NOT NULL,
	'category' varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com');