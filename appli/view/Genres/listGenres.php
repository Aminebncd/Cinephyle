<?php

ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des genres";
if (isset($_SESSION['message'])) {
    echo '<div class="alert customAlert mt-2">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<h1><?= $titre_secondaire ?></h1>

<div class="container mb-3 listGenres">
    <?php foreach($requeteGenre->fetchAll() as $genre): ?>
        <div class="listGenreElements">
            <a class="link genreElement" href="index.php?action=detailsGenre&id=<?= $genre['id_genre']?>"><?= $genre['libelle']?></a>
        </div>
    <?php endforeach; ?>
</div>

<?php 
$content = ob_get_clean();
require "view/template.php";
