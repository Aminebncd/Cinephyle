-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
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
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_sortie_france` date DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `resume` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `note` int DEFAULT NULL,
  `affiche` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `id_real` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_real` (`id_real`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_real`) REFERENCES `realisateur` (`id_real`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.film : ~14 rows (environ)
INSERT INTO `film` (`id_film`, `titre`, `date_sortie_france`, `duree`, `resume`, `note`, `affiche`, `id_real`) VALUES
	(1, 'Heat', '1995-12-15', 171, 'La bande de Neil McCauley à laquelle est venu se greffer Waingro, une nouvelle recrue, attaque un fourgon blindé pour s\'emparer d\'une somme importante en obligations. Cependant, ce dernier tue froidement l\'un des convoyeurs et Chris Shiherlis se retrouve obligé de terminer le travail. Neil tente d\'éliminer Waingro, mais celui-ci parvient à s\'échapper. Parallèlement, le lieutenant Vincent Hanna mène l\'enquête.', 9, 'https://img.fruugo.com/product/1/82/14567821_max.jpg', 4),
	(2, 'Les Affranchis', '1990-09-12', 146, 'Dans les années 1950, à Brooklyn, le jeune Henry Hill a l\'occasion de réaliser son rêve : devenir gangster lorsqu\'un caïd local l\'intègre à son équipe. C\'est alors qu\'il rencontre James et Tommy, 2 truands d\'une rare brutalité. Impressionné, Henry s\'associe avec eux pour débuter un trafic très lucratif. Lorsqu\'il séduit la ravissante Karen, le jeune mafieux s\'imagine que plus rien ni personne ne pourra jamais lui résister.', 8, 'https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/433/v4c6wmvqulsjhmyjhnj72itfghm-620.jpg', 2),
	(3, 'Le Parrain', '1972-10-18', 175, 'En 1945, à New York, les Corleone sont une des 5 familles de la mafia. Don Vito Corleone, `parrain\' de cette famille, marie sa fille à un bookmaker. Sollozzo, `parrain\' de la famille Tattaglia, propose à Don Vito une association dans le trafic de drogue, mais celui-ci refuse. Sonny, un de ses fils, y est quant à lui favorable. Afin de traiter avec Sonny, Sollozzo tente de faire tuer Don Vito, mais celui-ci en réchappe.', 9, 'https://fr.web.img4.acsta.net/medias/nmedia/18/35/57/73/18660716.jpg', 1),
	(4, 'Green Book : Sur les routes du Sud', '2019-01-23', 130, 'En 1962, alors que règne la ségrégation, Tony Lip, un videur italo-américain du Bronx, est engagé pour conduire et protéger le Dr Don Shirley, un pianiste noir de renommée mondiale, lors d\'une tournée de concerts. Durant leur périple de Manhattan jusqu\'au Sud profond, ils doivent se confronter aux humiliations, perceptions et persécutions, tout en devant trouver des établissements accueillant les personnes de couleurs.', 8, 'https://cine-images.com/wp-content/uploads/2021/04/green-book-120x160ok.jpg', 3),
	(5, 'Inception', '2010-07-14', 148, 'Dom Cobb est un voleur expérimenté dans l\'art périlleux de `l\'extraction\' : sa spécialité consiste à s\'approprier les secrets les plus précieux d\'un individu, enfouis au plus profond de son subconscient, pendant qu\'il rêve et que son esprit est particulièrement vulnérable. Très recherché pour ses talents dans l\'univers trouble de l\'espionnage industriel, Cobb est aussi devenu un fugitif traqué dans le monde entier. Cependant, une ultime mission pourrait lui permettre de retrouver sa vie d\'avant.', 9, 'https://m.media-amazon.com/images/I/91b3Xtjt0IL.jpg', 5),
	(6, 'Titanic', '1998-01-07', 195, 'En 1997, l\'épave du Titanic est l\'objet d\'une exploration fiévreuse, menée par des chercheurs de trésor en quête d\'un diamant bleu qui se trouvait à bord. Frappée par un reportage télévisé, l\'une des rescapées du naufrage, âgée de 102 ans, Rose DeWitt, se rend sur place et évoque ses souvenirs. 1912. Fiancée à un industriel arrogant, Rose croise sur le bateau un artiste sans le sou.', 8, 'https://m.media-amazon.com/images/I/8129a7-9A7L.jpg', 6),
	(7, 'Mission Impossible', '1996-05-22', 110, 'Jim Phelps dirige le département des "Missions impossibles." Un agent de la CIA, Kittridge, lui demande de mener à bien une délicate affaire, à Prague. Phelps doit y démasquer un agent russe, Alexander Golitsyn, dès que ce dernier aura volé la liste des agents américains opérant en Europe centrale. Phelps réunit son équipe, dont font partie son épouse, Claire, et son assistant, Ethan Hunt.', 7, 'https://www.ecranlarge.com/uploads/image/001/122/c6vnk6budf5wl1yghgvpdx2uf4u-507.jpg', 7),
	(8, 'Eyes Wide Shut', '1999-09-10', 159, 'Un jeune couple bourgeois vivant à New-York, Bill Harford, médecin, et sa femme, Alice, commissaire d\'exposition, se rend à une réception mondaine pour la fête de Noël donnée par un riche patient de Bill. Bill y rencontre un vieil ami de fac, Nick Nightingale, devenu pianiste professionnel puis pendant qu\'Alice se fait draguer par un Hongrois, Bill se voit proposer un plan à trois par deux mannequins pour aller jusqu\'au bout de l\'arc-en-ciel.', 7, 'https://i.pinimg.com/originals/81/6f/06/816f06f8b1f0cc21efee18be62998907.jpg', 8),
	(9, 'The Irishman', '2019-11-01', 209, 'Depuis sa maison de retraite, Frank Sheeran se remémore sa vie. Vétéran de la Seconde Guerre mondiale, « The Irishman » officie à Philadelphie comme chauffeur de camion dans les années 1950. Accusé de vol, il est défendu par l\'avocat Bill Bufalino. Ce dernier lui présente son cousin, Russell Bufalino. Frank se lie rapidement avec Russell et se rapproche peu à peu de la mafia italienne locale. Il devient un homme à tout faire et un tueur à gages efficace. Russell lui présente alors l\'un des hommes les plus influents des États-Unis, Jimmy Hoffa, président du puissant syndicat International Brotherhood of Teamsters.', 9, 'https://fr.web.img5.acsta.net/pictures/19/09/18/09/17/1349272.jpg', 2),
	(10, 'Oppenheimer', '2023-07-19', 181, 'En 1942, convaincus que l\'Allemagne nazie est en train de développer une arme nucléaire, les États-Unis initient, dans le plus grand secret, le Projet Manhattan destiné à mettre au point la première bombe atomique de l\'histoire. Pour piloter ce dispositif, le gouvernement engage J. Robert Oppenheimer, brillant physicien. C\'est dans le laboratoire ultra-secret de Los Alamos, au cœur du désert du Nouveau-Mexique, que le scientifique et son équipe mettent au point cette arme révolutionnaire.', 9, 'https://m.media-amazon.com/images/I/71Ij1x2RFEL.jpg', 5),
	(11, 'Napoléon', '2023-11-22', 158, ' L\'ascension et à la chute de l\'Empereur Napoléon Bonaparte. Le film retrace la conquête acharnée du pouvoir par Bonaparte à travers le prisme de ses rapports passionnels et tourmentés avec Joséphine, le grand amour de sa vie.', 6, 'https://fr.web.img6.acsta.net/r_1280_720/pictures/23/07/17/15/06/1535719.jpg', 9),
	(12, 'The Northman', '2022-04-22', 137, 'Le prince Amleth est sur le point de devenir un homme lorsque son père est brutalement assassiné par son oncle, qui kidnappe la mère du garçon. Deux décennies plus tard, Amleth est maintenant un Viking qui attaque les villages slaves. Il rencontre une voyante qui lui rappelle son voeu : sauver sa mère, tuer son oncle, venger son père.', 7, 'https://fr.web.img6.acsta.net/pictures/22/03/28/10/44/2400775.jpg', 12),
	(13, 'Parasite', '2019-06-05', 132, 'Les quatre membres de la famille Ki-taek sont proches, mais sont au chômage et ont un avenir sombre. Le fils, Ki-woo, est recommandé par son ami pour un emploi de tuteur bien rémunéré, faisant naître l\'espoir d\'un revenu régulier. Portant les attentes de toute sa famille, il passe une entrevue. En arrivant chez M. Park, propriétaire d\'une société informatique internationale, Ki-woo rencontre Yeon-kyo, la belle demoiselle de la maison. Une série d\'incidents imparables les attend.', 9, 'https://fr.web.img6.acsta.net/pictures/20/02/12/13/58/3992754.jpg', 11),
	(14, 'Anatomie d\'une chute', '2023-08-23', 150, 'Depuis un an, Sandra, une écrivaine allemande, et Samuel, son mari français, vivent ensemble avec leur fils Daniel, 11 ans, dans une petite ville isolée des Alpes. Lorsque Samuel est retrouvé mort, la police commence à traiter l\'affaire comme un homicide présumé et Sandra devient la principale suspecte.', 8, 'https://fr.web.img4.acsta.net/pictures/23/06/14/10/15/2288359.jpg', 10);

