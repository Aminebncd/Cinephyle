<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Role Deleted";

?>
 <h1><?= $titre_secondaire ?></h1>
    <p>The role has been successfully deleted.</p>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

