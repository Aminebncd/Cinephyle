<?php

ob_start();

use Controller\FilmController;
use Controller\AccueilController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlFilm = new FilmController();
$ctrlAccueil = new AccueilController();

$id = (isset($_GET["id"])) ? $_GET['id'] : null;

// si une action est reçue
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // FILM //
        case "listFilms": $ctrlFilm->listFilms(); break;
        case "detailsFilm": $ctrlFilm->detailsFilm($id); break;

        // ACTEURS //
        case "listActeurs": $ctrlCinema->listActeurs(); break;
        // case "detailsActeur": $ctrlCinema->detailsFilm($id); break;

        // REALISATEURS //
        case "listReals": $ctrlCinema->listReals(); break;
        // case "detailsReal": $ctrlCinema->detailsFilm($id); break;

            
        default:
        break;
    }
    
} else {
    $ctrlAccueil->landing();
}
?>


