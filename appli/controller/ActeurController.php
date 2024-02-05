<?php

namespace Controller;

use Model\Connect;

class ActeurController {

    // lister les acteurs
    public function listActeurs() {

        // se connete à ma base de données
        $pdo = Connect::seConnecter();
        // recupere les champs voulues
        $requete = $pdo->query("
            SELECT
             
            id_acteur, 
            CONCAT (prenom, ' ', nom) AS nom,
            portrait

            FROM acteur

            INNER JOIN personne on acteur.id_personne = personne.id_personne
        ");
        // inclusion de la page listActeurs
        require "view/Acteurs/listActeurs.php";
    }

    // detail l'acteur sur lequel on clique en recuperant ses infos ainsi que les roles ainsi que les titres des films dans lesquels il a joué
    public function detailsActeur($id) {
        $pdo = Connect::seConnecter();
    
        $requeteActeur = $pdo->prepare("
        SELECT 

        id_acteur,
        lien_wiki,
        portrait, 
        CONCAT (prenom, ' ', nom) AS nom, 
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

    // fonction d'ajout d'acteur fonctionnant avec un formulaire
    public function ajoutActeur() {
        // si on recupere des input en POST on rentre dans la fonction
        if (isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
            
            // filtrage et nettoyage des inputs recupérés
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $lienWikipedia = filter_input(INPUT_POST, "lienWikipedia", FILTER_SANITIZE_URL);
            
            // si tous les inputs sont bons, on les insere dans la rable 'personne' sous les bons champs
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
                
                // on recupère l'id fraichement incrémenté de la personne créée
                $id_personne = $pdo->lastInsertId();
                // et on l'injecte dans la table acteur
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