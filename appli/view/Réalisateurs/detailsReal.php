<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détail du réalisateur";

?>
<h1><?= $titre_secondaire ?></h1>

<div class="filmDetails">
    <?php if ($requeteReal->rowCount() > 0) {

        $real = $requeteReal->fetch(); ?>

        <h2 class="detNom" ><?= $real['nom'] ?></h2>
        <img class="portraitDet" src="<?= $real['portrait'] ?>" alt="<?= $real['portrait'] ?>">
        <a href="<?= $real['lien_wiki'] ?>">lien wiki</a>
        
        <div class="corps">
        <p><strong>date de naissance:</strong> <?= $real['date_naissance'] ?></p>
        </div>

        <h3 class="cast">Films réalisés :</h3>
    
        <?php $films = $requeteFilmo->fetchAll(); 
        // var_dump($casting);
        foreach($films as $film) { ?>
        <a class="link" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>"><?= $film['titre'] ?> (<?= $film['date_sortie_france'] ?>)</a>
            
        <?php }  ?>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour ce réalisateur.</p>
    <?php } ?>
    

</div>

<?php

$content = ob_get_clean();
require 'view/template.php'; 

?>