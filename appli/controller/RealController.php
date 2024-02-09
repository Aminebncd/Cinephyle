<?php

namespace Controller;

use Model\Connect;

class RealController {

    // Fonction pour lister tous les réalisateurs
    public function listReals() {
        $pdo = Connect::seConnecter();
        
        // Requête pour récupérer tous les réalisateurs
        $requete = $pdo->query("
            SELECT 
            id_real, 
            CONCAT(prenom, ' ', nom) AS nom,
            portrait
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");

        // Inclusion de la vue pour afficher la liste des réalisateurs
        require "view/Réalisateurs/listReals.php";
    }

    // Fonction pour afficher les détails d'un réalisateur, y compris les films qu'il a réalisés
    public function detailsReal($id) {
        $pdo = Connect::seConnecter();
    
        // Requête pour récupérer les détails du réalisateur
        $requeteReal = $pdo->prepare("
            SELECT 
            id_real,
            lien_wiki,
            portrait, 
            CONCAT(prenom, ' ', nom) AS nom, 
            date_naissance
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_real = :id
        ");
        $requeteReal->execute([":id" => $id]);
        
        // Requête pour récupérer les films réalisés par ce réalisateur
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
        
        // Inclusion de la vue pour afficher les détails du réalisateur
        require "view/Réalisateurs/detailsReal.php";
    }
    
    // Fonction pour ajouter un nouveau réalisateur
    public function ajoutReal() {
        if (isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
    
            // Filtrage et nettoyage des entrées POST
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $lienWikipedia = filter_input(INPUT_POST, "lienWikipedia", FILTER_SANITIZE_URL);
    
            // Vérification des entrées et insertion du nouveau réalisateur dans la base de données
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

                $_SESSION['message'] = "Réalisateur ajouté avec succès!";
                header("Location: index.php?action=listReals");
            } else {
                // Gestion de l'erreur en cas d'échec de la suppression
                $_SESSION['message'] = "Erreur lors de l'ajout.";
            }
        }
        
        // Inclusion de la vue pour afficher le formulaire d'ajout de réalisateur
        require "view/Réalisateurs/ajoutReal.php";
    }

    // Fonction pour modifier un réalisateur
    public function modifReal($id) {
        $pdo = Connect::seConnecter();
        
        // Récupération des informations sur le réalisateur à modifier
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
    
        if (isset($_POST["submit"])) {
            // Sanitization des inputs
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $lien_wiki = filter_input(INPUT_POST, "lien_wiki", FILTER_SANITIZE_URL);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_STRING);
    
            // Mise à jour des informations sur le réalisateur
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

            // Récupération des informations sur l'acteur à modifier
            $requeteHeader = $pdo->prepare("
            SELECT
            id_real,
            personne.id_personne
            FROM personne
            INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
            WHERE personne.id_personne = :id
            ");
            $requeteHeader->execute([":id" => $id]);
            $header = $requeteHeader->fetch();
            // var_dump($header['id_acteur']); die;
    
            // Redirection après modification
            $_SESSION['message'] = "Réalisateur modifié avec succès!";
            header("Location: index.php?action=detailsReal&id=$header[id_real]");
            exit(); 
        } else {
            $_SESSION['message'] = "Erreur lors de la modification";
        }
    
        // Inclusion de la vue pour afficher le formulaire de modification de réalisateur
        require "view/Réalisateurs/modifReal.php";
    }

    // Fonction pour supprimer un réalisateur
    public function deleteReal($id) {
        $pdo = Connect::seConnecter();
    
        // Suppression du réalisateur de la base de données
        $requeteDelete = $pdo->prepare("
            DELETE FROM realisateur
            WHERE id_real = :id
        ");
        $success = $requeteDelete->execute([":id" => $id]);

        if ($success) {
            // Redirection vers la liste des réalisateurs après la suppression
            $_SESSION['message'] = "Réalisateur supprimé avec succès!";
            header("Location: index.php?action=listReals");
            exit();
        } else {
            // Gestion de l'erreur en cas d'échec de la suppression
            $_SESSION['message'] = "Erreur lors de la suppression";
        }

        // Inclusion de la vue pour afficher la suppression du réalisateur
        require "view/Réalisateurs/deleteReal.php";
    }
}
