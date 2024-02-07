<?php

ob_start();

use Controller\FilmController;
use Controller\AccueilController;
use Controller\ActeurController;
use Controller\RealController;
use Controller\GenreController;
use Controller\RoleController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlFilm = new FilmController();
$ctrlAccueil = new AccueilController();
$ctrlActeur = new ActeurController();
$ctrlReal = new RealController();
$ctrlGenre = new GenreController();
$ctrlRole = new RoleController();

$id = (isset($_GET["id"])) ? $_GET['id'] : null;

// si une action est reçue
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // FILM //
        case "listFilms": $ctrlFilm->listFilms(); break;
        case "detailsFilm": $ctrlFilm->detailsFilm($id); break;
        case "ajoutFilm": $ctrlFilm->ajoutFilm(); break;
        case "modifFilm": $ctrlFilm->modifFilm($id); break;
        case "deleteFilm": $ctrlFilm->deleteFilm($id); break;
        case "castFilm": $ctrlFilm->castFilm($id); break;

        // ACTEURS //
        case "listActeurs": $ctrlActeur->listActeurs(); break;
        case "detailsActeur": $ctrlActeur->detailsActeur($id); break;
        case "ajoutActeur": $ctrlActeur->ajoutActeur(); break;
        case "modifActeur": $ctrlActeur->modifActeur($id); break;
        case "deleteActeur": $ctrlActeur->deleteActeur($id); break;
        
        // REALISATEURS //
        case "listReals": $ctrlReal->listReals(); break;
        case "detailsReal": $ctrlReal->detailsReal($id); break;
        case "ajoutReal": $ctrlReal->ajoutReal(); break;
        case "modifReal": $ctrlReal->modifReal($id); break;
        case "deleteReal": $ctrlReal->deleteReal($id); break;
        
        // GENRES //
        case "listGenres": $ctrlGenre->listGenres(); break;
        case "detailsGenre": $ctrlGenre->detailsGenre($id); break;
        case "ajoutGenre": $ctrlGenre->ajoutGenre(); break;
        case "modifGenre": $ctrlGenre->modifGenre($id); break;
        case "deleteGenre": $ctrlGenre->deleteGenre($id); break;
        
        // ROLES //
        case "listRoles": $ctrlRole->listRoles(); break;
        case "detailsRole": $ctrlRole->detailsRole($id); break;
        case "ajoutRole": $ctrlRole->ajoutRole(); break;
        case "modifRole": $ctrlRole->modifRole($id); break;
        case "deleteRole": $ctrlRole->deleteRole($id); break;

        // MODIFICATIONS //
        case "ajout" : $ctrlAccueil->modif(); break;

        default:
        break;
    }
    
} else {
    $ctrlAccueil->landing();
}
?>


