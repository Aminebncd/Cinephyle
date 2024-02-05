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
                ) AS nom,
            portrait

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
            role.id_role,
            titre

            FROM casting
            
            INNER JOIN role ON casting.id_role = role.id_role
            INNER JOIN film ON casting.id_film = film.id_film

            WHERE id_acteur = :id
        "); 
        $requeteRoles->execute([":id" => $id]);
        
        require "view/Acteurs/detailsActeur.php";
    }

    public function ajoutActeur() {

        if (isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
    
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $lienWikipedia = filter_input(INPUT_POST, "lienWikipedia", FILTER_SANITIZE_URL);
    
            if ($nom && $prenom && $sexe && $dateNaissance) {
    
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
    
                $requeteAjoutActeur = $pdo->prepare("
                    INSERT INTO acteur (id_personne)
                    VALUES (:id_personne)
                ");
    
                $requeteAjoutActeur->execute([
                    ":id_personne" => $id_personne
                ]);
    
                header("Location: index.php?action=listActeurs");
            }
        }
        
        require "view/Acteurs/ajoutActeur.php";
    }
        

}