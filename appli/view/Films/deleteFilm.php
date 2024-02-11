<?php

ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Film Deleted";

?>
 <h1><?= $titre_secondaire ?></h1>
    <p>The Film has been successfully deleted.</p>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

