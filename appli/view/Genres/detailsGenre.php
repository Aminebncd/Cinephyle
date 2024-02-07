<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des films contenant le genre :";
$genreData = $requeteNomGenre->fetch();
$idGenre = $genreData['id_genre'];
$libelle = $genreData['libelle'];
?>

<div class="container">
    <h1><?= $titre_secondaire ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" colspan="2"><?= $libelle?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($requeteCate->fetchAll() as $categorie): ?>
                <tr>
                    <td>
                        <a class="link" href="index.php?action=detailsFilm&id=<?= $categorie['id_film']?>"><?= $categorie['titre']?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container buttons">
    <a class="btn btn-outline-primary" href="index.php?action=modifGenre&id=<?= $id ?>" class="btn">Modifier le genre</a>
    <a class="btn btn-outline-danger" href="index.php?action=deleteGenre&id=<?= $id ?>" class="btn">supprimer le genre</a>
</div> 

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

