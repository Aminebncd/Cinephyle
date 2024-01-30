-- --------------------------------------------------------
-- Hôte:                         localhost
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema amine
CREATE DATABASE IF NOT EXISTS `cinema amine` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema amine`;

-- Listage de la structure de table cinema amine. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.acteur : ~13 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 10),
	(7, 11),
	(8, 12),
	(9, 13),
	(10, 18),
	(11, 23),
	(12, 24),
	(13, 25);

-- Listage de la structure de table cinema amine. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.casting : ~19 rows (environ)
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(9, 1, 19),
	(1, 2, 3),
	(3, 2, 4),
	(3, 3, 5),
	(4, 4, 6),
	(2, 5, 7),
	(5, 6, 8),
	(6, 6, 12),
	(6, 7, 9),
	(7, 8, 10),
	(8, 8, 13),
	(8, 9, 11),
	(12, 9, 17),
	(10, 10, 14),
	(14, 11, 18),
	(12, 12, 16),
	(11, 13, 15);

-- Listage de la structure de table cinema amine. categorise
CREATE TABLE IF NOT EXISTS `categorise` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `categorise_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `categorise_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.categorise : ~23 rows (environ)
INSERT INTO `categorise` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(7, 1),
	(12, 1),
	(2, 2),
	(4, 2),
	(1, 3),
	(3, 3),
	(4, 3),
	(6, 3),
	(8, 3),
	(11, 3),
	(12, 3),
	(14, 3),
	(3, 4),
	(9, 4),
	(1, 5),
	(5, 6),
	(6, 7),
	(5, 8),
	(8, 8),
	(9, 8),
	(10, 8),
	(13, 8);

-- Listage de la structure de table cinema amine. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_sortie_france` date DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `resume` text COLLATE utf8mb4_bin,
  `note` int DEFAULT NULL,
  `affiche` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_real` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_real` (`id_real`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_real`) REFERENCES `realisateur` (`id_real`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.film : ~14 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `date_sortie_france`, `duree`, `resume`, `note`, `affiche`, `id_real`) VALUES
	(1, 'Heat', '1995-12-15', 171, 'Heat (ou Tension au Québec) est un film policier américain écrit et réalisé par Michael Mann, sorti en 1995. ...', 9, 'Heat.jpg', 1),
	(2, 'Les Affranchis', '1990-09-12', 146, 'Dans les années 1950, à Brooklyn, le jeune Henry Hill a l occasion de réaliser son rêve ...', 8, 'Goodfellas.jpg', 2),
	(3, 'Le Parrain', '1972-10-18', 175, 'En 1945, à New York, les Corleone sont une des 5 familles de la mafia. Don Vito Corleone ...', 9, 'Godfather.jpg', 3),
	(4, 'Green Book : Sur les routes du Sud', '2019-01-23', 130, 'En 1962, alors que règne la ségrégation, Tony Lip, un videur italo-américain du Bronx, est engagé ...', 8, 'GreenBook.jpg', 4),
	(5, 'Inception', '2010-07-14', 148, 'Inception est un film de science-fiction américano-britannique écrit, produit et réalisé par Christopher Nolan, sorti en 2010. ...', 9, 'Inception.jpg', 5),
	(6, 'Titanic', '1998-01-07', 195, 'Titanic est un film américain écrit, produit et réalisé par James Cameron, sorti en 1997. ...', 8, 'Titanic.jpg', 6),
	(7, 'Mission Impossible', '1996-05-22', 110, 'Mission impossible (Mission: Impossible) est un film américain de Brian De Palma, sorti en 1996.', 7, 'MissionImpossible.jpg', 7),
	(8, 'Eyes Wide Shut', '1999-09-10', 159, 'Eyes Wide Shut est un film britannico-américain écrit, produit et réalisé par Stanley Kubrick, sorti en 1999.', 7, 'EyesWideShut.jpg', 8),
	(9, 'The Irishman', '2019-11-01', 209, 'Depuis sa maison de retraite, Frank Sheeran se remémore sa vie. Vétéran de la Seconde Guerre mondiale, « The Irishman » officie à Philadelphie comme chauffeur de camion dans les années 1950. Accusé de vol, il est défendu par l\'avocat Bill Bufalino. Ce dernier lui présente son cousin, Russell Bufalino. Frank se lie rapidement avec Russell et se rapproche peu à peu de la mafia italienne locale. Il devient un homme à tout faire et un tueur à gages efficace. Russell lui présente alors l\'un des hommes les plus influents des États-Unis, Jimmy Hoffa, président du puissant syndicat International Brotherhood of Teamsters.', 9, 'Irishman.jpg', 2),
	(10, 'Oppenheimer', '2023-07-19', 181, 'Le film présente une narration non linéaire, entrelaçant différentes périodes de la vie de Robert Oppenheimer : ses années de Cambridge à Los Alamos, son audition de sécurité en 1954 et l\'audition parlementaire de Strauss en 1959. L\'histoire est ici résumée en suivant l\'ordre chronologique des événements.', 9, 'Oppen.jpg', 5),
	(11, 'Napoléon', '2023-11-22', 158, 'Les origines de Napoléon et de son ascension aussi impitoyable que rapide, depuis sa promotion à l\'époque de la Révolution jusqu\'à ses derniers jours, à travers le prisme de sa relation addictive et explosive avec sa femme et unique amour, Joséphine.', 6, 'Napo.jpg', 9),
	(12, 'The Northman', '2022-04-22', 137, 'Au xe siècle, Amleth, un prince nordique, se lance dans une quête afin de venger la mort de son père, tué par son oncle Fjölnir. Il retrouve sa trace en Islande et se fait passer pour un esclave.', 7, 'Northman.jpg', 12),
	(13, 'Parasite', '2019-06-05', 132, 'La famille Kim, pauvre et au chômage, vit d\'expédients dans un taudis en sous-sol. Un jour, le fils réussit, au moyen d\'un faux diplôme, à se faire embaucher pour donner des cours d\'anglais à la fille d\'une famille richissime. C’est le début d\'une succession d\'événements qui vont rapprocher les deux familles.', 9, 'Parasite.jpg', 11),
	(14, 'Anatomie d\'une chute', '2023-08-23', 150, 'Sandra Voyter, Samuel Maleski et leur fils Daniel, âgé de onze ans vivent à la montagne, non loin de Grenoble. Un jour, Samuel est retrouvé mort au pied de leur chalet. Suicide ou homicide ? Une enquête est ouverte, et Sandra est mise en examen malgré le doute. Un an plus tard, Daniel assiste au procès de sa mère, véritable dissection du couple.', 8, 'Ana_chute.jpg', 10);

-- Listage de la structure de table cinema amine. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.genre : ~8 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
	(1, 'Action'),
	(2, 'Comédie'),
	(3, 'Drame'),
	(4, 'Mafia'),
	(5, 'Police'),
	(6, 'Science-Fiction'),
	(7, 'Romance'),
	(8, 'Thriller');

-- Listage de la structure de table cinema amine. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.personne : ~25 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`) VALUES
	(1, 'De Niro', 'Robert', 'Homme', '1943-08-17'),
	(2, 'Pacino', 'Alfred "Al"', 'Homme', '1940-04-25'),
	(3, 'Brando', 'Marlon', 'Homme', '1923-04-03'),
	(4, 'Mortensen', 'Viggo', 'Homme', '1958-10-20'),
	(5, 'Liotta', 'Ray', 'Homme', '1954-12-18'),
	(6, 'Coppola', 'Francis Ford', 'Homme', '1939-04-07'),
	(7, 'Scorcesse', 'Martin', 'Homme', '1942-11-17'),
	(8, 'Farrely', 'Peter', 'Homme', '1956-12-17'),
	(9, 'Mann', 'Michael', 'Homme', '1943-02-05'),
	(10, 'DiCaprio', 'Leonardo', 'Homme', '1974-11-11'),
	(11, 'Winslet', 'Kate', 'Femme', '1975-10-05'),
	(12, 'Cruise', 'Tom', 'Homme', '1962-07-03'),
	(13, 'Kidman', 'Nicole', 'Femme', '1967-06-20'),
	(14, 'Nolan', 'Christopher', 'Homme', '1970-07-30'),
	(15, 'Cameron', 'James', 'Homme', '1954-08-16'),
	(16, 'De Palma', 'Brian', 'Homme', '1940-09-11'),
	(17, 'Kubrick', 'Stanley', 'Homme', '1928-07-26'),
	(18, 'Murphy', 'Cillian', 'Homme', '1976-05-25'),
	(19, 'Scott', 'Ridley', 'Homme', '1937-11-30'),
	(20, 'Triet', 'Justine', 'Femme', '1978-07-17'),
	(21, 'Bong', 'Joon-ho', 'Homme', '1969-09-14'),
	(22, 'Eggers', 'Robert', 'Homme', '1983-07-07'),
	(23, 'Huller', 'Sandra', 'Femme', '1978-04-30'),
	(24, 'Skarsgard', 'Alexander', 'Homme', '1976-08-25'),
	(25, 'Phoenix', 'Joaquin (Rafael Bottom)', 'Homme', '1974-10-28');

