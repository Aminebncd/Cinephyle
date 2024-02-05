<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout d'acteur";
?>

<div class="container mb-5">

    <h1><?= $titre_secondaire ?></h1>

    <form action="index.php?action=ajoutActeur" method="POST" class="bg-dark text-white p-4 rounded">
        <div class="mb-3">
            <label for="nomActeur" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nomActeur" required>
        </div>
        <div class="mb-3">
            <label for="prenomActeur" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenomActeur" required>
        </div>
        <div class="mb-3">
            <label for="sexeActeur" class="form-label">Sexe :</label>
            <select class="form-control" name="sexe" id="sexeActeur" required>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dateNaissanceActeur" class="form-label">Date de Naissance :</label>
            <input type="text" class="form-control" name="dateNaissance" id="dateNaissanceActeur" placeholder="Format: YYYY-MM-DD" required>
        </div>
        <div class="mb-3">
            <label for="portraitActeur" class="form-label">URL du Portrait :</label>
            <input type="url" class="form-control" name="portrait" id="portraitActeur" required>
        </div>
        <div class="mb-3">
            <label for="lienWikipediaActeur" class="form-label">Lien Wikipedia :</label>
            <input type="url" class="form-control" name="lienWikipedia" id="lienWikipediaActeur" required>
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
