
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des interprètes pour le rôle de :";
?>
<div class="container">
    <h1><?= $titre_secondaire ?></h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" colspan="2"><?= $requeteNomRole->fetch()['role']?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($requeteHisto->fetchAll() as $historique): ?>
                <tr>
                    <td>
                        <div>
                        <a class="link" href="index.php?action=detailsActeur&id=<?= $historique['id_acteur']?>"><?= $historique['acteur']?></a> dans
                        <a class="link" href="index.php?action=detailsFilm&id=<?= $historique['id_film']?>"><?= $historique['titre']?></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
<div class="container buttons">
    <a class="btn btn-outline-primary" href="index.php?action=modifRole&id=<?= $id ?>" class="btn">Modifier le rôle</a>
    <a class="btn btn-outline-danger" href="index.php?action=deleteRole&id=<?= $id ?>" class="btn">supprimer le rôle</a>
</div> 

</body>
</html>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>