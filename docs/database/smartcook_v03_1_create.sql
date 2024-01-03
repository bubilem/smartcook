-- Project: SmartCook
-- Date: 2024-01-01
-- Author: bubilek

ALTER SCHEMA `smartcook`  DEFAULT CHARACTER SET utf8mb4  DEFAULT COLLATE utf8mb4_general_ci ;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `difficulty` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'json list',
  `duration` SMALLINT UNSIGNED NOT NULL DEFAULT 60 COMMENT 'minutes',
  `price` TINYINT NOT NULL DEFAULT 1 COMMENT 'json list',
  `decription` TEXT NULL DEFAULT NULL,
  `country` CHAR(2) NULL DEFAULT NULL COMMENT 'ISO 3166 alpha-2',
  `dttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smartcook`.`ingredient` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_ingredient` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_id` SMALLINT UNSIGNED NOT NULL,
  `ingredient_id` MEDIUMINT UNSIGNED NOT NULL,
  `quantity` DECIMAL(10,3) NOT NULL,
  `unit` VARCHAR(3) NOT NULL COMMENT 'json list',
  `necessary` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `order` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `comment` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_recipe_has_ingredient_recipe_idx` (`recipe_id` ASC) VISIBLE,
  INDEX `fk_recipe_has_ingredient_ingredient1_idx` (`ingredient_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_ingredient_recipe`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_has_ingredient_ingredient1`
    FOREIGN KEY (`ingredient_id`)
    REFERENCES `smartcook`.`ingredient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_tolerance` (
  `recipe_id` SMALLINT UNSIGNED NOT NULL,
  `tolerance_id` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`tolerance_id`, `recipe_id`),
  INDEX `fk_recipe_has_tolerance_recipe1_idx` (`recipe_id` ASC) INVISIBLE,
  CONSTRAINT `fk_recipe_has_tolerance_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_category` (
  `recipe_id` SMALLINT UNSIGNED NOT NULL,
  `recipe_category_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`, `recipe_category_id`),
  INDEX `fk_recipe_has_recipe_category_recipe1_idx` (`recipe_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_recipe_category_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_dish_category` (
  `recipe_id` SMALLINT UNSIGNED NOT NULL,
  `dish_category_id` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`, `dish_category_id`),
  INDEX `fk_recipe_has_dish_category_recipe1_idx` (`recipe_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_dish_category_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
