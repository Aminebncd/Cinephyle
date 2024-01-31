<?php
ob_start();

?>



<h3 >Nombre de films : <?= $requete->rowCount() ?></h3>



<div>
    <table>

        <thead>
            <tr>
                <th>TITRE</th>
                <th>ANNEE DE SORTIE</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($requete->fetchAll() as $film) { ?>
                    <tr>
                        <!-- à regler plus tard -->
                        <td>
                            <a class="filmLink" href="index.php?action=detailsFilm&id=<?= $film['id_film']?>">
                                <?= $film['titre']?>    
                            </a>
                        </td>
                        <!-- <td><?= $film['titre']?></td> -->
                        <td><?= $film['date_sortie_france']?></td>
                    </tr>
            <?php } ?>
        </tbody>
        
    </table>
</div>

<?php 

$titre = "Cinephyle";
$titre_secondaire = "Liste des films";
$content = ob_get_clean();
require 'view/template.php'; 

?>