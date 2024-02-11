<?php
ob_start(); 
$titre = "Cinephyle";
$titre_secondaire = "Cast Deleted";
?>

 <h1><?= $titre_secondaire ?></h1>
    <p>The cast has been successfully deleted.</p>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