-- Listage de la structure de table cinema amine. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_real` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_real`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.realisateur : ~12 rows (environ)
INSERT INTO `realisateur` (`id_real`, `id_personne`) VALUES
	(1, 6),
	(2, 7),
	(3, 8),
	(4, 9),
	(5, 14),
	(6, 15),
	(7, 16),
	(8, 17),
	(9, 19),
	(10, 20),
	(11, 21),
	(12, 22);

-- Listage de la structure de table cinema amine. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.role : ~20 rows (environ)
INSERT INTO `role` (`id_role`, `role`) VALUES
	(1, 'Neil McCauley'),
	(2, 'Jimmy Conway'),
	(3, 'Lieutenant Vincent Hanna'),
	(4, 'Michael Corleone'),
	(5, 'Vito Corleone'),
	(6, 'Frank "Tony Lip" Vallelonga'),
	(7, 'Henry Hill'),
	(8, 'Dom Cobb'),
	(9, 'Rose DeWitt Bukater'),
	(10, 'Ethan Hunt'),
	(11, 'Alice Harford'),
	(12, 'Jack Dawson'),
	(13, 'Docteur William "Bill" Harford'),
	(14, 'Robert Oppenheimer'),
	(15, 'Napoleon Bonaparte'),
	(16, 'Amleth'),
	(17, 'Reine Gudrun'),
	(18, 'Sandra Voyter'),
	(19, 'Frank "The Irishman" Sheeran'),
	(20, ' James Riddle « Jimmy » Hoffa');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;





































