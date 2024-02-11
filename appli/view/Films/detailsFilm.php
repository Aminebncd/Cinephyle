<?php
ob_start();
$titre = "Cinephyle";
$titre_secondaire = "Détails du film";
?>

<h1><?= $titre_secondaire ?></h1>

<div class="filmDetails">

    <?php if ($requeteFilm->rowCount() > 0) {
    $film = $requeteFilm->fetch(); ?>

    <img class="afficheDet" src="<?= $film['affiche'] ?>" alt="<?= $film['affiche'] ?>">
    <h2 class="detTitre"><?= $film['titre'] ?></h2>

        <div class="detFilmCorps">
            <p><strong>Réalisateur : </strong><a class="link" href="index.php?action=detailsReal&id=<?= $film['id_real'] ?>"><?= $film['réalisateur'] ?></a></p>

            <p><strong>Date de sortie (France) :</strong> <?= date('m/Y', strtotime($film['date_sortie_france'])) ?></p>

            <p><strong>Durée :</strong> <?= $film['duree_formatée'] ?> minutes</p>

            <p><strong>Note :</strong> <?= $film['note'] ?></p>

            <p><strong>genre(s) : <br></strong>
            <?php $genres = $requeteGenre->fetchAll(); 
                foreach($genres as $genre) { ?>
                <a class="link" href="index.php?action=detailsGenre&id=<?= $genre['id_genre'] ?>"><?= $genre['libelle'] ?></a>
            <?php } ?>
            </p>

            <p class="resume"><strong>Résumé : <br><br></strong> <?= $film['resume'] ?></p>
        </div>

    <h3 class="cast">Distribution des rôles :</h3>

    <?php $casting = $requeteCasting->fetchAll(); 
    
    foreach($casting as $cast) { ?>
        <p>
            <a class="link" href="index.php?action=detailsActeur&id=<?= $cast['id_acteur'] ?>"><?= $cast['acteur'] ?></a>
            dans le rôle de 
            <a class="link" href="index.php?action=detailsRole&id=<?= $cast['id_role'] ?>"><?= $cast['role'] ?></a>
        </p>
    <?php } ?>
         
    <div>
        <a class="far fa-trash-alt delete-icon" href="index.php?action=deleteCast&id=<?= $id?>"></a>
    </div>


    <?php } else { ?>
        <p>Aucun détail n'a été trouvé pour ce film.</p>
    <?php } ?>

        </div>

        <div class="container buttons">
            <a class="btn btn-outline-primary" href="index.php?action=modifFilm&id=<?= $id ?>" class="btn">Modifier le film</a>
            <a class="btn btn-outline-success" href="index.php?action=castFilm&id=<?= $id ?>" class="btn">Ajouter un casting</a>
            <a class="btn btn-outline-danger" href="index.php?action=deleteFilm&id=<?= $id ?>" class="btn">supprimer le film</a>
        </div> 

<?php
$content = ob_get_clean();
require 'view/template.php';
?>