/* The code used to create and populate our database named COP4331 for the contacts app
Database contributors: Corday Davis and Francisco Arisso
*/
create database COP4331; 
use COP4331;


CREATE TABLE `COP4331`.`Users`
(
  'ID' INT NOT NULL AUTO_INCREMENT ,
  'FirstName' VARCHAR(50) NOT NULL DEFAULT '' ,
  'LastName' VARCHAR(50) NOT NULL DEFAULT '' ,
  'Login' VARCHAR(50) NOT NULL DEFAULT '' ,
  'Password' VARCHAR(50) NOT NULL DEFAULT '' ,
  PRIMARY KEY ('ID')
) ENGINE = InnoDB;

CREATE TABLE `COP4331`.`Contacts`
(
	`ID` INT NOT NULL AUTO_INCREMENT ,
	`FirstName` VARCHAR(50) NOT NULL DEFAULT '' ,
	`LastName` VARCHAR(50) NOT NULL DEFAULT '' ,
	`Phone` VARCHAR(50) NOT NULL DEFAULT '' ,
	`Email` VARCHAR(50) NOT NULL DEFAULT '' ,
	`UserID` INT NOT NULL DEFAULT '0' ,
	`DateCreated` DATE NOT NULL , -- Requirement for date record created
	PRIMARY KEY (`ID`)
) ENGINE = InnoDB;
