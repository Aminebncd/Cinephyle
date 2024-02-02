<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire d'ajout";
?>



    <div class="container">

        <h1>ajoutez un genre</h1>

        <form action="index.php?action=ajoutGenre">
            <div>
                <label for="nomGenre">Libelle du genre :</label>
                <input type="text" class="form-control" name="libelle" id="libelleGenre">
            </div>
            
        </form>
        
    </div>


    <?php
    $content = ob_get_clean();
    require 'view/template.php'; 
?>