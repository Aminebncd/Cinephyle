<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout de genre";
?>

<div class="container">
    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=ajoutGenre" method="POST">
        <div class="mb-3">
            <label for="libelleGenre" class="form-label">Libellé du genre :</label>
            <input type="text" class="form-control" name="libelle" id="libelleGenre" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require 'view/template.php';
?>
