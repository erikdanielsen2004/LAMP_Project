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


insert into Contacts (FirstName, LastName, Phone, Email, UserID, DateCreated) VALUES ('Frankie', 'Ariso', '3214567890', 'frankie123@gmail.com', 21, CURRENT_DATE()); -- Temporary contact


INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Corday','Davis','CordayD','Test1');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Maya','Hernandez','MayaH','TestM');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Ethan','Reed','EthanR','TestE');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Sofia','Nguyen','SofiaN','TestS');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Jordan','Parker','JordanP','TestJ');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Aaliyah','Brooks','AaliyahB','TestA');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Carlos','Vega','CarlosV','TestC');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Priya','Shah','PriyaS','TestP');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Noah','Bennett','NoahB','TestN');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Zoe','Foster','ZoeF','TestZ');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Liam','Carter','LiamC','TestL');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Nina','Khan','NinaK','TestN');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Tyler','Morris','TylerM','TestT');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Olivia','Stone','OliviaS','TestO');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Ben','Ramirez','BenR','TestB');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Leila','Simmons','LeilaS','TestL');
INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('Hugo','Diaz','HugoD','TestH');

use COP4331;
create user 'TheBeast' identified by 'WeLoveCOP4331';
grant all privileges on COP4331.* to 'TheBeast'@'%'; -- Special database user!
