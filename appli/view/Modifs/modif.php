
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Modifications";
?>

<h1><?= $titre_secondaire ?></h1>

<h3>Vous souhaitez :</h3>

<div class="choice">
    <div>
            <div class="choiceLabel">
            Ajouter
            </div>
        <ul>
            <li><a class="link" href="index.php?action=ajoutFilm">Un film</a> </li>
            <li><a class="link" href="index.php?action=ajoutActeur">Un acteur</a></li>
            <li><a class="link" href="index.php?action=ajoutReal">Un realisateur</a></li>
            <li><a class="link" href="index.php?action=ajoutGenre">Un genre</a></li>
            <li><a class="link" href="index.php?action=ajoutRole">Un Role</a></li>
        </ul>
    </div>
    <div>
            <div class="choiceLabel">
            Modifier
            </div>
        <ul>
            <li><a class="link" href="index.php?action=modifFilm">Un film</a> </li>
            <li><a class="link" href="index.php?action=modifActeur">Un acteur</a></li>
            <li><a class="link" href="index.php?action=modifReal">Un realisateur</a></li>
            <li><a class="link" href="index.php?action=modifGenre">Un genre</a></li>
            <li><a class="link" href="index.php?action=modifRole">Un Role</a></li>
        </ul>
    </div>
    <div>
            <div class="choiceLabel">
            Supprimer
            </div>
        <ul>
            <li><a class="link" href="index.php?action=deleteFilm">Un film</a> </li>
            <li><a class="link" href="index.php?action=deleteActeur">Un acteur</a></li>
            <li><a class="link" href="index.php?action=deleteReal">Un realisateur</a></li>
            <li><a class="link" href="index.php?action=deleteGenre">Un genre</a></li>
            <li><a class="link" href="index.php?action=deleteRole">Un Role</a></li>
        </ul>
    </div>
</div>


<?php 

$content = ob_get_clean();
require "view/template.php" ;