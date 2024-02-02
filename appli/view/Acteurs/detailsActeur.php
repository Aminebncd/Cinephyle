<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détail de l'acteur";

?>
<h1><?= $titre_secondaire ?></h1>

<div class="filmDetails">
    <?php if ($requeteActeur->rowCount() > 0) {

        $acteur = $requeteActeur->fetch(); ?>

        <h2 class="detNom" ><?= $acteur['nom'] ?></h2>
        <img class="portraitDet" src="<?= $acteur['portrait'] ?>" alt="<?= $acteur['portrait'] ?>">
        <a href="<?= $acteur['lien_wiki'] ?>">lien wiki</a>
        
        <div class="corps">
        <p><strong>date de naissance:</strong> <?= $acteur['date_naissance'] ?></p>
        </div>

        <h3 class="cast">Rôles incarnés :</h3>
    
        <?php $roles = $requeteRoles->fetchAll(); 
        // var_dump($casting);
        foreach($roles as $role) { ?>
            <p><a class="filmLink" href="index.php?action=detailsRole&id=<?= $role['id_role'] ?>"><?= $role['role'] ?></a> dans <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $role['id_film']?>"><?= $role['titre'] ?> (<?= date('Y', strtotime($role['date_sortie_france'])) ?>)</a></p>
            
        <?php }  ?>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour cet acteur.</p>
    <?php } ?>
    

</div>

<?php

$content = ob_get_clean();
require 'view/template.php'; 

?>