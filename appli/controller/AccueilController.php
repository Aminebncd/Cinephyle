<?php

namespace Controller;

use Model\Connect;

class AccueilController {

    // Fonction pour afficher la page d'accueil
    public function landing() {
        // Connexion à la base de données
        $pdo = Connect::seConnecter();
    
        // Préparation de la requête SQL pour récupérer les affiches des films
        $requeteFilm = $pdo->prepare("
            SELECT 
            affiche
            FROM film
        ");

        // Préparation de la requête SQL pour récupérer les noms des acteurs
        $requeteActeurs = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) AS acteur
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        "); 
        
        // Inclusion de la vue de la page d'accueil
        require "view/accueil.php";
    }

    // Fonction pour afficher la page de modification
    public function modif() {
        // Inclusion de la vue de la page de modification
        require "view/Modifs/ajout.php";
    }
        
}
