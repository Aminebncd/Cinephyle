
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
                        <a class="link" href="index.php?action=detailsActeur&id=<?= $historique['id_acteur']?>"><?= $historique['acteur']?></a> dans
                        <a class="link" href="index.php?action=detailsFilm&id=<?= $historique['id_film']?>"><?= $historique['titre']?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>