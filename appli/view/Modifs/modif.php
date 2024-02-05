
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Modifications";
?>

<h1><?= $titre_secondaire ?></h1>




<?php 

$content = ob_get_clean();
require "view/template.php" ;