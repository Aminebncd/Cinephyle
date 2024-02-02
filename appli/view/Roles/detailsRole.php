
<?php
session_start(); 
ob_start(); 

$titre = "Cinephyle";
$titre_secondaire = "Liste des interprètes pour le rôle de :";
?>

<h1><a class="nav-link" href="index.php?action=listRoles"><?= $titre_secondaire ?></a></h1>


<div>
    <table>

        <thead>
            <tr>
                <th scope="row" colspan="2"><?= $requeteNomRole->fetch()['role']?></th>
                
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($requeteHisto->fetchAll() as $historique) { ?>

                    <tr>                       
                        <td>
                            <a class="filmLink" href="index.php?action=detailsActeur&id=<?= $historique['id_acteur']?>"><?= $historique['acteur']?></a>
                                dans
                            <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $historique['id_film']?>"><?= $historique['titre']?></a>
                        </td>                       
                    </tr>

            <?php } ?>
        </tbody>
        
    </table>
</div>


<?php 
$content = ob_get_clean();
require "view/template.php" ;