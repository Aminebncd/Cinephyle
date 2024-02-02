<?php

namespace Controller;

use Model\Connect;

class RoleController {

    public function listRoles() {
        $pdo = Connect::seConnecter();
    
        $requeteRoles = $pdo->query("
            SELECT 

            *
            
            FROM role
            
            ");

            require "view/Roles/listRoles.php";
        }
        
    public function detailsRole($id) {
        $pdo = Connect::seConnecter();
            
        $requeteHisto = $pdo->prepare("
            SELECT 

            CONCAT(prenom, ' ',nom) AS acteur,
            acteur.id_acteur,
            film.id_film,
            titre

            
            FROM casting

            INNER JOIN Role on casting.id_Role = Role.id_Role
            INNER JOIN film on casting.id_film = film.id_film
            INNER JOIN acteur on casting.id_acteur = acteur.id_acteur
            INNER JOIN personne on acteur.id_personne = personne.id_personne
            

            
            where role.id_role = :id
            
            "); 
            $requeteHisto->execute([":id" => $id]);

            $requeteNomRole = $pdo->prepare("
            SELECT 
            role
            FROM role
            
            where role.id_role = :id
            
            "); 
            $requeteNomRole->execute([":id" => $id]);


            require "view/Roles/detailsRole.php";
        }

        public function ajoutRole() {

            if(isset($_POST["submit"])) {

                $pdo = Connect ::seConnecter();
                
                $intitule = filter_input(INPUT_POST, "intitule", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
              
                if ($intitule) {
                    
                    $requeteAjout = $pdo->prepare("
                    INSERT INTO genre (intitule) VALUES (:intitule)
                    ");
                    $requeteAjout->execute([":intitule" => $intitule]);
    
                    header("Location: index.php?action=listRoles");
                }
            }
            require "view/Roles/ajoutRole.php";
        }
}