-- A. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur


SELECT titre, 
date_sortie_france,
 
CONCAT(
    LPAD(FLOOR(duree / 60), 2, '0'), 
    'h', 
    LPAD(duree % 60, 2, '0')
  ) AS duree_formatée, 
  CONCAT (
	  prenom, ' ', nom
	  ) AS réalisateur
   
FROM film

INNER JOIN realisateur ON film.id_real = realisateur.id_real
INNER JOIN personne ON realisateur.id_personne = personne.id_personne

-- peut valoir ce qu'on veut
WHERE id_film = 1



-- B. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court

SELECT * 
FROM film
WHERE duree > 135
ORDER BY duree DESC





-- C. Liste des films d’un réalisateur (en précisant l’année de sortie)

SELECT CONCAT (nom , ' ' , prenom) AS realisateur, titre, date_sortie_france
FROM film

INNER JOIN realisateur ON film.id_real=realisateur.id_real
INNER JOIN personne ON realisateur.id_personne=personne.id_personne

WHERE realisateur.id_real = 2





-- D. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT COUNT(*) AS nombre_de_films, libelle

FROM genre

INNER JOIN categorise ON genre.id_genre=categorise.id_genre

GROUP BY genre.id_genre
ORDER BY nombre_de_films desc





-- E. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT COUNT(*) AS nombre_de_films, CONCAT (nom , ' ' , prenom) AS realisateur

FROM film

INNER JOIN realisateur ON film.id_real=realisateur.id_real
INNER JOIN personne ON realisateur.id_personne=personne.id_personne

GROUP BY realisateur.id_real
ORDER BY nombre_de_films desc







-- F. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe


SELECT film.id_film, titre, CONCAT(prenom, ' ',nom) AS acteurs, sexe
FROM film

INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne

WHERE film.id_film = 1






-- G. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)


SELECT film.id_film, CONCAT(prenom, ' ',nom) AS acteur, titre, role, date_sortie_france
FROM film

INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN role ON casting.id_role = role.id_role
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne

WHERE acteur.id_acteur = 2







-- H. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT CONCAT(prenom," " ,nom) AS "acteur et realisateur" 
FROM personne
WHERE personne.id_personne IN (SELECT id_personne FROM realisateur)
AND personne.id_personne IN (SELECT id_personne FROM acteur)






-- I. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)


-- SELECT titre, date_sortie_france 
-- FROM film
-- WHERE DATEDIFF(yy, date_sortie_france, '2024-01-01' ) < 5

-- ORDER BY date_sortie_france DESC 

SELECT *
FROM film
WHERE TIMESTAMPDIFF(YEAR, date_sortie_france, NOW() ) < 5
ORDER BY date_sortie_france DESC;




-- J. Nombre d’hommes et de femmes parmi les acteurs


SELECT COUNT(*) AS effectif, sexe

FROM personne

INNER JOIN acteur ON personne.id_personne=acteur.id_personne

GROUP BY sexe




-- K. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)


SELECT 

CONCAT(prenom, ' ', nom) AS acteurs ,
TIMESTAMPDIFF(year, date_naissance, NOW() ) AS Age

FROM acteur
INNER JOIN personne ON acteur.id_personne=personne.id_personne
WHERE TIMESTAMPDIFF(YEAR, date_naissance, NOW() ) > 50



-- L. Acteurs ayant joué dans 3 films ou plus

SELECT CONCAT (prenom, ' ', nom) AS acteurs
FROM casting

INNER JOIN acteur ON casting.id_acteur=acteur.id_acteur
INNER JOIN personne ON acteur.id_personne=personne.id_personne


GROUP BY casting.id_acteur
HAVING ( SELECT COUNT(casting.id_acteur) >= 3 )


