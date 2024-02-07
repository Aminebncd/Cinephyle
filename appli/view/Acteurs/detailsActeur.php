<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détail de l'acteur";

?>
<h1><?= $titre_secondaire ?></h1>

<div class="acteurDetails mb-5">
    <?php if ($requeteActeur->rowCount() > 0) {

        $acteur = $requeteActeur->fetch(); ?>

        <h2 class="detNom" ><?= $acteur['nom'] ?></h2>
        <div class ='infos'>
            <div class="contPortrait">

                <img class="portraitDet" src="<?= $acteur['portrait'] ?>" alt="<?= $acteur['portrait'] ?>">
            </div>
            <div class="detActCorps">
            <a href="<?= $acteur['lien_wiki'] ?>">lien wikipedia</a>
            <p><strong>date de naissance:</strong> <?= date('d/m/Y', strtotime($acteur['date_naissance'])) ?></p>
            <div class="casting">
                <p class="castLabel">Rôles incarnés :</p>
    
                <?php $roles = $requeteRoles->fetchAll();
                foreach($roles as $role) { ?>
                    <p><a class="link" href="index.php?action=detailsRole&id=<?= $role['id_role'] ?>"><?= $role['role'] ?></a> dans <a class="link" href="index.php?action=detailsFilm&id=<?= $role['id_film']?>"><?= $role['titre'] ?> (<?= date('Y', strtotime($role['date_sortie_france'])) ?>)</a></p>
                <?php }  ?>
            </div>
            <div class="container buttons">
                <a class="btn btn-outline-primary" href="index.php?action=modifActeur&id=<?= $id ?>" class="btn">Modifier l'acteur</a>
                <a class="btn btn-outline-danger" href="index.php?action=deleteActeur&id=<?= $id ?>" class="btn">supprimer l'acteur</a>
            </div> 
            </div>
        </div>
    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour cet acteur.</p>
    <?php } ?>
    

</div>



<?php

$content = ob_get_clean();
require 'view/template.php'; 

?>