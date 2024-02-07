<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire de modification d'un Real";
?>

<div class="container modifForm">
    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=modifReal&id=<?= $realisateur["id_personne"] ?>" method="POST">

        <div class="mb-3">
            <label for="idReal" class="form-label titreForm">Réalisateur à modifier : <strong> <?= $realisateur["realisateur"] ?></strong></label>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="prenom" value="<?= $realisateur["prenom"] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" value="<?= $realisateur["nom"] ?>" required>
        </div>
        <div class="mb-3">
            <label for="lien_wiki" class="form-label">Lien Wikipedia :</label>
            <input type="text" class="form-control" name="lien_wiki" value="<?= $realisateur["lien_wiki"] ?>">
        </div>
        <div class="mb-3">
            <label for="portrait" class="form-label">Lien vers le portrait :</label>
            <input type="text" class="form-control" name="portrait" value="<?= $realisateur["portrait"] ?>">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance :</label>
            <input type="date" class="form-control" name="date_naissance" value="<?= $realisateur["date_naissance"] ?>">
        </div>
        <div class="mb-3">
            <input type="submit" value="Modifier" name="submit" class="btn btn-success">
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require 'view/template.php';
?>
