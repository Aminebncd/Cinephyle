<?php
ob_start();

?>


<div class="film-details">
    <?php if ($requeteFilm->rowCount() > 0) {
        $film = $requeteFilm->fetch(); ?>

        <h2><?= $film['titre'] ?></h2>
        <p><strong>Réalisateur:</strong> <?= $film['réalisateur'] ?></p>
        <p><strong>Date de sortie (France):</strong> <?= $film['date_sortie_france'] ?></p>
        <p><strong>Durée:</strong> <?= $film['duree_formatée'] ?> minutes</p>
        <p><strong>Résumé:</strong> <?= $film['resume'] ?></p>
        <p><strong>Note:</strong> <?= $film['note'] ?></p><br><br><br>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour ce film.</p>
    <?php } ?>
    
    <h3>Distribution des rôles :</h3>
    


    <?php $casting = $requeteCasting->fetchAll(); 
    // var_dump($casting);
    foreach($casting as $cast) { ?>
        <p><?= $cast['acteur'] ?> dans le rôle de  <?= $cast['role'] ?></p>
    <?php }  ?>

</div>

<?php

$titre = "Cinephyle";
$titre_secondaire = "Détail du film";
$content = ob_get_clean();
require 'view/template.php'; 

?>