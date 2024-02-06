<?php

namespace Controller;

use Model\Connect;

class GenreController {

    public function listGenres() {
        $pdo = Connect::seConnecter();
    
        $requeteGenre = $pdo->query("
            SELECT 

            id_genre,
            libelle
            
            FROM genre
            
            ");

            require "view/Genres/listGenres.php";
        }
        
    public function detailsGenre($id) {
        $pdo = Connect::seConnecter();
            
        $requeteCate = $pdo->prepare("
            SELECT 

            libelle,
            film.id_film,
            titre
            
            FROM categorise

            INNER JOIN genre on categorise.id_genre = genre.id_genre
            INNER JOIN film on categorise.id_film = film.id_film
            
            where genre.id_genre = :id
            
            "); 
            $requeteCate->execute([":id" => $id]);

            $requeteNomGenre = $pdo->prepare("
            SELECT 
            libelle
            FROM genre
            
            where genre.id_genre = :id
            
            "); 
            $requeteNomGenre->execute([":id" => $id]);
            
            
            
            require "view/Genres/detailsGenre.php";
        }
        
        public function ajoutGenre() {

            if(isset($_POST["submit"])) {

                $pdo = Connect ::seConnecter();
                
                $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
              
                if ($libelle) {
                    
                    $requeteAjout = $pdo->prepare("
                    INSERT INTO genre (libelle) VALUES (:libelle)
                    ");
                    $requeteAjout->execute([":libelle" => $libelle]);
    
                    header("Location: index.php?action=listGenres");
                }
            }
            require "view/Genres/ajoutGenre.php";
        }

        public function modifGenre($id) {
            
        $pdo = Connect ::seConnecter();
        $requeteGenres = $pdo->query("
        SELECT 
        
        id_genre,
        libelle
        
        FROM genre");
        
        $genres = $requeteGenres->fetchAll();
        
        if (isset($_POST["submit"])) {
            // var_dump($_POST);die;
            $genreId = filter_input(INPUT_POST, "idGenre", FILTER_SANITIZE_NUMBER_INT);
            $genreModifie = filter_input(INPUT_POST, "genreModifie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($genreModifie) {
                $requeteModif = $pdo->prepare("
                UPDATE genre
                SET libelle = :genreModifie
                where id_genre = :id
                ");
                $requeteModif->execute([":id" => $genreId,
                            ":genreModifie" => $genreModifie]);
                }
                header("Location: index.php?action=listGenres");
                exit(); 
            }
            require "view/Genres/modifGenre.php";
        }

}


