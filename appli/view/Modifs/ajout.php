
<?php
 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Modifications";
?>

<h1><?= $titre_secondaire ?></h1>

<h3>Vous souhaitez :</h3>

<div class="ajout">
    <div>
            <div class="choiceLabel">
            Ajouter
            </div>
        <ul class="choices">
            <li><a class="link choice" href="index.php?action=ajoutFilm">Un film</a> </li> |
            <li><a class="link choice" href="index.php?action=ajoutActeur">Un acteur</a></li> |
            <li><a class="link choice" href="index.php?action=ajoutReal">Un realisateur</a></li> |
            <li><a class="link choice" href="index.php?action=ajoutGenre">Un genre</a></li> |
            <li><a class="link choice" href="index.php?action=ajoutRole">Un Rôle</a></li>
        </ul>
    </div>
    
</div>


<?php 

$content = ob_get_clean();
require "view/template.php" ;