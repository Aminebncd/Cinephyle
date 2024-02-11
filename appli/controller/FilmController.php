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
    
    // afficher les détails d'un film
    public function detailsFilm($id) {
        $pdo = Connect::seConnecter();
    
        // Requête pour récupérer les détails du film spécifié par son ID
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
            FROM 
                film
            INNER JOIN 
                realisateur ON film.id_real = realisateur.id_real
            INNER JOIN 
                personne ON realisateur.id_personne = personne.id_personne
            WHERE 
                id_film = :id
        ");
        $requeteFilm->execute([":id" => $id]);

        // Requête pour récupérer le casting du film
        $requeteCasting = $pdo->prepare("
            SELECT 
                id_film,
                acteur.id_acteur,
                CONCAT(prenom, ' ',nom) AS acteur, 
                role,
                role.id_role
            FROM 
                casting
            INNER JOIN 
                acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN 
                personne ON acteur.id_personne = personne.id_personne
            INNER JOIN 
                role ON casting.id_role = role.id_role
            WHERE 
                id_film = :id
        "); 
        $requeteCasting->execute([":id" => $id]);

        // Requête pour récupérer les genres du film
        $requeteGenre = $pdo->prepare("
            SELECT 
                libelle,
                genre.id_genre,
                film.id_film
            FROM 
                categorise
            INNER JOIN 
                genre ON categorise.id_genre = genre.id_genre
            INNER JOIN 
                film ON categorise.id_film = film.id_film
            WHERE 
                film.id_film = :id
        "); 
        $requeteGenre->execute([":id" => $id]);
        
        // inclusion de la vue pour afficher les détails du film
        require "view/Films/detailsFilm.php";
    }
    
    // ajouter un film
    public function ajoutFilm() {
        $pdo = Connect::seConnecter();
    
        // Récupération de la liste des réalisateurs
        $requeteRealisateurs = $pdo->query("
            SELECT 
                realisateur.id_real, 
                CONCAT(personne.prenom, ' ', personne.nom) AS nom_realisateur
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
            FROM 
                genre");
        
        $genres = $requeteGenres->fetchAll();
    
        // Traitement du formulaire d'ajout de film
        if (isset($_POST["submit"])) {
            // Récupération + nettoyage des données du formulaire soumis par l'utilisateur
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
                    INSERT INTO 
                        film (titre, date_sortie_france, duree, resume, note, affiche, id_real)
                    VALUES 
                        (:titre, :dateSortieFrance, :duree, :resume, :note, :affiche, :idRealisateur)
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

                // catégorisation du film fraichement ajouté
                $id_film = $pdo->lastInsertId();

                // Insertion des catégories associées au film
                foreach ($id_genres as $id_genre) {
                    $requeteAjoutCategorie = $pdo->prepare("
                        INSERT INTO 
                            categorise (id_film, id_genre)
                        VALUES 
                            (:id_film, :id_genre)
                    ");

                    $requeteAjoutCategorie->execute([
                        ":id_film" => $id_film,
                        ":id_genre" => $id_genre
                    ]);
                }
                $_SESSION['message'] = "Film ajouté avec succès!";
                // Redirection vers la liste des films
                header("Location: index.php?action=listFilms");
                exit(); 
            }
        }
    
        // Inclusion du formulaire HTML pour ajouter un film
        require "view/Films/ajoutFilm.php";
    }

    // modifier un film
    public function modifFilm($id) {
        $pdo = Connect::seConnecter();
        
        // Récupération des détails du film à modifier
        $requeteFilm = $pdo->prepare("
            SELECT 
                *
            FROM 
                film
            WHERE 
                id_film = :id
        ");
        $requeteFilm->execute([":id" => $id]);
        $film = $requeteFilm->fetch();

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
            FROM 
                genre
            ");
    
        $genres = $requeteGenres->fetchAll();
    
        // Traitement du formulaire de modification de film
        if (isset($_POST["submit"])) {
            // Sanitization des entrées
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
                UPDATE 
                    film
                SET 
                    titre = :titre,
                    date_sortie_france = :dateSortieFrance,
                    duree = :duree,
                    resume = :resume,
                    note = :note,
                    affiche = :affiche,
                    id_real = :idRealisateur
                WHERE 
                    id_film = :id
            ");
            $requeteModif->execute([
                ":titre" => $titre,
                ":dateSortieFrance" => $dateSortieFrance,
                ":duree" => $duree,
                ":resume" => $resume,
                ":note" => $note,
                ":affiche" => $affiche,
                ":idRealisateur" => $idRealisateur,
                ":id" => $id // Ajout de ce paramètre manquant
            ]);
            
            // Mettre à jour les genres du film
            // Supprimer d'abord les genres existants du film
            $pdo->prepare("
                DELETE FROM 
                    categorise 
                WHERE 
                    id_film = :id")
                ->execute([":id" => $id]);

            // Insérer les nouveaux genres sélectionnés
            foreach ($idGenres as $idGenre) {
                $pdo->prepare("
                    INSERT INTO 
                        categorise (id_film, id_genre) 
                    VALUES 
                        (:id, :idGenre)")
                    ->execute([
                        ":id" => $id,
                        ":idGenre" => $idGenre
                    ]);
            }
            $_SESSION['message'] = "Film modifié avec succès!";
            // Redirection après la modification
            header("Location: index.php?action=listFilms");
            exit(); 
        }
    
        // Inclure la vue pour afficher le formulaire de modification du film
        require "view/Films/modifFilm.php";
    }

    // supprimer un film
    public function deleteFilm($id) {
        $pdo = Connect::seConnecter();
        
        // Supprimer les catégories associées au film
        $pdo->prepare("
            DELETE FROM 
                categorise 
            WHERE 
                id_film = :id")
            ->execute([":id" => $id]);

        $pdo->prepare("
            DELETE FROM 
                casting 
            WHERE 
                id_film = :id")
            ->execute([":id" => $id]);
        
        // Supprimer le film de la base de données
        $requeteDelete = $pdo->prepare("
            DELETE FROM 
                film
            WHERE 
                id_film = :id
        ");
        
        $success = $requeteDelete->execute([":id" => $id]);
        
        if ($success) {
            $_SESSION['message'] = "Film supprimé avec succès!";
            header("Location: index.php?action=listFilms");
            exit();
        } else {
            // Gérer l'erreur, afficher un message d'erreur ou le journaliser
            echo "Une erreur s'est produite lors de la suppression du film.";
        }
        
        // Inclure la vue pour afficher la confirmation de suppression du film
        require "view/Films/deleteFilm.php";
    }
    
    // attribuer un rôle à un acteur pour un film
    public function castFilm($id) {
        $pdo = Connect::seConnecter();

        // Récupération des détails du film spécifié par son ID
        $requeteFilm = $pdo->prepare("
            SELECT 
                *
            FROM 
                film
            WHERE 
                id_film = :id;
        ");
        $requeteFilm->execute([":id" => $id]);
        $film = $requeteFilm->fetch();
        
        // Récupération de la liste des acteurs
        $requeteActeurs = $pdo->query("
            SELECT 
                acteur.id_acteur, 
                CONCAT(personne.prenom, ' ', personne.nom) AS acteur
            FROM 
                acteur
            INNER JOIN 
                personne ON acteur.id_personne = personne.id_personne");
        
        $acteurs = $requeteActeurs->fetchAll();
        
        // Récupération de la liste des rôles
        $requeteRoles = $pdo->query("
            SELECT 
                *
            FROM 
                role
        ");
        
        $roles = $requeteRoles->fetchAll();
        
        // Traitement du formulaire d'attribution de rôle
        if (isset($_POST["submit"])) {
            // Sanitization des entrées
            $idActeur = filter_input(INPUT_POST, "idActeur", FILTER_SANITIZE_NUMBER_INT);
            $idRoles = filter_input(INPUT_POST, "idRole", FILTER_SANITIZE_NUMBER_INT);
            
            if ($idActeur && $idRoles && $id) {
                // Insertion des données dans la table "casting"
                $requeteModif = $pdo->prepare("
                    INSERT INTO 
                        casting (id_film, id_acteur, id_role)
                    VALUES 
                        (:id_film, :id_acteur, :id_role);
                ");
                $requeteModif->execute([
                    ":id_film" => $id,
                    ":id_acteur" => $idActeur,
                    ":id_role" => $idRoles
                ]);

                $_SESSION['message'] = "Casting attribué avec succès!";
                header("Location: index.php?action=detailsFilm&id=$id");
            }
        }
        // Inclure la vue pour afficher le formulaire d'attribution de rôle
        require "view/Films/castFilm.php";
    }

    public function deleteCast($id) {
        // Connexion à la base de données
        $pdo = Connect::seConnecter();
        
        // Supprimer le casting basé sur l'ID du film
        $requeteDelete = $pdo->prepare("
            DELETE FROM casting
            WHERE id_film = :id
        ");
        
        $success = $requeteDelete->execute([":id" => $id]);
        
        if ($success) {
            $_SESSION['message'] = "Casting supprimé avec succès!";            
            header("Location: index.php?action=detailsFilm&id=$id");
            exit();
        } else {
            // Gérer l'erreur, afficher un message d'erreur ou le journaliser
            echo "Une erreur s'est produite lors de la suppression du casting.";
        }
        
        // Inclure la vue pour afficher la confirmation de suppression du film
        require "view/Films/deleteCast.php";
    }


    
    
    

}



