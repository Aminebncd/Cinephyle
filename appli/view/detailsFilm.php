<?php
ob_start();
?>


<div class="film-details">
    <?php if ($requete->rowCount() > 0) {
        $film = $requete->fetch(); ?>
        
        <h2><?= $film['titre'] ?></h2>
        <p><strong>Date de sortie (France):</strong> <?= $film['date_sortie_france'] ?></p>
        <p><strong>Durée:</strong> <?= $film['duree'] ?> minutes</p>
        <p><strong>Résumé:</strong> <?= $film['resume'] ?></p>
        <p><strong>Note:</strong> <?= $film['note'] ?></p>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour ce film.</p>
    <?php } ?>
</div>

<?php

$titre = "Cinephyle";
$titre_secondaire = "Détail du film";
$content = ob_get_clean();
require 'view/template.php'; 

?>