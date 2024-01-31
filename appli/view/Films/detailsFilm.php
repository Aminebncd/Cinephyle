<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détail du film";

?>
<h1><?= $titre_secondaire ?></h1>

<div class="filmDetails">
    <?php if ($requeteFilm->rowCount() > 0) {
        $film = $requeteFilm->fetch(); ?>
        <img class="afficheDet" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>" >
        <h2 class="detTitre" ><?= $film['titre'] ?></h2>
        
        <div class="corps">
        <p><strong>Réalisateur:</strong> <?= $film['réalisateur'] ?></p>
        <p><strong>Date de sortie (France):</strong> <?= $film['date_sortie_france'] ?></p>
        <p><strong>Durée:</strong> <?= $film['duree_formatée'] ?> minutes</p>
        <p><strong>Note:</strong> <?= $film['note'] ?>
        <p class="resume"><strong>Résumé:</strong> <?= $film['resume'] ?></p>
        </div>

        <h3 class="cast">Distribution des rôles :</h3>
    
        <?php $casting = $requeteCasting->fetchAll(); 
        // var_dump($casting);
        foreach($casting as $cast) { ?>
            <p><?= $cast['acteur'] ?> dans le rôle de  <?= $cast['role'] ?></p>
        <?php }  ?>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour ce film.</p>
    <?php } ?>
    

</div>

<?php

$content = ob_get_clean();
require 'view/template.php'; 

?>