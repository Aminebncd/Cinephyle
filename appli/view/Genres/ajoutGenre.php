<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout de genre";
?>



    <div class="container">

        <h1><?= $titre_secondaire ?></h1>

        <form action="index.php?action=ajoutGenre" method="POST">
            <div>
                <label for="nomGenre">Libelle du genre :</label>
                <input type="text" class="form-control" name="libelle" id="libelleGenre">
            </div>
            <input type="submit" value="Ajouter" name="submit">
        </form>
        
    </div>


    <?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>