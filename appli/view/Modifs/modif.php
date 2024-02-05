
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Modifications";
?>

<h1><?= $titre_secondaire ?></h1>

<h2>Vous souhaitez :</h2>

<div class="choice">
    <div>Ajouter
        <ul>
            <li>Un film</li>
            <li>Un acteur</li>
            <li>Un realisateur</li>
            <li>Un genre</li>
            <li>Un Role</li>
        </ul>
    </div>
    <div>Modifier
        <ul>
            <li>Un film</li>
            <li>Un acteur</li>
            <li>Un realisateur</li>
            <li>Un genre</li>
            <li>Un Role</li>
        </ul>
    </div>
    <div>Supprimer
        <ul>
            <li>Un film</li>
            <li>Un acteur</li>
            <li>Un realisateur</li>
            <li>Un genre</li>
            <li>Un Role</li>
        </ul>
    </div>
</div>


<?php 

$content = ob_get_clean();
require "view/template.php" ;