<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire de modification d'un Real";
?>

<div class="container">
    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=modifReal" method="POST">
        <div class="mb-3">
            <label for="idReal" class="form-label">Real à modifier :</label>
            <select class="form-control" name="idReal" required>
                <?php foreach ($reals as $real) : ?>
                    <option value="<?= $real['id_personne'] ?>"><?= $real['realisateur'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="lien_wiki" class="form-label">Lien Wikipedia :</label>
            <input type="text" class="form-control" name="lien_wiki">
        </div>
        <div class="mb-3">
            <label for="portrait" class="form-label">Lien vers le portrait :</label>
            <input type="text" class="form-control" name="portrait">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance :</label>
            <input type="date" class="form-control" name="date_naissance">
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
