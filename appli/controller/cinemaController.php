<?php

namespace Controller;

use Model\Connect;

class CinemaController {

    // lister les films
    public function listFilms() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->query("
            SELECT id_film, titre, date_sortie_france
            FROM film
        ");

        require "view/Films/listFilms.php";
    }

    public function detailsFilm($id) {
        $pdo = Connect::seConnecter();
    
        $requeteFilm = $pdo->prepare("
            SELECT 
            
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
            SELECT CONCAT(prenom, ' ',nom) AS acteur, role

            FROM casting
            
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN role ON casting.id_role = role.id_role

            WHERE id_film = :id
        "); 
        $requeteCasting->execute([":id" => $id]);
        
            require "view/Films/detailsFilm.php";
        }
        

}