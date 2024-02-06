<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire de modification de genre";
?>

<!-- PLUS UTILISE MAIS JE LE CONSERVE QUAND MEME -->

    <div class="container">

        <h1><?= $titre_secondaire ?></h1>

        <form action="index.php?action=modifGenre" method="POST">
        <div class="mb-3">
            <label for="idGenre" class="form-label">Genre à modifier :</label>
            <select class="form-control" name="idGenre"  required>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= $genre['id_genre'] ?>"><?= $genre['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
        </div>
        <div class="mb-3">
            <label for="idGenreModifie" class="form-label">Genre modifié :</label>
            <input type="text" class="form-control" name="genreModifie" id="genreModifie" required>
        </div>
        <div class="mb-3">
            <label for="submit" class="form-label"></label>
            <input type="submit" value="Modifier" name="submit" class="btn btn-success">
        </div>
        </form>
        
    </div>


    <?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>