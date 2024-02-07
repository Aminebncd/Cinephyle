<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire de modification de genre";


?>



<div class="container modifForm">

<h1 class="mb-3"><?= $titre_secondaire ?></h1>

<form action="index.php?action=modifGenre&id=<?= $id ?>" method="POST">

    <div class="mb-3">
        <label for="idGenre" class="form-label label">Genre à modifier :
             <?= $genre?>
            </label>
    </div>
    <div class="mb-3">
        <label for="idGenreModifie" class="form-label">Genre modifié :</label>
        <input type="text" class="form-control" name="genreModifie"   id="genreModifie" required>
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