<?php

ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Genre Deleted";

?>
 <h1><?= $titre_secondaire ?></h1>
    <p>The genre has been successfully deleted.</p>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

