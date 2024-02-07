<?php

// Activation de la mise en mémoire tampon pour éviter les problèmes d'affichage prématuré
ob_start();

// Inclusion des contrôleurs
use Controller\FilmController;
use Controller\AccueilController;
use Controller\ActeurController;
use Controller\RealController;
use Controller\GenreController;
use Controller\RoleController;

// Autoload des classes
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Instanciation des contrôleurs
$ctrlFilm = new FilmController();
$ctrlAccueil = new AccueilController();
$ctrlActeur = new ActeurController();
$ctrlReal = new RealController();
$ctrlGenre = new GenreController();
$ctrlRole = new RoleController();

// Récupération de l'ID depuis l'URL
$id = (isset($_GET["id"])) ? $_GET['id'] : null;

// Si une action est reçue via l'URL
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // Gestion des actions liées aux films
        case "listFilms": $ctrlFilm->listFilms(); break;
        case "detailsFilm": $ctrlFilm->detailsFilm($id); break;
        case "ajoutFilm": $ctrlFilm->ajoutFilm(); break;
        case "modifFilm": $ctrlFilm->modifFilm($id); break;
        case "deleteFilm": $ctrlFilm->deleteFilm($id); break;
        case "castFilm": $ctrlFilm->castFilm($id); break;

        // Gestion des actions liées aux acteurs
        case "listActeurs": $ctrlActeur->listActeurs(); break;
        case "detailsActeur": $ctrlActeur->detailsActeur($id); break;
        case "ajoutActeur": $ctrlActeur->ajoutActeur(); break;
        case "modifActeur": $ctrlActeur->modifActeur($id); break;
        case "deleteActeur": $ctrlActeur->deleteActeur($id); break;
        
        // Gestion des actions liées aux réalisateurs
        case "listReals": $ctrlReal->listReals(); break;
        case "detailsReal": $ctrlReal->detailsReal($id); break;
        case "ajoutReal": $ctrlReal->ajoutReal(); break;
        case "modifReal": $ctrlReal->modifReal($id); break;
        case "deleteReal": $ctrlReal->deleteReal($id); break;
        
        // Gestion des actions liées aux genres
        case "listGenres": $ctrlGenre->listGenres(); break;
        case "detailsGenre": $ctrlGenre->detailsGenre($id); break;
        case "ajoutGenre": $ctrlGenre->ajoutGenre(); break;
        case "modifGenre": $ctrlGenre->modifGenre($id); break;
        case "deleteGenre": $ctrlGenre->deleteGenre($id); break;
        
        // Gestion des actions liées aux rôles
        case "listRoles": $ctrlRole->listRoles(); break;
        case "detailsRole": $ctrlRole->detailsRole($id); break;
        case "ajoutRole": $ctrlRole->ajoutRole(); break;
        case "modifRole": $ctrlRole->modifRole($id); break;
        case "deleteRole": $ctrlRole->deleteRole($id); break;

        // Redirection vers la page de modifications par défaut si aucune action correspondante n'est trouvée
        case "ajout" : $ctrlAccueil->modif(); break;

        default:
        break;
    }
    
} else {
    // Affichage de la page d'accueil si aucune action n'est reçue
    $ctrlAccueil->landing();
}

?>

