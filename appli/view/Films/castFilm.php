<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout d'un casting";
?>

<div class="container modifForm">

    <h1 class="mb-3"><?= $titre_secondaire ?></h1>

    <form action="index.php?action=castFilm&id=<?= $id ?>" method="POST">

        <div class="mb-3">
            <label for="idGenre" class="form-label titreForm">Casting du film : <strong><?= $film['titre']?></strong></label>
        </div>

        <div class="mb-3">
            <label for="idActeur" class="form-label">Acteur :</label>
            <select class="form-control" name="idActeur" id="idActeur" required>
                <?php foreach ($acteurs as $acteur) : ?>
                    <option value="<?= $acteur['id_acteur'] ?>"><?= $acteur['acteur'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="idRole" class="form-label">Dans le rôle de :</label>
            <select class="form-control" name="idRole" id="idRole" required>
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id_role'] ?>"><?= $role['role'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="submit" class="form-label"></label>
            <input type="submit" value="Ajouter" name="submit" class="btn btn-success">
        </div>
    </form>

</div>


<?php
$content = ob_get_clean();
require 'view/template.php'; 
?>
