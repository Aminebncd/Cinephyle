<?php

ob_start();

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET['id'] : null;

// si une action est reçue
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // FILM //
        case "listFilms": $ctrlCinema->listFilms(); break;
        case "detailsFilm": $ctrlCinema->detailsFilm($id); break;

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
    $titre = 'Cinephyle';
    $titre_secondaire = "Accueil";
    $content = ob_get_clean();
    require 'view/template.php'; 
}
?>



<div class="container"><br><br>

 <a href="index.php">Accueil</a><br>
 <a href="index.php?action=listFilms">Liste des films</a><br>
 <a href="index.php?action=listActeurs">Liste des acteurs</a><br>
 <a href="index.php?action=listReals">Liste des réalisateurs</a><br>

</div>
