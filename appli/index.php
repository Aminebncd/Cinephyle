<?php

ob_start();

use Controller\cinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new cinemaController();

$id = (isset($_GET["id"])) ? $_GET['id'] : null;

if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case "listFilms":
            $titre_secondaire = "Liste des films";
            $ctrlCinema->listFilms();
            break;

        case "listActeurs":
            $titre_secondaire = "Liste des acteurs";
            $ctrlCinema->listActeurs();
            break;

        case "listReal":
            $titre_secondaire = "Liste des réalisateurs";
            $ctrlCinema->listReal();
            break;
            
        case "detailsFilm":
            $titre_secondaire = "Détails du film";
            $ctrlCinema->detailsFilm($id);
            break;
    }
}
?>

<div class="container"><br><br>
 <a href="index.php?action=listFilms">Liste des films</a>
</div>


<?php

$titre = 'Cinephyle';
$titre_secondaire = "Accueil";
$content = ob_get_clean();
require 'view/template.php'; 

?>