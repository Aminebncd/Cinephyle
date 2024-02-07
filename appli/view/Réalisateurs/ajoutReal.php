<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout de réalisateur";
?>

<div class="container modifForm mb-5">

    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=ajoutReal" method="POST" class="bg-transparent text-white p-4 rounded">
        <div class="mb-3">
            <label for="nomReal" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nomReal" required>
        </div>
        <div class="mb-3">
            <label for="prenomReal" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenomReal" required>
        </div>
        <div class="mb-3">
            <label for="sexeReal" class="form-label">Sexe :</label>
            <select class="form-control" name="sexe" id="sexeReal" required>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dateNaissanceReal" class="form-label">Date de Naissance :</label>
            <input type="text" class="form-control" name="dateNaissance" id="dateNaissanceReal" placeholder="Format: YYYY-MM-DD" required>
        </div>
        <div class="mb-3">
            <label for="portraitReal" class="form-label">URL du Portrait :</label>
            <input type="url" class="form-control" name="portrait" id="portraitReal" required>
        </div>
        <div class="mb-3">
            <label for="lienWikipediaReal" class="form-label">Lien Wikipedia :</label>
            <input type="url" class="form-control" name="lienWikipedia" id="lienWikipediaReal" required>
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
