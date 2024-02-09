<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détail du réalisateur";
if (isset($_SESSION['message'])) {
    echo '<div class="alert customAlert mt-2">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

?>
<h1><?= $titre_secondaire ?></h1>

<div class="filmDetails">
    <?php if ($requeteReal->rowCount() > 0) {

        $real = $requeteReal->fetch(); ?>

        <h2 class="detNom" ><?= $real['nom'] ?></h2>
        <img class="portraitDet" src="<?= $real['portrait'] ?>" alt="<?= $real['portrait'] ?>">
        <a href="<?= $real['lien_wiki'] ?>">lien wiki</a>
        
        <div class="corps">
        <p><strong>date de naissance:</strong> <?= date('d/m/Y', strtotime($real['date_naissance'])) ?></p>
        </div>

        <h3 class="cast">Filmographie :</h3>
        <div class="filmoContainer">
        <?php $films = $requeteFilmo->fetchAll(); 
            
            foreach ($films as $film) : ?>
                <div class="filmoCard">
                    <a class="link" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>">
                        <img class="afficheDetReal" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>" >    
                        <div class="titleDet"><?= $film['titre']?></div>
                    </a>
                </div>
            <?php endforeach; ?> 
    
        <?php } else { ?>
            <p>Aucun détail n'a été trouvé pour ce réalisateur.</p>
        <?php } ?>
        </div>

</div>

<div class="container buttons">
    <a class="btn btn-outline-primary" href="index.php?action=modifReal&id=<?= $id ?>" class="btn">Modifier le réalisateur</a>
    <a class="btn btn-outline-danger" href="index.php?action=deleteReal&id=<?= $id ?>" class="btn">supprimer le réalisateur</a>
</div> 

<?php

$content = ob_get_clean();
require 'view/template.php'; 

?>