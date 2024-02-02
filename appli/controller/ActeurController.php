<?php

namespace Controller;

use Model\Connect;

class ActeurController {

    // lister les films
    public function listActeurs() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->query("
            SELECT id_acteur, 
            CONCAT (
                prenom, ' ', nom
                ) AS nom

            FROM acteur

            INNER JOIN personne on acteur.id_personne = personne.id_personne
        ");

        require "view/Acteurs/listActeurs.php";
    }

    public function detailsActeur($id) {
        $pdo = Connect::seConnecter();
    
        $requeteActeur = $pdo->prepare("
        SELECT id_acteur,
        lien_wiki,
        portrait, 
        CONCAT (
            prenom, ' ', nom
            ) AS nom, 
            date_naissance

        FROM acteur

        INNER JOIN personne on acteur.id_personne = personne.id_personne
            
            WHERE id_acteur = :id
        ");

        $requeteActeur->execute([":id" => $id]);
        $requeteRoles = $pdo->prepare("
            SELECT 
            film.id_film,
            id_acteur,
            date_sortie_france,
            role, 
            titre

            FROM casting
            
            INNER JOIN role ON casting.id_role = role.id_role
            INNER JOIN film ON casting.id_film = film.id_film

            WHERE id_acteur = :id
        "); 
        $requeteRoles->execute([":id" => $id]);
        
            require "view/Acteurs/detailsActeur.php";
        }
        

}