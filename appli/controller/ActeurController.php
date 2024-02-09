<?php

namespace Controller;
session_start();
use Model\Connect;

class ActeurController {

    // Fonction pour lister les acteurs
    public function listActeurs() {
        // Connexion à la base de données
        $pdo = Connect::seConnecter();
        
        // Récupération des informations sur les acteurs avec leur nom complet et leur portrait
        $requeteNom = $pdo->query("
            SELECT
            id_acteur, 
            CONCAT(prenom, ' ', nom) AS nom,
            portrait
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY nom DESC
        ");

        // Récupération des informations sur les acteurs avec leur nom complet et leur portrait, triés par ID décroissant
        $requeteDate = $pdo->query("
            SELECT
            id_acteur, 
            CONCAT(prenom, ' ', nom) AS nom,
            portrait
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY id_acteur DESC
        ");

        // Inclusion de la vue pour afficher la liste des acteurs
        require "view/Acteurs/listActeurs.php";
    }

    // Fonction pour afficher les détails d'un acteur, y compris ses rôles et les titres des films dans lesquels il a joué
    public function detailsActeur($id) {
        $pdo = Connect::seConnecter();
    
        // Requête pour récupérer les informations sur un acteur en fonction de son ID
        $requeteActeur = $pdo->prepare("
        SELECT 
        id_acteur,
        lien_wiki,
        portrait, 
        CONCAT(prenom, ' ', nom) AS nom, 
        date_naissance
        FROM acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        WHERE id_acteur = :id
        ");
        $requeteActeur->execute([":id" => $id]);
        
        // Requête pour récupérer les rôles d'un acteur dans les films
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
        
        // Inclusion de la vue pour afficher les détails de l'acteur
        require "view/Acteurs/detailsActeur.php";
    }

    // Fonction pour ajouter un nouvel acteur
    public function ajoutActeur() {
        if (isset($_POST["submit"])) {
            // Connexion à la base de données
            $pdo = Connect::seConnecter();
            
            // Filtrage et nettoyage des entrées POST
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $lienWikipedia = filter_input(INPUT_POST, "lienWikipedia", FILTER_SANITIZE_URL);
            
            // Vérification et insertion des données dans la table 'personne'
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
                
                // Récupération de l'ID de la personne nouvellement créée
                $id_personne = $pdo->lastInsertId();
                
                // Insertion de l'ID de la personne dans la table 'acteur'
                $requeteAjoutActeur = $pdo->prepare("
                    INSERT INTO acteur (id_personne)
                    VALUES (:id_personne)
                ");
                
                $requeteAjoutActeur->execute([
                    ":id_personne" => $id_personne
                ]);
                $_SESSION['message'] = "Acteur ajouté avec succès!";
                // Redirection vers la liste des acteurs après l'ajout
                header("Location: index.php?action=listActeurs");
            } else {
                $_SESSION['message'] = "Erreur lors de l'ajout";
            }
        }
        
        // Inclusion de la vue pour afficher le formulaire d'ajout d'acteur
        require "view/Acteurs/ajoutActeur.php";
    }

    // Fonction pour modifier un acteur
    public function modifActeur($id) {
        $pdo = Connect::seConnecter();
        
        // Récupération des informations sur l'acteur à modifier
        $requeteActeur = $pdo->prepare("
        SELECT
        id_acteur,
        personne.id_personne,
        personne.lien_wiki,
        personne.portrait,
        personne.nom,
        personne.prenom,
        CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
        personne.date_naissance
        FROM personne
        INNER JOIN acteur ON acteur.id_personne = personne.id_personne
        WHERE id_acteur = :id
        ");
        $requeteActeur->execute([":id" => $id]);
        $acteur = $requeteActeur->fetch();
    
        // var_dump($acteur['id_acteur']); die;
        if (isset($_POST["submit"])) {
            // Sanitization des entrées POST
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $lien_wiki = filter_input(INPUT_POST, "lien_wiki", FILTER_SANITIZE_URL);
            $portrait = filter_input(INPUT_POST, "portrait", FILTER_SANITIZE_URL);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_STRING);
            
            
            // Mise à jour des informations de l'acteur
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
            id_acteur,
            personne.id_personne
            FROM personne
            INNER JOIN acteur ON acteur.id_personne = personne.id_personne
            WHERE personne.id_personne = :id
            ");
            $requeteHeader->execute([":id" => $id]);
            $header = $requeteHeader->fetch();
            // var_dump($header['id_acteur']); die;
    
            // Redirection après modification
            $_SESSION['message'] = "Acteur modifié avec succès!";
            header("Location: index.php?action=detailsActeur&id=$header[id_acteur]");
            exit(); 
        } else {
            $_SESSION['message'] = "Erreur lors de la modification";
        }
    
        // Inclusion de la vue pour afficher le formulaire de modification d'acteur
        require "view/Acteurs/modifActeur.php";
    }

    // Fonction pour supprimer un acteur
    public function deleteActeur($id) {
        $pdo = Connect::seConnecter();
    
        // Suppression de l'acteur de la base de données
        $requeteDelete = $pdo->prepare("
        DELETE FROM acteur
        WHERE id_acteur = :id
        ");
        
        $success = $requeteDelete->execute([":id" => $id]);

        if ($success) {
            $_SESSION['message'] = "Acteur supprimé avec succès!";
            // Redirection vers la liste des acteurs après la suppression
            header("Location: index.php?action=listActeurs");
            exit();
        } else {
            // Gestion de l'erreur en cas d'échec de la suppression
            $_SESSION['message'] = "Erreur lors de la suppression";
        }

        // Inclusion de la vue pour afficher la suppression de l'acteur
        require "view/Acteurs/deleteActeur.php";
    }
}

?>
