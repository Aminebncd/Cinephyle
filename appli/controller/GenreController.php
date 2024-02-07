<?php

namespace Controller;

use Model\Connect;

class GenreController {

    // Fonction pour lister tous les genres
    public function listGenres() {
        $pdo = Connect::seConnecter();
    
        // Requête pour récupérer tous les genres
        $requeteGenre = $pdo->query("
            SELECT 
            id_genre,
            libelle
            FROM genre
        ");

        // Inclusion de la vue pour afficher la liste des genres
        require "view/Genres/listGenres.php";
    }
    
    // Fonction pour afficher les détails d'un genre, y compris les films associés à ce genre
    public function detailsGenre($id) {
        $pdo = Connect::seConnecter();
        
        // Requête pour récupérer les films associés à un genre spécifique
        $requeteCate = $pdo->prepare("
            SELECT 
            libelle,
            film.id_film,
            titre
            FROM categorise
            INNER JOIN genre ON categorise.id_genre = genre.id_genre
            INNER JOIN film ON categorise.id_film = film.id_film
            WHERE genre.id_genre = :id
        "); 
        $requeteCate->execute([":id" => $id]);
        
        // Requête pour récupérer les détails du genre
        $requeteNomGenre = $pdo->prepare("
            SELECT 
            id_genre,
            libelle
            FROM genre
            WHERE genre.id_genre = :id
        "); 
        $requeteNomGenre->execute([":id" => $id]);
        
        // Inclusion de la vue pour afficher les détails du genre
        require "view/Genres/detailsGenre.php";
    }
    
    // Fonction pour ajouter un nouveau genre
    public function ajoutGenre() {
        if(isset($_POST["submit"])) {
            $pdo = Connect::seConnecter();
            
            // Filtrage et nettoyage des entrées POST
            $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if ($libelle) {
                // Insertion du nouveau genre dans la base de données
                $requeteAjout = $pdo->prepare("
                    INSERT INTO genre (libelle) VALUES (:libelle)
                ");
                $requeteAjout->execute([":libelle" => $libelle]);
    
                // Redirection vers la liste des genres après l'ajout
                header("Location: index.php?action=listGenres");
            }
        }
        // Inclusion de la vue pour afficher le formulaire d'ajout de genre
        require "view/Genres/ajoutGenre.php";
    }

    // Fonction pour modifier un genre
    public function modifGenre($id) {
        $pdo = Connect::seConnecter();
        
        // Récupération des informations sur le genre à modifier
        $requeteGenre = $pdo->prepare("
            SELECT 
            id_genre,
            libelle
            FROM genre
            WHERE id_genre = :id
        ");
        $requeteGenre->execute([":id" => $id]);
        
        // Vérification si les données du genre ont été récupérées avec succès
        $genreData = $requeteGenre->fetch();
        if ($genreData) {
            // Récupération des données du genre
            $genre = $genreData['libelle'];
            $id = $genreData['id_genre'];
        
            if (isset($_POST["submit"])) {
                // Filtrage de l'entrée POST
                $genreModifie = filter_input(INPUT_POST, "genreModifie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if ($genreModifie) {
                    // Mise à jour du genre dans la base de données
                    $requeteModif = $pdo->prepare("
                        UPDATE genre
                        SET libelle = :genreModifie
                        WHERE id_genre = :id
                    ");
                    $success = $requeteModif->execute([
                        ":id" => $id,
                        ":genreModifie" => $genreModifie
                    ]);
                    if ($success) {
                        // Redirection vers la liste des genres après la modification
                        header("Location: index.php?action=listGenres");
                        exit();
                    } else {
                        // Gestion de l'erreur en cas d'échec de la modification
                        echo "Error occurred while updating genre.";
                    }
                }
            }
        } else {
            // Gestion du cas où les données du genre ne sont pas trouvées
            echo "Genre not found.";
            exit();
        }
        
        // Inclusion de la vue pour afficher le formulaire de modification de genre
        require "view/Genres/modifGenre.php";
    }

    // Fonction pour supprimer un genre
    public function deleteGenre($id) {
        $pdo = Connect::seConnecter();
    
        // Suppression du genre de la base de données
        $requeteDelete = $pdo->prepare("
            DELETE FROM genre
            WHERE id_genre = :id
        ");
        $success = $requeteDelete->execute([":id" => $id]);

        if ($success) {
            // Redirection vers la liste des genres après la suppression
            header("Location: index.php?action=listGenres");
            exit();
        } else {
            // Gestion de l'erreur en cas d'échec de la suppression
            echo "Error occurred while updating genre.";
        }

        // Inclusion de la vue pour afficher la suppression du genre
        require "view/Genres/deleteGenre.php";
    }
}
