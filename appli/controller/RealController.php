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
                ) AS nom,
                portrait

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
            affiche,
            id_real,
            titre, 
            date_sortie_france

            FROM film

            WHERE id_real = :id
        "); 
        $requeteFilmo->execute([":id" => $id]);
        
        require "view/Réalisateurs/detailsReal.php";
    }
    
    public function ajoutReal() {

        if (isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
    
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $lienWikipedia = filter_input(INPUT_POST, "lienWikipedia", FILTER_SANITIZE_URL);
    
            if ($nom && $prenom && $sexe && $dateNaissance && $portrait && $lienWikipedia) {
    
                $requeteAjout = $pdo->prepare("
                    INSERT INTO personne (nom, prenom, sexe, date_naissance, portrait, lien_wiki)
                    VALUES (:nom, :prenom, :sexe, :dateNaissance, :portrait, :lienWikipedia)
                ");
    
                $requeteAjout->execute([
                    ":nom" => $nom,
                    ":prenom" => $prenom,
                    ":sexe" => $sexe,
                    ":dateNaissance" => $dateNaissance,
                    ":portrait" => $portrait,
                    ":lienWikipedia" => $lienWikipedia
                ]);
    
                $id_personne = $pdo->lastInsertId();
    
                $requeteAjoutReal = $pdo->prepare("
                    INSERT INTO realisateur (id_personne)
                    VALUES (:id_personne)
                ");
    
                $requeteAjoutReal->execute([
                    ":id_personne" => $id_personne
                ]);
    
                header("Location: index.php?action=listReals");
            }
        }
        
        require "view/Réalisateurs/ajoutReal.php";
    }

    public function modifReal($id) {
        $pdo = Connect::seConnecter();
        
        // on recupere le realisateur à modifier
        $requeteReal = $pdo->prepare("
        SELECT
        
        personne.id_personne,
        personne.lien_wiki,
        personne.portrait,
        personne.nom,
        personne.prenom,
        CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
        personne.date_naissance
        FROM personne
        INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
        WHERE id_real = :id;
    
        ");
        $requeteReal->execute([":id" => $id]);
        $realisateur = $requeteReal->fetch();
        // var_dump($realisateur);
    
    
        if (isset($_POST["submit"])) {
            // Sanitize l'input
           
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $lien_wiki = filter_input(INPUT_POST, "lien_wiki", FILTER_SANITIZE_URL);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_STRING);
    
            // mise à jour des infos
            $requeteModif = $pdo->prepare("
                UPDATE personne
                SET prenom = :prenom,
                    nom = :nom,
                    lien_wiki = :lien_wiki,
                    portrait = :portrait,
                    date_naissance = :date_naissance
                WHERE id_personne = :id
            ");
            $requeteModif->execute([
                ":id" => $id,
                ":prenom" => $prenom,
                ":nom" => $nom,
                ":lien_wiki" => $lien_wiki,
                ":portrait" => $portrait,
                ":date_naissance" => $date_naissance
            ]);
    
            // Redirection apres modification
            header("Location: index.php?action=listReals");
            exit(); 
        }
    
        require "view/Réalisateurs/modifReal.php";
    }

}