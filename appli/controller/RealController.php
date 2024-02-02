<?php

namespace Controller;

use Model\Connect;

class RealController {

    // lister les films
    public function listReals() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->query("
            SELECT id_real, 
            CONCAT (
                prenom, ' ', nom
                ) AS nom

            FROM realisateur

            INNER JOIN personne on realisateur.id_personne = personne.id_personne
        ");

        require "view/Réalisateurs/listReals.php";
    }

    public function detailsReal($id) {
        $pdo = Connect::seConnecter();
    
        $requeteReal = $pdo->prepare("
        SELECT id_real,
        lien_wiki,
        portrait, 
        CONCAT (
            prenom, ' ', nom
            ) AS nom, 
            date_naissance

        FROM realisateur

        INNER JOIN personne on realisateur.id_personne = personne.id_personne
            
            WHERE id_real = :id
        ");

        $requeteReal->execute([":id" => $id]);
        $requeteFilmo = $pdo->prepare("
            SELECT 
            id_film,
            id_real,
            titre, 
            date_sortie_france

            FROM film

            WHERE id_real = :id
        "); 
        $requeteFilmo->execute([":id" => $id]);
        
            require "view/Réalisateurs/detailsReal.php";
        }
        

}