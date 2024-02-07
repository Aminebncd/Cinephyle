<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout de film";
?>

<div class="container modifForm">

    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=ajoutFilm" method="POST" class="bg-transparent text-white p-4 rounded">
        <div class="mb-3">
            <label for="titreFilm" class="form-label">Titre :</label>
            <input type="text" class="form-control" name="titre" id="titreFilm" required>
        </div>
        <div class="mb-3">
            <label for="dateSortieFilm" class="form-label">Date de sortie en France :</label>
            <input type="date" class="form-control" name="dateSortieFrance" id="dateSortieFilm" required>
        </div>

        <div class="mb-3">
            <label for="dureeFilm" class="form-label">Durée (en minutes) :</label>
            <input type="number" class="form-control" name="duree" id="dureeFilm" required>
        </div>
        <div class="mb-3">
            <label for="resumeFilm" class="form-label">Résumé :</label>
            <textarea class="form-control" name="resume" id="resumeFilm" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="noteFilm" class="form-label">Note (de 1 à 10) :</label>
            <input type="number" class="form-control" name="note" id="noteFilm" min="0" max="10" step="0.5" required>
        </div>
        <div class="mb-3">
            <label for="afficheFilm" class="form-label">URL de l'affiche :</label>
            <input type="url" class="form-control" name="affiche" id="afficheFilm" required>
        </div>
        <div class="mb-3">
            <label for="idRealisateurFilm" class="form-label">Réalisateur :</label>
            <select class="form-control" name="idRealisateur" id="idRealisateurFilm" required>
                <?php foreach ($realisateurs as $realisateur) : ?>
                    <option value="<?= $realisateur['id_real'] ?>"><?= $realisateur['nom_realisateur'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <label for="idGenreFilm" class="form-label">Genre(s) :</label>
        <div class="mb-3 checkbox">
            <?php foreach ($genres as $genre) : ?>
                <div class="checkElement">
                    <input type="checkbox" name="idGenre[]" id="<?= $genre['id_genre'] ?>" value="<?= $genre['id_genre'] ?>" > 
                    <label class="checkLabel" for="idGenreFilm"><?= $genre['libelle'] ?></label>
                </div>
            <?php endforeach; ?>
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
