<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout de role";
?>



    <div class="container">

        <h1><?= $titre_secondaire ?></h1>

        <form action="index.php?action=ajoutRole" method="POST">
            <div>
                <label for="intituleRole">intitullé du role :</label>
                <input type="text" class="form-control" name="intitule" id="intituleRole">
            </div>
            <input type="submit" value="Ajouter" name="submit">
        </form>
        
    </div>


    <?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>