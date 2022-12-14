-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Nov 2022 um 17:40
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `emensawerbeseite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `allergen`
--

CREATE TABLE `allergen` (
  `code` char(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Offizieller Abkürzungsbuchstabe für das Allergen.',
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name des Allergens, wie „Glutenhaltiges Getreide“.',
  `typ` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Gibt den Typ an. Standard: „allergen“'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `allergen`
--

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
('a', 'Getreideprodukte', 'Getreide (Gluten)'),
('a1', 'Weizen', 'Allergen'),
('a2', 'Roggen', 'Allergen'),
('a3', 'Gerste', 'Allergen'),
('a4', 'Dinkel', 'Allergen'),
('a5', 'Hafer', 'Allergen'),
('a6', 'Kamut', 'Allergen'),
('b', 'Fisch', 'Allergen'),
('c', 'Krebstiere', 'Allergen'),
('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
('e', 'Sellerie', 'Allergen'),
('f', 'Milch und Laktose', 'Allergen'),
('f1', 'Butter', 'Allergen'),
('f2', 'Käse', 'Allergen'),
('f3', 'Margarine', 'Allergen'),
('g', 'Sesam', 'Allergen'),
('h', 'Nüsse', 'Allergen'),
('h1', 'Mandeln', 'Allergen'),
('h2', 'Haselnüsse', 'Allergen'),
('h3', 'Walnüsse', 'Allergen'),
('i', 'Erdnüsse', 'Allergen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `besucher`
--

CREATE TABLE `besucher` (
  `id` int(11) NOT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `besucher`
--

INSERT INTO `besucher` (`id`, `ip`, `user_agent`, `created_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', '2022-11-13 15:59:38'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:54'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:57'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:57'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:57'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:57'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:57'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:58'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:58'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:106.0) Gecko/20100101 Firefox/106.0', '2022-11-13 15:59:58');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht`
--

CREATE TABLE `gericht` (
  `id` int(8) NOT NULL COMMENT 'Primärschlüssel',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name des Gerichts. Ein Name ist eindeutig.',
  `beschreibung` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Beschreibung des Gerichts.',
  `erfasst_am` date NOT NULL COMMENT 'Zeitpunkt der ersten Erfassung des Gerichts.',
  `vegetarisch` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegetarisch ist. Standard: Nein.',
  `vegan` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegan ist. Standard: Nein.',
  `preis_intern` double NOT NULL COMMENT 'Preis für interne Personen (wie Studierende). Es gilt immer\r\npreis_intern > 0.',
  `preis_extern` double NOT NULL COMMENT 'Preis für externe Personen (wie Gastdozent:innen).'
) ;

--
-- Daten für Tabelle `gericht`
--

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegetarisch`, `vegan`, `preis_intern`, `preis_extern`) VALUES
(1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4),
(3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 1, 0, 2.5, 4.5),
(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 1, 0, 2, 3),
(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 1, 0, 2.5, 4.5),
(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 1, 0, 3, 5),
(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 1, 0, 1, 1.5),
(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 1, 0, 1.25, 1.75),
(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9),
(21, 'Currywurst mit Pommes', 'Currywurst mit Pommes', '2022-11-13', 0, 0, 2.5, 3.5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht_hat_allergen`
--

CREATE TABLE `gericht_hat_allergen` (
  `code` char(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Referenz auf Allergen.',
  `gericht_id` int(8) NOT NULL COMMENT 'Referenz auf das Gericht.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `gericht_hat_allergen`
--

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
('h', 1),
('a3', 1),
('a4', 1),
('f1', 3),
('a6', 3),
('i', 3),
('a3', 4),
('f1', 4),
('a4', 4),
('h3', 4),
('d', 6),
('h1', 7),
('a2', 7),
('h3', 7),
('c', 7),
('a3', 8),
('h3', 10),
('d', 10),
('f', 10),
('f2', 12),
('h1', 12),
('a5', 12),
('c', 1),
('a2', 9),
('i', 14),
('f1', 1),
('a1', 15),
('a4', 15),
('i', 15),
('f3', 15),
('h3', 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht_hat_kategorie`
--

CREATE TABLE `gericht_hat_kategorie` (
  `gericht_id` int(8) DEFAULT NULL COMMENT 'Referenz auf Gericht.',
  `kategorie_id` int(8) NOT NULL COMMENT 'Referenz auf Kategorie.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `gericht_hat_kategorie`
--

INSERT INTO `gericht_hat_kategorie` (`gericht_id`, `kategorie_id`) VALUES
(1, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(9, 3),
(16, 4),
(17, 4),
(18, 4),
(16, 5),
(17, 5),
(18, 5),
(21, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(8) NOT NULL COMMENT 'Primärschlüssel',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name der Kategorie, z.B. „Hauptgericht“, „Vorspeise“, „Salat“,\r\n„Sauce“ oder „Käsegericht“.',
  `eltern_id` int(8) DEFAULT NULL COMMENT 'Referenz auf eine (Eltern-)Kategorie. Es soll eine Baumstruktur\r\ninnerhalb der Kategorien abgebildet werden. Zum Beispiel\r\nenthält die Kategorie „Hauptgericht“ alle Kategorien, denen\r\nGerichte zugeordnet sind, die als Hauptgang vorgesehen sind',
  `bildname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name der Bilddatei, die eine Darstellung der Kategorie enthält.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`id`, `name`, `eltern_id`, `bildname`) VALUES
(1, 'Aktionen', NULL, 'kat_aktionen.png'),
(2, 'Menus', NULL, 'kat_menu.gif'),
(3, 'Hauptspeisen', 2, 'kat_menu_haupt.bmp'),
(4, 'Vorspeisen', 2, 'kat_menu_vor.svg'),
(5, 'Desserts', 2, 'kat_menu_dessert.pic'),
(6, 'Mensastars', 1, 'kat_stars.tif'),
(7, 'Erstiewoche', 1, 'kat_erties.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `allergen`
--
ALTER TABLE `allergen`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `besucher`
--
ALTER TABLE `besucher`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indizes für die Tabelle `gericht_hat_allergen`
--
ALTER TABLE `gericht_hat_allergen`
  ADD KEY `cag_index` (`code`),
  ADD KEY `gidag_index` (`gericht_id`);

--
-- Indizes für die Tabelle `gericht_hat_kategorie`
--
ALTER TABLE `gericht_hat_kategorie`
  ADD KEY `cak_index` (`gericht_id`),
  ADD KEY `gik_index` (`kategorie_id`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gelternid_index` (`eltern_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `besucher`
--
ALTER TABLE `besucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT für Tabelle `gericht`
--
ALTER TABLE `gericht`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `gericht_hat_allergen`
--
ALTER TABLE `gericht_hat_allergen`
  ADD CONSTRAINT `check_ref_code` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`),
  ADD CONSTRAINT `check_ref_gid` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  ADD CONSTRAINT `gericht_hat_allergen_ibfk_1` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  ADD CONSTRAINT `gericht_hat_allergen_ibfk_2` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`);

--
-- Constraints der Tabelle `gericht_hat_kategorie`
--
ALTER TABLE `gericht_hat_kategorie`
  ADD CONSTRAINT `check_fkgid` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  ADD CONSTRAINT `gericht_hat_kategorie_ibfk_1` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  ADD CONSTRAINT `gericht_hat_kategorie_ibfk_2` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`);

--
-- Constraints der Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD CONSTRAINT `kategorie_ibfk_1` FOREIGN KEY (`eltern_id`) REFERENCES `kategorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
