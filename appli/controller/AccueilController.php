<?php

namespace Controller;

use Model\Connect;

class AccueilController {

    public function landing() {
        $pdo = Connect::seConnecter();
    
        $requeteFilm = $pdo->prepare("
            SELECT 
            
            affiche
            
            FROM film
            
        ");

        $requeteActeurs = $pdo->prepare("
            SELECT CONCAT(prenom, ' ',nom) AS acteur

            FROM acteur
            
            INNER JOIN personne ON acteur.id_personne = personne.id_personne

        "); 
        
            require "view/accueil.php";
        }
        

}