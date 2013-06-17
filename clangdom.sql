SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `clangdom` ;
CREATE SCHEMA IF NOT EXISTS `clangdom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `clangdom` ;

-- -----------------------------------------------------
-- Table `clangdom`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`User` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT ,
  `eMail` VARCHAR(45) NOT NULL ,
  `Password` TEXT NOT NULL ,
  PRIMARY KEY (`idUser`) ,
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`File`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`File` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`File` (
  `idFile` INT NOT NULL AUTO_INCREMENT ,
  `Path` VARCHAR(45) NULL ,
  PRIMARY KEY (`idFile`) ,
  UNIQUE INDEX `idFile_UNIQUE` (`idFile` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Picture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Picture` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Picture` (
  `idPicture` INT NOT NULL AUTO_INCREMENT ,
  `File` INT NOT NULL ,
  PRIMARY KEY (`idPicture`) ,
  INDEX `fk_Picture_File1_idx` (`File` ASC) ,
  CONSTRAINT `fk_Picture_File1`
    FOREIGN KEY (`File` )
    REFERENCES `clangdom`.`File` (`idFile` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Profil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Profil` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Profil` (
  `idProfil` INT NOT NULL AUTO_INCREMENT ,
  `Link` VARCHAR(45) NOT NULL ,
  `Picture` INT NULL ,
  PRIMARY KEY (`idProfil`) ,
  UNIQUE INDEX `idProfil_UNIQUE` (`idProfil` ASC) ,
  UNIQUE INDEX `Link_UNIQUE` (`Link` ASC) ,
  INDEX `fk_Profil_Picture1_idx` (`Picture` ASC) ,
  CONSTRAINT `fk_Profil_Picture1`
    FOREIGN KEY (`Picture` )
    REFERENCES `clangdom`.`Picture` (`idPicture` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Location` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Location` (
  `idLocation` INT NOT NULL AUTO_INCREMENT ,
  `Country` VARCHAR(45) NOT NULL ,
  `Federal_State` VARCHAR(45) NOT NULL ,
  `Region` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idLocation`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Konto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Konto` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Konto` (
  `idKonto` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  `Profil` INT NOT NULL ,
  `Location` INT NOT NULL ,
  `Confirmed` TINYINT(1) NOT NULL DEFAULT False ,
  PRIMARY KEY (`idKonto`) ,
  UNIQUE INDEX `idKonto_UNIQUE` (`idKonto` ASC) ,
  INDEX `Profil_idx` (`Profil` ASC) ,
  INDEX `fk_Konto_Location1_idx` (`Location` ASC) ,
  CONSTRAINT `Profil`
    FOREIGN KEY (`Profil` )
    REFERENCES `clangdom`.`Profil` (`idProfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Konto_Location1`
    FOREIGN KEY (`Location` )
    REFERENCES `clangdom`.`Location` (`idLocation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`User_has_Konto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`User_has_Konto` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`User_has_Konto` (
  `idUser` INT NOT NULL ,
  `idKonto` INT NOT NULL ,
  PRIMARY KEY (`idUser`, `idKonto`) ,
  INDEX `fk_User_has_Konto_Konto1_idx` (`idKonto` ASC) ,
  INDEX `fk_User_has_Konto_User1_idx` (`idUser` ASC) ,
  CONSTRAINT `fk_User_has_Konto_User1`
    FOREIGN KEY (`idUser` )
    REFERENCES `clangdom`.`User` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Konto_Konto1`
    FOREIGN KEY (`idKonto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Genre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Genre` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Genre` (
  `idGenre` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idGenre`) ,
  UNIQUE INDEX `idGenre_UNIQUE` (`idGenre` ASC) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Post` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Post` (
  `idPost` INT NOT NULL AUTO_INCREMENT ,
  `Date` DATETIME NOT NULL ,
  `Name` VARCHAR(45) NOT NULL ,
  `Konto` INT NOT NULL ,
  `Rating` INT NULL ,
  PRIMARY KEY (`idPost`) ,
  UNIQUE INDEX `idPost_UNIQUE` (`idPost` ASC) ,
  INDEX `fk_Post_Konto1_idx` (`Konto` ASC) ,
  CONSTRAINT `fk_Post_Konto1`
    FOREIGN KEY (`Konto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Music`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Music` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Music` (
  `idMusic` INT NOT NULL AUTO_INCREMENT ,
  `Post` INT NOT NULL ,
  `File` INT NOT NULL ,
  PRIMARY KEY (`idMusic`) ,
  UNIQUE INDEX `idMusic_UNIQUE` (`idMusic` ASC) ,
  INDEX `fk_Music_Post1_idx` (`Post` ASC) ,
  INDEX `fk_Music_File1_idx` (`File` ASC) ,
  CONSTRAINT `fk_Music_Post1`
    FOREIGN KEY (`Post` )
    REFERENCES `clangdom`.`Post` (`idPost` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Music_File1`
    FOREIGN KEY (`File` )
    REFERENCES `clangdom`.`File` (`idFile` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Video`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Video` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Video` (
  `idVideo` INT NOT NULL AUTO_INCREMENT ,
  `URL` VARCHAR(45) NOT NULL ,
  `Post` INT NOT NULL ,
  PRIMARY KEY (`idVideo`) ,
  UNIQUE INDEX `idVideo_UNIQUE` (`idVideo` ASC) ,
  INDEX `fk_Video_Post1_idx` (`Post` ASC) ,
  CONSTRAINT `fk_Video_Post1`
    FOREIGN KEY (`Post` )
    REFERENCES `clangdom`.`Post` (`idPost` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Tags` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Tags` (
  `idTags` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTags`) ,
  UNIQUE INDEX `idTags_UNIQUE` (`idTags` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Artist` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Artist` (
  `idArtist` INT NOT NULL AUTO_INCREMENT ,
  `Konto` INT NOT NULL ,
  PRIMARY KEY (`idArtist`) ,
  UNIQUE INDEX `idArtist_UNIQUE` (`idArtist` ASC) ,
  INDEX `fk_Artist_Konto1_idx` (`Konto` ASC) ,
  UNIQUE INDEX `Konto_idKonto_UNIQUE` (`Konto` ASC) ,
  CONSTRAINT `fk_Artist_Konto1`
    FOREIGN KEY (`Konto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Source` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Source` (
  `idSource` INT NOT NULL AUTO_INCREMENT ,
  `Konto` INT NOT NULL ,
  PRIMARY KEY (`idSource`) ,
  UNIQUE INDEX `idSource_UNIQUE` (`idSource` ASC) ,
  INDEX `fk_Source_Konto1_idx` (`Konto` ASC) ,
  CONSTRAINT `fk_Source_Konto1`
    FOREIGN KEY (`Konto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Artist_has_Genre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Artist_has_Genre` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Artist_has_Genre` (
  `Artist_idArtist` INT NOT NULL ,
  `Genre_idGenre` INT NOT NULL ,
  PRIMARY KEY (`Artist_idArtist`, `Genre_idGenre`) ,
  INDEX `fk_Artist_has_Genre_Genre1_idx` (`Genre_idGenre` ASC) ,
  INDEX `fk_Artist_has_Genre_Artist1_idx` (`Artist_idArtist` ASC) ,
  CONSTRAINT `fk_Artist_has_Genre_Artist1`
    FOREIGN KEY (`Artist_idArtist` )
    REFERENCES `clangdom`.`Artist` (`idArtist` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artist_has_Genre_Genre1`
    FOREIGN KEY (`Genre_idGenre` )
    REFERENCES `clangdom`.`Genre` (`idGenre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Konto_has_Tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Konto_has_Tags` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Konto_has_Tags` (
  `Konto_idKonto` INT NOT NULL ,
  `Tags_idTags` INT NOT NULL ,
  PRIMARY KEY (`Konto_idKonto`, `Tags_idTags`) ,
  INDEX `fk_Konto_has_Tags_Tags1_idx` (`Tags_idTags` ASC) ,
  INDEX `fk_Konto_has_Tags_Konto1_idx` (`Konto_idKonto` ASC) ,
  CONSTRAINT `fk_Konto_has_Tags_Konto1`
    FOREIGN KEY (`Konto_idKonto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Konto_has_Tags_Tags1`
    FOREIGN KEY (`Tags_idTags` )
    REFERENCES `clangdom`.`Tags` (`idTags` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Post_has_Tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Post_has_Tags` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Post_has_Tags` (
  `Post_idPost` INT NOT NULL ,
  `Tags_idTags` INT NOT NULL ,
  PRIMARY KEY (`Post_idPost`, `Tags_idTags`) ,
  INDEX `fk_Post_has_Tags_Tags1_idx` (`Tags_idTags` ASC) ,
  INDEX `fk_Post_has_Tags_Post1_idx` (`Post_idPost` ASC) ,
  CONSTRAINT `fk_Post_has_Tags_Post1`
    FOREIGN KEY (`Post_idPost` )
    REFERENCES `clangdom`.`Post` (`idPost` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Post_has_Tags_Tags1`
    FOREIGN KEY (`Tags_idTags` )
    REFERENCES `clangdom`.`Tags` (`idTags` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Tasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Tasks` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Tasks` (
  `idTasks` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTasks`) ,
  UNIQUE INDEX `idTasks_UNIQUE` (`idTasks` ASC) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Source_has_Tasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Source_has_Tasks` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Source_has_Tasks` (
  `Source_idSource` INT NOT NULL ,
  `Tasks_idTasks` INT NOT NULL ,
  PRIMARY KEY (`Source_idSource`, `Tasks_idTasks`) ,
  INDEX `fk_Source_has_Tasks_Tasks1_idx` (`Tasks_idTasks` ASC) ,
  INDEX `fk_Source_has_Tasks_Source1_idx` (`Source_idSource` ASC) ,
  CONSTRAINT `fk_Source_has_Tasks_Source1`
    FOREIGN KEY (`Source_idSource` )
    REFERENCES `clangdom`.`Source` (`idSource` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Source_has_Tasks_Tasks1`
    FOREIGN KEY (`Tasks_idTasks` )
    REFERENCES `clangdom`.`Tasks` (`idTasks` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Picture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Picture` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Picture` (
  `idPicture` INT NOT NULL AUTO_INCREMENT ,
  `File` INT NOT NULL ,
  PRIMARY KEY (`idPicture`) ,
  INDEX `fk_Picture_File1_idx` (`File` ASC) ,
  CONSTRAINT `fk_Picture_File1`
    FOREIGN KEY (`File` )
    REFERENCES `clangdom`.`File` (`idFile` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Event` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Event` (
  `idEvent` INT NOT NULL AUTO_INCREMENT ,
  `Post` INT NOT NULL ,
  `Profil` INT NOT NULL ,
  `Startdate` DATE NULL ,
  `Info` TEXT NULL ,
  `Time` TIME NULL ,
  PRIMARY KEY (`idEvent`) ,
  UNIQUE INDEX `idEvent_UNIQUE` (`idEvent` ASC) ,
  INDEX `fk_Event_Post1_idx` (`Post` ASC) ,
  INDEX `fk_Event_Profil1_idx` (`Profil` ASC) ,
  CONSTRAINT `fk_Event_Post1`
    FOREIGN KEY (`Post` )
    REFERENCES `clangdom`.`Post` (`idPost` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_Profil1`
    FOREIGN KEY (`Profil` )
    REFERENCES `clangdom`.`Profil` (`idProfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Event_has_Konto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Event_has_Konto` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Event_has_Konto` (
  `Event` INT NOT NULL ,
  `Konto` INT NOT NULL ,
  PRIMARY KEY (`Event`, `Konto`) ,
  INDEX `fk_Event_has_Konto_Konto1_idx` (`Konto` ASC) ,
  INDEX `fk_Event_has_Konto_Event1_idx` (`Event` ASC) ,
  CONSTRAINT `fk_Event_has_Konto_Event1`
    FOREIGN KEY (`Event` )
    REFERENCES `clangdom`.`Event` (`idEvent` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_has_Konto_Konto1`
    FOREIGN KEY (`Konto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Proposal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Proposal` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Proposal` (
  `idProposal` INT NOT NULL ,
  `Info_Text` VARCHAR(45) NULL ,
  `Post_idPost` INT NOT NULL ,
  PRIMARY KEY (`idProposal`) ,
  INDEX `fk_Proposal_Post1_idx` (`Post_idPost` ASC) ,
  CONSTRAINT `fk_Proposal_Post1`
    FOREIGN KEY (`Post_idPost` )
    REFERENCES `clangdom`.`Post` (`idPost` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Konto_has_Favorit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Konto_has_Favorit` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Konto_has_Favorit` (
  `Konto` INT NOT NULL ,
  `Favorit` INT NOT NULL ,
  PRIMARY KEY (`Konto`, `Favorit`) ,
  INDEX `fk_Konto_has_Konto_Konto2_idx` (`Favorit` ASC) ,
  INDEX `fk_Konto_has_Konto_Konto1_idx` (`Konto` ASC) ,
  CONSTRAINT `fk_Konto_has_Konto_Konto1`
    FOREIGN KEY (`Konto` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Konto_has_Konto_Konto2`
    FOREIGN KEY (`Favorit` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clangdom`.`Nachricht`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clangdom`.`Nachricht` ;

CREATE  TABLE IF NOT EXISTS `clangdom`.`Nachricht` (
  `idNachricht` INT NOT NULL AUTO_INCREMENT ,
  `Subject` VARCHAR(45) NULL ,
  `Text` TEXT NOT NULL ,
  `Sender` INT NOT NULL ,
  `Recipient` INT NOT NULL ,
  `Date` DATE NOT NULL ,
  `Checked` TINYINT(1) NOT NULL DEFAULT False ,
  PRIMARY KEY (`idNachricht`) ,
  UNIQUE INDEX `idNachricht_UNIQUE` (`idNachricht` ASC) ,
  INDEX `fk_Nachricht_Konto1_idx` (`Sender` ASC) ,
  INDEX `fk_Nachricht_Konto2_idx` (`Recipient` ASC) ,
  CONSTRAINT `fk_Nachricht_Konto1`
    FOREIGN KEY (`Sender` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nachricht_Konto2`
    FOREIGN KEY (`Recipient` )
    REFERENCES `clangdom`.`Konto` (`idKonto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `clangdom` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
