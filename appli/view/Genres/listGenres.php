<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des genres";
?>

<h1><?= $titre_secondaire ?></h1>

<div class="mb-3 listGenres">
    <?php foreach($requeteGenre->fetchAll() as $genre): ?>
        <div class="listGenreElements">
            <a class="link genreElement" href="index.php?action=detailsGenre&id=<?= $genre['id_genre']?>"><?= $genre['libelle']?></a>
        </div>
    <?php endforeach; ?>
</div>

<?php 
$content = ob_get_clean();
require "view/template.php";
