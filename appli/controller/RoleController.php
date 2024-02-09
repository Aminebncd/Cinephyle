<?php

namespace Controller;

use Model\Connect;

class RoleController {

    // Fonction pour lister tous les rôles
    public function listRoles() {
        $pdo = Connect::seConnecter();
    
        // Requête pour récupérer tous les rôles
        $requeteRoles = $pdo->query("
            SELECT *
            FROM role
            ORDER BY role ASC
        ");

        // Inclusion de la vue pour afficher la liste des rôles
        require "view/Roles/listRoles.php";
    }

    // Fonction pour afficher les détails d'un rôle, y compris les acteurs associés
    public function detailsRole($id) {
        $pdo = Connect::seConnecter();
            
        // Requête pour récupérer les acteurs associés à ce rôle
        $requeteHisto = $pdo->prepare("
            SELECT 
            CONCAT(prenom, ' ', nom) AS acteur,
            acteur.id_acteur,
            film.id_film,
            titre
            FROM casting
            INNER JOIN Role ON casting.id_Role = Role.id_Role
            INNER JOIN film ON casting.id_film = film.id_film
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE role.id_role = :id
        "); 
        $requeteHisto->execute([":id" => $id]);

        // Requête pour récupérer le nom du rôle
        $requeteNomRole = $pdo->prepare("
            SELECT 
            role
            FROM role
            WHERE role.id_role = :id
        "); 
        $requeteNomRole->execute([":id" => $id]);

        // Inclusion de la vue pour afficher les détails du rôle
        require "view/Roles/detailsRole.php";
    }

    // Fonction pour ajouter un nouveau rôle
    public function ajoutRole() {
        if(isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
            $intitule = filter_input(INPUT_POST, "intitule", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          
            if ($intitule) {
                // Requête pour ajouter un nouveau rôle dans la base de données
                $requeteAjout = $pdo->prepare("
                    INSERT INTO role (role) VALUES (:intitule)
                ");
                $requeteAjout->execute([":intitule" => $intitule]);
                $_SESSION['message'] = "Rôle ajouté avec succès!";
                header("Location: index.php?action=listRoles");
            }
        }
        // Inclusion de la vue pour afficher le formulaire d'ajout de rôle
        require "view/Roles/ajoutRole.php";
    }

    // Fonction pour modifier un rôle
    public function modifRole($id) {
        $pdo = Connect::seConnecter();
        
        // Récupération des informations sur le rôle à modifier
        $requeteRole = $pdo->prepare("
            SELECT 
            id_role,
            role
            FROM role
            WHERE id_role = :id
        ");
        $requeteRole->execute([":id" => $id]);
        $roleData = $requeteRole->fetch();
        
        $role = $roleData['role'];
        $id = $roleData['id_role'];
        
        if (isset($_POST["submit"])) {
            $roleModifie = filter_input(INPUT_POST, "roleModifie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($roleModifie) {
                // Requête pour modifier le rôle dans la base de données
                $requeteModif = $pdo->prepare("
                    UPDATE role
                    SET role = :roleModifie
                    WHERE id_role = :id
                ");
                $requeteModif->execute([
                    ":id" => $id,
                    ":roleModifie" => $roleModifie
                ]);
            }
            $_SESSION['message'] = "Rôle Modifié avec succès!";
            header("Location: index.php?action=listRoles");
            exit(); 
        }
        // Inclusion de la vue pour afficher le formulaire de modification de rôle
        require "view/Roles/modifRole.php";
    }

    // Fonction pour supprimer un rôle
    public function deleteRole($id) {
        $pdo = Connect::seConnecter();
    
        // Suppression du rôle de la base de données
        $requeteDelete = $pdo->prepare("
            DELETE FROM role
            WHERE id_role = :id
        ");
        $success = $requeteDelete->execute([":id" => $id]);

        if ($success) {
            $_SESSION['message'] = "Rôle supprimé avec succès!";
            header("Location: index.php?action=listRoles");
            exit();
        } else {
            // Gestion de l'erreur en cas d'échec de la suppression
            $_SESSION['message'] = "Une erreur est survenue lors de la suppression du rôle";
        }

        // Inclusion de la vue pour afficher la suppression du rôle
        require "view/Roles/deleteRole.php";
    }
}
