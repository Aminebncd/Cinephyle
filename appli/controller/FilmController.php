<?php

namespace Controller;

use Model\Connect;

class FilmController {

    // lister les films
    public function listFilms() {
        $pdo = Connect::seConnecter();
        
        // Récupération des films ordonnés par date de sortie en France
        $requeteDate = $pdo->query("
            SELECT id_film, titre, affiche
            FROM film
            ORDER BY date_sortie_france DESC
        ");
        $filmsDate = $requeteDate->fetchAll();
    
        // Récupération des films ordonnés par note
        $requeteNote = $pdo->query("
            SELECT id_film, titre, affiche
            FROM film
            ORDER BY note DESC
        ");
        $filmsNote = $requeteNote->fetchAll();
    
        // Inclusion de la vue avec les résultats
        require "view/Films/listFilms.php";
    }
    

    public function detailsFilm($id) {
        $pdo = Connect::seConnecter();
    
        
        $requeteFilm = $pdo->prepare("
            SELECT 

            film.id_real,
            affiche,
            titre, 
            date_sortie_france, 
            resume, 
            note,
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
            
            WHERE id_film = :id
        ");
        $requeteFilm->execute([":id" => $id]);


        $requeteCasting = $pdo->prepare("
            SELECT 
            acteur.id_acteur,
            CONCAT(prenom, ' ',nom) AS acteur, 
            role,
            role.id_role

            FROM casting
            
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN role ON casting.id_role = role.id_role

            WHERE id_film = :id
        "); 
        $requeteCasting->execute([":id" => $id]);


        $requeteGenre = $pdo->prepare("
            SELECT 

            libelle,
            genre.id_genre,
            film.id_film
           
            FROM categorise

            INNER JOIN genre on categorise.id_genre = genre.id_genre
            INNER JOIN film on categorise.id_film = film.id_film
        
            WHERE film.id_film = :id
        "); 
        $requeteGenre->execute([":id" => $id]);
        

        require "view/Films/detailsFilm.php";
    }

    
    
    
        

}