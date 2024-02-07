

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


