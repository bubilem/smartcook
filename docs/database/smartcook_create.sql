SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

--
-- Databáze: `smartcook`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `difficulty` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'json list',
  `duration` smallint UNSIGNED NOT NULL DEFAULT '60' COMMENT 'minutes',
  `price` tinyint NOT NULL DEFAULT '1' COMMENT 'json list',
  `description` text COLLATE utf8mb4_general_ci,
  `country` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'ISO 3166 alpha-2',
  `dttm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `recipe_has_category`
--

DROP TABLE IF EXISTS `recipe_has_category`;
CREATE TABLE IF NOT EXISTS `recipe_has_category` (
  `recipe_id` smallint UNSIGNED NOT NULL,
  `recipe_category_id` smallint UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`,`recipe_category_id`),
  KEY `fk_recipe_has_recipe_category_recipe1_idx` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `recipe_has_dish_category`
--

DROP TABLE IF EXISTS `recipe_has_dish_category`;
CREATE TABLE IF NOT EXISTS `recipe_has_dish_category` (
  `recipe_id` smallint UNSIGNED NOT NULL,
  `dish_category_id` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`,`dish_category_id`),
  KEY `fk_recipe_has_dish_category_recipe1_idx` (`recipe_id`) INVISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `recipe_has_ingredient`
--

DROP TABLE IF EXISTS `recipe_has_ingredient`;
CREATE TABLE IF NOT EXISTS `recipe_has_ingredient` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_id` smallint UNSIGNED NOT NULL,
  `ingredient_id` mediumint UNSIGNED NOT NULL,
  `quantity` decimal(10,3) NOT NULL,
  `unit` varchar(3) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'json list',
  `necessary` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `rota` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'order',
  `comment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recipe_has_ingredient_recipe_idx` (`recipe_id`),
  KEY `fk_recipe_has_ingredient_ingredient1_idx` (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `recipe_has_tolerance`
--

DROP TABLE IF EXISTS `recipe_has_tolerance`;
CREATE TABLE IF NOT EXISTS `recipe_has_tolerance` (
  `recipe_id` smallint UNSIGNED NOT NULL,
  `tolerance_id` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`tolerance_id`,`recipe_id`),
  KEY `fk_recipe_has_tolerance_recipe1_idx` (`recipe_id`) INVISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `recipe_has_category`
--
ALTER TABLE `recipe_has_category`
  ADD CONSTRAINT `fk_recipe_has_recipe_category_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `recipe_has_dish_category`
--
ALTER TABLE `recipe_has_dish_category`
  ADD CONSTRAINT `fk_recipe_has_dish_category_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `recipe_has_ingredient`
--
ALTER TABLE `recipe_has_ingredient`
  ADD CONSTRAINT `fk_recipe_has_ingredient_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `fk_recipe_has_ingredient_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `recipe_has_tolerance`
--
ALTER TABLE `recipe_has_tolerance`
  ADD CONSTRAINT `fk_recipe_has_tolerance_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
