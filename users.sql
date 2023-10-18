CREATE TABLE `capstone_group_6`.`users` (
  `userid` INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `address` VARCHAR(200) NULL,
  `registration_date` DATE NOT NULL,
  PRIMARY KEY (`userid`));