<?php

ob_start();

use Controller\FilmController;
use Controller\AccueilController;
use Controller\ActeurController;
use Controller\RealController;
use Controller\GenreController;
// use Controller\RealController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlFilm = new FilmController();
$ctrlAccueil = new AccueilController();
$ctrlActeur = new ActeurController();
$ctrlReal = new RealController();
$ctrlGenre = new GenreController();
// $ctrlRole = new RoleController();

$id = (isset($_GET["id"])) ? $_GET['id'] : null;

// si une action est reçue
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // FILM //
        case "listFilms": $ctrlFilm->listFilms(); break;
        case "detailsFilm": $ctrlFilm->detailsFilm($id); break;

        // ACTEURS //
        case "listActeurs": $ctrlActeur->listActeurs(); break;
        case "detailsActeur": $ctrlActeur->detailsActeur($id); break;

        // REALISATEURS //
        case "listReals": $ctrlReal->listReals(); break;
        case "detailsReal": $ctrlReal->detailsReal($id); break;

        // GENRES //
        case "listGenres": $ctrlGenre->listGenres(); break;
        case "detailsGenre": $ctrlGenre->detailsGenre($id); break;

        // // ROLES //
        // case "listRoles": $ctrlRole->listRoles(); break;
        // case "detailsRole": $ctrlRole->detailsRole($id); break;
            
        default:
        break;
    }
    
} else {
    $ctrlAccueil->landing();
}
?>


