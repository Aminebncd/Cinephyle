<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Retrouvez toutes les infos sur vos films favoris.";
?>



<div class="textLanding">
    <h1 class="h1Landing"><?= $titre_secondaire ?></h1>
    <p class="pLanding">Une base de donnée tenue par des passionnés, pour des passionés.</p>
</div>


<?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>