<?php

namespace Controller;
session_start();
use Model\Connect;

class AccueilController {

    // Fonction pour afficher la page d'accueil
    public function landing() {
        // Connexion à la base de données
        $pdo = Connect::seConnecter();
    
        // Préparation de la requête SQL pour récupérer les affiches des films
        $requeteFilm = $pdo->query("
            SELECT 
            id_film,
            affiche
            FROM film
            LIMIT 4
        ");

        // Préparation de la requête SQL pour récupérer les noms des acteurs
        $requeteActeur = $pdo->query("
            SELECT CONCAT(prenom, ' ', nom) AS acteur, portrait, id_acteur
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            LIMIT 5 
        "); 

        $requeteGenre = $pdo->query("
            SELECT 
            id_genre,
            libelle
            FROM genre
            LIMIT 8
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
