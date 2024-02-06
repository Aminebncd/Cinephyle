<?php

namespace Controller;

use Model\Connect;

class FilmController {

    // lister les films
    public function listFilms() {
        $pdo = Connect::seConnecter();
        
        // Récupération des films ordonnés par date de sortie en France
        $requeteDate = $pdo->query("
            SELECT id_film, titre, affiche
            FROM film
            ORDER BY date_sortie_france DESC
        ");
        $filmsDate = $requeteDate->fetchAll();
    
        // Récupération des films ordonnés par note
        $requeteNote = $pdo->query("
            SELECT id_film, titre, affiche
            FROM film
            ORDER BY note DESC
        ");
        $filmsNote = $requeteNote->fetchAll();
    
        // inclusion de la page listFilms
        require "view/Films/listFilms.php";
    }
    

    public function detailsFilm($id) {
        $pdo = Connect::seConnecter();
    
        
        $requeteFilm = $pdo->prepare("
            SELECT 

            film.id_real,
            affiche,
            titre, 
            date_sortie_france, 
            resume, 
            note,
            CONCAT(
                LPAD(FLOOR(duree / 60), 2, '0'), 
                'h', 
                LPAD(duree % 60, 2, '0')
              ) AS duree_formatée, 
              CONCAT (
                  prenom, ' ', nom
                  ) AS réalisateur
               
            FROM film
            
            INNER JOIN realisateur ON film.id_real = realisateur.id_real
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            
            WHERE id_film = :id
        ");
        $requeteFilm->execute([":id" => $id]);


        $requeteCasting = $pdo->prepare("
            SELECT 
            acteur.id_acteur,
            CONCAT(prenom, ' ',nom) AS acteur, 
            role,
            role.id_role

            FROM casting
            
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN role ON casting.id_role = role.id_role

            WHERE id_film = :id
        "); 
        $requeteCasting->execute([":id" => $id]);


        $requeteGenre = $pdo->prepare("
            SELECT 

            libelle,
            genre.id_genre,
            film.id_film
           
            FROM categorise

            INNER JOIN genre on categorise.id_genre = genre.id_genre
            INNER JOIN film on categorise.id_film = film.id_film
        
            WHERE film.id_film = :id
        "); 
        $requeteGenre->execute([":id" => $id]);
        

        require "view/Films/detailsFilm.php";
    }

    
    public function ajoutFilm() {
        $pdo = Connect::seConnecter();
    
        // Récupération de la liste des réalisateurs
        $requeteRealisateurs = $pdo->query("
            SELECT 
            realisateur.id_real, 
            CONCAT(personne.prenom, ' ', personne.nom) AS nom_realisateur

            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne");
    
        $realisateurs = $requeteRealisateurs->fetchAll();
        
        // Récupération de la liste des genres
        $requeteGenres = $pdo->query("
            SELECT 

            id_genre,
            libelle

            FROM genre");
        
        $genres = $requeteGenres->fetchAll();
    
        if (isset($_POST["submit"])) {
            // Récupération + nettoyage des données du formulaire
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateSortieFrance = filter_input(INPUT_POST, "dateSortieFrance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_URL);
            $id_genres = filter_input(INPUT_POST, "idGenre", FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
            $id_realisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_NUMBER_INT);
    
            // Validation des données
            if ($titre && $dateSortieFrance && $duree && $resume && $note && $id_realisateur) {
    
                // Insertion des données dans la table "film"
                $requeteAjoutFilm = $pdo->prepare("
                    INSERT INTO film (titre, date_sortie_france, duree, resume, note, affiche, id_real)
                    VALUES (:titre, :dateSortieFrance, :duree, :resume, :note, :affiche, :idRealisateur)
                ");
    
                $requeteAjoutFilm->execute([
                    ":titre" => $titre,
                    ":dateSortieFrance" => $dateSortieFrance,
                    ":duree" => $duree,
                    ":resume" => $resume,
                    ":note" => $note,
                    ":affiche" => $affiche,
                    ":idRealisateur" => $id_realisateur
                ]);

                // categorisation du film fraichement ajouté
                $id_film = $pdo->lastInsertId();

                // Insertion des catégories associées au film
                foreach ($id_genres as $id_genre) {
                    $requeteAjoutCategorie = $pdo->prepare("
                        INSERT INTO categorise (id_film, id_genre)
                        VALUES (:id_film, :id_genre)
                    ");

                    $requeteAjoutCategorie->execute([
                        ":id_film" => $id_film,
                        ":id_genre" => $id_genre
                    ]);
                }
                
                // Redirection vers la liste des films
                header("Location: index.php?action=listFilms");
                exit(); 
            }
        }
    
        // Inclusion du formulaire HTML
        require "view/Films/ajoutFilm.php";
    }

    public function modifFilm($id) {
        $pdo = Connect::seConnecter();
    
        // Récupération de la liste des réalisateurs
        $requeteRealisateurs = $pdo->query("
            SELECT 
                realisateur.id_real, 
                CONCAT(personne.prenom, ' ', personne.nom) AS realisateur
            FROM 
                realisateur
            INNER JOIN 
                personne ON realisateur.id_personne = personne.id_personne");
    
        $realisateurs = $requeteRealisateurs->fetchAll();
    
        // Récupération de la liste des genres
        $requeteGenres = $pdo->query("
            SELECT 
                id_genre,
                libelle
            FROM genre
            ");
    
        $genres = $requeteGenres->fetchAll();
    
        // Récupération du film à modifier
        $requeteFilm = $pdo->prepare("
            SELECT
                *
            FROM film
        ");
        $requeteFilm->execute();
        $films = $requeteFilm->fetchAll();
    
        
    
        if (isset($_POST["submit"])) {
            // Sanitization des entrées
            $filmId = filter_input(INPUT_POST, "idFilm", FILTER_SANITIZE_NUMBER_INT);
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
            $dateSortieFrance = filter_input(INPUT_POST, "dateSortieFrance", FILTER_SANITIZE_STRING);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_STRING);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_URL);
            $idRealisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_NUMBER_INT);
            $idGenres = filter_input(INPUT_POST, "idGenre", FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
    
            // Mise à jour des informations du film
            $requeteModif = $pdo->prepare("
                UPDATE film
                SET 
                    titre = :titre,
                    date_sortie_france = :dateSortieFrance,
                    duree = :duree,
                    resume = :resume,
                    note = :note,
                    affiche = :affiche,
                    id_realisateur = :idRealisateur
                WHERE 
                    id_film = :idFilm
            ");
            $requeteModif->execute([
                ":idFilm" => $filmId,
                ":titre" => $titre,
                ":dateSortieFrance" => $dateSortieFrance,
                ":duree" => $duree,
                ":resume" => $resume,
                ":note" => $note,
                ":affiche" => $affiche,
                ":idRealisateur" => $idRealisateur
            ]);
    
            // Mettre à jour les genres du film
            // Supprimer d'abord les genres existants du film
            $pdo->prepare("
            DELETE FROM categorise 
            WHERE id_film = :idFilm")
            ->execute([":idFilm" => $filmId]);

            // Insérer les nouveaux genres sélectionnés
            foreach ($idGenres as $idGenre) {
                $pdo->prepare("
                INSERT INTO categorise (id_film, id_genre) 
                VALUES (:idFilm, :idGenre)")
                ->execute([
                    ":idFilm" => $filmId,
                    ":idGenre" => $idGenre
                ]);
            }
    
            // Redirection après la modification
            header("Location: index.php?action=listFilms");
            exit(); 
        }
    
        // Inclure la vue pour afficher le formulaire de modification du film
        require "view/Films/modifFilm.php";
    }
    

    
    
    
        

}