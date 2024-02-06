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
    <a class="btn btn-outline-primary" href="index.php?action=modifGenre&id=<?= $idGenre ?>" class="btn">Modifier le genre</a>
    <a class="btn btn-outline-danger" href="index.php?action=deleteGenre&id=<?= $idGenre ?>" class="btn">supprimer le genre</a>
</div> 

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

<!-- 
.btn {
  background-color: #4caf50;
  border: none; 
  color: white; 
  padding: 10px 20px; 
  text-align: center; 
  text-decoration: none; 
  display: inline-block; 
  font-size: 16px; 
  border-radius: 5px; 
  transition: background-color 0.3s;
}
.btn:hover {
  background-color: #c9d2e79c; 
  cursor: pointer; 
} -->