-- Listage de la structure de table cinema amine. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.genre : ~9 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
	(1, 'Action'),
	(2, 'Comédie'),
	(3, 'Drame'),
	(4, 'Mafia'),
	(5, 'Police'),
	(6, 'Science-Fiction'),
	(7, 'Romance'),
	(8, 'Thriller'),
	(9, 'horreur');

-- Listage de la structure de table cinema amine. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `sexe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `portrait` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `lien_wiki` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.personne : ~25 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`, `portrait`, `lien_wiki`) VALUES
	(1, 'De Niro', 'Robert', 'Homme', '1943-08-17', 'https://i.pinimg.com/originals/48/2a/c2/482ac2bf95c55c7a7324ad45f6e17ad0.jpg', 'https://fr.wikipedia.org/wiki/Robert_De_Niro'),
	(2, 'Pacino', 'Alfred "Al"', 'Homme', '1940-04-25', 'https://cdn.profoto.com/cdn/0522126/contentassets/887cb960e3974a42bdd616355d47f566/profoto-victoria-will-al-pacino-1-768x1024.jpg?width=1280&quality=75&format=jpg', NULL),
	(3, 'Brando', 'Marlon', 'Homme', '1923-04-03', 'https://upload.wikimedia.org/wikipedia/commons/5/53/Marlon_Brando_publicity_for_One-Eyed_Jacks.png', NULL),
	(4, 'Mortensen', 'Viggo', 'Homme', '1958-10-20', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Viggo_Mortensen_B_%282020%29.jpg/640px-Viggo_Mortensen_B_%282020%29.jpg', NULL),
	(5, 'Liotta', 'Ray', 'Homme', '1954-12-18', 'https://upload.wikimedia.org/wikipedia/commons/2/23/Ray_Liotta_Deauville_2014_3.jpg', NULL),
	(6, 'Coppola', 'Francis Ford', 'Homme', '1939-04-07', 'https://img-4.linternaute.com/Irzs1MQwmac-88sLIBwEclZ2aHg=/1500x/smart/16a504f76f2549bb846c68fd00d8f5c1/ccmcms-linternaute/23801388.jpg', NULL),
	(7, 'Scorcesse', 'Martin', 'Homme', '1942-11-17', 'https://cdn-s-www.lalsace.fr/images/A0D3F044-BB0D-42D3-AC65-20AC04FE5B1C/NW_raw/portrait-de-martin-scorsese-photo-brigitte-lacombe-1444664688.jpg', NULL),
	(8, 'Farrely', 'Peter', 'Homme', '1956-12-17', 'https://fr.web.img3.acsta.net/pictures/18/11/05/16/36/3909426.jpg', NULL),
	(9, 'Mann', 'Michael', 'Homme', '1943-02-05', 'https://imgsrc.cineserie.com/2024/01/642987.jpg?ver=1', 'https://fr.wikipedia.org/wiki/Michael_Mann'),
	(10, 'DiCaprio', 'Leonardo', 'Homme', '1974-11-11', 'https://www.screentune.com/wp-content/uploads/2018/11/Leonardo-Dicaprio-British-Awards-noir-blanc.jpg', NULL),
	(11, 'Winslet', 'Kate', 'Femme', '1975-10-05', 'https://i.pinimg.com/564x/0d/8b/98/0d8b98da3f678b27c04fa0598818d6fd.jpg', NULL),
	(12, 'Cruise', 'Tom', 'Homme', '1962-07-03', 'https://usercontent.one/wp/www.screentune.com/wp-content/uploads/2019/07/Tom-Cruise.jpg?media=1649161309', NULL),
	(13, 'Kidman', 'Nicole', 'Femme', '1967-06-20', 'https://i.pinimg.com/736x/53/83/6c/53836c3906c33123bd5f67970c21f71f.jpg', NULL),
	(14, 'Nolan', 'Christopher', 'Homme', '1970-07-30', 'https://upload.wikimedia.org/wikipedia/commons/9/95/Christopher_Nolan_Cannes_2018.jpg', NULL),
	(15, 'Cameron', 'James', 'Homme', '1954-08-16', 'https://ca-times.brightspotcdn.com/dims4/default/a3f2f44/2147483647/strip/true/crop/4000x5000+0+0/resize/1200x1500!/quality/75/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2F7b%2F44%2F9d0cb70248ea93614844d259e6bf%2F1240520-env-james-cameron-cover-shoot-01.jpg', NULL),
	(16, 'De Palma', 'Brian', 'Homme', '1940-09-11', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/BrianDePalma09TIFF.jpg/220px-BrianDePalma09TIFF.jpg', NULL),
	(17, 'Kubrick', 'Stanley', 'Homme', '1928-07-26', 'https://fr.web.img4.acsta.net/medias/nmedia/18/85/93/27/19813127.jpeg', NULL),
	(18, 'Murphy', 'Cillian', 'Homme', '1976-05-25', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Cillian_Murphy-2014.jpg/640px-Cillian_Murphy-2014.jpg', NULL),
	(19, 'Scott', 'Ridley', 'Homme', '1937-11-30', 'https://fr.web.img3.acsta.net/pictures/14/12/10/16/47/273365.jpg', NULL),
	(20, 'Triet', 'Justine', 'Femme', '1978-07-17', 'https://upload.wikimedia.org/wikipedia/commons/6/64/Justine_Triet_2017.jpg', NULL),
	(21, 'Bong', 'Joon-ho', 'Homme', '1969-09-14', 'https://media.vanityfair.com/photos/5da0a9df15cfd60008961fdb/master/w_2560%2Cc_limit/Bong-Joon-Ho-Interview-Lede.jpg', NULL),
	(22, 'Eggers', 'Robert', 'Homme', '1983-07-07', 'https://www.bewaremag.com/wp-content/uploads/2020/04/GettyImages-462299328-1-1024x683-1.jpg', NULL),
	(23, 'Huller', 'Sandra', 'Femme', '1978-04-30', 'https://img.lemde.fr/2023/05/19/0/0/3992/4990/664/0/75/0/c8931aa_1684522008228-csharrock-sandrahuller-1.jpg', NULL),
	(24, 'Skarsgard', 'Alexander', 'Homme', '1976-08-25', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Alexander_Skarsgard_%2829485267411%29_%28cropped%29.jpg/1200px-Alexander_Skarsgard_%2829485267411%29_%28cropped%29.jpg', NULL),
	(25, 'Phoenix', 'Joaquin (Rafael Bottom)', 'Homme', '1974-10-28', 'https://pbs.twimg.com/media/ETJge25XQAA2ryT.jpg', NULL);

-- Listage de la structure de table cinema amine. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_real` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_real`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema amine.realisateur : ~0 rows (environ)
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
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
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


