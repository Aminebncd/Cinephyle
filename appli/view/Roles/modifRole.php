<?php
ob_start();
$titre = 'Cinephyle';
$titre_secondaire = "Formulaire de modification de rôle";
?>



    <div class="container">

        <h1><?= $titre_secondaire ?></h1>

        <form action="index.php?action=modifRole" method="POST">
        <div class="mb-3">
            <label for="idRole" class="form-label">Rôle à modifier :</label>
            <select class="form-control" name="idRole"  required>
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id_role'] ?>"><?= $role['role'] ?></option>
                    <?php endforeach; ?>
                </select>
        </div>
        <div class="mb-3">
            <label for="idRoleModifie" class="form-label">Rôle modifié :</label>
            <input type="text" class="form-control" name="roleModifie" id="roleModifie" required>
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